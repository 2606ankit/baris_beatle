<?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
	$this->load->model('AdminModel');

?>
   <button type="button" class="btn btn-info btn-lg" id="modalclick" style="display: block;" data-toggle="modal" data-target="#myModal">Open Modal</button>
   <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"> 
        <h4 class="modal-title modal_processes_heading"><lable id="proname"></lable></h4>
      </div>
      <div class="modal-body" id="contenthere">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">List Processes</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">All Processes</h1>
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
												<th class="text-nowrap">Processes Short Name</th>
												<th class="text-nowrap">Processes Full Name</th>
												<th class="text-nowrap">Add Sub Processes</th>
												<th class="text-nowrap">Created Date</th>
												<th class="text-nowrap">Status</th>
												<th class="text-nowrap">Action</th>
												<th class="text-nowrap"></th>
											</tr>
									</tr>
								</thead>
								<tbody>
									 
									<?php 
								 if (!empty($getdata)){
								 	foreach ($getdata as $key=>$val){
								 		$date = date('d, M Y',strtotime($val->created_date));
								 		if ($val->status == ACTIVE_STATUS){
								 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:yellow;color:#000;">Active</span>';
								 		}else {
								 			$status = '<span class="label label-success m-l-5 t-minus-1" style="background-color:red;color:#000;">Inactive</span>';
								 		}
								 	$proid = $val->id;
								 	$subpro = $this->AdminModel->getallSubProcessesByProcessesId($proid);
							?>
								<tr class="odd gradeX">
									 
									<td><?php echo $key+1; ?></td>
									<td><?php echo $val->processes_name; ?></td>
									<td><?php echo substr($val->processes_full_name,0,25).'...'; ?></td>
									<td>
										<?php 
											if (!empty($subpro)){
										?>
											<a href="javascript:;" data-proname="<?php echo $val->processes_full_name; ?>" data-proid="<?php echo $val->id; ?>" class="btn btn-warning showsubpro">Show Processes</a>
										<?php 
											}else{
										?>
										<a href="<?php echo ADMIN_URL?>addsubprocesses/<?php echo base64_encode($val->id); ?>"  class="btn btn-warning">Add Sub Processes</a>
										<?php 
											}
										?>
									</td>
									<td><?php echo $date; ?></td>
									<td><?php echo $status; ?></td>

									<td>

										<div class="btn-group">
													<a href="#" class="btn btn-white btn-sm width-90">Settings</a>
													<a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret" data-toggle="dropdown">
													<span class="caret"></span>
													</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a href="<?php echo ADMIN_URL;?>editprocesses/<?php echo base64_encode($val->id); ?>" class="dropdown-item">Edit</a>
														<a href="javascript:;"  class="dropdown-item changestatus" data-status="2" data-tablename="processes" data-mainid="<?php echo $val->id;?>">Delete</a>
														 
														<a href="javascript:;" class="dropdown-item changestatus" data-status="0" data-tablename="processes" data-mainid="<?php echo $val->id;?>">Inactive</a>
														<a href="javascript:;" class="dropdown-item changestatus" data-status="1" data-tablename="processes" data-mainid="<?php echo $val->id;?>">Active</a>
													</div>
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
						 			<td colspan="5" style="text-align: center;"><a href="<?php echo ADMIN_URL ?>addprocesses">Click To Add New Processes</a></td>
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
	$this->load->view('layout/admin/footer');
?>