@extends('layouts.backend.print_master')
@section('title', 'Challan Print')
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
    </style>
@endpush
@section('content')

    <div class="card mb-4">
        <div class="card text-left">
            <div class="card-body">
                {{-- <h4 class="card-title mb-3">Order Details</h4> --}}
                <div class="header_img mb-2">
                    {{-- <img src="{{asset('img/top_header_img.jpeg')}}" style="width: 100%;height:120px" alt=""> --}}

                    <div class="invoice-masthead" style="margin-bottom: 10px;position:relative;">
                        <div class="invoice-text" style="text-align:center; float:none">
                            <h2 class="h2 text-uppercase text-thin mar-no">{{ 'S.A THAI ALUMINIUM & GLASS HOUSE' }}</h2>
                            <h2 class="h2 text-uppercase text-thin mar-no">{{ 'এস. এ. থাই এ্যালুমিনিয়াম এন্ড গ্লাস হাউজ' }}</h2>
                            <div class="badge badge-dark" style="font-size: 16px;">All kinds of Aluminium, Glass, S.S. Pipes, S.S. Hardware Sellers & Fabricators </div>
                            <p class="mt-3">{{ 'শাহ আমানত সংযোগ সড়ক (কল্পোলক আবাসিকের উত্তর পার্শ্বে), লিজা গার্ডেনের দক্ষিণ পার্শ্বে, বাকলিয়া, চট্টগ্রাম।' }} </p>
                            <p class="mt-3">{{ 'Mobile: 01718-598973, 01811-687864, 01766-616129' }} </p>
                            <h4 class="h3 text-uppercase text-thin mar-no text-primary"><label
                                    class="label label-primary">{{ 'ORDER SHEET' }}</label>
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
                            <td>Order No</td>
                            <td>
                                {{ $order->order_no }}
                            </td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td>
                                {{ $order->customer->customer }}
                            </td>
                        </tr>
                        <tr>
                            <td>Site Delivery Address</td>
                            <td>
                                {{ $order->customer_address }}
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>
                                {{ $order->customer_mobile }}
                            </td>
                        </tr>
                    </table>

                    <h5 class="h5 text-uppercase mt-5"><label
                        class="label label-primary">{{ 'COMPANY PROFILE' }} : <span style="color: green">{{$order->company_profile ?? ''}}</span></label>
                    </h5>

                    
                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td>Date</td>
                            <td>
                                {{ $order->order_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Supplier Name</td>
                            <td>
                                {{ $order->supplier->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                {{ $order->supplier_address }}
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>
                                {{ $order->supplier_mobile }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    @if ($order->order_type !== 'Glass')
                        <table class="table table-bordered">
                            <thead class="bg-dark">
                                <tr class="text-white text-center">
                                    <th scope="col">Sl</th>
                                    <th scope="col">Die No</th>
                                    <th scope="col">Item Name</th>
                                    @if ($order->order_type == 'Aluminium')
                                        <th scope="col">Color</th>
                                    @endif
                                    <th scope="col">Size/Length</th>
                                    <th scope="col">Thickness</th>
                                    
                                    <th scope="col">Qty</th>

                                </tr>
  
                            </thead>
                            <tbody id="table-body">
                                @php
                                    $total_qty = 0;
                                @endphp
                                @foreach ($order->products as $key => $ord)
                                    <tr class="text-center">
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ ($ord->product->die)??'' }}</td>
                                        <td>
                                            {{ ($ord->product->item_description)??'' }}
                                        </td>
                                        @if ($order->order_type == 'Aluminium')
                                            <td>{{ ($ord->color)??'' }}</td>
                                        @endif

                                        <td>{{ ($ord->product->size)??'' }}</td>
                                        <td>{{ ($ord->product->thickness)??'' }}</td>

                                                       
                                        <td class="text-center">
                                            {{ $ord->qty }}
                                            @php
                                                $total_qty = $total_qty + $ord->qty;
                                            @endphp
                                        </td>
       
                                    </tr>
                                @endforeach

                                <tr class="text-center bg-dark text-white">
                                    @php
                                    $colspan = $order->order_type == 'Aluminium' ? 5 : 4;
                                    @endphp
                                    <td colspan="{{$colspan}}" class="text-right">Total</td>
   
                                    <td></td>
                                    <td><span id="total_other_qty">{{$total_qty}}</span></td>
                              
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered">
                            <thead class="bg-dark">  
                                <tr class="text-white text-center">
                                    <th scope="col">Sl</th>
                                    <th scope="col">Type Of Glass</th>
                                    <th scope="col">Thikness</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Pcs</th>
                                    <th scope="col">Sft</th>
                                    <th scope="col">MT</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col"> Ammount </th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @php
                                    $pcs = 0;
                                    $sft = 0;
                                    $mt = 0;
                                    $ammount = 0;
                                @endphp
                                @foreach ($order->products as $key => $ord)
                                    <tr class="text-center">
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            {{ $order->products[$key]->product->item_description }}
                                            {{-- <input class="form-control type_of_glass type_of_glass_1" type="text" name="type_of_glass[]" data-index="1">     --}}
                                        </td>
                                        <td>
                                            {{ (explode('#', $order->products[$key]->product->color)[0])??'' }}
                                            {{-- <input class="form-control thikness thikness_1" type="text" name="thikness[]" data-index="1"> --}}
                                        </td>
                                        <td class="d-flex">
                                            @php
                                                $size = (explode(' = ', $order->products[$key]->product->size)[0])??'';
                                            @endphp
                                            {{ (explode(' * ', $size)[0])??'' }} X {{ (explode(' * ', $size)[1])??'' }}
                                        </td>
                                        <td>
                                            {{ $ord->other_qty}}
                                            @php
                                                $pcs += $ord->other_qty;
                                            @endphp
                                            {{-- <input class="form-control pcs pcs_1" type="text" name="pcs[]" data-index="1"> --}}
                                        </td>
                                            
                                        <td class="text-center">
                                            {{ $size = (explode(' = ', $order->products[$key]->product->size)[1])??''; }}
                                            @php
                                                $sft += (explode(' = ', $order->products[$key]->product->size)[1])??0;
                                            @endphp
                                            {{-- <input class="form-control sft sft_1" type="text" name="sft[]" readonly data-index="1"> --}}
                                        </td>
                                        <td class="text-center">
                                            {{ (explode('#', $order->products[$key]->product->color)[1])??''; }}
                                            @php
                                                $mt += (explode('#', $order->products[$key]->product->color)[1])??0;
                                            @endphp
                                            {{-- <input class="form-control mt mt_1" type="text" name="mt[]" data-index="1"> --}}
                                        </td>
                                        <td>
                                            {{ $ord->other_rate }}
                                            {{-- <input class="form-control rate rate_1" type="text" name="rate[]" data-index="1"> --}}
                                        </td>

                                        <td class="text-center">
                                            {{ $ord->other_rate*$ord->other_qty }}
                                            @php
                                                $ammount += ($ord->other_rate*$ord->other_qty);
                                            @endphp
                                            {{-- <input class="form-control ammount ammount_1" type="text" name="ammount[]" readonly data-index="1"> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="text-center bg-dark text-white">
                                    <td colspan="4" class="text-right">Total</td>
                                    <td><span>{{$pcs}}</span></td>
                                    <td> <span>{{ $sft }}</span> </td>
                                    <td> <span>{{ $mt }}</span> </td>
                                    <td></td>
                                    <td>
                                        <span id="total_other_rate">{{$ammount}}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    {{-- <div class="row mt-5">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="text-right">Grand Total</td>
                                    <td><span class="font-weight-bold" id="grand_total">{{ $order->grandTotal }}</span>TK
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div> --}}
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
