 
<?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
?>
	<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Devision</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add Devision</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Add Devision</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<form class="form-horizontal" name="edit_devision" id="edit_devision" action="<?php echo ADMIN_URL ?>editdevision/<?php echo base64_encode($getdata[0]->id); ?>" method="post">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Devision Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="devision_name" name="devision_name" placeholder="Devision Name" value="<?php echo $getdata[0]->devision_name; ?>">
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