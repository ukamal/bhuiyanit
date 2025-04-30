@extends('layouts.backend.print_master')
@section('title', 'Sale Details')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
    <style>
        @media print {
            .card {
                display: block;
            }

            .table td,
            .table th {
                padding: 0.5rem;
                color: black !important;
            }
        }
        tbody#table-body {
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card text-left">
            <div class="card-body">
                <div class="header_img mb-2">
                    {{-- <img src="{{asset('img/top_header_img.jpeg')}}" style="width: 100%;height:120px" alt=""> --}}
                    <div class="invoice-masthead" style="margin-bottom: 10px;position:relative;">
                        <div class="invoice-text" style="text-align:center; float:none">
                            <h4 class=" text-uppercase text-thin mar-no">{{ ' Bhuiyan Technologies & Solutions.' }}</h4>
                            <div class="badge badge-dark" style="font-size: 16px;">Your Trusted ICT Partner </div>
                            <p class="mt-3">Location: Shop # A-5, (Ground Floor Computer Market) Wali Khan Bhaban, <br>
                            South side of Robi Sheba. 603 Sekh Mujib Road, <br> Chowmuhuni Circle, Agrabad - Chattogram. 
                            <br>
                            Mobile:02334419698, 01601240791.
                            <br>
                            Email:btech.solutions0320@gmail.com.
                            </p>
                            <h4 class="h3 text-uppercase text-thin mar-no text-primary"><label
                                    class="label label-primary">{{ 'INVOICE' }}</label>
                            </h4>
                        </div>

                        <div style="position:absolute;top:20px;">
                            <img src="{{ asset('logo.png') }}" style="height: 65px; width: 120px;">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td>Sales Date</td>
                            <td>
                                {{ $order->sale_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Invoice No</td>
                            <td>
                                {{ $order->sale_no }}
                            </td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td>
                                {{ $order->customer->customer }}
                            </td>
                        </tr>
                        <tr>
                            <td> Address</td>
                            <td>
                                {{ $order->customer->address }}
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>
                                {{ $order->customer_mobile }}
                            </td>
                        </tr>
                    </table>

                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td>Brand Name</td>
                            <td>
                                {{ $order->sale_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td>
                                {{ $order->sale_no }}
                            </td>
                        </tr>
                        <tr>
                            <td>Chasis No</td>
                            <td>
                                {{ $order->customer->customer }}
                            </td>
                        </tr>
                      
                    </table>

                </div>
                <div>
                <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-white text-center">
                                <th scope="col">Sl</th>
                                <th>Date:</th>
                                <th scope="col">Sale No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Mobile</th>
                             
                            </tr>
                        </thead>
                        <tbody id="table-body">
                         <tr>
                            <td>#</td>
                            <td>{{ $order->sale_date }}</td>
                            <td>{{ $order->sale_no }}</td>
                            <td>{{ $order->customer_id }}</td>
                            <td>{{ $order->customer_address }}</td>
                            <td>{{ $order->customer_mobile }}</td>
                         </tr>
                        </tbody>
                    </table>
                    <div class="row mt-5">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="text-right">Grand Total</td>
                                    <td><span class="font-weight-bold" id="grand_total">{{ $order->grandTotal }}</span> TK
                                    </td>

                                </tr>

                            </table>

                        </div>
                    </div>

                    {{--<table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-white text-center">
                                <th scope="col">Sl</th>
                                <th scope="col">Die No</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size/Length</th>
                                <th scope="col">Thickness</th>    
                                <th scope="col">Qty</th>                              
                                <th scope="col">Rate</th>                              
                                <th scope="col">Value</th>                              
                            </tr>

                        </thead>
                        <tbody id="table-body">
                            @php
                                $total_qty = 0;
                                $total_value = 0;
                            @endphp
                            @foreach ($order->products as $key => $ord)
                                <tr class="text-center">
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ ($ord->product->die)??'' }}</td>
                                    <td>
                                        {{ ($ord->product->item_description)??'' }}
                                    </td>
                                    <td>{{ ($ord->color)??'' }}</td>
                                    <td>{{ ($ord->product->size)??'' }}</td>
                                    <td>{{ ($ord->product->thickness)??'' }}</td>
                                    <td class="text-center">
                                        @php
                                            $total_qty = $total_qty  + $ord->qty;
                                            $total_value = $total_value + ($ord->qty * $ord->rate);
                                        @endphp
                                        {{ $ord->qty }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ord->rate }}
                                    </td>
                                    <td>
                                        {{ $ord->qty * $ord->rate }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="text-center bg-dark text-white">
                                @php
                                $colspan = $order->order_type == 'Aluminium' ? 5 : 4;
                                $colspan = 5;
                                @endphp
                                <td colspan="{{$colspan}}" class="text-right">Total</td>
                                
                              
                                <td></td>
                                <td><span id="total_other_qty">{{$total_qty}}</span></td>
                                <td></td>
                                <td>
                                    <span id="total_other_rate">{{$total_value}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>--}}

                    {{-- <div class="row mt-5">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="text-right">Grand Total</td>
                                    <td><span class="font-weight-bold" id="grand_total">{{ $order->service_value }}</span>TK
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">Paid Amount</td>
                                    <td><span class="font-weight-bold" id="grand_total">{{ $order->paid_amount }}</span>TK
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">Due Amount</td>
                                    <td><span class="font-weight-bold" id="grand_total">{{ $order->due_amount }}</span>TK
                                    </td>
                                </tr>
                                @if ($order->order_type == 'Glass')
                                    <tr>
                                        <td class="text-right">Carrying Charge</td>
                                        <td>
                                            <span class="font-weight-bold" id="carrying_cost">
                                                {{ $order->carrying_charge }}
                                            </span>TK
                                        </td>
                                    </tr>
                                @endif 
                            </table>
                        </div>
                    </div>--}}
                 
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endpush
