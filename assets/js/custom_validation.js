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
   //  Add Owner Form validation start here
   $("#add_owner").validate({
	    rules: {
	      owner_firstname : {
	        required: true,
	      },
	      owner_lastname : {
	        required: true,
	      },
	      owner_username : {
	        required: true,
	        remote : {
	   				url:  base_url+'checkusername',
			        type: "post",
			      	data: {owner_username: function() {return $('#owner_username').val();}}
	   		}
	      },
	      owner_devision : {
	        required: true,
	      },
	      owner_station : {
	      	required: true,
	      },
	      owner_email : {
	        required: true,
	   		remote : {
	   				url:  base_url+'chackuseremail',
			        type: "post",
			      	data: {owner_email: function() {return $('#owner_email').val();}}
	   		}
	      },
	      owner_phone : {
	        required: true,
	        number:true,
	        minlength : 10,
	        maxlength : 10,

	      },
	      owner_password : {
	        required: true,
	        minlength : 8,
	       },
	      owner_rep_password : {
	        required: true,
	       equalTo: "#owner_password",
	       },
	    },
	    messages : {
		  owner_firstname: {
		    required: "First Name should not be empty",
		  },
		  owner_lastname: {
		    required: "Last name should not be empty",
		  },
		  owner_devision: {
		    required: "Owner Devision should not be empty",
		  },
		  owner_station: {
		    required: "Owner Station Name should not be empty",
		  },
		  owner_phone: {
		    required: "Mobile Number should not be empty",
		    number: "Mobile Number should Numeric",
		    min: "Mobile Number should be min 10 digit",
		  },
		  owner_username: {
		    required: "Username should not be empty",
			remote: jQuery.validator.format("{0} is already taken. Please choose another username. ")
		  },
		  owner_email: {
		    required: "Email should not be empty",
			remote: jQuery.validator.format("{0} is already taken. Please choose another Email. ")
		  },
		  owner_password: {
		    required: "Password Should not be blank",
			minlength: "Password Should have minimum 8 digit",
		  },
		 
		  owner_password: {
		    required: "Password Should not be blank",
			equalto: "Password does not match",
		  },
		}
		
	  });

   // end here

   //  Edit Owner Information Form validation start here
   $("#edit_owner").validate({
	    rules: {
	      owner_firstname : {
	        required: true,
	      },
	      owner_lastname : {
	        required: true,
	      },
	     /* owner_username : {
	        required: true,
	        remote : {
	   				url:  base_url+'checkeditusername',
			        type: "post",
			      	//data: {owner_username: function() {return $('#owner_username').val();}}
			      	data: {owner_username:$('#owner_username').val(),owner_id:$('#ownerId').val()}
	   		}
	      },*/
	      owner_devision : {
	        required: true,
	      },
	      owner_station : {
	      	required: true,
	      },
	      /*owner_email : {
	        required: true,
	   		remote : {
	   				url:  base_url+'chackuseremail',
			        type: "post",
			      	data: {owner_email: function() {return $('#owner_email').val();}}
	   		}
	      },*/
	      owner_phone : {
	        required: true,
	        number:true,
	        minlength : 10,
	        maxlength : 10,

	      },
	      owner_password : {
	       // required: true,
	        minlength : 8,
	       },
	      owner_rep_password : {
	        //required: true,
	       equalTo: "#owner_password",
	       },
	    },
	    messages : {
		  owner_firstname: {
		    required: "First Name should not be empty",
		  },
		  owner_lastname: {
		    required: "Last name should not be empty",
		  },
		  owner_devision: {
		    required: "Owner Devision should not be empty",
		  },
		  owner_station: {
		    required: "Owner Station Name should not be empty",
		  },
		  owner_phone: {
		    required: "Mobile Number should not be empty",
		    number: "Mobile Number should Numeric",
		    min: "Mobile Number should be min 10 digit",
		  },
		  owner_username: {
		    required: "Username should not be empty",
			remote: jQuery.validator.format("{0} is already taken. Please choose another username. ")
		  },
		  owner_email: {
		    required: "Email should not be empty",
			remote: jQuery.validator.format("{0} is already taken. Please choose another Email. ")
		  },
		  owner_password: {
		    required: "Password Should not be blank",
			minlength: "Password Should have minimum 8 digit",
		  },
		 
		  owner_password: {
		    required: "Password Should not be blank",
			equalto: "Password does not match",
		  },
		}
		
	  });

   // end here
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
   // end here
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
   		 
   		var txt;
		var r = confirm("Are You Sure To Want To Change Status !");
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
   				$("#proname").html(proname+' processes');
   				var htmlmain = '';
   				var obj = JSON.parse(res);
   				$.each(obj,function(key,val){
   					var sub_processes_name 	= val.sub_processes_name;
   					var sub_proid 			= val.id;
   					htmlmain += '<div class="row"><div class="col-md-12 modal_processes label label-green" >'+sub_processes_name+'</div></div>';
   				
   				})
   				htmlmain += '<div style="margin-top:10px;"> <a href="'+base_url+'editsubprocesses/'+urlproid+'" class="label label-success m-l-5 t-minus-1">Click To Edit Sub Processes</a></div>';
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
   // Remove edit sub processes start here
   $(document).on('click','.presubproclass', function(){
   		 var button_id = $(this).attr("data-id");
         
        $("#rowmain_"+button_id).remove();
   })
   // end here
})