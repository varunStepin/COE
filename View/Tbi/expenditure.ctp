<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title ?>
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> TBI</a></li>
            <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
            <li class="breadcrumb-item active">Expenditure Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
             <div class="col-12 text-center"><span class="text-danger"><b>NOTE </b>:Please fill up the form for individual line items of expenditure.  For bulk upload, please download the sample template, fill it and upload the same</span></div>
            <div class="col-lg-1"></div>
            <div class="col-lg-10 col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('Expenditure list', array("controller" => "Tbi", "action" =>$action."List"), array("class" => "ml-5 btn btn-info btn-sm pull-right", "escape" => false,));  ?>

                        <a href="<?php echo $this->webroot .'excel_dounload/expense.xls'; ?>" class="btn btn-sm btn-outline-danger pull-right">Template Download <i
                                    class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5"
                           id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>
                        <div style="display: none">

                                <?php
                                echo $this->Form->create('Exel',array("url"=>array("controller"=>"Tbi","action"=>$action),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));

                                echo $this->Form->input('finance_year_id',array("type"=>"hidden","label"=>false,'required',"id"=>"excel_program_id"));
                                echo $this->Form->input('file',array("type"=>"file",'id'=>'excel_file',"class"=>"form-control doc_type","label"=>false));
                                echo $this->Form->end();
                                ?>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>

                        <?php echo $this->Form->create('Expenditure', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Tbi", "action" => $action)));
                        echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                        echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
                        echo $this->Form->input('document', array("type" => "hidden", "label" => false, 'required')); ?>

                        <div class="row">

                            <div class="col-lg-6 col-12">
                                <div class="form-group row ">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Phase<span  class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row ">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Financial Year<span  class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php            echo $this->Form->input("financial_year_id", array("type" => "select", "label" => false,"class" => "form-control", 'id' => 'fundYear', "options"=>$financialYear, 'required')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Amount Spent
                                        (INR)<span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("amount_spent", array("type" => "text", "class" => "form-control isNumber", "required", "label" => false, "placeholder" => "Amount Spent (INR)")) ?>
                                        <?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control", "value" => $this->request->data['Expenditure']['id'])); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Expense Type<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("expense_type", array("type" => "select", "empty" => "Select Expense Type", "options" => array('CAPEX' => 'CAPEX', 'OPEX' => 'OPEX'), "required", "class" => "form-control", "label" => false)) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Date of Expense (Start Date)<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("date", array("type" => "text", "autocomplete" => "off", "id" => "datepicker", "label" => false, 'class' => "form-control ", 'required', "placeholder" => "Start Date")); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Date of Expense(End Date)<span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("end_date", array("type" => "text", "autocomplete" => "off", "label" => false, 'class' => "datepicker form-control ", 'required', "placeholder" => "End Date")); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Details of
                                        Expenditure <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("details", array("type" => "textarea", "class" => "form-control", "label" => false, "rows" => '2', "placeholder" => "Details of Expenditure")) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Remarks <span
                                                class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("remarks", array("type" => "textarea","rows"=>2, "class" => "form-control", "required", "label" => false, "placeholder" => "Remarks")) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-5 col-form-label">Supporting Documents
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <?php echo $this->Form->input("document_new", array("type" => "file", "class" => "form-control", "label" => false)) ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
                                <?php
                                if (empty($this->request->data['Expenditure']['id'])) {
                                    echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-danger btn-sm", "label" => false));
                                } else {
                                    echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-danger btn-sm", "label" => false));
                                }
                                ?>

                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
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
<?php echo $this->Form->create('Expenditure', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "Tbi", "action" => $action)));
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
    $('#bulkUpload').on('click',function () {
 $('#excel_program_id').val($('#fundYear').val())
            $('#excel_file').click();

    });
    $('#excel_file').on('change',function () {
       

        $('#excel_import_form').submit();
    });
</script>
<script>
    var elementTitle='.<?=$action ?>'

    $(elementTitle).addClass('active').parents('li').addClass('active')
</script>
