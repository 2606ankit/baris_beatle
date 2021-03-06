 
<?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
?>
	<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Edit Sub Processes</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit Sub Processes</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Edit Sub Processes</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<form class="form-horizontal" name="add_subprocesses" id="add_subprocesses" action="<?php echo ADMIN_URL ?>editsubprocesses/<?php echo base64_encode($getdata[0]->id)?>" method="post">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Sub Processes Name * :</label>
										<?php 
											foreach (json_decode($getsubpro) as $key=>$val){
										?> 
												<div class="col-md-8 col-sm-8" id="rowmain_<?php echo $key ?>">
													<input type="type" class="form-control" value="<?php echo $val->sub_processes_name; ?>"  name="presubpro[]" id="presubpro_<?php echo $key?>">
													 <a href="javascript:;" class="presubproclass" data-id="<?php echo $key; ?>" > Remove</a>
												</div>
											
										<?php 
											}
										?>
								 </div>
								 <div class="form-group row m-b-15">
										<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Sub Processes Name * :</label>
										<div class="col-md-8 col-sm-8">
											<input type="button" value="Add More Processes" class="btn btn-warning" name="btnaddpro" id="btnaddpro" >
											<div id="adddiv"></div>
										</div>
									</div>

								 
								<div class="form-group row m-b-0">
									<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
									<div class="col-md-8 col-sm-8">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
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
		<!-- end #content -->
<?php 
	$this->load->view('layout/admin/footer');
?>