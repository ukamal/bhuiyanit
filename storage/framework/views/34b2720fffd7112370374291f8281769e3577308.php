<?php $__env->startSection('title', 'Stock List'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Stock List'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body ">
                        <h4 class="card-title mb-3">Stock List</h4>
                        
                        <table class="table table-bordered" id="zero_configuration_table">
                            <thead class="bg-dark">
                                <tr class="text-white text-center">
                                    <th scope="col">Sl</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Items</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Colour</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <th scope="row"><?php echo e($key + 1); ?></th>
                                        <th><?php echo e($product->code); ?></th>
                                        <td><?php echo e($product->category ? $product->category->category_name : 'N/A'); ?></td>
                                        <td> <?php echo e($product->product_name); ?></td>
                                        <td> <?php echo e($product['brand']['brand_name']); ?></td>
                                        <td> <?php echo e($product->color); ?></td>
                                        
                                        <td>
                                            <?php
                                                $totalQtyPurchased = 0;
                                            ?>

                                            <?php $__currentLoopData = $product->purchaseDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchaseDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $totalQtyPurchased += $purchaseDetail->qty;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php echo e($totalQtyPurchased); ?>

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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('backend/dist-assets/js/plugins/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/datatables.script.min.js')); ?>"></script>
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/stock/stock_list1.blade.php ENDPATH**/ ?>