<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title ?>
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> TBI</a></li>
        <li class="breadcrumb-item"><a href="#"><?=$title ?></a></li>
        <li class="breadcrumb-item active">Expenditure Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  


		<div class="col-lg-12 col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Expense', array("controller" => "Tbi", "action" =>$action/* $linkType  */), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));  ?>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
                            <th>Phase</th>
							 <th>Finance Year</th>
							<th>Amount Spent (INR)</th>
							<th>Expense Type</th>
							<th>Expense Start Date</th>
                            <th>Expense End Date</th>
							<th>Details of Expenditure</th>
							<th>Remarks</th>
							<th>Supporting Documents</th>
						
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $manage) {
									$id = $manage['Expenditure']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
              <td><?php echo $manage['Expenditure']['phase'];?></td>
							<td><?php echo $manage['FinancialYear']['year'];?></td>
							<td><?php echo number_format($manage['Expenditure']['amount_spent']);?></td>
							<td><?php echo $manage['Expenditure']['expense_type'];?></td>
							<td><?php echo date('d-M-y',strtotime($manage['Expenditure']['date']));?></td>
              <td><?php echo date('d-M-y',strtotime($manage['Expenditure']['end_date']));?></td>
							<td><?php echo $manage['Expenditure']['details'];?></td>
							<td><?php echo $manage['Expenditure']['remarks'];?></td>
							<td><?php if($manage['Expenditure']['document']!=""){?>
                  <a href="<?php echo $this->webroot; ?>Expenditure_Documents/<?php echo $manage['Expenditure']['document'];?>" target="_blank">View</a>
                  <?php } ?>
              </td>
							<td>
                <a href="javascript:void(0)" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
                <!-- <a href=<?php echo $linkType?> onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a> -->
							</td>
						</tr>
						<?php  }
          } ?>
					</tbody>
				</table>
				</div>              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->   
		</div>
	  </div>
		

      <!-- /.row -->
      
    </section>
    <!-- /.content -->
  </div>
<?php echo $this->Form->create('Expenditure',array("url"=>array("controller"=>"Tbi","action"=>$action),"id"=>"EditDeleteForm","type"=>"file",));
                                echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
                                echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
                                echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
                                echo $this->Form->end();
                                ?>
<script>
   function addIdToForm(id,type){
       $('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
       if(type=='delete'){
           if(confirm('Are you sure you want to delete?')===false)
               return;
       }
       $('#fieldId').val(id)
       $('#actionType').val(type)
       $('#EditDeleteForm').submit();
   }
</script>
<script>
    var elementTitle='.<?=$action ?>'

    $(elementTitle).addClass('active').parents('li').addClass('active')
</script>
