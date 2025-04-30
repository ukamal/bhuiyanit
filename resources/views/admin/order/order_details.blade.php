@extends('layouts.backend.master')
@section('title', 'Order Details')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Order Details')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Order Details</h4>
                        <form action="{{ route('admin.add.order.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Order No</td>
                                            <td>
                                                {{ $order->order_no }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>
                                                {{ $order->customer->customer }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Site Delivery Address</td>
                                            <td>
                                                {{ $order->customer_address }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>
                                                {{ $order->customer_mobile }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Date</td>
                                            <td>
                                                {{ $order->order_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Supplier Name</td>
                                            <td>
                                                {{ $order->supplier->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>
                                                {{ $order->supplier_address }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>
                                                {{ $order->supplier_mobile }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div>
                                @if ($order->order_type !== 'Glass')
                                    <table class="table table-bordered">
                                        <thead class="bg-dark">  
                                            <tr class="text-white text-center">
                                                <th scope="col">Sl</th>
                                                <th scope="col">Die No</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">unit</th>
                                                <th scope="col">Size/Thickness</th>
                                                @if ($order->order_type == 'Aluminium' || $order->order_type == '')
                                                    <th scope="col" colspan="3" class="text-center">Silver</th>
                                                    <th scope="col" colspan="3" class="text-center">Bronze</th>
                                                @endif
                                                @if($order->order_type !== 'Glass')
                                                    <th scope="col" colspan="3" class="text-center">SS</th>
                                                @endif
                                                <th scope="col" colspan="3" class="text-center">
                                                    Other
                                                    <p>{{ $order->other_text}}</p>
                                                </th>

                                            </tr>
                                            <tr class="bg-dark">
                                                <td colspan="5"></td>
                                                @if ($order->order_type == 'Aluminium' || $order->order_type == '')
                                                    <td class="text-white text-center">Rate</td>
                                                    <td class="text-white text-center">Qty</td>
                                                    <td class="text-white text-center">Total</td>

                                                    <td class="text-white text-center">Rate</td>
                                                    <td class="text-white text-center">Qty</td>
                                                    <td class="text-white text-center">Total</td>
                                                @endif
                                                @if($order->order_type !== 'Glass')
                                                    <td class="text-white text-center">Rate</td>
                                                    <td class="text-white text-center">Qty</td>
                                                    <td class="text-white text-center">Total</td>
                                                @endif

                                                <td class="text-white text-center">Rate</td>
                                                <td class="text-white text-center">Qty</td>
                                                <td class="text-white text-center">Total</td>


                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            @php
                                                $silver_qty = 0;
                                                $silver_total_rate = 0;
                                                $bronze_qty = 0;
                                                $bronze_total_rate = 0;
                                                $bronze_total_rate = 0;
                                                $ss_qty = 0;
                                                $sss_total_rate = 0;
                                                $other_qty = 0;
                                                $other_total_rate = 0;
                                            @endphp
                                            @foreach ($order->products as $key => $ord)
                                                <tr class="text-center">
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ ($ord->product->die)??'' }}</td>
                                                    <td>
                                                        {{ ($ord->product->item_description)??'' }}

                                                    </td>
                                                    <td>{{ ($ord->product->unit)??'' }}</td>
                                                    <td>
                                                        {{ ($ord->product->size)??'' }}
                                                        @if($order->order_type == 'Glass')
                                                            {{$ord->product->unit}}
                                                        @endif
                                                    </td>
                                                    @if ($order->order_type == 'Aluminium' || $order->order_type == '')
                                                        <td class="text-center">
                                                            {{ $ord->silver_rate }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $ord->silver_qty }}
                                                            @php
                                                                $silver_qty = $silver_qty + $ord->silver_qty;
                                                            @endphp
                                                        </td>
                                                        <td>
                                                            @php
                                                                $silver_total_rate = $silver_total_rate + $ord->silver_rate * $ord->silver_qty;
                                                            @endphp
                                                            {{ $ord->silver_rate * $ord->silver_qty }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $ord->bronze_rate }}

                                                        </td>
                                                        <td class="text-center">
                                                            @php
                                                                $bronze_qty = $bronze_qty + $ord->bronze_qty;
                                                                $bronze_total_rate = $bronze_total_rate + $ord->bronze_qty * $ord->bronze_rate;
                                                            @endphp
                                                            {{ $ord->bronze_qty }}
                                                        </td>
                                                        <td>
                                                            {{ $ord->bronze_qty * $ord->bronze_rate }}
                                                        </td>
                                                    @endif
                                                    @if($order->order_type !== 'Glass')
                                                        <td class="text-center">

                                                            {{ $ord->ss_rate }}

                                                        </td>
                                                        <td class="text-center">
                                                            @php
                                                                $ss_qty = $ss_qty + $ord->ss_qty;
                                                                $sss_total_rate = $sss_total_rate + $ord->ss_qty * $ord->ss_rate;
                                                            @endphp
                                                            {{ $ord->ss_qty }}
                                                        </td>
                                                        <td>
                                                            {{ $ord->ss_qty * $ord->ss_rate }}
                                                        </td>
                                                    @endif
                                                    <td class="text-center">
                                                        {{ $ord->other_rate }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $other_qty = $other_qty  + $ord->other_qty;
                                                            $other_total_rate = $other_total_rate + ($ord->other_qty * $ord->other_rate);
                                                        @endphp
                                                        {{ $ord->other_qty }}
                                                    </td>
                                                    <td>
                                                        @if($order->order_type == 'Glass')
                                                            {{ (float) ($ord->product->size) * (float) $ord->other_qty * (float) $ord->other_rate }}
                                                        @else
                                                            {{ $ord->other_qty * $ord->other_rate }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="text-center bg-dark text-white">
                                                <td colspan="5" class="text-right">Total</td>
                                                @if ($order->order_type == 'Aluminium' || $order->order_type == '')
                                                    <td></td>
                                                    <td><span id="total_silver_qty"></span>{{ $silver_qty }}</td>
                                                    <td>
                                                        <span id="total_silver_rate"></span>
                                                        {{ $silver_total_rate }}
                                                    </td>

                                                    <td></td>
                                                    <td><span id="total_bronze_qty">{{ $bronze_qty }}</span></td>
                                                    <td>
                                                        <span id="total_bronze_rate"></span>{{ $bronze_total_rate }}
                                                    </td>
                                                @endif
                                                
                                                @if($order->order_type !== 'Glass')
                                                    <td></td>
                                                    <td><span id="total_ss_qty">{{ $ss_qty }}</span></td>
                                                    <td>
                                                        <span id="total_ss_rate">{{ $sss_total_rate }}</span>

                                                    </td>
                                                @endif
                                                <td></td>
                                                <td><span id="total_other_qty">{{$other_qty}}</span></td>
                                                <td>
                                                    <span id="total_other_rate">{{$other_total_rate}}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table table-bordered">
                                        <thead class="bg-dark">  
                                            <tr class="text-white text-center">
                                                <th scope="col">Sl</th>
                                                <th scope="col">Type Of Glass</th>
                                                <th scope="col">Thikness</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Pcs</th>
                                                <th scope="col">Sft</th>
                                                <th scope="col">MT</th>
                                                <th scope="col">Rate</th>
                                                <th scope="col"> Ammount </th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                            @php
                                                $pcs = 0;
                                                $sft = 0;
                                                $mt = 0;
                                                $ammount = 0;
                                            @endphp
                                            @foreach ($order->products as $key => $ord)
                                                <tr class="text-center">
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>
                                                        {{ $order->products[$key]->product->item_description }}
                                                        {{-- <input class="form-control type_of_glass type_of_glass_1" type="text" name="type_of_glass[]" data-index="1">     --}}
                                                    </td>
                                                    <td>
                                                        {{ (explode('#', $order->products[$key]->product->color)[0])??'' }}
                                                        {{-- <input class="form-control thikness thikness_1" type="text" name="thikness[]" data-index="1"> --}}
                                                    </td>
                                                    <td class="d-flex">
                                                        @php
                                                            $size = (explode(' = ', $order->products[$key]->product->size)[0])??'';
                                                        @endphp
                                                        {{ (explode(' * ', $size)[0])??'' }} X {{ (explode(' * ', $size)[1])??'' }}
                                                    </td>
                                                    <td>
                                                        {{ $ord->other_qty}}
                                                        @php
                                                            $pcs += $ord->other_qty;
                                                        @endphp
                                                        {{-- <input class="form-control pcs pcs_1" type="text" name="pcs[]" data-index="1"> --}}
                                                    </td>
                                                        
                                                    <td class="text-center">
                                                        {{ $size = (explode(' = ', $order->products[$key]->product->size)[1])??''; }}
                                                        @php
                                                            $sft += (explode(' = ', $order->products[$key]->product->size)[1])??0;
                                                        @endphp
                                                        {{-- <input class="form-control sft sft_1" type="text" name="sft[]" readonly data-index="1"> --}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ (explode('#', $order->products[$key]->product->color)[1])??''; }}
                                                        @php
                                                            $mt += (explode('#', $order->products[$key]->product->color)[1])??0;
                                                        @endphp
                                                        {{-- <input class="form-control mt mt_1" type="text" name="mt[]" data-index="1"> --}}
                                                    </td>
                                                    <td>
                                                        {{ $ord->other_rate }}
                                                        {{-- <input class="form-control rate rate_1" type="text" name="rate[]" data-index="1"> --}}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $ord->other_rate*$ord->other_qty }}
                                                        @php
                                                            $ammount += ($ord->other_rate*$ord->other_qty);
                                                        @endphp
                                                        {{-- <input class="form-control ammount ammount_1" type="text" name="ammount[]" readonly data-index="1"> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="text-center bg-dark text-white">
                                                <td colspan="4" class="text-right">Total</td>
                                                <td><span>{{$pcs}}</span></td>
                                                <td> <span>{{ $sft }}</span> </td>
                                                <td> <span>{{ $mt }}</span> </td>
                                                <td></td>
                                                <td>
                                                    <span id="total_other_rate">{{$ammount}}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                                <div class="row mt-5">
                                    <div class="col-lg-9"></div>
                                    <div class="col-lg-3">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="text-right">Grand Total</td>
                                                <td><span class="font-weight-bold"
                                                        id="grand_total">{{ (float) $order->grandTotal }}</span>TK</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Supplier Commision &nbsp;
                                                        {{ (int) $order->supplier_com_percent }}%
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ (int) $order->supplier_comm }} TK
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Supplier Advance</div>
                                                </td>
                                                <td>
                                                    {{ (int) $order->supplier_advenced }} TK
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Carrying Charge</div>
                                                </td>
                                                <td>
                                                    {{ (int) $order->carrying_charge }} TK
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Customer Commision &nbsp;
                                                        {{ (int) $order->customer_com_percent }}%</div>
                                                </td>
                                                <td>{{ (int) $order->customer_comm }} TK</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Customer Advance</div>
                                                </td>
                                                <td>
                                                    {{ (int) $order->customer_advence }} TK
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend/dist-assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/dist-assets/js/scripts/datatables.script.min.js') }}"></script>
@endpush
