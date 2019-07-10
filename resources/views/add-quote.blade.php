@extends('layouts.app')
@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Add New Quote</h2>
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
                            <h3 class="m-2 text-center text-md-left">Quote No: {{ $quote_number }}</h3>
                        </div>

                        <div class="col-md-6 d-none d-sm-block">
                            <img class="pull-right" src="{{ URL::asset('/images/360-logo.png') }}" alt="360-app">
                        </div>

                    </div>
                </div>
                
                <div class="card-body">

                    <!-- <div class="card-title">
                        <h3 class="text-center title-2">Pay Invoice</h3>
                    </div>
                    <hr> -->

                    <form id="add-quote-form" class="pt-4 draft-quote-form" method="POST" action="{{ route('addQuote') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="quote_number" name="quote_number" value="{{ $quote_number }}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_name" class="control-label mb-1">Client Name*</label>
                                    <input id="c_name" name="c_name" type="text" class="form-control c_name" value="{{ old('c_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_email" class="control-label mb-1">Client Email*</label>
                                    <input id="c_email" name="c_email" type="email" class="form-control c_email" value="{{ old('c_email') }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_contact" class="control-label mb-1">Client Contact Number*</label>
                                    <input id="c_contact" name="c_contact" class="form-control c_contact" type="text" maxlength="14" placeholder="(XXX) XXX-XXXX" value="{{ old('c_contact') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="address" class="control-label mb-1">Job Address*</label>                                    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea name="address_1" id="address_1" rows="1" placeholder="Address line 1" class="form-control address_1" required>{{ old('address_1') }}</textarea>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <textarea name="address_2" id="address_2" rows="1" placeholder="Address line 2" class="form-control address_2">{{ old('address_2') }}</textarea>
                                </div>  
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input name="city" type="text" class="form-control city" placeholder="City" value="{{ old('city') }}" required>
                                </div> 
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <input name="post_code" type="text" class="form-control post_code" placeholder="Post code" value="{{ old('post_code') }}" required>
                                </div>  
                            </div>
                        </div>

                        <!-- Table-->                        
                        <table id="orderTable" class="my-5">
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
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Labour" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="" class="form-control description">{{ old('description.0') }}</textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="{{ old('qty.0') }}" min="0">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" value="{{ old('unit_price.0') }}" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" value="{{ old('sub_total.0') }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Callout Fee" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="" class="form-control description">{{ old('description.1') }}</textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="{{ old('qty.1') }}" min="0">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" value="{{ old('unit_price.1') }}" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" value="{{ old('sub_total.1') }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Equipment" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="" class="form-control description">{{ old('description.2') }}</textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="{{ old('qty.2') }}" min="0">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" value="{{ old('unit_price.2') }}" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" value="{{ old('sub_total.2') }}" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Travel" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="" class="form-control description">{{ old('description.3') }}</textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="{{ old('qty.3') }}" min="0">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" value="{{ old('unit_price.3') }}" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" value="{{ old('sub_total.3') }}" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Other" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="" class="form-control description">{{ old('description.4') }}</textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="{{ old('qty.4') }}" min="0">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" value="{{ old('unit_price.4') }}" step="any" >
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" value="{{ old('sub_total.4') }}" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="" class="sm-hide" colspan="3"></td>
                                    <td data-label="" class="sm-hide">Grand Total ($)</td>
                                    <td data-label="Grand Total">
                                        <input id="grand_total" name="grand_total" type="number" class="form-control grand_total" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="" class="sm-hide" colspan="3"></td>
                                    <td data-label="" class="sm-hide">GST Tax (10%)</td>
                                    <td data-label="GST Tax (10%)">
                                        <input id="tax" name="tax" type="text" class="form-control tax" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="" class="sm-hide" colspan="3"></td>
                                    <td data-label="" class="sm-hide">Net Total ($)</td>
                                    <td data-label="Total">
                                        <input id="total" name="total" type="number" class="form-control total" readonly >
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                        <!-- Table-->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="upload_file" class="control-label mb-1">Upload Images (Each image size should be less than 1MB)</label>
                                    <input type="file" class="form-control" id="upload_file" name="upload_file[]" placeholder="upload images here" style="height: 45px;" multiple>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div id="image_preview"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment" class="control-label mb-1">Note</label>
                                    <textarea name="comment" id="comment" rows="3" placeholder="" class="form-control comment">{{ old('comment') }}</textarea>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <?php 
                                    $today = date("d-m-Y"); 
                                    $twoWeeksFromNow = date( "d-m-Y", strtotime( "$today +2 week" ) );
                                ?>
                                <div class="form-group">
                                    <label for="draft_date" class="control-label mb-1">Drafted on</label>
                                    <input id="draft_date" name="draft_date" type="text" class="form-control draft_date" value="<?php echo $today; ?>" readonly>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="float-md-right">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-refresh fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Save as Draft</span>
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
