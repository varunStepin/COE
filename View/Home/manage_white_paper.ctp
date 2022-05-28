<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        White Paper / News Letter
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Cyber Security</a></li>
        <li class="breadcrumb-item active">White Paper / News Letter</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  
        <div class="col-lg-5 col-12">
			  <div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('ManageWhitePaper',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()",'type'=>"file"),array("url"=>array("controller"=>"Home","action"=>"manageWhitePaper")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Phase<span class="text-danger">*</span></label>
							<div class="col-sm-8">
							<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Title of White Papers<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("no_of_white_papers",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Title of White Papers"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['ManageWhitePaper']['id']));?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Document Type<span class="text-danger">*</span></label>
							<div class="col-sm-8">
                                <?php $doc_type = array('White Paper'=>'White Paper','News Letter'=>'News Letter');
                                echo $this->Form->input("doc_type",array("type"=>"select","options"=>$doc_type,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y'),"label"=>false));?>
							</div>
						</div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Publication Date<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input("publication_date",array("type"=>"text","class"=>"form-control datepicker","id"=>"datepicker","placeholder"=>"DD-MM-YYYY","required","label"=>false))?>
                            </div>
                        </div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">URL Link<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("url_link",array("type"=>"url","class"=>"form-control","required","label"=>false,"placeholder"=>"URL Link"))?>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Upload project<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php if(empty($this->request->data['ManageWhitePaper']['id'])) $req = 'required'; else $req = '';
                                echo $this->Form->input("newsletter_upload",array("type"=>"file","class"=>"form-control",$req,"label"=>false))?>
								<span class="text-danger"><?php echo $this->request->data['ManageWhitePaper']['newsletter_upload'] ?></span>
							</div>
						</div>
                        <div class="form-group row displayNone">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Month-year<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input("month",array("type"=>"text","value"=>"Jan-2020","label"=>false,"class"=>"form-control ","id"=>"monthPicker","placeholder"=>"MMM-YYYY",'required',));?>
                            </div>
                        </div>
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['ManageWhitePaper']['id']))
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

		<div class="col-lg-7 col-12">
			<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Phase</th>
							<th>Title of White Papers</th>
							<th>Document Type</th>
							<th>Publication Date</th>
							<th>URL Link</th>
							<th>News letter File</th>
							<!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($manage_list)) {
								foreach ($manage_list as $list) {
									$id = $list['ManageWhitePaper']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['ManageWhitePaper']['phase'];?></td>
							<td><?php echo $list['ManageWhitePaper']['no_of_white_papers'];?></td>
							<td><?php echo $list['ManageWhitePaper']['doc_type'];?></td>
							<td><?php echo $list['ManageWhitePaper']['publication_date'];?></td>
							<td><?php echo $list['ManageWhitePaper']['url_link'];?></td>
							<td><a href="<?php echo $this->webroot;?>Newsletter/<?php echo $list['ManageWhitePaper']['newsletter_upload']; ?>" target="_blank">View</a></td>
							<!--<td><?php /*echo $list['ManageWhitePaper']['month'] .'-'. $list['ManageWhitePaper']['year'];*/?></td>-->
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
<?php echo $this->Form->create('ManageWhitePaper',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"manageWhitePaper")));
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

    $('.white-paper').attr('class','active').parents('li').addClass('active');
</script>
