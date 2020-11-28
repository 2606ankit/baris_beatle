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
	}
?>