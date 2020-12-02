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
				<li class="breadcrumb-item"><a href="javascript:;">Owner</a></li>
				 
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add Owner</h1>
			<!-- end page-header -->
			<!-- begin panel --> 
				 
				 <div class="row">
					<div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-validation-1">
						<!-- begin panel-heading -->
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Add Owner</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<form class="form-horizontal" name="add_contractor" id="add_contractor" action="<?php echo ADMIN_URL ?>addcontractor" method="post">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Organization Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_organization" name="cont_organization" placeholder="Contrator Organization name" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">First Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_firstname" name="cont_firstname" placeholder="Contrator First name" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname">Last Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_lastname" name="cont_lastname" placeholder="Contrator Last name" >
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">User name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_username" name="cont_username" placeholder="Contrator Username" >
									</div>
								</div>


								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Owner Name * :</label>
									<div class="col-md-8 col-sm-8">
											<select name="cont_owner" id="cont_owner" class="form-control"> 
												<option value="">- -  Select One Owner - -</option>
												<?php 
													foreach ($getowner as $key=>$val){
												?>
													<option value="<?php echo $val->id; ?>"><?php echo $val->first_name.' '.$val->last_name.' , '.$val->devision_name.' (Devision) , '.$val->station_name.' (station)'; ?></option>
												<?php 
													}
												?>
											</select>
									</div>
								</div>
								<div class="form-group row m-b-15" id="hideprodiv" style="display:none;">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Processes * :</label>
									<div class="col-md-8 col-sm-8" id="prodiv">
										  
										 
									</div>
								</div>
 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Contractor Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="cont_email" name="cont_email" placeholder="Contractor Email" >
									</div>
								</div>
								 
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="full1name">Mobile Number * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="number" id="cont_phone" name="cont_phone" placeholder="Contractor Mobile" >
									</div>
								</div>

								<div class="form-group row m-b-15">
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