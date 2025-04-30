@extends('layouts.backend.master')
@section('title', 'Stock List')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Stock List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body ">
                        <h4 class="card-title mb-3">Stock List</h4>
                        
                        <table class="table table-bordered" id="zero_configuration_table">
                            <thead class="bg-dark">
                                <tr class="text-white text-center">
                                    <th scope="col">Sl</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Colour</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($products as $key => $product)
                                    <tr class="text-center">
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <th>{{ $product->code }}</th>
                                        <td>{{ $product->category ? $product->category->category_name : 'N/A' }}</td>
                                        <td> {{ $product->product_name }}</td>
                                        <td> {{ $product['brand']['brand_name'] }}</td>
                                        <td> {{ $product->color }}</td>
                                        {{--<td> 
                                            @foreach ($product->purchaseDetails as $purchaseDetail)
                                                @php
                                                    $totalQtyPurchased = $purchaseDetail->qty;
                                                    $soldQty = $product->invoices->sum('qty');
                                                    $remainingQty = $totalQtyPurchased - $soldQty;
                                                @endphp
                                                {{ $remainingQty }}
                                            @endforeach
                                        </td>--}}
                                        <td>
                                            @php
                                                $totalQtyPurchased = 0;
                                            @endphp

                                            @foreach ($product->purchaseDetails as $purchaseDetail)
                                                @php
                                                    $totalQtyPurchased += $purchaseDetail->qty;
                                                @endphp
                                            @endforeach

                                            {{ $totalQtyPurchased }}
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
@endsection
@push('js')
    <script src="{{ asset('backend/dist-assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/dist-assets/js/scripts/datatables.script.min.js') }}"></script>
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
@endpush


