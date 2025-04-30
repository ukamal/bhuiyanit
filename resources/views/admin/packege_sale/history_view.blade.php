@extends('layouts.backend.master')
@section('title', 'Package Sale History')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Package Sale History')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Search...</h4>
                        <div>
                            <table class="table" id="zero_configuration_table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scop="col">SL:</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Name</th>
                                        <th scop="col">Mobile</th>
                                        <th scop="col">Package</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $item->invoice_no }}</td>
                                            <td>{{ $item['customer']['customer'] }}</td>
                                            <td>{{ $item['customer']['phone'] }}</td>
                                            <td> {{ $item->package->packege_name }} </td>
                                            <td>
                                                <a href="{{ route('admin_package_sale_details',$item->id) }}" class="btn btn-primary">View</a>
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
