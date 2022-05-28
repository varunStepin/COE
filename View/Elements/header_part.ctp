<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo -->
	  <!--<b class="logo-mini">
		  <span class="light-logo"><img src="<?php echo $this->webroot ?>images/logo/updated-logo.png" alt="logo"></span>
		  <span class="dark-logo"><img src="<?php echo $this->webroot ?>images/logo/updated-logo.png" alt="logo"></span>
	  </b>-->
      <!-- logo-->
      <span class="logo-lg">
		  <img style="margin-bottom: 10px;height:55px;" src="<?php echo $this->webroot ?>images/logo/nain_logo.png" alt="logo"  class="light-logo"> <span style="font-size:25px;">ITBTST</span>
	  	  <img src="<?php echo $this->webroot ?>images/logo/nain_logo.png" alt="logo" class="dark-logo ">
	  </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
	  <div>
		  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>

		  </a>
          <span class="institution_title"> K-tech Hubs Dashboard</span>
	  </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Tasks-->
        
		  <!-- User Account-->
		  	<?php
			if($this->request->params['controller']=='Admin' || $this->request->params['controller']=='Dashboard') { ?>
          <li class="mr-15">
            <?php $appPhase= ($this->Session->read('Phase')=='Phase 1')?'Phase 2':'Phase 1' ?>
              <a href="#"  onclick="setPhase('<?php echo $appPhase ?>')" class="btn btn-block btn-outline btn-sm btn-white font-size-16 font-weight-600 mt-10 pl-20 pr-20">  <?= $appPhase ?></a>
          </li>
					<?php } ?>
		  <?php if($this->Session->read('USER_TYPE')=='Admin') { ?>
          <li class="mr-15">
            <?php $appType= ($this->Session->read('ApplicationType')=='CIF')?'COE':'CIF' ?>
              <a href="#" class="btn btn-block btn-outline btn-sm btn-white font-size-16 font-weight-600 mt-10 pl-20 pr-20" onclick="changeApplication('<?= $appType ?>')">  <?= $appType ?></a>
          </li>
          <li class="mr-15">
            <?php $appType= ($this->Session->read('ApplicationType')=='TBI')?'COE':'TBI' ?>
              <a href="#" class="btn btn-block btn-outline btn-sm btn-white font-size-16 font-weight-600 mt-10 pl-20 pr-20" onclick="changeApplication('<?= $appType ?>')">  <?= $appType ?></a>
          </li>
            <?php } ?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php  if ($this->Session->read('USER_PROFILE') && file_exists ( WWW_ROOT."/images/profile/".$this->Session->read('USER_PROFILE'))){ ?>
                    <img src="<?php echo $this->webroot ?>images/profile/<?php echo $this->Session->read('USER_PROFILE');?>" class="user-image rounded-circle" alt="User Image">
                <?php  }
                else { ?>
                    <img src="<?php echo $this->request->webroot;?>images/profile/default_user_pic.png" class="user-image rounded-circle" alt="User Image">
                <?php } ?>
            </a>
            <ul class="dropdown-menu scale-up">
              <!-- User image -->
              <li class="user-header">
                <?php  if ($this->Session->read('USER_PROFILE') && file_exists ( WWW_ROOT."/images/profile/".$this->Session->read('USER_PROFILE'))){ ?>
                      <img src="<?php echo $this->webroot; ?>images/profile/<?php echo $this->Session->read('USER_PROFILE');?>" style=" height: 85px; width:85px;" class="float-left rounded-circle " alt="User Image">
                  <?php  }
                  else { ?>
                      <img src="<?php echo $this->request->webroot;?>images/profile/default_user_pic.png" class="float-left rounded-circle" alt="User Image">
                  <?php } ?>
                <p>
                  <?php echo $this->Session->read('USER_NAME'); ?>
                  <a href="#" class="btn btn-danger btn-sm btn-rounded">View Profile</a>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row no-gutters">
				  <div class="col-12 text-left">
                      <?php echo $this->Html->link('<i class="fa fa-key"></i> Change Password', array("controller"=>"Home","action"=>"changePassword"),array("escape"=>false));?>
                  </div>
                 
				<div role="separator" class="divider col-12"></div>
				  <div class="col-12 text-left">
                      <?php echo $this->Html->link('<i class="fa fa-power-off"></i> Logout', array("controller"=>"Home","action"=>"logout"),array("escape"=>false));?>
                  </div>				
                </div>
                <!-- /.row -->
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
         <!-- =============================================== -->
		 
   <script>
      function setPhase(i) {
           // alert(i);
           $.ajax({
               type: "POST",
               url: '<?php echo Router::url(array("controller" => "Home", "action" => "setPhase")); ?>' ,
               data: {phase:i},
               cache: false,
               success: function(html) {
                   window.location.reload();
               }
           });
       }

   </script>
