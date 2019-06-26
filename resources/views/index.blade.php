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

                <div class="card-header py-5">
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
                            <h3 class="m-2 text-center text-md-left">Quote No: 157896</h3>
                        </div>

                        <div class="col-md-6 d-none d-sm-block">
                            <img class="pull-right" src="images/icon/logo.png" alt="Cool Admin">
                        </div>

                    </div>
                </div>
                
                <div class="card-body">

                    <!-- <div class="card-title">
                        <h3 class="text-center title-2">Pay Invoice</h3>
                    </div>
                    <hr> -->

                    <form class="pt-4 draft-quote-form" method="POST" action="{{ route('addQuote') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="quote_number" name="quote_number" value="157896">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_name" class="control-label mb-1">Client Name</label>
                                    <input id="c_name" name="c_name" type="text" class="form-control c_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_email" class="control-label mb-1">Client Email</label>
                                    <input id="c_email" name="c_email" type="email" class="form-control c_email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="c_contact" class="control-label mb-1">Client Contact Number</label>
                                    <input id="c_contact" name="c_contact" class="form-control c_contact" type="tel" pattern="^\d{4}\d{3}\d{3}$" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="job_address" class="control-label mb-1">Job Address</label>
                                    <textarea name="job_address" id="job_address" rows="3" placeholder="Address..." class="form-control job_address"></textarea>
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
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Labour" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="..." class="form-control description"></textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="1" min="1">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Callout Fee" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="..." class="form-control description"></textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="1" min="1">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Equipment" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="..." class="form-control description"></textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="1" min="1">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Travel" readonly>
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="..." class="form-control description"></textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="1" min="1">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" step="any">
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Item">
                                        <input name="item_name[]" type="text" class="form-control item_name" value="Other" readonly >
                                    </td>
                                    <td data-label="Description">
                                        <textarea name="description[]" rows="3" placeholder="..." class="form-control description"></textarea>
                                    </td>
                                    <td data-label="Qty">
                                        <input name="qty[]" type="number" class="form-control qty calc" value="1" min="1">
                                    </td>
                                    <td data-label="Unit Price">
                                        <input name="unit_price[]" type="number" class="form-control unit_price calc" step="any" >
                                    </td>
                                    <td data-label="Total">
                                        <input name="sub_total[]" type="number" class="form-control sub_total" step="any" readonly >
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
                                    <label for="comment" class="control-label mb-1">Comment</label>
                                    <textarea name="comment" id="comment" rows="3" placeholder="" class="form-control comment"></textarea>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <?php 
                                    $today = date("Y-m-d"); 
                                    $twoWeeksFromNow = date( "Y-m-d", strtotime( "$today +2 week" ) );
                                ?>
                                <div class="form-group">
                                    <label for="expiry_date" class="control-label mb-1">This quote expires on</label>
                                    <input id="expiry_date" name="expiry_date" type="text" class="form-control expiry_date" value="<?php echo $twoWeeksFromNow; ?>" readonly>
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
