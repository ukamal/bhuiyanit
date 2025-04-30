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
                            <h2 class="h2 text-uppercase text-thin mar-no">{{ 'Mirroraa' }}</h2>
                            <div class="badge badge-dark" style="font-size: 16px;">Automated Car Wash & Servicing </div>
                            <p class="mt-3">{{ 'Agrabad Access Road,Agrabad, Chattogram,Bangladesh' }} </p>
                            <p class="mt-3">{{ 'Mobile: 01312-093389, Email: mahmudur175@gmail.com' }} </p>
                            <h4 class="h3 text-uppercase text-thin mar-no text-primary"><label
                                    class="label label-primary">{{ 'DETAILS' }}</label>
                            </h4>
                        </div>
                        <img src="{{ asset('logo.png') }}"
                            style="height: 65px; width: 120px; position: fixed; top: 35px; left: 35px;">
                    </div>
                </div>
                
                <table class="table table-bordered" style="width:30%">
                        <tbody><tr>
                            <td>Date:</td>
                            <td>
                            {{ $service_sale->invoice_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Service Sale No:</td>
                            <td>
                            {{ $service_sale->service_sale_no }}
                            </td>
                        </tr>
                        <tr>
                            <td>Customer Name:</td>
                            <td>
                            {{ $service_sale->customer->customer }}
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>
                            {{ $service_sale->mobile }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- <h5>Subject: {{ $order->subject }}</h5> --}}
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
                                $i = 0;
                            @endphp
                            {{-- @dd($service_sale); --}}
                                <tr class="text-center">
                                    <th scope="row">{{ $service_sale->id }}</th>
                                    <td>
                                        {{ $service_sale->item_dsc }}
                                    </td>
                                    <td>{{ $service_sale->unit }}</td>
                                    <td>{{ $service_sale->rate }}</td>
                                    {{-- @php
                                        // $totaRate = $totaRate + $ord->rate;
                                        $totalRate += (float)$service_sale->rate;
                                    @endphp --}}
                                </tr>
                            {{-- @endforeach --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-right">Total</td>
                                <td class="text-center"><span class="font-weight-bold"
                                        id="grand_total">{{($service_sale->total) }}</span>TK</td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <h5 class="mt-3">{{ $service_sale->dsc }}</h5> --}}
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
