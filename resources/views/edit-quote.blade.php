@extends('layouts.app')
@section('content')
    
    @if($quote->status == '0')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Edit Quote</h2>
                <!-- <button class="au-btn au-btn-icon au-btn--blue">
                    <i class="zmdi zmdi-plus"></i>add item
                </button> -->
            </div>
        </div>
    </div>
    @endif

    <div class="row m-t-25">
        <div class="col-lg-12">
            
            <div class="card">

                <div class="card-header py-2">
                    <div class="row">
                    
                        <!-- Messages -->
                        <div class="form-group col-md-12">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif
                        </div>
                        <!-- Messages -->

                        <div class="col-md-6">
                            <h3 class="m-2 text-center text-md-left">Quote No: {{ $quote->quote_number }}</h3>
                        </div>

                        <div class="col-md-6 d-none d-sm-block">
                            <img class="pull-right" src="{{ URL::asset('/images/360-logo.png') }}" alt="360-app">
                        </div>

                    </div>
                </div>
                
                <div class="card-body">

                    <form class="pt-4 edit-quote-form" method="POST" action="{{ route('updateQuote',[$quote->id]) }}" enctype="multipart/form-data">
                        
                        {{ csrf_field() }}
                        <input type="hidden" id="quote_number" name="quote_number" value="{{ $quote->quote_number }}">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_name" class="control-label mb-1">Client Name</label>
                                    <input id="c_name" name="c_name" type="text" class="form-control c_name" value="{{ $quote->c_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_email" class="control-label mb-1">Client Email</label>
                                    <input id="c_email" name="c_email" type="email" class="form-control c_email" value="{{ $quote->c_email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_contact" class="control-label mb-1">Client Contact Number</label>
                                    <input id="c_contact" name="c_contact" class="form-control c_contact" type="tel" pattern="^\d{4}\d{3}\d{3}$" value="{{ $quote->c_contact }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="address" class="control-label mb-1">Job Address</label>                                    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea name="address_1" id="address_1" rows="1" placeholder="Address line 1" class="form-control address_1" readonly>{{ $quote->address_1 }}</textarea>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea name="address_2" id="address_2" rows="1" placeholder="Address line 2" class="form-control address_2" readonly>{{ $quote->address_2 }}</textarea>
                                </div>  
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input name="city" type="text" class="form-control city" value="{{ $quote->city }}" readonly>
                                </div> 
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <input name="post_code" type="text" class="form-control post_code" value="{{ $quote->post_code }}" readonly>
                                </div>  
                            </div>
                        </div>

                        <!-- Table-->                        
                        <table id="orderTable" class="mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col" style="width: 385px;">Description</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quote_items as $qi)   
                                <tr>
                                    <input type="hidden" name="item_id[]" value="{{ $qi->id }}">
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="{{ $qi->name }}" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="1" class="form-control description" readonly>{{ $qi->description }}</textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" min="1" value="{{ $qi->qty }}" readonly>
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" step="any" value="{{ $qi->unit_price }}" readonly>
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" value="{{ $qi->sub_total }}" readonly>
                                    </td>
                                </tr>
                                @endforeach
                                
                                <tr>
                                    <td data-label="" class="sm-hide" colspan="3"></td>
                                    <td data-label="" class="sm-hide">Grand Total ($)</td>
                                    <td data-label="Grand Total">
                                        <input id="grand_total" name="grand_total" type="number" class="form-control grand_total" value="{{ $quote->grand_total }}" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="" class="sm-hide" colspan="3"></td>
                                    <td data-label="" class="sm-hide">GST Tax (10%)</td>
                                    <td data-label="GST Tax (10%)">
                                        <input id="tax" name="tax" type="number" class="form-control tax" value="{{ $quote->tax }}" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="" class="sm-hide" colspan="3"></td>
                                    <td data-label="" class="sm-hide">Net Total ($)</td>
                                    <td data-label="Total">
                                        <input id="total" name="total" type="number" class="form-control total" value="{{ $quote->total }}" readonly >
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                        <!-- Table-->

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="float-md-right mr-2 mt-4">
                                    <button id="changes-button" type="button" class="btn btn-sm btn-dark btn-block">Make Changes to Items</button>
                                    <button id="changes-save-button" type="submit" class="btn btn-sm btn-success btn-block" name="submitbutton" value="3">Save Changes</button>
                                </p>                                
                            </div>
                        </div>

                        @if(count($quote_pictures)>0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="upload_file" class="control-label mb-1">Images</label>                                    
                                    <div id="image_preview">
                                    @foreach ($quote_pictures as $qp)                                      
                                        <img src="{{ URL::asset('/quote_images/'. $qp->name ) }}">                                       
                                    @endforeach                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment" class="control-label mb-1">Note </label>
                                    <textarea name="comment" id="comment" rows="3" placeholder="" class="form-control comment" readonly>{{ $quote->comment }}</textarea>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <?php 
                                    $today = date("d-m-Y"); 
                                    $oneMonthFromNow = date( "d-m-Y", strtotime( "$today +1 month" ) );
                                    //$exp_date = date("d-m-Y", strtotime($quote->draft_date));
                                ?>
                                <div class="form-group">
                                    <label for="expiry_date" class="control-label mb-1">This quote expires on</label>
                                    <input id="expiry_date" name="expiry_date" type="text" class="form-control expiry_date" value="<?php echo $oneMonthFromNow?>" readonly>
                                </div> 
                            </div>
                        </div>

                        @if($quote->status == '2') 

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reject_reason" class="control-label mb-1">Reason for Rejecting </label>
                                    <textarea name="reject_reason" id="reject_reason" rows="3" class="form-control reject_reason">{{ $quote->reject_reason }}</textarea>
                                </div> 
                            </div>
                        </div>

                        @endif

                        @if($quote->status == '0') 
                        <div class="row mb-4">

                            <!-- <div class="col-md-12 mb-3">
                                <h3 class="text-md-left pb-4">Please Choose your Design</h3>
                            </div>-->

                            <div class="col-md-12">
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="quote_option" id="approve" value="approve">
                                    <label class="form-check-label">Approve this Quote</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="quote_option" id="reject" value="reject">
                                    <label class="form-check-label">Reject this Quote</label>
                                </div>

                            </div>

                        </div>

                                                  
                        <div id="quote_reject" class="row hide" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reject_reason" class="control-label mb-1">Reason for Rejecting </label>
                                    <textarea name="reject_reason" id="reject_reason" rows="3" placeholder="" class="form-control reject_reason"></textarea>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <p class="float-md-left">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block reject_btn" name="submitbutton" value="2">
                                        <i class="fa fa-bolt fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Reject</span>
                                    </button>
                                </p>
                            </div>
                        </div>

                        <div id="quote_approve" class="row hide" style="display: none;">
                            <div class="col-md-12">
                                <p class="float-md-left mr-2">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submitbutton" value="1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Approve</span>
                                    </button>
                                </p>
                            </div>
                        </div>
                        @endif

                        <?php 
                            if($quote->status == '0'){ $back = route('index'); } 
                            else if($quote->status == '1'){ $back = route('approvedQuotes'); } 
                            else if($quote->status == '2'){ $back = route('rejectedQuotes'); } 
                        ?>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="float-md-right  mr-2">
                                    <a href="{{ $back }}" class="btn btn-lg btn-info btn-block">Back</a>
                                </p>                                
                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
    
@endsection
