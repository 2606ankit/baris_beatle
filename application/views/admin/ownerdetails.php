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
			<h1 class="page-header"><?php echo $getuserById[0]->first_name.' '.$getuserById[0]->last_name; ?>  Owner Details</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 	<div class="row">
				<!-- begin col-6 -->
					<div class="col-xl-6 ui-sortable">
						<!-- begin panel -->
						<div class="panel panel-inverse" data-sortable-id="form-validation-1">
							<!-- begin panel-heading -->
							<div class="panel-heading ui-sortable-handle">
								<h4 class="panel-title">Owner Details</h4>
							<a href="<?php echo ADMIN_URL?>owneredit/<?php echo base64_encode($getuserById[0]->id); ?>" style="margin-left: 20px;" class="label label-success m-l-5 t-minus-1 showownerselect">Edit Owner</a>
							</div>
							<!-- end panel-heading -->
							<!-- begin panel-body -->
							<div class="panel-body">
								 <div class="details_content">
									
									<div class="details_left_head">Owner Id : </div>
									<div class="details_right"><?php echo $getuserById[0]->user_unique_id; ?></div>

									<div class="details_left_head">Owner Name : </div>
									<div class="details_right"><?php echo ucfirst($getuserById[0]->first_name.' '.$getuserById[0]->last_name); ?></div>


									<div class="details_left_head">Owner Email : </div>
									<div class="details_right"><?php echo $getuserById[0]->user_email; ?></div>
									
									<div class="details_left_head">Owner Phone : </div>
									<div class="details_right"><?php echo $getuserById[0]->user_phone; ?></div> 

									<div class="details_left_head">Devision Name : </div>
									<div class="details_right"><?php echo ucfirst($getuserById[0]->devision_name); ?></div>

									<div class="details_left_head">Station Name : </div>
									<div class="details_right"><?php echo ucfirst($getuserById[0]->station_name); ?></div>

									<div class="details_left_head">Running Processes : </div>
									<div class="details_right">
										<?php foreach ($getprocssesById as $k=>$v){?>
											<span class="label label-success m-l-5 t-minus-1"><?php echo $v->processes_name ; ?></span>
										<?php } ?>
									</div>
									<div class="details_left_head">Running Sub Processes : </div>
									<div class="details_right">
										<?php foreach ($getSubprocssesById as $k=>$v){?>
											<div style="margin-top:10px;">
											<span class="label label-success m-l-5 t-minus-1"><?php echo $v->sub_processes_name ; ?></span></div>
										<?php } ?>
									</div>
									

									 	<div class="details_left_head"> </div>
										<div class="details_right"> 
											<a href="javascript:;" style="margin-left: 20px;" class="btn btn-green m-r-5 m-b-5 addmoretoowner">Add Owner To Another Station</a>
										</div>

										<!-- Add Owner To Another Devision and Station -->
									
	 								 


									<div class="detatail_clear"></div>
								</div>
									<div style="width: 100%;padding: 10px; border:1px solid #ddd; border-radius:4px;display: none;" id="showmoreowner">
											<form accept="" action="<?php echo ADMIN_URL?>addownerTootherstation" method="post" name="addmoreowner" id="addownerselect">
												<input type="hidden" name="ownerid" id="ownerid" value="<?php echo $getuserById[0]->id ?>">
													<div style="width: 100%;padding-bottom: 10px; text-align: center;font-weight: bold;">Add Owner To Other Devision And Station</div>
												<select name="morediv" id="morediv" class="form-control">
													<option value="">- - Select Devision - - </option>
													<?php 
														foreach ($getAlldivision as $k=>$v){
														if (!in_array($v->id, $selectedDevionbyowner)){
													?>
														<option value="<?php echo $v->id; ?>"><?php echo $v->devision_name; ?></option>
													<?php 
															}
														}
													?>
												</select>
												<br>
												<select name="morestation" id="morestation" class="form-control">
													<option value="">- - Select Station - - </option>
													<?php 
														foreach($getstation as $key=>$val){
														if (!in_array($val->id, $selectedStationbyowner)){
													?>
														<option value="<?php echo $val->id?>"><?php echo $val->station_name?></option>
													<?php 
															}
														}
													?>
												</select><br>
												<div style="width:100%; padding:5px;">
													<?php 
													foreach ($getallprocesses as $k=>$v){

													?>
													<div style="float: left;border: 0px solid #ddd;border-radius: 4px; margin-left: 10px; font-weight: bold;"><input type="checkbox" data-proid="<?php echo $v->id; ?>" name="processesid[]" id="processesid[]" class="checkprocsses" value="<?php echo $v->id; ?>"><?php echo $v->processes_name;?></div>
													<div id="subprocessesaDiv_<?php echo $v->id; ?>"></div>
												<?php }?>
												</div>
												<br><br>
												<button type="submit" class="btn btn-primary">Add New Processes</button>
											</form>
										</div>
							</div>
							<!-- end panel-body -->
							 
						</div>
						<!-- end panel -->
					</div>
					<!-- end col-6 -->
					<!-- begin col-6 -->
					<!--  Edit modal start here-->
					<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="editbutton" style="display: none;">Open Modal</button>

						<!-- Edit  -->
						<div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <div style="width: 100%;padding-bottom: 10px; text-align: center;font-weight: bold;">Edit Owner To Other Devision And Station</div>
						      </div>
						      <div class="modal-body">
						      <div style="width: 100%;padding: 10px; border:1px solid #ddd; border-radius:4px;display: block;" id="showmoreowner">
											<form accept="" action="<?php echo ADMIN_URL?>editownerTootherstation" method="post" name="editmoreowner" id="editmoreowner">
												<input type="hidden" name="editownerid" id="editownerid" value="">
												<input type="hidden" name="ownerid" id="ownerid" value="<?php echo $getuserById[0]->id ?>"> 	
												<input type="hidden" name="editproid" id="editproid" >

												<select name="editmorediv" id="editmorediv" class="form-control">
													<option value="">- - Select Devision - - </option>
													<?php 
														foreach ($getAlldivision as $k=>$v){
														if (!in_array($v->id, $selectedDevionbyowner)){
													?>
														<option value="<?php echo $v->id; ?>"><?php echo $v->devision_name; ?></option>
													<?php 
															}
														}
													?>
												</select>
												<br>
												<select name="editmorestation" id="editmorestation" class="form-control">
													<option value="">- - Select Station - - </option>
													<?php 
														foreach($getstation as $key=>$val){
														if (!in_array($val->id, $selectedStationbyowner)){
													?>
														<option value="<?php echo $val->id?>"><?php echo $val->station_name?></option>
													<?php 
															}
														}
													?>
												</select><br>
												<div style="width:100%; padding:5px;">
													<?php 
													foreach ($getallprocesses as $k=>$v){

													?>
													<div style="float: left;border: 0px solid #ddd;border-radius: 4px; margin-left: 10px; font-weight: bold;"><input type="checkbox" data-proid="<?php echo $v->id; ?>" name="processesidedit[]" id="processesidedit[]" class="checkprocsses_edit" value="<?php echo $v->id; ?>"><?php echo $v->processes_name;?></div>
													<div id="editsubprocessesaDiv_<?php echo $v->id; ?>"></div>
												<?php }?>
												</div>
												<br><br>
												<button type="submit" class="btn btn-primary">Edit Processes</button>
											</form>
										</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>

						  </div>
						</div>
					<!-- End here -->


					<div class="col-xl-6 ui-sortable">
						<div class="panel panel-inverse" data-sortable-id="form-validation-2">
							<!-- begin panel-heading -->
							<div class="panel-heading ui-sortable-handle">
								<h4 class="panel-title">All Related Station and Devision</h4>
								 
							</div>
							<!-- end panel-heading -->
							<!-- begin panel-body -->
							<div class="panel-body">
								 <table id="data-table-default1" class="table table-striped table-bordered table-td-valign-middle">
											
												<tr style="background-color: #ddd;">
													<td class="text-nowrap">No.</td>
													<td class="text-nowrap">Devision Name</td>
													<td class="text-nowrap">Station Email</td> 
													<td class="text-nowrap">Running Processes</td> 
													<td class="text-nowrap">Status</td> 
													<td class="text-nowrap">Action</td> 
												</tr>
												<?php 
													if (!empty($getuserById)){
														foreach ($getuserById as $key=>$val)
														{ 
															if ($key != 0){
																$i = 1;
													 						
													if ($val->ownerstatus == ACTIVE_STATUS){
											 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:yellow;color:#000;">Active</span>';
											 		}else {
											 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:red;color:#000;">Inactive</span>';
											 		}		

													 $processesdata = $this->UserModel->getprocessesByMultiId($val->processes_id);

													 //$processesdata = $this->UserModel->getSubprocessesByMultiId($ownerprocess);
												?>	
													<tr>
														<td><?php echo $i;?></td>
														<td style="height: 30px;"><?php echo $val->devision_name; ?></td>
														<td><?php echo $val->station_name; ?></td>
													 
														 
														<td>
															<?php 
																	foreach ($processesdata as $k=>$v){
																	$editproid[] = $v->id;
																?>
																	<span class="label label-success m-l-5 t-minus-1" style="color:#FFF;background-color: green;"><?php echo $v->processes_name; ?></span>
																<?php 
																	}
																	 
																?>
														</td>
														<td><?php echo $status; ?></td>
														<td>
															<div class="btn-group">
																<a href="#" class="btn btn-white btn-sm width-90" style="width:0px !important; ">AC</a>
																<a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret" data-toggle="dropdown">
																<span class="caret"></span>
																</a>
															<div class="dropdown-menu dropdown-menu-right">
																 
																
																<a href="javascript:;" class="dropdown-item editmultiowner"  data-tablename="owner" data-mainid="<?php echo $val->ownid;?>" data-division="<?php echo $val->devision_id; ?>" data-station="<?php echo $val->station_id; ?>" data-editproid="<?php echo implode(',',$editproid); ?>">Edit</a>

																<a href="javascript:;" class="dropdown-item changestatuslinktable" data-status="0" data-tablename="owner" data-checkid="owner_id"  data-mainid="<?php echo $val->ownid;?>">Inactive</a>
																<a href="javascript:;" class="dropdown-item changestatuslinktable" data-status="1"   data-tablename="owner" data-checkid="owner_id" data-mainid="<?php echo $val->ownid;?>">Active</a>

																<a href="javascript:;"  class="dropdown-item changestatuslinktable" data-status="2" data-tablename="owner" data-checkid="owner_id" data-mainid="<?php echo $val->ownid;?>">Delete</a>
															
																</div>
															</div>
														</td>
													</tr>
												<?php 
												$i++;
														}
													}
													}else{
												?>
												<tr><td colspan="4"><a href="javascript:;" class="addcontoowne"> Add Contractor With this owner.</a></td></tr>
												 
												<?php 
													}
												?>

											</table>
							</div>
							<!-- end panel-body -->
							<!-- begin hljs-wrapper -->
						 
							<!-- end hljs-wrapper -->
						</div>
						<!-- begin panel -->
						<div class="panel panel-inverse" data-sortable-id="form-validation-2">
							<!-- begin panel-heading -->
							<div class="panel-heading ui-sortable-handle">
								<h4 class="panel-title">Related Contractor Details</h4>
								 
							</div>
							<!-- end panel-heading -->
							<!-- begin panel-body -->
							<div class="panel-body">
								 <table id="data-table-default1" class="table table-striped table-bordered table-td-valign-middle">
											
												<tr style="background-color: #ddd;">
													<td class="text-nowrap">No.</td>
													<td class="text-nowrap">Contractor Name</td>
													<td class="text-nowrap">Contractor Email</td> 
													<td class="text-nowrap">Contractor Processes</td> 
													<td class="text-nowrap">Action</td> 
												</tr>
												<?php 
													if (!empty($getcontractor)){
														foreach ($getcontractor as $key=>$val)
														{ 

													$contractorproid =  explode(',',$val->processes_id);
													//print_r($contractorproid );								
													$conallpro = $this->AdminModel->getprocessesMultiAccId($contractorproid);
												?>	
													<tr>
														<td><?php echo $key+1;?></td>
														<td style="height: 30px;"><a href="<?php echo ADMIN_URL?>showcontractor/<?php echo base64_encode($val->contractor_id);?>"><?php echo $val->first_name.' '.$val->last_name; ?></a></td>
														<td><?php echo $val->user_email; ?></td>
													 
														 
														<td>
															<?php 
																	foreach ($conallpro as $k=>$v){
																?>
																	<span class="label label-success m-l-5 t-minus-1" style="color:#FFF;background-color: green;"><?php echo $v->processes_name; ?></span>
																<?php 
																	}
																?>
														</td>
														<td>
															<div class="btn-group">
																<a href="#" class="btn btn-white btn-sm width-90" style="width: 0px !important; ">AC</a>
																<a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret" data-toggle="dropdown">
																<span class="caret"></span>
																</a>
															<div class="dropdown-menu dropdown-menu-right">
															 
																<a href="javascript:;"  class="dropdown-item deletecontractorfromowner" data-ownerid="<?php echo $getuserById[0]->id ?>" data-conid="<?php echo $val->id;?>">Delete</a>
																 
																 
																</div>
															</div>
														</td>
													</tr>
												<?php 
														}
													}else{
												?>
												<tr><td colspan="4"><a href="javascript:;" class="addcontoowne"> Add Contractor With this owner.</a></td></tr>
												 
												<?php 
													}
												?>

											</table>
							</div>
							<!-- end panel-body -->
							<!-- begin hljs-wrapper -->
						 
							<!-- end hljs-wrapper -->
						</div>
						<!-- end panel -->
					</div>
					<!-- end col-6 -->
				</div>
				  
			 
			<!-- end panel -->
		</div>
<?php 
	$this->load->view('layout/siteadmin/footer');
?>