@extends('layouts.backend.master')
@section('title', 'Add new Stock')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Add Order Stock')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="ml-3 mb-3">
                <h4 class="card-title mb-3">Add Glass Order Stock</h4>
                <form action="{{ route('admin.search.glass.stock') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order No</label>
                                <input type="text" class="form-control" name="glass_order_no"
                                    aria-describedby="emailHelp" placeholder="Glass Order No">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div> 
                </form>
            </div>


            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Add Order Stock</h4>
                        <form action="{{ route('admin.add.stock.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Order No</label>
                                        <input type="text" class="form-control" id="order_no"
                                            aria-describedby="emailHelp" placeholder="Order No">
                                    </div>
                                    <button type="button" class="btn btn-primary mb-3" onclick="orderNo()">Search</button>
                                </div>
                            </div>

                            <div class="order_table_box">


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
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
        let grandTotalSilver = 0;
        let grandTotalBronze = 0;
        let grandTotalSS = 0;
        let grandTotalOther = 0;

        function silver_qty(id) {
            const silver_rate = $('#silver_rate' + id).val();
            const silver_qty = $('#silver_qty' + id).val();
            const total = Number(silver_rate) * Number(silver_qty);
            $('#total_qty' + id).text(total);
            total_silver_qty_rate_calculate();
            grandTotalTK();
        }

        function bronzeQty(id) {
            const bronze_rate = $('#bronze_rate' + id).val();
            const bronze_qty = $('#bronze_qty' + id).val();
            const total = Number(bronze_rate) * Number(bronze_qty);
            $('#bronze_total_qty' + id).text(total);
            total_bronze_qty_rate_calculate();
            grandTotalTK();
        }

        function ssQty(id) {
            const rate = $('#ss_rate' + id).val();
            const qty = $('#ss_qty' + id).val();
            const total = Number(rate) * Number(qty);
            $('#ss_total_qty' + id).text(total);
            total_ss_qty_rate_calculate();
            grandTotalTK();
        }

        function otherQty(id) {
            const rate = $('#other_rate' + id).val();
            const qty = $('#other_qty' + id).val();
            const total = Number(rate) * Number(qty);
            $('#other_total_qty' + id).text(total);
            total_other_qty_rate_calculate();
            grandTotalTK();
        }

        function total_silver_qty_rate_calculate() {
            var inputs_silver_qty = $('input[name="silver_qty[]"]');
            var total_silver_qty = 0;
            var total_silver_rate = 0;
            for (var i = 0; i < inputs_silver_qty.length; i++) {
                const silver_rate = $('#silver_rate' + i).val();
                const silver_qty = $('#silver_qty' + i).val();
                const total = Number(silver_rate) * Number(silver_qty);
                total_silver_rate += total;
                total_silver_qty += Number(silver_qty);
            }
            $('#total_silver_qty').text(total_silver_qty);
            $('#total_silver_rate').text(total_silver_rate);
            $('#total_silver_rate_input').val(total_silver_rate);
        }

        function total_bronze_qty_rate_calculate() {
            var inputs_qty = $('input[name="bronze_qty[]"]');
            var total_qty = 0;
            var total_rate = 0;
            for (var i = 0; i < inputs_qty.length; i++) {
                const rate = $('#bronze_rate' + i).val();
                const qty = $('#bronze_qty' + i).val();
                const total = Number(rate) * Number(qty);
                total_rate += total;
                total_qty += Number(qty);
            }
            $('#total_bronze_qty').text(total_qty);
            $('#total_bronze_rate').text(total_rate);
            $('#total_bronze_rate_input').val(total_rate);
        }

        function total_ss_qty_rate_calculate() {
            var inputs_qty = $('input[name="ss_qty[]"]');
            var total_qty = 0;
            var total_rate = 0;
            for (var i = 0; i < inputs_qty.length; i++) {
                const rate = $('#ss_rate' + i).val();
                const qty = $('#ss_qty' + i).val();
                const total = Number(rate) * Number(qty);
                total_rate += total;
                total_qty += Number(qty);
            }
            $('#total_ss_qty').text(total_qty);
            $('#total_ss_rate').text(total_rate);
            $('#total_ss_rate_input').val(total_rate);

        }

        function total_other_qty_rate_calculate() {
            var inputs_qty = $('input[name="other_qty[]"]');
            var total_qty = 0;
            var total_rate = 0;
            for (var i = 0; i < inputs_qty.length; i++) {
                const rate = $('#other_rate' + i).val();
                const qty = $('#other_qty' + i).val();
                const total = Number(rate) * Number(qty);
                total_rate += total;
                total_qty += Number(qty);
            }
            $('#total_other_qty').text(total_qty);
            $('#total_other_rate').text(total_rate);
            $('#total_other_rate_input').val(total_rate);

        }

        function grandTotalTK() {

            let total_silver_rate_input = $('#total_silver_rate_input').val();
            let total_ss_rate_input = $('#total_ss_rate_input').val();
            let total_bronze_rate_input = $('#total_bronze_rate_input').val();
            let total_other_rate_input = $('#total_other_rate_input').val();

            let grand_all_total = Number(total_silver_rate_input) + Number(total_ss_rate_input) + Number(
                total_bronze_rate_input) + Number(total_other_rate_input);

            $('#grand_total').text(grand_all_total);
            $('#grand_Total_input').val(grand_all_total);
        }

        // function calculate_supplier_comm() {
        //     const grand_total = $('#grand_Total_input').val();
        //     const com_percent = $('#supplier_com_percent').val();

        //     const calculate = (Number(grand_total) * Number(com_percent)) / 100;
        //     $('#supplier_comm_show').text(calculate);
        //     const supplier_grand_total = $('#supplier_grand_total').val(calculate);
        // }

        // function calculate_customer_comm() {
        //     const grand_total = $('#grand_Total_input').val();
        //     const com_percent = $('#customer_com_percent').val();
        //     console.log(grand_total, com_percent);
        //     const calculate = (Number(grand_total) * Number(com_percent)) / 100;
        //     $('#customer_comm_show').text(calculate);
        //     const supplier_grand_total = $('#customer_grand_total').val(calculate);
        // }

        function orderNo() {
            var order_no = $('#order_no').val();
            $.ajax({
                url: "/admin/order/list/get/"+order_no,
                type: 'GET',
                success: function(res) {
                    console.log(res)
                    $('.order_table_box').html(res)
                }
            });
        }
    </script>
@endpush
