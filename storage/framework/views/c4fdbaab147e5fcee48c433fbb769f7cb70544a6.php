<?php $__env->startSection('title','Login'); ?>
<?php $__env->startSection('content'); ?>
<div class="logo">
    <a href="index.html"><img src="../assets/pages/img/logo-big.png" alt="" /> </a>
</div>
<div class="content">
    <form class="login-form" method="POST" action="<?php echo e(route('login')); ?>"><?php echo e(csrf_field()); ?>

        <h3 class="form-title">Sign In</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email Address</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email Address" name="email" value="<?php echo e(old('email')); ?>" required autofocus/> 
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> 
            <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn green uppercase">Login</button>
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" />Remember
                <span></span>
            </label>
            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
        </div>
        <div class="create-account">
            <p><a href="<?php echo e(URL::route('register')); ?>" id="register-btn" class="uppercase">Create an account</a></p>
        </div>
    </form>
    <form class="forget-form" action="#" method="POST">
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> 
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
</div>
<div class="copyright"> Powered By: <a href="https:://www.codemansion.org">CodeMansion Technology</a> </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>