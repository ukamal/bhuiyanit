<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(env('APP_NAME')); ?> | <?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="<?php echo e(asset('backend/dist-assets/css/themes/lite-purple.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('backend/dist-assets/css/plugins/perfect-scrollbar.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist-assets/css/plugins/fontawesome-5.css')); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo e(asset('backend/dist-assets/css/plugins/metisMenu.min.css')); ?>" rel="stylesheet" />
    
    
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">
        <?php echo $__env->make('layouts.backend.parts.left_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="switch-overlay"></div>
        <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
            <?php echo $__env->make('layouts.backend.parts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- ============ Body content start ============= -->
            <div class="main-content pt-4">
                <div class="breadcrumb">
                    <h1><?php echo $__env->yieldContent('page_title'); ?></h1>
                    
                </div>
                <div class="separator-breadcrumb border-top"></div><!-- end of main-content -->
            </div>
            <?php echo $__env->yieldContent('content'); ?>
            <div class="sidebar-overlay open">
            </div><!-- Footer Start -->
            <div class="flex-grow-1"></div>

            <!-- fotter end -->
        </div>
    </div>
    <!-- ============ Search UI End ============= -->
    <script src="<?php echo e(asset('backend/dist-assets/js/plugins/jquery-3.3.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/plugins/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/tooltip.script.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/script.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/script_2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/sidebar.large.script.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/plugins/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/plugins/metisMenu.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/handlebars.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="<?php echo e(asset('backend/dist-assets/js/scripts/layout-sidebar-vertical.min.js')); ?>"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    Toastr::message()
    
    <script>
        function get_customer() {
            var customer_id = $('#customer').val();
            $.ajax({
                url: "/admin/customer/get/" + customer_id,
                type: "get",
                success: function(res) {
                    $('#customer_mobile').val(res.phone)
                    $('#customer_address').val(res.address)
                }
            });
        }

        function get_supplier() {
            var supplier_id = $('#supplier').val();
            $.ajax({
                url: "/admin/supplier/get/" + supplier_id,
                type: "get",
                success: function(res) {
                    console.log(res);
                    $('#supplier_mobile').val(res.phone)
                    $('#supplier_address').val(res.address)
                }
            });
        }

    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <?php echo $__env->yieldPushContent('js'); ?>

    <?php echo $__env->yieldPushContent('vue-js'); ?>


    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();
    });
    </script>

</body>

</html>
<?php /**PATH /home/user/backup-projets/bhuiyanit/resources/views/layouts/backend/master.blade.php ENDPATH**/ ?>