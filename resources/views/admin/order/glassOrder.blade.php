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
                                                <input type="text" name="order_no" value="{{order_no()}}"  hidden>
                                                <input type="text" name="order_type" value="{{$_GET['type']}}" hidden>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" id="customer" onchange="get_customer()" name="customer">
                                                        <option selected disabled>Select Customer</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}">{{ $customer->customer }}</option>
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
                                                        <option selected disabled>Select Supplier</option>
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
                                <table class="table table-bordered">
                                    <thead class="bg-dark">
                                        <tr class="text-white text-center">
                                            <th scope="col">Sl</th>
                                            <th scope="col" width="15%">Item Name (& Code)</th>
                                            <th scope="col">Type Of Glass</th>
                                            <th scope="col">Thickness</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Pcs</th>
                                            <th scope="col">Sft</th>
                                            <th scope="col">MT</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col"> Ammount </th>
                                            <th scope="col"> 
                                                <span onclick="addNewSection()" class="btn btn-sm btn-success">+</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        <tr class="text-center input-items-section-1">
                                            <th scope="row">1</th>
                                            <td >
                                                <select name="glass_product_id[]" id="glass_product_id_1" class="form-control item_name_with_code item_name_with_code_1" data-index="1" onchange="get_glass_product(1)">
                                                    <option disabled selected>Select Glass Product</option>
                                                    @foreach ($products as $product)                                                        
                                                        <option value="{{$product->id}}">{{$product->product_name}} ({{$product->product_code}})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control type_of_glass type_of_glass_1" type="text" name="type_of_glass[]" data-index="1">    
                                            </td>
                                            <td>
                                                <input class="form-control thikness thikness_1" type="text" name="thickness[]" data-index="1">
                                            </td>
                                            <td class="d-flex">
                                                <input class="form-control size_x size_x_1" type="text" name="size_x[]" placeholder="inch" data-index="1">
                                                <b> &nbsp;&nbsp;X&nbsp;&nbsp; </b> 
                                                <input class="form-control size_y size_y_1" type="text" name="size_y[]" placeholder="inch" data-index="1">
                                            </td>
                                            <td>
                                                <input class="form-control pcs pcs_1" type="text" name="pcs[]" data-index="1">
                                            </td>
                                            
                                            <td class="text-center">
                                                <input class="form-control sft sft_1" id="sft_1" type="text" name="sft[]" readonly data-index="1">
                                            </td>
                                            <td class="text-center">
                                                <input class="form-control mt mt_1" type="text" name="mt[]" data-index="1" readonly >
                                            </td>
                                            <td>
                                                <input class="form-control rate rate_1" type="text" name="rate[]" data-index="1">
                                            </td>

                                            <td class="text-center">
                                                <input class="form-control ammount ammount_1" type="text" name="ammount[]" readonly data-index="1">
                                            </td>
                                            <td>
                                                <span onclick="removeSection(1)" class="btn btn-sm btn-danger" data-index="1">-</span>
                                            </td>
                                            
                                        </tr>
                                        <tr class="text-center bg-dark text-white">
                                            <td colspan="5" class="text-right">Total</td>
                    
                                            <td >
                                                <span id="total_pcs"></span>
                                            </td>
                                            <td>
                                                <span id="total_sft"></span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <span id="total_ammount"></span>
                                            </td>
                                            <td></td>
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
                                                    <div class="d-flex">Carrying Cost &nbsp; 
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                    <span>
                                                        <input name="carrying_cost" id="carrying_cost"
                                                                type="text" style="width: 80px"
                                                                placeholder="">
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex">Supplier Advance</div>
                                                </td>
                                                <td><span class="font-weight-bold"><input type="text"
                                                            name="supplier_advenced" style="width: 80px"
                                                            placeholder="ex: 1000TK"></span></td>
                                            </tr>
                                            {{-- <tr>
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
                                            </tr> --}}
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
            // console.log(grand_total, com_percent);
            const calculate = (Number(grand_total) * Number(com_percent)) / 100;
            $('#customer_comm_show').text(calculate);
            const supplier_grand_total = $('#customer_grand_total').val(calculate);
        }
        
    </script>
    <script id="add_new_template">
        let template = `<tr class="input-items-section-{{@key}}"><th class="sl_item">{{@key}}</th>
        <td> 
            <select name="glass_product_id[]" id="glass_product_id_{{@key}}" class="form-control item_name_with_code item_name_with_code_{{@key}}" data-index="{{@key}}" onchange="get_glass_product({{@key}})">
                <option disabled selected>Select Glass Product</option>
                @foreach ($products as $product)                    
                    <option value="{{$product->id}}">{{$product->product_name}} ({{$product->product_code}})</option>
                @endforeach
            </select>
        </td>
        <td>
            <input class="form-control type_of_glass type_of_glass_{{@key}}" type="text" name="type_of_glass[]" data-index="{{@key}}">    
        </td>
        <td>
            <input class="form-control thikness thikness_{{@key}}" type="text" name="thickness[]" data-index="{{@key}}">
        </td>
        <td class="d-flex">
            <input class="form-control size_x size_x_{{@key}}" type="text" name="size_x[]" placeholder="inch" data-index="{{@key}}">
            <b> &nbsp;&nbsp;X&nbsp;&nbsp; </b> 
            <input class="form-control size_y size_y_{{@key}}" type="text" name="size_y[]" placeholder="inch" data-index="{{@key}}">
        </td>
        <td>
            <input class="form-control pcs pcs_{{@key}}" type="text" name="pcs[]" data-index="{{@key}}">
        </td>
        
        <td class="text-center">
            <input class="form-control sft sft_{{@key}}" id="sft_{{@key}}" type="text" name="sft[]" readonly data-index="{{@key}}">
        </td>
        <td class="text-center">
            <input class="form-control mt mt_{{@key}}" type="text" name="mt[]" data-index="{{@key}}" readonly>
        </td>
        <td>
            <input class="form-control rate rate_{{@key}}" type="text" name="rate[]" data-index="{{@key}}">
        </td>

        <td class="text-center">
            <input class="form-control ammount ammount_{{@key}}" type="text" name="ammount[]" readonly data-index="{{@key}}">
        </td>
        <td>
            <span onclick="removeSection({{@key}})" class="btn btn-sm btn-danger" data-index="{{@key}}">-</span>
        </td></tr>`;
        let recentKey = 1;
        function addNewSection() {
            let newKey = parseInt(recentKey)+1
            let newTemplate = template.replace(/{{@key}}/g, newKey)
            $('.input-items-section-'+recentKey).after(newTemplate);
            recentKey = newKey;

        }

        function removeSection (index) {
            if (confirm('Are you sure to remove this?')) {
                $('.input-items-section-'+index).remove();
                // recentKey--;
            }
        }

        function calculation(index) {
            let size_x = $('.size_x_'+index).val();
            let size_y = $('.size_y_'+index).val();
            let pcs = $('.pcs_'+index).val();
            if (size_x && size_y && pcs) {
                let cal_sft = parseFloat(((parseInt(size_x)/12) * (parseInt(size_y)/12)) * pcs).toFixed(2);
                $('.sft_'+index).val(cal_sft);
            } else {
                $('.sft_'+index).val(0);
            }
            let sft = $('.sft_'+index).val();
            let rate = $('.rate_'+index).val();

            let thikness = Number($('.thikness_'+index).val());
            if(thikness == 2.5){
                var mt = sft/1720;
            }else if(thikness == 3.5){
                var mt = sft/860;
            }else if(thikness == 5){
                var mt = sft/537;
            }else if(thikness == 8){
                var mt = sft/1230;
            }

            $('.mt_'+index).val(mt);

            if (sft && rate) {
                let ammount = (parseFloat(sft) * parseFloat(rate)).toFixed(2);
                $('.ammount_'+index).val(ammount);
                
            } else {
                $('.ammount_'+index).val(0);
            }

            calTotal();
            
        }

        function calTotal() {
            let ammountList = $('.ammount');
            let sftList = $('.sft');
            let totalAmmount = totalSft = 0;
            for (let i = 0; i < ammountList.length; i++) {
                if (ammountList[i].value) {
                    totalAmmount = (parseFloat(totalAmmount) + parseFloat(ammountList[i].value)).toFixed(2);
                }
                if (sftList[i].value) {
                    totalSft = (parseFloat(totalSft) + parseFloat(sftList[i].value)).toFixed(2);
                }
            }
            $('#grand_Total_input').val(totalAmmount);
            $('#total_ammount').html(totalAmmount);
            $('#grand_total').html(totalAmmount);
            $('#total_sft').html(totalSft);
            // console.log(totalAmmount);
        }

        $('#table-body').on('keyup', '.size_x', function (event) {
            let val = $(this).val();
            let index = $(this).data('index')

            calculation(index)
        });

        $('#table-body').on('keyup', '.size_y', function (event) {
            let val = $(this).val();
            let index = $(this).data('index')

            calculation(index)
        });

        $('#table-body').on('keyup', '.pcs', function (event) {
            let val = $(this).val();
            let index = $(this).data('index')

            calculation(index)
        });

        $('#table-body').on('keyup', '.rate', function (event) {
            let val = $(this).val();
            let index = $(this).data('index')
            calculation(index)
        });


        // function get_glass_product(key) {
        //     var sft_element = $('#sft_'+key);
        //     var glass_product_id = $('#glass_product_id_'+key).val();

        //     $.ajax({
        //         url: "/admin/glass_product/get/" + glass_product_id,
        //         type: "get",
        //         success: function(res) {
        //             sft_element.val(res.sft)
        //         }
        //     });
        // }

    </script>
@endpush
