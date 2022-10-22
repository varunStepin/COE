<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Graduates - Finishing School
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>', array("controller" => "Admin", "action" => "dashboard"), array("escape" => false)); ?>
            </li>
            <li class="breadcrumb-item"><a href="#">Animation, Visual Effects</a></li>
            <li class="breadcrumb-item active">Graduates - Finishing School</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot . 'excel_dounload/graduateSchoolList.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('GraduateSchool', array("url" => array("controller" => "Home", "action" => "graduateSchoolImport"), "class" => "form-horizontal", 'id' => 'excel_import_form', "type" => "file", 'onsubmit' => "return addCsrfToken()"));
                            echo $this->Form->input('file', array("type" => "file", 'id' => 'excel_file', "class" => "form-control doc_type", "label" => false));
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
                </div>

                <div class="box">

                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php echo $this->Form->create('GraduateSchool', array("class" => "form-horizontal", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Home", "action" => "graduateSchoolList")));
                                echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                                echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert")); ?>


                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Program Name
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("graduation_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Program Name")) ?>
                                        <?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control", "value" => $this->request->data['GraduateSchool']['id'])); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Batch No<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("batch_no", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Batch No")) ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Date of Commencement<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("date_of_graduation", array("type" => "text", "autocomplete" => "off", "id" => "datepicker", "label" => false, 'class' => "form-control ", 'required', 'placeholder' => 'DD-MM-YYYY')); ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Name of the Candidate<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("name_of_the_graduate", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Name of the Candidate")) ?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Institute Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("institute_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Institute Name")) ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Address<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("address", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Address")) ?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Mobile No<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("mobile_no", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Mobile No")) ?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("email", array("type" => "email", "class" => "form-control", "required", "label" => false, "placeholder" => "Email")) ?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">City<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("city", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "City")) ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Phase<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("phase", array("type" => "select", "options" => ['Phase 1' => 'Phase 1', 'Phase 2' => 'Phase 2'], "empty" => "Select", "class" => "form-control", "required", "label" => false, "placeholder" => "Venue")) ?>

                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="clearfix pull-right">
                                        <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
                                        <?php
                                        if (empty($this->request->data['GraduateSchool']['id'])) {
                                            echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-danger btn-sm", "label" => false));
                                        } else {
                                            echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-danger btn-sm", "label" => false));
                                        }
                                        ?>

                                    </div>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                </div>
                <!-- /.box -->
            </div>

            <div class="col-lg-7 col-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table example_long table-striped table-bordered table-hover">
                                <thead style="font-size:15px; font-weight:bold;">
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Program Name</th>
                                        <th>Batch No</th>
                                        <th>Date of Commencement</th>
                                        <th>Name of the Candidate</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Phase</th>
                                        <th>Institute Name</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    if (!empty($manage_list)) {

                                        foreach ($manage_list as $list) {
                                            $id = $list['GraduateSchool']['id'];
                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $list['GraduateSchool']['graduation_name']; ?></td>
                                                <td><?php echo $list['GraduateSchool']['batch_no']; ?></td>
                                                <td><?php echo date('d M Y', strtotime($list['GraduateSchool']['date_of_graduation'])); ?></td>
                                                <td><?php echo $list['GraduateSchool']['name_of_the_graduate']; ?></td>
                                                <td><?php echo $list['GraduateSchool']['mobile_no']; ?></td>
                                                <td><?php echo $list['GraduateSchool']['email']; ?></td>
                                                <td><?php echo $list['GraduateSchool']['city']; ?></td>
                                                <td><?php echo $list['GraduateSchool']['phase']; ?></td>
                                                <td><?php echo $list['GraduateSchool']['institute_name']; ?></td>
                                                <td><?php echo $list['GraduateSchool']['address']; ?></td>
                                                <td>
                                                    <a href="#" onclick="addIdToForm(<?php echo $id ?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                                    <a href="#" onclick="addIdToForm(<?php echo $id ?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>


                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
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
<?php echo $this->Form->create('GraduateSchool', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "Home", "action" => "graduateSchoolList")));
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
        $('#fieldId').val(id)
        $('#actionType').val(type)
        $('#EditDeleteForm').submit();
    }
</script>
<script>
    $('#bulkUpload').on('click', function() {
        $('#excel_file').click();
    });

    $('#excel_file').on('change', function() {
        $('#excel_import_form').submit();
    });
    $('.graduates_school').addClass('active').parents('li').addClass('active');
</script>