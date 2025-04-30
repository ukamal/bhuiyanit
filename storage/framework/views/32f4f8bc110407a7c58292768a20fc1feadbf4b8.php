<?php $__env->startSection('content'); ?>

<div class="page-wrapper">
   <div class="page-content">
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
         <div class="breadcrumb-title pe-3">Brand</div>
         <div class="ps-3">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">All Brand</li>
               </ol>
            </nav>
         </div>
      </div>
      <!--end breadcrumb-->

     <div class="d-flex justify-content-between">
            <h6 class="mb-0 text-uppercase">Brand List</h6>
            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#addBrand">
            Add Brand
            </a>

     </div>
    
      <hr>
      <div class="card">
         <div class="card-body">
            <div class="table-responsive">
               <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                 
                  <div class="row">
                     <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                           <thead>
                              <tr role="row">
                                 <th>Sl</th>
                                 <th>Brand Name</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr role="row" class="odd">
                                          <td><?php echo e($key+1); ?></td>
                                          <td><?php echo e($item->brand_name); ?></td>
                                          <td>
                                                <a data-toggle="modal" data-target="#editBrand<?php echo e($item->id); ?>" title="edit" class="btn btn-primary btn-sm text-white">Eidt</a>
                                                <a href="<?php echo e(route('delete_brand',$item->id)); ?>" id="delete" title="delete" class="btn btn-danger btn-sm">Delete</a>
                                          </td>
                                    </tr>
                                    
                                    <!-- Edit Coupon Modal -->
                                    <div class="modal fade" id="editBrand<?php echo e($item->id); ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                                          <div class="modal-dialog modal-md modal-dialog-centered">
                                                <div class="modal-content">
                                                      <div class="modal-header">
                                                            <h5 class="modal-title text-dark">Edit Brand</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                            <form action="<?php echo e(route('update_brand',$item->id)); ?>" method="post">
                                                                  <?php echo csrf_field(); ?>

                                                                  <div class="modal-body text-dark">

                                                                  <div class="col-md-12">
                                                                        <label for="name">Brand Name</label>
                                                                        <input type="text" name="brand_name" value="<?php echo e($item->brand_name); ?>" id="name" class="form-control">
                                                                  </div>

                                                                  </div>
                                                                  <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-dark" id="updateCoupon">Update</button>
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
   </div>
</div>


<!-- Add Coupon Modal -->
<div class="modal fade" id="addBrand" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title text-dark">Add Brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
               <form action="<?php echo e(route('store_brand')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <div class="modal-body text-dark">

                    <div class="col-md-12">
                        <label for="name">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" placeholder="Enter Brand Name">
                        <?php $__errorArgs = ['brand_name'];
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

                   </div>
                   <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-dark">Save changes</button>
                   </div>
               </form>
            </div>
      </div>
</div>

 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/brand/view_brand.blade.php ENDPATH**/ ?>