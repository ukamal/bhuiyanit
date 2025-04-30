<?php $__env->startSection('title', 'Receive Report'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Receive Payment Report'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title mb-3">Receive Payment Report</h4>
                            </div>
                            <div class="col-md-6">
                                <form action="<?php echo e(url('admin/customer/recieve/report')); ?>" method="get" class="form-group d-flex">
                                    <select name="customer" id="" class="form-control">
                                        <option value="0">Search By Customer</option>
                                        <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($cus->id == $selectedCus): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($cus->id); ?>"><?php echo e($cus->customer); ?></option> 
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <input type="text" class="form-control" name="search" placeholder="Search..">
                                    <button class="btn btn-info">Filter</button>
                                    <a href="<?php echo e(url('admin/customer/recieve/report')); ?>" class="btn btn-primary">Clear</a>
                                </form>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Grand Total</th>
                                        <th scope="col">Due</th>
                                        <th scope="col">Receive</th>
                                        <th scope="col">Blanced</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totaDue = 0;
                                        $totalReceive = 0;
                                        $totalBlance = 0;
                                    ?>
                                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e(date('d-m-y', strtotime($invoice->created_at))); ?></td>
                                            <td><?php echo e($invoice->invoice_no); ?></td>
                                            <td><?php echo e(($invoice->customer->customer)??''); ?></td>
                                            <td><?php echo e($invoice->grandTotal); ?></td>
                                            <td>
                                                <?php
                                                    $due = 0;
                                                    $receive = 0;
                                                ?>
                                                <?php if($invoice->type == 'sale' || $invoice->type == 'order'): ?>
                                                    <?php
                                                        $grandTotal = $invoice->grandTotal - $invoice->customer_comm;
                                                        $due = $grandTotal - $invoice->customer_comm;
                                                        $totaDue = $totaDue + $due;
                                                    ?>
                                                <?php else: ?>
                                                    <?php
                                                        $receive = $invoice->grandTotal;
                                                        $totalReceive = $totalReceive+ $receive;
                                                    ?>
                                                <?php endif; ?>
                                                <?php echo e($due); ?>

                                            </td>
                                            <td>
                                                <?php echo e($receive); ?>

                                            </td>
                                            <td><?php echo e($totaDue - $totalReceive); ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="<?php echo e(route('receive_report_print',$invoice->id)); ?>">Print</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/report/receive_report.blade.php ENDPATH**/ ?>