<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Orientation Awareness Student List
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard mr-2"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Aerospace and Defence</a></li>
        <li class="breadcrumb-item active">Orientation Awareness Student List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">	
		<div class="col-lg-12 col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('<span>Orientation Awareness Student Add  </span>',array("controller"=>"AerospaceDefence","action"=>"orientationAwarenessStudent"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
                </div>
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Course Name</th>
							<th>Attendee Name</th>
                            <th>Gender</th>
							<th>Contact number</th>
							<th>Email Id</th>
							<th>Institute name</th><th>City</th>
							<!--<th>Month</th>
							<th>Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $list) {
									$id = $list['OrientationAwarenessStudent']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['OrientationAwarenessCourse']['internship_program_name'];?></td>
							<td><?php echo $list['OrientationAwarenessStudent']['attendee_name'];?></td>
                            <td><?php echo $list['OrientationAwarenessStudent']['gender'];?></td>
							<td><?php echo $list['OrientationAwarenessStudent']['contact_number'];?></td>
							<td><?php echo $list['OrientationAwarenessStudent']['email_id'];?></td>
							<td><?php echo $list['OrientationAwarenessStudent']['institute_name'];?></td>
                            <td><?php echo $list['OrientationAwarenessStudent']['city'];?></td>
							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
							</td>
						</tr>
						<?php   }}  ?>
					</tbody>
				</table>
				</div>              
            </div>
          </div>
		</div>
	  </div>
    </section>
  </div>
<?php echo $this->Form->create('OrientationAwarenessStudent',array("id"=>"EditDeleteForm","type"=>"file","url"=>array("controller"=>"AerospaceDefence","action"=>"orientationAwarenessStudentList")));
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

    $('.orientationAwarenessStudent').addClass('active').parents('li').addClass('active');
</script>
