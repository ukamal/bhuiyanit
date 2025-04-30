<?php $__env->startSection('title', 'Product'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/datatables.min.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page_title', 'Product List'); ?>
<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Product</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title mb-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#supplier_modal">
                                        Add New Product
                                    </button>
                                </h4>
                                <!-- Modal -->
                                <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo e(route('product.store')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="product_type">Product Category</label>
                                                        <select class="form-control" name="product_category" id="product_type_add">
                                                            <option value="">Select An Category </option>
                                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->category_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_type">Product Brand</label>
                                                        <select class="form-control" name="brand_id" id="brand_id">
                                                            <option selected disabled>Select Brand</option>
                                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($item->id); ?>"><?php echo e($item->brand_name); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dsc">Product Name</label>
                                                        <input type="text" class="form-control" name="product_name"
                                                            id="dsc" placeholder="Product Name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="code">Product Code</label>
                                                        <input type="text" class="form-control" name="code"
                                                            id="code" placeholder="code">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="unit">Unit</label>
                                                        <input type="text" class="form-control" name="unit"
                                                            id="unit" placeholder="Unit">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="color">Color</label>
                                                        <input type="text" class="form-control" name="color"
                                                            id="silver_rate_add" placeholder="Color">
                                                    </div>

                                                   
                                                    <div class="form-group">
                                                        <label for="other_rate_add">Rate</label>
                                                        <input type="text" class="form-control" name="rate"
                                                            id="other_rate_add" placeholder="Rate">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="<?php echo e(url('/admin/product')); ?>" method="GET">
                                    <div class="form-group d-flex">
                                        <select name="brand_id" class="form-control" id="">
                                            <option selected value="">Filter by Brand</option>
                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($search_brand == $sup->id): ?> <?php echo e('selected'); ?> <?php endif; ?>
                                                    value="<?php echo e($sup->id); ?>"><?php echo e($sup->brand_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Search Here .." value="<?php echo e($search); ?>">
                                        <button class="btn btn-info">Filter</button>
                                        <a href="<?php echo e(url('/admin/product')); ?>" class="btn btn-primary">Clear</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Product Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row"><?php echo e($key + 1); ?></th>
                                            <td><?php echo e($product->product_name); ?></td>
                                            <td><?php echo e($product->unit); ?></td>
                                            <td><?php echo e($product->code); ?></td>
                                            <td><?php echo e($product['category']['category_name']); ?></td>
                                            <td><?php echo e($product['brand']['brand_name']); ?></td>
                                            <td><?php echo e($product->color); ?></td>
                                            <td><?php echo e($product->rate); ?></td>
                                            <td>
                                                <div class="d-flex">
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#product_edit<?php echo e($product->id); ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <div class="modal fade" id="product_edit<?php echo e($product->id); ?>"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Product</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="<?php echo e(route('product.update', $product->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="modal-body">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="product_type">Select Category</label>
                                                                        <select class="form-control" name="product_category"
                                                                            id="product_category">
                                                                            <option selected value="0">Select Category
                                                                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            </option>
                                                                                <option
                                                                                    <?php if($sup->id == $product->product_category): ?> <?php echo e('selected'); ?> <?php endif; ?>
                                                                                    value="<?php echo e($sup->id); ?>">
                                                                                    <?php echo e($sup->category_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="product_type">Select Brand</label>
                                                                        <select class="form-control" name="brand_id"
                                                                            id="brand_id">
                                                                            <option selected value="0">Select Brand
                                                                            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            </option>
                                                                                <option
                                                                                    <?php if($sup->id == $product->brand_id): ?> <?php echo e('selected'); ?> <?php endif; ?>
                                                                                    value="<?php echo e($sup->id); ?>">
                                                                                    <?php echo e($sup->brand_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </div>
                                                                  
                                                                    <div class="form-group">
                                                                        <label for="dsc">Product Name</label>
                                                                        <input type="text"
                                                                            value="<?php echo e($product->product_name); ?>"
                                                                            class="form-control" name="product_name"
                                                                            id="dsc" placeholder="dsc">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="unit">Unit</label>
                                                                        <input type="text"
                                                                            value="<?php echo e($product->unit); ?>"
                                                                            class="form-control" name="unit"
                                                                            id="unit" placeholder="Unit">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="code">Code</label>
                                                                        <input type="text"
                                                                            value="<?php echo e($product->code); ?>"
                                                                            class="form-control" name="code"
                                                                            id="code" placeholder="code">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="silver_rate_edit">Color</label>
                                                                        <input type="text"
                                                                            value="<?php echo e($product->color); ?>"
                                                                            class="form-control" name="color"
                                                                            id="silver_rate_edit" placeholder="Color">
                                                                    </div>
                                                                 
                                                                    <div class="form-group">
                                                                        <label for="other_rate_edit">Rate</label>
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo e($product->rate); ?>"
                                                                            name="other_rate" id="other_rate_edit"
                                                                            placeholder="Rate">
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
                                                    data-target="#delete_modal<?php echo e($product->id); ?>">x</a>
                                                </div>

                                                <div class="modal fade" id="delete_modal<?php echo e($product->id); ?>"
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
                                                                <a href="<?php echo e(route('product.destroy', $product->id)); ?>"
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
    <script>
        $(document).ready(function() {
                     
            let glass_product_name  = $('#glass_product_name');
            let glass_product_code  = $('#glass_product_code');

            let grade  = $('#grade');


            glass_product_name.parent().hide();
            glass_product_code.parent().hide();
   

            $('#product_type_add').on('change', function(e) {
                let silver_rate = $('#silver_rate_add');
                let bronze_rate = $('#bronze_rate_add');
                let ss_rate     = $('#ss_rate_add');
                let other_rate  = $('#other_rate_add');
                let die  = $('#die');
                let dsc  = $('#dsc');
                let code  = $('#code');
                let unit  = $('#unit');

     
                if (e.target.value == 'Aluminium') {
                    silver_rate.parent().show();
                    bronze_rate.parent().show();
                    ss_rate.parent().show();
                    other_rate.parent().show();
                    die.parent().show();
                    dsc.parent().show();
                    code.parent().show();
                    unit.parent().show();
                    glass_product_name.parent().hide();
                    glass_product_code.parent().hide();

                }

                if (e.target.value == 'Glass') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().hide();
                    other_rate.parent().hide();
                    die.parent().hide();
                    dsc.parent().hide();
                    code.parent().hide();
                    unit.parent().hide();
                    grade.parent().hide();

                    glass_product_name.parent().show();
                    glass_product_code.parent().show();
        
                }

                if (e.target.value == 'SS') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().show();
                    other_rate.parent().show();
                    die.parent().show();
                    dsc.parent().show();
                    code.parent().show();
                    unit.parent().show();
                    grade.parent().hide();

                    glass_product_name.parent().hide();
                    glass_product_code.parent().hide();
       
                }
            });


            $('#product_type_edit').on('change', function(e) {
                let silver_rate = $('#silver_rate_edit');
                let bronze_rate = $('#bronze_rate_edit');
                let ss_rate     = $('#ss_rate_edit');
                let other_rate  = $('#other_rate_edit');
                
                
                if (e.target.value == 'Aluminium') {
                    silver_rate.parent().show();
                    bronze_rate.parent().show();
                    ss_rate.parent().show();
                }

                if (e.target.value == 'Glass') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().hide();
                    grade.parent().hide();

                    
                    silver_rate.val(' ');
                    bronze_rate.val(' ');
                    ss_rate.val(' ');
                }

                if (e.target.value == 'SS') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().show();
                    grade.parent().hide();


                    silver_rate.val(' ');
                    bronze_rate.val(' ');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/admin/product/index.blade.php ENDPATH**/ ?>