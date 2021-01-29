<?php

	class AjaxModel extends CI_Model
	{
		// get all sub procsses by processes id  Start here
		public function getSubprocessByProcessesId($proid)
		{
			$data = $this->db->select("sub_processes_name,id,processes_id")
					->from("baris_subprocesses")
					->where("processes_id",$proid)
					->get();
			$res = $data->result();
			return json_encode($res);		
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
		// change status start here
		public function changestatus($tablename,$statuvalue,$statusid)
		{
			$maintable = TABLE_PREFIX.'_'.$tablename;

			$data = $this->db->where("id",$statusid)->update($maintable,array("status"=>$statuvalue));
			 //echo $this->db->last_query(); die;
			if ($data){return true; }else {return false; }
		}
		// end here
		// Change Status for link table start here Start from here
		public function changestatuslinktable($tablename,$statuvalue,$statusid,$checkid)
		{
			$maintable = TABLE_PREFIX.'_'.$tablename;
			$checkcon = array('id'=>$statusid);
			$data = $this->db->where($checkcon)->update($maintable,array("status"=>$statuvalue));
			 // echo $this->db->last_query(); die;
			if ($data){return true; }else {return false; }
		}
		// end here

		// get all processes from baris_owner 
		public function getprocessesOfownerfrombarisOwner($barisOwnerid)
		{
			$data = $this->db->select("*")
						->from("baris_owner")
					->where("id",$barisOwnerid)->get();
			$res = $data->result();
			return json_encode($res);		
		}
		//

		// get all processes and subprocesses By contractor Id
		public function getAllprocessesAndSubprocessesOfContractor($cont_table_con_id)
		{
			$data = $this->db->select("*")
						->from("baris_contractor")
					->where("id",$cont_table_con_id)->get();
			$res = $data->result();
			return json_encode($res);		
		}
		// end here
	}
?>