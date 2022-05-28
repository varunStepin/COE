<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            IOT Research Incubated
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">IOT Research Incubated</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('<span>IOT Research Incubated List  </span>',array("controller"=>"Home","action"=>"iotResearchIncubationList"),array("escape"=>false,"class"=>'btn btn-primary pull-right'));?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <?php echo $this->Form->create('IotResearchIncubation',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"iotResearchIncubation")));
                                    echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                                    echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Select Type<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php $type=array("Iot Research Incubation"=>"Iot Research Incubation","Startup Enrolled"=>"Startup Enrolled"); ?>
                                        <?php echo $this->Form->input("selected_type",array("type"=>"select","class"=>"form-control","required","options"=>$type,"label"=>false,"empty"=>"Select Type"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Name of the Startup <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("name_of_the_startup",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Startup Name"))?>
                                        <?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['IotResearchIncubation']['id']));?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Target Year<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php  $target_years=array("1st Year"=>"1st Year","2nd Year"=>"2nd Year","3rd Year"=>"3rd Year") ?>
                                        <?php echo $this->Form->input("target_year",array("type"=>"select","class"=>"form-control","options"=>$target_years,"required","label"=>false,"empty"=>"Select Target Year"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Target<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("target",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"target"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Details of Team<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("detail_of_team",array("type"=>"textarea","class"=>"form-control","required","label"=>false,"placeholder"=>"Team Detail"))?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Type of project Handled<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("type_project_handled",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Complete Detail"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Incubation start Date<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("incubation_start_date",array("type"=>"text","class"=>"form-control", "id"=>"datepicker","required","label"=>false,"placeholder"=>"date"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Current Status<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("current_status",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Current status"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Incubation Outcome<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("incubation_outcome",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Incubation Outcome"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Month<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php 
                                            echo $this->Form->input("month",array("type"=>"select","label"=>false,"options"=>$month_data,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('F')));?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Year<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php 
                                            echo $this->Form->input("year",array("type"=>"select","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="box-footer">
                            <div class="col-8 clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn waring btn-sm","label"=>false)); ?>
                                <?php
                                    if(empty($this->request->data['IotResearchIncubation']['id']))
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

    $('.iotResearchIncubation').addClass('active').parents('li').addClass('active');
</script>
