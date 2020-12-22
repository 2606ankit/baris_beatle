 <?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
	$this->load->model('AdminModel');
?>
		 <!-- begin #content -->
		<div id="content" class="content content-full-width">
			<!-- begin vertical-box -->
			<div class="vertical-box with-grid inbox bg-light">
				<!-- begin vertical-box-column -->
				<div class="vertical-box-column width-200">
					<!-- begin vertical-box -->
					<div class="vertical-box">
						<!-- begin wrapper -->
						<div class="wrapper">
							<div class="d-flex align-items-center justify-content-center">
								<a href="#emailNav" data-toggle="collapse" class="btn btn-inverse btn-sm mr-auto d-block d-lg-none">
									<i class="fa fa-cog"></i>
								</a>
								<a href="#" class="btn btn-inverse p-l-40 p-r-40 btn-sm">
									<?php echo $processesname?>
								</a>
								 
							</div>
						</div>
						<!-- end wrapper -->
						<!-- begin vertical-box-row -->
						<div class="d-lg-table-row" id="emailNav">
							<!-- begin vertical-box-cell -->
							<div class="vertical-box-cell">
								<!-- begin vertical-box-inner-cell -->
								<div class="vertical-box-inner-cell">
									<!-- begin scrollbar -->
									<div data-scrollbar="true" data-height="100%">
										<!-- begin wrapper -->
										<div class="wrapper p-0">
											<div class="nav-title"><b>Sub Process Name</b></div>
										
											<ul class="nav nav-inbox">
												<?php 
													foreach ($getallprocess as $k=>$v){
														 foreach ($v as $key=>$val){

														if (in_array($val->id,$userproceeses)){

												?>
													<li><a href="javascript:;"> <?php echo $val->sub_processes_name; ?> </a></li>
													 
												<?php 
														 }
														}
													}
												?>
											</ul>
										</div>
										<!-- end wrapper -->
									</div>
									<!-- end scrollbar -->
								</div>
								<!-- end vertical-box-inner-cell -->
							</div>
							<!-- end vertical-box-cell -->
						</div>
						<!-- end vertical-box-row -->
					</div>
					<!-- end vertical-box -->
				</div>
				<!-- end vertical-box-column -->
				<!-- begin vertical-box-column -->
				<div class="vertical-box-column">
					<!-- begin vertical-box -->
					<div class="vertical-box">
						<!-- begin wrapper -->
						<div class="wrapper">
							<!-- begin btn-toolbar -->
							<div class="btn-toolbar align-items-center">
								<h4 class="line-height-normal mb4"><?php echo $processesfullname?><h4>	
								
							
								
							</div>
							<!-- end btn-toolbar -->
						</div>
						<!-- end wrapper -->
						<!-- begin vertical-box-row -->
						<div class="vertical-box-row">
							<!-- begin vertical-box-cell -->
							<div class="vertical-box-cell">
								<!-- begin vertical-box-inner-cell -->
								<div class="vertical-box-inner-cell bg-white">
									<!-- begin scrollbar -->
									<div class="cover_v" data-scrollbar="true" data-height="100%">
												<form class="form-inline mb10" action="" method="POST" >
											<div class="form-group m-r-10">
												<input type="number" class="form-control" id="" placeholder="Table Row">
											</div>
											<div class="form-group m-r-10">
												<input type="number" class="form-control" id="" placeholder="Table columns">
											</div>
											<div class="form-group m-r-10">
												<input type="number" class="form-control" id="" placeholder="Number of Shift ">
											</div>
											<button type="submit" class="btn btn-sm btn-primary m-r-5">Creat</button>
											
										</form>
								 
					 

									</div>
									
									
									<!-- end scrollbar -->
								</div>
								<!-- end vertical-box-inner-cell -->
							</div>
							<!-- end vertical-box-cell -->
						</div>
						<!-- end vertical-box-row -->
						
					</div>
					<!-- end vertical-box -->
				</div>
				<!-- end vertical-box-column -->
			</div>
			<!-- end vertical-box -->
		</div>
<?php 
	$this->load->view('layout/admin/footer');
?>
	