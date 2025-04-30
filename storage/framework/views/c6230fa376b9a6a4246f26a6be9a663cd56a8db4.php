<?php $__env->startSection('title', 'Service Sale List'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Service Sale List'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Service Sale List</h4>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Invoice Date</th>
                                        <th scope="col">Service Sale No</th>
                                        <th scope="col">Customer</th>
                                        
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Item Dsc</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Grand Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $service_sale; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e($item->invoice_date); ?></td>
                                            <td><?php echo e($item->service_sale_no); ?></td>
                                            <td><?php echo e($item->customer->customer); ?></td>
                                            
                                            <td><?php echo e($item->mobile); ?></td>
                                            <td><?php echo e($item->item_dsc); ?></td>
                                            <td><?php echo e($item->unit); ?></td>
                                            <td><?php echo e($item->rate); ?></td>
                                            <td><?php echo e($item->total); ?></td>
                                            <td><?php echo e($item->grand_total); ?></td>
                                            <td class="d-flex">
                                            <a href="<?php echo e(route('admin.service_sales.details',$item->id)); ?>" class="btn btn-primary">View</a>
                                            <a href="<?php echo e(route('admin.service_sales_pdf',$item->id)); ?>" class="btn btn-success">PDF</a>
                                            <a href="<?php echo e(route('service_sale_remove',$item->id)); ?>" class="btn btn-danger">X</a>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/service_sale/list.blade.php ENDPATH**/ ?>