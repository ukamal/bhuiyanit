<?php $__env->startSection('title', 'Purchase List'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Purchase List'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Purchase List</h4>
                        <div>
                            <table class="table" id="zero_configuration_table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Purchase No</th>
                                        <th scope="col">Supplier Name</th>
                                        <th scope="col">Grand Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($item->purchase_date); ?></td>
                                        <td><?php echo e($item->purchase_no); ?></td>
                                        <td><?php echo e($item['supplier']['name']); ?></td>
                                        <td><?php echo e($item->grandTotal); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('purchase_details',$item->id)); ?>" class="btn btn-primary">View</a>
                                            <a href="<?php echo e(route('purchase_pdf',$item->id)); ?>" class="btn btn-success">Bill Print</a>
                                            <a href="<?php echo e(route('remove_purchase',$item->id)); ?>" class="btn btn-danger">X</a>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/remote/webbysys/bhuiyanit/resources/views/admin/purchase/purchase_list.blade.php ENDPATH**/ ?>