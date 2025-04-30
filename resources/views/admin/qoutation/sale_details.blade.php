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
        .final_address{
                height: 200px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                margin-top: 150px
            }
    </style>
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card text-left">
            <div class="card-body">
                <div class="header_img mb-2">
                    {{-- <img src="{{ asset('img/top_header_img.jpeg') }}" style="width: 100%;height:120px" alt=""> --}}

                    <div class="invoice-masthead" style="margin-bottom: 10px;">
                        <div class="invoice-text" style="text-align:center; float:none">
                            <h2 class="h2 text-uppercase text-thin mar-no text-primary">{{ 'S.A THAI ALUMINIUM & GLASS HOUSE' }}</h2>
                            <h2 class="h2 text-uppercase text-thin mar-no text-primary">{{ 'এস. এ. থাই এ্যালুমিনিয়াম এন্ড গ্লাস হাউজ' }}</h2>
                            <div class="badge badge-success" style="font-size: 16px">All kinds of Aluminium, Glass, S.S. Pipes, S.S. Hardware Sellers & Fabricators </div>
                            <p class="mt-3">{{ 'শাহ আমানত সংযোগ সড়ক (কল্লোল আবাসিকের উত্তর পার্শ্বে), লিজা গার্ডেনের দক্ষিণ পার্শ্বে, বাকলিয়া, চট্টগ্রাম।' }} </p>
                            <p class="mt-3">{{ 'Mobile: 01718-598973, 01811-687864, 01766-616129' }} </p>
                            <h4 class="h3 text-uppercase text-thin mar-no text-primary"><label
                                    class="label label-primary">{{ 'INVOICE' }}</label>
                            </h4>
                        </div>
                        <img src="{{ asset('logo.png') }}"
                            style="height: 65px; width: 120px; position: fixed; top: 35px; left: 35px;">
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <h5>Date: {{ $order->sale_date }}</h5>
                        <h5>Qoutation No: {{ $order->qoutation_no }}</h5>
                        <h5>Customer Name: {{ $order->customer->customer }}</h5>
                        <h5>Site Delivery Address: {{ $order->customer_address }}</h5>
                    </div>
                </div>
                <h5>Subject: {{ $order->subject }}</h5>
                <div>
                    <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-white text-center">
                                <th scope="col">Sl</th>
                                <th scope="col">Description</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Rate</th>

                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @php
                                $totaRate = 0;
                            @endphp
                            @foreach ($order->products as $key => $ord)
                                <tr class="text-center">
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>
                                        {{ $ord->item_dsc }}
                                    </td>
                                    <td>{{ $ord->unit }}</td>
                                    <td>{{ $ord->rate }}</td>
                                    @php
                                        $totaRate = $totaRate + $ord->rate;
                                    @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right">Total</td>
                                <td class="text-center"><span class="font-weight-bold"
                                        id="grand_total">{{ $totaRate }}</span>TK</td>
                            </tr>
                        </tbody>
                    </table>
                    <h5 class="mt-3">{{ $order->dsc }}</h5>
                </div>

                <div class="final_address">
                    <h5 class="mb-3">Thanking You</h5>
                    <div>
                        <h5>SA Thai & Steel Design</h5>
                        <h5>Kalamia Bazar, Main Road, Chittagong</h5>
                        <h5>Contact Us-01811687864</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    
@endpush
