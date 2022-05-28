<style>
    .height-36 {
        height: 36px;
        font-weight: bold;
    }

    .bg-1 {

        border: 1px #395ebd solid;

    }

    .bg-2 {
        border: 1px #2a7a21 solid;
        /*  background-image: linear-gradient(180deg, #84e27d, #c4e297);
        color: #2a7a21;*/
    }

    .bg-3 {
        border: 1px #992b4f solid;
        /* background-image: linear-gradient(180deg, #ff9b9b, #ffb9d3);
        color: #992b4f;*/
    }

    .bg-4 {
        border: 1px #8c5631 solid;
        /* background-image: linear-gradient(180deg, #ffb07f, #fdd9a5);
        color: #8c5631;*/
    }

    .bg-5 {

        border: 1px #395ebd solid;
        color: #67757c !important;
    }

    .bg-6 {
        border: 1px #2a7a21 solid;
        color: #67757c !important;
    }

    .bg-7 {
        border: 1px #992b4f solid;
        color: #67757c !important;
    }

    .bg-8 {
        border: 1px #8c5631 solid;
        color: #67757c !important;
    }

    .box-body {
        cursor: pointer;
    }

    .amount_in {
        font-size: 14px;
    }

    .card-image {
        position: absolute;
        max-width: 200px;
        margin-right: 10px;
    }

    .hidden {
        display: none;
    }

    .highcharts-credits {
        display: none;
    }

    <?php if ($this->Session->read('USER_TYPE') != 'Admin') { ?>.showExpense {
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
            <div class="col-xl-3 col-md-6 col-12 px-5" onclick="openDashboard('NSTBI')">
                <div class="box box-body bg-1 bg-2 pt-25 pb-25" style="cursor: pointer;display:block;width:100%;height:100px;  ">

                    <img class="card-image-center" src="<?php echo $this->webroot ?>images/CENSE.jpg">

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 px-5" onclick="openDashboard('DMTBI')">
                <div class="box box-body bg-1 bg-2 pt-25 pb-25" style="cursor: pointer;display:block;width:100%;height:100px;  ">

                    <img class="card-image-center" src="<?php echo $this->webroot ?>images/cpdm.png">

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 px-5" onclick="openDashboard('MUTBI')">
                <div class="box box-body bg-1 bg-2 pt-25 pb-25" style="cursor: pointer;display:block;width:100%;height:100px;  ">

                    <img class="card-image-center" src="<?php echo $this->webroot ?>images/manipal.png">

                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12 px-5" onclick="openDashboard('RMTBI')">
                <div class="box box-body bg-1 bg-2 pt-25 pb-25" style="cursor: pointer;display:block;width:100%;height:100px;  ">

                    <img class="card-image-center" src="<?php echo $this->webroot ?>images/ramaiah.webp" style="    width: 194px;">

                </div>
            </div>
        </div>
        <div class="row chart hidden" style="margin-top:-20px;">
            <div class="col-12">
                <div class="box">
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <button type="button" class="btn btn-info">TBI Dashboard <?= $this->Session->read('Phase'); ?></button>
                        </div>
                    </div>
                    <div class=" box-header with-border">
                        <h4 class="box-title text-info">Centre for Nano Science and Engineering (CeNSE), IISc., Bengaluru </h4>
                        <a href="javascript:void(0)" onclick="closeDashboard()" class="showExpense btn btn-info btn-sm pull-right"><span>Back</span></a>

                    </div>
                    <div class="box-body chart-body">

                        <!-- <div id="chartNSTBI" class='chart ' style="width:100%;height: 400px;"></div> -->
                        <div class="chart-div" id="chartDMTBI" style="width:100%;height: 400px;"></div>
                        <div class="chart-div" id="chartMUTBI" style="width:100%;height: 400px;"></div>
                        <div class="chart-div" id="chartRMTBI" style="width:100%;height: 400px;"></div>
                        <div class="chart-div" id="chartNSTBI" style="width:100%;height: 400px;"></div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


<div class="modal center-modal fade" id="ExpenseDetails">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
                <h5 class="box-title text-white"> </h5>
            </div>
            <div class="modal-body " id="ExpenseDetailsContent">

            </div>
            <div class="modal-footer modal-footer-uniform">

                <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<?= $this->element('cssJs/charts'); ?>


<script>
    var final_array = <?= $finalArray ?>;
    var userLoginType = '<?= $this->Session->read('USER_TYPE') ?>';
    if (userLoginType == 'CENSE') {
        openDashboard('NSTBI');
    } else if (userLoginType == 'CPDM') {
        openDashboard('DMTBI');
    } else if (userLoginType == 'MUTBI') {
        openDashboard('MUTBI');
    } else if (userLoginType == 'RMTBI') {
        openDashboard('RMTBI');
    }

    $.fn.loadModalData = function(university, type) {

        url = encodeURI('tbiDashboardPopup/' + university + '/' + type);
        $('#ExpenseDetailsContent').load(url, function() {
            $('#ExpenseDetails').modal({
                show: true
            });
        });
    }


    function openDashboard(type) {

        $('.box-title').html(final_array[type].title)
        $('.chart-div').css('display', 'none')
        $('.cards').addClass('hidden')
        $('.chart').removeClass('hidden')
        $('#chart' + type).css('display', '')
    }

    function closeDashboard() {
        $('.chart').addClass('hidden')
        $('.cards').removeClass('hidden')
    }


    $.each(final_array, function(index, value) {


        Highcharts.chart('chart' + index, {
            chart: {
                type: 'column',

            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Numbers'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    },
                    point: {
                        events: {
                            click: function() {
                                if (this.options != null) {
                                    myoptions = this.options
                                    if (myoptions.y > 0) {
                                        $(this).loadModalData(myoptions.university, myoptions.type);
                                    }
                                }
                            }
                        }
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} INR<br/>'
            },

            series: [{
                name: "TBI Details",
                colorByPoint: true,
                data: [{
                        name: 'TECHNOLOGY START-UPS',
                        y: (value.count) ? value.count : 0,
                        university: index,
                        type: 'all'

                    },
                    {
                        name: 'START-UPS SELECTED',
                        y: (value.selected) ? value.selected : 0,
                        university: index,
                        type: 'is_selected'

                    },
                    {
                        name: 'START-UPS INCUBATED',
                        y: (value.incubated) ? value.incubated : 0,
                        university: index,
                        type: 'is_incubated'
                    },
                    {
                        name: 'INNOVATIONS COMMERCIALIZED',
                        y: (value.innovations) ? value.innovations : 0,
                        university: index,
                        type: 'is_innovations_commercialized'
                    },
                    {
                        name: 'START-UPS INCUBATED OFF TBI',
                        y: (value.tbi) ? value.tbi : 0,
                        university: index,
                        type: 'is_incubated_off_tbi'
                    },
                    {
                        name: 'STARTUPS GRADUATED',
                        y: (value.graduated) ? value.graduated : 0,
                        university: index,
                        type: 'is_graduated'
                    },
                    {
                        name: 'EVENTS CONDUCTED',
                        y: (value.event_conducted) ? value.event_conducted : 0,
                        university: index,
                        type: 'is_event_conducted'
                    }
                ]
            }],

        });
    });
    $('.highcharts-button').addClass('hidden');
</script>