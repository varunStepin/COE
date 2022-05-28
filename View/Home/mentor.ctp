<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Mentor
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Innovators accelerated</a></li>
        <li class="breadcrumb-item active">New Mentor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">
          <div class="col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-lg-10 col-sm-10">
			<!-- Basic Forms -->
			  <div class="box">
				<div class="box-header with-border">
					<?php echo $this->Html->link('Mentor List' ,array("controller"=>"Home","action"=>"listMentor"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,));

					?>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('Mentor',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()","url"=>array("controller"=>"Home","action"=>"mentor")));
                                echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                                echo $this->Form->input('actionType',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));
                        ?>
						
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="form-group row">
									<label for="example-search-input" class="col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
									<div class="col-sm-7">
										<?php echo $this->Form->input("name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Name")); ?>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Sector <span class="text-danger">*</span></label>
									<div class="col-sm-7">
										<?php 
											echo $this->Form->input("sector_id",array("type"=>"select","label"=>false,"options"=>$sectors,"class"=>"form-control",'empty'=>'Select','required'));
										?>
										<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['Mentor']['id']));?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="form-group row">
									<label for="example-search-input" class="col-sm-4 col-form-label">Event name <span class="text-danger">*</span></label>
									<div class="col-sm-7">
										<?php echo $this->Form->input("event_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Event Name")); ?>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group row">
									<label for="example-search-input" class="col-sm-4 col-form-label">No. of events <span class="text-danger">*</span></label>
									<div class="col-sm-7">
										<?php echo $this->Form->input("no_of_events",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Name")); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row displayNone">
							<div class="col-sm-6 col-md-6">
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Year <span class="text-danger">*</span></label>
									<div class="col-sm-7">
										<?php 
											echo $this->Form->input("year",array("type"=>"select","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?>
										
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Month <span class="text-danger">*</span></label>
									<div class="col-sm-7">
										<?php 
										echo $this->Form->input("month",array("type"=>"select","label"=>false,"options"=>$month_data,"class"=>"form-control",'empty'=>'Select','required','value'=>Date('F')));?>
									</div>
								</div>
							</div>
						</div>
						
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['UserDetail']['id']))
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
	  </div>
		

      <!-- /.row -->
      
    </section>
    <!-- /.content -->
  </div>
<script>
    $('.Mentors').addClass('active').parents('li').addClass('active');
</script>

