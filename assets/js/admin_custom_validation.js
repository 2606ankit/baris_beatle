$(document).ready(function(){
 var base_url = "http://localhost/beatle_baris/index.php/siteadmin/";
 var ajax_url = "http://localhost/beatle_baris/index.php/ajaxController/";
	// add owner validation start here
	 //  Add Owner Form validation start here
   $("#add_owner").validate({
	    rules: {
	      owner_firstname : {
	        required: true,
	      },
	      owner_lastname : {
	        required: true,
	      },
	      'processesid[]': {
                required: true,
                maxlength: 2
            },
        
	      owner_username : {
	        required: true,
	        remote : {
	   				url:  ajax_url+'checkusername',
			        type: "post",
			      	data: {owner_username: function() {return $('#owner_username').val();}}
	   		},
	      },
	      owner_devision : {
	        required: true,
	      },
	      owner_station : {
	      	required: true,
	      },
	      owner_email : {
	        required: true,
	   		/*remote : {
	   				url:  base_url+'chackuseremail',
			        type: "post",
			      	data: {owner_email: function() {return $('#owner_email').val();}}
	   		}*/
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

$("#edit_owner").validate({
	    rules: {
	      owner_firstname : {
	        required: true,
	      },
	      owner_lastname : {
	        required: true,
	      },
	      'processesid[]': {
                required: true,
                maxlength: 2
            },
        
	      owner_username : {
	        required: true,
	      },
	      owner_devision : {
	        required: true,
	      },
	      owner_station : {
	      	required: true,
	      },
	      owner_email : {
	        required: true,
	   		/*remote : {
	   				url:  base_url+'chackuseremail',
			        type: "post",
			      	data: {owner_email: function() {return $('#owner_email').val();}}
	   		}*/
	      },
	      owner_phone : {
	        required: true,
	        number:true,
	        minlength : 10,
	        maxlength : 10,

	      },
	      owner_password : {
	        minlength : 8,
	       },
	      owner_rep_password : {
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

	// add another station and devision to owner
	$("#addmoreowner").validate({
	    rules: {
	    'processesid[]': {
	            required: true,
	            maxlength: 2
	        },
	    morediv : {
	        required: true,
	      },
	      morestation : {
	      	required: true,
	      },
	     
	    },
	    messages : {
		   
		  morediv: {
		    required: "Devision should not be empty",
		  },
		  morestation: {
		    required: "Station Name should not be empty",
		  },
		   
		}
		
	  });
	// end here

	//  Add Owner Form validation start here
   $("#add_contractor").validate({
	    rules: {
	       cont_organization:{
	       	required: true,
	       },
	       cont_contract_name:{
	       	required: true,
	       },
	       cont_username: {
	       	required : true,
	       },
	       cont_owner: {
	       	required : true,
	       },
	      cont_firstname : {
	        required: true,
	      },
	      cont_lastname : {
	        required: true,
	      },
	      cont_email : {
	        required: true,
	        email : true,
	      },
	        
	      cont_phone : {
	        required: true,
	        number:true,
	        minlength : 10,
	        maxlength : 10,

	      },
	      cont_password : {
	        
	        minlength : 8,
	       },
	      cont_rep_password : {
	        
	       equalTo: "#cont_password",
	       },
	    },
	    messages : {
		 cont_organization:{
		 	required :  "Organization name should not be empty",
		 },
		 cont_contract_name:{
		 	required :  "Contract name should not be empty",
		 },
		 cont_username:{
		 	required :  "Username should not be empty",
		 },
		  cont_firstname: {
		    required: "First Name should not be empty",
		  },
		  cont_lastname: {
		    required: "Last name should not be empty",
		  },
		 cont_email : {
	        required: "Email should not be empty",
	        email : "Email should be in right formate",
	      },
		  
		  cont_phone: {
		    required: "Mobile Number should not be empty",
		    number: "Mobile Number should Numeric",
		    min: "Mobile Number should be min 10 digit",
		  },
		  cont_username: {
		    required: "Username should not be empty",
			remote: jQuery.validator.format("{0} is already taken. Please choose another username. ")
		  },
		  cont_email: {
		    required: "Email should not be empty",
			remote: jQuery.validator.format("{0} is already taken. Please choose another Email. ")
		  },
		  cont_password: {
		    required: "Password Should not be blank",
			minlength: "Password Should have minimum 8 digit",
		  },
		 
		  cont_rep_password: {
		    required: "Password Should not be blank",
			equalto: "Password does not match",
		  },
		}
		
	  });

   // end here

   // Add Line manager start here
    // Validation for add line manage 
  $("#add_linemanager").validate({
	    rules: {
	      line_contracter : {
	        required: true,
	      },
	      line_shift : {
	      	required : true,
	      },
	      line_firstname : {
	        required: true,
	      },
	      'processesid[]': {
            required: true,
            maxlength: 2
          },
          "subproid[]" : {
            required: true,
            maxlength: 2
          },
          line_lastname : {
	        required: true,
	      },
	      line_username : {
	        required: true,
	        remote : {
   				url:  base_url+'checkusername',
		        type: "post",
		      	data: {owner_username: function() {return $('#line_username').val();}}
	   		}
	      },
	      
	      line_email : {
	        required: true,
	        email : true,
	   		 
	      },
	      line_phone : {
	        required: true,
	        number:true,
	        minlength : 10,
	        maxlength : 10,

	      },
	      line_password : {
	        required: true,
	        minlength : 8,
	       },
	      cont_rep_password : {
	        
	       equalTo: "#cont_password",
	       },
	    },
	    messages : {
		  line_contracter: {
		    required: "Contractor name should not be empty",
		  },
		  line_shift: {
		    required: "Shift should not be empty",
		  },
		  line_firstname: {
		    required: "First Name should not be empty",
		  },
		  line_lastname: {
		    required: "Last name should not be empty",
		  },
		  
		  line_phone: {
		    required: "Mobile Number should not be empty",
		    number: "Mobile Number should Numeric",
		    min: "Mobile Number should be min 10 digit",
		  },
		  line_username: {
		    required: "Username should not be empty",
			remote: jQuery.validator.format("{0} is already taken. Please choose another username. ")
		  },
		  line_email: {
		    required: "Email should not be empty",
		   },
		  line_password: {
		    required: "Password Should not be blank",
			minlength: "Password Should have minimum 8 digit",
		  },
		 
		  line_rep_password: {
		    required: "Password Should not be blank",
			equalto: "Password does not match",
		  },
		}
		
	  });
   
   // end here
	// get sub processes by processes id 
	$(".checkprocsses").change(function(){
		var checkprocsses = $(this);
		var proid = checkprocsses.attr("data-proid");
		 if ($(this).is(':checked'))
		 {
		 	var htmlmain = '';
		     $.ajax({
					type : 'POST',
					url  : ajax_url+'getSubprocessByProcessesId',
					data : {proid:proid},
					success : function(res)
					{
						var obj = JSON.parse(res);
		   				$.each(obj,function(key,value){
		   					htmlmain += '<div id="subprodiv'+key+'" style="width:20%;margin-top:5px;padding:10px;border:1px solid #ddd;border-radius:4px;">';
		   					htmlmain += '<input type="checkbox" name="subprocesses[]" id="subprocesses[]" value="'+value.id+'">'+value.sub_processes_name+'';
		   					htmlmain +='</div>';
		   				})
		   				$("#subprocessesaDiv_"+proid).append(htmlmain);
					}

				})
		 }
	   else
	    {
	     $("#subprocessesaDiv_"+proid).html('');
	    }
		
	})
	$(".checkprocsses_edit").change(function(){
		var checkprocsses = $(this);
		var proid = checkprocsses.attr("data-proid");
		 if ($(this).is(':checked'))
		 {
		 	var htmlmain = '';
		     $.ajax({
					type : 'POST',
					url  : ajax_url+'getSubprocessByProcessesId',
					data : {proid:proid},
					success : function(res)
					{
						var obj = JSON.parse(res);
		   				$.each(obj,function(key,value){
		   					htmlmain += '<div id="subprodiv'+key+'" style="width:20%;margin-top:5px;padding:10px;border:1px solid #ddd;border-radius:4px;">';
		   					htmlmain += '<input type="checkbox" name="subprocessesedit[]" id="subprocessesedit[]" value="'+value.id+'">'+value.sub_processes_name+'';
		   					htmlmain +='</div>';
		   				})
		   				$("#editsubprocessesaDiv_"+proid).append(htmlmain);
					}

				})
		 }
	   else
	    {
	     $("#editsubprocessesaDiv_"+proid).html('');
	    }
		
	})
	// end here

	// change status of max table
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
		   			url  : ajax_url+"changestatus",
		   			data : {tablename:tablename,statuvalue:statuvalue,statusid:statusid},
		   			success :  function (res){
		   				//alert(res);
		   				location.reload(); 
		   			}
		   		})
			} else {
			   
			} 

	   })
	      // change status for linked table 
 	$(".changestatuslinktable").click(function(){
   		var changestatus = 	$(this);
   		var tablename 	= 	changestatus.attr("data-tablename");
   		var statuvalue 	= 	changestatus.attr("data-status");
   		var statusid 	= 	changestatus.attr("data-mainid");
   		var checkid 	= 	changestatus.attr("data-checkid");
   		/*var staid 		= 	changestatus.attr("data-station");
   		var divid 		= 	changestatus.attr("data-division");*/
   		 
   		var txt;
		var r = confirm("Are You Sure To Want To Change Status !");
		if (r == true) {
			 $.ajax({
	   			type : "POST",
	   			url  : ajax_url+"changestatuslinktable",
	   			data : {tablename:tablename,statuvalue:statuvalue,statusid:statusid,checkid:checkid},
	   			success :  function (res){
	   				 //alert(res);
	   				location.reload(); 
	   			}
	   		})
		} else {
		   
		} 

   })
	// end here

	  // Edit Multiowner information start here 
   $(".editmultiowner").click(function(){
   		var  editmultiowner = $(this);
   		var editid 		= editmultiowner.attr("data-mainid");
   		var divid  		= editmultiowner.attr("data-division");
   		var staid  		= editmultiowner.attr("data-station");
   		var editproid  	= editmultiowner.attr("data-editproid");

   		$("#editbutton").click();
   		$("#editownerid").val(editid);
   		$("#editproid").val(editproid);
   })
   // end here


   // get all processes from baris_owner table 
   	$("#cont_owner").change(function(){
   		var ownerdata = $("#cont_owner").val();
   		$.ajax({
   			type : 'post',
   			url  : ajax_url+'getprocessesOfownerfrombarisOwner',
   			data : {ownerdata:ownerdata},
   			success : function(res){

   				var obj = JSON.parse(res);
   				$.each(obj,function(key,value){
   					var processid = value.processes_id;
   					var subproid = value.sub_processes_id;
   					$.ajax({
   						type : 'post',
   						url : ajax_url+'getAllProcessesWithSubProcessesWithId',
   						data : {processid:processid,subproid:subproid},
   						success : function(response){
   							 mainhtml = '';
   							 var objnew = JSON.parse(response);
   							 $.each(objnew,function(k,v){
   							 	res = k.split("|");
   							 	 	mainhtml += '<div data-id="'+res[1]+'" style="width:100%; border:1px solid #ddd border-radius:4px;"><input type="checkbox" value="'+res[1]+'" name="processesid[]" id="name="processesid[]">'+res[0]+'</div>';
   							 	 $.each(v,function(t,h){
   							 	 	mainhtml += '<div data-id=""><input type="checkbox" name="subproid[]" id="subproid[]" value="'+h.subproId+'">'+h.sub_processes_name+'</div>';
   							 	 })
   							 })
   							 $("#ownerprocesses").html(mainhtml);
   						}
   					})
   				})
   			}
   		})
   	})
   // end here

   // get All processes of contractor for linemanager add
   $("#line_contracter").change(function(){
   		var line_contracter = $("#line_contracter").val();

   		$.ajax({
   			type  : 'POST',
   			url   : ajax_url+'getAllprocessesAndSubprocessesOfContractor',
   			data  : {line_contracter:line_contracter},
   			success :  function(res){
   				var obj = JSON.parse(res);
   				$.each(obj,function(key,value){
   					var processid = value.processes_id;
   					var subproid = value.sub_processes_id;
   					$.ajax({
   						type : 'post',
   						url : ajax_url+'getAllProcessesWithSubProcessesWithId',
   						data : {processid:processid,subproid:subproid},
   						success : function(response){
   							 mainhtml = '';
   							 var objnew = JSON.parse(response);
   							 $.each(objnew,function(k,v){
   							 	res = k.split("|");
   							 	 	mainhtml += '<div data-id="'+res[1]+'" style="width:100%; border:1px solid #ddd border-radius:4px;"><input type="checkbox" value="'+res[1]+'" name="processesid[]" id="name="processesid[]">'+res[0]+'</div>';
   							 	 $.each(v,function(t,h){
   							 	 	mainhtml += '<div data-id=""><input type="checkbox" name="subproid[]" id="subproid[]" value="'+h.subproId+'">'+h.sub_processes_name+'</div>';
   							 	 })
   							 })
   							 $("#ownerprocesses").html(mainhtml);
   						}
   					})
   				})
   			}
   		})
   })
   // end here
  
   $(".showownerselect").click(function(){

   		$("#addownerselect").show(200);
   	})
   
})