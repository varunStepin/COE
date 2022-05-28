<style>
    .height-36{
        height: 36px;
        font-weight: bold;
    }
    .bg-1{

        border: 1px #395ebd solid;

    }
    .bg-2{
        border: 1px #2a7a21 solid;
      /*  background-image: linear-gradient(180deg, #84e27d, #c4e297);
        color: #2a7a21;*/
    }
    .bg-3{
        border: 1px #992b4f solid;
       /* background-image: linear-gradient(180deg, #ff9b9b, #ffb9d3);
        color: #992b4f;*/
    }
    .bg-4{
        border: 1px #8c5631 solid;
       /* background-image: linear-gradient(180deg, #ffb07f, #fdd9a5);
        color: #8c5631;*/
    }
    .bg-5{

        border: 1px #395ebd solid;
        color: #67757c !important;
    }
    .bg-6{
        border: 1px #2a7a21 solid;
        color: #67757c !important;
    }
    .bg-7{
        border: 1px #992b4f solid;
        color: #67757c !important;
    }
    .bg-8{
        border: 1px #8c5631 solid;
        color: #67757c !important;
    }

    .box-body{
        cursor: pointer;
    }
    .amount_in{
        font-size: 14px;
    }
    .card-image{
        position: absolute;
        max-width: 200px;
        margin-right: 10px;
    }
    .hidden{
        display: none;
    }
    .highcharts-credits{
        display: none;
    }
    <?php if($this->Session->read('USER_TYPE')!='Admin'){?>
    .showExpense{
        display: none;
    }
    <?php } ?>

</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ol>
    </section>
    <section class="content mainCards">
        <div class="row cards">
            <div class="col-xl-3 col-md-6 col-12 px-5" onclick="openDashboard('CIF')">
                <div class="box box-body bg-1 bg-2 pt-25 pb-25" style="cursor: pointer;display:block;width:100%;height:100px;  ">
                    <img class="card-image-center" src="<?php echo $this->webroot ?>images/CENSE.jpg">
                </div>
            </div>
        </div>
        <div class="row chart hidden" style="margin-top:-20px;">
            <div class="col-12">
                <div class="box">
                    <div class=" box-header with-border">
                        <h4 class="box-title text-info">K-Tech Innovation Hub - CIF </h4>
                        <a href="javascript:void(0)" onclick="closeDashboard()" class="showExpense btn btn-info btn-sm pull-right"><span>Back</span></a>
                    </div>
                    <div class="box-body chart-body">
                        <div class="chart-div" id="chartCIF" style="width:100%;height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal center-modal fade" id="ExpenseDetails">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="ExpenseDetailsContent">
            <!-- <div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
                <h5 class="box-title text-white"> </h5>
            </div> -->
            <!-- <div class="modal-body " id="ExpenseDetailsContent"></div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>

<script>
    function openDashboard(type){
        if(type=='CIF')
            url  = "<?= $this->html->url(array('controller'=>'Cif','action'=>'cifDashboard')) ?>";

        window.location.href = url;
    }
</script>
<style>
    .font-size-30 {
    font-size: 22px !important;
    line-height: 1.2;
    }
    @media (max-width: 1514px){
        .font-size-30 {
            font-size: 18px !important;
            line-height: 1.2;
        }
    }
    @media (max-width: 1412px){
        .font-size-30 {
            font-size: 12px !important;
            line-height: 1.2;
        }
    }
    @media (min-width:1170px) {
        .finance_section{
            margin-top:-65px!important;
        }

    }
    @media (min-width:991px) and (max-width:1169px){
        .finance_section{
            margin-top:-10px!important;
        }
    }
</style>
<?= $this->element('cssJs/charts'); ?>
<script>
    $(function () {
        var colors1 = ['#89adff','#FFB583','#fb5965'];

        try {

        }catch (e) {
            console.log(e)
            $('#training').html('<h3 class="no-data"> No Fund Details for  <?= $types ?> </h3>')

        }
    });
</script>
<script>
    var final_array = <?= $finalArray ?>;
    var userLoginType='<?= $this->Session->read('USER_TYPE') ?>';
    if(userLoginType=='CIF'){
        openDashboard('CIF');
    }
    
</script>