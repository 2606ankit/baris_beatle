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
								<th class="text-nowrap">Username</th>
								<th class="text-nowrap">Email</th>
								<th class="text-nowrap">Phone</th>
								<th class="text-nowrap">Station Devision</th>
								<th class="text-nowrap">Station Name</th>
								<th class="text-nowrap">Status</th>
								<th class="text-nowrap">Created date</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php 
								 if (!empty($getallowner)){
								 	foreach ($getallowner as $key=>$val){
								 		$date = date('d, M Y',strtotime($val->created_date));
								 		echo $val->status;
								 		if ($val->status == ACTIVE_STATUS){
								 			$status = '<span class="label label-success m-l-5 t-minus-1">Active</span>';
								 		}else {
								 			$status = '<span class="btn btn-warning">Inactive</span>';
								 		}
								 	//$proid = $val->id;
								 //	$subpro = $this->AdminModel->getallSubProcessesByProcessesId($proid);
							?>
								<tr class="odd gradeX">
									 
									<td><?php echo $key+1; ?></td>
									<td><?php echo $val->first_name.' '.$val->last_name; ?></td>
									<td><?php echo $val->username; ?></td>
									<td><?php echo $val->user_email; ?></td>
									<td><?php echo $val->user_phone; ?></td>
									<td><?php echo $val->devision_name; ?></td>
									<td><?php echo $val->station_name; ?></td>
									<td><?php echo $date; ?></td>
									<td><?php echo $status; ?></td>

									<td>
											<a href="javascript:;" class="btn btn-primary">Action</a>
											<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false"><b class="caret"></b></a>
											<div class="dropdown-menu dropdown-menu-right" x-placement="top-end"  >
												 
												<a href="<?php echo ADMIN_URL;?>editowner/<?php echo base64_encode($val->id); ?>" class="dropdown-item">Edit</a>
												<a href="javascript:;"  class="dropdown-item changestatus" data-status="2" data-tablename="user" data-mainid="<?php echo $val->id;?>">Delete</a>
												 
												<a href="javascript:;" class="dropdown-item changestatus" data-status="0" data-tablename="user" data-mainid="<?php echo $val->id;?>">Inactive</a>
												<a href="javascript:;" class="dropdown-item changestatus" data-status="1" data-tablename="user" data-mainid="<?php echo $val->id;?>">Active</a>
												 
											</div>
									</td>
									<td>
									</td>
								</tr>
						 	<?php 
									}
								 }else {

						 	?>
						 		<tr>
						 			<td colspan="10" style="text-align: center;"><a href="<?php echo ADMIN_URL ?>addowner">Click To Add New Owner</a></td>
						 		</tr>
							<?php }?>
							<tr class="gradeU">
								<th width="1%">No.</th>
								<th class="text-nowrap">Owner Name</th>
								<th class="text-nowrap">Username</th>
								<th class="text-nowrap">Email</th>
								<th class="text-nowrap">Phone</th>
								<th class="text-nowrap">Station Devision</th>
								<th class="text-nowrap">Station Name</th>
								<th class="text-nowrap">Status</th>
								<th class="text-nowrap">Created date</th>
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