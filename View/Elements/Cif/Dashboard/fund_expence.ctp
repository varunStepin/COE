<div class="col-12">
	<div class="box fundCard">
		<div class=" box-header with-border">
			<!--<h4 class="box-title text-info">Fund Allocation / Utilization  Details </h4>-->
			<a href="javascript:void(0)" class="showExpense btn btn-info btn-sm pull-right"><span>Expense Details</span></a>
			

		</div>

		<div class="box-body finance_section">
			<div align="center">
				<button type="button" class="btn btn-info">COE Financials Dashboard : <?= $current_financial_year; ?></button>
			</div>
			<div id="container" style="width:100%;height: 400px;"></div>
		</div>
	</div>
	<style>
		.hidden {
			display: none;
		}
	</style>
	<div class="box hidden expenseCard ">
		<div class=" box-header with-border">
			<!--<h4 class="box-title text-info">Expense Details </h4>-->
			<a href="javascript:void(0)" class="showFund btn btn-danger btn-sm pull-right"><span>Fund Details</span></a>
			</div>
		<div class="box-body finance_section">
			<div align="center">
				<button type="button" class="btn btn-info">COE Financials Dashboard : <?= $current_financial_year; ?></button>
			</div>
			<div id="containerExpense" style="width:100%;height: 400px;"></div>
		</div>
	</div>
</div>
<div class="modal center-modal fade" id="ExpenseDetails">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="ExpenseDetailsContent">


        </div>
    </div>
</div>
<script>
	$(function() {
		/*--------------------------------------------Fund Detauls Started-----------------*/
		$('.showExpense').on('click', function() {
			$('.fundCard').addClass('hidden')
			$('.expenseCard').removeClass('hidden')

		})
		$('.showFund').on('click', function() {
			$('.fundCard').removeClass('hidden')
			$('.expenseCard').addClass('hidden')

		})

		var series_categories = <?php echo  json_encode($fundcategory) ?>;
		var series_data = series_data = [{
			name: 'Fund Received ',
			data: <?php echo json_encode($fundDetails['FundReceived']) ?>

		}, {
			name: 'Fund Utilized',
			data: <?php echo json_encode($fundDetails['FundUtilized']) ?>

		}, {
			name: 'Fund Remaining',
			data: <?php echo json_encode($fundDetails['FundRemaining']) ?>

		}]
		var colors1 = ['#89adff', '#FFB583', '#348C53', '#00bcd4', '#e91e63', '#03a9f4', '#b54d28', '#ffc107'];

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

		/*--------------------------------------------Fund Detauls Closed-----------------*/


		var month = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

		Highcharts.chart('containerExpense', {
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
										$(this).loadExpenceModalData(myoptions.module, myoptions.name);
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
				data: <?php echo json_encode($expenceDetails) ?>
			}],
			drilldown: {
				series: <?php echo json_encode($expenceDetailsMonthly) ?>
			}
		});
		$.fn.loadExpenceModalData = function(type, month) {

			url = encodeURI('<?php echo Router::url(array("controller" => "Admin", "action" => "cifExpenseDetailsPopUp")); ?>/'+ $('#year').val()+'/'+ type + '/' + month);

			$('#ExpenseDetailsContent').load(url, function() {
				$('#ExpenseDetails').modal({
					show: true
				});
			});
		}
	});
</script>
