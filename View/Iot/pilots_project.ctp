<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Govt. Delegations & International delegations hosted at CoE
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">Delegations</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pt-0">

        <div class="row">
            <div class="col-lg-12">
                <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot .'excel_dounload/delegation.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>
                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('IotPilotsProject',array("url"=>array("controller"=>"Iot","action"=>"pilotProjectImport"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
                            echo $this->Form->input('file',array("type"=>"file",'id'=>'excel_file',"class"=>"form-control doc_type","label"=>false));
                            echo $this->Form->input('program_name_id',array("type"=>"hidden",'id'=>'ProgramNameId',"class"=>"form-control","label"=>false));
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('List', array("controller" => "Iot", "action" => "pilotsProjectList"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,)); ?>
                    </div>
                    <?php echo $this->Form->create('IotPilotsProject', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()", "url" => array("controller" => "Iot", "action" => "pilotsProject")));
                    echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                    echo $this->Form->input('actionType', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
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
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Name of Startup <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("iot_start_up_id", array("type" => "select",'id'=>'ProgramName', "class" => "form-control", "required", "label" => false, "options"=>$startups,"empty" => "Start Up Name")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Start Date<span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("date_of_started", array("type" => "text", "class" => "form-control datepicker", "required", "label" => false, "placeholder" => "Start Date")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>End/continuing Date<span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("date_of_end", array("type" => "text", "class" => "form-control datepicker",  "required", "label" => false, "placeholder" => "End/continuing Date")); ?>
                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Industry Category </label>
                                            <?php echo $this->Form->input("industry_category", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Industry Category")); ?>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>Impact expected </label>
                                                <?php echo $this->Form->input("impact_expected", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Impact expected ")); ?>
                                            </div>

                                        </div>

                                    <div class="col-sm-12 col-md-6 col-lg-4 displayNone">
                                            <div class="form-group">
                                                <label>Month Year</label>
                                               <?php echo $this->Form->input("month",array("type"=>"text","value"=>"Jan-2020","label"=>false,"id"=>"monthPicker","class"=>"form-control",'placeholder'=>'Month Year','required'));?>  </div>
                                        </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>Description <span data-toggle="tooltip" class="text-danger font-size-10" title="Description including URL of a case study, photo, video etc">(?) </span> </label>
                                                <?php echo $this->Form->input("details", array("type" => "textarea", "rows"=>5,"class" => "form-control", "label" => false, "placeholder" => "Description")); ?>
                                            </div>
                                        </div>

                                </div>

                    </div>
                    <div class="box-footer">
                        <div class="clearfix pull-right pb-10">
                            <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn waring btn-sm","label"=>false)); ?>
                            <?php
                            if(empty($this->request->data['IotResearchIncubation']['id'])) {
                                echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                            } else {
                                echo $this->Form->button("Update",array("type"=>"submit","class"=>"_update btn btn-danger btn-sm","label"=>false));
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
    $('#bulkUpload').on('click',function () {
        let program = $('#ProgramName').val();
        $('.error_ale').remove();
        if(program == ''){
            $('#ProgramName').focus().after('<span class="text-danger error_ale">Select Program type !!!</span>');
        }else{
            $('#excel_program_id').val(program);
            $('#excel_file').click();
        }
    });

    $('#ProgramName').on('change',function () {
        $('#ProgramNameId').val($(this).val());
        $('.error_ale').remove();
    });


    $('#excel_file').on('change',function () {
        $('#excel_import_form').submit();
    });
</script>
<script>
    $('.pilotsProjectList').addClass('active').parents('li').addClass('active')
</script>

