 <?php 
	$this->load->view('layout/siteadmin/header');
	$this->load->view('layout/siteadmin/sidebar');
 
?>
	
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">List Contractor</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">All Contractor</h1>
			<div class="row">
				 
				<!-- end col-2 -->
				<!-- begin col-10 -->
				<div class="col-xl-12">
					<!-- begin panel -->
					<div class="panel panel-inverse">
						<!-- begin panel-heading -->
						<div class="panel-heading">
							<h4 class="panel-title">All Contractor</h4>
							 
						</div>
						<!-- end panel-heading -->
					 
						<!-- begin panel-body -->
						<div class="panel-body">
							<table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
								<thead>
									<tr>
											<tr>
												<th width="1%">No.</th>
												<th class="text-nowrap">Unique Id</th>
												<th class="text-nowrap">Contractor Name</th>
												<th class="text-nowrap">Email</th> 
												<th class="text-nowrap">Username</th>
												<th class="text-nowrap">User Phone</th>
												<th class="text-nowrap">Status</th>
												<th class="text-nowrap">Action</th>
												<th class="text-nowrap"></th>
											</tr>
									</tr>
								</thead>
								<tbody>
									 
									<?php 
								 if (!empty($getallcontractorlist)){
								 	foreach ($getallcontractorlist as $key=>$val){
								 		$date = date('d, M Y',strtotime($val->created_date));
								 		 
								 		if ($val->status == ACTIVE_STATUS){
								 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:yellow;color:#000;">Active</span>';
								 		}else {
								 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:red;color:#000;">Inactive</span>';
								 		}
								 		
								 	//echo '<pre>'; print_r($processesval);
								 	//$proid = $val->id;
								 //	$subpro = $this->AdminModel->getallSubProcessesByProcessesId($proid);
							?>
								<tr class="odd gradeX">
									 
									<td><?php echo $key+1; ?></td>
									<td><?php echo $val->user_unique_id; ?></td>
									<td><?php echo $val->first_name.' '.$val->last_name; ?></td>
									<td><?php echo $val->user_email; ?></td>
									<td><?php echo $val->username; ?></td>
									<td><?php echo $val->user_phone; ?></td>
									 
								 
									<td><?php echo $status; ?></td>

									<td>
										<div class="btn-group">
													<a href="#" class="btn btn-white btn-sm width-90">Action</a>
													<a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret" data-toggle="dropdown">
													<span class="caret"></span>
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="<?php echo ADMIN_URL?>contractordetails/<?php echo base64_encode($val->id);?>" class="dropdown-item" data-status="1" data-tablename="user" data-mainid="<?php echo $val->id;?>">Show Details</a>
														<a href="<?php echo ADMIN_URL;?>editcontractor/<?php echo base64_encode($val->id); ?>" class="dropdown-item">Edit</a>
														<a href="javascript:;"  class="dropdown-item changestatus" data-status="2" data-tablename="user" data-mainid="<?php echo $val->id;?>">Delete</a>
														<a href="javascript:;" class="dropdown-item changestatus" data-status="0" data-tablename="user" data-mainid="<?php echo $val->id;?>">Inactive</a>
												<a href="javascript:;" class="dropdown-item changestatus" data-status="1" data-tablename="user" data-mainid="<?php echo $val->id;?>">Active</a>
														
													</div>
												</div>
											 
											 
									</td>
									<td></td>
									 
								</tr>
						 	<?php 
									}
								 }else {

						 	?>
						 		<tr>
						 			<td colspan="10" style="text-align: center;"><a href="<?php echo ADMIN_URL ?>addcontractor">Click To Add New Contractor</a></td>
						 		</tr>
							<?php }?>
									 
								</tbody>
							</table>
						</div>
						<!-- end panel-body -->
					</div>
					<!-- end panel -->
				</div>
				<!-- end col-10 -->
			</div>
		 
		</div>
 <?php 
	$this->load->view('layout/siteadmin/footer');
?>