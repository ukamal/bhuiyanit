<?php $__env->startSection('title', 'Payment Report'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Supplier Payment Report'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="my-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="card-title mb-3">Supplier Payment Report</h4>
                                </div>
                                <div class="col-md-8">
                                    <form action="<?php echo e(url('/admin/payment/report')); ?>" method="get" class="form-group d-flex">
                                        
                                        <select name="supplier" id="" class="form-control">
                                            <option value="0">Search By Supplier</option>
                                            <?php $__currentLoopData = $supplier; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($selectedSup) && $cus->id == $selectedSup): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($cus->id); ?>"><?php echo e($cus->name); ?></option> 
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <input type="text" class="form-control" name="search" placeholder="Search.." value="<?php echo e(($search)??''); ?>">
                                        <button class="btn btn-info">Filter</button>
                                        <a href="<?php echo e(url('/admin/payment/report')); ?>" class="btn btn-primary">Clear</a>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Grand Total</th>
                                        
                                        <th scope="col">Advance</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Blanced</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totaDue = 0;
                                        $totalPayment = 0;
                                        $totalBlance = 0;
                                    ?>
                                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e(date('d-m-y', strtotime($invoice->created_at))); ?></td>
                                            
                                            <td><?php echo e(($invoice->supplier->name)??''); ?></td>
                                            <td><?php echo e($invoice->grandTotal); ?></td>
                                            
                                            <td><?php echo e($invoice->supplier_advenced); ?></td>
                                            <td>
                                                <?php
                                                    $due = 0;
                                                    $payment = 0;
                                                ?>
                                                <?php if($invoice->type == 'sale' || $invoice->type == 'order'): ?>
                                                    <?php
                                                        $grandTotal = $invoice->grandTotal - $invoice->supplier_comm;
                                                        $due = $grandTotal - $invoice->supplier_advenced;
                                                        $totaDue = $totaDue + $due;
                                                    ?>
                                                <?php else: ?>
                                                    <?php
                                                        $payment = $invoice->grandTotal;
                                                        $totalPayment = $totalPayment+ $payment;
                                                    ?>
                                                <?php endif; ?>
                                                <?php echo e($due); ?>

                                            </td>
                                            <td>
                                                <?php echo e($payment); ?>


                                            </td>
                                            <td><?php echo e($totaDue - $totalPayment); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('supplier_payment_report_pdf',$invoice->id)); ?>" class="btn btn-primary">Print</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="modal fade" id="additional_commission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Additional Commission</h5>
                                        <button type="button" class="close"
                                            data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(url('admin/payment/report/additionComm')); ?>" method="POST">
                                        
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Order Id</label>
                                                <!--<input type="text" required
                                                    class="form-control" value="" name="name"
                                                    id="name" aria-describedby="emailHelp"
                                                    placeholder="">-->
                                                <select class="form-control select product_id" name="product">
                                                    <option >Select</option>
                                                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($invoice->id); ?>">
                                                        <?php echo e($invoice->id); ?>

                                                        <?php if($invoice->order): ?>
                                                            <?php echo e(' - '.(($invoice->order->order_no)??'')); ?>

                                                        <?php endif; ?>
                                                        <?php if($invoice->supplier): ?>
                                                            <?php echo e(' - '.(($invoice->supplier->name)??'')); ?></option>
                                                        <?php endif; ?>
                                                        
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="name">Percentage</label>
                                                <input type="text" required
                                                    class="form-control" value="" name="percantage"
                                                    id="name" aria-describedby="emailHelp"
                                                    placeholder="">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('backend/dist-assets/js/plugins/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/datatables.script.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/report/payment_report.blade.php ENDPATH**/ ?>