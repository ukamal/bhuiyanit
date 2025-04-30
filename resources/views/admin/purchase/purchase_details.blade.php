@extends('layouts.backend.master')
@section('title', 'Purchase Details')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Purchase Details')
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="card mb-4">
        <div class="card text-left">
            <div class="card-body">
             
                <div class="d-flex justify-content-between">
                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td>Purchase Date</td>
                            <td>
                                {{ $order->purchase_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Invoice No</td>
                            <td>
                                {{ $order->purchase_no }}
                            </td>
                        </tr>
                        <tr>
                            <td>Supplier Name</td>
                            <td>
                                {{ $order['supplier']['name'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Supplier Mobile</td>
                            <td>
                                {{ $order->supplier_mobile }}
                            </td>
                        </tr>
                    </table>
                    <h3><a href="{{ route('purchase_sale_list') }}">Back</a></h3>
                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td>Brand Name</td>
                            <td>
                                {{ $order->brand_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td>
                                {{ $order->model }}
                            </td>
                        </tr>
                        <tr> 
                            <td>Chasis No</td>
                            <td>
                                {{ $order->chasis_no }}
                            </td>
                        </tr>
                       
                    </table>
                       
                </div>
              
                <div>
                    <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-white text-center">
                                <th scope="col">Sl</th>
                                <th scope="col">Items Name</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size/Length</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Rate</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        @foreach($details as $detail)
                            <tr>
                                <td>#</td>
                                <td>{{ $detail['product']['item_description'] }}</td>
                                <td>{{ $detail['product']['color'] }}</td>
                                <td>{{ $detail->size_no }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>{{ $detail->rate }}</td>
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
                                    <td><span class="font-weight-bold">{{ $order->grandTotal }}</span> TK
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">Paid Amount</td>
                                    <td><span class="font-weight-bold">{{ $order->paid_amount }}</span> TK
                                    </td>
                                </tr>
                                <tr>

                                <td class="text-right">Due Amount</td>
                                    <td><span class="font-weight-bold">{{ $order->due_amount }}</span> TK
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
  </div>
@endsection
@push('js')
    <script src="{{ asset('backend/dist-assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/dist-assets/js/scripts/datatables.script.min.js') }}"></script>
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
@endpush

