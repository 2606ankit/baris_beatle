	<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo ASSETS_URL; ?>js/app.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo ASSETS_URL; ?>plugins/parsleyjs/dist/parsley.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
	<script src="<?php echo ASSETS_URL; ?>js/demo/form-wizards-validation.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	
	
		<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo ASSETS_URL; ?>plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/moment/min/moment.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/tag-it/js/tag-it.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/select2/dist/js/select2.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>js/demo/form-plugins.demo.js"></script>

	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/pdfmake/build/pdfmake.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/pdfmake/build/vfs_fonts.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/jszip/dist/jszip.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>js/demo/table-manage-buttons.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script src="<?php echo ASSETS_URL; ?>plugins/gritter/js/jquery.gritter.js"></script>
	<script src="<?php echo ASSETS_URL; ?>plugins/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?php echo ASSETS_URL; ?>js/demo/ui-modal-notification.demo.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
		
	<script src="<?php echo ASSETS_URL?>js/admin_custom_validation.js"></script>
	<script src="<?php echo ASSETS_URL?>js/setprocessesJs.js"></script>
	<script src="<?php echo ASSETS_URL; ?>js/demo/email-inbox.demo.js"></script>

<script>
	// get all station here
 $( function() {
    var availableTags = [
    <?php
    //	print_r($getstation);
    	foreach ($getstation as $k=>$v){
    		echo '"'.$v->station_name.'",';
    	}
     ?>
      
    ];
    $( "#owner_station" ).autocomplete({
      source: availableTags
    });
  } );
  // end here
  // get all organization autocomplete
	 $( function() {
	    var availableTags1 = [
	    <?php
	    //	print_r($getstation);
	    	foreach ($getorganization as $k=>$v){
	    		echo '"'.$v->organization_name.'",';
	    	}
	     ?>
	      
	    ];
	    $( "#cont_organization" ).autocomplete({
	      source: availableTags1
	    });
	  } );

  // end here

  $(document).ready(function(){
  	$(".gritter-close").click(function(){
  		$("#gritter-notice-wrapper").hide(500);
  	})
  	$(".addmoretoowner").click(function(){
  		$("#showmoreowner").toggle(500);
  	})
  })

  </script>
</body>
</html>