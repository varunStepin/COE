<div class="modal-header bg-info  font-size-30">
    <h5  class="box-title ">
       <?php echo $header.' Expense Details of '.date('M-Y',strtotime($expenseDetails[0]['CifExpenditures']['date'])) ?>
    </h5>
    <!-- <i class="ti-printer font-size-18 mr-12" style="padding-right: 20px; cursor: pointer;" onclick="printTotEmp();"></i>-->
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">

        <div class="table-responsive model_slim_scroll" style="height: 500px">

            <table   class="table table-striped example_long table-bordered table-hover" >
                <thead>
                <tr>
                    <th>Sl no.</th>
                    <th>Amount(INR)</th>
                    <th>Type </th>
                    <th>Date Start</th> <th>Date End </th>
                    <th>Details</th>
					<th>Attacment</th>


                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($expenseDetails as $expense){?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?= $expense['CifExpenditures']['amount_spent'] ?></td>
                    <td><?= $expense['CifExpenditures']['expense_type'] ?></td>
                    <td><?= date('d-M-Y',strtotime($expense['CifExpenditures']['date'])) ?></td>
                    <td><?= date('d-M-Y',strtotime($expense['CifExpenditures']['end_date'])) ?></td>
                    <td><?= $expense['CifExpenditures']['details'] ?></td>
                    <td>
						<?php if($expense['CifExpenditures']['document']!=""){?>
							<a href="<?php echo $this->webroot; ?>Expenditure_Documents/<?php echo $expense['CifExpenditures']['document'];?>" target="_blank">View</a>
						<?php } ?>
					</td>

                </tr>

                <?php }?>

                </tbody>
            </table>




        </div>
    </div>

</div>
<div class="modal-footer modal-footer-uniform">
    <!--<button type="button" class="btn btn-bold btn-pure btn-info  float-right" onclick="upcoming_birthday();">Upcoming</button>-->
    <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
</div>
<script>
    $(function () {
        'use strict'

        $('.model_slim_scroll').slimScroll({
            height: '300px'
        });
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
</script>
