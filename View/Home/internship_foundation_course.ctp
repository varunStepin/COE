<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Internship Foundation Course
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Aerospace and Defence</a></li>
        <li class="breadcrumb-item active">Manage Internship Foundation Course</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	     <div class="box">
		 <div class="box-body">
		  <div class="row">		  
			<div class="col-lg-6 col-12">
				  <div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
				  </div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('InternshipFoundationCourse',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"internshipFoundationCourse")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Internship Foundation Course name<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("id",array("type"=>"hidden","class"=>"form-control","required","label"=>false))?>
								<?php echo $this->Form->input("internship_program_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Internship Foundation Course"))?>
								
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Duration<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("duration",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Duration"))?>
								
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Start Date<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("start_date",array("type"=>"text","class"=>"form-control","id"=>"datepicker","required","label"=>false))?>
								
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">End Date<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("end_date",array("type"=>"text","class"=>"form-control","id"=>"datepicker1","required","label"=>false))?>
								
							</div>
						</div>

						
					</div>
				<!-- /.col -->
					</div>
			<!-- /.row -->
			</div>
			<div class="col-lg-6 col-12">
                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">Phase<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo $this->Form->input("phase",array("type"=>"select","options"=>['Phase 1'=>'Phase 1','Phase 2'=>'Phase 2'],"empty"=>"Select","class"=>"form-control","required","label"=>false,"placeholder"=>"Venue"))?>

                    </div>
                </div>
              <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">Venue<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo $this->Form->input("venue",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Venue"))?>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-text-input" class="col-sm-4 col-form-label">Resource Person<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <?php echo $this->Form->input("resource_person",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Resource Person"))?>

                    </div>
                </div>
				<div class="row">
					<div class="col-12">
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Other Details<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("details",array("type"=>"textarea","class"=>"form-control","required","rows"=>3,"label"=>false,"placeholder"=>"Other Details"))?>
								
							</div>
						</div>
						
						<div class="form-group row displayNone">
							<label for="example-text-input" class="col-sm-4 col-form-label">Month/Year<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<input id="bday-month" type="month" name="bday-month" value="2020-09" class="form-control">
							</div>
						</div>
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['InternshipFoundationCourse']['id']))
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
				</div>
			</div>
		</div>
		</div>
	  </div>
    </section>
	
    <!-- /.content -->
  </div>
<?php echo $this->Form->create('InternshipFoundationCourse',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"internshipFoundationCourse")));
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
     $( function() {
    $( "#datepicker1" ).datepicker();
  } ); 
  
</script>

<script>
    $('.manageInternshipFoundationCourseList').addClass('active').parents('li').addClass('active')
</script>
