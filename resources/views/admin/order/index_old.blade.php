@extends('layouts.backend.master')
@section('title', 'Add new Order')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Add New Order')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Add New Order</h4>
                        <form action="{{route('admin.add.order.store')}}" method="POST" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Order No</td>
                                            <td>
                                                {{order_no()}}
                                                <input type="text" name="order_no" value="{{order_no()}}" hidden>
                                                <input type="text" name="order_type" value="{{$_GET['type']}}" hidden>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" id="customer" onchange="get_customer()" name="customer">
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->customer }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Site Delivery Address</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="customer_address"
                                                        id="customer_address" placeholder="address">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="customer_mobile"
                                                        id="customer_mobile" placeholder="Mobile">
                                                </div>
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
                                                <div class="form-group">
                                                    <input type="date" required class="form-control" name="order_date"
                                                        id="date" placeholder="date">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Supplier Name</td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" id="supplier" onchange="get_supplier()" name="supplier">
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="supplier_address"
                                                        id="supplier_address" placeholder="address">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="supplier_mobile"
                                                        id="supplier_mobile" placeholder="Mobile">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div>
                                {{ $_GET['type']}}
                                <table class="table table-bordered">
                                    <thead class="bg-dark">
                                        <tr class="text-white text-center">
                                            <th scope="col">Sl</th>
                                            <th scope="col">Die No</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">unit</th>
                                            <th scope="col">Size/Thickness</th>
                                            @if ($_GET['type'] !== 'SS' && $_GET['type'] !== 'Glass')
                                                <th scope="col" colspan="3" class="text-center">Silver</th>
                                                <th scope="col" colspan="3" class="text-center">Bronze</th>
                                            @endif
                                            @if ($_GET['type'] !== 'Glass')
                                            <th scope="col" colspan="3" class="text-center">SS</th>
                                            @endif
                                            <th scope="col" colspan="3" class="text-center">
                                                Other
                                                <input type="text" class="form-control" name="other_text">
                                            </th>

                                        </tr>
                                        <tr class="bg-dark">
                                            <td colspan="5"></td>
                                            @if ($_GET['type'] !== 'SS' && $_GET['type'] !== 'Glass')
                                                <td class="text-white text-center">Rate</td>
                                                <td class="text-white text-center">Qty</td>
                                                <td class="text-white text-center">Total</td>
                                                
                                                <td class="text-white text-center">Rate</td>
                                                <td class="text-white text-center">Qty</td>
                                                <td class="text-white text-center">Total</td>
                                            @endif
                                            @if ($_GET['type'] !== 'Glass')
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
                                        @foreach ($products as $key => $product)
                                            <tr class="text-center">
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $product->die }}</td>
                                                <td>
                                                    {{ $product->item_description }}
                                                    <input type="text" name="product_id[]" hidden
                                                        value="{{ $product->id }}">
                                                </td>
                                                <td>{{ $product->unit }}</td>
                                                <td>{{ $product->size }}</td>
                                                
                                                @if ($_GET['type'] !== 'SS' && $_GET['type'] !== 'Glass')
                                                    <td class="text-center">
                                                        {{ $product->silver_rate }}
                                                        <input type="text" name="silver_rate[]"
                                                            id="silver_rate{{ $key }}" hidden
                                                            value="{{ $product->silver_rate }}">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="silver_qty[]" style="width: 55px"
                                                            onkeyup="silver_qty({{ $key }})"
                                                            id="silver_qty{{ $key }}">
                                                    </td>
                                                    <td>
                                                        <span id="total_qty{{ $key }}"></span>
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $product->bronze_rate }}
                                                        <input type="text" name="bronze_rate[]" id="bronze_rate{{ $key }}" hidden
                                                            value="{{ $product->bronze_rate }}">

                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" id="bronze_qty{{ $key }}"
                                                            onkeyup="bronzeQty({{ $key }})" name="bronze_qty[]"
                                                            style="width: 55px">
                                                    </td>
                                                    <td>
                                                        <span id="bronze_total_qty{{ $key }}"></span>
                                                    </td>
                                                @endif
                                                
                                                @if ($_GET['type'] !== 'Glass')
                                                    <td class="text-center">
                                                        {{ $product->ss_rate }}
                                                        <input type="text" name="ss_rate[]" id="ss_rate{{ $key }}" hidden
                                                            value="{{ $product->ss_rate }}">

                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" id="ss_qty{{ $key }}"
                                                            onkeyup="ssQty({{ $key }})" name="ss_qty[]"
                                                            style="width: 55px">
                                                    </td>
                                                    <td>
                                                        <span id="ss_total_qty{{ $key }}"></span>
                                                    </td>
                                                @endif

                                                <td class="text-center">
                                                    {{ $product->other_rate }}
                                                    <input type="text" name="other_rate[]" id="other_rate{{ $key }}" hidden
                                                        value="{{ $product->other_rate }}">

                                                </td>
                                                <td class="text-center">
                                                    <input type="text" id="other_qty{{ $key }}"
                                                        onkeyup="otherQty({{ $key }})" name="other_qty[]"
                                                        style="width: 55px">
                                                </td>
                                                <td>
                                                    <span id="other_total_qty{{ $key }}"></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="text-center bg-dark text-white">
                                            <td colspan="5" class="text-right">Total</td>
                                            @if ($_GET['type'] !== 'SS' && $_GET['type'] !== 'Glass')
                                                <td></td>
                                                <td><span id="total_silver_qty"></span></td>
                                                <td>
                                                    <span id="total_silver_rate"></span>
                                                    <input type="text" hidden id="total_silver_rate_input">
                                                </td>

                                                <td></td>
                                                <td><span id="total_bronze_qty"></span></td>
                                                <td>
                                                    <span id="total_bronze_rate"></span>
                                                    <input type="text" hidden id="total_bronze_rate_input">
                                                </td>
                                            @endif
                                            @if ($_GET['type'] !== 'Glass')
                                                <td></td>
                                                <td><span id="total_ss_qty"></span></td>
                                                <td>
                                                    <span id="total_ss_rate"></span>
                                                    <input type="text" hidden id="total_ss_rate_input">

                                                </td>
                                            @endif
                                            <td></td>
                                            <td><span id="total_other_qty"></span></td>
                                            <td>
                                                <span id="total_other_rate"></span>
                                                <input type="text" hidden id="total_other_rate_input">
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row mt-5">
                                    <div class="col-lg-9"></div>
                                    <div class="col-lg-3">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="text-right">Grand Total</td>
                                                <td><span class="font-weight-bold" id="grand_total"></span>TK</td>
                                                <input type="text" name="grandTotal" hidden id="grand_Total_input">
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Supplier Commision &nbsp; <span>
                                                            <input onkeyup="calculate_supplier_comm()"
                                                                name="supplier_com_percent" id="supplier_com_percent"
                                                                type="text" style="width: 80px"
                                                                placeholder="ex: 15%"></span></div>
                                                </td>
                                                <td><span class="font-weight-bold" id="supplier_comm_show"></span></td>
                                                <input type="text" hidden id="supplier_grand_total"
                                                    name="supplier_comm_show">
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Supplier Advance</div>
                                                </td>
                                                <td><span class="font-weight-bold"><input type="text"
                                                            name="supplier_advenced" style="width: 80px"
                                                            placeholder="ex: 1000TK"></span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Customer Commision &nbsp; <span><input
                                                                type="text" style="width: 80px"
                                                                onkeyup="calculate_customer_comm()"
                                                                id="customer_com_percent" name="customer_com_percent"
                                                                placeholder="ex: 10%"></span></div>
                                                </td>
                                                <td><span class="font-weight-bold" id="customer_comm_show"></span></td>
                                                <input type="text" hidden id="customer_grand_total"
                                                    name="customer_comm_show">
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Customer Advance</div>
                                                </td>
                                                <td><span class="font-weight-bold"><input type="text"
                                                            name="customer_advence" style="width: 80px"
                                                            placeholder="ex: 1000TK"></span></td>
                                            </tr>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Confirm Order</button>
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

            // console.log('EEEEEEEEEEE');
            // console.log(total_ss_rate_input+total_other_rate_input);


            
            var total_silver_value = isNaN(Number(total_silver_rate_input))  ? 0 : Number(total_silver_rate_input);

            var total_ss_value = isNaN(Number(total_ss_rate_input)) ? 0 : Number(total_ss_rate_input);
            var total_bronze_value = isNaN(Number(total_bronze_rate_input)) ? 0 : Number(total_bronze_rate_input);
            var total_other_value = isNaN(Number(total_other_rate_input)) ? 0 : Number(total_other_rate_input);
            let grand_all_total = total_silver_value + total_ss_value + total_bronze_value + total_other_value;
            
            $('#grand_total').text(grand_all_total);
            $('#grand_Total_input').val(grand_all_total);
        }

        function calculate_supplier_comm() {
            const grand_total = $('#grand_Total_input').val();
            const com_percent = $('#supplier_com_percent').val();

            const calculate = (Number(grand_total) * Number(com_percent)) / 100;
            $('#supplier_comm_show').text(calculate);
            const supplier_grand_total = $('#supplier_grand_total').val(calculate);
        }

        function calculate_customer_comm() {
            const grand_total = $('#grand_Total_input').val();
            const com_percent = $('#customer_com_percent').val();
            console.log(grand_total, com_percent);
            const calculate = (Number(grand_total) * Number(com_percent)) / 100;
            $('#customer_comm_show').text(calculate);
            const supplier_grand_total = $('#customer_grand_total').val(calculate);
        }
    </script>
@endpush
