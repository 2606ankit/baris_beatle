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
				<li class="breadcrumb-item"><a href="javascript:;">Contractor</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit Contractor</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Edit Contractor</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<form class="form-horizontal" name="edit_contractor" id="edit_contractor" action="<?php echo ADMIN_URL ?>editcontractor/<?php echo base64_encode($getcontractor[0]->id); ?>" method="post">
								 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">First Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_firstname" name="cont_firstname" placeholder="Contrator First name" value="<?php echo $getcontractor[0]->first_name; ?>" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Last Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_lastname" name="cont_lastname" placeholder="Contrator Last name"  value="<?php echo $getcontractor[0]->last_name; ?>">
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_username" name="cont_username" placeholder="Contrator Username" value="<?php echo $getcontractor[0]->username; ?>" readonly="readonly">
									</div>
								</div>


								 
 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Contractor Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_email" name="cont_email" placeholder="Contractor Email" value="<?php echo $getcontractor[0]->user_email; ?>" readonly="readonly">
									</div>
								</div>
								 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Mobile Number * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="number" id="cont_phone" name="cont_phone" placeholder="Contractor Mobile" value="<?php echo $getcontractor[0]->user_phone; ?>">
									</div>
								</div>
							

								<div class="form-group row m-b-15">
										<input type="hidden" name="prepass" id="prepass" value="<?php echo $getcontractor[0]->user_password; ?>">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User Password * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="cont_password" name="cont_password" placeholder="Contractor Password" >
									</div>
								</div>

								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Repet Password * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="password" id="cont_rep_password" name="cont_rep_password" placeholder="Contractor Repete Password" >
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