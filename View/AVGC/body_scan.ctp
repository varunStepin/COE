<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Body Scan 360
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Ktech</a></li>
            <li class="breadcrumb-item active">Body Scan 360</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php echo $this->Form->create('AvgcIncubation', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "AVGC", "action" => "computerGeneratedImagery")));
                                echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                                echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert")); ?>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Phase<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("phase", array("type" => "select", "options" => AppController::getPhase(), "empty" => "Select Phase", "class" => "form-control", "required", "label" => false)) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Startup Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("startup_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Startup Name")) ?>
                                        <?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control", "value" => $this->request->data['KtechHackthon']['id'])); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Incubation Start Date<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("incubation_start_date", array("type" => "text", "autocomplete" => "off", "id" => "datepicker", "label" => false, 'class' => "form-control ", 'required', 'placeholder' => 'DD-MM-YYYY')); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Founder Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("founder_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Founder Name")) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Address<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("address", array("type" => "text", "label" => false, "class" => "form-control", 'placeholder' => 'Address', 'required')); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email Address<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("email_id", array("type" => "text", "label" => false, "class" => "form-control", 'placeholder' => 'Email Address', 'required')); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Mobile Number<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("mobile_number", array("type" => "text", "label" => false, "class" => "form-control", 'placeholder' => 'Mobile Number', 'required')); ?>
                                    </div>
                                </div>
                                <div class="form-group row displayNone">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Month-Year<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("month", array("type" => "text", "value" => date('F-Y'), "label" => false, "id" => "monthPicker", "class" => "form-control", 'placeholder' => 'MMM-YYYY', 'required')); ?>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="clearfix pull-right">
                                        <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
                                        <?php
                                        if (empty($this->request->data['AvgcIncubation']['id'])) {
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
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table example_long table-striped table-bordered table-hover">
                                <thead style="font-size:15px; font-weight:bold;">
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Startup Name</th>
                                        <th>Founder Name</th>
                                        <th>Email Address</th>
                                        <th>Mobile Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($table_list)) {
                                        foreach ($table_list as $list) {
                                            if ($list['AvgcIncubation']['type'] == 'Body Scan') {
                                                $id = $list['AvgcIncubation']['id'];
                                    ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $list['AvgcIncubation']['startup_name']; ?></td>
                                                    <td><?php echo $list['AvgcIncubation']['founder_name']; ?></td>
                                                    <td><?php echo $list['AvgcIncubation']['email_id']; ?></td>
                                                    <td><?php echo $list['AvgcIncubation']['mobile_number']; ?></td>
                                                    <td><?php echo $list['AvgcIncubation']['address']; ?></td>
                                                    <!--<td><?php /*echo $list['KtechFundRaisedStartup']['month'] .'-'. $list['KtechFundRaisedStartup']['year'];*/ ?></td>-->
                                                    <td>
                                                        <a href="#" onclick="addIdToForm(<?php echo $id ?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                                        <a href="#" onclick="addIdToForm(<?php echo $id ?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></a>
                                                    </td>
                                                </tr>
                                    <?php   }
                                        }
                                    }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php echo $this->Form->create('AvgcIncubation', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "AVGC", "action" => "computerGeneratedImagery")));
echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftokenEdit', "label" => false, 'required', 'value' => ' '));
echo $this->Form->input('id', array("type" => "hidden", "label" => false, 'required', "id" => "fieldId"));
echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "id" => "actionType"));
echo $this->Form->end();
?>
<script>
    function addIdToForm(id, type) {

        $('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
        if (type == 'delete') {
            if (confirm('Are you sure you want to delete?') === false)
                return;
        }
        $('#fieldId').val(id);
        $('#actionType').val(type);
        $('#EditDeleteForm').submit();


    }
</script>
<script>
    $('.scan').addClass('active').parents('li').addClass('active')
</script>