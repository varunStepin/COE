<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">

        <div class="col-lg-4 col-md-8 col-12">
            <div class="login-box">
                <div class="login-box-body">
<div class="row">
  
    <div class="col-12 "><img src="<?php echo $this->webroot ?>images/logo/nain_logo.png" alt="logo" class="light-logo "></div>
</div>



                    <p class="login-box-msg" style="    margin-top: 10px;">Sign in to start your session1</p>

                    <?php echo $this->Form->create("UserDetail",array("url"=>array("controller"=>"Home","action"=>"index")));?>
                        <div class="form-group has-feedback">
                            <?php echo $this->Form->input('mobile',array("type"=>"text","class"=>"form-control rounded","placeholder"=>"User Name","label"=>false,'required',"AUTOCOMPLETE"=>"off")); ?>
                        </div>
                        <div class="form-group has-feedback">
                            <?php echo $this->Form->input('password',array("type"=>"password","class"=>"form-control rounded","placeholder"=>"Password","label"=>false,'required',"AUTOCOMPLETE"=>"off")); ?>
                        </div>
                        <div class="form-group has-feedback">
                            <?php echo $this->Form->input('user_type',array("type"=>"select","class"=>"form-control rounded","options"=>$user_types,"label"=>false,'required')); ?>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <!-- /.col -->
                            
                            <!-- /.col -->
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-sm btn-info btn-block margin-top-10">SIGN IN</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    <?php echo $this->Form->end(); ?>
                    <div class="margin-top-30 text-center">
                        <a href="javascript:void(0)" class="text-danger"><?php echo $this->Session->flash(); ?></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
