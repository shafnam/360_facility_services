<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\QuoteItem;
use App\QuotePhoto;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function pendingQuotes()
    {
        $quotes = Quote::orderBy('quote_number','desc')->where('status','0')->get();
        return view('pending-quotes')->with('quotes', $quotes);
        //return view('pending-quotes');
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
            'c_contact' => 'required|regex:/(0)[0-9]{9}/',
            'job_address' => 'required',
            'expiry_date' => 'required',
            'description' => 'required|array',
            'unit_price' => 'required|array',
            'sub_total' => 'required|array',
            'grand_total' => 'required',
            'tax' => 'required',
            'total' => 'required',
            'upload_file' => 'max:999|required'
            //'cover_image' => 'image|nullable|max:1999'
        ]);

        // Create Quote
        $quote = new Quote;
        $quote->quote_number = $request->input('quote_number');
        $quote->c_name = $request->input('c_name');
        $quote->c_email = $request->input('c_email');
        $quote->c_contact = $request->input('c_contact');
        $quote->job_address = $request->input('job_address');
        $quote->grand_total = $request->input('grand_total');
        $quote->tax = $request->input('tax');
        $quote->total = $request->input('total');
        $quote->comment = $request->input('comment');
        $quote->expiry_date = $request->input('expiry_date');
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
        
        //Check if quote exists before deleting
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
        // Update Quote
        $quote = Quote::find($id);

        if($request->input('submitbutton') == '1'){
            $quote->status = '1';
            $quote->save();
            return redirect('/pending-quotes')->with('success', 'Quote approved');
        }
        else if($request->input('submitbutton') == '2'){
            $quote->status = '2';
            $quote->save();
            return redirect('/pending-quotes')->with('success', 'Quote rejected');
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
