 <?php 
	$this->load->view('layout/siteadmin/header');
	$this->load->view('layout/siteadmin/sidebar');
	 
?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Contractor</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add Contractor</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Add Contractor</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<form class="form-horizontal" name="add_contractor" id="add_contractor" action="<?php echo ADMIN_URL ?>editcontractor/<?php echo base64_encode($getallcontractordataById[0]->contractor_id); ?>" method="post">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Organization Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_organization" name="cont_organization" placeholder="Contrator Organization name" value="<?php echo $getallcontractordataById[0]->organization_name; ?>" >
									</div>
									<input type="hidden" name="organization_id" id="organization_id" value="<?php echo $getallcontractordataById[0]->organization_id; ?>">

									<input type="hidden" name="table_con_id" id="table_con_id" value="<?php echo $getallcontractordataById[0]->table_con_id; ?>">
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Contract Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_contract_name" name="cont_contract_name" placeholder="Contract Name" value="<?php echo $getallcontractordataById[0]->contract_name; ?>" readonly="readonly">
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">First Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_firstname" name="cont_firstname" placeholder="Contrator First name" value="<?php echo $getallcontractordataById[0]->first_name; ?>" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Last Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_lastname" name="cont_lastname" placeholder="Contrator Last name" value="<?php echo $getallcontractordataById[0]->last_name; ?>" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_username" name="cont_username" placeholder="Contrator Username" value="<?php echo $getallcontractordataById[0]->username; ?>" readyonly="readonly" >
									</div>
								</div>


								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Owner Name * :</label>
									<div class="col-md-8 col-sm-8">
											<select name="cont_owner" id="cont_owner" class="form-control getpprocessesforcontractor"> 
												<option value="">- -  Select One Owner - -</option>
												<?php 
													foreach ($getallownerlist as $key=>$val){
												?>
													<option <?php if ($val->id == $getallcontractordataById[0]->owner_baris_id ){ echo 'selected="selected"';} ?> value="<?php echo $val->id.'|'.$val->devision_id.'|'.$val->station_id.'|'.$val->ownertable_id; ?>"><?php echo $val->first_name.' '.$val->last_name.' , '.$val->devision_name.' (Devision) , '.$val->station_name.' (station)'; ?></option>
												<?php 
													}
												?>
											</select>
											<div style="border:1px solid #ddd; border-radius: 4px; padding: 10px;">
												<?php 

												$conProid = explode(',', $getallcontractordataById[0]->processes_id);
												$consubProid = explode(',', $getallcontractordataById[0]->sub_processes_id);

												foreach ($ownerprocessesdata as $key=>$val){
														$prodata = explode('|',$key);
												?>
													<input type="checkbox" name="processesid[]" id="processesid[]" <?php if (in_array($prodata[1],$conProid)){ echo 'checked="checked"'; }?>value="<?php echo $prodata[1]; ?>"><?php echo $prodata[0]?><br>
													<?php 
														foreach ($val as $k=>$v){
													?>
														<input type="checkbox" name="subproid[]" id="subproid[]" <?php if (in_array($v->subproId,$consubProid)){ echo 'checked="checked"'; }?> value="<?php echo $v->subproId; ?>"><?php echo $v->sub_processes_name?><br>
													<?php } ?>
												<?php } ?>
											</div>
									</div>
									<div id="ownerprocesses"></div>
								</div>
								<div class="form-group row m-b-15" id="hideprodiv" style="display:none;">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Processes * :</label>
									<div class="col-md-8 col-sm-8" id="prodiv">
										  
										 
									</div>
								</div>
 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Contractor Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_email" name="cont_email" placeholder="Contractor Email" value="<?php echo $getallcontractordataById[0]->user_email; ?>" readonly="readonly">
									</div>
								</div>
								 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Mobile Number * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="number" id="cont_phone" name="cont_phone" placeholder="Contractor Mobile" value="<?php echo $getallcontractordataById[0]->user_phone; ?>">
									</div>
								</div>

								<input type="hidden" name="old_password" id="old_password" value="<?php echo $getallcontractordataById[0]->user_password; ?>">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User Password * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="cont_password" name="cont_password" placeholder="Contractor Password" >
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Repet Password * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="cont_rep_password" name="cont_rep_password" placeholder="Contractor Repete Password" >
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