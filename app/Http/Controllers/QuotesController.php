<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;
use App\QuoteItem;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'total' => 'required'
            //'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        // if($request->hasFile('cover_image')){
        //     // Get filename with the extension
        //     $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //     // Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //     // Get just ext
        //     $extension = $request->file('cover_image')->getClientOriginalExtension();
        //     // Filename to store
        //     $fileNameToStore= $filename.'_'.time().'.'.$extension;
        //     // Upload Image
        //     $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        // } else {
        //     $fileNameToStore = 'noimage.jpg';
        // }

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
        //
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
        //
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
