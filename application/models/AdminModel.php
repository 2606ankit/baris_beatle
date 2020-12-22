<?php

	class AdminModel extends CI_Model
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

		// get all orgnization start here
		public function getallorgnization()
		{
			$data = $this->db->select("*")
					->from("baris_organization")
					->where("status !=",DELETE_STATUS)
					->get();
			$result = $data->result();		
			return $result;
		}
		// end here
		// get orgnization by id
		public function getorganizationbyId($orgid)
		{
			$data = $this->db->select("*")
					->from("baris_organization")
					->where("id",$orgid)
					->where("status !=",DELETE_STATUS)
					->get();
			$result = $data->result();
			return $result;
		}
		// end here
		// get user by id
		public function getuserById($userid)
		{
			$data = $this->db->select("*")
					->from("baris_user")
					->where("id",$userid)
					->get();
			$res = $data->result();
			return json_encode($res);		
		}
		// end here
		// get all owner details start here

		// end here
		// Check Devision If Already In database
		public function checkdevision($checkvalue)
		{	
			$data = $this->db->select("devision_name")
					->from("baris_devision")
					->where("devision_name",$checkvalue)
					->get();
			$result = $data->result();		
			return $result;
		}
		// end here
		// Check Processes If already in database
		public function checkprocesses($checkvalue)
		{
			$data = $this->db->select("*")
					->from("baris_processes")
					->where("processes_name",$checkvalue)
					->get();
			$result = $data->result();		
			return $result;
		}
		// end here
		// check username if already in database
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
		// check username if already in database
		public function checkeditusername($username,$ownerid)
		{
			$data = $this->db->select("username")
					->from("baris_user")
					//->where("username",$username)
					->where("id",$ownerid)
					->get();
					echo $this->db->last_query(); die;
			$result = $data->result();
			return $result;		

		}
		// end here
		// check if orgnization is already 
		public function checkorgnization($orgname)
		{
			$data = $this->db->select("*")
					->from("baris_organization")
					->where("organization_name",$orgname)
					->get();
			$result = $data->result();
			return $result;		
		}
		// end here
		// check if useremail already in database
		public function chackuseremail($useremail)
		{
			$data = $this->db->select("user_email")
					->from("baris_user")
					->where("user_email",$useremail)
					->get();
			$result = $data->result();
			return $result;		
			
		}
		// end here
		// get All Devision Start here
		public function getalldevision()
		{
			$status = DELETE_STATUS;
			$data = $this->db->select("*")
					->from("baris_devision")
					->where("status !=",$status)
					->get();
			$result = $data->result();
			return $result;		
		}
		// End Here
		// Get devision data by Id
		public function getdevisionbyid($divid)
		{
			$data = $this->db->select("*")
					->from("baris_devision")
					->where("id",$divid)
					->get();
			$result = $data->result();
			return $result;		
		}
		// end here

		// get all processes start here
		public function getallprocesses()
		{
			$data = $this->db->select("*")
					->from("baris_processes")
					->where("status !=",DELETE_STATUS)
					->get();
			$result = $data->result();
			return $result;		
		}
		// end here
		// get only owner start here
		public function getowner()
		{
			$data = $this->db->select("*")
					->from("baris_user")
					->where("user_type",OWNER)
					->where("status !=",DELETE_STATUS)
					->get();
			$result = $data->result();
			return $result;
		}
		// end here
		// Get all linemanager start here
		public function getalllinemager()
		{
			$data = $this->db->select("*")
					->from("baris_user")
					->where("status !=",DELETE_STATUS)
					->where("user_type",LINE_MANAGER)
					->get();
			$result = $data->result();
			return json_encode($result);		
		}
		// end here
		// get line manager By Id
		public function getlinemanagerWithId($linemanid)
		{
			$data = $this->db->select("buser.id as id,buser.first_name as first_name,buser.last_name as last_name,buser.status as status,buser.user_email as user_email,buser.user_phone as user_phone, bline.manager_id as manager_id,bline.contractor_id as contractor_id,bline.organization_id as organization_id,bline.processes_id as processes_id,bline.sub_processes_id as sub_processes_id")
					->from("baris_user as buser")
					->join("baris_linemanager as bline","bline.manager_id = buser.id")
					->where("buser.id",$linemanid)
					->get();
			$res = $data->result();		
			return $res;
		}
		// end here
		// Get all owner with devision table and station name start here
		public function getallowner()
		{
			$data = $this->db->select("buser.id as id,buser.first_name as first_name,buser.last_name as last_name,buser.username as username,buser.user_email as user_email,buser.user_phone as user_phone,buser.created_date as created_date, buser.status as status, bdiv.id as divid, bdiv.devision_name as devision_name, bsta.id as staid , bsta.station_name as station_name")
					->from("baris_user as buser")
					->join("baris_devision as bdiv","bdiv.id = buser.user_devision","left")
					->join("baris_station as bsta","bsta.id = buser.user_station","right")
					->where("buser.status !=",DELETE_STATUS)
					->where("buser.user_type",OWNER)
					->get();
			$result = $data->result();
			return json_encode($result);		
		}
		// end here
 
		// end here
		// get owner acc to the id
		public function getownerById($ownerid)
		{
			$data = $this->db->select("buser.id as id,buser.user_unique_id as user_unique_id,buser.first_name as first_name,buser.last_name as last_name,buser.username as username,buser.user_email as user_email,buser.user_phone as user_phone,buser.created_date as created_date,buser.user_password as user_password, buser.status as status, bdiv.id as divid, bdiv.devision_name as devision_name, bsta.id as staid , bsta.station_name as station_name,buserpro.id as proid,buserpro.processes_id as processes_id,buserpro.user_id as uid")
					->from("baris_user as buser")
					->join("baris_devision as bdiv","bdiv.id = buser.user_devision","left")
					->join("baris_station as bsta","bsta.id = buser.user_station","right")
					->join("baris_user_processes as buserpro","buserpro.user_id = buser.id","right")
					->where("buser.status ",ACTIVE_STATUS)
					->where("buser.id",$ownerid)
					->get();

			$result = $data->result();
			return json_encode($result);
		}
		// end here
		// get Contractor By Owner ID Start here
		public function getContractorByOwnerId($ownerid)
		{
			$data = $this->db->select("bcon.contractor_id as contractor_id,bcon.owner_id as owner_id,bcon.organization_id as organization_id,bcon.devision_id as devision_id,bcon.station_id as station_id,bcon.processes_id as processes_id ,buser.id as id,buser.first_name as first_name , buser.last_name as last_name, buser.user_email as user_email ,  buser.user_phone as user_phone")
					->from("baris_contractor as bcon")
					->join("baris_user as buser","buser.id = bcon.contractor_id")
					->where("bcon.owner_id",$ownerid)
					->get();
					//echo $this->db->last_query(); die;
			$res = $data->result();
			return $res;		
		}
		// end here
		

		// get all contractor start here
		public function getallcontractor()
		{
			/*$data = $this->db->select("buser.id as id, buser.first_name as first_name,buser.last_name as last_name,buser.user_email as user_email,buser.username as username,buser.user_phone as user_phone ,buser.status as status,buser.created_date as created_date,buser.user_type as user_type, bcon.contractor_id as contractor_id,bcon.owner_id as owner_id,bcon.organization_id as organization_id,bcon.devision_id as devision_id,bcon.station_id as station_id,bcon.processes_id as processes_id")
					->from("baris_user as buser")
					->join("baris_contractor as bcon","bcon.contractor_id = buser.id")
					->where("buser.user_type",CONTRACTOR)
					->where("buser.status ",ACTIVE_STATUS)
					->get();
			$result = $data->result();*/
			$data = $this->db->select("*")
					->from('baris_user')
					->where("user_type",CONTRACTOR)
					->where("status",ACTIVE_STATUS)
					->get();
			$result = $data->result();
			return json_encode($result);		
		}
		// end here

		// get contractor details by ID
		public function getcontractorById($conid)
		{
			$data = $this->db->select("buser.id as id,buser.user_unique_id as user_unique_id,buser.user_password as user_password, buser.first_name as first_name,buser.last_name as last_name,buser.user_email as user_email,buser.username as username,buser.user_phone as user_phone ,buser.status as status,buser.created_date as created_date,buser.user_type as user_type, bcon.contractor_id as contractor_id,bcon.owner_id as owner_id,bcon.organization_id as organization_id,bcon.devision_id as devision_id,bcon.station_id as station_id,bcon.processes_id as processes_id")
					->from("baris_user as buser")
					->join("baris_contractor as bcon","bcon.contractor_id = buser.id")
					->where("buser.user_type",CONTRACTOR)
					->where("buser.id ",$conid)
					->get();
			$result = $data->result();
			return json_encode($result);
		}
		// end heregetallprocessAccToCnontractor

		// Get All Contractor With Their orgnization information start here
		public function getcontractorWithOrg()
		{
			$data = $this->db->select("buser.id as id,buser.status as status,buser.first_name as first_name,buser.last_name as last_name,bcon.id as bconid,bcon.contractor_id as contractor_id,bcon.processes_id as processes_id,bcon.owner_id as owner_id,bcon.organization_id as orgId,borg.id as oID,borg.organization_name as organization_name,buser.user_type as user_type")
					->from("baris_user as buser")
					->join("baris_contractor as bcon","bcon.contractor_id = buser.id")
					->join("baris_organization as borg","borg.id = bcon.organization_id ")
					//->join("baris_user as buser","buser.id = bcon.owner_id")
					->where("buser.user_type",CONTRACTOR)
					->where("buser.status",ACTIVE_STATUS)
					->get();
			$result = $data->result();
			return json_encode($result);		
		}
		// end here

		// check all information of contractor before insert value
		// if devision id , station id , owner id , and processes id should not be same if not conratctor will be insert
		public function checkcontratorInfo($ownerdetail,$useremail,$proidcheck,$firstname,$lastname,$username,$phone,$passwrod,$loginuserid,$orgid,$uniqueId)
		{
			$ownerinfo 	= explode('|', $ownerdetail);
			$ownerid 	= $ownerinfo[0];
			$devisionid = $ownerinfo[1];
			$stationid 	= $ownerinfo[2];

			$data = $this->db->select("user_email")
					->from("baris_user")
					->where("user_email",$useremail)
					->get();
			$result = $data->result();
			if (empty($result)){
				$insertdata = array(
									'user_unique_id'	=>	$uniqueId,
									'username'			=>	$username,
									'user_password'		=>	md5($passwrod),
									'first_name'		=>	$firstname,
									'last_name'			=>	$lastname,
									'user_email'		=>	$username,
									'user_phone'		=>	$phone,
									'user_type'			=>	CONTRACTOR,
									'created_date'		=>	TODAY_DATE,
									'created_by'		=>	$loginuserid
								);
				$insertquery = $this->db->insert("baris_user",$insertdata);
				if ($insertquery){
					$lastid = $this->db->insert_id();
					$continsert = array(
										'contractor_id'		=>	$lastid,
										'owner_id'			=>	$ownerid,
										'organization_id'	=>	$orgid,
										'devision_id'		=>	$devisionid,
										'station_id'		=>	$stationid,
										'processes_id'		=>	$proidcheck,
										'created_date'		=>	TODAY_DATE
									);
					$query = $this->db->insert("baris_contractor",$continsert);
					if ($query){
						return true;
					}
				}
			}
			else {
				$userid = $result[0]->id;
				$checkcon = $this->db->select("*")
							->from("baris_contractor")
							->where("contractor_id",$userid)
							->where("owner_id",$ownerid)
							->where("devision_id",$devisionid)
							->where("station_id",$stationid)
							->where_in("processes_id",$proidcheck)
							->get();
				$res = $checkcon->result();
				if (empty($res)){
					return true;
				}
				else {
					return false;
				}
			}					
		}
		// end here
		// Get all prossess With their sub processes
		public function getallSubProcessesByProcessesId($proid)
		{
			$data = $this->db->select("*")
					->from("baris_subprocesses")
					->where("processes_id",$proid)
					->get();
			$result =	$data->result();
			return $result; 		
		}
		// end here
		// 
		public function getallsubprocessAccProId($proid)
		{
			$data = $this->db->select("*")
					->from("baris_subprocesses")
					->where("processes_id",$proid)
					->get();
				//echo $this->db->last_query();die;	
			$result = $data->result();
			return json_encode($result);	
		}
		// Get Processes acc to the id
		public function getprocessesAccId($proid)
		{
			$data = $this->db->select("*")
					->from("baris_processes")
					->where("id ",$proid)
					->get();
			$result = $data->result();
			return $result;		

		}
		// end here
		// get processes multiple string
		public function getprocessesMultiAccId($proid)
		{
			$data = $this->db->select("*")
					->from("baris_processes")
					->where_in("id ",$proid)
					->get();
					 //echo $this->db->last_query();
			$result = $data->result();
			return $result;		

		}
		public function getSubproByPro($proid)
		{
			//$pid = explode
			$data = $this->db->select("bpro.id as id,bpro.processes_name as processes_name,bpro.processes_full_name as processes_full_name,bsubpro.sub_processes_name  as sub_processes_name ,bsubpro.processes_id as processes_id,bsubpro.id as subid")
					->from("baris_processes as bpro")
					->join("baris_subprocesses as bsubpro","bpro.id = bsubpro.processes_id")
					->where_in("processes_id ",$proid)
					//->group_by("processes_id")
					->get();
				 	// echo $this->db->last_query();
			$result = $data->result();
			foreach ($result as $k=>$v){
				$finalarray[$v->processes_id.'|'.$v->processes_name.'|'.$v->processes_full_name][] = (object) array("sub_processes_name"=>$v->sub_processes_name,"id"=>$v->subid); 
			}
			return $finalarray;	
		}
		// end here
		// get all subprocesses according to sub processesid
		public function getSubprocessesBySubprocessesid($subproid)
		{
			$data = $this->db->select("*")
					->from("baris_subprocesses")
					->where_in("id",$subproid)
					->get();
			$res = $data->result();
			return $res;		
		}
		// end here
		// Get All line manager according to the Contractor Id
		public function getLineManagerByConId($conid)
		{
			/*$data = $this->db->select("*")
					->from("baris_linemanager")
					->where("contractor_id",$conid)
					->get();*/
			$data = $this->db->select("buser.id as id , buser.first_name as first_name , buser.last_name as last_name , buser.user_email as user_email , buser.user_phone as user_phone , bline.manager_id as manager_id , bline.contractor_id as contractor_id , bline.owner_id as lineowner_id , bline.organization_id as lineorganization_id , bline.processes_id as lineprocesses_id , bline.sub_processes_id as linesub_processes_id")
					->from("baris_linemanager as bline")
					->join("baris_user as buser","buser.id = bline.manager_id")
					->where("bline.contractor_id",$conid)
					->get();

			$res = $data->result();
			return 	$res;	
		}
		// End here
		// get all Owner By Contractor Id 
		public function getOwnerAccToCon($conid)
		{
			$data = $this->db->select("bcon.owner_id as owner_id , bcon.processes_id as bconproid,buser.id as id, buser.first_name as first_name,buser.last_name as last_name,buser.user_email as user_email, buser.user_phone as user_phone,bpro.user_id as userid,bpro.processes_id as processes_id")
					->from("baris_contractor as bcon")
					->join("baris_user as buser","buser.id = bcon.owner_id")
					->join("baris_user_processes as bpro","bpro.user_id = buser.id")
					->where("bcon.contractor_id",$conid)
					->get();
			$res = $data->result();
			return $res;
		}
		// end here
		// Change Status Start from here
		public function changestatus($tablename,$statuvalue,$statusid)
		{
			$maintable = TABLE_PREFIX.'_'.$tablename;

			$data = $this->db->where("id",$statusid)->update($maintable,array("status"=>$statuvalue));
			 //echo $this->db->last_query(); die;
			if ($data){return true; }else {return false; }
		}
		// end here

		// Get all Station here
		public function getallstation()
		{
			$data = $this->db->select("*")
					->from("baris_station")
					->where("status !=",DELETE_STATUS)
					->get();
					 
			$result = $data->result();
			return $result;		
		}
		// end here
		// get station by id
		public function getstationById($staid)
		{
			$data = $this->db->select("*")
					->from("baris_station")
					->where("id",$staid)
					->where("status !=",DELETE_STATUS)
					->get();
			$result = $data->result();		
			return $result;
		}
		// end here
		// check station by name
		public function checkstation($owner_station,$loginuserid)
		{
			$data = $this->db->select("station_name,id")
					->from("baris_station")	
					->where("station_name",$owner_station)
					->where("status !=",DELETE_STATUS)
					->get();
			$result = $data->result();
			if (!empty($result)){
				$staionid = $result[0]->id;
				return $staionid;
			} 		

		}
		// end here

		// Get all processes acording to the selected processes for owner
		public function getallprocessAccToOwner($ownerId)
		{
			$owner = explode('|',$ownerId);
			$data = $this->db->select("*")
					->from("baris_user_processes")
					->where("user_id",$owner[0])
					->get();
			$data = $data->result();
			$processesid = explode('|',$data[0]->processes_id);
			
			foreach ($processesid as $k=>$v){
				$selectdata = $this->db->select("id,processes_name")
								->from("baris_processes")
								->where("id",$v)
								->get();
				$res[] = $selectdata->result();				
			}		
			foreach ($res as $k=>$v){
				foreach ($v as $h=>$l){
					$finalarr[] = (object) array("id"=>$l->id,"proname"=>$l->processes_name);
				}
			}


							

			return $finalarr;
		}
		 
		 // Get all processes acording to the selected processes for owner
		public function getallprocessAccToOwnerCon($ownerId)
		{
			 
			$owner = explode('|',$ownerId);

			$data = $this->db->select("*")
					->from("baris_user_processes")
					->where("user_id",$owner[0])
					->get(); 
			$data = $data->result(); 
			$processesid = explode('|',$data[0]->processes_id);
			 
			foreach ($processesid as $k=>$v){
				$selectdata = $this->db->select("id,processes_name")
								->from("baris_processes")
								->where("id",$v)
								->get();
				$res[] = $selectdata->result();				
			}		

			foreach ($res as $k=>$v){
				foreach ($v as $h=>$l){
					$finalarr[] = (object) array("id"=>$l->id,"proname"=>$l->processes_name);
				}
			}
			 
			 
			return $finalarr;
		}
		// get all contractor processes by table id baris_contractor
		public function getallprocessAccToCnontractor($conid)
		{
			$maincon = explode("|",$conid);
			$id = $maincon[0];
			 
			$data = $this->db->select("processes_id")
					->from("baris_contractor")
					->where("contractor_id",$id)
					->get();
			$res = $data->result();		
			 
			$process = explode(",",$res[0]->processes_id);
			
				/*$selectpro = $this->db->select("bpro.id as id, bpro.processes_name as processes_name,bsubpro.id as bsubid,bsubpro.processes_id as processes_id,bsubpro.sub_processes_name as sub_processes_name")
							->from("baris_processes as bpro")
							->join("baris_subprocesses as bsubpro","bsubpro.processes_id = bpro.id")
							->where_in("bpro.id",$process)

							->get();
			*/
			$selectpro = $this->db->select("*")
						->from("baris_processes")
						->where_in("id",$process)
						->get();
			$query = $selectpro->result();
			//print_r($query); die;
			foreach ($query as $k=>$v){
					$select = $this->db->select("*")
							  ->from("baris_subprocesses")
							  ->where("processes_id",$v->id)
							  ->get();
					$query = $select->result();
					foreach ($query as $key=>$val){
					$finalarr[$v->id.','.$v->processes_name][] = (object) array('id'=>$val->id,'sub_processes_name'=>$val->sub_processes_name);
				}		   
				

			} 
			//echo '<pre>'; print_r($finalarr); die;	
			print_r(json_encode($finalarr));		
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
	}
?>