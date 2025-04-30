<?php $__env->startSection('title', 'Sale List'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Sale List'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Sale List</h4>
                        <div>
                            <table class="table" id="zero_configuration_table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Invoice No</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Grand Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e($order->sale_date); ?></td>
                                            <td><?php echo e($order->sale_no); ?></td>
                                            <td><?php echo e($order->customer->customer); ?></td>
                                            <td><?php echo e($order->grandTotal); ?></td>
                                            <td>
                                            <a href="<?php echo e(route('saleDetails',$order->id)); ?>" class="btn btn-primary">View</a>
                                            <a href="<?php echo e(route('sale_pdf',$order->id)); ?>" class="btn btn-success">Bill Print</a>
                                            <a href="<?php echo e(route('sale_delete',$order->id)); ?>" class="btn btn-danger">X</a>
                                            
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/remote/webbysys/bhuiyanit/resources/views/admin/sales/sale_list.blade.php ENDPATH**/ ?>