@extends('layouts.backend.master')
@section('title', 'Service Sale List')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Service Sale List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Service Sale List</h4>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Invoice Date</th>
                                        <th scope="col">Service Sale No</th>
                                        <th scope="col">Customer</th>
                                        {{--<th scope="col">Brand Name</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">chasis No</th>--}}
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Item Dsc</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Grand Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service_sale as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $item->invoice_date }}</td>
                                            <td>{{ $item->service_sale_no }}</td>
                                            <td>{{ $item->customer->customer }}</td>
                                            {{--<td>{{ $item->brand_name}}</td>
                                            <td>{{ $item->model}}</td>
                                            <td>{{ $item->chasis_no}}</td>--}}
                                            <td>{{ $item->mobile}}</td>
                                            <td>{{ $item->item_dsc}}</td>
                                            <td>{{ $item->unit}}</td>
                                            <td>{{ $item->rate}}</td>
                                            <td>{{ $item->total}}</td>
                                            <td>{{ $item->grand_total}}</td>
                                            <td class="d-flex">
                                            <a href="{{route('admin.service_sales.details',$item->id)}}" class="btn btn-primary">View</a>
                                            <a href="{{route('admin.service_sales_pdf',$item->id)}}" class="btn btn-success">PDF</a>
                                            <a href="{{route('service_sale_remove',$item->id)}}" class="btn btn-danger">X</a>
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
