<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Start-ups Accelerated Virtual
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Innovators Accelerated</a></li>
            <li class="breadcrumb-item active">Start-ups Accelerated Virtual</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                
                <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot .'excel_dounload/ds_start_ups_accelerated_virtual.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('DsAiVirtualAccStartup',array("url"=>array("controller"=>"DsAndAi","action"=>"startupsAcceleratedVirtualImport"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
                            echo $this->Form->input('file',array("type"=>"file",'id'=>'excel_file',"class"=>"form-control doc_type","label"=>false));
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('List', array("controller" => "DsAndAi", "action" => "startupsAcceleratedVirtualList"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <?php echo $this->Form->create('DsAiVirtualAccStartup', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()", "url" => array("controller" => "DsAndAi", "action" => "startupsAcceleratedVirtual")));
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
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Phase <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Start Up Name <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("start_up_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Start Up Name")); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Date of Incubation <span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("date_of_incubation", array("type" => "text", "class" => "form-control", "id" => "datepicker", "required", "label" => false, "placeholder" => "Date of Incubation")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Date of Graduation </label>
                                            <?php echo $this->Form->input("date_of_graduation", array("type" => "text", "class" => "form-control datepicker", "label" => false, "placeholder" => "Date of Graduation")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Founder Name</label>
                                            <?php echo $this->Form->input("founder_name", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Founder Name")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Url (without http, https, www)</label>
                                            <?php echo $this->Form->input("url", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "url")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Founder Email</label>
                                            <?php echo $this->Form->input("founder_email", array("type" => "email", "class" => "form-control", "label" => false, "placeholder" => "Founder Email")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Founder Mobile</label>
                                            <?php echo $this->Form->input("mobile", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Mobile")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>No of Employees</label>
                                            <?php echo $this->Form->input("no_employees", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "No of Employees")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>No of Women  Employees </label>
                                            <?php echo $this->Form->input("no_employees_women", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "No of Women  Employees")); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>	No of Women co-founder</label>
                                            <?php echo $this->Form->input("no_women_cofounder", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "No of Women co-founder")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Founder Education</label>
                                            <?php echo $this->Form->input("founder_education", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Founder Education")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Founders Total Man Year	Experience</label>
                                            <?php echo $this->Form->input("founders_total_man_year", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Founders Total Man Year Experience")); ?>
                                        </div>
                                    </div>



                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Valuation at the start</label>
                                            <?php echo $this->Form->input("valuation_at_start", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Valuation at the start")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Valuation current</label>
                                            <?php echo $this->Form->input("valuation_current", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Valuation current")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Head Count at the start</label>
                                            <?php echo $this->Form->input("head_count_at_start", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Head Count at the start")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Head Count current</label>
                                            <?php echo $this->Form->input("head_count_current", array("type" => "text", "class" => "form-control", "label" => false, "placeholder" => "Head Count current")); ?>
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Status at start of incubation</label>
                                            <?php $options=["Idea"=>"Idea","Prototype"=>"Prototype","POC"=>"POC","Early market"=>"Early market","Growth"=>"Growth"];
                                            echo $this->Form->input("status_at_start", array("type" => "select", "class" => "form-control", "label" => false,"options"=>$options, "empty" => "status")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-3 displayNone">
                                        <div class="form-group">
                                            <label>Month Year</label>
                                           <?php echo $this->Form->input("month",array("type"=>"text","label"=>false,"id"=>"monthPicker","class"=>"form-control","value"=>"Jan-2020",'placeholder'=>'Month Year','required'));?>  </div>
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
        $('#excel_file').click();
    });

    $('#excel_file').on('change',function () {
        $('#excel_import_form').submit();
    });
    $('.startupsAcceleratedVirtual').addClass('active').parents('li').addClass('active')
</script>

