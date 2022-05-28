<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Mentorship
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
        <li class="breadcrumb-item active">Mentorship</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-lg-4 col-12">
			<!-- Basic Forms -->
			  <div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('MiMentorship',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"mentorshipList")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Phase<span class="text-danger">*</span></label>
								<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
						</div>
						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Mentor Name <span class="text-danger">*</span></label>

								<?php echo $this->Form->input("mentor_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Mentor Name"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['MiMentorship']['id']));?>

						</div>
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Company of the Mentor<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("mentor_company",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Company of the Mentor"))?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Gender<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("gender",array("type"=>"text","options"=>$financialYear,"required","class"=>"form-control","label"=>false,"placeholder"=>"Gender"))?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Email<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("email",array("type"=>"email","options"=>$financialYear,"required","class"=>"form-control","label"=>false,"placeholder"=>"Email"))?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Phone number<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("phone",array("type"=>"text","required","class"=>"form-control","label"=>false,"placeholder"=>"Phone number"))?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Mentorship Start Date<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("mentorship_start_date", array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required','placeholder'=>'DD-MM-YYYY')); ?>

						</div>

                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['MiMentorship']['id']))
                                {
                                    echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                                }
                                else
                                {
                                    echo $this->Form->button("Update",array("type"=>"submit","class"=>"_update btn btn-danger btn-sm","label"=>false));
                                }
                                ?>

                            </div>
                        </div>
						<?php echo $this->Form->end(); ?>
					</div>
				<!-- /.col -->
				</div>
			<!-- /.row -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
		</div>

		<div class="col-lg-8 col-12">
			<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Phase</th>
							<th>Mentor Name</th>
							<th>Company of the Mentor</th>
							<th>Gender</th>
							<th>Email</th>
							<th>Phone number</th>
							<th>Mentorship Start Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $manage) {
									$id = $manage['MiMentorship']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $manage['MiMentorship']['phase'];?></td>
							<td><?php echo $manage['MiMentorship']['mentor_name'];?></td>
							<td><?php echo $manage['MiMentorship']['mentor_company'];?></td>
							<td><?php echo $manage['MiMentorship']['gender'];?></td>
							<td><?php echo $manage['MiMentorship']['email'];?></td>
							<td><?php echo $manage['MiMentorship']['phone'];?></td>
							<td><?php echo date('d M Y',strtotime($manage['MiMentorship']['mentorship_start_date']));?></td>
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	  </div>


      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
<?php echo $this->Form->create('MiMentorship',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"mentorshipList")));
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

	$('.mentorship_list').addClass('active').parents('li').addClass('active')
</script>
