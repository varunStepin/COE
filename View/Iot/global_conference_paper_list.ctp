<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
			Global Conferences Papers 
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
			<li class="breadcrumb-item active">Global Conferences Papers </li>
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
						<?php echo $this->Form->create('IotGlobalConferencePaper',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>$action)));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Phase<span class="text-danger">*</span></label>
							<!-- <div class="col-sm-8"> -->
							<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
							<!-- </div> -->
						</div>

						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Title of the Paper <span class="text-danger">*</span></label>

								<?php echo $this->Form->input("title",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Title"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['IotGlobalConferencePaper']['id']));?>

						</div>
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Date of Publication<span class="text-danger">*</span></label>
								<?php echo $this->Form->input("publication_date" , array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required','placeholder'=>'DD-MM-YYYY')); ?>

						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Conference Name<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("conference_name",array("type"=>"text","required","class"=>"form-control","label"=>false,"placeholder"=>"Conference Name"))?>

						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">URL Link<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("url",array("type"=>"url","required","class"=>"form-control","label"=>false,"placeholder"=>"https://www.webpage.com"))?>

						</div>
						
						<div class="form-group ">
                            <?php
                                $doc_req = 'required';
                                if($this->request->data['IotGlobalConferencePaper']['upload_doc'] !='') $doc_req = '';
                            ?>
							<label for="example-text-input" class=" col-form-label">Upload Document(PDF only)<span class="text-danger">*</span></label>
								<?php echo $this->Form->input("upload_doc",array("type"=>"file",$doc_req,"class"=>"form-control","label"=>false));
                                 echo $this->Form->input('upload_doc_old',array("type"=>"hidden","label"=>false,"value"=>$this->request->data['IotGlobalConferencePaper']['upload_doc']));?>
                            <span class="text-danger"><?= $this->request->data['IotGlobalConferencePaper']['upload_doc']; ?></span>
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
							<th>Title of the Paper</th>
							<th>Date of Publication</th>
							<th>Conference Name</th>
							<th>URL Link</th>
							<th>Document</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $manage) {
									$id = $manage['IotGlobalConferencePaper']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $manage['IotGlobalConferencePaper']['phase'];?></td>
							<td><?php echo $manage['IotGlobalConferencePaper']['title'];?></td>
							<td><?php echo $manage['IotGlobalConferencePaper']['publication_date'];?></td>
                            <td><?= $manage['IotGlobalConferencePaper']['conference_name']; ?></td>
                            <td><a href="<?= $manage['IotGlobalConferencePaper']['url']; ?>" target="_blank" ><?= $manage['IotGlobalConferencePaper']['url']; ?></a></td>
                            <td><?php if($manage['IotGlobalConferencePaper']['upload_doc']!=""){ ?>
								<a href="<?php echo $this->webroot; ?>files/<?php echo $manage['IotGlobalConferencePaper']['upload_doc'];?>" target="_blank">View</a>
							<?php } ?>
							</td>
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
<?php echo $this->Form->create('IotGlobalConferencePaper',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>$action)));
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

	$('.Paper_global_conference').addClass('active').parents('li').addClass('active')
</script>
