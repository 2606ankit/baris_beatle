$(document).ready(function(){
 var base_url = "http://localhost/beatle_baris/index.php/admin/";
 // ADD Devision Validation Start Here
	  $("#add_devision").validate({
	    rules: {
	      devision_name : {
	        required: true,
	   		remote : {
	   				url:  base_url+'checkdevision',
			        type: "post",
			      	data: {devision_name: function() {return $('#devision_name').val();}}
	   		}
	      },
	    },
	    messages : {
		  devision_name: {
		    required: "Devision Name should not be empty",
			remote: "Sorry, that Devision Name is already in database Please choose another name!."
		  },
		 
		}
		
	  });
	  $("#edit_devision").validate({
	    rules: {
	      devision_name : {
	        required: true,
	   		 
	      },
	    },
	    messages : {
		  devision_name: {
		    required: "Devision Name should not be empty",
			 
		  },
		 
		}
		
	  });
   // END HERE

   // Processes Validation start from here
    $("#add_processes").validate({
	    rules: {
	      processes_name : {
	        required: true,
	   		remote : {
	   				url:  base_url+'checkprocesses',
			        type: "post",
			      	data: {processes_name: function() {return $('#processes_name').val();}}
	   		}
	      },
	       processes_full_name : {
	        required: true,
	   		 
	      },
	    },
	    messages : {
		  processes_name: {
		    required: "Processes Name should not be empty",
			remote: "Sorry, that Processes Name is already in database Please choose another name!."
		  },
		  processes_full_name: {
		    required: "Processes Full Name should not be empty",
		 
		  },
		 
		}
		
	  });
   // End here


   // Change status Start here
   $(".changestatus").click(function(){
   		var changestatus = 	$(this);
   		var tablename 	= 	changestatus.attr("data-tablename");
   		var statuvalue 	= 	changestatus.attr("data-status");
   		var statusid 	= 	changestatus.attr("data-mainid");
   		alert(statusid);
   		var txt;
		var r = confirm("Are You Sure To Change The Devision Status !");
		if (r == true) {
			 $.ajax({
	   			type : "POST",
	   			url  : base_url+"changestatus",
	   			data : {tablename:tablename,statuvalue:statuvalue,statusid:statusid},
	   			success :  function (res){
	   				//alert(res);
	   				location.reload(); 
	   			}
	   		})
		} else {
		   
		} 

   })
   // end here

   // Get all Sub Processes according to the processes
   $(".showsubpro").click(function(){
   		var showsubpro = $(this);
   		var proid = showsubpro.attr('data-proid');
   		var proname = showsubpro.attr('data-proname');
   		var urlproid = btoa(proid);
   		$.ajax({
   			type : 'post',
   			url  : base_url+'getallsubprocessAccProId',
   			data : {proid:proid},
   			success :  function(res){
   				$("#modalclick").click();
   				$("#proname").html(proname);
   				var htmlmain = '';
   				var obj = JSON.parse(res);
   				$.each(obj,function(key,val){
   					var sub_processes_name 	= val.sub_processes_name;
   					var sub_proid 			= val.id;
   					htmlmain += '<div class="row"><div class="col-md-12" style="padding:5px; text-align:center;margin-top:5px;border:1px solid #ddd;border-radius:4px;">'+sub_processes_name+'</div></div>';
   				
   				})
   				htmlmain += '<div> <a href="'+base_url+'editsubprocesses/'+urlproid+'">Click To Edit Sub Processes</a></div>';
   				$("#contenthere").html(htmlmain);
   			}


   		})
   })
   // end here

})
$(document).ready(function(){
var i = 0;
   //Add Sub Processes Start here 
   $("#btnaddpro").click(function(){
   	
   	if (i <= 6){
   		
	   	var html = 
	   	'<div id="row'+i+'" ><input class="form-control" type="text" id="processes_name'+i+'" name="processes_name[]" placeholder="Sub Processes Name" ><input type="button" class="btn_remove" name="rembtn'+i+'" id="rembtn'+i+'" data-id="'+i+'" value="-"></div>';
	  	$("#adddiv").append(html); 	
	   	++i;
   	}

   })
     $(document).on('click','.btn_remove', function(){
        var button_id = $(this).attr("data-id");
         
        $("#row"+button_id+"").remove();
    });
   // end here
})