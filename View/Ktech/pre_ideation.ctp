<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Pre-Ideation
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Ktech</a></li>
            <li class="breadcrumb-item active">Pre-Ideation</li>
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
                                <?php echo $this->Form->create('KtechPreIdeation', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Ktech", "action" => "preIdeation")));
                                echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                                echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert")); ?>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Name of the Program<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("tbi_startup_id", array("type" => "select", "options" => $unselectedStartUps, "class" => "form-control startUpId", "required", "label" => false, "empty" => "Startup Name"));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Candidate Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("candidate_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Name of Candidate")) ?>
                                        <?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control", "value" => $this->request->data['KtechHackthon']['id'])); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Organization Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("organization_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Organization Name")) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email Id<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("email_id", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Email Address")) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Phone Number<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("phone_number", array("type" => "text", "label" => false, "class" => "form-control", 'placeholder' => 'Phone Number', 'required')); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Address<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("address", array("type" => "text", "label" => false, "class" => "form-control", 'placeholder' => 'Address', 'required')); ?>
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
                                        if (empty($this->request->data['KtechPreIdeation']['id'])) {
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
                                        <th>Program Name</th>
                                        <th>Candidate Name</th>
                                        <th>Organization Name</th>
                                        <th>Email Address</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($table_list)) {
                                        foreach ($table_list as $list) {
                                            $id = $list['KtechPreIdeation']['id'];
                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $list['TbiStartup']['startup_name']; ?></td>
                                                <td><?php echo $list['KtechPreIdeation']['candidate_name']; ?></td>
                                                <td><?php echo $list['KtechPreIdeation']['organization_name']; ?></td>
                                                <td><?php echo $list['KtechPreIdeation']['email_id']; ?></td>
                                                <td><?php echo $list['KtechPreIdeation']['phone_number']; ?></td>
                                                <td><?php echo $list['KtechPreIdeation']['address']; ?></td>
                                            <!--<td><?php /*echo $list['KtechFundRaisedStartup']['month'] .'-'. $list['KtechFundRaisedStartup']['year'];*/ ?></td>-->
                                                <td>
                                                    <a href="#" onclick="addIdToForm(<?php echo $id ?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                                    <a href="#" onclick="addIdToForm(<?php echo $id ?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></a>
                                                </td>
                                            </tr>
                                    <?php   }
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
<?php echo $this->Form->create('KtechPreIdeation', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "Ktech", "action" => "preIdeation")));
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
    $('.ktechPreideation').addClass('active').parents('li').addClass('active')
</script>