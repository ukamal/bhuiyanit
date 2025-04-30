<?php $__env->startSection('title', 'Service'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Service'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Service</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add New Service
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Project</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('store.service')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="head">Service Name</label>
                                                <input type="text" class="form-control" name="service_name" id="head"
                                                    placeholder="Project Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="head">Service Value</label>
                                                <input type="number" step="any" class="form-control" name="service_value" id="value"
                                                    placeholder="Ex: 12.56">
                                            </div>      
                                            <div class="form-group">
                                                <label for="head">Quantity</label>
                                                <input type="number" step="any" class="form-control" name="quantity" id="value"
                                                    placeholder="Ex: 12.56">
                                            </div>                               
                                            <div class="form-group">
                                                <label for="dsc">Description</label>
                                                <textarea class="form-control" id="dsc" name="service_dsc" rows="3"></textarea>
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
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e($item->service_name); ?></td>
                                            <td><?php echo e($item->service_value); ?></td>
                                            <td><?php echo e($item->quantity); ?></td>
                                            <td><?php echo e(Str::limit( $item->service_dsc, 20)); ?></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#edit_customer_modal<?php echo e($item->id); ?>" class="btn btn-primary"><i class="fa fa-pen-to-square" style="color: white"></i></a>
                                                <a href="<?php echo e(route('delete.service',$item->id)); ?>" onclick="return confirm('Are you sure delete this ')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                          <!-- Modal -->
                                          <div class="modal fade" id="edit_customer_modal<?php echo e($item->id); ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update New
                                                            Serive</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?php echo e(route('update.service',$item->id)); ?>" method="POST">
                                                        
                                                        <?php echo csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="head">Service Name</label>
                                                                    <input type="text" class="form-control" value="<?php echo e($item->service_name); ?>" name="service_name" id="head"
                                                                        placeholder="Project Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="head">Service Value</label>
                                                                    <input type="number" step="any" class="form-control" value="<?php echo e($item->service_value); ?>" name="service_value" id="value"
                                                                        placeholder="Ex: 12.56">
                                                                </div>      
                                                                <div class="form-group">
                                                                    <label for="head">Quantity</label>
                                                                    <input type="number" step="any" class="form-control" value="<?php echo e($item->quantity); ?>" name="quantity" id="value"
                                                                        placeholder="Ex: 12.56">
                                                                </div>                               
                                                                <div class="form-group">
                                                                    <label for="dsc">Description</label>
                                                                    <textarea class="form-control" id="dsc" name="service_dsc" rows="3"><?php echo e($item->service_dsc); ?></textarea>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/service/index.blade.php ENDPATH**/ ?>