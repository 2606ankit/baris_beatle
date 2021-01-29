$(document).ready(function(){
	// create Table For Set processes
	 var base_url = "http://localhost/beatle_baris/index.php/admin/";
	$(".setprocesses").click(function(){
		var tablerow 	= 	$("#setpro_tablerow").val();
		var tablecolum 	= 	$("#setpro_tablecolumn").val();
		var tableshift 	= 	$("#setpro_tableshift").val();
		var table_body	=	'';
		var totalrow 	=	parseInt(tablecolum)+parseInt(tableshift);
		//$("#createproceeses").show(600); 
		var i = 0;
		var j = 0;
 		table_body+='<table style="width:100%; border:1px solid #000;">';
        
              for(var i=0;i<tablerow;i++){
                table_body+='<tr>';
                for(var j=0;j<totalrow;j++){
                	if (i == 0)
	            			{	
	            				var textname = 'headername[]'; 
	            			}
                	 else { 
                	 		var textname = 'headervalue['+j+'][]';
                	 	  }
                    table_body +='<td>';
                    table_body +='<input type="text" name="'+textname+'" class="form-control">';
                    table_body +='</td>';
                }
                table_body+='</tr>';
              }
        table_body+='</table>';
       $('#setproceesetablhtml').html(table_body);
	

	})

	// get already set procsses start here
		$(".getpreprocsses").click(function(){
			var getpreprocsses 	= 	$(this);
			var linemanagerid  	= 	getpreprocsses.attr("data-line");
			var procssesid		=	getpreprocsses.attr("data-proid");

			$.ajax({
				type : 'POST',
				url  : base_url+'getpreviousprocssesAccLineManager',
				data : {linemanagerid:linemanagerid,procssesid:procssesid},
				success : function(res)
				{
					//alert(res);
					$("#predata").html(res);
					var  htmlmain = '';
	   				var  obj = JSON.parse(res);	
	   				var  dataarr ='';

	   				htmlmain += '<table style="width:100%;border:1px solid #ddd">';
	   				htmlmain += '<tr>';
	   				$.each(obj,function(key,value){
	   					htmlmain += '<td>'+key+'</td>';
	   					dataarr.push( value );
	   				 
	   				})
	   				htmlmain += '</tr>';
	   				  alert(dataarr);
	   				$.each(dataarr,function(k,v){

	   					htmlmain += '</tr>';
						htmlmain += '<td>'+v.headerval+'</td>';
	   					htmlmain += '<tr>';

	   				})
	   					   				 
	   			 
	   				//htmlmain += '</table>';
	   				//$("#predata").html(htmlmain);
				}

			})
		})
	// end here

	// get all processes template from here
		$(".setsubpro").click(function(){
			$("#selectprocsses").show();
		})
	// end here

	// create template according to the subprocesses name
		$("#selectprocsses").change(function(){
			 
			var templateval 	= 	$("#selectprocsses").val();
			var linemanshift 	= 	$("#linemanshift").val();
			var mainhtml 		= 	'';

			if (templateval == 1){
				mainhtml = '';
			}
			// create template for machine report
			if (templateval == 3){
				mainhtml = '';
			}
			// end here
			// create template for Equipment,Consumables & Chemical
		if (templateval == 6)
		{
			mainhtml += '<div style="border: 1px solid #ddd; border-radius: 4px; padding:10px; width: 100%;">';
			mainhtml += '<div style="width: 20%; float: left;border: 1px solid #ddd; border-radius: 4px;">';
			mainhtml += '<input type="text" name="Chemicalheader1" id="Chemicalheader1" class="headertextbox form-control" value="SNo.">';
			mainhtml += '</div><div style="width: 20%; float: left;border: 1px solid #ddd; border-radius: 4px;">';
			mainhtml += '<input type="text" name="Chemicalheader2" id="Chemicalheader2" class="headertextbox form-control" value="Description Of Material"></div>';
			mainhtml += '<div style="width: 20%; float: left;border: 1px solid #ddd; border-radius: 4px;">';
			mainhtml += '<input type="text" name="Chemicalheader3" id="Chemicalheader3" class="headertextbox form-control" value="Units">';
			mainhtml += '</div><div style="width: 20%; float: left;border: 1px solid #ddd; border-radius: 4px;">';
			mainhtml += '<input type="text" name="Chemicalheader4" id="Chemicalheader4" class="headertextbox form-control" value="Quantity Used">';
			mainhtml += '</div><div style="width: 20%; float: left;border: 1px solid #ddd; border-radius: 4px;">';
			mainhtml += '<input type="text" name="Chemicalheader5" id="Chemicalheader5" class="headertextbox form-control" value="Total Qty"></div>';
			mainhtml += '<div style="clear: both;"></div>';
			mainhtml += '<div style="margin-top: 20px; width: 50%; border:1px solid #ddd;border-radius:4px;padding: 10px;">';
			mainhtml += '<div style="width: 50%; float: left;">Enter Row ';
			mainhtml += '<input type="text" name="chemicalrow" id="chemicalrow" style="width: 100px; margin-left: 20px;" class="headertextbox">';
			mainhtml += '</div><div style="width: 50%; float: right;">';
			mainhtml += '<a href="javascript:;" class="btn btn-inverse p-l-40 p-r-40 btn-sm" id="addmorechemical">Add More Row</a>';
			mainhtml += '</div><div style="clear: both;"></div></div>';
			mainhtml += '<div style="width:100%; border:1px solid #ddd;padding:10px; margin-top:20px;" id="chemicalrowtable">';
			mainhtml += '</div></div>';
		}
			// end here
			$("#templateoutput").html(mainhtml);

			// add row for chemmical report
		$("#addmorechemical").click(function(){
			var countrow = $("#chemicalrow").val();
			var i = 0;
			var j = 0;
			var s = 0;
			var count = 1;
			var table_body = '';
			var totcolum = parseInt(linemanshift);
			 
			table_body += '<table style="width: 100%">';
			for(var i=0;i<countrow;i++){
				
				table_body += '<tr>';
				table_body += '<td>';
				table_body += '<input type="text" style="width:50px" value="'+count+'" name="sno" id="sno" class="headertextbox">';
				table_body += '</td>';
				table_body += '<td>';
				table_body += '<input type="text" style="width:417px;" placeholder="Description Of Material" name="Description_Of_Material[]" id="Description_Of_Material'+i+'" class="headertextbox">';
				table_body += '</td><td>';
				table_body += '<input type="text" style="width:80px;" placeholder="Units" name="units[]" id="units'+i+'" class="headertextbox">';
				table_body += '</td><td><table><tr>';
				for (var s=0;s<linemanshift;s++){
					 
				table_body += '<td><input type="text" placeholder="Shifts'+s+'" style="width:80px;" name="Quantity_Used[]" id="Quantity_Used'+i+'" class="headertextbox"></td>';
					}
				table_body += '</tr></table></td><td>';
				table_body += '<input type="text" placeholder="Totalqty" style="width:80px;" name="Total_Qty[]" id="Total_Qty'+i+'" class="headertextbox">';
				table_body += '</td>';
				table_body += '<td><input type="text" placeholder="penality" style="width:80px;" name="penality[]" id="penality'+i+'" class="headertextbox"></td></tr>';
				count++;
			}
			table_body += '</table>';
	 
	       		$('#chemicalrowtable').html(table_body);
		})
	// end here
		})

	// end here


	$(".getsubid").click(function(){
		var getsubid = $(this);
		var subproid = getsubid.attr('data-proid');
		$("#showsetdiv").show(500);

		$("#selectedproid").val(subproid);
	})
})