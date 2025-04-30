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
                                    <!-- <th scope="col">Die No</th> -->
                                    <th scope="col">Items</th>
                                    <th scope="col">unit</th>
                                    <th scope="col">Size/Lenght</th>
                                    <!-- <th scope="col" class="text-center">Silver</th>
                                    <th scope="col" class="text-center">Bronze</th>
                                    <th scope="col" class="text-center">SS</th>
                                    <th scope="col" class="text-center">Other</th> -->

                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($products as $key => $product)
                                    <tr class="text-center">
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <!-- <td>{{ $product->die }}</td> -->
                                        <td> {{ $product->item_description }}</td>
                                        <td> {{ $product->unit }}</td>
                                        <td> {{ $product->size }}</td>
                                        <!-- <td> {{ $product->stock->sum('silver_qty') }}</td>
                                        <td> {{ $product->stock->sum('bronze_qty') }}</td>
                                        <td> {{ $product->stock->sum('ss_qty') }}</td>
                                        <td> {{ $product->stock->sum('other_qty') }}</td> -->
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


