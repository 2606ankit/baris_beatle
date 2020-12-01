<?php 
	$this->load->view('layout/admin/header');
	$this->load->view('layout/admin/sidebar');
?>
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
			<div class="col-xl-9 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-unlimited-tabs-1">
						<!-- begin panel-heading -->
						<div class="panel-heading p-0 ui-sortable-handle">
							<!-- begin nav-tabs -->
							<div class="tab-overflow overflow-right">
								<ul class="nav nav-tabs nav-tabs-inverse">
									<li class="nav-item prev-button" style=""><a href="javascript:;" data-click="prev-tab" class="nav-link text-primary"><i class="fa fa-arrow-left"></i></a></li>
									<li class="nav-item"><a href="#nav-tab-1" data-toggle="tab" class="nav-link">Nav Tab 1</a></li>
									<li class="nav-item"><a href="#nav-tab-2" data-toggle="tab" class="nav-link">Nav Tab 2</a></li>
									 
								</ul>
							</div>
							<!-- end nav-tabs -->
							<div class="panel-heading-btn mr-2 ml-2 d-flex">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-secondary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							</div>
						</div>
						<!-- end panel-heading -->
						<!-- begin tab-content -->
						<div class="panel-body tab-content">
							<!-- begin tab-pane -->
							<div class="tab-pane fade" id="nav-tab-1">
								<h3 class="m-t-10">Nav Tab 1</h3>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
									Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
									est diam sagittis orci, a ornare nisi quam elementum tortor. 
									Proin interdum ante porta est convallis dapibus dictum in nibh. 
									Aenean quis massa congue metus mollis fermentum eget et tellus. 
									Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, 
									nec eleifend orci eros id lectus.
								</p>
								<p>
									Aenean eget odio eu justo mollis consectetur non quis enim. 
									Vivamus interdum quam tortor, et sollicitudin quam pulvinar sit amet. 
									Donec facilisis auctor lorem, quis mollis metus dapibus nec. Donec interdum tellus vel mauris vehicula, 
									at ultrices ex gravida. Maecenas at elit tincidunt, vulputate augue vitae, vulputate neque.
									Aenean vel quam ligula. Etiam faucibus aliquam odio eget condimentum. 
									Cras lobortis, orci nec eleifend ultrices, orci elit pellentesque ex, eu sodales felis urna nec erat. 
									Fusce lacus est, congue quis nisi quis, sodales volutpat lorem.
								</p>
							</div>
							<div class="tab-pane fade" id="nav-tab-2">
								<h3 class="m-t-10">Nav Tab 2</h3>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
									Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor, 
									est diam sagittis orci, a ornare nisi quam elementum tortor. 
									Proin interdum ante porta est convallis dapibus dictum in nibh. 
									Aenean quis massa congue metus mollis fermentum eget et tellus. 
									Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, 
									nec eleifend orci eros id lectus.
								</p>
								<p>
									Aenean eget odio eu justo mollis consectetur non quis enim. 
									Vivamus interdum quam tortor, et sollicitudin quam pulvinar sit amet. 
									Donec facilisis auctor lorem, quis mollis metus dapibus nec. Donec interdum tellus vel mauris vehicula, 
									at ultrices ex gravida. Maecenas at elit tincidunt, vulputate augue vitae, vulputate neque.
									Aenean vel quam ligula. Etiam faucibus aliquam odio eget condimentum. 
									Cras lobortis, orci nec eleifend ultrices, orci elit pellentesque ex, eu sodales felis urna nec erat. 
									Fusce lacus est, congue quis nisi quis, sodales volutpat lorem.
								</p>
							</div>
							<!-- end tab-pane -->
							 
						</div>
						<!-- end tab-content -->
					</div>
					<!-- end panel -->
					 
				</div>
		</div>
<?php 
	$this->load->view('layout/admin/footer');
?>