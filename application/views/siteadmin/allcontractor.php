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
				<li class="breadcrumb-item"><a href="javascript:;">List Owner</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">All Owner</h1>
			<div class="row">
				<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="table-basic-7">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">All Owner</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<!-- begin table-responsive -->
						 <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No.</th>
								<th class="text-nowrap">Owner Name</th>
								<th class="text-nowrap">Email</th> 
								<th class="text-nowrap">Organization</th>sss
								<th class="text-nowrap">Devision</th>
								<th class="text-nowrap">Station</th>
								<th class="text-nowrap">Processes</th> 
								<th class="text-nowrap">Status</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php 
								 if (!empty($getallcontractor)){
								 	foreach ($getallcontractor as $key=>$val){
								 		$date = date('d, M Y',strtotime($val->created_date));
								 		 
								 		if ($val->status == ACTIVE_STATUS){
								 			$status = '<span class="label label-success m-l-5 t-minus-1">Active</span>';
								 		}else {
								 			$status = '<span class="btn btn-warning">Inactive</span>';
								 		}
								 		$divid = $val->devision_id;
								 		$orgid = $val->organization_id;
								 		$staid = $val->station_id;
								 		$proid = explode(',',$val->processes_id);

								 	$getcondevision = $this->AdminModel->getdevisionbyid($divid);
								 	$getorgbyId = $this->AdminModel->getorganizationbyId($orgid);
								 	$getStabyId = $this->AdminModel->getstationById($staid);
								 	$processesval = $this->AdminModel->getprocessesMultiAccId($proid);
								 	//echo '<pre>'; print_r($processesval);
								 	//$proid = $val->id;
								 //	$subpro = $this->AdminModel->getallSubProcessesByProcessesId($proid);
							?>
								<tr class="odd gradeX">
									 
									<td><?php echo $key+1; ?></td>
									<td><?php echo $val->first_name.' '.$val->last_name; ?></td>
									<td><?php echo $val->user_email; ?></td>
									<td><span class="btn btn-sm btn-danger"><?php echo $getorgbyId[0]->organization_name; ?></span></td> 
									<td><span class="btn btn-sm btn-danger"><?php echo $getcondevision[0]->devision_name; ?></span></td>
									<td><span class="btn btn-sm btn-danger"><?php echo $getStabyId[0]->station_name;?></span></td>
									<td>
										<?php 
											foreach ($processesval as $k=>$v){
										?>
											<span class="btn btn-sm btn-danger"><?php echo $v->processes_name; ?></span>
										<?php 
											}
										?>
									</td>
								 
									<td><?php echo $status; ?></td>

									<td>
											<a href="javascript:;" class="btn btn-primary">Action</a>
											<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false"><b class="caret"></b></a>
											<div class="dropdown-menu dropdown-menu-right" x-placement="top-end"  >
												 
												<a href="<?php echo ADMIN_URL;?>editowner/<?php echo base64_encode($val->id); ?>" class="dropdown-item">Edit</a>
												<a href="javascript:;"  class="dropdown-item changestatus" data-status="2" data-tablename="user" data-mainid="<?php echo $val->id;?>">Delete</a>
												 
												<a href="javascript:;" class="dropdown-item changestatus" data-status="0" data-tablename="user" data-mainid="<?php echo $val->id;?>">Inactive</a>
												<a href="javascript:;" class="dropdown-item changestatus" data-status="1" data-tablename="user" data-mainid="<?php echo $val->id;?>">Active</a>
												 <a href="javascript:;" class="dropdown-item" data-status="1" data-tablename="user" data-mainid="<?php echo $val->id;?>">Set Processes</a>
												 
											</div>
									</td>
									 
								</tr>
						 	<?php 
									}
								 }else {

						 	?>
						 		<tr>
						 			<td colspan="10" style="text-align: center;"><a href="<?php echo ADMIN_URL ?>addcontractor">Click To Add New Contractor</a></td>
						 		</tr>
							<?php }?>
							<tr class="gradeU">
								<th width="1%">No.</th>
								<th class="text-nowrap">Owner Name</th>
								<th class="text-nowrap">Email</th> 
								<th class="text-nowrap">Organization</th>
								<th class="text-nowrap">Devision</th>
								<th class="text-nowrap">Station</th>
								<th class="text-nowrap">Processes</th> 
								<th class="text-nowrap">Status</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</tbody>
					</table>
							<!-- end table-responsive -->
						</div>
						<!-- end panel-body -->
						<!-- begin hljs-wrapper -->
					
						<!-- end hljs-wrapper -->
					</div>
					<!-- end panel -->
					<!-- begin panel -->
				
					<!-- end panel -->
					<!-- begin panel -->
					
					<!-- end panel -->
				</div>
			</div>
		</div>
 <?php 
	$this->load->view('layout/admin/footer');
?>