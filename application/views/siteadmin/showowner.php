<?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
	$this->load->model('AdminModel');
	$ownerproid = explode('|',$getuserById[0]->processes_id);
    $processesval = $this->AdminModel->getprocessesMultiAccId($ownerproid);
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
										<?php foreach ($processesval as $k=>$v){?>
											<span class="label label-success m-l-5 t-minus-1"><?php echo $v->processes_name ; ?></span>
										<?php } ?>
									</div>
									

									<!--<div class="details_left_head">Total Owner : </div>
										<div class="details_right"><span class="label label-success m-l-5 t-minus-1"><?php echo count($getownerbyCon); ?></span>
												<a href="javascript:;" style="margin-left: 20px;" class="btn btn-green m-r-5 m-b-5 showownerselect">Add More Owner</a>
										</div>
	 								-->


									<div class="detatail_clear"></div>
								</div>
							</div>
							<!-- end panel-body -->
							 
						</div>
						<!-- end panel -->
					</div>
					<!-- end col-6 -->
					<!-- begin col-6 -->
					<div class="col-xl-6 ui-sortable">
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
													</tr>
												<?php 
														}
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
	$this->load->view('layout/admin/footer');

?>