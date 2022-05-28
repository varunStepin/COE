<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Solutions Adopted
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">POC</a></li>
        <li class="breadcrumb-item active">Solutions Adopted</li>
      </ol>
    </section>

      <section class="content">
          <div class="box">
              <div class="box-header with-border">
                  <?php echo $this->Html->link('List Solutions Adopted' ,array("controller"=> "DsAndAi", "action" => "solutionsAdoptedList"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
              </div>
              <div class="box-body">
                  <div class="row">
                      <div class="col-sm-12 col-md-12">
                          <?php echo $this->Session->flash(); ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <?php echo $this->Form->create('DsSolutionsAdopted',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"DsAndAi","action"=>"solutionsAdopted")));
                          echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                          echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

                          <div class="row">
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Phase<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>

                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Enterprise<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("enterprise",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Enterprise"))?>
                                      <?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['DsSolutionsAdopted']['id']));?>
                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Start-up<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("startup",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Start-up"))?>
                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Category<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("category",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Category"))?>
                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Focus Area<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("focus_area",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Focus Area"))?>
                                  </div>
                              </div>


                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Date<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("date",array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required','placeholder'=>'DD-MM-YYYY')); ?>
                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Notes<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("notes",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Notes"))?>
                                  </div>
                              </div>

                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">Start Date<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("start_date",array("type"=>"text","class"=>"form-control datepicker","required","placeholder"=>"dd-mm-YYYY","label"=>false))?>
                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                      <label for="example-text-input" class="col-form-label">End Date<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("end_date",array("type"=>"text","class"=>"form-control datepicker","required","placeholder"=>"dd-mm-YYYY","label"=>false))?>
                                  </div>
                              </div>
                              <div class="col-sm-12 col-md-6 col-lg-4 displayNone">
                                  <div class="form-group ">
                                      <label for="example-text-input" class="col-form-label">Month-Year<span class="text-danger">*</span></label>
                                      <?php echo $this->Form->input("month",array("type"=>"text","value"=>"Jan-2020","label"=>false,"id"=>"monthPicker","class"=>"form-control",'placeholder'=>'MMM-YYYY','required'));?>
                                  </div>
                              </div>
                          </div>
                          <div class="box-footer">
                              <div class="clearfix pull-right">
                                  <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                  <?php
                                  if(empty($this->request->data['DsSolutionsAdopted']['id'])) {
                                      echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                                  }
                                  else {
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
          </div>
      </section>

  </div>
<?php echo $this->Form->create('DsSolutionsAdopted',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"DsAndAi","action"=>"solutionsAdopted")));
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

    $('.SolutionsAdopted').addClass('active').parents('li').addClass('active')
</script>
