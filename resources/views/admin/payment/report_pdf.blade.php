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
        tbody#table-body {
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <div class="card mb-4" style="width:80%;margin:0 auto">
        <div class="card text-left">
            <div class="card-body">
                <div class="header_img mb-2">
                    {{-- <img src="{{asset('img/top_header_img.jpeg')}}" style="width: 100%;height:120px" alt=""> --}}
                    <div class="invoice-masthead" style="margin-bottom: 10px;position:relative;">
                    <div class="invoice-text" style="text-align:center; float:none">
                            <h4 class=" text-uppercase text-thin mar-no">{{ ' Bhuiyan Technologies & Solutions.' }}</h4>
                            <div class="badge badge-dark" style="font-size: 16px;">Your Trusted ICT Partner </div>
                            <p class="mt-3">Location: Shop # A-5, (Ground Floor Computer Market) Wali Khan Bhaban, <br>
                            South side of Robi Sheba. 603 Sekh Mujib Road, <br> Chowmuhuni Circle, Agrabad - Chattogram. 
                            <br>
                            Mobile:02334419698, 01601240791.
                            <br>
                            Email:btech.solutions0320@gmail.com.
                            </p>
                            <h4 class="h3 text-uppercase text-thin mar-no text-primary"><label
                                    class="label label-primary">{{ 'INVOICE' }}</label>
                            </h4>
                        </div>

                        <div style="position:absolute;top:20px;">
                            <img src="{{ asset('logo.png') }}" style="height: 65px; width: 120px;">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td> Name</td>
                            <td>{{$recive_payment->customer->customer}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{$recive_payment->customer->phone}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$recive_payment->customer->address}}</td>
                        </tr>
                    </table>

                    <table class="table table-bordered" style="width:30%">
                        <tr>
                            <td>Date</td>
                            <td>{{ \Carbon\Carbon::parse($recive_payment->date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                              <td>Email</td>
                              <td>{{ $recive_payment->customer->email }}</td>
                        </tr>
                       
                    </table>
                       
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead class="bg-dark">
                            <tr class="text-white text-center">
                                <th scope="col">Sl</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        
                        <tr>
                              <td>#</td>
                              <td>{{ $recive_payment->receivPayment->description }}</td>
                              <td>{{ $recive_payment->receivPayment->receive_amount }}</td>
                        </tr>

                        </tbody>

                        {{--<tfoot>
                            <tr>
                                <td class="text-right" colspan="5">Grand Total</td>
                                <td colspan="5" class="text-center"><span class="font-weight-bold">{{ $customers->grandTotal }}</span> TK
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="5">Paid Amount</td>
                                <td colspan="5" class="text-center"><span class="font-weight-bold">{{ $customers->paid_amount }}</span> TK
                                </td>
                            </tr>
                            <tr>

                            <td class="text-right" colspan="5">Due Amount</td>
                                <td colspan="5" class="text-center"><span class="font-weight-bold">{{ $customers->due_amount }}</span> TK
                                </td>
                            </tr>
                        </tfoot>--}}
                    </table>
                 
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endpush
