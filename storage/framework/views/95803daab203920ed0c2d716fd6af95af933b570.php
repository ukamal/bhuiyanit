
<?php $__env->startSection('title', 'Add Category'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Add Category'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Add Category</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add New Category
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('category.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="category_name">Category Name</label>
                                                <input type="text" required class="form-control" name="category_name"
                                                    id="name" aria-describedby="emailHelp" placeholder="Category Name">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="zero_configuration_table"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $i = 1
                                        ?>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($item->category_name); ?></td>
                                        <td>
                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                            data-target="#delete_modal<?php echo e($item->id); ?>">x</a>
                                            <div class="modal fade" id="delete_modal<?php echo e($item->id); ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                            <div class="modal-body">
                                                                Are You Sure You Want To Delete This?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                    <form action="<?php echo e(route('category.destroy',$item->id)); ?>" method="post">
                                                                        <input class="btn btn-danger" type="submit" value="Delete" />
                                                                       
                                                                        <?php echo csrf_field(); ?>
                                                                    </form>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#edit_supplier_modal<?php echo e($item->id); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edit_supplier_modal<?php echo e($item->id); ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update
                                                                Category</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?php echo e(route('category.update',$item->id)); ?>" method="POST">
                                                        
                                                            <?php echo csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Category Name</label>
                                                                    <input type="text" required
                                                                        class="form-control" value="<?php echo e($item->category_name); ?>" name="category_name"
                                                                        id="name" aria-describedby="emailHelp"
                                                                        placeholder="">

                                                                </div>
                                                                
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/category/index.blade.php ENDPATH**/ ?>