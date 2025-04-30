<?php $__env->startSection('title', 'Supplier Order List'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Supplier Order List'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Order List</h4>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th>Order No</th>
                                        <th>Supplier</th>
                                        <th>Total Amount</th>
                                        <th>Commission</th>
                                        <th>Payable Amount</th>
                                        <th>Advence</th>
                                        <th>Due</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e($order->order_no); ?></td>
                                            <td><?php echo e($order->supplier->name); ?></td>
                                            <td><?php echo e($order->grandTotal); ?></td>
                                            <td><?php echo e($order->supplier_comm); ?></td>
                                            <?php
                                                $amount = $order->grandTotal - $order->supplier_comm;
                                            ?>
                                            <td><?php echo e($amount); ?></td>
                                            <td><?php echo e($order->supplier_advenced); ?></td>
                                            <td><?php echo e($amount - $order->supplier_advenced); ?></td>
                                            <td><a href="<?php echo e(route('admin.order_details', $order->id)); ?>"
                                                    class="btn btn-primary">View</a></td>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/order/suppler_order_list.blade.php ENDPATH**/ ?>