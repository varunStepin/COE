<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Other Programs
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">Other Programs</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('Add Programs', array("controller" => "Iot", "action" => "otherProgram"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false)); ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table example_long table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Type of Program</th>
                                        <th>Is it Women Entrepreneurship Event</th>
                                        <th>Session Date</th>
                                        <th>Topic</th>
                                        <th>Speaker(s) / Investor(s)</th>
                                        <th>Number of attendees</th>
                                        <th>Emails of the attendees</th>
                                        <th>Session Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$i = 1;
									if (!empty($data_list)) {
										foreach ($data_list as $list) {
											$id = $list['IotOtherProgram']['id'];
									?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>

                                        <td><?php echo $list['IotOtherProgram']['prog_type']; ?></td>
                                        <td><?php echo $list['IotOtherProgram']['women_event']; ?></td>
                                        <td><?php $date1 = $list['IotOtherProgram']['session_date'];
														echo ($date1) ? date('d-m-Y', strtotime($date1)) : '';
														?></td>

                                        <td><?php echo $list['IotOtherProgram']['topic']; ?></td>
                                        <td><?php echo $list['IotOtherProgram']['speaker']; ?></td>
                                        <td><?php echo $list['IotOtherProgram']['no_of_attended']; ?></td>
                                        <td><?php echo $list['IotOtherProgram']['email']; ?></td>
                                        <td><?php if ($list['IotOtherProgram']['image'] != '') {
															echo '<a class="text-danger" target="_blank" href="' . $this->webroot . $list['IotOtherProgram']['image'] . '">Uploaded <i style="font-size:12px;" class="glyphicon glyphicon-eye"></a>';
														} ?>
                                        </td>
                                        <td>
                                            <a href="#" onclick="addIdToForm(<?php echo $id ?>,'delete')"><i
                                                    style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                            <a href="#" onclick="addIdToForm(<?php echo $id ?>,'edit')"><i
                                                    style="font-size:12px;"
                                                    class="glyphicon glyphicon-edit"></i></i></a>


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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php echo $this->Form->create('IotOtherProgram', array("url" => array("controller" => "Iot", "action" => "otherProgram"), "id" => "EditDeleteForm"));
echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftokenEdit', "label" => false, 'required', 'value' => ' '));
echo $this->Form->input('id', array("type" => "hidden", "label" => false, 'required', "id" => "fieldId"));
echo $this->Form->input('actionType', array("type" => "hidden", "label" => false, 'required', "id" => "actionType"));
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
$('.IotOtherProgram').addClass('active').parents('li').addClass('active');
</script>