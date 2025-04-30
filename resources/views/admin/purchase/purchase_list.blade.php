@extends('layouts.backend.master')
@section('title', 'Purchase List')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Purchase List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Purchase List</h4>
                        <div>
                            <table class="table" id="zero_configuration_table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Purchase No</th>
                                        <th scope="col">Supplier Name</th>
                                        <th scope="col">Grand Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($purchases as $key => $item)
                                      <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->purchase_date }}</td>
                                        <td>{{ $item->purchase_no}}</td>
                                        <td>{{ $item['supplier']['name']}}</td>
                                        <td>{{ $item->grandTotal}}</td>
                                        <td>
                                            <a href="{{ route('purchase_details',$item->id)}}" class="btn btn-primary">View</a>
                                            <a href="{{route('purchase_pdf',$item->id)}}" class="btn btn-success">Bill Print</a>
                                            <a href="{{route('remove_purchase',$item->id)}}" class="btn btn-danger">X</a>
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
