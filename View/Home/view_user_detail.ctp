<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>User Detail</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Manage User</a></li>
        <li class="breadcrumb-item active">List User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
            <a  href='javascript: history.go(-1)' class="btn btn-sm btn-info waves-effect waves-light btnRight pull-right"><i class="icofont icofont-arrow-left"></i>&nbsp; Back</a>
		</div>
        <div class="box-body">
			<div class="row">
				<div class="col-sm-4">&nbsp;
					<!--<div class="row">&nbsp;</div><br>
					<div class="row">
						<img class="img-fluid img-responsive" src="<?php //echo $this->webroot; ?>img/profile_picture_file/<?php //echo $user_detail['UserDetail']['profile_picture']; ?>">
					</div>-->
					
				</div>
				<div class="col-sm-8">
					<div class="row">
						<div class="col-sm-1">&nbsp;</div>
						<div class="col-sm-4">
							<img class="user-image rounded-circle img-responsive" src="<?php echo $this->webroot; ?>img/profile_picture_file/<?php if($user_detail['UserDetail']['profile_image']){echo $user_detail['UserDetail']['profile_image'];}else{echo "filenotfound.jpg"; }  ?>" style="height:150px; width:200px;">
						</div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>First Name</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['firstname']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Last Name</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['lastname']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Gender</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['gender']; ?></span></div>
					</div><br>
                    <?php if($user_detail['UserDetail']['user_type']=="Judge") {?>
                    <div class="row">
                        <div class="col-sm-3"><span>Sector</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['Sector']['sector']; ?></span></div>
                    </div><br>
                    <?php } ?>
					<div class="row">
						<div class="col-sm-3"><span>Email Address</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['email']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Website</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['website']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Mobile Number</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['mobile']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Alternate Mobile No</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['alternate_mobile']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>User Type</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['user_type']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Status</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['status']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Created Date</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['create_date']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Updated Date</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['updated_date']; ?></span></div>
					</div><br>
					<div class="row">
						<div class="col-sm-3"><span>Password</span></div><div class="col-sm-1"><span>:</span></div><div class="col-sm-3"><span><?php echo $user_detail['UserDetail']['password']; ?></span></div>
					</div><br>
				</div>
				<div class="col-sm-4">&nbsp;</div>
			</div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
