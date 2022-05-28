<?= $this->element('cssJs/charts'); ?>
<div class="content-wrapper">
    <section class="content drillDown">
		<div class="row">
			<div class="col-md-12" align="center">
				<button type="button" class="btn btn-info">K-tech COE in CS <?= $this->Session->read('Phase') ?></button>
			</div>
        </div>
        <div class="row mt-15">
            <div class="col-12 mb-20">
                 </div>
            <div class="col-12">
                <div class="box ">
                    <div class=" box-header with-border">
                        <h4 class="box-title text-info">Workshop</h4>
                        <div class="pull-right">
                            <?php echo $this->Html->link('<span> Finance Dashboard <i class="fa fa-arrow-right"></i></span>',array("controller"=>"Dashboard","action"=>"financeDashboard","cyberSecurityFund"),array('class'=>'btn btn-primary ml-10 pull-right btn-sm',"escape"=>false));?>
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
        var colors1 = ['#FB7A07', '#DA07FB'];

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

                    month=[]
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
                    text: 'No. of Internship/Training/Enablement/Workshops conducted'
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
                    ['Internship',final_array['Internship']['Target']['count'],'Internship-YearWise-Target',colors1[0]],
                    ['Enablement',final_array['Enablement']['Target']['count'],'Enablement-YearWise-Target',colors1[0]],
                    ['Training',final_array['Training']['Target']['count'],'Training-YearWise-Target',colors1[0]],
                    ['White Paper - News Letter',final_array['White Paper - News Letter']['Target']['count'],'White Paper - News Letter-YearWise-Target',colors1[0]],
                    ['Workshop',final_array['Workshop']['Target']['count'],'Workshop-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Internship',final_array['Internship']['Achieve']['count'],'Internship-YearWise-Achieved',colors1[1]],
                    ['Enablement',final_array['Enablement']['Achieve']['count'],'Enablement-YearWise-Achieved',colors1[1]],
                    ['Training',final_array['Training']['Achieve']['count'],'Training-YearWise-Achieved',colors1[1]],
                    ['White Paper - News Letter',final_array['White Paper - News Letter']['Achieve']['count'],'White Paper - News Letter-YearWise-Achieved',colors1[1]],
                    ['Workshop',final_array['Workshop']['Achieve']['count'],'Workshop-YearWise-Achieved',colors1[1]],
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
           $('#chartDetailModalContent').load('cyberSecurityDashboard/'+encodeURIComponent(type)+'/'+year+'/'+month,function(){
               $('#chartDetailModal').modal({show:true});
           });
       }
    });
</script>
