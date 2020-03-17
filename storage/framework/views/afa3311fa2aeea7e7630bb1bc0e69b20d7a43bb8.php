<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<?php echo $__env->make('partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</head>
    <body>
        <div id="app">
            <?php echo $__env->make('layouts.nav_loggedin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!--References layout/nav.blade/php which is the navigation header-->
            <?php echo $__env->make('layouts.modal_loggedin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>


        </div>
        <script type="text/javascript" src="<?php echo e(URL::asset('js/app.js')); ?>"></script>
    </body>
</html>
<?php /**PATH /home/nwd/Desktop/Nozy/resources/views/layouts/welcome_loggedin.blade.php ENDPATH**/ ?>