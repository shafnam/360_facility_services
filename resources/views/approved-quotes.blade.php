@extends('layouts.app')
@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Approved Quotes</h2>
                <!-- <button class="au-btn au-btn-icon au-btn--blue">
                    <i class="zmdi zmdi-plus"></i>add item
                </button> -->
            </div>
        </div>
    </div>

    <div class="row m-t-25">
        
        <div class="col-lg-12">

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

        </div>

        <div class="col-lg-12">
            
            <div class="card">

                <!-- <div class="card-header py-5">
                    <div class="row">
                    
                        <!-- Messages --
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
                        <!-- Messages --
                    </div>
                </div> -->
                
                <div class="card-body">

                    <!-- <div class="card-title">
                        <h3 class="text-center title-2">Pay Invoice</h3>
                    </div>
                    <hr> -->

                    <!-- Table-->                        
                    <table id="pending" class="mb-5">
                        <thead>
                            <tr>
                                <th scope="col">Quote Number</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Job Address</th>
                                <th scope="col">Expires On</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //for($i=0; $i<=60; $i++){ ?> 
                            @if(count($quotes) > 0)
                                @foreach($quotes as $quote)
                                <tr>
                                    <td data-label="Quote Number">
                                    {{ $quote->quote_number }}
                                    </td>
                                    <td data-label="Client Name">
                                    {{ $quote->c_name }}
                                    </td>
                                    <td data-label="Email">
                                    {{ $quote->c_email }}
                                    </td>
                                    <td data-label="Job Address">
                                    {{ $quote->address_1 }}
                                    {{ $quote->address_2 }},
                                    {{ $quote->city }}
                                    {{ $quote->post_code }}
                                    </td>
                                    <td data-label="Expires On">
                                    {{ $quote->expiry_date }}
                                    </td>
                                    <td data-label="Action">
                                        <div class="table-data-feature">
                                            <a href="{{ route('editQuote',[$quote->id]) }}" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </a>
                                            <!-- <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button> -->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                            <?php //}?> 
                        </tbody>
                    </table>
                    <!-- Table-->

                    <!-- <form class="pt-4 draft-quote-form" method="POST" action="{{ route('addQuote') }}" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label for="upload_file" class="control-label mb-1">Upload Images</label>
                                    <input type="file" class="form-control" id="upload_file" name="upload_file[]" placeholder="upload images here" multiple required>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div id="image_preview"></div>
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

                    </form> -->


                </div>

            </div>

        </div>
        
    </div>
    
@endsection
