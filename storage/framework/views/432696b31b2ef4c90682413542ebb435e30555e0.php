<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(env('APP_NAME')); ?></title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="<?php echo e(asset('backend/dist-assets/css/themes/lite-purple.min.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body>
    <div class="auth-layout-wrap" style="background-image: url(<?php echo e(asset('backend/dist-assets/images/photo-wide-4.jpg')); ?>)">
        <div class="auth-content">
            <div class="card o-hidden">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
    <?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>
<?php /**PATH /home/user/remote/webbysys/bhuiyanit/resources/views/layouts/auth_master.blade.php ENDPATH**/ ?>