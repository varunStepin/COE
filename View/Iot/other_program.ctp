<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/advance_elements'); ?>
<?php  echo $this->Html->script('check_file_type');?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Other Program
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active"> Other Program</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content pt-20">

        <div class="row">
            <div class="col-lg-12">


                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('List', array("controller" => "Iot", "action" => "otherProgramList"), array("class" => "btn btn-info btn-sm pull-right", "escape" => false,));

                        ?>
                    </div>
                    <?php echo $this->Form->create('IotOtherProgram', array("class" => "form-horizontal","type"=>"file", 'onsubmit' => "return addCsrfToken()", "url" => array("controller" => "Iot", "action" => "otherProgram")));
                    echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
                    echo $this->Form->input('actionType', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
                    echo $this->Form->input('id', array("type" => "hidden", "label" => false));
                    echo $this->Form->input('image', array("type" => "hidden", "label" => false));
                    ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Type of Program <span class="text-danger"> *</span></label>
                                            <?php  $types=["Workshop"=>"Workshop","Investor Connect"=>"Investor Connect", "Demo Day"=>"Demo Day","Startup Showcase"=>"Startup Showcase", "Industry/Enterprise Connect"=>"Industry/Enterprise Connect", "Shark Tank"=>"Shark Tank","Boot Camp"=>"Boot Camp","International Connect"=>"International Connect","Soft-landing"=>"Soft-landing", "EDP in Tier- II/III Cities"=> "EDP in Tier- II/III Cities"];

											echo $this->Form->input("prog_type", array("type" => "select", "class" => "form-control", "required", "label" => false,"options"=>$types, "empty" => "Type of Program")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Is it Women Entrepreneurship Event <span class="text-danger"> *</span></label>
											<br/>
                                    <?php $options = array('YES'=> 'YES','No'=>'No');
                                    $attributes = array('legend' => false,'','default' => 'No');
                                    echo $this->Form->radio('women_event', $options, $attributes); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Session Date<span class="text-danger"> *</span></label>
                                            <?php echo $this->Form->input("session_date", array("type" => "text","required","class" => "form-control", "id" => "datepicker", "required", "label" => false, "placeholder" => "Session Date")); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Topic</label>
                                            <?php echo $this->Form->input("topic", array("type" => "text", "required","class" => "form-control", "label" => false, "placeholder" => "Topic")); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Number of attendees</label>
                                            <?php echo $this->Form->input("no_of_attended", array("type" => "text","required", "class" => "form-control isNumber", "label" => false, "placeholder" => "Number of attendees")); ?>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label>Image of the session</label>
                                            <?php echo $this->Form->input("image_file", array("type" => "file","class" => "form-control image_type", "label" => false)); ?>
											<?php if($this->request->data['IotOtherProgram']['image']!=''){
														echo '<a class="text-danger" target="_blank" href="'.$this->webroot.$this->request->data['IotOtherProgram']['image'].'">Uploaded</a>';
											} ?>
                                        </div>
                                    </div>
									<div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Speaker(s) / Investor(s) <span class='text-danger'>Use comma to separate names</span></label>
                                            <?php echo $this->Form->input("speaker", array("type" => "textarea","required","rows"=>3, "class" => "form-control", "label" => false, "placeholder" => "Speaker(s) , Investor(s) , Jury(s) , Company(s), Showcased To Enterprise(s) ")); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Emails of the attendees<span class='text-danger'> Use comma to separate emails </span> </label>
                                            <?php echo $this->Form->input("email", array("type" => "textarea","rows"=>3, "class" => "form-control", "label" => false, "placeholder" => "test@email.com, test2@gmail.com")); ?>
                                        </div>
                                    </div>
                                </div>
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
    $('.IotOtherProgram').addClass('active').parents('li').addClass('active')
</script>

