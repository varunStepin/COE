<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            White Papers
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">White Paper</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('<span>White Paper List  </span>',array("controller"=>"Home","action"=>"whitePaperList"),array("escape"=>false,"class"=>'btn btn-primary pull-right'));?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo $this->Session->flash(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <?php echo $this->Form->create('WhitePaper',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"whitePaper")));
                                    echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                                    echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Title of the Paper<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("title_of_the_paper",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Title of the paper"))?>
                                        <?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['WhitePaper']['id']));?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Date<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("date",array("type"=>"text","class"=>"form-control","required","id"=>"datepicker","label"=>false,"placeholder"=>"Date"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Year<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("year",array("type"=>"select","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Topic of the Paper<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("paper_topic",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Topic of the Paper"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Month<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php
                                        echo $this->Form->input("month",array("type"=>"select","label"=>false,"options"=>$month_data,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('F')));?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3>Authors Details</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Author Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("author_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Author Name"))?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Author Email Id<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("author_mail_id",array("type"=>"email","class"=>"form-control","required","label"=>false,"placeholder"=>"Mail ID"))?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Address<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("author_address",array("type"=>"textarea","class"=>"form-control","required","label"=>false,"placeholder"=>"Author Address"))?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h3>Published Detail</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Paper Published?<span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="input radio"><input type="hidden" name="published_status" value=""><label class="custom-control custom-radio"><input type="radio" name="published_status" value="Yes" id="published_status-yes" checked="checked" class="custom-control-input"><span class="custom-control-label" id="published_status-yes" checked="checked"></span>Yes</label><label class="custom-control custom-radio"><input type="radio" name="published_status" value="No" id="published_status-no" class="custom-control-input"><span class="custom-control-label" id="published_status-no"></span>No</label></div>
                                        <?php echo $this->Form->input("published_status",array("type"=>"hidden","class"=>"form-control","label"=>false))?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">Paper Published Date</label>
                                    <div class="col-sm-8">
                                        <?php echo $this->Form->input("published_date",array("type"=>"text","class"=>"form-control","id"=>"datepicker1","label"=>false,'dateFormat' => 'd-m-Y',"placeholder"=>"published Date"))?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-8 clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn waring btn-sm","label"=>false)); ?>
                                <?php
                                    if(empty($this->request->data['WhitePaper']['id']))
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
<script>
    $(function() {
      $( "#datepicker1" ).datepicker()
    });
</script>
<script>

    $('.whitePaper').addClass('active').parents('li').addClass('active');
</script>
