<div class="container h-p100" id="loginForm">
    <div class="row align-items-center justify-content-md-center h-p100">

        <div class="col-lg-4 col-md-8 col-12">
            <div class="login-box">
                <div class="login-box-body">
<div class="row">

    <div class="col-12 "><a style="padding-left:42%" href="#"><img src="<?php echo $this->webroot ?>images/logo/logoNine.png" alt="logo" class="light-logo " ></a></div>
<div class="col-12 text-center"><h4>Department of Electronics  Information Technology  Biotechnology and Science & Technology</h4></div>
</div>



                    <p class="login-box-msg" style="margin-top: 10px;">Sign in to start your session</p>

                    <?php echo $this->Form->create('UserDetail',array("url"=>array("controller"=>"Home","action"=>"index"),'id'=>'formId') );  ?>
                        <div class="form-group has-feedback">
                            <?php 
							echo $this->Form->input('username',array("type"=>"text",'id'=>'username',"class"=>"form-control rounded","placeholder"=>"User Name","label"=>false,'required',"onblur"=>'dataSet1()', "onkeypress"=>'dataSet1()',"AUTOCOMPLETE"=>"off")); 
							
							echo $this->Form->input('username_hidden',array("type"=>"hidden",'id'=>'username_hidden',"class"=>"form-control rounded","label"=>false)); 
							?>
                        </div>
                        <div class="form-group has-feedback">
                            <?php 
							echo $this->Form->input('password',array("type"=>"password",'id'=>'password',"class"=>"form-control rounded","placeholder"=>"Password","label"=>false,'required',"onblur"=>'dataSet2()', "onkeypress"=>'dataSet2()',"oninput"=>'dataSet2()',"onchange"=>'dataSet2()',"onclick"=>'dataSet2()',"AUTOCOMPLETE"=>"off")); 
							
							echo $this->Form->input('password_hidden',array("type"=>"hidden",'id'=>'password_hidden',"class"=>"form-control rounded","label"=>false));
							?>
                        </div>
                           <div class="form-group has-feedback" >
                            <?php $user_types=array($user_types); echo  $this->Form->input('user_type',array("type"=>"select","class"=>"form-control rounded","options"=>$user_types,"label"=>false,'required')); ?>
                        </div>
						<div class="form-group has-feedback">
                            <?php 
								echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>$this->Session->read('CSRFTOKEN')));
							?>
                        </div>
                        
                        <div class="row">
                            <div class="col-6"></div>
                            <!-- /.col -->
                            
                            <!-- /.col -->
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-sm btn-info btn-block margin-top-10">SIGN IN.</button>
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

