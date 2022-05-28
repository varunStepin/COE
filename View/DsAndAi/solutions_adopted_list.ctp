<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Solutions Adopted
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Events</a></li>
        <li class="breadcrumb-item active"> Solutions Adopted</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <?php echo $this->Html->link('Add Solutions Adopted' ,array("controller"=> "DsAndAi", "action" => "solutionsAdopted"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
            </div>
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
                            <th>Phase</th>
							<th>Enterprise</th>
							<th>Start-up</th>
							<th>Category</th>
							<th>Focus Area</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Date</th>
							<th>Notes</th>
							<!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($table_list)) {
							    foreach ($table_list as $list) {
									$id = $list['DsSolutionsAdopted']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
                            <td><?php echo $list['DsSolutionsAdopted']['phase'];?></td>
							<td><?php echo $list['DsSolutionsAdopted']['enterprise'];?></td>
                            <td><?php echo $list['DsSolutionsAdopted']['startup'];?></td>
							<td><?php echo $list['DsSolutionsAdopted']['category'];?></td>
							<td><?php echo $list['DsSolutionsAdopted']['focus_area'];?></td>
							<td><?php echo $list['DsSolutionsAdopted']['start_date'];?></td>
							<td><?php echo $list['DsSolutionsAdopted']['end_date'];?></td>
							<td class="text-nowrap"><?php echo $list['DsSolutionsAdopted']['date'];?></td>
							<td><?php echo $list['DsSolutionsAdopted']['notes'];?></td>
							<!--<td><?php /*echo $list['DsSolutionsAdopted']['month'] .'-'.  $list['DsSolutionsAdopted']['year'];*/?></td>-->
							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>

								
							</td>
						</tr>
						<?php   }

                            } ?>
					</tbody>
				</table>
				</div>              
            </div>

          </div>
    </section>

  </div>
<?php echo $this->Form->create('DsSolutionsAdopted',array("id"=>"EditDeleteForm","type"=>"file","url"=>array("controller"=>"DsAndAi","action"=>"solutionsAdopted")));
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
       $('#fieldId').val(id);
       $('#actionType').val(type);
       $('#EditDeleteForm').submit();


   }
</script>
<script>

    $('.SolutionsAdopted').addClass('active').parents('li').addClass('active')
</script>
