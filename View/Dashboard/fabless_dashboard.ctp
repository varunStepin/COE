<?= $this->element('cssJs/charts'); ?>
<div class="content-wrapper">
    <section class="content drillDown">
		<div class="row">
			<div class="col-md-12" align="center">
				<button type="button" class="btn btn-info">K-tech COE - SFAL  <?= $this->Session->read('Phase'); ?></button>
			</div>
        </div>
        <div class="row mt-15">
            <div class="col-12 mb-20">
                 </div>
            <div class="col-12">
                <div class="box ">
                    <div class=" box-header with-border">
                        <!--<h4 class="box-title text-info">Fabless</h4>-->
						<div class="pull-right">
                            <?php echo $this->Html->link('<span> Finance Dashboard <i class="fa fa-arrow-right"></i></span>',array("controller"=>"Dashboard","action"=>"financeDashboard","fablessFund"),array('class'=>'btn btn-primary ml-10 pull-right btn-sm',"escape"=>false));?>
                            <?php echo $this->Html->link('<span><i class="fa fa-arrow-left"></i> Dashboard</span>',array("controller"=>"Admin","action"=>"dashboard"),array('class'=>'btn btn-info pull-right btn-sm',"escape"=>false));?>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="research_project" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--model pop Up-->
    <div class="modal center-modal fade" id="chartDetailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="chartDetailModalContent">

            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var colors1 = ['#6962dc', '#cf6886'];

        var final_array=<?= json_encode($final_array) ?>;



        researchDrillDown = [];

        $.each(final_array,function(index, value){
            $.each(final_array[index],function(index1, value1){

                year=[];
                $.each(final_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    researchDrillDown.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear=[];
                $.each(final_array[index]['Achieve']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Achieved']
                    );
                    researchDrillDown.push( {
                        id: index+'-YearWise-Achieved',
                        name: index+'-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[];
                    $.each(final_array[index]['Achieve'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index,index2]);
                        researchDrillDown.push({
                            id: index+'-'+index2+'-Achieved',
                            name: index+'-'+index2+'-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName','year']
                        });
                    });
                });
            });
        });
        console.log(researchDrillDown);



        Highcharts.chart('research_project', {
            chart: {
                type: 'column',
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'No of companies incubated/ Exits/ Successful/ Partners/Cohorts'
                }
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                if(this.y >0 && this.year!='' && this.year>0){
                                    $(this).loadModalData(this.shName,this.year,this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Target',
                data: [
                    ['Total No of Product Companies/ Incubatees Supported',final_array['Companies']['Target']['count'],'Companies-YearWise-Target',colors1[0]],
                    ['Partners',final_array['Partners']['Target']['count'],'Partners-YearWise-Target',colors1[0]],
                    ['Cohort',final_array['Cohort']['Target']['count'],'Cohort-YearWise-Target',colors1[0]],
                 ['SuccessfulCompany',final_array['SuccessfulCompany']['Target']['count'],'SuccessfulCompany-YearWise-Target',colors1[0]],
              ['ExitedCompany',final_array['ExitedCompany']['Target']['count'],'ExitedCompany-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Total No of Product Companies/ Incubatees Supported',final_array['Companies']['Achieve']['count'],'Companies-YearWise-Achieved',colors1[1]],
                    ['Partners',final_array['Partners']['Achieve']['count'],'Partners-YearWise-Achieved',colors1[1]],
                    ['Cohort',final_array['Cohort']['Achieve']['count'],'Cohort-YearWise-Achieved',colors1[1]],
                 ['SuccessfulCompany',final_array['SuccessfulCompany']['Achieve']['count'],'SuccessfulCompany-YearWise-Achieved',colors1[1]],
               ['ExitedCompany',final_array['ExitedCompany']['Achieve']['count'],'ExitedCompany-YearWise-Achieved',colors1[1]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[1]
            }],
            drilldown: {
                allowPointDrilldown: false,
                series:researchDrillDown
            }
        });

    });
</script>



<script>
    $(function(){
       'use strict';
       $.fn.loadModalData=function(type,year,month){  //alert(type);
           $('#chartDetailModalContent').load('fablessDashboard/'+encodeURIComponent(type)+'/'+year+'/'+month,function(){
               $('#chartDetailModal').modal({show:true});
           });
       }
    });
</script>
