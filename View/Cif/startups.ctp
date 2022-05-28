<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Start-ups Enrolled
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">CIF</a></li>
            <li class="breadcrumb-item active">Start-ups Enrolled</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pt-0">

        <div class="row">
            <div class="col-lg-12">
                <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot . 'excel_dounload/cif_start_ups_enrolled.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download<i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('CifStartup', array("url" => array("controller" => "Cif", "action" => "startupsImport"), "class" => "form-horizontal", 'id' => 'excel_import_form', "type" => "file", 'onsubmit' => "return addCsrfToken()"));
                            echo $this->Form->input('file', array("type" => "file", 'id' => 'excel_file', "class" => "form-control doc_type", "label" => false));
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('List', array("controller" => "Cif", "action" => "startupList"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <?php echo $this->Form->create('CifStartup', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()", "url" => array("controller" => "Cif", "action" => "startups")));
                    echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, "class" => "form-control rounded", 'value' => ' '));
                    echo $this->Form->input('type', array("type" => "hidden", "label" => false, "value" => "insert"));
                    echo $this->Form->input('id', array("type" => "hidden", "label" => false));
                    ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Phase<span class="text-danger">*</span></label>
                                            <?php
                                            echo $this->Form->input("phase", array("type" => "select", "options" => AppController::getPhase(), "empty" => "Select Phase", "class" => "form-control", "required", "label" => false)) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Year<span class="text-danger">*</span></label>
                                            <?php
                                            echo $this->Form->input("year", array("type" => "select", "label" => false, "options" => $years_list, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('Y'))); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Start Up Name<span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("startup_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Start Up Name")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Date of Incubation <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("incubation_date", array("type" => "text", "class" => "form-control datepicker", "id" => "datepicker", "required", "label" => false, "placeholder" => "Date of Incubation")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Date of Graduation </label>
                                            <?php echo $this->Form->input("graduation_date", array("type" => "text", "class" => "form-control datepicker", "label" => false, "placeholder" => "Date of Graduation", "required")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Founder Name</label>
                                            <?php echo $this->Form->input("founder_name", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Founder Name", "required")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label style="color: #ffffff">Is Any of Founder is Female?</label><br />
                                            <?php
                                            echo $this->Form->checkbox("is_women_founder", array("type" => "checkbox", "style" => "display:none", "id" => 'basic_checkbox_2', "class" => "filled-in", "label" => false, "empty" => "Is Woman Founder?")); ?>
                                            <label for="basic_checkbox_2">Is Any of Founder is Female?</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Founder Email</label>
                                            <?php echo $this->Form->input("founder_email", array("type" => "email", "class" => "form-control", "label" => false, "placeholder" => "Founder Email", "required")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>No of Employees</label>
                                            <?php echo $this->Form->input("no_employees", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "No of Employees", "required")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>No of Women Employees </label>
                                            <?php echo $this->Form->input("no_employees_women", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "No of Women  Employees", "required")); ?>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>	No of Women co-founder</label>
                                            <?php echo $this->Form->input("no_women_cofounder", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "No of Women co-founder")); ?>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Url (without http, https, www)</label>
                                            <?php echo $this->Form->input("url", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "url", "required")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Startup Contact Number</label>
                                            <?php echo $this->Form->input("mobile", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Mobile", "maxlength" => 10, "required")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 displayNone">
                                        <div class="form-group">
                                            <label>Month Year</label>
                                            <?php echo $this->Form->input("month", array("type" => "text", "value" => "Jan-2020", "label" => false, "id" => "monthPicker", "class" => "form-control", 'placeholder' => 'Month Year', 'required')); ?>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="box-footer">
                        <div class="clearfix pull-right pb-10">
                            <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn waring btn-sm", "label" => false)); ?>
                            <?php
                            if (empty($this->request->data['Cifstartup']['id'])) {
                                echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-danger btn-sm", "label" => false));
                            } else {
                                echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-danger btn-sm", "label" => false));
                            }
                            ?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
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
    $('#bulkUpload').on('click', function() {
        let program = $('#ProgramName').val();
        $('.error_ale').remove();
        if (program == '') {
            $('#ProgramName').focus().after('<span class="text-danger error_ale">Select Program type !!!</span>');
        } else {
            $('#excel_program_id').val(program);
            $('#excel_file').click();
        }
    });

    $('#ProgramName').on('change', function() {
        $('.error_ale').remove();
    });


    $('#excel_file').on('change', function() {
        $('#excel_import_form').submit();
    });
</script>

<script>
    $('.startups').addClass('active').parents('li').addClass('active')
</script>