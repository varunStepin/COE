<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Change Password
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Change Password</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-lg-6"><h5>Reset Your Password</h5></div>
                            <?php echo $this->Form->create("UserDetail",array('onsubmit'=>"return addCsrfToken()","url"=>array("controller"=>"Home","action"=>"changePassword")));
                            echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                            ?>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">New Password</label>
                                    <?php echo $this->Form->input('password',array('type'=>'text','class'=>'form-control',"autocomplete"=>"off",'required',
                                        "placeholder"=>"New Password","label"=>false));?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                    <?php echo $this->Form->input('confirm_password',array('type'=>'password','class'=>'form-control',"autocomplete"=>"off",'required',
                                        "placeholder"=>"Confirm Password","label"=>false));?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Change Password",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>

        </div>
    </section>
</div>




