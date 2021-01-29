 <?php 
	$this->load->view('layout/siteadmin/header');
	$this->load->view('layout/siteadmin/sidebar');
 
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
									<?php 
										$prodata = explode('|',$processes_name);
										echo $prodata[0];
									?>
								</a>
							</div>
							<div style="border: 1px solid #ddd; width:100%; padding:5px; margin-top: 20px;">
								<?php 
									 foreach ($subprocessesname as $key=>$val){

								?>
									<div class="setsubpro getsubid" data-proid="<?php echo $val->subproId; ?>">	<?php echo $val->sub_processes_name; ?>
									 </div>
								<?php 
										 
										}
									 
								?>
								<div style="clear: both;"></div>
							</div>
							<form action="<?php echo ADMIN_URL?>setprocesses/<?php echo base64_encode($linemanid)?>/<?php echo base64_encode($processesid); ?>" method="post" >
							<div style="border: 1px solid #ddd; border-radius: 4px; padding: 10px; width: 50%; margin-top: 20px;">
								<select class="form-control" id="selectprocsses" name="selectprocsses">
									<option> - -  Select One Template - - </option>
									<option value="1">Suprise Visit Daily</option>
									<option value="2">Daily Consumable Report</option>
									<option value="3">Machine Report</option>
									<option value="4">Daily Performence</option>
									<option value="5">Manpower Log Details</option>
									<option value="6">Equipment,Consumables & Chemical</option>
								</select>
							</div>
							<div style="display:none;" id="showsetdiv">
							

								<input type="text" name="selectedproid" id="selectedproid" value="">
								<input type="text" name="linemanshift" id="linemanshift" value="<?php echo $getlinemangaerById[0]->shifts; ?>">

								<div id="templateoutput" style="padding: 20px; border: 1px solid green; border-radius: 4px; width: 100%; margin-top: 30px;"></div>

								<div style="padding:10px; width:100%;float:right">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
								
							
							</div></form>
						</div>

						

					</div>
				</div>
			</div>
		</div>

 <?php 
	$this->load->view('layout/siteadmin/footer');
?>