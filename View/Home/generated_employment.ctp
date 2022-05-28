<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employment Generation
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">Employment Generation</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content pt-0">

        <div class="row">

            <div class="col-lg-12 col-12">

                <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot .'excel_dounload/employment_generation.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('GeneratedEmployment',array("url"=>array("controller"=>"Iot","action"=>"generatedEmploymentImport"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
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
                        <?php echo $this->Html->link('<span>Employee List  </span>',array("controller"=>"Home","action"=>"generatedEmploymentList"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
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
                                <?php echo $this->Form->create('GeneratedEmployment',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"generatedEmployment")));
                                    echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                                    echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Name of startup<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("iot_start_up_id", array("type" => "select", "class" => "form-control", 'id'=>'ProgramName',"required", "label" => false, "options"=>$startups,"empty" => "Start Up Name")); ?>
                                        <?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['GeneratedEmployment']['id']));?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Current No. of employee<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("mobile_no",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Current No. of employee"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">No. of internships provided cumulative<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("place",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"No. of internships provided cumulative"))?>
                                    </div>
                                </div>


                                <div class="form-group row displayNone">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Year-Month<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("month",array("type"=>"text","value"=>"Jan-2020","label"=>false,"id"=>"monthPicker","class"=>"form-control",'empty'=>'Select','required'));?>
                                    </div>
                                </div>
                                 <div class="form-group row ">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Incubation Date<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("email_id",array("type"=>"text",'id'=>"datepicker","label"=>false,"class"=>"form-control",'empty'=>'Select','required'));?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label"> Names of main / full time employees<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("other_details",array("type"=>"textarea","class"=>"form-control","required","label"=>false,"placeholder"=>" Names of main /full time employees"))?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="box-footer">
                            <div class="col-8 clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn waring btn-sm","label"=>false)); ?>
                                <?php
                                    if(empty($this->request->data['GeneratedEmployment']['id'])) {
                                        echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                                    } else {
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

    $('.generatedEmployment').addClass('active').parents('li').addClass('active');
</script>
