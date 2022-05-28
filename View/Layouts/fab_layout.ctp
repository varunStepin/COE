<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $this->webroot ?>images/favicon.ico">
<?php header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure'); ?>
    <title>COE</title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?php echo $this->webroot ?>assets/vendor_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $this->webroot ?>assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="<?php echo $this->webroot ?>css/bootstrap-extend.css">

    <!-- theme style -->
    <link rel="stylesheet" href="<?php echo $this->webroot ?>css/master_style.css">


    <!-- Fab Admin skins -->
    <link rel="stylesheet" href="<?php echo $this->webroot ?>css/skins/_all-skins.css">


    <link href="<?php echo $this->webroot ?>assets/vendor_components/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Morris charts -->
    <link rel="stylesheet" href="<?php echo $this->webroot ?>assets/vendor_components/morris.js/morris.css">
    <link rel="stylesheet" href="<?php echo $this->webroot ?>css/custom.css">
    <!--=====================================================================-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- jQuery 3 -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/jquery-ui/jquery-ui.js"></script>
<!--preloader-->
<!--<div id="preloader">
   <div id="status"></div>
</div>-->
<!-- Site wrapper -->

<div class="wrapper">
    <?php

    $full__url = "https://" . $_SERVER['HTTP_HOST'] . $this->request->here; 
    if($this->Session->read('USER_TYPE')=='Admin'){
        echo $this->Element('header_part');
        echo $this->Element('side_bar');
        echo $this->fetch('content');
        echo $this->Element('footer_part');
    }
   else if($this->Session->read('USER_TYPE')){
        echo $this->Element('header_part');
        echo $this->Element('side_bar');
        echo $this->fetch('content');
        echo $this->Element('footer_part');
    }
    ?>
    <?php echo $this->Session->flash(); ?>
</div>







<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- popper -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/popper/dist/popper.min.js"></script>

<!-- Bootstrap 4.0-->
<script src="<?php echo $this->webroot ?>assets/vendor_components/bootstrap/dist/js/bootstrap.js"></script>
<!-- Bootstrap 4.0-->
<script src="<?php echo $this->webroot ?>assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- ChartJS -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/chart.js-master/Chart.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- FastClick -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/fastclick/lib/fastclick.js"></script>

<!-- peity -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/jquery.peity/jquery.peity.js"></script>

<!-- Morris.js charts -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/raphael/raphael.min.js"></script>
<script src="<?php echo $this->webroot ?>assets/vendor_components/morris.js/morris.min.js"></script>

<!-- Fab Admin App -->
<script src="<?php echo $this->webroot ?>js/template.js"></script>



<!-- Fab Admin for demo purposes -->
<script src="<?php echo $this->webroot ?>js/demo.js"></script>



<!-- This is data table -->
<script src="<?php echo $this->webroot ?>assets/vendor_components/datatable/datatables.min.js"></script>


<script src="<?php echo $this->webroot ?>js/pages/validation.js"></script>
<script src="<?php echo $this->webroot ?>js/global_custom.js"></script>
<script>
    $(document).ready(function(){
        $("#php-alert").delay(3500).hide(800);
    });
     $(".mobileNo").keypress(function (e) {
        var mob=$(this).val()
        if(mob.length>9){
            //$('<p  style="position: absolute; left: 30px;"  class="text-danger error-class">10 Digits Only</p>').insertAfter(this).fadeOut("slow", function(){ $(".error-class").remove();});
            return false;
        }

        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
           // $('<p  style="position: absolute; left: 30px;"  class="text-danger error-class">Digits Only</p>').insertAfter(this).fadeOut("slow", function(){ $(".error-class").remove();});
            return false;
        }
    });
      $(".isNumber").keypress(function (e) {
       // console.log('hai');
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            // $('<p  style="position: absolute; left: 30px;"  class="text-danger error-class">Digits Only</p>').insertAfter(this).fadeOut("slow", function(){ $(".error-class").remove();});
            // $("#errmsg").html("Digits Only").show().fadeOut("slow");
            return false;
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        var url ='<?php echo  $full__url?>';
        var arr=url.split("/");
        var data = arr[arr.length-1];
        $('ul.sidebar-menu a[href="'+ data +'"]').parent().addClass('active');
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parents().addClass('active');
        $('li.dropdown').parent().removeClass('active');

    });
    function addCsrfToken() {
        $('#csrftoken').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
       // return true;   // Returns Value
    }
    function changeApplication(type) {
        $.ajax({
            type: "POST",
            url: '<?php echo Router::url(array("controller" => "Home", "action" => "changeApplication")); ?>' ,
            data: {type},
            cache: false,
            success: function(html) {
                window.location='<?php echo Router::url(array("controller" => "Admin", "action" => "dashboard")); ?>';
            }
        });
    }
</script>
</body>

</html>
