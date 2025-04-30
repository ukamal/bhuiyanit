@extends('layouts.backend.master')
@section('title', 'Customer Order List')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Customer Order List')
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
                                        <th>Order No</th>
                                        <th>Customer</th>
                                        <th>Total Amount</th>
                                        <th>Commission</th>
                                        <th>Receive Amount</th>
                                        <th>Advence</th>
                                        <th>Due</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $order->order_no }}</td>
                                            <td>{{ $order->customer->customer }}</td>
                                            <td>{{ $order->grandTotal }}</td>
                                            <td>{{ $order->customer_comm }}</td>
                                            @php
                                                $receive_amount=$order->grandTotal-$order->customer_comm;
                                            @endphp
                                            <td>{{$receive_amount}}</td>
                                            <td>{{ $order->customer_advence }}</td>
                                            <td>{{ $receive_amount-$order->customer_advence }}</td>
                                            <td><a href="{{ route('admin.order_details', $order->id) }}"
                                                    class="btn btn-primary">View</a></td>
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
