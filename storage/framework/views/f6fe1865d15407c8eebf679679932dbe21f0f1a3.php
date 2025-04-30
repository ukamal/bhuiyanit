<?php $__env->startSection('title', 'Bank Transaction'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Bank Transaction List'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Bank Transaction</h4>
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                    Withdraw/Deposit
                                </button>
                            </h4>
                            <form action="" method="GET" class="form-group d-flex">
                                <select name="bank_filter" class="w-auto form-control">
                                    <option value="0">Filter By Bank</option>
                                    <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($bank->id); ?>"><?php echo e($bank->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button class="form-control btn btn-info" > Filter </button>
                                <a class="btn btn-primary form-control" href="<?php echo e(url('admin/bank/transaction')); ?>">Clear</a>
                            </form>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Deposit/withdraw</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('admin.transaction.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="die">Select Status</label>
                                                        <select name="status" class="form-control" id="">
                                                            <option value="deposit">Deposit</option>
                                                            <option value="withdraw">Withdraw</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="date">Date</label>
                                                        <input type="date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control"
                                                            name="date" id="date" aria-describedby="emailHelp">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="text" value="" class="form-control"
                                                            name="amount" id="amount" aria-describedby="emailHelp"
                                                            placeholder="00.00">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="die">Select Bank</label>
                                                <select name="bank" class="form-control" id="">
                                                    <?php $__currentLoopData = $banks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($bank->id); ?>"><?php echo e($bank->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="bank_description">Description</label>
                                                <textarea class="form-control" name="description" id="bank_description" rows="3"></textarea>
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
                                        <th scope="col">Date</th>
                                        <th scope="col">Bank</th>
                                        <th scope="col">Deposit</th>
                                        <th scope="col">Withdraw</th>
                                        <th scope="col">Blanced</th>
                                        <th scope="col">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $blanced = 0;
                                    ?>
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e(date('d-M-y', strtotime($transaction->transaction_date))); ?></td>
                                            <td><?php echo e($transaction->bank->name); ?></td>
                                            <td>
                                                <?php if($transaction->status == 'deposit' || $transaction->status == 'prev'): ?>
                                                    <?php echo e($transaction->amount); ?>

                                                    <?php
                                                        $blanced += $transaction->amount;
                                                    ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($transaction->status == 'withdraw'): ?>
                                                    <?php echo e($transaction->amount); ?>

                                                    <?php
                                                        $blanced = $blanced - $transaction->amount;
                                                    ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e($blanced); ?>

                                            </td>
                                            <td><?php echo e($transaction->remarks); ?></td>

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

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/bank/bank_transaction.blade.php ENDPATH**/ ?>