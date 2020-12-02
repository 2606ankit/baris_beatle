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
		// get owner acc to the id
		public function getownerById($ownerid)
		{
			$data = $this->db->select("buser.id as id,buser.first_name as first_name,buser.last_name as last_name,buser.username as username,buser.user_email as user_email,buser.user_phone as user_phone,buser.created_date as created_date,buser.user_password as user_password, buser.status as status, bdiv.id as divid, bdiv.devision_name as devision_name, bsta.id as staid , bsta.station_name as station_name,buserpro.id as proid,buserpro.processes_id as processes_id,buserpro.user_id as uid")
					->from("baris_user as buser")
					->join("baris_devision as bdiv","bdiv.id = buser.user_devision","left")
					->join("baris_station as bsta","bsta.id = buser.user_station","right")
					->join("baris_user_processes as buserpro","buserpro.user_id = buser.id","right")
					->where("buser.status !=",DELETE_STATUS)
					->where("buser.id",$ownerid)
					->get();
			$result = $data->result();
			return $result;
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
			$data = $this->db->select("*")
					->from("baris_user_processes")
					->where("user_id",$ownerId)
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
		// end here
	}
?>