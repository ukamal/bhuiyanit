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
    </style>
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card text-left">
            <div class="card-body">
             
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
                    <table>
                        <tr>
                              <td>
                                    <a href="{{ route('admin.sales.list') }}">Back</a>
                              </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-white text-center">
                                <th scope="col">Sl</th>
                                <th>Product Name</th>
                                <th scope="col">Sale</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach ($products as $key => $item)
                                <tr class="text-center">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item['product']['item_description'] }}</td>
                                    <td>{{ $item->sale_id }}</td>
                                    <td>{{ $item['product']['color'] }}</td>
                                    <td>{{ $item->size_no }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->rate }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>
                                          <a href="" class="btn btn-info btn-sm">Sale Return</a>
                                    </td>
                                </tr>
                            @endforeach
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
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

@endpush
