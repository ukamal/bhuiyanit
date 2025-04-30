<?php $__env->startSection('title', 'Add new Service Sale'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Add New Service Sale'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Add New Service Sale</h4>
                        <form action="<?php echo e(route('admin.service_sales.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <tr>
                                        <td>Invoice  Date</td>
                                        <td>
                                            <input type="date"  class="form-control" name="invoice_date">
                                        </td>
                                    </tr>
                                </div>
                                <div class="col-md-4">
                                    <tr>
                                        <td>Invoice No</td>
                                        <td>
                                            <input type="text" name="service_sale_no" value="<?php echo e(sale_no()); ?>" class="form-control">
                                        </td>
                                    </tr>
                                </div>
                                <div class="col-md-4">
                                    <tr>
                                        <td>Customer Name</td>
                                        <td>
                                            <div class="form-group" style="display: flex;">
                                                <select class="form-control" onchange="get_customer()" id="customer_id"
                                                    name="customer_id" >
                                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->customer); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <a class="btn btn-primary mx-1" style="color: wheat;" data-toggle="modal" data-target="#exampleModal">+</a>
                                            </div>
                                        </td>
                                        </tr>
                                </div>
                                <div class="col-md-4">
                                    <tr>
                                        <td>Brand Name 
                                        </td>
                                        <td>
                                            <select class="form-control" id="brand_name" name="brand_name">
                                                <option selected disabled>Select Brand</option>
                                                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->brand_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    </tr>
                                </div>
                                <div class="col-md-4">
                                    <tr>
                                        <td>Mobile</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="mobile"
                                                    id="customer_mobile" placeholder="Mobile">
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <table class="table table-bordered">
                                       
                                        
                                     
                                    </table>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">

                                </div>
                            </div>
                            <div>
                                 <br>
                                 <table class="table table-bordered">
                                    <thead class="bg-dark">
                                        <tr class="text-white text-center">
                                            <th scope="col" style="width: 5%">Sl</th>
                                            <th scope="col" style="width: 35%">Details Of Work Description</th>
                                            <th scope="col" style="width: 10%">Unit</th>
                                            <th scope="col" style="width: 10%">Rate</th>
                                            <th scope="col" style="width: 10%">Total</th>
                                            <th scope="col" style="width: 5%">Actions</th>
                                        </tr>

                                    </thead>
                                    <tbody id="table-body">
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-center">
                                                <textarea class="form-control" name="item_dsc[]" id="exampleFormControlTextarea1" rows="1"></textarea>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="unit[]" class="form-control" id="unit"
                                                    placeholder="Unit">
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="rate[]" class="form-control" id="unit"
                                                    placeholder="Rate">
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="total[]" class="form-control" id="total"
                                                    placeholder="Total">
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary add_qoutation">+</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <td class="text-center">
                                                    <input type="text" name="grand_total[]" class="form-control" id="grand_total"
                                                        placeholder="Grand Total">
                                                </td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="dsc">Description</label>
                                            <textarea class="form-control" name="dsc" id="dsc" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>


<script src="<?php echo e(asset('backend/dist-assets/js/plugins/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/datatables.script.min.js')); ?>"></script>
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

        var qoutations = [];
        var count = 1;
        $('.add_qoutation').on('click', function() {
            var htmlTable = '';
            htmlTable += `
                <tr>
                    <td class="text-center">${count+1}</td>
                    <td class="text-center">
                        <textarea class="form-control" name="item_dsc[]" id="item_dsc${count}" rows="1"></textarea>
                    </td>
                    <td class="text-center">
                        <input type="text" name="unit[]" class="form-control" id="unit${count}"
                            placeholder="Unit">
                    </td>
                    <td class="text-center">
                        <input type="text" name="rate[]" class="form-control" id="rate${count}"
                            placeholder="Rate">
                    </td>
                    <td class="text-center">
                        <input type="text" name="total[]" class="form-control" id="total${count}"
                            placeholder="total">
                    </t
                </tr>
                `;
            $('#table-body').append(htmlTable);
            count++
        })

        function qoutationList(book_list) {
            var htmlTable = '';
            for (var i = 0; i < book_list.length; i++) {

                htmlTable += `
                    <tr>
                        <th scope="row">${i+1}</th>
                        <td>${book_list[i].material}</td>
                        <td>
                            <p style="margin-bottom:0px">${book_list[i].booking_color}</p>
                            <p>${book_list[i].material_color}</p>
                        </td>
                        <td>
                        <p style="margin-bottom:0px"> ${book_list[i].booking_size}</p>
                        <p> ${book_list[i].material_size}</p>
                        </td>
                        <td>${book_list[i].booking_order_qty}</td>
                        <td>${book_list[i].booking_conz}</td>
                        <td>${parseFloat(book_list[i].booking_req_qty).toFixed(3)} ${book_list[i].req_units}</td>
                        <td>${parseFloat(book_list[i].booking_qty).toFixed(3)}</td>
                        <td>${book_list[i].booking_supplier}</td>
                        <td>${book_list[i].remarks}</td>
                        <td><div data-index="${i}" class="btn btn-sm btn-danger text-right qty_remove_list">x</div></td>
                    </tr>
                `;
            }
        }
    </script>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
     <form action="<?php echo e(route('customer.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="fomr-group">
                <label for="customer"><strong>Customer</strong></label>
                <input type="text" id="customer" name="name" class="form-control" placeholder="Enter Customer Name" required>
              </div>
              <div class="fomr-group mt-2">
                <label for="phone"><strong>Phone</strong></label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter Customer Phone">
              </div>
              <div class="fomr-group mt-2">
                <label for="email"><strong>Email</strong></label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter Customer Email">
              </div>
              <div class="fomr-group mt-2">
                <label for="address"><strong>Address</strong></label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Customer Address">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
     </form>
    </div>
  </div>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/service_sale/index.blade.php ENDPATH**/ ?>