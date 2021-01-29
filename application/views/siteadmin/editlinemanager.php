 <?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
	$this->load->model('AdminModel');
?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Line Manager</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add Line Manager</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Add Line Manager</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<form class="form-horizontal" name="edit_linemanager" id="edit_linemanager" action="<?php echo ADMIN_URL ?>editlinemanager/<?php echo base64_encode($lineid); ?>" method="post">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Contractor Name * :</label>
									<div class="col-md-8 col-sm-8">
										<select name="line_contracter" id="line_contracter" class="form-control">
											<option value=""> - - Select Contractor - - </option>
											<?php 
												foreach ($getcontractor as $k=>$v){
													 $userid = $v->owner_id;
													$owner = json_decode($this->AdminModel->getuserById($userid));
													 
											?>	
												<option <?php if($getLinemanagerById[0]->contractor_id == $v->id ){echo "selected='selected'";}?>value="<?php echo $v->id.'|'.$v->orgId.'|'.$v->owner_id; ?>"><?php echo $v->first_name.' '.$v->last_name.' (Contractor Name), '. $v->organization_name .' (Orgnization Name) , '.$owner[0]->first_name.' '.$owner[0]->last_name.' (Owner Name)' ?></option>
											<?php 
												}
											?>		
										</select>
										 
									</div>
								</div>
								<input type="hidden" name="preproid" id="preproid" value="<?php echo $getLinemanagerById[0]->processes_id;?> ">
								<input type="hidden" name="presubproid" id="presubproid" value="<?php echo $getLinemanagerById[0]->sub_processes_id;?> ">

								<div class="form-group row m-b-15" id="hideprodiv" style="display:none;">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Processes * :</label>
									<div class="col-md-8 col-sm-8" id="prodiv">
										 
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">First Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="line_firstname" name="line_firstname" placeholder="Line Manager First name" value="<?php echo $getLinemanagerById[0]->first_name; ?>">
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Last Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="line_lastname" name="line_lastname" placeholder="Line Manager Last name" value="<?php echo $getLinemanagerById[0]->last_name; ?>" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="line_username" name="line_username" placeholder="Line Manager Username" value="<?php echo $getLinemanagerById[0]->username; ?>" readonly="readonly">
									</div>
								</div>
 
 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Line Manager Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="line_email" name="line_email" placeholder="Line Manager Email" value="<?php echo $getLinemanagerById[0]->user_email; ?>" readonly="readonly" >
									</div>
								</div>
								 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Mobile Number * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="number" id="line_phone" name="line_phone" placeholder="Line Manager Mobile" value="<?php echo $getLinemanagerById[0]->user_phone; ?>">
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Shifts * :</label>
									<div class="col-md-8 col-sm-8">
										<select name="line_shift" id="line_shift" class="form-control">
											<option>- - Select Shift - - </option>
											<option <?php if($getLinemanagerById[0]->shifts == '1'){echo "selected='selected'"; }?>value="1">1</option>
											<option <?php if($getLinemanagerById[0]->shifts == '2'){echo "selected='selected'"; }?> value="2">2</option>
											<option <?php if($getLinemanagerById[0]->shifts == '3'){echo "selected='selected'"; }?> value="3">3</option>
											<option <?php if($getLinemanagerById[0]->shifts == '4'){echo "selected='selected'"; }?> value="4">4</option>
										</select>
									</div>
								</div>
								<input type="hidden" name="old_password" id="old_password" value="<?php echo $getLinemanagerById[0]->user_password ?>">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User Password  :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="line_password" name="line_password" placeholder="Line Manager Password" >
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Repet Password  :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="line_rep_password" name="line_rep_password" placeholder="Line Manager Repete Password" >
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
	$this->load->view('layout/admin/footer');
?>