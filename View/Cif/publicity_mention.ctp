<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Publicity Mentions in Newspaper or media platform
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#"> CIF</a></li>
            <li class="breadcrumb-item active">Publicity Mentions</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php echo $this->Form->create('CifPublicityMention', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Cif", "action" => 'publicityMention')));
                                echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                                echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
                                echo $this->Form->input('id', array("type" => "hidden", "label" => false)); ?>
                                <div class="form-group ">
                                    <label for="example-text-input" class=" col-form-label">Phase<span class="text-danger">*</span></label>
                                    <?php
										  echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
                                </div>
                                <div class="form-group ">
                                    <label for="example-text-input" class=" col-form-label">Year<span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input("year", array("type" => "select", "label" => false, "options" => $years_list, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('Y'))); ?>
                                </div>

                                <div class="form-group ">
                                    <label for="example-text-input" class=" col-form-label">Media Type<span class="text-danger">*</span></label>
                                    <?php $options = ["News Paper" => "News Paper", "Online Platform" => "Online Platform"];
                                    echo $this->Form->input("media_type", array("type" => "select", "class" => "form-control", "label" => false, "options" => $options, "empty" => "Select Media Type", "required")); ?>
                                </div>

                                <div class="form-group ">
                                    <label for="example-text-input" class=" col-form-label">Media Name<span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input("media_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Publication/ Paper/ Online Platform Name")) ?>
                                </div>
                                <div class="form-group">
                                    <label>Published Date<span class="text-danger"> *</span></label>
                                    <?php echo $this->Form->input("published_date", array("type" => "text", "class" => "form-control datepicker", "id" => "datepicker", "required", "label" => false, "placeholder" => "Published Date")); ?>
                                </div>
                                <div class="form-group ">
                                    <?php
                                    $doc_req = 'required';
                                    if ($this->request->data['CifPublicityMention']['image'] != '') $doc_req = '';
                                    ?>
                                    <label for="example-text-input" class=" col-form-label">Upload Image<span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input("image", array("type" => "file", $doc_req, "class" => "form-control", "label" => false));
                                    echo $this->Form->input('image_old', array("type" => "hidden", "label" => false, "value" => $this->request->data['CifPublicityMention']['image'])); ?>
                                    <span class="text-danger"><?= $this->request->data['CifPublicityMention']['image'] ?></span>
                                </div>
                                <div class="box-footer">
                                    <div class="clearfix pull-right">
                                        <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
                                        <?php
                                        if (empty($this->request->data['CifPublicityMention']['id'])) {
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-lg-8 col-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table example_long table-striped table-bordered table-hover">
                                <thead style="font-size:15px; font-weight:bold;">
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Phase</th>
                                        <th>Year</th>
                                        <th>Media Type</th>
                                        <th>Media Name</th>
                                        <th>Published Date</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($manage_list)) {

                                        foreach ($manage_list as $manage) {
                                            $id = $manage['CifPublicityMention']['id'];
                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $manage['CifPublicityMention']['phase']; ?></td>
                                                <td><?php echo $manage['CifPublicityMention']['year']; ?></td>
                                                <td><?php echo $manage['CifPublicityMention']['media_type']; ?></td>
                                                <td><?php echo $manage['CifPublicityMention']['media_name']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($manage['CifPublicityMention']['published_date'])); ?></td>
                                                <td><?php if ($manage['CifPublicityMention']['image'] != "") { ?>
                                                        <a href="<?php echo $this->webroot; ?>cif_publicity_mention/<?php echo $manage['CifPublicityMention']['image']; ?>" target="_blank">View</a>
                                                    <?php } ?>
                                                </td>

                                                <td>
                                                    <a href="#" onclick="addIdToForm(<?php echo $id ?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                                    <a href="#" onclick="addIdToForm(<?php echo $id ?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
                                                </td>
                                            </tr>
                                    <?php   }
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
<?php echo $this->Form->create('CifPublicityMention', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "Cif", "action" => 'publicityMention')));
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
    $('.publicityMention').addClass('active').parents('li').addClass('active')
</script>