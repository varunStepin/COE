<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Funds raised by startups</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">Funds raised by startups</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pt-0">

        <div class="row">
            <div class="col-lg-12">

                <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot .'excel_dounload/iot_startup_rised_funds.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('IotStartupsRisedFund',array("url"=>array("controller"=>"Iot","action"=>"startupRisedFundsImport"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
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
                        <?php echo $this->Html->link('List', array("controller" => "Iot", "action" => "startupRisedFundsList"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <?php echo $this->Form->create('IotStartupsRisedFund', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()", "url" => array("controller" => "Iot", "action" => "startupRisedFunds")));
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
                                            <label>Start Up Name <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("iot_start_up_id", array("type" => "select",'id'=>'ProgramName', "class" => "form-control", "required", "label" => false, "options"=>$startups,"empty" => "Start Up Name")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Date of Funding <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("date_of_funding", array("type" => "text", "class" => "form-control datepicker enableChk", "required", "label" => false, "placeholder" => "Date of Funding")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Amount in INR (Cr)<span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("amount", array("type" => "text", "class" => "form-control",  "required", "label" => false, "placeholder" => "Amount")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Founder Name </label>
                                            <?php echo $this->Form->input("founder_name", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Founder Name")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Public Announcement Link</label>
                                            <?php echo $this->Form->input("public_announcement_link", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Public Announcement Link")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label style="color: #ffffff">post incubation start ?</label><br/>
                                            <?php
                                            echo $this->Form->checkbox("is_incubation_start", array("type" => "checkbox","style"=>"display:none", "id"=>'basic_checkbox_2', "class" => "filled-in","label" => false, "empty" => "Title")); ?>
                                            <label for="basic_checkbox_2">Post incubation start ?</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 displayNone">
                                        <div class="form-group">
                                            <label>Month Year</label>
                                           <?php echo $this->Form->input("month",array("type"=>"text","value"=>"Jan-2020","label"=>false,"id"=>"monthPicker","class"=>"form-control",'placeholder'=>'Month Year','required'));?>  </div>
                                    </div>

                                </div>


                        <!-- /.row -->
                    </div>
                    <div class="box-footer">
                        <div class="clearfix pull-right pb-10">
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


    $('.enableChk').on('change',function () {
        if($(this).val().length>5 ) $('#basic_checkbox_2').prop('checked',true)
        else $('#basic_checkbox_2').prop('checked',false)


    })
    $('.startupRisedFundsList').addClass('active').parents('li').addClass('active')
</script>

