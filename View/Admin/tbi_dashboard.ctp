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
        <?php $userType = $this->Session->read('USER_TYPE'); ?>
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
            <div class="col-12">
                <div class="box fundCard">
                    <div class=" box-header with-border">
                        <!--<h4 class="box-title text-info">Fund Allocation / Utilization  Details </h4>-->
                        <a href="javascript:void(0)" class="showExpense btn btn-info btn-sm pull-right"><span>Expense Details</span></a>

                        <div class="col-3 float-right">
                            <?php echo $this->Form->input("financial_year_id", array("type" => "select", "options" => $financialYear, "onchange" => 'setFundingYear()', "empty" => "Select", 'value' => $expenseYear, "class" => "form-control pull-right w-200 fund", 'id' => 'fund', "required", "label" => false)) ?>
                        </div>

                    </div>

                    <div class="box-body finance_section">
                        <div align="center">
                            <button type="button" class="btn btn-info">TBI <?= $this->Session->read('Phase'); ?> Financials Dashboard : <?= $current_financial_year; ?></button>
                        </div>
                        <div id="container" style="width:100%;height: 400px;"></div>
                    </div>
                </div>

                <div class="box hidden expenseCard ">
                    <div class="box-header with-border">
                        <!--<h4 class="box-title text-info">Expense Details </h4>-->
                        <a href="javascript:void(0)" class="showFund btn btn-danger btn-sm pull-right"><span>Fund Details</span></a>
                        <div class="col-3 float-right">
                           <?php echo $this->Form->input("financial_year_id", array("type" => "select", "options" => $financialYear, "onchange" => 'setExpense()', "empty" => "Select", 'value' => $expenseYear, "class" => "form-control pull-right w-200 expense ", 'id' => 'expense',  "label" => false)) ?>
                        </div>
                    </div>
                    <div class="box-body finance_section">
                        <div align="center">
                            <button type="button" class="btn btn-info">TBI <?= $this->Session->read('Phase'); ?> Financials Dashboard : <?= $current_financial_year; ?></button>
                        </div>

                        <div id="containerExpense" style="width:100%;height: 400px;"></div>
                    </div>
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
        <div class="modal-content" id="ExpenseDetailsContent">


        </div>
    </div>
</div>

<?= $this->element('cssJs/charts'); ?>
<script>
    $('.showExpense').on('click', function() {
        $('.fundCard').addClass('hidden')
        $('.expenseCard').removeClass('hidden')

    })
    $('.showFund').on('click', function() {
        $('.fundCard').removeClass('hidden')
        $('.expenseCard').addClass('hidden')

    })
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

    $.fn.loadModalChart = function(university, type) {

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
                                        $(this).loadModalChart(myoptions.university, myoptions.type);
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

<style>
    .font-size-30 {
        font-size: 22px !important;
        line-height: 1.2;
    }

    @media (max-width: 1514px) {
        .font-size-30 {
            font-size: 18px !important;
            line-height: 1.2;
        }
    }

    @media (max-width: 1412px) {
        .font-size-30 {
            font-size: 12px !important;
            line-height: 1.2;
        }
    }

    @media (min-width:1170px) {
        .finance_section {
            margin-top: -65px !important;
        }

    }

    @media (min-width:991px) and (max-width:1169px) {
        .finance_section {
            margin-top: -10px !important;
        }

    }
</style>


<?= $this->element('cssJs/charts'); ?>
<script>
    $(function() {
        var colors1 = ['#89adff', '#FFB583', '#fb5965'];

        try {
            var CeNSE_approved_amount = <?= 0 + $CeNSE['Financials']['approved_amount'] ?>;
            var CeNSE_amount_utilized = <?= 0 + $CeNSE['Financials']['amount_utilized'] ?>;
            var CeNSE_amount_remaining = <?= 0 + $CeNSE['Financials']['approved_amount'] - $CeNSE['Financials']['amount_utilized'] ?>;

            var CPDM_approved_amount = <?= 0 + $CPDM['Financials']['approved_amount'] ?>;
            var CPDM_amount_utilized = <?= 0 + $CPDM['Financials']['amount_utilized'] ?>;
            var CPDM_amount_remaining = <?= 0 + $CPDM['Financials']['approved_amount'] - $CPDM['Financials']['amount_utilized'] ?>;

            var ManipalUniversity_approved_amount = <?= 0 + $ManipalUniversity['Financials']['approved_amount'] ?>;
            var ManipalUniversity_amount_utilized = <?= 0 + $ManipalUniversity['Financials']['amount_utilized'] ?>;
            var ManipalUniversity_amount_remaining = <?= 0 + $ManipalUniversity['Financials']['approved_amount'] - $ManipalUniversity['Financials']['amount_utilized'] ?>;

            var RamaiahUniversity_approved_amount = <?= 0 + $RamaiahUniversity['Financials']['approved_amount'] ?>;
            var RamaiahUniversity_amount_utilized = <?= 0 + $RamaiahUniversity['Financials']['amount_utilized'] ?>;
            var RamaiahUniversity_amount_remaining = <?= 0 + $RamaiahUniversity['Financials']['approved_amount'] - $RamaiahUniversity['Financials']['amount_utilized'] ?>;

            var userType = '<?= $userType ?>'
            console.log(userType);
            var series_data;
            var series_categories;
            if (userType == 'Admin') {
                series_data = [{
                    name: 'Fund Received ',
                    data: [CeNSE_approved_amount, CPDM_approved_amount, ManipalUniversity_approved_amount, RamaiahUniversity_approved_amount]

                }, {
                    name: 'Fund Utilized',
                    data: [CeNSE_amount_utilized, CPDM_amount_utilized, ManipalUniversity_amount_utilized, RamaiahUniversity_amount_utilized]

                }, {
                    name: 'Fund Remaining',
                    data: [CeNSE_amount_remaining, CPDM_amount_remaining, ManipalUniversity_amount_remaining, RamaiahUniversity_amount_remaining]
                }]
                series_categories = [
                    'CeNSE',
                    'CPDM',
                    'Manipal University',
                    'Ramaiah University',
                ]
            }
            if (userType == 'CeNSE') {
                series_data = [{
                    name: 'Fund Received ',
                    data: [CeNSE_approved_amount]

                }, {
                    name: 'Fund Utilized',
                    data: [CeNSE_amount_utilized]

                }, {
                    name: 'Fund Remaining',
                    data: [CeNSE_amount_remaining]
                }]
                series_categories = ['CeNSE']
            }
            if (userType == 'CPDM') {
                series_data = [{
                    name: 'Fund Received ',
                    data: [CPDM_approved_amount]

                }, {
                    name: 'Fund Utilized',
                    data: [CPDM_amount_utilized]

                }, {
                    name: 'Fund Remaining',
                    data: [CPDM_amount_remaining]
                }]
                series_categories = ['CPDM']
            }
            if (userType == 'Manipal University') {
                series_data = [{
                    name: 'Fund Received ',
                    data: [ManipalUniversity_approved_amount]

                }, {
                    name: 'Fund Utilized',
                    data: [ManipalUniversity_amount_utilized]

                }, {
                    name: 'Fund Remaining',
                    data: [ManipalUniversity_amount_remaining]
                }]
                series_categories = ['Manipal University']
            }
            if (userType == 'Ramaiah University') {
                series_data = [{
                    name: 'Fund Received ',
                    data: [RamaiahUniversity_approved_amount]

                }, {
                    name: 'Fund Utilized',
                    data: [RamaiahUniversity_amount_utilized]

                }, {
                    name: 'Fund Remaining',
                    data: [RamaiahUniversity_amount_remaining]
                }]
                series_categories = ['Ramaiah University']
            }

            //Updates by Pavan Ends (29/10/2020)

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: series_categories,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Amount (INR)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} INR</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: series_data
            });
        } catch (e) {
            console.log(e)
            $('#training').html('<h3 class="no-data"> No Fund Details for  <?= $types ?> </h3>')

        }

        // console.log(drillDownData);
    });
</script>


<script>
    $.fn.loadModalData = function(type, month) {

        url = encodeURI('expenseDetailsPopUp/' + type + '/' + month);
        $('#ExpenseDetailsContent').load(url, function() {
            $('#ExpenseDetails').modal({
                show: true
            });
        });
    }
    var month = ["April", "May", "June", "July", "August", "September", "October", "November", "December", "January", "February", "March"];
    var modules = ['CeNSE', 'CPDM', 'Manipal University', 'Ramaiah University']

    var colors1 = ['#89adff', '#FFB583', '#348C53', '#00bcd4', '#e91e63', '#03a9f4', '#b54d28', '#ffc107'];


    var expensedata = JSON.parse('<?= json_encode($expenseDetails) ?>');
    var userType = '<?= $userType ?>'
    console.log(userType)
    var dsaidata = []
    for (j = 0; j < 8; j++) {
        module = modules[j]
        for (i = 0; i < 12; i++) {
            loopMnt = month[i];
            var value;
            try {
                value = parseInt(expensedata[module][loopMnt])
            } catch (e) {
                value = 0
            }

            if (isNaN(value)) value = 0
            try {
                dsaidata[module].push({
                    'name': month[i],
                    'y': value,
                    'module': module
                })
            } catch (e) {
                dsaidata[module] = []
                dsaidata[module].push({
                    'name': month[i],
                    'y': value,
                    'module': module
                })
            }

        }
    }
    Highcharts.setOptions({
        colors: Highcharts.map(colors1, function(color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
    });
    Highcharts.chart('containerExpense', {
        chart: {
            type: 'column',
            events: {
                load: function(event) {
                    if (userType == 'CeNSE') this.series[0].data[0].doDrilldown();
                    if (userType == 'CPDM') this.series[0].data[1].doDrilldown();
                    if (userType == 'Manipal University') this.series[0].data[2].doDrilldown();
                    if (userType == 'Ramaiah University') this.series[0].data[3].doDrilldown();
                }
            },
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
                text: 'Total Amount Spent (INR)'
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
                                    $(this).loadModalData(myoptions.module, myoptions.name);
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
            name: "Expense Details",
            colorByPoint: true,
            data: [{
                    name: 'CeNSE',

                    y: <?= 0 + $expenseDetails['CeNSE']['total'] ?>,
                    drilldown: "CeNSE"
                },
                {
                    name: 'CPDM',

                    y: <?= 0 + $expenseDetails['CPDM']['total'] ?>,
                    drilldown: "CPDM"
                },
                {
                    name: 'Manipal University',

                    y: <?= 0 + $expenseDetails['Manipal University']['total'] ?>,
                    drilldown: "Manipal University"
                },
                {
                    name: 'Ramaiah University',

                    y: <?= 0 + $expenseDetails['Ramaiah University']['total'] ?>,
                    drilldown: "Ramaiah University"
                },
            ]
        }],
        drilldown: {
            series: [{
                    name: "CeNSE",
                    id: "CeNSE",
                    data: dsaidata['CeNSE']
                },
                {
                    name: "CPDM",
                    id: "CPDM",
                    data: dsaidata['CPDM']
                },
                {
                    name: "Manipal University",
                    id: "Manipal University",
                    data: dsaidata['Manipal University']
                },
                {
                    name: "Ramaiah University",
                    id: "Ramaiah University",
                    data: dsaidata['Ramaiah University']
                },
            ]
        }
    });
</script>
<?php if ($userType != 'Admin') { ?>

    <!--<script>
    $('.highcharts-button').addClass('hidden')
    $('.fundCard').addClass('hidden')
    $('.showFund').addClass('hidden')
    $('.expenseCard').removeClass('hidden')
</script>-->
    <script>
        $('.highcharts-button').addClass('hidden')
    </script>
    <!--Updates by Pavan Ends (29/10/2020)-->
<?php } ?>

<script>
    function setFundingYear() {
        //alert(i);
        var a = $('.fund').val();

        //alert(a);
        $.ajax({
            type: "POST",
            url: '<?php echo Router::url(array("controller" => "Home", "action" => "setFundingYear")); ?>',
            data: {
                tbi_year: a
            },
            cache: false,
            success: function(html) {
                window.location.reload();
            }
        });
    }

    function setExpense() {
        var a = $('.expense').val();

        $.ajax({
            type: "POST",
            url: '<?php echo Router::url(array("controller" => "Home", "action" => "setFundingYear")); ?>',
            data: {
                tbi_year: a
            },
            cache: false,
            success: function(html) {
                window.location.reload();
            }
        });
    }
</script>