<?php $__env->startSection('title', 'Bank'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Bank List'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Bank</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add New Bank
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Bank</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('bank.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="prev_amount">Previews Amount</label>
                                                        <input type="text" value=""
                                                            class="form-control" name="prev_amount" id="prev_amount"
                                                            aria-describedby="emailHelp" placeholder="00.00">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="die">Bank Name</label>
                                                <input type="text" required class="form-control" name="bank_name"
                                                    id="die" aria-describedby="emailHelp" placeholder="">

                                            </div>
                                            <div class="form-group">
                                                <label for="dsc">Account Number</label>
                                                <input type="text" class="form-control" name="account_number"
                                                    id="dsc" placeholder="Account Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="unit">Account Name</label>
                                                <input type="text" class="form-control" name="account_name"
                                                    id="unit" placeholder="Account Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="bank_description">Bank Description</label>
                                                <textarea class="form-control" name="bank_description" id="bank_description" rows="3"></textarea>
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
                                        <th scope="col">Bank Name</th>
                                        <th scope="col">Account Name</th>
                                        <th scope="col">Account Number</th>
                                        <th scope="col">Previews Amount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e($bank->name); ?></td>
                                            <td><?php echo e($bank->acount_name); ?></td>
                                            <td><?php echo e($bank->acount_number); ?></td>
                                            <td><?php echo e($bank->prev_amount); ?></td>
                                            <td><?php echo e($bank->description); ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#product_edit<?php echo e($bank->id); ?>">Edit</a>

                                                <div class="modal fade" id="product_edit<?php echo e($bank->id); ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Bank</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="<?php echo e(route('bank.update', $bank->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-lg-6"></div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="prev_amount">Previews
                                                                                    Amount</label>
                                                                                <input type="text"
                                                                                    value="<?php echo e($bank->prev_amount); ?>"
                                                                                    class="form-control"
                                                                                    name="prev_amount" id="prev_amount"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="00.00">

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="die">Bank Name</label>
                                                                        <input type="text" value="<?php echo e($bank->name); ?>"
                                                                            required class="form-control" name="bank_name"
                                                                            id="die" aria-describedby="emailHelp"
                                                                            placeholder="">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="dsc">Account Number</label>
                                                                        <input type="text"
                                                                            value="<?php echo e($bank->acount_number); ?>"
                                                                            class="form-control" name="account_number"
                                                                            id="dsc" placeholder="Account Number">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="unit">Account Name</label>
                                                                        <input type="text"
                                                                            value="<?php echo e($bank->acount_name); ?>"
                                                                            class="form-control" name="account_name"
                                                                            id="unit" placeholder="Account Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="bank_description">Bank
                                                                            Description</label>
                                                                        <textarea class="form-control" name="bank_description" id="bank_description" rows="3"><?php echo e($bank->description); ?></textarea>
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



                                                <a href="#" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete_modal<?php echo e($bank->id); ?>">x</a>
                                                <div class="modal fade" id="delete_modal<?php echo e($bank->id); ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                Are You Sure You Want To Delete This?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <a href="<?php echo e(route('bank.destroy', $bank->id)); ?>"
                                                                    class="btn btn-danger">Delete</a>
                                                            </div>
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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/bank/bank.blade.php ENDPATH**/ ?>