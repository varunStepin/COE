<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Exited Companies
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Fabless</a></li>
            <li class="breadcrumb-item active">Exited Companies</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('Exited Company List', array("controller" => "Fabless", "action" => "exitedCompanies"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>


                        <?php echo $this->Form->create('ExitedCompany', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Fabless", "action" => "exitedCompanies")));
                        echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                        echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert")); ?>
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
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Name <span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Name")) ?>
                                        <?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control")); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Type<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("company_type", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Type")) ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Product<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("product", array("type" => "text", "autocomplete" => "off", "label" => false, 'class' => "form-control ", "placeholder" => "Product", 'required')); ?>

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
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Mobile<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("mobile", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Mobile")) ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Website</label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("website", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Website")) ?>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Address</label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("address", array("type" => "textarea", "class" => "form-control", "label" => false, "rows" => '2', "placeholder" => "Address")) ?>

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
                           
                        </div>
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
                                <?php
                                if (empty($this->request->data['exitedCompanies']['id'])) {
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

    $('.exitedCompanies').addClass('active').parents('li').addClass('active');
</script>
