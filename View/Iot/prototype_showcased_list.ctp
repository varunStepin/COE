<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Prototypes Showcased
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
        <li class="breadcrumb-item active">Prototypes Showcased</li>
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
						<?php echo $this->Form->create('IotShowcasedPrototype',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>$action)));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Phase<span class="text-danger">*</span></label>
							<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
						</div>

						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Prototype Name <span class="text-danger">*</span></label>

								<?php echo $this->Form->input("prototype_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Prototype Name"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['Financial']['id']));?>

						</div>
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Event Name<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("event_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Event Name"))?>

						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Event Date<span class="text-danger">*</span></label>
								<?php echo $this->Form->input("event_date" , array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required','placeholder'=>'DD-MM-YYYY')); ?>

						</div>
						
						<div class="form-group ">
                            <?php
                                $photo_req = 'required';
                                if($this->request->data['IotShowcasedPrototype']['photo'] !='') $photo_req = '';
                            ?>
							<label for="example-text-input" class=" col-form-label">Upload Photo<span class="text-danger">*</span></label>
								<?php echo $this->Form->input("photo",array("type"=>"file",$photo_req,"class"=>"form-control","label"=>false));
                                 echo $this->Form->input('photo_old',array("type"=>"hidden","label"=>false,"value"=>$this->request->data['IotShowcasedPrototype']['photo']));?>
                            <span class="text-danger"><?= $this->request->data['IotShowcasedPrototype']['photo']; ?></span>
						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Prototype description<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("description",array("type"=>"textarea","required","rows"=>2,"class"=>"form-control","label"=>false,"placeholder"=>"Prototype description"))?>

						</div>
						
						
						
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['Financial']['id']))
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
							<th>Prototype Name</th>
							<th>Event Name</th>
							<th>Event Date</th>
							<th>Photo</th>
							<th>Prototype description</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $manage) {
									$id = $manage['IotShowcasedPrototype']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $manage['IotShowcasedPrototype']['phase'];?></td>
							<td><?php echo $manage['IotShowcasedPrototype']['prototype_name'];?></td>
							<td><?php echo $manage['IotShowcasedPrototype']['event_name'];?></td>
                            <td><?=  date('d-m-Y',strtotime($manage['IotShowcasedPrototype']['event_date'])); ?></td>
							<td><?php if($manage['IotShowcasedPrototype']['photo']!=""){ ?>
								<a href="<?php echo $this->webroot; ?>files/<?php echo $manage['IotShowcasedPrototype']['photo'];?>" target="_blank">View</a>
							<?php } ?>
							</td>
							<td><?php echo $manage['IotShowcasedPrototype']['description'];?></td>
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
<?php echo $this->Form->create('IotShowcasedPrototype',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>$action)));
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

	$('.prototype_showcased').addClass('active').parents('li').addClass('active')
</script>
