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
                        <a href="<?php echo $this->webroot .'excel_dounload/international_delegations.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('IotDelegation',array("url"=>array("controller"=>"Iot","action"=>"iotDelegationImport"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
                            echo $this->Form->input('file',array("type"=>"file",'id'=>'excel_file',"class"=>"form-control doc_type","label"=>false));
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('List', array("controller" => "Iot", "action" => "delegationList"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <?php echo $this->Form->create('IotDelegation', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()", "url" => array("controller" => "Iot", "action" => "delegation")));
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
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Phase <span class="text-danger"> *</span></label>
                                            <?php  echo $this->Form->input("phase", array("type" => "select", "options" => AppController::getPhase(), "empty" => "Select Phase", "class" => "form-control", "required", "label" => false)) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Name")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Gender <span class="text-danger">*</span></label>
                                            <br/>
                                            <?php $options = array('Male'=> 'Male','Female'=>'Female');
                                            $attributes = array('legend' => false,'','default' => 'Male');
                                            echo $this->Form->radio('gender', $options, $attributes); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Arrived From <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("arrived_from", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Arrived From")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Date of Visit <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("date_of_visit", array("type" => "text", "class" => "form-control", "id" => "datepicker", "required", "label" => false, "placeholder" => "Date of Visit ")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Nos of  people<span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("no_of_people", array("type" => "text", "class" => "form-control",  "required", "label" => false, "placeholder" => "Nos of  people")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Industry type </label>
                                            <?php echo $this->Form->input("industry_type", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Industry type")); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-4 displayNone">
                                        <div class="form-group">
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
        $('.error_ale').remove();
    });


    $('#excel_file').on('change',function () {
        $('#excel_import_form').submit();
    });
</script>

<script>
    $('.delegation').addClass('active').parents('li').addClass('active')
</script>

