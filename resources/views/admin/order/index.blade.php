@extends('layouts.backend.master')
@section('title', 'Add New Aluminium Order')
@section('page_title', 'Add New Aluminium Order')
@section('content')
    <div class="row" id="add_new_order">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Add New Order</h4>
                        <form action="{{route('admin.add.order.store')}}" method="POST" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <select-customer type="{{$_GET['type']}}"></select-customer>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="mb-2">Company Profile</h5>
                                    <input type="text" class="form-control mb-2" name="company_profile" placeholder="EX: ALCO">
                                    <input type="hidden" name="order_type" value="{{$_GET['type']}}">
                                </div>
                                <div class="col-lg-4">
                                    <select-supplier></select-supplier>
                                </div>
                            </div>
                            <div id="">
                                {{ $_GET['type']}}
                                <add-new-order type="{{ $_GET['type']}}" ></add-new-order>                                
                            </div>

                            <button type="submit" class="btn btn-primary float-right mr-5">Confirm Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('vue-js')
<script src="{{ asset('js/pages/AddNewOrder.js') }}"></script>
@endpush