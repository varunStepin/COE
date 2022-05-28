<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $this->webroot ?>images/logo/nain_logo.png">

    <title>COE</title>

    <!-- Bootstrap 4.0-->
    <?php echo $this->Html->css('../assets/vendor_components/bootstrap/dist/css/bootstrap.min');?>

    <!-- Bootstrap extend-->
    <?php echo $this->Html->css('bootstrap-extend');?>

    <!-- Theme style -->
    <?php echo $this->Html->css('master_style');?>
    <?php echo $this->Html->css('custom');?>

    <!-- Fab Admin skins -->
    <?php echo $this->Html->css('skins/_all-skins');?>
    <link rel="stylesheet" href="../../css/skins/_all-skins.css">

    <?php echo $this->Html->script('../assets/vendor_components/jquery-3.3.1/jquery-3.3.1.min');?>
    <!-- popper -->
    <?php echo $this->Html->script('../assets/vendor_components/popper/dist/popper.min');?>
    <!-- Bootstrap 4.0-->
    <?php echo $this->Html->script('../assets/vendor_components/bootstrap/dist/js/bootstrap.min');?>

    <style>

    </style>
</head>
<body class="hold-transition login-page">
 <?php echo $this->fetch('content');?>
</body>
</html>
