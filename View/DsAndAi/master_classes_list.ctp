<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Master Classes
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Events</a></li>
        <li class="breadcrumb-item active">Master Classes List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <?php echo $this->Html->link('Add Master Classes' ,array("controller"=> "DsAndAi", "action" => "masterClasses"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
            </div>
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Topic</th>
                            <th>Date</th>
							<th>Speaker Name</th>
							<th>Industry</th>
							<th>Startups</th>
							<th>Academia & Students Name</th>
							<th>Academia & Students Email</th>
							<th>Month-Year</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($table_list)) {
							    foreach ($table_list as $list) {
									$id = $list['DsMasterClass']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['DsMasterClass']['topic'];?></td>
                            <td><?php echo $list['DsMasterClass']['date'];?></td>
							<td><?php echo $list['DsMasterClass']['speaker_name'];?></td>
							<td><?php echo $list['DsMasterClass']['industry'];?></td>
							<td><?php echo $list['DsMasterClass']['startups'];?></td>
							<td><?php echo $list['DsMasterClass']['student_name'];?></td>
							<td><?php echo $list['DsMasterClass']['student_email'];?></td>
							<td><?php echo $list['DsMasterClass']['month'] .'-'.  $list['DsMasterClass']['year'];?></td>
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
<?php echo $this->Form->create('DsMasterClass',array("id"=>"EditDeleteForm","type"=>"file","url"=>array("controller"=>"DsAndAi","action"=>"masterClasses")));
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

    $('.MasterClasses').addClass('active').parents('li').addClass('active')
</script>
