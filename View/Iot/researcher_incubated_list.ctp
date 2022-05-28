<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Researcher Incubated
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
        <li class="breadcrumb-item active">Researcher Incubated</li>
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
						<?php echo $this->Form->create('IotIncubatedResearcher',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>$action)));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Phase<span class="text-danger">*</span></label>
							<!-- <div class="col-sm-8"> -->
							<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
							<!-- </div> -->
						</div>

						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Researcher Name <span class="text-danger">*</span></label>

								<?php echo $this->Form->input("researcher_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Researcher Name"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['IotIncubatedResearcher']['id']));?>

						</div>
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Date<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("date_of_incubation" , array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required','placeholder'=>'DD-MM-YYYY')); ?>

						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Research Title<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("research_title",array("type"=>"text","required","class"=>"form-control","label"=>false,"placeholder"=>"Research Title"))?>

						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Email<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("researcher_email",array("type"=>"text","required","class"=>"form-control","label"=>false,"placeholder"=>"Email"))?>

						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Phone<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("mobile",array("type"=>"text","required","class"=>"form-control","label"=>false,"placeholder"=>"Phone"))?>

						</div>
						
						
						
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['IotIncubatedResearcher']['id']))
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
							<th>Researcher Name</th>
							<th>Date</th>
							<th>Research Title</th>
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
									$id = $manage['IotIncubatedResearcher']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $manage['IotIncubatedResearcher']['phase'];?></td>
							<td><?php echo $manage['IotIncubatedResearcher']['researcher_name'];?></td>
							<td><?php echo date('d-m-Y',strtotime($manage['IotIncubatedResearcher']['date_of_incubation']));?></td>
                            <td><?= $manage['IotIncubatedResearcher']['research_title'] ?></td>
                            <td><?= $manage['IotIncubatedResearcher']['researcher_email'] ?></td>
                            <td><?= $manage['IotIncubatedResearcher']['mobile'] ?></td>
							
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
<?php echo $this->Form->create('IotIncubatedResearcher',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>$action)));
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

	$('.Researchers_incubated').addClass('active').parents('li').addClass('active')
</script>
