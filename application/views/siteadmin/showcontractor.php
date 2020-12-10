<?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
	$this->load->model('AdminModel');
		$divid = $getcontractor[0]->devision_id;
		$orgid = $getcontractor[0]->organization_id;
		$staid = $getcontractor[0]->station_id;
		$proid = explode(',',$getcontractor[0]->processes_id);

	$getcondevision = $this->AdminModel->getdevisionbyid($divid);
	$getorgbyId 	= $this->AdminModel->getorganizationbyId($orgid);
	$getStabyId 	= $this->AdminModel->getstationById($staid);
	$processesval 	= $this->AdminModel->getprocessesMultiAccId($proid);
?>
	<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Contractor</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><?php echo $getcontractor[0]->first_name.' '.$getcontractor[0]->last_name; ?>  Contractor Details</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Contractor Details </h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<div class="details_content">
								
								<div class="details_left_head">Contractor Id : </div>
								<div class="details_right"><?php echo $getcontractor[0]->user_unique_id; ?></div>

								<div class="details_left_head">Contractor Name : </div>
								<div class="details_right"><?php echo ucfirst($getcontractor[0]->first_name.' '.$getcontractor[0]->last_name); ?></div>


								<div class="details_left_head">Email : </div>
								<div class="details_right"><?php echo $getcontractor[0]->user_email; ?></div>
								
								<div class="details_left_head">Phone : </div>
								<div class="details_right"><?php echo $getcontractor[0]->user_phone; ?></div>

								<div class="details_left_head">Organization Name : </div>
								<div class="details_right"><?php echo ucfirst($getorgbyId[0]->organization_name); ?></div>

								<div class="details_left_head">Devision Name : </div>
								<div class="details_right"><?php echo ucfirst($getcondevision[0]->devision_name); ?></div>

								<div class="details_left_head">Station Name : </div>
								<div class="details_right"><?php echo ucfirst($getStabyId[0]->station_name); ?></div>

								<div class="details_left_head">Total Owner : </div>
								<div class="details_right"><span class="label label-success m-l-5 t-minus-1"><?php echo count($getownerbyCon); ?></span>
										<a href="javascript:;" style="margin-left: 20px;" class="btn btn-green m-r-5 m-b-5 showownerselect">Add More Owner</a>
								</div>

								<div class="details_left_head">Total Line Manager : </div>
								<div class="details_right"><span class="label label-success m-l-5 t-minus-1"><?php echo count($linemanagecount); ?></span>
									<a href="javascript:;" style="margin-left: 20px;" class="btn btn-green m-r-5 m-b-5">Add More Line Manager</a>
								</div>


								<div class="detatail_clear"></div>
							</div>

							<div class="toggle_owner" >
								<div class="panel panel-inverse" data-sortable-id="form-validation-1">
									<div class="panel-heading ui-sortable-handle">
										<h4 class="panel-title">Owner Details </h4>
									</div>

									<div class="togglebody">
										<div class="panel-body">
											<table id="data-table-default1" class="table table-striped table-bordered table-td-valign-middle">
										
											<tr style="background-color: #ddd;">
												<td class="text-nowrap">No.</td>
												<td class="text-nowrap">Owner Name</td>
												<td class="text-nowrap">Owner Email</td>
												<td class="text-nowrap">Owner Phone</td>
												<td class="text-nowrap">Owner Processes</td>
												<td class="text-nowrap">Working Processes</td>
											</tr>
											<?php 
												if (!empty($getownerbyCon)){
													foreach ($getownerbyCon as $key=>$val)
													{
														$ownerproid = $proid = explode('|',$val->processes_id);
														 $processesval = $this->AdminModel->getprocessesMultiAccId($ownerproid);

												$contractorproid =  explode(',',$val->bconproid);
												//print_r($contractorproid );								
												$conallpro = $this->AdminModel->getprocessesMultiAccId($contractorproid);
											?>	
												<tr>
													<td><?php echo $key+1;?></td>
													<td style="height: 30px;"><?php echo $val->first_name.' '.$val->last_name; ?></td>
													<td><?php echo $val->user_email; ?></td>
													<td><?php echo $val->user_phone; ?></td>
													<td>
														<?php 
																foreach ($processesval as $k=>$v){
															?>
																<span class="label label-success m-l-5 t-minus-1" style="color:#000;"><?php echo $v->processes_name; ?></span>
															<?php 
																}
															?>
													</td>
													<td>
														<?php 
																foreach ($conallpro as $k=>$v){
															?>
																<span class="label label-success m-l-5 t-minus-1" style="color:#FFF;background-color: green;"><?php echo $v->processes_name; ?></span>
															<?php 
																}
															?>
													</td>
												</tr>
											<?php 
													}
												}
											?>
										</table>
									
									<form method="post" name="addpro" id="addpro" action="<?php echo ADMIN_URL?>addnewprocessesContractor">
									<div style="margin-top: 20px;width:50%; display: none;" id="addownerselect">
										<label>Add New Owner With <?php echo ucfirst($getcontractor[0]->first_name.' '.$getcontractor[0]->last_name); ?></label>
										<select name="cont_owner_add" id="cont_owner_add" class="form-control">
											<option>- - Select Owner - - </option>
												<?php 
													foreach ($getowner as $key=>$val){
												?>
													<option value="<?php echo $val->id.'|'.$val->divid.'|'.$val->staid.'|'.$getcontractor[0]->id.'|'.$getcontractor[0]->organization_id; ?>"><?php echo $val->first_name.' '.$val->last_name.' (Owner) , '.$val->devision_name.' (Devision) , '.$val->station_name.' (station)'; ?></option>
												<?php 
													}
												?>
										</select>
										
										<div class="form-group row m-b-15" id="hideprodiv" style="display:none;margin-top: 10px;">
												<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Processes * :</label>
												
													<div class="col-md-8 col-sm-8" id="prodiv"></div>
													<button type="submit" class="btn btn-primary">Add New Processes</button>
												

										</div>
										
									</div>
									</form>
									</div>
								</div>
								</div>
							</div>

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
<?php 
	$this->load->view('layout/admin/footer');
?>