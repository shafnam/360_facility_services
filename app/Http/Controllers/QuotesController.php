<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\QuoteItem;
use App\QuotePhoto;
use Mail;
use App\Mail\SendQuoteMail;
use PDF;
use Illuminate\Support\Facades\Storage;

class QuotesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('pending-quotes');
        $quotes = Quote::orderBy('quote_number','desc')->where('status','0')->get();
        return view('pending-quotes')->with('quotes', $quotes);
    }

    public function addQuote()
    {
        return view('add-quote');
    }

    public function approvedQuotes()
    {
        $quotes = Quote::orderBy('quote_number','desc')->where('status','1')->get();
        return view('approved-quotes')->with('quotes', $quotes);
    }

    public function rejectedQuotes()
    {
        $quotes = Quote::orderBy('quote_number','desc')->where('status','2')->get();
        return view('rejected-quotes')->with('quotes', $quotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'c_name' => 'required',
            'c_email' => 'required',
            'c_contact' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            //'expiry_date' => 'required',

            'description.0' => 'required',
            'description.1' => 'required',
            'description.2' => 'required',
            'description.3' => 'required',

            'unit_price.0' => 'required',
            'unit_price.1' => 'required',
            'unit_price.2' => 'required',
            'unit_price.3' => 'required',

            'sub_total.0' => 'required',
            'sub_total.1' => 'required',
            'sub_total.2' => 'required',
            'sub_total.3' => 'required',
            //'description' => 'required|array',
            //'unit_price' => 'required|array',
            //'sub_total' => 'required|array',
            'grand_total' => 'required',
            'tax' => 'required',
            'total' => 'required',
            //'upload_file' => 'max:999|nullable'
            'upload_file.*' => 'image|mimes:jpeg,png,jpg,gif|max:1999'
            //'cover_image' => 'image|nullable|max:1999'
        ]);

        // Create Quote
        $quote = new Quote;
        $quote->quote_number = $request->input('quote_number');
        $quote->c_name = $request->input('c_name');
        $quote->c_email = $request->input('c_email');
        $quote->c_contact = $request->input('c_contact');
        $quote->address_1 = $request->input('address_1');
        $quote->address_2 = $request->input('address_2');
        $quote->city = $request->input('city');
        $quote->post_code = $request->input('post_code');
        $quote->grand_total = $request->input('grand_total');
        $quote->tax = $request->input('tax');
        $quote->total = $request->input('total');
        $quote->comment = $request->input('comment');
        $quote->draft_date = $request->input('draft_date');
        $quote->status = '0';
        $quote->save();

        // Create Quote Items 
        for ($i = 0; $i < count($request->input('qty')); $i++) {
            $QuoteItem = new QuoteItem();
            $QuoteItem->name = $request->item_name[$i];
            $QuoteItem->description = $request->description[$i]; 
            $QuoteItem->qty = $request->qty[$i];
            $QuoteItem->unit_price = $request->unit_price[$i];
            $QuoteItem->sub_total = $request->sub_total[$i];
            //Save one to many relationship
            $quote->quote_items()->save($QuoteItem); 
        }

        // Handle File Upload
        if($request->hasFile('upload_file')){
            foreach($request->file('upload_file') as $file_upload){
                
                // Get File name with the extension
                $filenameWithExt = $file_upload->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $file_upload->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename.'-'.time().'.'.$extension;
                $path =  public_path().'/quote_images/';
                // Upload Image
                $file_upload->move($path, $fileNameToStore);

                // Create Quote Images 
                $quotePhoto = new QuotePhoto();
                $quotePhoto->name = $fileNameToStore;
                //Save one to many relationship
                $quote->quote_items()->save($quotePhoto); 
            }
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        return redirect('/')->with('success', 'Quote Drafted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::find($id);
        $quote_items =  QuoteItem::where('quote_id', $id)->get();
        $quote_pictures =  QuotePhoto::where('quote_id', $id)->get();
        
        //Check if quote exists before editing
        if (!isset($quote)){
            return redirect('/pending-quotes')->with('error', 'No Quote Found');
        }

        // Check for correct user
        // if(auth()->user()->id !==$post->user_id){
        //     return redirect('/edit-quote')->with('error', 'Unauthorized Page');
        // }

        return view('edit-quote', compact('quote', 'quote_items', 'quote_pictures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $items = array(); 
        $attachments = array();
        $quote_details = array();
        
        $quote = Quote::find($id);

        // quote details
        $quote_number = $request->input('quote_number');
        $c_name = $request->input('c_name');
        $c_email = $request->input('c_email');
        $c_contact = $request->input('c_contact');
        $address_1 = $request->input('address_1');
        $address_2 = $request->input('address_2');
        $city = $request->input('city');
        $post_code = $request->input('post_code');
        $grand_total = $request->input('grand_total');
        $tax = $request->input('tax');
        $total = $request->input('total');
        $comment = $request->input('comment');
        $expiry_date = $request->input('expiry_date');       

        // quote item details        
        $quote_items = $quote->quote_items; //the quote items object
        // quote images details
        $quote_photos = $quote->quote_photos; //the quote items object

        //item details array (for email)
        foreach ($quote_items as $quote_item) {
            array_push($items, [
                'item' => $quote_item->name,
                'description' => $quote_item->description,
                'qty' => $quote_item->qty,
                'unit_price' => $quote_item->unit_price,
                'sub_total' => $quote_item->sub_total
            ]);           
        }       

        if($request->input('submitbutton') == '1'){
            // Approved
            $quote->status = '1';
            $quote->expiry_date = $expiry_date;
            $quote->save();
            
            // create PDF file
            $pdf = PDF::loadView('pdf', compact('quote', 'quote_items', 'quote_photos')); 
            $content = $pdf->download()->getOriginalContent();      
                  
            // Store pdf in quote_pdf folder in public folder (new folder created in config/filesystems.php)
            Storage::disk('quote_pdf')->put($quote_number.'_quote.pdf', $content);
            //Storage::put('public/pdf/name.pdf',$content) ;

            // pdf location
            //$file = storage_path('/quote_pdf/'. $quote_number.'_quote.pdf');
            // $file_path =  public_path().'/quote_pdf/'. $quote_number.'_quote.pdf';
            // $file_name =  $quote_number.'_quote.pdf';
            //dd($file);

            // item photos array (for email attachments)
            foreach ($quote_photos as $quote_photo) {
                array_push($attachments, [
                    'file_path' => public_path().'/quote_images/'. $quote_photo->name,
                    'file_name' => $quote_photo->name
                ]);           
            }
            // foreach ($quote_photos as $quote_photo) {
            //     array_push($attachments, [
            //         public_path().'/quote_images/'. $quote_photo->name => [
            //             'as' => $quote_photo->name,
            //             'mime' => 'application/pdf',
            //         ]
            //     ]);           
            // }
            
            // add PDFattachment details
            array_push($attachments, [
                // public_path().'/quote_pdf/'. $quote_number.'_quote.pdf' => [
                //     'as' => $quote_number.'_quote.pdf',
                //     'mime' => 'application/pdf',
                // ]
                'file_path' =>  public_path().'/quote_pdf/'. $quote_number.'_quote.pdf',
                'file_name' =>  $quote_number.'_quote.pdf'
            ]);
            //dd($attachments);

            $quote_details =  [
                'quote_number' => $quote_number,
                'c_name' => $c_name,
                'c_email' => $c_email,
                'c_contact' => $c_contact,
                'address_1' => $address_1,
                'address_2' => $address_2,
                'city' => $city,
                'post_code' => $post_code,
                'grand_total' => $grand_total,
                'tax' => $tax,
                'total' => $total,
                'expiry_date' => $expiry_date,
                'items' => $items,
                'attachments' => $attachments
                // 'file_path' => $file_path,
                // 'file_name' => $file_name,
            ];
            //dd($quote_details);

            // send email 
            //Mail::send(new SendQuoteMail());
            Mail::to($c_email)->send(new SendQuoteMail($quote_details));           

            return redirect('/')->with('success', 'Quote approved');
        }
        else if($request->input('submitbutton') == '2'){
            // Rejected
            $quote->status = '2';
            $quote->reject_reason = $request->input('reject_reason');
            $quote->save();
            return redirect('/')->with('success', 'Quote rejected');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
