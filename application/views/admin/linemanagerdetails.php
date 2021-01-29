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
			<h1 class="page-header"><?php echo $userdata[0]->first_name.' '.$userdata[0]->last_name; ?>  Line Manager Details</h1>
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
								
								<div class="details_left_head">Line Manager Id : </div>
								<div class="details_right"><?php echo $userdata[0]->user_unique_id; ?></div>

								<div class="details_left_head">Contractor Name : </div>
								<div class="details_right"><?php echo ucfirst($userdata[0]->first_name.' '.$userdata[0]->last_name); ?></div>


								<div class="details_left_head">Email : </div>
								<div class="details_right"><?php echo $userdata[0]->user_email; ?></div>
								
								<div class="details_left_head">Phone : </div>
								<div class="details_right"><?php echo $userdata[0]->user_phone; ?></div>

								<div class="details_left_head">Organization Name : </div>
								<div class="details_right"><?php echo ucfirst($userdata[0]->organization_name); ?></div>

								
 
								<div class="details_left_head">Current Processes : </div>
								<div class="details_right">
									<?php 
									$processId = $userdata[0]->processes_id;
									$processesval = $this->UserModel->getprocessesByMultiId($processId);
									 	if (!empty($processesval)){
											foreach ($processesval as $key=>$val){
											 
											//	$processdata = explode("|",$key);
									?>
										<a href="<?php echo ADMIN_URL?>setprocesses/<?php echo base64_encode($userdata[0]->id); ?>/<?php echo base64_encode($val->id); ?>"><span class="label label-success m-l-5 t-minus-1"><?php echo $val->processes_full_name; ?></span></a>
									<?php 
											}
										}
									?>
								</div>
								<!--<div class="details_left_head">Total Owner : </div>
								<div class="details_right"><span class="label label-success m-l-5 t-minus-1"><?php echo count($getownerbyCon); ?></span>
										<a href="javascript:;" style="margin-left: 20px;" class="btn btn-green m-r-5 m-b-5 showownerselect">Add More Owner</a>
								</div>

								<div class="details_left_head">Total Line Manager : </div>
								<div class="details_right"><span class="label label-success m-l-5 t-minus-1"><?php echo count($linemanagecount); ?></span>
									<a href="javascript:;" style="margin-left: 20px;" class="btn btn-green m-r-5 m-b-5">Add More Line Manager</a>
								</div> -->


								<div class="detatail_clear"></div>
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
	$this->load->view('layout/siteadmin/footer');
?>
	