@extends('layouts.backend.master')
@section('title', 'Receive Report')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Receive Payment Report')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title mb-3">Receive Payment Report</h4>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ url('admin/customer/recieve/report')}}" method="get" class="form-group d-flex">
                                    <select name="customer" id="" class="form-control">
                                        <option value="0">Search By Customer</option>
                                        @foreach( $customer as $key => $cus)
                                            <option @if($cus->id == $selectedCus) {{'selected'}} @endif value="{{$cus->id}}">{{ $cus->customer}}</option> 
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="search" placeholder="Search..">
                                    <button class="btn btn-info">Filter</button>
                                    <a href="{{ url('admin/customer/recieve/report')}}" class="btn btn-primary">Clear</a>
                                </form>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Grand Total</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Receive</th>
                                        <th scope="col">Blanced</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totaDue = 0;
                                        $totalReceive = 0;
                                        $totalBlance = 0;
                                    @endphp
                                    @foreach ($invoices as $key => $invoice)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ date('d-m-y', strtotime($invoice->created_at)) }}</td>
                                            <td>{{$invoice->invoice_no}}</td>
                                            <td>{{ ($invoice->customer->customer)??'' }}</td>
                                            <td>{{ $invoice->grandTotal }}</td>
                                            <td>
                                                @php
                                                    $due = 0;
                                                    $receive = 0;
                                                @endphp
                                                @if ($invoice->type == 'sale' || $invoice->type == 'order')
                                                    @php
                                                        $grandTotal = $invoice->grandTotal - $invoice->customer_comm;
                                                        $due = $grandTotal - $invoice->customer_comm;
                                                        $totaDue = $totaDue + $due;
                                                    @endphp
                                                @else
                                                    @php
                                                        $receive = $invoice->grandTotal;
                                                        $totalReceive = $totalReceive+ $receive;
                                                    @endphp
                                                @endif
                                                {{ $due }}
                                            </td>
                                            <td>
                                                {{ $receive }}
                                            </td>
                                            <td>{{ $totaDue - $totalReceive }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('receive_report_print',$invoice->id)}}">Print</a>
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
