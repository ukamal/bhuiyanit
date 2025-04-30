@extends('layouts.backend.master')
@section('title', 'Add new Packege sale')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('page_title', 'Add New Packege Sale')
@section('content')
<div class="row" id="add_new_sale">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card text-left">
            <div class="card-body">
               <h4 class="card-title mb-3">Add New Packege Sale</h4>
               <form action="{{ route('admin.packege_sales.store') }}" method="POST">
                  @csrf

                <input type="hidden" name="service_datetime">

                  <div class="row">
                     <div class="col-lg-4">
                        <table class="table table-bordered">
                           <tr>
                              <td>Date </td>
                              <td>
                                 <input type="date" name="sale_date" class="form-control">
                              </td>
                           </tr>
                           <tr>
                              <td>Invoice No</td>
                              <td>
                                 {{ sale_no() }}
                                 <input type="text" name="invoice_no" value="{{ sale_no() }}" hidden>
                              </td>
                           </tr>
                           <tr>
                              <td>Customer Name</td>
                              <td>
                                 <div class="form-group"  style="display: flex;">
                                    <select class="form-control" onchange="get_customer()" id="customer" name="customer_id">
                                       <option selected disabled>Select Customer</option>
                                       @foreach ($customers as $customer)
                                       <option value="{{ $customer->id }}">{{ $customer->customer }}</option>
                                       @endforeach
                                    </select>
                                    <a class="btn btn-primary mx-1" style="color: wheat;" data-toggle="modal" data-target="#exampleModal">+</a>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>Brand Name 
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="brand_name"
                                       id="brand_name" placeholder="Brand Name">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>Model 
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="model"
                                       id="model" placeholder="Model">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>Chasis No
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" class="form-control" name="chasis_no"
                                       id="chasis_no" placeholder="Chasis No">
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
                           <tr>
                              <td>Packege Name</td>
                              <td>
                                 <div class="form-group">
                                    <select class="form-control" id="packege" name="packege_id">
                                       <option selected disabled>Select Packege</option>
                                       @foreach ($package as $packages)
                                       <option value="{{ $packages->id }}">{{ $packages->packege_name }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <table class="table table-bordered">
                           <thead class="bg-dark">
                              <tr class="text-white text-center">
                                 <th width="25%">Service Name</th>
                                 <th width="25%">Service Amount</th>
                                 <th width="25%">Quantity <span class="text-danger"></th>
                              </tr>
                           </thead>
                           <tbody class="service_id">
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div>
                  </div>

                     <!-- Table for Total Counts -->
                     <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead class="bg-dark">
                                    <tr class="text-white text-center">
                                        <th width="50%">Total Service Amount</th>
                                        <th width="50%">Total Quantity</th>
                                    </tr>
                                </thead>
                                <tbody class="total_counts text-center" style="font-width:bold">
                                    <tr>
                                        <td class="total_amount">0.00</td>
                                        <td class="total_quantity">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Start Table for Calculation -->
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Service Total:</th>
                                    <td class="service_value">TK: 0</td>
                                </tr>
                                <tr>
                                    <th>Paid Amount:</th>
                                    <td>
                                        <input type="text" id="paid_amount" name="paid_amount" class="form-control" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Due Amount:</th>
                                    <td class="due_amount">TK: 0</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                      <!-- End Table for Calculation -->

                  <button type="submit" class="btn btn-primary float-right mr-5">Confirm</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('backend/dist-assets/js/plugins/datatables.min.js') }}"></script>
<script src="{{ asset('backend/dist-assets/js/scripts/datatables.script.min.js') }}"></script>


<script>
    $(document).ready(function () {
        $('#packege').on('change', function () {
            var packege_id = $(this).val();
            $.ajax({
                url: '/get-packege',
                type: 'post',
                dataType: 'json',
                data: 'packege_id=' + packege_id,
                success: function (data) {
                    var serviceTableBody = $('.service_id');
                    var totalCountsBody = $('.total_counts');
                    var calculationTable = $('.table-bordered');

                    serviceTableBody.empty();
                    totalCountsBody.empty();

                    var totalAmount = 0;
                    var totalQuantity = 0;

                    data.forEach(function (row) {
                     var rowData = '<tr>' +
                        '<td><input type="text" readonly name="service_name[]" value="' + row.service_name + '" class="form-control"></td>' +
                        '<td><input type="text" readonly name="service_value[]" value="' + row.service_value + '" class="form-control"></td>' +
                        '<td><input type="text" readonly name="quantity[]" value="' + row.quantity + '" class="form-control"></td>' +
                        '</tr>';
                     serviceTableBody.append(rowData);

                     // Calculate the total amount and quantity
                     totalAmount += parseFloat(row.service_value);
                     totalQuantity += parseInt(row.quantity);
                  });


                    // Display total amount and quantity
                    var totalsRow = '<tr>' +
                        '<td class="total_amount">' + totalAmount.toFixed(2) + '</td>' +
                        '<td class="total_quantity">' + totalQuantity + '</td>' +
                        '</tr>';
                    totalCountsBody.append(totalsRow);

                    // Update the Service Total in the Calculation Table
                    calculationTable.find('.service_value').text('TK: ' + totalAmount.toFixed(2));

                    // Handle input changes in Paid Amount
                    $('#paid_amount').on('input', function () {
                        var paidAmount = parseFloat($(this).val()) || 0;
                        var dueAmount = totalAmount - paidAmount;

                        // Display Due Amount
                        calculationTable.find('.due_amount').text('TK: ' + dueAmount.toFixed(2));
                    });

                    // Initial calculation
                    $('#paid_amount').trigger('input');
                },
                error: function (error, xhr, status) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endpush
@push('vue-js')
<script src="{{ asset('js/pages/AddNewSale.js') }}"></script>
@endpush