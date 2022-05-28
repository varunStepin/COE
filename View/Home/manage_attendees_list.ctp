<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendees List
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Aerospace and Defence</a></li>
        <li class="breadcrumb-item active">Manage Attendees List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">	
		<div class="col-lg-12 col-12">
			<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Program </th>
							<th>Attendee Name</th>
                            <th>Gender</th>
							<th>Contact number</th>
							<th>Email Id</th>
							<th>Institute name</th>
							<th>Month</th>
							<th>Year</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $list) {
									$id = $list['ManageAttendees']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['ManageTraining']['program_name'];?></td>
							<td><?php echo $list['ManageAttendees']['attendee_name'];?></td>
                            <td><?php echo $list['ManageAttendees']['gender'];?></td>
							<td><?php echo $list['ManageAttendees']['contact_number'];?></td>
							<td><?php echo $list['ManageAttendees']['email_id'];?></td>
							<td><?php echo $list['ManageAttendees']['institute_name'];?></td>
							<td><?php echo $list['ManageAttendees']['year'];?></td>
							<td><?php echo $list['ManageAttendees']['month'];?></td>
							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>

							</td>
						</tr>
						<?php   }

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
<?php echo $this->Form->create('ManageAttendees',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"manageAttendeesList")));
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

    $('.manageAttendees').addClass('active').parents('li').addClass('active');
</script>
