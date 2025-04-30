
<?php $__env->startSection('title', 'Package'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Package'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Package</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add New Package
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Package</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('store.packege')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="head">Packege Name</label>
                                                <input type="text" class="form-control" name="packege_name" id="head"
                                                    placeholder="Project Name">
                                                    <?php $__errorArgs = ['packege_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="head">Select Service</label>
                                                <!-- <select name="service_id" id="" class="select form-control" style="width: 200px;">
                                                    <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->service_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select> -->

                                            <div class="d-flex">
                                                <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div style="margin-right: 10px;">
                                                        <input type="checkbox" name="service_id[]" value="<?php echo e($item->id); ?>">
                                                        <label><?php echo e($item->service_name); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php $__errorArgs = ['service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                            </div>

                                            <div class="form-group">
                                                <label for="head">Packege Value</label>
                                                <input type="number" step="any" class="form-control" name="packege_value" id="value"
                                                    placeholder="Ex: 12.56">
                                                    <?php $__errorArgs = ['packege_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="die">Select Currency</label>
                                                <select name="currency" class="form-control" id="">
                                                    <option value="bdt">BDT</option>
                                                    <option value="usd">USD</option>
                                                    <option value="aed">AED</option>
                                                </select>
                                                <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="head">Packege Share</label>
                                                <input type="number" class="form-control" name="packege_share" id="share"
                                                    placeholder="Ex: 45">
                                            </div> -->
                                            <div class="form-group">
                                                <label for="dsc">Description</label>
                                                <textarea class="form-control" id="dsc" name="packege_dsc" rows="3"></textarea>
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
                                        <th scope="col">Share</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e($project->packege_name); ?></td>
                                            <td><?php echo e($project->packege_value); ?></td>
                                            <td><?php echo e($project->packege_share); ?></td>
                                            
                                          
                                            <td>
                                                <?php if($project->services && $project->services->count() > 0): ?>
                                                    <?php $__currentLoopData = $project->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php echo e($service->service_name); ?>,
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    No services
                                                <?php endif; ?>
                                            </td>


                                            <td><?php echo e($project->currency); ?></td>
                                            <td><?php echo e(Str::limit($project->packege_dsc, 20)); ?></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#edit_customer_modal<?php echo e($project->id); ?>" class="btn btn-primary"><i class="fa fa-pen-to-square" style="color: white"></i></a>
                                                <a href="<?php echo e(route('delete.package',$project->id)); ?>" onclick="return confirm('Are you sure delete this ')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                           <!-- Modal -->
                                           <div class="modal fade" id="edit_customer_modal<?php echo e($project->id); ?>" tabindex="-1"
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
                                                    <form action="<?php echo e(route('update.package',$project->id)); ?>" method="POST">
                                                        
                                                        <?php echo csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="head">Packege Name</label>
                                                                <input type="text" class="form-control" value="<?php echo e($project->packege_name); ?>" name="packege_name" id="head"
                                                                    placeholder="Project Name">
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="head">Select Service</label>
                                                            


                                                           



                                                            </div>

                                                            <div class="form-group">
                                                                <label for="head">Packege Value</label>
                                                                <input type="number" step="any" class="form-control" value="<?php echo e($project->packege_value); ?>" name="packege_value" id="value"
                                                                    placeholder="Ex: 12.56">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="die">Select Currency</label>
                                                                <select name="currency" class="form-control" id="">
                                                                    <option value="bdt"><?php echo e($project->currency); ?></option>
                                                                    <option value="usd">USD</option>
                                                                    <option value="aed">AED</option>
                                                                </select>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="head">Packege Share</label>
                                                                <input type="number" class="form-control" value="<?php echo e($project->packege_share); ?>" name="packege_share" id="share"
                                                                    placeholder="Ex: 45">
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label for="dsc">Description</label>
                                                                <textarea class="form-control" id="dsc"  name="packege_dsc" rows="3"><?php echo e($project->packege_dsc); ?></textarea>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/package/package.blade.php ENDPATH**/ ?>