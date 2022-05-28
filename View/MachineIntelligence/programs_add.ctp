<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Programs
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
            <li class="breadcrumb-item active">Programs</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('Programs List', array("controller" => "MachineIntelligence", "action" => "programs"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>


                        <?php echo $this->Form->create('MiPrograms', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "MachineIntelligence", "action" => "programsAdd")));
                        echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                         ?>
                        <div class="row">
                            <div class="col-lg-6 col-12">
							<div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Phase<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
									<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
                                    </div>
                                </div>
							</div>
							<div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Program Name <span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("program_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Name")) ?>
                                        <?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control", "value" => $this->request->data['Announcement']['id'])); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Program Date <span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("program_date" , array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required', "placeholder" => "Date")); ?>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Program Type <span   class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("program_type", array("type" => "select", "label" => false, "options" => $programType, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('Y'))); ?>
                                    </div>
                                </div>
                                <div class="form-group displayNone row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Month <span  class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("month", array("type" => "select", "label" => false, "options" => $month_data, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('F'))); ?>
                                    </div>
                                </div>
                                <div class="form-group displayNone row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Year <span   class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("year", array("type" => "select", "label" => false, "options" => $years_list, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('Y'))); ?>
                                    </div>
                                </div>

                            </div>
							<div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Program Details</label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("program_details", array("type" => "textarea", "class" => "form-control", "label" => false, "rows" => '6', "placeholder" => "Program Details")) ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
                                <?php
                                if (empty($this->request->data['MiPrograms']['id'])) {
                                    echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-danger btn-sm", "label" => false));
                                } else {
                                    echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-danger btn-sm", "label" => false));
                                }
                                ?>

                            </div>
                        </div>

                        <?php echo $this->Form->end(); ?>


                    </div>

                </div>
                <!-- /.box -->
            </div>


        </div>


        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>

<script>

    $('.Programs').addClass('active').parents('li').addClass('active');
</script>
