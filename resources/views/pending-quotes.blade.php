@extends('layouts.app')
@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Pending Quotes</h2>
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
                                <th scope="col">Drafted On</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    <?php 
                                        $exp_date = date("d-m-Y", strtotime($quote->draft_date));
                                    ?>
                                    {{ $exp_date }}
                                    </td>
                                    <td data-label="Action">
                                        <div class="table-data-feature">
                                            <a href="{{ route('editQuote',[$quote->id]) }}" class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- Table-->

                </div>

            </div>

        </div>
        
    </div>
    
@endsection
