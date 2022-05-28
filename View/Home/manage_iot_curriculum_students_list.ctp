<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Manage Iot Curriculum Students List
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">IOT NASSCOM</a></li>
        <li class="breadcrumb-item active">Manage Iot Curriculum Students List</li>
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
							<th>Name of college</th>
							<th>Student Name</th>
                            <th>Gender</th>
							<th>Course</th>
							<th>Contact Number</th>
							<th>Email id</th>
							<th>Institute Name</th>
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
									$id = $list['ManageIotStudentDetail']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['ManageIotCurriculum']['name_of_college'];?></td>
							<td><?php echo $list['ManageIotStudentDetail']['student_name'];?></td>
                            <td><?php echo $list['ManageIotStudentDetail']['gender'];?></td>
							<td><?php echo $list['ManageIotStudentDetail']['course'];?></td>
							<td><?php echo $list['ManageIotStudentDetail']['contact_number'];?></td>
							<td><?php echo $list['ManageIotStudentDetail']['email_id'];?></td>
							<td><?php echo $list['ManageIotStudentDetail']['institute_name'];?></td>
							<td><?php echo $list['ManageIotStudentDetail']['month'];?></td>
							<td><?php echo $list['ManageIotStudentDetail']['year'];?></td>
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
<?php echo $this->Form->create('ManageIotStudentDetail',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"manageIotCurriculumStudentsList")));
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

    $('.manageIotCurriculumStudents').addClass('active').parents('li').addClass('active');
</script>
