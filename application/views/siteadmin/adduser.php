<?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
?>
asdfasdfasdf
		<!-- begin #content -->
		<div id="content" class="content">
			
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Baris</a></li>
				<li class="breadcrumb-item active"><a href="javascript:;">Add User</a></li>
				
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add New User Register  </h1>
			<!-- end page-header -->
			<!-- begin wizard-form -->
			<form action="/" method="POST" name="form-wizard" class="form-control-with-bg">
				<!-- begin wizard -->
				<div id="wizard">
					<!-- begin wizard-step -->
					<ul>
						<li>
							<a href="#step-1">
								<span class="number">1</span> 
								<span class="info">
									 Railway Owner
										<small>All fields mandatory required</small>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-2">
								<span class="number">2</span> 
								<span class="info">
									Contractor Owner
									<small>All fields mandatory required</small>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-3">
								<span class="number">3</span>
								<span class="info">
									Line Manager
									<small>All fields mandatory required</small>
								</span>
							</a>
						</li>
						<li>
							<a href="#step-4">
								<span class="number">4</span> 
								<span class="info">
									Processes
									<small>All fields mandatory required</small>
								</span>
							</a>
						</li>
						
						
						<li>
							<a href="#step-5">
								<span class="number">5</span> 
								<span class="info">
									Completed
									<small>Complete Registration</small>
								</span>
							</a>
						</li>
						
						
						
						
					</ul>
					<!-- end wizard-step -->
					<!-- begin wizard-content -->
					<div>
						<!-- begin step-1 -->
						<div id="step-1">
							<!-- begin fieldset -->
							<fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Creat Railway Owner</legend>
										
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Full Name<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" placeholder="Enter Full Name" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">User Name<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" placeholder="Enter User Name" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Division Name<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												
											<select class="form-control" name="Division"  data-parsley-group="step-1" data-parsley-required="true" >
															<option>-- Division --</option>
											<option> Central Railway </option>
												<option> Eastern Railway </option>
												<option> East Central Railway </option>
												<option> East Coast Railway  </option>
												<option> Northern Railway </option>
												<option> North Central  Railway </option>
												<option> North Eastern  Railway </option>
												<option> North Frontier  Railway </option>
												<option> North Western Railway </option>
												<option> Southern  Railway </option>
												<option> South Central Railway </option>
												<option> South Eastern Railway </option>
												<option> South East Central  Railway </option>
												<option> South Western Railway </option>
												<option> Western Railway </option>
												<option> West Central Railway </option>
														</select>
												

											
											
											
											</div>
										</div>
										<!-- end form-group -->
										
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Email Id<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="email" name="firstname" placeholder="Enter Email Id" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Mobile Number<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="number" name="firstname" placeholder="Enter Mobile Number" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Password<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" name="firstname" placeholder="Enter Password" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Repet Password<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" name="firstname" placeholder="Enter Repet Password" data-parsley-group="step-1" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
										
										
										
										
										
									</div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-1 -->
						<!-- begin step-2 -->
						<div id="step-2">
							<!-- begin fieldset -->
							<fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Creat Contractor Owner</legend>
										
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Organization Name <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" placeholder="Organization xxxxxx" data-parsley-group="step-2" data-parsley-required="true" class="form-control" />
												

										</div>
										</div>
										<!-- end form-group -->
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Full Name <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" placeholder="Enter Full Name" data-parsley-group="step-2" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">User Name <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" placeholder="Enter User Name" data-parsley-group="step-2" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Email<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="email" name="firstname" placeholder="Enter Email id" data-parsley-group="step-2" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Mobile Number<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="number" name="firstname" placeholder="Enter Mobile Number" data-parsley-group="step-2" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
									
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Password<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" name="firstname" placeholder="Enter Password" data-parsley-group="step-2" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Repet Password<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" name="firstname" placeholder="Enter Repet Password" data-parsley-group="step-2" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
										
										
									</div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-2 -->
						<!-- begin step-3 -->
						<div id="step-3">
							<!-- begin fieldset -->
							<fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Creat Line Manager</legend>
										
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Division Name</label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" disabled="disabled" value="North Western Railway" placeholder="Division Name" data-parsley-group="step-3" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
									
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Full Name<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" placeholder="Enter Full Name" data-parsley-group="step-3" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">User Name<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="text" name="firstname" placeholder="Enter User Name" data-parsley-group="step-3" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
									
										

										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Email Id<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="email" name="firstname" placeholder="Enter Email Id" data-parsley-group="step-3" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Mobile Number<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="number" name="firstname" placeholder="Enter Mobile Number" data-parsley-group="step-3" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Stations<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<select class="form-control" name="Division"  data-parsley-group="step-3" data-parsley-required="true" >
													<option>-- Stations --</option>
													<option>  Mumbai </option>
													<option>  Nagpur </option>
													<option>  Bhusawal </option>
													<option>  Pune </option>
													<option>  Sholapur  </option>
													<option>  Howrah-I </option>
													<option>  Howrah-II </option>
													<option>  Sealdah </option>
													<option>  Malda </option>
													<option>  Asansol </option>
													<option>  Chitaranjan </option>
													<option>  Kolkata Metro </option>
													<option>  Danapur </option>
													<option>  Mugalsarai </option>
													<option>  Dhanbad </option>
													<option>  Sonpur </option>
													<option> Samastipur </option>
													<option>  Khurda Road </option>
													<option>  Waltair </option>
													<option>  Sambhalpur </option>
													<option> Delhi-I </option>
													<option>  Delhi-II </option>
													<option>  Ambala </option>
													<option>  Moradabad </option>
													<option>  Lucknow </option>
													<option>  Firozpur </option>
													<option>  Allahabad </option>
													<option>  Jhansi </option>
													<option>  Agra </option>
													<option>  Izzatnagar </option>
													<option>  Lucknow </option>
													<option>  Varanasi </option>
													<option> DLW </option>
													<option>  Katihar </option>
													<option>  Alipurduar </option>
													<option> Rangiya </option>
													<option>  Lumding </option>
													<option>  Tinsukhia </option>
													<option>  Jaipur </option>
													<option>  Jodhpur </option>
													<option>  Bikaner </option>
													<option>  Ajmer </option>
													<option>  Chennai </option>
													<option>  Madurai </option>
													<option>  Palghat </option>
													<option>  Trichy </option>
													<option>  Trivendrum </option>
													<option>  Secunderabad </option>
													<option>  Hyderabad </option>
													<option>  Guntakal </option>
													<option>  Vijaywada </option>
													<option>  Nanded </option>
													<option>  Kharagpur </option>
													<option>  Adra </option>
													<option>  Chakradharpur </option>
													<option>  Ranchi </option>
													<option>  Shalimar </option>
													<option>  Bilaspur </option>
													<option>  Nagpur </option>
													<option>  Raipur </option>
													<option>  Bangalore </option>
													<option>  Mysore </option>
													<option>  Hubli </option>
													<option>  RWF/YNK </option>
													<option>  BCT </option>
													<option>  Vadodara </option>
													<option>  Ahemdabad </option>
													<option>  Ratlam </option>
													<option>  Rajkot </option>
													<option>  Bhavnagar </option>
													<option>  Jabalpur </option>
													<option>  Bhopal </option>
													<option>  Kota </option>

											</select>
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Processes<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
											<span class="label label-primary">CTS</span>
											<span class="label label-primary">PMC</span>
											<span class="label label-primary">WAT</span>
											<span class="label label-primary">RBPC</span>
											
											
											<br><br>
											<span>ADD NEW PROCESSES </span>
												<ul id="jquery-tagIt-default">
											<li>CTS</li>
											<li>PMC</li>
											<li>WAT</li>
											<li>RBPC</li>
										</ul>
										<p>Try to enter "CTS, PMC, WAT, RBPC" </p>
										
										
										
												
												
											</div>
										</div>
										<!-- end form-group -->
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Password<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" name="firstname" placeholder="Enter Password" data-parsley-group="step-3" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Repet Password<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<input type="password" name="firstname" placeholder="Enter Repet Password" data-parsley-group="step-3" data-parsley-required="true" class="form-control" />
											</div>
										</div>
										<!-- end form-group -->
										
										
										
										
										
									</div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-3 -->
						<!-- begin step-4 -->
						<div id="step-4">
							<!-- begin fieldset -->
							<fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Set Processes</legend>
										
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Select Process <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio1" value="option1" checked="">
													<label for="inlineCssRadio1">CTS</label>
												</div>
												<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio2" value="option2">
													<label for="inlineCssRadio2">PMC</label>
												</div>
												<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio3" value="option2">
													<label for="inlineCssRadio3">WAT</label>
												</div>
												
												<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio4" value="option2">
													<label for="inlineCssRadio4">RBPC</label>
												</div>

										</div>
										</div>
										<!-- end form-group -->
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label"> Process Full Name<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
											
												<input type="text" name="firstname" placeholder="Enter Process Full Name" data-parsley-group="step-4" data-parsley-required="true" class="form-control" />
											
											</div>
										</div>
										<!-- end form-group -->
										
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Sub Process <span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
												<ul id="jquery-tagIt-primary" class="primary">
													<li>Daily Surprise Audit </li>
													<li>Equipment Consumable nad Chemical</li>
													<li>Daily Machine Report</li>
													<li>Manpower Log Details</li>
												</ul>
												<p>Try to enter "Sub Process 1, Sub Process 2, Sub Process 3" </p>
												
											</div>
										</div>
										<!-- end form-group -->
										
										
										
											<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Billing<span class="text-danger">*</span></label>
											<div class="col-lg-9 col-xl-6">
													<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio5" value="option4">
													<label for="inlineCssRadio5">Yes</label>
												</div>
												
												<div class="radio radio-css radio-inline">
													<input type="radio" name="radio_css_inline" id="inlineCssRadio6" value="option4">
													<label for="inlineCssRadio6">No</label>
												</div>

											</div>
										</div>
										<!-- end form-group -->
										
										
										
									
										
										
										
									</div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
							<!-- end fieldset -->
						</div>
						<!-- end step-4 -->
						
						<!-- begin step-5 -->
						<div id="step-5">
							<div class="jumbotron m-b-0 text-center">
								<h2 class="display-4">Register Successfully</h2>
								
								<p><a href="set-process.html" class="btn btn-primary btn-lg">Set Process</a></p>
							</div>
						</div>
						<!-- end step-5 -->
						
						
					</div>
					<!-- end wizard-content -->
				</div>
				<!-- end wizard -->
			</form>
			<!-- end wizard-form --> 
		</div>
		<!-- end #content -->
<?php 
	$this->load->view('layout/admin/footer');
?>