<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Open Experience Centre
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
        <li class="breadcrumb-item active">Open Experience Centre</li>
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
						<?php echo $this->Form->create('MiOpenExperienceCentre',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"openExperienceCentreList")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						<div class="form-group">
                            <label for="example-text-input" class="col-form-label">Phase<span class="text-danger">*</span></label>

						     		<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>

                        </div>
						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Name of the Experience Center <span class="text-danger">*</span></label>

								<?php echo $this->Form->input("name_of_the_experience_center",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Name of the Experience Center"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['MiOpenExperienceCentre']['id']));?>

						</div>
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Location<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("location",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Location"))?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Date of establishment<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("date_of_establishment", array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required','placeholder'=>'DD-MM-YYYY')); ?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Contact Person<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("contact_person",array("type"=>"text","options"=>$financialYear,"required","class"=>"form-control","label"=>false,"placeholder"=>"Contact Person"))?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Email<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("email",array("type"=>"email","required","class"=>"form-control","label"=>false,"placeholder"=>"Email"))?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Phone<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("phone",array("type"=>"text","required","class"=>"form-control","label"=>false,"placeholder"=>"Phone"))?>

						</div>


                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['MiOpenExperienceCentre']['id']))
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
							<th>Name of the Experience Center</th>
							<th>Location</th>
							<th>Date of establishment</th>
							<th>Contact Person</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $manage) {
									$id = $manage['MiOpenExperienceCentre']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $manage['MiOpenExperienceCentre']['phase'];?></td>
							<td><?php echo $manage['MiOpenExperienceCentre']['name_of_the_experience_center'];?></td>
							<td><?php echo $manage['MiOpenExperienceCentre']['location'];?></td>
							<td><?php echo date('d M Y',strtotime($manage['MiOpenExperienceCentre']['date_of_establishment']));?></td>
							<td><?php echo $manage['MiOpenExperienceCentre']['contact_person'];?></td>
							<td><?php echo $manage['MiOpenExperienceCentre']['email'];?></td>
							<td><?php echo $manage['MiOpenExperienceCentre']['phone'];?></td>
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
<?php echo $this->Form->create('MiOpenExperienceCentre',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"openExperienceCentreList")));
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

	$('.open_experience_centre').addClass('active').parents('li').addClass('active')
</script>
