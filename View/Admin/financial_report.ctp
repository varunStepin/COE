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

</style>
<div class="content-wrapper">
    <section class="content mainCards">
		<?php $userType = $this->Session->read('USER_TYPE'); ?>
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-12">
							<?php echo $this->Form->create('Financials',array("class"=>"form-horizontal"),array("url"=>array("controller"=>"Admin","action"=>"financialReport")));
							?>

							
							<div class="form-group row">
								<div class="col-sm-4">
									<?php echo $this->Form->input("financial_year_id",array("type"=>"select","options"=>$financialYear,"empty"=>"Select Financial Year","class"=>"form-control","required","label"=>false,"placeholder"=>"Topic"))?>
									
								</div>
								<div class="col-sm-8">
									<button type="submit" name="show_btn" class="btn btn-danger pull-left btn-sm">Show</button>
									<?php echo $this->Html->link('<span><i class="fa fa-arrow-left"></i> Dashboard</span>',array("controller"=>"Admin","action"=>"dashboard"),array('class'=>'btn btn-info pull-right btn-sm',"escape"=>false));?>
								</div>
								
							</div>
							<?php echo $this->Form->end(); ?>
							
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>	
<?php if(isset($_POST['show_btn'])!=''){ ?>        
		<div class="row" style="margin-top:-20px;">
            <div class="col-12">
                    <div class="box fundCard">
                        <div class=" box-header with-border">
                            <!--<h4 class="box-title text-info">Fund Allocation / Utilization  Details </h4>-->
							<a href="javascript:void(0)" class="showExpense btn btn-info btn-sm pull-right"><span>Expense Details</span></a>
							
						</div>
						
                        <div class="box-body finance_section" >
							<div align="center">
								<button type="button" class="btn btn-info">COE Financials Dashboard : <?= $financial_year; ?></button>
							</div>
                            <div id="container" style="width:100%;height: 400px;"></div>
                        </div>
                    </div>
					
                    <div class="box hidden expenseCard " >
                        <div class=" box-header with-border">
                            <!--<h4 class="box-title text-info">Expense Details </h4>-->
							<a href="javascript:void(0)" class="showFund btn btn-danger btn-sm pull-right"><span>Fund Details</span></a>
							
                        </div>
                        <div class="box-body finance_section" >
							<div align="center">
								<button type="button" class="btn btn-info">COE Financials Dashboard : <?= $financial_year; ?></button>
							</div>
                            <div id="containerExpense" style="width:100%;height: 400px;"></div>
                        </div>
                    </div>
            </div>
            
        </div>
<?php } ?>
    </section>
</div>

<div class="modal center-modal fade" id="ExpenseDetails">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="ExpenseDetailsContent">


        </div>
    </div>
</div>


<script>
    $('.showExpense').on('click',function () {
        $('.fundCard').addClass('hidden')
        $('.expenseCard').removeClass('hidden')

    })
    $('.showFund').on('click',function () {
        $('.fundCard').removeClass('hidden')
        $('.expenseCard').addClass('hidden')

    })
    function openDashboard(type){
        if(type=='dataScienceDashboard')
            url  = "<?= $this->html->url(array('controller'=>'Dashboard','action'=>'dataScienceDashboard')) ?>";
        else if(type=='aerospaceDashboard')
            url ="<?= $this->html->url(array('controller'=>'Dashboard','action'=>'aerospaceDashboard')) ?>";
        else if(type=='cyberSecurityDashboard')
            url="<?= $this->html->url(array('controller'=>'Dashboard','action'=>'cyberSecurityDashboard')) ?>";
        else if(type=='animationDashboard')
            url="<?= $this->html->url(array('controller'=>'Dashboard','action'=>'animationDashboard')) ?>";
        else if(type=='fablessDashboard')
            url="<?= $this->html->url(array('controller'=>'Dashboard','action'=>'fablessDashboard')) ?>";
        else if(type=='ktechCenterDashboard')
            url="<?= $this->html->url(array('controller'=>'Dashboard','action'=>'ktechCenterDashboard')) ?>";
        else if(type=='miRoboticsDashboard')
            url  = "<?php echo $this->html->url(array('controller'=>'Dashboard','action'=>'miRoboticsDashboard')) ?>";
        else if(type=='iotDashboard')
            url  = "<?php echo $this->html->url(array('controller'=>'Dashboard','action'=>'iotDashboard')) ?>";

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
            var DataScience_approved_amount = <?= 0+$DataScience['Financials']['approved_amount'] ?>;
            var DataScience_amount_utilized =  <?= 0+$DataScience['Financials']['amount_utilized'] ?>;
            var DataScience_amount_remaining =  <?= 0+$DataScience['Financials']['approved_amount']- $DataScience['Financials']['amount_utilized'] ?>;
            
            var IoTapproved_amount = <?= 0+$IoT['Financials']['approved_amount'] ?>;
            var IoTamount_utilized =  <?= 0+$IoT['Financials']['amount_utilized'] ?>;
            var IoTamount_remaining =  <?= 0+$IoT['Financials']['approved_amount']- $IoT['Financials']['amount_utilized'] ?>;

            var Machine_approved_amount = <?= 0+$Machine['Financials']['approved_amount']?>;
            var Machine_amount_utilized =  <?= 0+$Machine['Financials']['amount_utilized']?>;
            var Machine_amount_remaining =  <?= 0+$Machine['Financials']['approved_amount']- $Machine['Financials']['amount_utilized']?>;

            var Aerospace_approved_amount = <?= 0+$Aerospace['Financials']['approved_amount']?>;
            var Aerospace_amount_utilized =  <?= 0+$Aerospace['Financials']['amount_utilized']?>;
            var Aerospace_amount_remaining =  <?= 0+$Aerospace['Financials']['approved_amount']- $Aerospace['Financials']['amount_utilized']?>;

            var Cyber_approved_amount = <?= 0+$Cyber['Financials']['approved_amount']?>;
            var Cyber_amount_utilized =  <?= 0+$Cyber['Financials']['amount_utilized']?>;
            var Cyber_amount_remaining =  <?= 0+$Cyber['Financials']['approved_amount']- $Cyber['Financials']['amount_utilized']?>;

            var Animation_approved_amount = <?= 0+$Animation['Financials']['approved_amount']?>;
            var Animation_amount_utilized =  <?= 0+$Animation['Financials']['amount_utilized']?>;
            var Animation_amount_remaining =  <?= 0+$Animation['Financials']['approved_amount']- $Animation['Financials']['amount_utilized']?>;

           

            var camp_approved_amount = <?= 0+$Camp['Financials']['approved_amount']?>;
            var camp_amount_utilized =  <?= 0+$Camp['Financials']['amount_utilized']?>;
            var camp_amount_remaining =  <?= 0+$Camp['Financials']['approved_amount']- $Camp['Financials']['amount_utilized']?>;

            var Fabless_approved_amount = <?= 0+$Fabless['Financials']['approved_amount']?>;
            var Fabless_amount_utilized =  <?= 0+$Fabless['Financials']['amount_utilized']?>;
            var Fabless_amount_remaining =  <?= 0+$Fabless['Financials']['approved_amount']- $Fabless['Financials']['amount_utilized']?>;

            Highcharts.setOptions({
                colors: Highcharts.map(colors1, function (color) {
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
			//Updates by Pavan Starts (29/10/2020)
			var userType='<?= $userType ?>'
			var series_data;
			var series_categories;
			if(userType=='Admin') {
				series_data = [{
						name: 'Fund Received ',
						data: [DataScience_approved_amount, Aerospace_approved_amount, Cyber_approved_amount, Animation_approved_amount, camp_approved_amount,IoTapproved_amount,Machine_approved_amount, Fabless_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [DataScience_amount_utilized,Aerospace_amount_utilized,Cyber_amount_utilized, Animation_amount_utilized, camp_amount_utilized,IoTamount_utilized, Machine_amount_utilized, Fabless_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [DataScience_amount_remaining, Aerospace_amount_remaining, Cyber_amount_remaining, Animation_amount_remaining, camp_amount_remaining, IoTamount_remaining,Machine_amount_remaining, Fabless_amount_remaining]
				}]
			series_categories	= [
                        'K-tech COE for DS&AI',
                        'K-tech COE in A&D',
                        'K-tech COE in CS',
                        'K-tech COE in AVGC',
                        'K-tech COE by C-Camp',
                        'K-tech COE on IoT',
                        'K-tech COE - MINRO',
                        'K-tech COE - SFAL',
					]
			}
			if(userType=='DATA SCIENCE AND AI') {
				series_data = [{
						name: 'Fund Received ',
						data: [DataScience_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [DataScience_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [DataScience_amount_remaining]
				}]
				series_categories	= ['DATA SCIENCE AND AI']
			}
			if(userType=='AEROSPACE & DEFENSE') {
				series_data = [{
						name: 'Fund Received ',
						data: [Aerospace_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [Aerospace_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [Aerospace_amount_remaining]
				}]
				series_categories	= ['Aerospace & Defense']
			}
			if(userType=='CYBER SECURITY') {
				series_data = [{
						name: 'Fund Received ',
						data: [Cyber_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [Cyber_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [Cyber_amount_remaining]
				}]
				series_categories	= ['CYBER SECURITY']
			}
			if(userType=='ANIMATION') {
				series_data = [{
						name: 'Fund Received ',
						data: [Animation_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [Animation_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [Animation_amount_remaining]
				}]
				series_categories	= ['Animation, Visual Effects']
			}
			if(userType=='KTECH CENTRE') {
				series_data = [{
						name: 'Fund Received ',
						data: [camp_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [camp_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [camp_amount_remaining]
				}]
				series_categories	= ['KTECH Centre']
			}
			if(userType=='IOT') {
				series_data = [{
						name: 'Fund Received ',
						data: [IoTapproved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [IoTamount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [IoTamount_remaining]
				}]
				series_categories	= ['IOT']
			}
			if(userType=='MI & ROBOTICS') {
				series_data = [{
						name: 'Fund Received ',
						data: [Machine_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [Machine_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [Machine_amount_remaining]
				}]
				series_categories	= ['MI & Robotics']
			}
			if(userType=='FABLESS') {
				series_data = [{
						name: 'Fund Received ',
						data: [Fabless_approved_amount ]

					}, {
						name: 'Fund Utilized',
						data: [Fabless_amount_utilized ]

					}, {
						name: 'Fund Remaining',
						data: [Fabless_amount_remaining]
				}]
				series_categories	= ['Fabless']
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
                series: series_data //Updated by Pavan (29/10/2020)
            });
        }catch (e) {
            console.log(e)
            $('#training').html('<h3 class="no-data"> No Fund Details for  <?= $types ?> </h3>')

        }

        // console.log(drillDownData);
    });
</script>

<script>
    $.fn.loadModalData=function(type,month){
		var year = "<?php echo $financial_year_id ?>";
        url=encodeURI('expenseDetailsPopUpExtended/'+type+'/'+month+'/'+year);
        $('#ExpenseDetailsContent').load(url,function(){
            $('#ExpenseDetails').modal({show:true});
        });
    }
    var month=["April", "May","June","July","August", "September", "October", "November","December","January","February", "March"];
    var modules=['Data Science and AI','Aerospace & Defense','Cyber Security','Animation','KTECH Centre','IOT','MI & Robotics', 'Fabless']

    var colors1 = ['#89adff','#FFB583','#348C53','#00bcd4','#e91e63','#03a9f4','#b54d28','#ffc107'];


    var expensedata=JSON.parse('<?= json_encode($expenseDetails)?>');
    var userType='<?= $userType ?>'
    console.log(userType)
    var dsaidata=[]
    for(j=0;j<8;j++){
         module=modules[j]
        for(i=0;i<12;i++){
            loopMnt=month[i];
            var value;
            try{
                 value=parseInt(expensedata[module][loopMnt])
            }catch (e) {
                 value=0
            }

            if(isNaN(value))value=0
            try{
                dsaidata[module].push({'name':month[i],'y':value,'module':module})
            }catch (e) {
                dsaidata[module]=[]
                dsaidata[module].push({'name':month[i],'y':value,'module':module})
            }

        }
    }
    Highcharts.setOptions({
        colors: Highcharts.map(colors1, function (color) {
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
                    if(userType=='DATA SCIENCE AND AI')   this.series[0].data[0].doDrilldown();
                    if(userType=='AEROSPACE & DEFENSE')   this.series[0].data[1].doDrilldown();
                    if(userType=='CYBER SECURITY')   this.series[0].data[2].doDrilldown();
                    if(userType=='ANIMATION')   this.series[0].data[3].doDrilldown();
                    if(userType=='KTECH CENTRE')   this.series[0].data[4].doDrilldown();
                    if(userType=='MI & ROBOTICS')   this.series[0].data[6].doDrilldown();
                    if(userType=='IOT')   this.series[0].data[5].doDrilldown();
                    if(userType=='FABLESS')   this.series[0].data[7].doDrilldown();
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
                        click: function () {
                            if(this.options!=null){
                                myoptions=this.options
                                if(myoptions.y >0) {
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

        series: [
            {
                name: "Expense Details",
                colorByPoint: true,
                data: [
                    {
                        name:   'K-tech COE for DS&AI',

                        y: <?=0+$expenseDetails['Data Science and AI']['total'] ?>,
                        drilldown: "DSAI"
                    },
                    {
                        name: 'K-tech COE in A&D',

                        y: <?=0+$expenseDetails['Aerospace & Defense']['total'] ?>,
                        drilldown: "ASD"
                    },
                    {
                        name: 'K-tech COE in CS',

                        y: <?=0+$expenseDetails['Cyber Security']['total'] ?>,
                        drilldown: "CS"
                    },
                    {
                        name: 'K-tech COE in AVGC',

                        y: <?=0+$expenseDetails['Animation']['total'] ?>,
                        drilldown: "AN"
                    },
                    {
                        name: 'K-tech COE by C-Camp',

                        y: <?=0+$expenseDetails['KTECH Centre']['total'] ?>,
                        drilldown: "KT"
                    },
                    {
                        name: 'K-tech COE on IoT',

                        y: <?=0+$expenseDetails['IOT']['total'] ?>,
                        drilldown: "IOT"
                    },
                    {
                        name:  'K-tech COE - MINRO',

                        y: <?=0+$expenseDetails['MI & Robotics']['total'] ?>,
                        drilldown: 'MIR'
                    },
                    {
                        name:  'K-tech COE - SFAL',
                        y: <?=0+$expenseDetails['Fabless']['total'] ?>,
                        drilldown: 'Fabless'
                    }
                ]
            }
        ],
        drilldown: {
            series: [
                {
                    name: "DSv AI",
                    id: "DSAI",
                    data: dsaidata['Data Science and AI']
                },
                {
                    name: "Aerospace & Defense",
                    id: "ASD",
                    data: dsaidata['Aerospace & Defense']
                },
                {
                    name: "Cyber Security",
                    id: "CS",
                    data: dsaidata['Cyber Security']
                },
                {
                    name: "Animation",
                    id: "AN",
                    data: dsaidata['Animation']
                },
                {
                    name: "KTECH Centre",
                    id: "KT",
                    data: dsaidata['KTECH Centre']
                },
                {
                    name: "IOT",
                    id: "IOT",
                    data: dsaidata['IOT']
                },
                {
                    name: "MI & Robotics",
                    id: "MIR",
                    data: dsaidata['MI & Robotics']
                },
                {
                    name: "Fabless",
                    id: "Fabless",
                    data: dsaidata['Fabless']
                }
            ]
        }
    });
</script>
<!--Updates by Pavan Starts (29/10/2020)-->
<?php  if($userType!='Admin'){?>

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
<?php }?>
