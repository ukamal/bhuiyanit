<?php $__env->startSection('title', 'Add new Quotation'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Add New Item Quotation'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Add New Item Quotation</h4>
                        <form action="<?php echo e(route('item_qutation_store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-2">
                                    <tr>
                                        <td>Qoutation Date</td>
                                        <td>
                                            <input type="date"  class="form-control" name="qoutation_date">
                                        </td>
                                    </tr>
                                </div>
                                <div class="col-2">
                                    <tr>
                                        <td>Qoutation No</td>
                                        <td>
                                            <input type="text" name="qoutation_no" value="<?php echo e(qoutation_no()); ?>" class="form-control">
                                        </td>
                                    </tr>
                                </div>
                                <div class="col-2">
                                    <tr>
                                        <td>Customer Name</td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" onchange="get_customer()" id="customer"
                                                    name="customer">
                                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->customer); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                                <div class="col-3">
                                    <tr>
                                        <td>Site Delivery Address</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="customer_address"
                                                    id="customer_address" placeholder="address">
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                                <div class="col-2">
                                    <tr>
                                        <td>Mobile</td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="customer_mobile"
                                                    id="customer_mobile" placeholder="Mobile">
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                            </div>
                        
                            <div>
                                <span>Sub: </span> <input type="text" name="sub" class="form-control" id="unit"
                                    placeholder="Qoutation Subject"> <br>

                                       <!-------------Start calculation table------------------->     
                                    <table class="table table-bordered" id="dynamic-table">
                                          <thead class="bg-dark">
                                                <tr class="text-white text-center">
                                                <th scope="col">Sl</th>
                                                <th scope="col" style="width: 350px;">Items</th>
                                                <th scope="col">Color</th>
                                                
                                                <th scope="col">QTY</th>
                                                <th scope="col">Rate</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col" colspan="1" class="text-center">Action</th>
                                                </tr>
                                          </thead>
                                          <tbody id="table-body">
                                          <tr class="text-center">
                                                <th scope="row">1</th>

                                                <td>
                                                <select class="form-control select2 product-select" name="prosize_id[]" data-row="1">
                                                      <option value="">Select Item</option>
                                                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($pro->id); ?>">
                                                            <?php echo e($pro->code); ?> - <?php echo e($pro['brand']['brand_name']); ?> - <?php echo e($pro->product_name); ?>

                                                            </option>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                </td>

                                                <td>
                                                <select name="color_id[]" class="form-control color-select" data-row="1">
                                                      <option value="">Select Color</option>
                                                      <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($color->id); ?>"><?php echo e($color->color); ?></option>
                                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                </td>

                                                

                                                <td>
                                                <input type="number" name="qty[]" class="form-control qty" style="width: 100px;" oninput="calculateAmount()">
                                                </td>

                                                <td>
                                                <input type="text" name="rate[]" class="form-control rate-input" 
                                                oninput="calculateAmoun()">
                                                </td>

                                                <td>
                                                <input type="text" name="amount[]" class="form-control amount" readonly>
                                                </td>
                                          
                                                <td class="d-flex">
                                                <div class="btn btn-success mr-1" id="add-row">+</div> 
                                                <div class="btn btn-danger" id="remove-row">-</div>
                                                </td>
                                                
                                          </tr>
                                                

                                          </tbody>
                                    </table>                             
                              
                                    <div class="row">
                                          <div class="col-lg-4"></div>
                                          <div class="col-lg-4"></div>
                                          <div class="col-lg-4">
                                                <table class="table table-bordered">
                                                <tr>
                                                      <th>Grand Total:</th>
                                                      <td id="grandTotalDisplay">TK: 0</td>
                                                      <input type="hidden" name="grandTotal[]" id="grand_total">
                                                </tr>
                                                <tr>
                                                      <th>Discount:</th>
                                                      <td>
                                                      <input class="form-control" type="text" name="discount_percentage[]" id="discount_percentage" placeholder="%"
                                                      oninput="calculateDueAmount()">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <th>Paid Amount:</th>
                                                      <td>
                                                            <input type="text" id="paid_amount" name="paid_amount[]" class="form-control" oninput="calculateDueAmount()">
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <th>Due Amount:</th>
                                                      <td id="due_amountDisplay">TK: 0</td>
                                                      <input type="hidden" name="due_amount[]" id="due_amount">
                                                </tr>
                                                </table>
                                          </div>
                                    </div>
                              <!-- End Table for Calculation -->
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
    $(document).ready(function () {

        // Add Row
        $("#add-row").on("click", function () {
            var rowCount = $("#dynamic-table tbody tr").length;
            var rowCounter = rowCount + 1;

            var newRow = '<tr>' +
                '<td>' + rowCounter + '</td>' +
                '<td>' +
                '<select class="form-control select2 product-select" name="prosize_id[]" data-row="' + rowCounter + '">' +
                    '<option value="">Select Item</option>' +
                    '<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>' +
                        '<option value="<?php echo e($pro->id); ?>"> <?php echo e($pro->code); ?> - <?php echo e($pro['brand']['brand_name']); ?> - <?php echo e($pro->product_name); ?></option>' +
                    '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<select class="form-control color-select" name="color_id[]" data-row="' + rowCounter + '">' +
                    '<option value="">Select Color</option>' +
                    '<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>' +
                        '<option value="<?php echo e($color->id); ?>"><?php echo e($color->color); ?></option>' +
                    '<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>' +
                '</select>' +
                '</td>' +
                '<td><input type="text" name="size_no[]" class="size-no form-control" data-row="' + rowCounter + '"></td>' +
                '<td><input type="text" name="qty[]" class="form-control qty" data-row="' + rowCounter + '" oninput="calculateAmount(this)"></td>' +
                '<td><input type="text" name="rate[]" class="rate-input form-control" data-row="' + rowCounter + '" oninput="calculateAmount(this)"></td>' +
                '<td><input type="text" name="amount[]" class="form-control amount" data-row="' + rowCounter + '" readonly></td>' +
                '<td><button class="remove-row btn btn-danger">Remove</button></td>' +
                '</tr>';

            $("#dynamic-table tbody").append(newRow);
        });

        // Remove Row
        $("#dynamic-table").on("click", ".remove-row", function () {
            $(this).closest("tr").remove();
            // Update row numbers
            $("#dynamic-table tbody tr").each(function (index) {
                $(this).find("td:first").text(index + 1);
            });

            calculateAmount(); // Update calculation after removing a row
        });


        // Event handler for fetching product size on change of product-select
        $(document).on('change', '.product-select', function() {
            var row = $(this).closest('tr');
            getProductSize(row);
        });

        // Event handler for fetching color rate on change of color-select
        $(document).on('change', '.color-select', function() {
            var row = $(this).closest('tr');
            getColorRate(row);
        });

        // Fetch product size
        function getProductSize(row) {
            var productId = row.find(".product-select").val();
            var sizeInput = row.find(".size-no");

            $.ajax({
                url: '/get-sizes/' + productId,
                type: 'GET'
            })
            .done(function(response) {
                sizeInput.val(response.size);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching product size:', textStatus, errorThrown);
            });
        }

        // Fetch color rate
        function getColorRate(row) {
            var colorId = row.find(".color-select").val();
            var rateInput = row.find(".rate-input");

            $.ajax({
                url: '/get-rates/' + colorId,
                type: 'GET'
            })
            .done(function(response) {
                rateInput.val(response.silver_rate);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching color rate:', textStatus, errorThrown);
            });
        } //end get color ways rate

        
    }); //end document ready function


    function calculateAmount() {
        $(".amount").each(function () {
            var row = $(this).closest("tr");
            var qty = parseFloat(row.find('.qty').val()) || 0;
            var rate = parseFloat(row.find('.rate-input').val()) || 0;
            var amount = qty * rate;
            $(this).val(amount.toFixed(2));
        });

        calculateGrandTotal();
        calculateDueAmount();
    }

    function calculateGrandTotal() {
        var grandTotal = 0;
        $(".amount").each(function () {
            grandTotal += parseFloat($(this).val()) || 0;
        });
        $("#grand_total").val(grandTotal.toFixed(2));
        $("#grandTotalDisplay").text('TK: ' + grandTotal.toFixed(2));
    }

    function calculateDueAmount() {
        var paidAmount = parseFloat($("#paid_amount").val()) || 0;
        var grandTotal = parseFloat($("#grand_total").val()) || 0;

        var discountPercentage = parseFloat($("#discount_percentage").val()) || 0;
        var discountAmount = (grandTotal * discountPercentage) / 100;

        var dueAmount = grandTotal - discountAmount - paidAmount;

        $("#due_amountDisplay").text('TK: ' + dueAmount.toFixed(2));
        $("#due_amount").val(dueAmount.toFixed(2));
    }

    // get supplier 
    function getSupplierInPurchase() {
        console.log('Function getSupplierInPurchase called');
        var supplierId = $('#supplier_name').val();

        $.ajax({
            url: '/get-supplier-mobile/' + supplierId,
            type: 'GET'
        })
        .done(function(response) {
            console.log('Success. Response:', response);
            $('#supplier_mobile').val(response.phone);
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching supplier mobile:', textStatus, errorThrown);
        });
    }


</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/qoutation/add_item_qutation.blade.php ENDPATH**/ ?>