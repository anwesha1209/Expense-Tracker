<?php global $s_v_data; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Income and Expense tracker for business and personal use.">
    <meta name="author" content="Simcy Creative">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=  asset('uploads/app/'.env('APP_ICON')) ; ?>">
    <title>Hellaplus | Income and Expense tracker for business and personal use.</title>
    <!-- Material design icons -->
    <link href="<?=  asset('assets/fonts/mdi/css/materialdesignicons.min.css') ; ?>" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="<?=  asset('assets/libs/bootstrap/css/bootstrap.css') ; ?>" rel="stylesheet">
    <link href="<?=  asset('assets/css/simcify.min.css') ; ?>" rel="stylesheet">
    <!-- Signer CSS -->
    <link href="<?=  asset('assets/css/style.css') ; ?>" rel="stylesheet">
</head>
<body>


<div class="auth-page">
        <div class="auth-card card">
            <div class="auth-logo">
                <img src="<?=  asset('uploads/app/'.env('APP_LOGO')) ; ?>" class="img-responsive">
            </div>
            <div class="login">
                <div class="auth-heading mt-15">
                    <h2>Welcome Back</h2>
                    <p>A beatiful and powerful system crafted specifically for income and expense.</p>
                </div>
                <div class="auth-form">
                    <form class="simcy-form" action="<?=  url('Auth@signin') ; ?>" data-parsley-validate="" method="POST" loader="true">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" value="demo@simcycreative.com" placeholder="Email Address" required="">
                                    <input type="hidden" name="csrf-token" value="<?= csrf_token(); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" value="passqw" placeholder="Password" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                  <a href="" class="auth-switch pull-right mt-10 text-muted text-thin" show=".forgot">Forgot Password?</a>
                                 
                                    <button type="submit" class="btn btn-primary">Login Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if ( env('NEW_ACCOUNTS') == "Enabled" ) { ?> 
                <div class="">
                  <p class="text-muted text-thin mt-40">Dont's have an account <a href="" class="auth-switch text-primary" show=".register">Create an account</a></p>
                </div>
                <?php } ?>
            </div>
            <div class="forgot">
                <div class="auth-heading mt-15">
                    <h2>Forgot password</h2>
                    <p>Don't worry if you forgot your password, enter your email and you can reset it.</p>
                </div>
                <div class="auth-form">
                    <form class="simcy-form" action="<?=  url('Auth@forgot') ; ?>" data-parsley-validate="" method="POST" loader="true">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required="">
                                    <input type="hidden" name="csrf-token" value="<?= csrf_token(); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-block">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="">
                  <p class="text-muted text-thin mt-40">Remembered your password? <a href="" class="auth-switch text-primary" show=".login">Login Now</a></p>
                </div>
            </div>
            <?php if ( env('NEW_ACCOUNTS') == "Enabled" ) { ?> 
            <div class="register">
                <div class="auth-heading mt-15">
                    <h2>Create an account</h2>
                    <p>A beatiful and powerful system crafted specifically for expense and income tracking.</p>
                </div>
                <div class="auth-form">
                    <form class="simcy-form" action="<?=  url('Auth@signup') ; ?>"  data-parsley-validate="" method="POST" loader="true">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="fname" placeholder="First Name" required="">
                                    <input type="hidden" name="csrf-token" value="<?= csrf_token(); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="lname" placeholder="Last Name" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-block">Create Account</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="">
                  <p class="text-muted text-thin mt-40">Already have an account? <a href="" class="auth-switch text-primary" show=".login">Login Now</a></p>
                </div>
            </div>
            <?php } ?>
    </div>
    <p class="copyright text-thin text-muted"> &copy; <?=  date("Y") ; ?> <?=  env("APP_NAME") ; ?> <span>•</span> All Rights Reserved.</p>
</div>

    <!-- scripts -->
    <script src="<?= asset('assets/js/jquery-3.2.1.min.js'); ?>"></script>
    <script src="<?= asset('assets/libs/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js//jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/simcify.min.js'); ?>"></script>
    <!-- custom scripts -->
    <script src="<?= asset('assets/js/app.js'); ?>"></script>
</body>
</html>

<?php return;
