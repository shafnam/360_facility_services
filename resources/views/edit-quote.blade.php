@extends('layouts.app')
@section('content')
    
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
                            <img class="pull-right" src="/images/icon/logo.png" alt="Cool Admin">
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
                                <div class="form-group">
                                    <label for="job_address" class="control-label mb-1">Job Address</label>
                                    <textarea name="job_address" id="job_address" rows="3" placeholder="Address..." class="form-control job_address" readonly>{{ $quote->job_address }}</textarea>
                                </div> 
                            </div>
                        </div>

                        <div class="card-title mt-4 mb-5">
                            <h3 class="text-center title-2">Pay Invoice</h3>
                        </div>

                        <!-- Table-->                        
                        <table id="orderTable" class="mb-5">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quote_items as $qi)   
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="{{ $qi->name }}" readonly readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="..." class="form-control description" value="{{ $qi->description }}" readonly></textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="1" min="1" value="{{ $qi->qty }}" readonly>
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment" class="control-label mb-1">Comment</label>
                                    <textarea name="comment" id="comment" rows="3" placeholder="" class="form-control comment" readonly>{{ $quote->comment }}</textarea>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="expiry_date" class="control-label mb-1">This quote expires on</label>
                                    <input id="expiry_date" name="expiry_date" type="text" class="form-control expiry_date" value="{{ $quote->expiry_date }}" readonly>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="upload_file" class="control-label mb-1">Upload Images</label>
                                    <input type="file" class="form-control" id="upload_file" name="upload_file[]" placeholder="upload images here" multiple required>
                                </div> 
                            </div> -->
                            <div class="col-md-12">
                                <div id="image_preview">
                                @foreach ($quote_pictures as $qp)     
                                    <img src="{{ URL::asset('/quote_images/'. $qp->name ) }}">
                                @endforeach                                         
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <p class="float-md-right">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block" name="submitbutton" value="2">
                                        <i class="fa fa-bolt fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Reject</span>
                                    </button>
                                </p>
                                <p class="float-md-right  mr-2">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submitbutton" value="1">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Approve</span>
                                    </button>
                                </p>                                
                            </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
    
@endsection
