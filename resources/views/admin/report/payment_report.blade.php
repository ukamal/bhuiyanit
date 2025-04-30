@extends('layouts.backend.master')
@section('title', 'Payment Report')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('page_title', 'Supplier Payment Report')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="my-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="card-title mb-3">Supplier Payment Report</h4>
                                </div>
                                <div class="col-md-8">
                                    <form action="{{url('/admin/payment/report')}}" method="get" class="form-group d-flex">
                                        {{--<select name="customer" id="" class="form-control">
                                            <option value="0">Search By Customer</option>
                                            @foreach( $customer as $key => $cus)
                                                <option @if(isset($selectedCus) && $selectedCus == $cus->id) {{ 'selected' }} @endif value="{{$cus->id}}">{{ $cus->customer}}</option> 
                                            @endforeach
                                        </select>--}}
                                        <select name="supplier" id="" class="form-control">
                                            <option value="0">Search By Supplier</option>
                                            @foreach( $supplier as $key => $cus)
                                                <option @if(isset($selectedSup) && $cus->id == $selectedSup) {{'selected'}} @endif value="{{$cus->id}}">{{ $cus->name}}</option> 
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="search" placeholder="Search.." value="{{ ($search)??'' }}">
                                        <button class="btn btn-info">Filter</button>
                                        <a href="{{url('/admin/payment/report')}}" class="btn btn-primary">Clear</a>
                                    </form>
                                    {{--<button type="button" class="btn btn-info float-right" data-toggle="modal" 
                                    data-target="#additional_commission">Additional Commission</button>--}}
                                </div>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        {{--<th scope="col">Order No</th>--}}
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Grand Total</th>
                                        {{--<th scope="col">Carrying Charge</th>
                                        <th scope="col">Supplier Commission</th>--}}
                                        <th scope="col">Advance</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Blanced</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totaDue = 0;
                                        $totalPayment = 0;
                                        $totalBlance = 0;
                                    @endphp
                                    @foreach ($invoices as $key => $invoice)

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ date('d-m-y', strtotime($invoice->created_at)) }}</td>
                                            {{--<td>{{$invoice->order?$invoice->order->order_no:''}}</td>--}}
                                            <td>{{ ($invoice->supplier->name)??'' }}</td>
                                            <td>{{ $invoice->grandTotal }}</td>
                                            {{--<td>{{ $invoice->carrying_charge }}</td>
                                            <td>{{ intval($invoice->supplier_com_percent) }}% / {{ floatval($invoice->supplier_comm) }}</td>--}}
                                            <td>{{ $invoice->supplier_advenced }}</td>
                                            <td>
                                                @php
                                                    $due = 0;
                                                    $payment = 0;
                                                @endphp
                                                @if ($invoice->type == 'sale' || $invoice->type == 'order')
                                                    @php
                                                        $grandTotal = $invoice->grandTotal - $invoice->supplier_comm;
                                                        $due = $grandTotal - $invoice->supplier_advenced;
                                                        $totaDue = $totaDue + $due;
                                                    @endphp
                                                @else
                                                    @php
                                                        $payment = $invoice->grandTotal;
                                                        $totalPayment = $totalPayment+ $payment;
                                                    @endphp
                                                @endif
                                                {{ $due }}
                                            </td>
                                            <td>
                                                {{ $payment }}

                                            </td>
                                            <td>{{ $totaDue - $totalPayment }}</td>
                                            <td>
                                                <a href="{{ route('supplier_payment_report_pdf',$invoice->id) }}" class="btn btn-primary">Print</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="modal fade" id="additional_commission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Additional Commission</h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{url('admin/payment/report/additionComm')}}" method="POST">
                                        {{-- @method('PUT') --}}
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Order Id</label>
                                                <!--<input type="text" required
                                                    class="form-control" value="" name="name"
                                                    id="name" aria-describedby="emailHelp"
                                                    placeholder="">-->
                                                <select class="form-control select product_id" name="product">
                                                    <option >Select</option>
                                                    @foreach ($invoices as $key => $invoice)
                                                    <option value="{{ $invoice->id }}">
                                                        {{$invoice->id}}
                                                        @if ($invoice->order)
                                                            {{ ' - '.(($invoice->order->order_no)??'') }}
                                                        @endif
                                                        @if ($invoice->supplier)
                                                            {{ ' - '.(($invoice->supplier->name)??'') }}</option>
                                                        @endif
                                                        {{-- @if($invoice->order && $invoice->order->order_no != 0)
                                                        @endif --}}
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="name">Percentage</label>
                                                <input type="text" required
                                                    class="form-control" value="" name="percantage"
                                                    id="name" aria-describedby="emailHelp"
                                                    placeholder="">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  --}}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
@endpush
