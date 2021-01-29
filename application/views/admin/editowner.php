<?php 
	$this->load->view('layout/siteadmin/header');
	$this->load->view('layout/siteadmin/sidebar');
?>
	<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Owner</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add Owner</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Add Owner</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<form class="form-horizontal" name="edit_owner" id="edit_owner" action="<?php echo ADMIN_URL ?>owneredit/<?php echo base64_encode($ownerId)?>" method="post">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">First Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="owner_firstname" name="owner_firstname" placeholder="Owner First name" value="<?php echo $getOwnerById[0]->first_name; ?>" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Last Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="owner_lastname" name="owner_lastname" placeholder="Owner Last name" value="<?php echo $getOwnerById[0]->last_name; ?>">
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="owner_username" name="owner_username" placeholder="Owner Username" value="<?php echo $getOwnerById[0]->username; ?>" readonly="readonly">
									</div>
								</div>


								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Devision Name * :</label>
									<div class="col-md-8 col-sm-8">
											<select name="owner_devision" id="owner_devision" class="form-control"> 
												<option value="">- -  Select One Devision - -</option>
												<?php 
													foreach ($getAlldivision as $key=>$val){
												?>
													<option <?php if ($getOwnerById[0]->division_id == $val->id){echo "selected='seleceted'"; }?>value="<?php echo $val->id; ?>"><?php echo $val->devision_name; ?></option>
												<?php 
													}
												?>
											</select>
									</div>
								</div>
								
								 <div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Station Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="owner_station" name="owner_station" placeholder="Owner Station Name" value="<?php echo $getOwnerById[0]->station_name; ?>">
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="owner_email" name="owner_email" placeholder="Owner Email" value="<?php echo $getOwnerById[0]->user_email; ?>">
									</div>
								</div>
								 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Mobile Number * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="number" id="owner_phone" name="owner_phone" placeholder="Owner Mobile" value="<?php echo $getOwnerById[0]->user_phone; ?>">
									</div>
								</div>
								<input type="hidden" name="old_pass" id="old_pass" value="<?php echo $getOwnerById[0]->user_password; ?>">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User Password * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="owner_password" name="owner_password" placeholder="Owner Password" >
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Repet Password * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="owner_rep_password" name="owner_rep_password" placeholder="Owner Repete Password" >
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Processes * :</label>
									<div class="col-md-8 col-sm-8">
										<div style="width:100%; border:0px solid #000;padding: 5px;">
											<?php 
											$checkarray = explode(',',$getOwnerById[0]->processes_id);
												foreach ($getallprocesses as $k=>$v){
											?>
											
											<div style="float: left;padding:10px;border: 1px solid #ddd;border-radius: 4px; margin-left: 10px; font-weight: bold;">
												<input type="checkbox" data-proid="<?php echo $v->id; ?>" name="processesid[]" id="processesid[]" class="checkprocsses" <?php if (in_array($val->id,$checkarray)){echo 'checked="checked"';} ?> value="<?php echo $v->id; ?>"><?php echo $v->processes_name;?>
											</div>

											<div id="subprocessesaDiv_<?php echo $v->id; ?>"></div>

										<?php }?>
											<div style="clear: both;"></div>
										</div>
										
									</div>
								</div>

								<div class="form-group row m-b-0">
									<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
									<div class="col-md-8 col-sm-8">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- end panel-body -->
						<!-- begin hljs-wrapper -->
						
						<!-- end hljs-wrapper -->
				 
					<!-- end panel -->
				</div>
				</div>
			</div>
			 
			<!-- end panel -->
		</div>
		<!-- end #content -->
<?php 
	$this->load->view('layout/siteadmin/footer');
?>