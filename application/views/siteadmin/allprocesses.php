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
				<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="table-basic-7">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">All Processes <span class="label label-success m-l-5 t-minus-1">NEW</span></h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<!-- begin table-responsive -->
						 <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%">No.</th>
								<th class="text-nowrap">Processes Short Name</th>
								<th class="text-nowrap">Processes Full Name</th>
								<th class="text-nowrap">Add Sub Processes</th>
								<th class="text-nowrap">Created Date</th>
								<th class="text-nowrap">Status</th>
								<th class="text-nowrap">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php 
								 if (!empty($getdata)){
								 	foreach ($getdata as $key=>$val){
								 		$date = date('d, M Y',strtotime($val->created_date));
								 		if ($val->status == ACTIVE_STATUS){
								 			$status = '<span class="label label-success m-l-5 t-minus-1">Active</span>';
								 		}else {
								 			$status = '<span class="btn btn-warning">Inactive</span>';
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
											<a href="javascript:;" class="btn btn-primary">Action</a>
											<a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false"><b class="caret"></b></a>
											<div class="dropdown-menu dropdown-menu-right" x-placement="top-end"  >
												 
												<a href="<?php echo ADMIN_URL;?>editprocesses/<?php echo base64_encode($val->id); ?>" class="dropdown-item">Edit</a>
												<a href="javascript:;"  class="dropdown-item changestatus" data-status="2" data-tablename="processes" data-mainid="<?php echo $val->id;?>">Delete</a>
												 
												<a href="javascript:;" class="dropdown-item changestatus" data-status="0" data-tablename="processes" data-mainid="<?php echo $val->id;?>">Inactive</a>
												<a href="javascript:;" class="dropdown-item changestatus" data-status="1" data-tablename="processes" data-mainid="<?php echo $val->id;?>">Active</a>
												 
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
							<tr class="gradeU">
								<th width="1%">No</th>
								<th class="text-nowrap">Processes Short Name</th>
								<th class="text-nowrap">Processes Full Name</th>
								<th class="text-nowrap">Add Sub Processes</th>
								<th class="text-nowrap">Created Date</th>
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