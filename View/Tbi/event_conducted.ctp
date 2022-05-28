<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>
            <?= $details['TbiTitle'] ?>
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">TBI</a></li>
            <li class="breadcrumb-item active">Events Conducted</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php echo $this->Form->create('TbiEvent', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => $details['Controller'], "action" => "eventConducted")));
                                echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                                echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
                                echo $this->Form->input('id', array("type" => "hidden", "label" => false,)); ?>
                                <div class="form-group ">
                                    <label for="example-text-input" class="col-form-label">Phase <span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input("phase", array("type" => "select", "options" => AppController::getPhase(), "empty" => "Select Phase", "class" => "form-control", "required", "label" => false)) ?>

                                </div>
                                <div class="form-group ">
                                    <label for="example-text-input" class="col-form-label">Event Name <span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input("event_name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Event Name")) ?>

                                </div>
                                <div class="form-group ">
                                    <label for="example-text-input" class="col-form-label">Event date <span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input("event_date", array("type" => "text", "id" => "datepicker", "class" => "form-control st_date", "required", "label" => false, "placeholder" => "Event date")) ?>

                                </div>
                                <div class="form-group ">
                                    <label for="example-text-input" class="col-form-label">Event Location <span class="text-danger">*</span></label>
                                    <?php echo $this->Form->input("event_location", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Location of Event")) ?>

                                </div>
                                <div class="box-footer">
                                    <div class="clearfix pull-right">
                                        <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "_cancel btn btn-danger btn-sm", "label" => false)); ?>
                                        <?php
                                        if (empty($this->request->data['TbiEvent']['id'])) {
                                            echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-success btn-sm", "label" => false));
                                        } else {
                                            echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-success btn-sm", "label" => false));
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
                                        <th>Event Name</th>
                                        <th>Event Date</th>
                                        <th>Event Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($manage_list)) {

                                        foreach ($manage_list as $manage) {
                                            $id = $manage['TbiEvent']['id'];
                                    ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $manage['TbiEvent']['phase'] ?></td>
                                                <td><?php echo $manage['TbiEvent']['event_name'] ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($manage['TbiEvent']['event_date'])); ?></td>
                                                <td><?php echo $manage['TbiEvent']['event_location']; ?></td>
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
                </div>
            </div>
        </div>
    </section>
</div>
<?php echo $this->Form->create('TbiEvent', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => $details['Controller'], "action" => "eventConducted")));
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
    var conrtoller = '.<?= $details['Controller'] ?>eventConducted'
    $(conrtoller).addClass('active').parents('li').addClass('active')
</script>