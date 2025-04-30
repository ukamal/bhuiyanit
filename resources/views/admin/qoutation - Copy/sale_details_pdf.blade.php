@extends('layouts.backend.print_master')
@section('title', 'Qoutation Pdf')
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
                <div class="header_img mb-2">
                    <img src="{{asset('img/top_header_img.jpeg')}}" style="width: 100%;height:120px" alt="">
                </div>
                <div class="d-flex justify-content-between">
                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td>Qoutation Date</td>
                            <td>
                                {{ $order->sale_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Qoutation No</td>
                            <td>
                                {{ $order->qoutation_no }}
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

                </div>
                <div>
                    <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-white text-center">
                                <th scope="col">Sl</th>
                                <th scope="col">Die No</th>
                                <th scope="col">Description</th>
                                <th scope="col">unit</th>
                                <th scope="col">Size/Thickness</th>
                                <th scope="col" colspan="3" class="text-center">Silver</th>
                                <th scope="col" colspan="3" class="text-center">Bronze</th>
                                <th scope="col" colspan="3" class="text-center">SS</th>
                                <th scope="col" colspan="3" class="text-center">Other</th>

                            </tr>
                            <tr class="bg-dark">
                                <td colspan="5"></td>
                                <td class="text-white text-center">Rate</td>
                                <td class="text-white text-center">Qty</td>
                                <td class="text-white text-center">Total</td>

                                <td class="text-white text-center">Rate</td>
                                <td class="text-white text-center">Qty</td>
                                <td class="text-white text-center">Total</td>

                                <td class="text-white text-center">Rate</td>
                                <td class="text-white text-center">Qty</td>
                                <td class="text-white text-center">Total</td>

                                <td class="text-white text-center">Rate</td>
                                <td class="text-white text-center">Qty</td>
                                <td class="text-white text-center">Total</td>


                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @php
                                $silver_qty = 0;
                                $silver_total_rate = 0;
                                $bronze_qty = 0;
                                $bronze_total_rate = 0;
                                $bronze_total_rate = 0;
                                $ss_qty = 0;
                                $sss_total_rate = 0;
                                $other_qty = 0;
                                $other_total_rate = 0;
                            @endphp
                            @foreach ($order->products as $key => $ord)
                                <tr class="text-center">
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $ord->product->die }}</td>
                                    <td>
                                        {{ $ord->product->item_description }}

                                    </td>
                                    <td>{{ $ord->product->unit }}</td>
                                    <td>{{ $ord->product->size }}</td>

                                    <td class="text-center">
                                        {{ $ord->silver_rate }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ord->silver_qty }}
                                        @php
                                            $silver_qty = $silver_qty + $ord->silver_qty;
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                            $silver_total_rate = $silver_total_rate + $ord->silver_rate * $ord->silver_qty;
                                        @endphp
                                        {{ $ord->silver_rate * $ord->silver_qty }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ord->bronze_rate }}

                                    </td>
                                    <td class="text-center">
                                        @php
                                            $bronze_qty = $bronze_qty + $ord->bronze_qty;
                                            $bronze_total_rate = $bronze_total_rate + $ord->bronze_qty * $ord->bronze_rate;
                                        @endphp
                                        {{ $ord->bronze_qty }}
                                    </td>
                                    <td>
                                        {{ $ord->bronze_qty * $ord->bronze_rate }}
                                    </td>
                                    <td class="text-center">

                                        {{ $ord->ss_rate }}

                                    </td>
                                    <td class="text-center">
                                        @php
                                            $ss_qty = $ss_qty + $ord->ss_qty;
                                            $sss_total_rate = $sss_total_rate + $ord->ss_qty * $ord->ss_rate;
                                        @endphp
                                        {{ $ord->ss_qty }}
                                    </td>
                                    <td>
                                        {{ $ord->ss_qty * $ord->ss_rate }}
                                    </td>
                                    <td class="text-center">
                                        {{ $ord->other_rate }}


                                    </td>
                                    <td class="text-center">
                                        @php
                                            $other_qty = $other_qty  + $ord->other_qty;
                                            $other_total_rate = $other_total_rate + ($ord->other_qty * $ord->other_rate);
                                        @endphp
                                        {{ $ord->other_qty }}
                                    </td>
                                    <td>

                                        {{ $ord->other_qty * $ord->other_rate }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="text-center bg-dark text-white">
                                <td colspan="5" class="text-right">Total</td>
                                <td></td>
                                <td><span id="total_silver_qty"></span>{{ $silver_qty }}</td>
                                <td>
                                    <span id="total_silver_rate"></span>
                                    {{ $silver_total_rate }}
                                </td>

                                <td></td>
                                <td><span id="total_bronze_qty">{{ $bronze_qty }}</span></td>
                                <td>
                                    <span id="total_bronze_rate"></span>{{ $bronze_total_rate }}
                                </td>
                                <td></td>
                                <td><span id="total_ss_qty">{{ $ss_qty }}</span></td>
                                <td>
                                    <span id="total_ss_rate">{{ $sss_total_rate }}</span>

                                </td>
                                <td></td>
                                <td><span id="total_other_qty">{{$other_qty}}</span></td>
                                <td>
                                    <span id="total_other_rate">{{$other_total_rate}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mt-5">
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
                    </div>
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
