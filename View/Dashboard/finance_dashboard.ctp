<?= $this->element('cssJs/charts'); ?>
<?php  echo $this->Html->script('../assets/vendor_components/jquery-slimscroll/jquery.slimscroll.min');?>
<style>.highcharts-credits{display: none}</style>
<div class="content-wrapper">
    <section class="content drillDown">
        <div class="row mt-15">
            <div class="col-12 mb-20">
                <?php echo $this->Html->link('<span><i class="fa fa-arrow-left"></i> Dashboard</span>',array("controller"=>"Admin","action"=>"dashboard"),array('class'=>'btn btn-info pull-right btn-sm',"escape"=>false));?>
            </div>
            <div class="col-6">
                <div class="box ">
                    <div class=" box-header with-border">
                        <h4 class="box-title text-info">Fund Details </h4>
                    </div>
                    <div class="box-body">
                        <div id="training" style="height: 400px;"></div>
                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="box ">
                    <div class=" box-header with-border">
                        <h4 class="box-title text-info">Expense Details </h4>
                    </div>
                    <div class="box-body slim_scroll" >
                        <div class="table-responsive">
                       <table class="table table-striped table-bordered table-hover">
                           <thead>
                           <tr class="bg-info">
                           <th>#</th>
                           <th>Amount</th>
                           <th>Expense Type</th>
                           <th>Expense Date Date</th>
  <th>Expense End Date</th>

                           </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $funds['Financial']['approved_amount']=str_replace(",","",$funds['Financial']['approved_amount']);
                           $funds['Financial']['amount_utilized']=str_replace(",","",$funds['Financial']['amount_utilized']);
                          
                           $i=0; foreach ($manage_list as $list){?>
                           <tr>
                               <td><?= ++$i ?></td>
                               <td><?= $list['Expenditure']['amount_spent'] ?></td>
                               <td><?= $list['Expenditure']['expense_type'] ?></td>

                               <td><?= date('d-M-Y',strtotime($list['Expenditure']['date'])) ?></td>
                               <td><?= date('d-M-Y',strtotime($list['Expenditure']['end_date'])) ?></td>
                           </tr>
                           <?php } if(sizeof($manage_list)==0){ ?>
                               <tr>
                                   <td colspan="4" class="text-center"> No data found</td>
                               </tr>
                           <?php } ?>
                           </tbody>
                       </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</div>
<style>
    .no-data{
        text-align: center;
        padding-top: 15%;
    }
</style>
    <script>
        $('.slim_scroll').slimScroll({
            height: '435px'
        });
        $(function () {
            var colors1 = ['#673ab7','#e91e63','#009688'];
            var fund=JSON.parse('<?= json_encode($funds) ?>')

            try {
                var approved_amount = parseFloat(fund['Financial'].approved_amount)
                var amount_utilized = parseFloat(fund['Financial'].amount_utilized)
                var amount_remaining = approved_amount - amount_utilized
                
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
                Highcharts.chart('training', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 35
                        }
                    },
                    title: {
                        text: '<?= $types ?> Fund Details of year ' + fund['FinancialYear'].year
                    },
                    subtitle: {
                        text: ''
                    },
                    plotOptions: {
                        pie: {
                            innerSize: 80,
                            depth: 45
                        }
                    },
                    series: [{
                        name: 'Delivered amount',
                        data: [
                            ['Remaining Amount ' + amount_remaining, amount_remaining],
                            ['Utilized Amount ' + amount_utilized, amount_utilized],
                            ['Fund Received ' + approved_amount, approved_amount],

                        ]
                    }]
                });
            }catch (e) {
                $('#training').html('<h3 class="no-data"> No Fund Details for  <?= $types ?> </h3>')

            }

            // console.log(drillDownData);
        });
    </script>
