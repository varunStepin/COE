<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Announcement
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Utility</a></li>
        <li class="breadcrumb-item active">Announcement</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  
        <div class="col-lg-5 col-12">
			<!-- Basic Forms -->
			  <div class="box">
				<!--<div class="box-header with-border">
					<button class="btn btn-primary pull-right">View Notice List</button>
				</div>-->
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('Announcement',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"announcement")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<?php echo $this->Form->input("title",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Announcement Title"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['Announcement']['id']));?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-3 col-form-label">Date <span class="text-danger">*</span></label>
							<div class="col-sm-9">
								<?php echo $this->Form->input("date" , array("type"=>"text","id"=>"datepicker","label"=>false,'class'=>"form-control",'required')); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-3 col-form-label">Details</label>
							<div class="col-sm-9">
								<?php echo $this->Form->input("detail",array("label"=>false,"class"=>"form-control","rows"=>"5","placeholder"=>"Details Here...."))?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-3 col-form-label">File Upload</label>
							<div class="col-sm-9">
								<?php echo $this->Form->input("document",array("type"=>"file","class"=>"form-control" ,"label"=>false)); ?>
                                <span class="text-danger"><?php $this->request->data['Announcement']['document'] ?></span>
								<?php echo $this->Form->input("document_hidden",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['Announcement']['document']));?>
							</div>
						</div>
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['Announcement']['id']))
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
							<th>Title</th>
							<th>Date</th>
							<th>Details</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($announcement_list)) {

								foreach ($announcement_list as $announcement) {
									$announcement_id = $announcement['Announcement']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $announcement['Announcement']['title'];?></td>
							<td class="text-nowrap"><?php echo date('d-m-Y',strtotime($announcement['Announcement']['date']));?></td>
                            <td><a  data-toggle="tooltip" data-original-title="<?php echo $announcement['Announcement']['detail']; ?> "><span ></span><?php echo  substr($announcement['Announcement']['detail'], 0, 50); echo strlen($announcement['Announcement']['detail'])>51 ? "  ...":""; ?> </a></td>

							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $announcement_id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" onclick="addIdToForm(<?php echo $announcement_id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>

								<?php
									if(empty($announcement['Announcement']['document'])){
										$announcement['Announcement']['document'] = "filenotfound.jpg";
									}
									$filename = WWW_ROOT . 'img/announcement_files/' .$announcement['Announcement']['document'];
									
									if (file_exists($filename)) { ?>
										<a download href="<?php echo $this->webroot; ?>img/announcement_files/<?php echo $announcement['Announcement']['document']; ?>" target="_blank" "<?php echo $this->webroot; ?>img/announcement_files/<?php echo $announcement['Announcement']['document']; ?>">
											<i class="fa fa-eye menu-icon" style="font-size:18px;" aria-hidden="true"></i>
										</a>
									<?php } else{ ?>
										<a download href="<?php echo $this->webroot; ?>img/announcement_files/filenotfound.jpg" target="_blank" "<?php echo $this->webroot; ?>img/announcement_files/filenotfound.jpg">
											<i class="fa fa-eye menu-icon" style="font-size:18px;" aria-hidden="true"></i>
										</a>
									<?php }
								?>
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
<?php echo $this->Form->create('Announcement',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"announcement")));
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
