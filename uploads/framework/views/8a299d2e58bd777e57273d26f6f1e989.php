<?php global $s_v_data, $user, $title, $timezones, $currencies, $accounts, $categories; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Income and Expense tracker for business and personal use.">
    <meta name="author" content="Simcy Creative">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=  asset('uploads/app/'.env('APP_ICON')) ; ?>">
    <title><?=  $title ; ?> | Income and Expense tracker for business and personal use.</title>

    <link href="<?=  asset('assets/libs/slider/css/bootstrap-slider.min.css') ; ?>" rel="stylesheet"/>
    <link href="<?=  asset('assets/libs/daterangepicker/daterangepicker.css') ; ?>" rel="stylesheet"/>
    <!-- Material design icons -->
    <link href="<?=  asset('assets/fonts/mdi/css/materialdesignicons.min.css') ; ?>" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="<?=  asset('assets/libs/bootstrap/css/bootstrap.css') ; ?>" rel="stylesheet">
    <link href="<?=  asset('assets/css/simcify.min.css') ; ?>" rel="stylesheet">
    <!-- Signer CSS -->
    <link href="<?=  asset('assets/css/style.css') ; ?>" rel="stylesheet">
</head>

<?php return;
