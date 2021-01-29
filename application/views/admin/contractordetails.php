<?php 
	$this->load->view('layout/siteadmin/header');
	$this->load->view('layout/siteadmin/sidebar');
	$this->load->model('UserModel');
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
				<!-- begin col-6 -->
					<div class="col-xl-5 ui-sortable">
						<!-- begin panel -->
						<div class="panel panel-inverse" data-sortable-id="form-validation-1">
							<!-- begin panel-heading -->
							<div class="panel-heading ui-sortable-handle">
								<h4 class="panel-title">Contractor Details</h4>
							 <a href="<?php echo ADMIN_URL?>editcontractor/<?php echo base64_encode($getcontractor[0]->id); ?>" style="margin-left: 20px;" class="label label-success m-l-5 t-minus-1">Edit</a>
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
								<div class="details_right"><?php echo ucfirst($getcontractor[0]->organization_name); ?></div>

								<div class="details_left_head">Devision Name : </div>
								<div class="details_right"><?php echo ucfirst($getcontractor[0]->devision_name); ?></div>

								<div class="details_left_head">Station Name : </div>
								<div class="details_right"><?php echo ucfirst($getcontractor[0]->station_name); ?></div>
 
 
								<div class="detatail_clear"></div>

							</div>
							</div>
							<!-- end panel-body -->
							 
						</div>
						<!-- end panel -->
					</div>
					<!-- end col-6 -->
					<!-- begin col-6 -->
					<div class="col-xl-7 ui-sortable">
						<!-- begin panel -->
						<div class="panel panel-inverse" data-sortable-id="form-validation-2">
							<!-- begin panel-heading -->
							<div class="panel-heading ui-sortable-handle">
								<h4 class="panel-title">Related Owner </h4>
								<a href="javascript:;" style="margin-left: 20px;" class="label label-success m-l-5 t-minus-1 showownerselect">Add More Owner</a>
							</div>
							<!-- end panel-heading -->
							<!-- begin panel-body --> 
								 <div class="toggle_owner" >
								  
									<div class="togglebody">
										<div class="panel-body">
											<table id="data-table-default1" class="table table-striped table-bordered table-td-valign-middle">
										
											<tr style="background-color: #ddd;">
												<td class="text-nowrap">No.</td>
												<td class="text-nowrap">Owner Name</td>
											 	<td class="text-nowrap">Owner Processes</td>
												<td class="text-nowrap">Working Processes</td>
												<td class="text-nowrap">Status</td>
												<td class="text-nowrap">Action</td>
											</tr>
											<?php 
											if (!empty($getownerByContractorId)){
											 foreach ($getownerByContractorId as $key=>$val)
												{
												 
												$owner_processes_id = $val->owner_processesId;
												$owner_sub_processes_id = $val->owner_sub_processes_id;

												$con_processes_id = $val->contractor_processes_id;
												$con_sub_processes_id = $val->contractor_sub_processes_id;

												$ownerprocessesdata = $this->UserModel->getAllProcessesWithSubProcessesWithIdsec($owner_processes_id,$owner_sub_processes_id);
												 

												$Contractorprocessesdata = $this->UserModel->getAllProcessesWithSubProcessesWithIdsec($con_processes_id,$con_sub_processes_id);
											//	echo '<pre>'; print_r(json_decode($Contractorprocessesdata));
												if ($val->contractor_status == ACTIVE_STATUS){
											 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:yellow;color:#000;">Active</span>';
											 		}else {
											 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:red;color:#000;">Inactive</span>';
											 		}	
											?>	
												<tr>
													<td><?php echo $key+1;?></td>
													<td style="height: 30px;"><a href="<?php echo ADMIN_URL?>ownerdetail/<?php echo base64_encode($val->id)?>"><?php echo $val->first_name.' '.$val->last_name; ?></a></td>
 													<td>
														<?php foreach (json_decode($ownerprocessesdata) as $key1=>$val1){
															$proname = explode('|',$key1);
															?>
															<span class="label label-success m-l-5 t-minus-1"><?php echo $proname[0];?></span>
														<?php }?>	 
													</td>
													<td>
														 <?php foreach (json_decode($Contractorprocessesdata) as $key1=>$val1){
														 	 foreach($val1 as $k=>$f){															//$proname = explode('|',$key);
															?>
															<span class="label label-success m-l-5 t-minus-1"><?php echo $f->sub_processes_name;?></span>
														<?php   }}  ?>
													</td>
													<td><?php echo $status;?></td>
												 <td>
															<div class="btn-group">
																<a href="#" class="btn btn-white btn-sm width-90" style="width:0px !important; ">AC</a>
																<a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret" data-toggle="dropdown">
																<span class="caret"></span>
																</a>
															<div class="dropdown-menu dropdown-menu-right">
														   
																<a href="javascript:;" class="dropdown-item changestatuslinktable" data-status="0" data-tablename="contractor" data-checkid="contractor_id"  data-mainid="<?php echo $val->table_con_id;?>">Inactive</a>
																<a href="javascript:;" class="dropdown-item changestatuslinktable" data-status="1"   data-tablename="contractor" data-checkid="contractor_id" data-mainid="<?php echo $val->table_con_id;?>">Active</a>

																<a href="javascript:;"  class="dropdown-item changestatuslinktable" data-status="2" data-tablename="contractor" data-checkid="contractor_id" data-mainid="<?php echo $val->table_con_id;?>">Delete</a>
															
																</div>
															</div>
														</td>
												</tr>
											<?php 
													}
												}
											?>
										</table>
									
									<form method="post" name="addpro" id="addpro" action="<?php echo ADMIN_URL?>addnewownerContractor/<?php echo base64_encode($getcontractor[0]->id)?>">
									<div style="margin-top: 20px;width:100%; display: none;" id="addownerselect">
										<input type="hidden" name="contractor_id" id="contractor_id" value="<?php echo $getcontractor[0]->id;?>">
										<input type="hidden" name="contract_name" id="contract_name" value="<?php echo $getcontractor[0]->contract_name; ?>">
										<input type="hidden" name="orgination_Id" id="orgination_Id" value="<?php echo $getcontractor[0]->organization_id; ?>">

										<label>Add New Owner With <?php echo ucfirst($getcontractor[0]->first_name.' '.$getcontractor[0]->last_name); ?></label>
										<select name="cont_owner" id="cont_owner" class="form-control">
											<option>- - Select Owner - - </option>
												<?php 
													foreach ($getallownerlist as $key=>$val){
														// if (!in_array($val->id,$contowner)){
 												?>
													<option value="<?php echo $val->id.'|'.$val->devision_id.'|'.$val->station_id.'|'.$val->ownertable_id; ?>"><?php echo $val->first_name.' '.$val->last_name.' (Owner) , '.$val->devision_name.' (Devision) , '.$val->station_name.' (station)'; ?></option>
												<?php 
														//}
													}
												?>
										</select>
										<div id="ownerprocesses"></div>
										<div class="form-group row m-b-15" id="hideprodiv" style="display:block;margin-top: 10px;"> 
											<button type="submit" class="btn btn-primary">Add New Owner</button>
										</div>
										
									</div>
									</form>
									</div>
								</div>
								 
							</div>
							 
							<!-- end panel-body -->
							<!-- begin hljs-wrapper -->
						 
							<!-- end hljs-wrapper -->
						</div>
						<!-- end panel -->

						<!-- Line manager details start here-->
						<div class="panel panel-inverse" data-sortable-id="form-validation-2">
							<!-- begin panel-heading -->
							<div class="panel-heading ui-sortable-handle">
								<h4 class="panel-title">Related Linemanager</h4>
								 <a href="javascript:;" style="margin-left: 20px;" class="label label-success m-l-5 t-minus-1">Add More Line Manager</a>
							</div>
							<!-- end panel-heading -->
							<!-- begin panel-body -->
							 	 <div class="toggle_owner" >
								 	 

									<div class="togglebody">
										<div class="panel-body">
											<table id="data-table-default1" class="table table-striped table-bordered table-td-valign-middle">
										
											<tr style="background-color: #ddd;">
												<td class="text-nowrap">No.</td>
												<td class="text-nowrap">Manager Name</td> 
												<td class="text-nowrap">Line Manager Processes</td>
												<td class="text-nowrap">Sub Processes</td>
											</tr>
											<?php 
												if (!empty($linemanagecount)){
													foreach ($linemanagecount as $key=>$val)
													{

													$subrocessesid = explode(",",$val->linesub_processes_id);
													$subprocessesdata = $this->AdminModel->getSubprocessesBySubprocessesid($subrocessesid);	 

												$contractorproid =  explode(',',$val->lineprocesses_id);
												//print_r($contractorproid );								
												$conallpro = $this->AdminModel->getprocessesMultiAccId($contractorproid);

											?>	
												<tr>
													<td><?php echo $key+1;?></td>
													<td style="height: 30px;"><a href="<?php echo ADMIN_URL?>showlinemanager/<?php echo base64_encode($val->id); ?>"><?php echo $val->first_name.' '.$val->last_name; ?></td> 
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
																foreach ($subprocessesdata as $k=>$v){
															?>
															 <div style="border: 1px solid #ddd; border-radius:4px; padding: 4px;color:#000;font-size:10px;"><?php echo $v->sub_processes_name; ?></div>
																 
															 
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
									
									 
									</div>
								 
							</div>
							</div>
							<!-- end panel-body -->
							<!-- begin hljs-wrapper -->
						 
							<!-- end hljs-wrapper -->
						</div>
						<!--  End Line Manager Details Start here -->
					</div>
					<!-- end col-6 -->
				</div>
			 
			<!-- end panel -->
		</div>
<?php 
	$this->load->view('layout/siteadmin/footer');

?>