<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Govt Official Training
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
            <li class="breadcrumb-item active"> Govt Official Training</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('Training  List', array("controller" => "MachineIntelligence", "action" => "govtOfficialTraining"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>


                        <?php echo $this->Form->create('MiOfficials', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "MachineIntelligence", "action" => "govtOfficialTrainingAdd")));
                        echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));?>
                        <div class="row">
						<div class="col-lg-6 col-12">
							<div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4  col-form-label">Phase<span class="text-danger">*</span></label>
									<div class="col-sm-8">
									<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
									</div>
                                </div>
							</div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Name <span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Name")) ?>
                                        <?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control", "value" => $this->request->data['Announcement']['id'])); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Gender <span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php $options = array('Male'=> 'Male','Female'=>'Female');
                                        $attributes = array('legend' => false,'','default' => 'Male');
                                        echo $this->Form->radio('gender', $options, $attributes); ?>   </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Mobile<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("mobile", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Mobile")) ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("email", array("type" => "email", "autocomplete" => "off", "label" => false, 'class' => "form-control ", "placeholder" => "Email", 'required')); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">City<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("city", array("type" => "text", "autocomplete" => "off", "label" => false, 'class' => "form-control ", "placeholder" => "City", 'required')); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Organization<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("organization_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Organization Name")) ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Organization Details</label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("organization_details", array("type" => "textarea","rows"=>2, "class" => "form-control", "label" => false, "placeholder" => "Organization Details")) ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Department<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("department", array("type" => "select", "class" => "form-control","options"=>$department ,"label" => false, "empty" => "Department")) ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Training Date<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("date", array("type" => "text", "class" => "form-control", "required","label" => false,"id"=>"datepicker", "placeholder" => "Training Date")) ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 displayNone">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Year <span   class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("year", array("type" => "select", "label" => false, "options" => $years_list, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('Y'))); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 displayNone">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Month <span  class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("month", array("type" => "select", "label" => false, "options" => $month_data, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('F'))); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Training  Details</label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("training_details", array("type" => "textarea","rows"=>2, "class" => "form-control", "label" => false, "placeholder" => "Training  Details")) ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
                                <?php
                                if (empty($this->request->data['MiOfficials']['id'])) {
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

    $('.govtOfficialTraining').addClass('active').parents('li').addClass('active');
</script>
