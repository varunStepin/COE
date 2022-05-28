<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Industries Connected
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">Industries Connected</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pt-0">
		
        <div class="row">

            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot .'excel_dounload/industries_connected.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('IotIndustryConnected',array("url"=>array("controller"=>"Iot","action"=>"industriesConnectedImport"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
                            echo $this->Form->input('file',array("type"=>"file",'id'=>'excel_file',"class"=>"form-control doc_type","label"=>false));
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('Industries Connected List ', array("controller" => "Iot", "action" => "industryConnectedList"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <?php echo $this->Form->create('IotIndustryConnected', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()", "url" => array("controller" => "Iot", "action" => "industryConnected")));
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
                            <div class="col-12">


                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group ">
							                <label>Phase<span class="text-danger">*</span></label>
							                <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
						                </div>
                                   
                                        <div class="form-group">
                                            <label>Company Name <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("company_name", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Company Name",'required')); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Tech Support </label>
                                            <?php echo $this->Form->input("tech_support", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Tech Support")); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Adopter / Co-Create </label>
                                            <?php echo $this->Form->input("adopter", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Adopter / Co-Create")); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>Purpose <span data-toggle="tooltip" class="text-danger font-size-10" title='“Infra (e.g. cloud), Tech support, Adopter/co-create” '>(?) </span></label>
                                            <?php echo $this->Form->input("purpose", array("type" => "textarea", 'rows'=>'5', "class" => "form-control", "label" => false, "placeholder" => "Purpose")); ?>
                                        </div>
                                        <div class="form-group displayNone">
                                            <label>Month Year</label>
                                           <?php echo $this->Form->input("month",array("type"=>"text","value"=>"Jan-2020","label"=>false,"id"=>"monthPicker","class"=>"form-control",'placeholder'=>'Month Year','required'));?>  </div>
                                    </div>

                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="box-footer">
                        <div class="clearfix pull-right pb-10">
                            <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn waring btn-sm","label"=>false)); ?>
                            <?php
                            if(empty($this->request->data['IotIndustryConnected']['id']))
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
        $('.error_ale').remove();
    });


    $('#excel_file').on('change',function () {
        $('#excel_import_form').submit();
    });
</script>

<script>
    $('.IndustryConnected').addClass('active').parents('li').addClass('active')
</script>

