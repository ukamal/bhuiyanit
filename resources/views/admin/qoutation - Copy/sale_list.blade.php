@extends('layouts.backend.master')
@section('title', 'Qoutation List')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Qoutation List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Qoutation List</h4>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Qoutation No</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Grand Total</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $key => $order)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $order->sale_date }}</td>
                                            <td>{{ $order->qoutation_no }}</td>
                                            <td>{{ $order->customer->customer }}</td>
                                            <td>{{ $order->grandTotal}}</td>
                                            <td><a href="{{route('admin.qoutation_details',$order->id)}}" class="btn btn-primary">View</a>
                                            <a href="{{route('admin.qoutation_details_print',$order->id)}}" class="btn btn-primary">PDF</a></td>
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
