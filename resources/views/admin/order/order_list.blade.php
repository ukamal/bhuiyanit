@extends('layouts.backend.master')
@section('title', 'Contact Messaage')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Product Chart')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Order List</h4>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Order No</th>
                                        <th scope="col">Order Type</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Grand Total</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->order_type }}</td>
                                            <td>{{ $order->customer->customer }}</td>
                                            <td>{{ $order->supplier->name }}</td>
                                            <td>{{ $order->grandTotal}}</td>
                                            <td class="d-flex">
                                                <a href="{{route('admin.order_details',$order->id)}}" class="btn btn-primary mr-1">View</a>
                                                <a href="{{route('admin.order_challan_pdf',$order->id)}}" class="btn btn-primary mr-1">Challan</a>
                                                <a href="{{route('admin.order_pdf',$order->id)}}" class="btn btn-primary">Bill</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
