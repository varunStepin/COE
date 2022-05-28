<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Incubatee Team Details
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
            <li class="breadcrumb-item"><a href="#">Fabless</a></li>
            <li class="breadcrumb-item active">Incubatee Team Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <?php echo $this->Html->link('<span> Incubatee Team Details List</span>',array("controller"=>"Fabless","action"=>"incubateeTeamDetailsList"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <!-- Basic Forms -->
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <?php echo $this->Form->create('IncubateeTeamDetail',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Fabless","action"=>"incubateeTeamDetails")));
                                echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                                echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>


                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Team Member Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("team_member_name",array("type"=>"text","class"=>"form-control","placeholder"=>'Team Member Name',"required","label"=>false))?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Gender<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php $options = array('Male'=> 'Male','Female'=>'Female');
                                        $attributes = array('legend' => false,'','default' => 'Male');
                                        echo $this->Form->radio('gender', $options, $attributes); ?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Designation<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("designation",array("type"=>"text","class"=>"form-control ","placeholder"=>"Designation","required","label"=>false))?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Qualification<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("qualification",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Qualification"))?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("email",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Email"))?>

                                    </div>
                                </div>








                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.box -->
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Contact Person<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("contact_person",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Contact Person"))?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">City Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("city_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"City Name"))?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Date of Joining<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("date_of_joining",array("type"=>"text", "id"=>"datepicker","class"=>"form-control","required","label"=>false,"placeholder"=>"Date of Joining"))?>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("date_of_birth",array("type"=>"text", "id"=>"datepicker1","class"=>"form-control","required","label"=>false,"placeholder"=>"Date of Birth"))?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Address<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("address",array("type"=>"textarea","class"=>"form-control","required","rows"=>2,"label"=>false,"placeholder"=>"Address"))?>

                                    </div>
                                </div>

                                <div class="form-group row displayNone">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Year/Month<span class="text-danger">*</span></label>
                                    <div class="col-sm-4">
                                        <?php
                                        echo $this->Form->input("year",array("type"=>"select","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        echo $this->Form->input("month",array("type"=>"select","label"=>false,"options"=>$month_data,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('F')));?>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <div class="clearfix pull-right">
                                        <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                        <?php
                                        if(empty($this->request->data['IncubateeTeamDetail']['id']))
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<?php echo $this->Form->create('IncubateeTeamDetail',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Fabless","action"=>"incubateeTeamDetails")));
echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
echo $this->Form->end();
?>
<script>
    function addIdToForm(id,type){
        $('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
        if(type=='delete'){
            if(confirm('Are you sure you want to delete?')===false)
                return;
        }
        $('#fieldId').val(id)
        $('#actionType').val(type)
        $('#EditDeleteForm').submit();
    }

    $( function() {
        $( "#datepicker1" ).datepicker();
    } );
</script>


<script>
    $('.incubateeTeamDetailsList').addClass('active').parents('li').addClass('active');
</script>
