<?php

	class UserModel extends CI_Model
	{

		// Admin login start here
		public function loginadminuser($username,$userpass)
		{
			$data = $this->db->select("*")
					->from("baris_user")
					->where("username",$username)
					->where("user_password",md5($userpass))
					->get();
			$result = $data->result();
			//echo $this->db->last_query();
			$sessData = array
						(
							'fname' 	=> 	$result[0]->first_name,
							'lname' 	=> 	$result[0]->last_name,
							'userid'	=> 	$result[0]->id,
							'username'	=>	$result[0]->username,		
							'useremail'	=>	$result[0]->user_email,		
						);
			$sessiondata = $this->session->set_userdata($sessData);
			return $sessiondata;
			 //return $result;		
		}

		// gel all processes 
		public function getallprocesses()
		{
			$data = $this->db->select("*")
					->from("baris_processes")
					->where("status", ACTIVE_STATUS)
					->get();
			$res = $data->result();
			return $res;
		}
		// end here

		// Get All Processes With Their Sub Processes
		public function getAllProcessesWithSubProcesses()
		{
			$data = $this->db->select("
								bpro.id as id,
								bpro.processes_name as processes_name,
								bpro.processes_full_name as processes_full_name,
								bpro.status as status,
								bsubpro.id as subproId,
								bsubpro.sub_processes_name as sub_processes_name,
								bsubpro.processes_id as processes_id
							")
				  	->from("baris_processes as bpro")
				  	->join("baris_subprocesses as bsubpro","bsubpro.processes_id = bpro.id")
				  	->get();
			$res = $data->result();
			foreach ($res as $key=>$val){
				$finalarr[$val->processes_name][] = (object) array("id"=>$val->id,'subproId'=>$val->subproId,'sub_processes_name'=>$val->sub_processes_name) ;
			}
			return json_encode($finalarr);

		}
		// End here
		// Get All Processes With id With Their Sub Processes
		public function getAllProcessesWithSubProcessesWithId($proid,$subproid)
		{
			$proid = explode(",",$_POST['processid']);
			$subproid = explode(",",$_POST['subproid']);
			foreach ($proid as $key=>$val){
				$data = $this->db->select("
									bpro.id as id,
									bpro.processes_name as processes_name,
									bpro.processes_full_name as processes_full_name,
									bpro.status as status,
									bsubpro.id as subproId,
									bsubpro.sub_processes_name as sub_processes_name,
									bsubpro.processes_id as processes_id
								")
					  	->from("baris_processes as bpro")
					  	->join("baris_subprocesses as bsubpro","bsubpro.processes_id = bpro.id")
					  	->where("bpro.id",$val)
					  	->where_in("bsubpro.id",$subproid)
					  	->get();
				$res[] = $data->result();
			}
			$mainhtml = '';

			/*foreach ($res as $key=>$val){
				$finalarr[$val->processes_name.'|'.$val->id][] = (object) array("id"=>$val->id,'subproId'=>$val->subproId,'sub_processes_name'=>$val->sub_processes_name) ;
				}*/
				foreach ($res as $key=>$v){
					foreach ($v as $k=>$val){
					$finalarr[$val->processes_name.'|'.$val->id][] = (object) array("id"=>$val->id,'subproId'=>$val->subproId,'sub_processes_name'=>$val->sub_processes_name) ;
					}
				}
			 return json_encode($finalarr);

		}
		// End here
		public function getAllProcessesWithSubProcessesWithIdsec($proid,$subproid)
		{
			$proid = explode(",",$proid);
			$subproid = explode(",",$subproid);
			foreach ($proid as $key=>$val){
				$data = $this->db->select("
									bpro.id as id,
									bpro.processes_name as processes_name,
									bpro.processes_full_name as processes_full_name,
									bpro.status as status,
									bsubpro.id as subproId,
									bsubpro.sub_processes_name as sub_processes_name,
									bsubpro.processes_id as processes_id
								")
					  	->from("baris_processes as bpro")
					  	->join("baris_subprocesses as bsubpro","bsubpro.processes_id = bpro.id")
					  	->where("bpro.id",$val)
					  	->where_in("bsubpro.id",$subproid)
					  	->get();
				$res[] = $data->result();
			}
			$mainhtml = '';
 
				foreach ($res as $key=>$v){
					foreach ($v as $k=>$val){
					$finalarr[$val->processes_name.'|'.$val->id][] = (object) array("id"=>$val->id,'subproId'=>$val->subproId,'sub_processes_name'=>$val->sub_processes_name) ;
					}
				}
			 return json_encode($finalarr);

		}
		// get all processes with sub processes by processes id in Set Processes
		public function getProcessesWithSubprocessesInSetProcesses($line_processes,$line_sub_processes,$processesid)
		{
			$proid = explode(",",$line_processes);
			$subproid = explode(",",$line_sub_processes);
			foreach ($proid as $key=>$val){
				$data = $this->db->select("
									bpro.id as id,
									bpro.processes_name as processes_name,
									bpro.processes_full_name as processes_full_name,
									bpro.status as status,
									bsubpro.id as subproId,
									bsubpro.sub_processes_name as sub_processes_name,
									bsubpro.processes_id as processes_id
								")
					  	->from("baris_processes as bpro")
					  	->join("baris_subprocesses as bsubpro","bsubpro.processes_id = bpro.id")
					  	->where("bpro.id",$processesid)
					  	->where_in("bsubpro.id",$subproid)
					  	->get();
				$res[] = $data->result();
			}
			foreach ($res as $key=>$v){
					foreach ($v as $k=>$val){
					$finalarr[$val->processes_name.'|'.$val->id][] = (object) array("id"=>$val->id,'subproId'=>$val->subproId,'sub_processes_name'=>$val->sub_processes_name) ;
					}
				}
			 return json_encode($finalarr);
		}
		// end here

		// Get all station start here
		public function getallstation()
		{
			$data = $this->db->select("*")
					->from("baris_station")
					->where("status",ACTIVE_STATUS)
					->get();
			$res = $data->result();
			return $res;		
		}
		// end here

		//get all division start here
		public function getallorgnization()
		{
			$data = $this->db->select("*")
					->from("baris_organization")
					->where("status",ACTIVE_STATUS)
					->get();
			$result = $data->result();		
			return $result;
		}
		// end here

 		// get all division start here
 		public function getAlldivision()
 		{
 			$data = $this->db->select("*")
 					->from("baris_devision")
 					->where("status",ACTIVE_STATUS)
 					->get();
 			$res = $data->result();
 			return $res;		
 		}
 		// end here
 		// create unique Id Start Here
		public function uniqueId($usertype)
		{
			$time = substr(md5(strtotime(TODAY_DATE)),-7);
			$unique = $usertype.'_'.$time;
			return $unique;
		}
		// end here 

 		/* ======================================
 			start all owner function from here
 		====================================   */
 		//  Insert Owner With Condition start here
 		public function insertOwnerdata($owner_firstname,$owner_lastname,$owner_username,$owner_devision,$stationid,$owner_email,$owner_phone,$owner_password,$processesid,$subprocesses,$uniqueId,$loginid)
 		{
 			$proid = explode(',',$processesid);
 			$subproid = explode(',',$subprocesses);

 		 	$insertarray = array(
 		 					'user_unique_id'	=>	$uniqueId,
 		 					'username'			=>	$owner_username,
 		 					'user_password'		=>	$owner_password,
 		 					'first_name'		=>	$owner_firstname,
 		 					'last_name'			=>	$owner_lastname,
 		 					'user_email'		=>	$owner_email,
 		 					'user_phone'		=>	$owner_phone,
 		 					'user_type'			=>	OWNER,
 		 					'created_by'		=>	$loginid,
 		 					'created_date'		=>	TODAY_DATE
 		 					);
 		 	$insertqury = $this->db->insert("baris_user",$insertarray);
 		 	if ($insertqury)
 		 	{
 		 		$lastowerid = $this->db->insert_id();
 		 		$checkowner = $this->db->select("*")
 		 						->from("baris_owner")
 		 						->where("devision_id",$owner_devision)
 		 						->where("station_id",$stationid)
 		 						->where_in("processes_id",$processesid)
 		 						->where_in("sub_processes_id",$subprocesses)
 		 						->get();
 		 		$checkdata = $checkowner->result();
 		 	//echo $this->db->last_query(); die;
 		 		if (empty($checkdata)){
 		 			$barisownertable = array(
 		 								'owner_id'			=>	$lastowerid,
 		 								'devision_id'		=>	$owner_devision,
 		 								'station_id'		=>	$stationid,
 		 								'processes_id'		=>	$processesid,
 		 								'sub_processes_id'	=>	$subprocesses,
 		 								'created_date'		=>	TODAY_DATE
 		 								);
 		 			$insertbarisowner = $this->db->insert("baris_owner",$barisownertable);
 		 			if ($insertbarisowner){
 		 				$masg = array('type'=>'1','message'=>'Owner Added Successfully');
 		 				return json_encode($masg);
 		 			}else {
 		 				$deleteowner = $this->db->where("id",$lastowerid)->delete("baris_user");
 		 				 $masg = array('type'=>'0','message'=>'Somethinng went worng to insert! Please try again letter');
 		 				return json_encode($masg);
 		 			}
 		 		}
 		 		else {
	 		 			$deleteowner = $this->db->where("id",$lastowerid)->delete("baris_user");
	 		 		$masg = 	array('type'=>'0','message'=>'Please select diffrent value of Station,Division,Processes and Sub processes must not be same! Please choose another value to insert');
 		 			return json_encode($masg);	
 		 		}				
 		 	}	

 		}
 		// end here
 		// update owner information start here 
 		public function updateOwnerdata($owner_firstname,$owner_lastname,$owner_username,$owner_devision,$stationid,$owner_email,$owner_phone,$password,$processesid,$subprocesses,$uniqueId,$loginid,$ownerId)
 		{
 			$checkowner = 	$this->db->select("*")
 							->from("baris_owner")
 							->where("devision_id",$owner_devision)
 							->where("station_id",$stationid)
 							->where_in("processes_id",$processesid)
 							->where_in("sub_processes_id",$subprocesses)
 							->where("owner_id !=",$ownerId)
 							->get();
 			$datacheck = $checkowner->result();
 			if (empty($datacheck)){

 				$updatebaisuser = array(
 										'first_name' 	=> 	$owner_firstname,
 										'last_name'		=> 	$owner_lastname,
 										'user_email'	=>	$owner_email,
 										'user_phone'	=>	$owner_phone,
 										'user_password'	=>	$password,
 										'updated_date'	=>	TODAY_DATE
 									);
 				$update = $this->db->where("id",$ownerId)->update("baris_user",$updatebaisuser);
 				if ($update){
 					$udpateowner = array(
 										'devision_id'	=>	$owner_devision,
 										'station_id'	=>	$stationid,
 										'processes_id'	=>	$processesid,
 										'sub_processes_id'	=>	$subprocesses,
 										'updated_date'		=>	TODAY_DATE
 									); 
 					$dataupdate = $this->db->where("owner_id",$ownerId)->update("baris_owner",$udpateowner);
 					//echo $this->db->last_query(); die;
 					if ($dataupdate){
 						 $masg = array("type"=>'1',"message"=>"Owner Details Updated Successfully");
 						 return json_encode($masg);
 					}
 					else {
 						 $masg = array("type"=>'0',"message"=>"Something is wrong!");
 						 return json_encode($masg);
 					}
 				}

 			}		
 			else {
 				$masg = array("type"=>'0',"message"=>"Please select diffrent value of Station,Division,Processes and Sub processes must not be same! Please choose another value to insert");
 				 return json_encode($masg);
 			}		
 		}
 		// end here
 		// get all listing of owner start here
 		public function getallownerlist()
 		{
 			$data = $this->db->select("

 								buser.id as id,
 								buser.user_unique_id as user_unique_id,
 								buser.username as username,
 								buser.first_name as first_name,
 								buser.last_name as last_name,
 								buser.user_email as user_email,
 								buser.user_phone as user_phone,
 								buser.user_type as user_type,
 								buser.status as status,
 								buser.created_date as created_date,
 								
 								bown.id as ownertable_id,
 								bown.owner_id as owner_id,
 								bown.devision_id as devision_id,
 								bown.station_id as station_id,
 								bown.processes_id as processes_id,
 								bown.sub_processes_id as sub_processes_id,

 								bdiv.id as division_id,
 								bdiv.devision_name as devision_name,

 								bsta.id as station_id,
 								bsta.station_name as station_name,

 							")

 					->from("baris_user as buser")
 					->join("baris_owner as bown","bown.owner_id = buser.id")
 					->join("baris_devision as bdiv","bdiv.id = bown.devision_id")
 					->join("baris_station as bsta","bsta.id = bown.station_id")
 					->where("buser.user_type",OWNER)
 					->where("buser.status !=",DELETE_STATUS)
 					->get();
 			$res = $data->result();
 			return json_encode($res);		
 		}
 		// end here


 		// Get Owner information by id start here
 		public function getOwnerById($ownerId)
 		{
 			$data = $this->db->select("

 								buser.id as id,
 								buser.user_unique_id as user_unique_id,
 								buser.username as username,
 								buser.first_name as first_name,
 								buser.last_name as last_name,
 								buser.user_email as user_email,
 								buser.user_phone as user_phone,
 								buser.user_type as user_type,
 								buser.status as status,
 								buser.created_date as created_date,
 								buser.user_password as user_password,
 								
 								bown.id as ownid,
 								bown.owner_id as owner_id,
 								bown.devision_id as devision_id,
 								bown.station_id as station_id,
 								bown.processes_id as processes_id,
 								bown.sub_processes_id as sub_processes_id,
 								bown.status as ownerstatus,
 								bdiv.id as division_id,
 								bdiv.devision_name as devision_name,

 								bsta.id as station_id,
 								bsta.station_name as station_name,

 							")

 					->from("baris_user as buser")
 					->join("baris_owner as bown","bown.owner_id = buser.id")
 					->join("baris_devision as bdiv","bdiv.id = bown.devision_id")
 					->join("baris_station as bsta","bsta.id = bown.station_id")
 					->where("buser.user_type",OWNER)
 					->where("buser.status !=",DELETE_STATUS)
 					->where("buser.id",$ownerId)
 					->get();
 			$res = $data->result();
 			return json_encode($res);
 		}
 		// end here
 		/* ======================================
 			END HERE

 			START CONTRACTOR FUNCTION
 		====================================   */

 		public function insertContractor($orgid,$cont_contract_name,$cont_firstname,$cont_lastname,$cont_username,$cont_owner,$processesid,$subproid,$cont_email,$cont_phone,$cont_password,$uniqueId,$loginid)
 		{
 			$owerdata = explode("|",$cont_owner);
 			$owneruserid = $owerdata[0];
 			$divid 	= $owerdata[1];
 			$statid = $owerdata[2];
 			$owerid = $owerdata[3];
 			$proid = explode(",",$processesid);
 			$sproid = explode(",",$subproid);

 			$selectcont = $this->db->select("*")
 						 ->from("baris_contractor")
 						 ->where("owner_id",$owerid)
 						 ->where("devision_id",$divid)
 						 ->where("station_id",$statid)
 						 ->where_in("processes_id",$processesid)
 						 ->where_in("sub_processes_id",$subproid)
 						 ->get();
 			$selectdata = $selectcont->result();

 			if (empty($selectdata)){
 				$insertconarray = array(
 									'user_unique_id'	=>	$uniqueId,
 									'username'			=>	$cont_username,
 									'user_password'		=>	$cont_password,
 									'first_name'		=>	$cont_firstname,
 									'last_name'			=>	$cont_lastname,
 									'user_email'		=>	$cont_email,
 									'user_phone'		=>	$cont_phone,
 									'user_type'			=>	CONTRACTOR,
 									'created_by'		=>	$loginid,
 									'created_date'		=>	TODAY_DATE,
 								);
 				$insertcon = $this->db->insert("baris_user",$insertconarray);
 				if ($insertcon)
 				{
 					$conId = $this->db->insert_id();
 					$conarray = array(
 								"contractor_id"		=>	$conId,
 								"contract_name"		=>	$cont_contract_name,
 								"owner_id"			=>	$owerid,
 								"owner_baris_id"	=>	$owneruserid,
 								"organization_id"	=>	$orgid,
 								"devision_id"		=>	$divid,
 								"station_id"		=>	$statid,
 								"processes_id"		=>	$processesid,
 								"sub_processes_id"	=>	$subproid,
 								"created_date"		=>	TODAY_DATE
 								);
 					//echo '<pre>'; print_r($conarray); die;
 					$insertconc = $this->db->insert("baris_contractor",$conarray);
 					if($insertconc){
 						$masg = 	array('type'=>'1','message'=>'Contractor Added Successfully');
 		 			return json_encode($masg);
 					}
 				}
 			}	
 			else {
 			//	$deleteowner = $this->db->where("id",$lastowerid)->delete("baris_user");
	 		 	$masg = 	array('type'=>'0','message'=>'Another contractor have allready added for theses value. Please select diffrent value of Station,Division,Processes and Sub processes must not be same! Please choose another value to insert');
 		 			return json_encode($masg);
 			}		 
 		}

 		// edit contractor details
 		public function editcontractor($cont_organization,$cont_contract_name,$cont_firstname,$cont_lastname,$cont_username,$cont_owner,$processesid ,$subproid,$cont_email,$cont_phone,$password,$orgid,$table_con_id,$conid,$implodeprocessesid,$implodesubproid)
 		{
 			$owerdata = explode("|",$cont_owner);
 			$owneruserid = $owerdata[0];
 			$divid 	= $owerdata[1];
 			$statid = $owerdata[2];
 			$owerid = $owerdata[3];
 			$proid = explode(",",$implodeprocessesid);
 			$sproid = explode(",",$implodesubproid);

 			$selectcont = $this->db->select("*")
 						 ->from("baris_contractor")
 						 ->where("owner_id",$owerid)
 						 ->where("devision_id",$divid)
 						 ->where("station_id",$statid)
 						 ->where_in("processes_id",$processesid)
 						 ->where_in("sub_processes_id",$subproid)
 						 ->where("id !=",$table_con_id)
 						 ->get();
 			$selectdata = $selectcont->result();
 			//echo $this->db->last_query(); die;
 			if (empty($selectdata)){
 				$insertarray = array(
 								"user_password"	=>	$password,
 								"first_name"	=>	$cont_firstname,
 								"last_name"		=>	$cont_lastname,
 								"user_email"	=>	$cont_email,
 								"user_phone"	=>	$cont_phone,
 								"updated_date"	=>	TODAY_DATE,
 							);
 				$query = $this->db->where("id",$conid)->update("baris_user",$insertarray );
 				if ($query){
 					$conupdatearr = array(
 										"contract_name" 	=> 	$cont_contract_name,
 										"owner_id"			=>	$owerid,
 										"owner_baris_id"	=>	$owneruserid,
 										"organization_id"	=>	$orgid,
 										"devision_id"		=>	$divid,
 										"station_id"		=>	$statid,
 										"processes_id"		=>	$implodeprocessesid,
 										"sub_processes_id"	=>	$implodesubproid
 									);
 			$update = $this->db->where("id",$table_con_id)->update("baris_contractor",$conupdatearr) ;
 			//echo $this->db->last_query(); die;
				if ($update){
					$masg = 	array('type'=>'1','message'=>'Contractor Details Updated Successfully');
	 			return json_encode($masg);
				}
 				}
 			}
 			else {
 				$masg = 	array('type'=>'0','message'=>'Another contractor have allready added for theses value. Please select diffrent value of Station,Division,Processes and Sub processes must not be same! Please choose another value to insert');
 		 			return json_encode($masg);
 			}
 		}
 		// end here
 		// get all contractor list start here
 		public function getallcontractorlist()
 		{
 			$data = $this->db->select("
 								buser.id as id,
 								buser.first_name as first_name,
 								buser.last_name as last_name,
 								buser.user_email as user_email,
 								buser.user_phone as user_phone,
 								buser.user_unique_id  as user_unique_id ,
 								buser.status as status,
 								buser.username as username,
 								buser.created_date as created_date,

 								bcon.id as table_con_id,
 								bcon.contractor_id as contractor_id,
 								bcon.contract_name as contract_name,
 								bcon.owner_id as owner_id,
 								bcon.organization_id as organization_id,
 								bcon.devision_id as devision_id,
 								bcon.station_id as station_id,
 								bcon.processes_id as processes_id,
 								bcon.sub_processes_id as sub_processes_id,

 								borg.id as orgid,
 								borg.organization_name as organization_name,

 								bdiv.id as divid,
 								bdiv.devision_name as devision_name,

 								bsta.id as staid,
 								bsta.station_name as station_name,


 							")
 					->from("baris_user as buser")
 					->join("baris_contractor as bcon","bcon.contractor_id = buser.id")
 					->join("baris_organization as borg","borg.id = bcon.organization_id")
 					->join("baris_devision as bdiv","bdiv.id = bcon.devision_id")
 					->join("baris_station as bsta","bsta.id = bcon.station_id")
 					->where("buser.status !=",DELETE_STATUS)
 					->get();
 				$res = $data->result();
 				return json_encode($res);	
 		}
 		// end here

 		// get contractor detaild by id star here
 		public function getallcontractordataById($conid)
 		{
 			$data = $this->db->select("
 								buser.id as id,
 								buser.first_name as first_name,
 								buser.last_name as last_name,
 								buser.user_email as user_email,
 								buser.user_phone as user_phone,
 								buser.user_unique_id  as user_unique_id ,
 								buser.status as status,
 								buser.username as username,
 								buser.created_date as created_date,
 								buser.user_password as user_password,

 								bcon.id as table_con_id,
 								bcon.contractor_id as contractor_id,
 								bcon.contract_name as contract_name,
 								bcon.owner_id as owner_id,
 								bcon.owner_baris_id as owner_baris_id,
 								bcon.organization_id as organization_id,
 								bcon.devision_id as devision_id,
 								bcon.station_id as station_id,
 								bcon.processes_id as processes_id,
 								bcon.sub_processes_id as sub_processes_id,

 								borg.id as orgid,
 								borg.organization_name as organization_name,

 								bdiv.id as divid,
 								bdiv.devision_name as devision_name,

 								bsta.id as staid,
 								bsta.station_name as station_name,


 							")
 					->from("baris_user as buser")
 					->join("baris_contractor as bcon","bcon.contractor_id = buser.id")
 					->join("baris_organization as borg","borg.id = bcon.organization_id")
 					->join("baris_devision as bdiv","bdiv.id = bcon.devision_id")
 					->join("baris_station as bsta","bsta.id = bcon.station_id")
 					->where("buser.status !=",DELETE_STATUS)
 					->where("buser.id",$conid)
 					->get();
 				$res = $data->result();
 				return json_encode($res);	
 		}

 		// end here

 		// get all owner by contractor id 
 		public function getownerByContractorId($conid)
 		{
 			$data = $this->db->select("
 								buser.id as id,
 								buser.first_name as first_name,
 								buser.last_name as last_name,
 								buser.user_email as user_email,
 								buser.user_phone as user_phone,
 								buser.user_unique_id  as user_unique_id ,
 								buser.status as status,
 								buser.username as username,
 								buser.created_date as created_date,

 								bcon.id as table_con_id,
 								bcon.contractor_id as contractor_id,
 								bcon.contract_name as contract_name,
 								bcon.owner_id as owner_id,
 								bcon.owner_baris_id as owner_baris_id,
 								bcon.organization_id as organization_id,
 								bcon.devision_id as devision_id,
 								bcon.station_id as station_id,
 								bcon.processes_id as contractor_processes_id,
 								bcon.sub_processes_id as contractor_sub_processes_id,
 								bcon.status as contractor_status,

 								bown.id as owner_table_id,
 								bown.owner_id as ownid,
 								bown.processes_id as owner_processesId,
 								bown.sub_processes_id as owner_sub_processes_id,

 								borg.id as orgid,
 								borg.organization_name as organization_name,

 								bdiv.id as divid,
 								bdiv.devision_name as devision_name,

 								bsta.id as staid,
 								bsta.station_name as station_name,


 							")
 					->from("baris_user as buser")
 					->join("baris_contractor as bcon","bcon.owner_baris_id = buser.id")
 					->join("baris_owner as bown","bown.id = bcon.owner_id")
 					->join("baris_organization as borg","borg.id = bcon.organization_id")
 					->join("baris_devision as bdiv","bdiv.id = bcon.devision_id")
 					->join("baris_station as bsta","bsta.id = bcon.station_id")
 					//->where("buser.status !=",DELETE_STATUS)
 					->where("bcon.contractor_id",$conid)
 					->where("bcon.status !=", DELETE_STATUS)
 					->get();

 				// echo $this->db->last_query(); die;
 				$res = $data->result();
 				return json_encode($res);	
 		}
 		// end here
 		/* ======================================
 			END HERE

 			Line Manager function start here
 		====================================   */

	 	public function	getlinemanagerByContactorId($conid)
	 	{
	 		$data = $this->db->select("
	 						buser.id as id,
	 						buser.first_name as first_name,
	 						buser.last_name as last_name,
	 						buser.user_email as user_email,
	 						buser.user_phone as user_phone,
	 						buser.user_type as user_type,
	 						buser.status as status,
	 						buser.created_date as created_date,

	 						bline.id as linemanagerid,
	 						bline.manager_id as manager_id,
	 						bline.contractor_id as contractor_id,
	 						bline.owner_id as owner_id,
	 						bline.organization_id as organization_id,
	 						bline.processes_id as processes_id,
	 						bline.sub_processes_id as sub_processes_id,
	 						bline.shifts as shifts,
	 						bline.created_date as created_date,

	 						borg.id as orgid,
							borg.organization_name as organization_name,

	 				")
	 		->from("baris_user as buser")
	 		->join("baris_linemanager as bline","bline.manager_id = buser.id")
	 		->join("baris_organization as borg","bline.organization_id = borg.id")
	 		->where("bline.contractor_id",$conid)
	 		->get();

	 	$res  = $data->result();
	 	return json_encode($res);	

	 	}


	 	// get all contractor by owner id
	 	public function getcontractorByOenerId($ownid)
	 	{
	 		$data = $this->db->select("

	 					buser.id as id,
	 					buser.first_name as first_name,
	 					buser.last_name as last_name,
	 					buser.user_email as user_email,
	 					buser.status as status,
	 					buser.created_date as created_date,

	 					bcon.contractor_id as contractor_id,
	 					bcon.owner_id as owner_id,
	 					bcon.owner_baris_id as owner_baris_id,
	 					bcon.processes_id as processes_id,
	 					bcon.sub_processes_id as sub_processes_id,
	 					bcon.organization_id as organization_id,
	 					bcon.devision_id as devision_id,
	 					bcon.station_id as station_id,


	 					borg.id as orgid,
	 					borg.organization_name as organization_name,

	 					bsta.id as staId,
	 					bsta.station_name as station_name,

	 					bdiv.id as divId,
	 					bdiv.devision_name as devision_name,

	 				")
	 		->from("baris_user as buser")
	 		->join("baris_contractor as bcon","buser.id = bcon.owner_baris_id")
	 		->join("baris_organization as borg ","bcon.organization_id = borg.id")
	 		->join("baris_station as bsta","bsta.id = bcon.station_id")
	 		->join("baris_devision as bdiv","bdiv.id = bcon.devision_id")

	 		->where("bcon.owner_baris_id",$ownid)
	 		->get();

	 		$res = $data->result();
	 		return json_encode($res);
	 	}
	 	// end here

	 	// Add another owner to a contractor start here
	 	public function addnewownerContractor($contractor_id,$contract_name,$cont_owner,$processesid,$subproid,$implodeporid,$implodesubproid,$orgination_Id)
	 	{
	 		//echo $orgination_Id; die;
	 		$ownerdata = explode('|',$cont_owner);

	 		$ownerid 		= 	$ownerdata[0];
	 		$devision_id 	= 	$ownerdata[1];
	 		$station_id 	= 	$ownerdata[2];
	 		$ownertable_id 	= 	$ownerdata[3];

	 		$checkcon = $this->db->select("*")
	 					->from("baris_contractor")
	 					->where("contractor_id",$contractor_id)
	 					->where("owner_id",$ownertable_id)
	 					->where("organization_id",$orgination_Id)
	 					->where("devision_id",$devision_id)
	 					->where("station_id",$station_id)
	 					->where_in("processes_id",$implodeporid)
	 					->where_in("sub_processes_id",$implodesubproid)
	 					->get();
	 		$checkdata = $checkcon->result();
	 		//
	 		//echo $this->db->last_query(); die;

	 		if (empty($checkdata)){
	 			$insertarr = array(
	 						'contractor_id'		=>	$contractor_id,
	 						'contract_name'		=>	$contract_name,
	 						'owner_id'			=>	$ownertable_id,
	 						'owner_baris_id'	=>	$ownerid,
	 						'organization_id '	=>	$orgination_Id,
	 						'devision_id'		=>	$devision_id,
	 						'station_id'		=>	$station_id,
	 						'processes_id'		=>	$implodeporid,
	 						'sub_processes_id'	=>	$implodesubproid,
	 						'created_date'		=>	TODAY_DATE,
	 						);
	 		//	echo '<pre>'; print_r($insertarr); die;
	 			$insertquery = $this->db->insert("baris_contractor",$insertarr);
//echo $this->db->last_query(); die;
	 			if ($insertquery){
	 					$masg = 	array('type'=>'1','message'=>'Contractor Added Successfully');
 		 			return json_encode($masg);
	 			}
	 		}
	 		else {
				$masg = 	array('type'=>'0','message'=>'Another Line Manager have allready added for theses value. Please select diffrent value of Contactor , Owner , Organization and Sub processes must not be same! Please choose another value to insert');
	 			return json_encode($masg);
	 		}			
	 	}
	 	// end here
 		/* ======================================
 			END HERE
 			All Line Manager function start here

 		====================================   */
 		public function insertLinemanager($line_contracter,$processesid,$subproid,$line_firstname,$line_lastname,$line_username,$line_email,$line_phone,$line_shift,$line_password,$uniqueId,$loginid)
 		{
 			$line_contracter 		= 	explode('|',$line_contracter);
 			$contractor_table_id 	= 	$line_contracter[0];
 			$contractor_id 			= 	$line_contracter[1];
 			$owner_id 				= 	$line_contracter[3];
 			$orgid 					= 	$line_contracter[2];

 			$proid 	= implode(",",$processesid);
 			$subpro = implode(",",$subproid);

 			$checkUser = $this->db->select("*")
 						->from("baris_linemanager")
 						->where("contractor_id",$contractor_id)
 						->where("contractor_baris_table_id",$contractor_table_id)
 						->where("owner_id",$owner_id)
 						->where("organization_id",$orgid)
 						->where_in("processes_id",$processesid)
 						->where_in("sub_processes_id",$subproid)
 						->get();
 						///echo $this->db->last_query(); die;
 			$querycheck = $checkUser->result();
 			if (empty($querycheck))
 			{
 				//LINE_MANAGER
 				$insertQue = array(
 								"user_unique_id"	=>	$uniqueId,
 								"username"			=>	$line_username,
 								"user_password"		=>	$line_password,
 								"first_name"		=>	$line_firstname,
 								"last_name"			=>	$line_lastname,
 								"user_email"		=>	$line_email,
 								"user_phone"		=>	$line_phone,
 								"user_type"			=>	LINE_MANAGER,
 								"created_by"		=>	$loginid,
 								"created_date"		=>	TODAY_DATE,
 							);
 				$queryinsert = $this->db->insert("baris_user",$insertQue);
 				if ($queryinsert){
 					$lineid = $this->db->insert_id();
 					$insertlinebaris = array(
	 										"manager_id" 				=> 	$lineid,
	 										"contractor_id"				=>	$contractor_id,
	 										"contractor_baris_table_id"	=>	$contractor_table_id,
	 										"owner_id"					=>	$owner_id,
	 										"organization_id"			=>	$orgid,
	 										"processes_id"				=>	$proid,
	 										"sub_processes_id"			=>	$subpro,
	 										"shifts"					=>	$line_shift,
	 										"created_by"				=> 	$loginid,
	 										"created_date"				=>	TODAY_DATE	
 										);
 					$queryline = $this->db->insert("baris_linemanager",$insertlinebaris);
 					if ($queryline)
 					{
						$masg = 	array('type'=>'1','message'=>'Line Mangaer Added Successfully');
			 			return json_encode($masg);

 					}
 				}
 			}	
 			else {
				$masg = 	array('type'=>'0','message'=>'Another contractor have allready added for theses value. Please select diffrent value of Station,Division,Processes and Sub processes must not be same! Please choose another value to insert');
	 			return json_encode($masg);
	 		}			
 		}

 		// get all linemagerlist Start here
 		public function getalllinemanagerlist()
 		{
 			$data = $this->db->select("

 								buser.user_unique_id as user_unique_id,
 								buser.id as id,
 								buser.first_name as first_name,
 								buser.last_name as last_name,
 								buser.user_email as user_email,
 								buser.user_phone as user_phone,
 								buser.created_date as created_date,
 								buser.status as status,
 								buser.username as username,

 								bline.manager_id as manager_id,
 								bline.contractor_id as contractor_id,
 								bline.owner_id as owner_id,
 								bline.shifts as shifts,
 								bline.processes_id as processes_is,
 								bline.sub_processes_id as sub_processes_id,
 						")
 				->from("baris_linemanager as bline")
 				->join("baris_user as buser","buser.id  = bline.manager_id")
 				->where("buser.status !=",DELETE_STATUS)
 				->get();
 			$res = $data->result();
 			return json_encode($res);
 		}

 		// end here

 		// get linemager details according to the linemanager Id
 		public function getlinemangaerById($lineid)
 		{
 			$data = $this->db->select("

 								buser.user_unique_id as user_unique_id,
 								buser.id as id,
 								buser.first_name as first_name,
 								buser.last_name as last_name,
 								buser.user_email as user_email,
 								buser.user_phone as user_phone,
 								buser.created_date as created_date,
 								buser.status as status,
 								buser.username as username,

 								bline.manager_id as manager_id,
 								bline.contractor_id as contractor_id,
 								bline.owner_id as owner_id,
 								bline.organization_id as organization_id,
 								bline.shifts as shifts,
 								bline.processes_id as processes_id,
 								bline.sub_processes_id as sub_processes_id,

 								borg.id as orgid,
 								borg.organization_name as organization_name,

 						")
 				->from("baris_linemanager as bline")
 				->join("baris_user as buser","buser.id  = bline.manager_id")
 				->join("baris_organization as borg","borg.id = bline.organization_id")
 				->where("buser.status !=",DELETE_STATUS)
 				->where("buser.id",$lineid)
 				->get();
 			$res = $data->result();
 			return json_encode($res);
 		}
 		// end here

 		/*
			Get Processes By Multiple Id
 		*/
		public function getprocessesByMultiId($ownerprocess)
		{
			$proid = explode(',',$ownerprocess);
			$data = $this->db->select("*")
					->from("baris_processes")
					->where_in("id",$proid)
					->get();
			$res = $data->result();
			return $res;					
		}
		// end here
		// get sub processes by multi id
		public function getSubprocessesByMultiId($ownerSubprocess)
		{
			$subroid = explode(',',$ownerSubprocess);
			$data = $this->db->select("*")
					->from("baris_subprocesses")
					->where_in("id",$subroid)
					->get(); 
			$res = $data->result();
			return $res;		
		}
		// end here 
		public function checkusername($username)
		{
			$data = $this->db->select("username")
					->from("baris_user")
					->where("username",$username)
					->get();
			$result = $data->result();
			return $result;		

		}
		// end here
	}
?>