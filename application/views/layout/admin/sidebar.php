	<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="../assets/img/user/user-13.jpg" alt="" />
							</div>
							<div class="info">
							
								Sidharth J
								<small>Owner</small>
							</div>
						</a>
					</li>
					
				</ul>
				<!-- end sidebar user -->

				<!-- begin sidebar nav -->
				<ul class="nav"> 
					<li class="nav-header">Navigation</li>
					<li class="has-sub ">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-th-large"></i>
							<span>User</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?php echo ADMIN_URL?>user"><i class="fas fa-lg fa-fw m-r-10 fa-users"></i> <span>All User</span></a></li>
							<li><a href="<?php echo ADMIN_URL?>adduser"><i class="fas fa-lg fa-fw m-r-10 fa-user-plus"></i> <span>Add User</span></a></li>
						</ul>
					</li>
					
					<li class="has-sub ">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-table"></i>
							<span>Devision</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?php echo ADMIN_URL?>devision">All Devision</a></li>
							<li><a href="<?php echo ADMIN_URL?>adddevision"><span>Add Devision</a></li>
						</ul>
					</li>
					<li class="has-sub ">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-table"></i>
							<span>Processes</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?php echo ADMIN_URL?>processes">All Processes</a></li>
							<li><a href="<?php echo ADMIN_URL?>addprocesses"><span>Add Processes</a></li>
						</ul>
					</li>
					
				 
					
					
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>


					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->