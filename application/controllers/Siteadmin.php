<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siteadmin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		$data = array();
	    parent::__construct();
	    // load library form validation
	    $this->load->library('form_validation');
	   	$this->load->helper('url');
	   	$this->load->model('UserModel');
	   	$this->load->library('pagination');
	   
	   	$this->load->library('email'); 

	   	$this->getprocsses 		= $this->UserModel->getAllProcessesWithSubProcesses();
	   	$this->getstation 		= $this->UserModel->getallstation();
	   	$this->getprcesses 		= $this->UserModel->getallprocesses();
	   	$this->getorganization  = $this->UserModel->getallorgnization();
	   	// get all station here
	}

	// Login Function Start here

	public function index()
	{
		if(!empty($this->session->userdata('userid'))){redirect(ADMIN_URL.'dashboard');} 
			if (isset($_POST) && !empty($_POST)){
	 			$username = $this->input->post('username');
	 			$userpass = $this->input->post('userpass');

	 			$data = $this->UserModel->loginadminuser($username,$userpass);
	 			$loginid = $this->session->userdata('userid');
	 			if(!empty($loginid)){
	 				$this->session->set_flashdata('message', 'Welcome to the daashboard');
	 				redirect(ADMIN_URL.'dashboard');
	 			}
	 			 
	 		}
		  
		$this->load->view('siteadmin/login');
	}
	// end here 

	// Logout function Start here
	public function logout()
	{
		$user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    	$this->session->sess_destroy();
    	redirect(ADMIN_URL.'index');
	}
	// end here

	// Dashboard Start here
	public function dashboard()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
			$userdata = $this->session->userdata();

			$data = array
						(
							'usedata' 			=>	$userdata,
							'getstation' 		=> 	$this->getstation,
							'getprcesses' 		=>	$this->getprcesses,
							'getorganization' 	=> 	$this->getorganization ,
						);
			$this->load->view('admin/dashboard',$userdata);	
	}
	// End here

	 /* =====================================
		All Owner Related Function Start Here
	 ======================================= */
	public function addowner()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getallprocesses = $this->UserModel->getallprocesses();
		$getAlldivision  = $this->UserModel->getAlldivision();
		$loginid = $this->session->userdata('userid');
		//echo '<pre>'; print_r(json_decode($getAllProcessesWithSubProcesses)); die;
		if (!empty($_POST)){
			//echo '<pre>'; print_r($_POST); die;
			$owner_firstname 	= 	$this->input->post('owner_firstname');
			$owner_lastname 	= 	$this->input->post('owner_lastname');
			$owner_username 	= 	$this->input->post('owner_username');
			$owner_devision 	= 	$this->input->post('owner_devision');
			$owner_station 		= 	$this->input->post('owner_station');
			$owner_phone 		= 	$this->input->post('owner_phone');
			$owner_email 		= 	$this->input->post('owner_email');
			$owner_password 	= 	md5($this->input->post('owner_password'));
			$processesid 		= 	implode(',',$this->input->post('processesid'));
			$subprocesses 		= 	implode(',',$this->input->post('subprocesses'));
			$usertype 	 		=  	OWNER_UNIQ;
			$uniqueId	 		=	$this->UserModel->uniqueId($usertype);
			/* 
				Start check if station allready in database or not if exists get id and inseert with owner and if not insert it and get id of station adn then insert with owner 
			*/
			$checkstation = $this->db->select("id,station_name")
							->from("baris_station")->where("station_name",$owner_station)
							->get();
			$checkres = $checkstation->result();
			if(empty($checkres)){
				$stationarr = array("station_name"=>$owner_station,"created_by"=>$loginid,"devision_id"=>$owner_devision,'created_date'=>TODAY_DATE);

				$insertstation = $this->db->insert("baris_station",$stationarr);

				if ($insertstation){
					$stationid = $this->db->insert_id();
				}
			}else{
				$stationid = $checkres[0]->id;
			}
			//echo '<pre>'; print_r($checkres); die;
			// end here
			// Insert Owner value start from here
			$dataquery = $this->UserModel->insertOwnerdata($owner_firstname,$owner_lastname,$owner_username,$owner_devision,$stationid,$owner_email,$owner_phone,$owner_password,$processesid,$subprocesses,$uniqueId,$loginid);
			if($dataquery){
				 $msg = json_decode($dataquery);
				// echo '<pre>'; print_r($msg); die;
				 if ($msg->type == 0){
				 		$this->session->set_flashdata('error',$msg->message);
				 		//echo '<pre>'; print_r($this->session); die;
					 }
				 	else {
							$this->session->set_flashdata('success',$msg->message);
						}
			}
		}
		$data = array
					(
						'usedata' 			=>  $userdata,
						'getallprocesses' 	=>  $getallprocesses,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization ,
						'getAlldivision'	=>	$getAlldivision,
					);
		$this->load->view('admin/addowner',$data);

	}
	public function ownerlist()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getallownerlist = $this->UserModel->getallownerlist();
		// echo '<pre>'; print_r(array_unique(json_decode($getallownerlist))); die;
		$data = array
					(
						'usedata' 			=>  $userdata,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization,
						'getallownerlist'	=>	json_decode($getallownerlist)
					);
		$this->load->view('admin/owner',$data);
	}

	// Edit owner information start here
	public function owneredit()
	{
		$ownerId = base64_decode($this->uri->segment(3));
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getallprocesses = $this->UserModel->getallprocesses();
		$getAlldivision  = $this->UserModel->getAlldivision();
		$loginid = $this->session->userdata('userid');
		$getOwnerById = $this->UserModel->getOwnerById($ownerId);
		//echo '<pre>'; print_r(json_decode($getOwnerById)); die;
		if (!empty($_POST)){

			//echo '<pre>'; print_r($_POST); die;
			$owner_firstname 	= 	$this->input->post('owner_firstname');
			$owner_lastname 	= 	$this->input->post('owner_lastname');
			$owner_username 	= 	$this->input->post('owner_username');
			$owner_devision 	= 	$this->input->post('owner_devision');
			$owner_station 		= 	$this->input->post('owner_station');
			$owner_phone 		= 	$this->input->post('owner_phone');
			$owner_email 		= 	$this->input->post('owner_email');
			$owner_password 	= 	md5($this->input->post('owner_password'));
			$processesid 		= 	implode(',',$this->input->post('processesid'));
			$subprocesses 		= 	implode(',',$this->input->post('subprocesses'));
			$usertype 	 		=  	OWNER_UNIQ;
			$uniqueId	 		=	$this->UserModel->uniqueId($usertype);
			/* 
				Start check if station allready in database or not if exists get id and inseert with owner and if not insert it and get id of station adn then insert with owner 
			*/
			$checkstation = $this->db->select("id,station_name")
							->from("baris_station")->where("station_name",$owner_station)
							->get();
			$checkres = $checkstation->result();
			if(empty($checkres)){
				$stationarr = array("station_name"=>$owner_station,"created_by"=>$loginid,"devision_id"=>$owner_devision,'created_date'=>TODAY_DATE);

				$insertstation = $this->db->insert("baris_station",$stationarr);

				if ($insertstation){
					$stationid = $this->db->insert_id();
				}
			}else{
				$stationid = $checkres[0]->id;
			}
			//echo '<pre>'; print_r($checkres); die;
			// end here
			// Insert Owner value start from here
			if (!empty($_POST['owner_password'])){
				$password = md5($_POST['owner_password']);
			}else {$password = $_POST['old_pass']; }

			$dataquery = $this->UserModel->updateOwnerdata($owner_firstname,$owner_lastname,$owner_username,$owner_devision,$stationid,$owner_email,$owner_phone,$password,$processesid,$subprocesses,$uniqueId,$loginid,$ownerId);
			//echo '<pre>'; print($dataquery); die;
			if($dataquery){
				 $msg = json_decode($dataquery);
				// echo '<pre>'; print_r($msg); die;
				 if ($msg->type == 0){
				 		$this->session->set_flashdata('error',$msg->message);
				 		//echo '<pre>'; print_r($this->session); die;
					 }
				 	else {
							$this->session->set_flashdata('success',$msg->message);
						}
			}
		
		}
		$data = array
				(
					'usedata' 			=>  $userdata,
					'getallprocesses' 	=>  $getallprocesses,
					'getstation' 		=> 	$this->getstation,
					'getprcesses' 		=>	$this->getprcesses,
					'getorganization' 	=> 	$this->getorganization ,
					'getAlldivision'	=>	$getAlldivision,
					'getOwnerById'		=>	json_decode($getOwnerById),
					'ownerId'			=>	$ownerId
				);
		$this->load->view('admin/editowner',$data);


	}
	// end here


	// get all realted detail for owner start here
	public function ownerdetail()
	{
			$ownerId = base64_decode($this->uri->segment(3));
			if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
			$userdata = $this->session->userdata();
			//$getallownerlist = $this->UserModel->getallownerlist();
			$getOwnerById = $this->UserModel->getOwnerById($ownerId);
		 //	  echo '<pre>'; print_r(json_decode($getOwnerById)); die;
			$ownerdetails = json_decode($getOwnerById);
			$ownerprocess = $ownerdetails[0]->processes_id;
			$ownerSubprocess = $ownerdetails[0]->sub_processes_id;
			$getprocssesById = $this->UserModel->getprocessesByMultiId($ownerprocess);
			$getSubprocssesById = $this->UserModel->getSubprocessesByMultiId($ownerSubprocess);
			$getallprocesses = $this->UserModel->getallprocesses();
			$getAlldivision  = $this->UserModel->getAlldivision(); 

			$getcontractorByOenerId = $this->UserModel->getcontractorByOenerId($ownerId) ;
			//echo '<pre>'; print_r(json_decode($getcontractorByOenerId)); die;
			$data = array
						(
							'usedata' 				=>  $userdata,
							'getstation' 			=> 	$this->getstation,
							'getprcesses' 			=>	$this->getprcesses,
							'getorganization' 		=> 	$this->getorganization,
							'getuserById'			=>	json_decode($getOwnerById),
							'getprocssesById'		=>	$getprocssesById,
							'getSubprocssesById'	=>	$getSubprocssesById,
							'getallprocesses'		=>	$getallprocesses,
							'getAlldivision'		=>	$getAlldivision			
						);

			$this->load->view('admin/ownerdetails',$data);
	}
	// end here

	// add Owner to another station and devision
	public function addownerTootherstation()
	{
		//echo '<pre>'; print_r($_POST); die;
		$ownerid 		= 	$_POST['ownerid'];
		$division_id 	= 	$_POST['morediv'];
		$station_id 	= 	$_POST['morestation'];
		$processesid 	= 	implode(',',$_POST['processesid']);
		$subprocesses 	= 	implode(',',$_POST['subprocesses']);

		$checkowner = $this->db->select("*")
						->from("baris_owner")
						->where("owner_id",$ownerid)
						->where("devision_id",$division_id)
						->where("station_id",$station_id)
						->where_in("processes_id",$processesid)
						->where_in("sub_processes_id",$subprocesses)
						->get();
		$datacheck = $checkowner->result();
		if (empty($datacheck))
		{
			$insertarr = array(
								"owner_id"			=>	$ownerid,
								"devision_id"		=>	$division_id,
								"station_id"		=>	$station_id,
								"processes_id"		=>	$processesid,
								"sub_processes_id"	=>	$subprocesses,
								"created_date"		=>	TODAY_DATE		
							);
			$insertqur = $this->db->insert("baris_owner",$insertarr);
			if ($insertqur)
			{
				redirect(ADMIN_URL.'ownerdetail/'.base64_encode($ownerid));
			}
		}		
		else {
			redirect(ADMIN_URL.'ownerdetail/'.base64_encode($ownerid));
		}		

	}
	// end here
	// edit more owner details 
	public function editownerTootherstation()
	{
		//echo '<pre>'; print_r($_POST); die;
		$editownerid	=	$_POST['editownerid'];
		$ownerid 		= 	$_POST['ownerid'];
		$division_id 	= 	$_POST['editmorediv'];
		$station_id 	= 	$_POST['editmorestation'];
		$processesid 	= 	implode(',',$_POST['processesidedit']);
		$subprocesses 	= 	implode(',',$_POST['subprocessesedit']);

		$checkowner = $this->db->select("*")
						->from("baris_owner")
						->where("owner_id",$ownerid)
						->where("devision_id",$division_id)
						->where("station_id",$station_id)
						->where_in("processes_id",$processesid)
						->where_in("sub_processes_id",$subprocesses)
						->where("owner_id !=",$ownerid)
						->get();
		$datacheck = $checkowner->result();
		if (empty($datacheck))
		{
			$insertarr = array(
								"owner_id"			=>	$ownerid,
								"devision_id"		=>	$division_id,
								"station_id"		=>	$station_id,
								"processes_id"		=>	$processesid,
								"sub_processes_id"	=>	$subprocesses,
								"created_date"		=>	TODAY_DATE		
							);
			$insertqur = $this->db->where("id",$editownerid)->update("baris_owner",$insertarr);
			if ($insertqur)
			{
				redirect(ADMIN_URL.'ownerdetail/'.base64_encode($ownerid));
			}
		}		
		else {
			redirect(ADMIN_URL.'ownerdetail/'.base64_encode($ownerid));
		}
	}
	// end here

	/* =====================================
		End Here
	 ====================================== */	
	  
	 /* =====================================
	 	All Contractor related function start here
	 ======================================= */
	 public function addcontractor()
	 {
	 	if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 			= 	$this->session->userdata();
		$getallprocesses 	= 	$this->UserModel->getallprocesses();
		$getAlldivision  	= 	$this->UserModel->getAlldivision();
		$loginid 			= 	$this->session->userdata('userid');
		$getallownerlist 	= 	$this->UserModel->getallownerlist();
		 //echo '<pre>'; print_r(json_decode($getallownerlist)); die;
		// Insert contractor start here
		
		if (!empty($_POST)){
			//echo'<pre>'; print_r($_POST); die;
			$proid =implode(',',$this->input->post('processesid'));
			$spid = implode(',',$this->input->post('subproid'));
			 $cont_organization 	= 	$this->input->post('cont_organization');
			 $cont_contract_name 	= 	$this->input->post('cont_contract_name');
			 $cont_firstname 		= 	$this->input->post('cont_firstname');
			 $cont_lastname 		= 	$this->input->post('cont_lastname');
			 $cont_username 		= 	$this->input->post('cont_username');
			 $cont_owner 			= 	$this->input->post('cont_owner');
			 $cont_email 			= 	$this->input->post('cont_email');
			 $cont_owner 			= 	$this->input->post('cont_owner');
			 $cont_phone 			= 	$this->input->post('cont_phone');
			 $cont_password 		= 	md5($this->input->post('cont_password'));
			 $processesid 			= 	$proid;
			 $subproid 				= 	$spid;
			 $usertype 	 			=  	CONTRACTOR_UNIQ;
			 $uniqueId	 			=	$this->UserModel->uniqueId($usertype);
		//	echo '<pre>'; print_r($processesid); die;
 			$checkorg = $this->db->select("*")
						->from("baris_organization")
						->where("organization_name",$cont_organization)
						->get();
			$datacheck = $checkorg->result();
			 if(!empty($datacheck)){
			 	$orgid = $datacheck[0]->id;
			 }else{
			 	$inarray = array ("organization_name "=>$cont_organization,"created_date"=>TODAY_DATE);
			 	$insertorg = $this->db->insert("baris_organization",$inarray);
			 	if ($insertorg){
			 		$orgid = $this->db->insert_id();
			 	}
			 }						


			 $datacontractor = $this->UserModel->insertContractor($orgid,$cont_contract_name,$cont_firstname,$cont_lastname,$cont_username,$cont_owner,$processesid,$subproid,$cont_email,$cont_phone,$cont_password,$uniqueId,$loginid);
		//	 echo '<pre>'; print_r($datacontractor); die;
			 if ($datacontractor){
			 	 $msg = json_decode($datacontractor);
				// echo '<pre>'; print_r($msg); die;
				 if ($msg->type == 0){
				 		$this->session->set_flashdata('error',$msg->message);
				 		//echo '<pre>'; print_r($this->session); die;
					 }
				 	else {
							$this->session->set_flashdata('success',$msg->message);
						}
			 }
		}
		// end here
		$data = array
					(
						'usedata' 			=>  $userdata,
						'getallprocesses' 	=>  $getallprocesses,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization ,
						'getAlldivision'	=>	$getAlldivision,
						'getallownerlist'	=>	json_decode($getallownerlist)
					);
		$this->load->view('admin/addcontractor',$data);
	 }

	 // edit contractor start here 
	 public function editcontractor()
	 {
	 	$conid = base64_decode($this->uri->segment(3));
	 	if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 			= 	$this->session->userdata();
		$getallprocesses 	= 	$this->UserModel->getallprocesses();
		$getAlldivision  	= 	$this->UserModel->getAlldivision();
		$loginid 			= 	$this->session->userdata('userid');
		$getallownerlist 	= 	$this->UserModel->getallownerlist();

		$getallcontractordataById =  $this->UserModel->getallcontractordataById($conid);

		$ownerId = json_decode($getallcontractordataById)[0]->owner_baris_id;

		$getOwnerById 	 =  $this->UserModel->getOwnerById($ownerId);
		//echo '<pre>'; print_r(json_decode($getOwnerById));die;
		$ownerprocesse 	 = json_decode($getOwnerById)[0]->processes_id;
		$ownerSubprocess = json_decode($getOwnerById)[0]->sub_processes_id;
		//echo $ownerprocesse ; die;
		$ownerprocessesdata = $this->UserModel->getAllProcessesWithSubProcessesWithIdsec($ownerprocesse,$ownerSubprocess);
		
		 //echo '<pre>'; print_r(json_decode($ownerprocessesdata));die;

		if (!empty($_POST)){
			//echo '<pre>'; print_r($_POST);die;
			$cont_organization 	= 	$this->input->post('cont_organization');
			$cont_contract_name = 	$this->input->post('cont_contract_name');
			$cont_firstname 	= 	$this->input->post('cont_firstname');
			$cont_lastname 		= 	$this->input->post('cont_lastname');
			$cont_username 		= 	$this->input->post('cont_username');
			$cont_owner 		= 	$this->input->post('cont_owner');
			$processesid 		= 	$this->input->post('processesid');
			$subproid 			= 	$this->input->post('subproid');
			$cont_email 		= 	$this->input->post('cont_email');
			$cont_phone 		= 	$this->input->post('cont_phone');
			$old_password 		= 	$this->input->post('old_password');
			$cont_password 		= 	$this->input->post('cont_password');
			$organization_id	=	$this->input->post('organization_id');
			$table_con_id		=	$this->input->post('table_con_id');

			$implodeprocessesid 		= 	implode(',', $this->input->post('processesid'));
			$implodesubproid 			= 	implode(',', $this->input->post('subproid'));

			$checkorg = $this->db->select("*")
						->from("baris_organization")
						->where("organization_name",$cont_organization)
						->get();
			$datacheck = $checkorg->result();
			 if(!empty($datacheck)){
			 	$orgid = $organization_id;
			 }else{
			 	$inarray = array ("organization_name "=>$cont_organization,"created_date"=>TODAY_DATE);
			 	$insertorg = $this->db->insert("baris_organization",$inarray);
			 	if ($insertorg){
			 		$orgid = $this->db->insert_id();
			 	}
			 }	

			if (empty($cont_password)){
				$password = $old_password;
			}else{ $password  = md5($cont_password);}

			$data = $this->UserModel->editcontractor($cont_organization,$cont_contract_name,$cont_firstname,$cont_lastname,$cont_username,$cont_owner,$processesid ,$subproid,$cont_email,$cont_phone,$password,$orgid,$table_con_id,$conid,$implodeprocessesid,$implodesubproid);
			//echo '<pre>'; print_r($data); die;
			if ($data ){
				 $msg = json_decode($data);
				// echo '<pre>'; print_r($msg); die;
				 if ($msg->type == 0){
				 		$this->session->set_flashdata('error',$msg->message);
			 		//echo '<pre>'; print_r($this->session); die;
				 }
			 	else {
						$this->session->set_flashdata('success',$msg->message);
					}
			}

		}
		$data = array
					(
						'usedata' 			=>  $userdata,
						'getallprocesses' 	=>  $getallprocesses,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization ,
						'getAlldivision'	=>	$getAlldivision,
						'getallownerlist'	=>	json_decode($getallownerlist),
						'getallcontractordataById' => json_decode($getallcontractordataById),
						'ownerprocessesdata'	=>	json_decode($ownerprocessesdata),
					);
		$this->load->view('admin/editcontractor',$data);
	 }
	 // end here

	 // get contractor list start here
	public function contractor()
	{ 
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getallownerlist = $this->UserModel->getallownerlist();
		$getallcontractorlist = $this->UserModel->getallcontractorlist();

		// echo '<pre>'; print_r(json_decode($getallcontractorlist)); die;
		$data = array
					(
						'usedata' 			=>  $userdata,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization,
						'getallownerlist'	=>	json_decode($getallownerlist),
						'getallcontractorlist'	=>	json_decode($getallcontractorlist)
					);
		$this->load->view('admin/contractor',$data);
	}
	// end here

	// get contractor detials acc. to the contactor id 
	public function contractordetails()
	{
		$conid = base64_decode($this->uri->segment(3));
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 

		$userdata 						=	$this->session->userdata();
		$getallownerlist 				= 	$this->UserModel->getallownerlist();
		$getallcontractorlist 			= 	$this->UserModel->getallcontractordataById($conid);
		$getlinemanagerByContactorId 	= 	$this->UserModel->getlinemanagerByContactorId($conid);
		$getownerByContractorId			=	$this->UserModel->getownerByContractorId($conid);
	  //echo '<pre>'; print_r(json_decode($getownerByContractorId)); die;
	//$getProcesseAndSubprocesses = $this->UserModel->getAllProcessesWithSubProcessesWithIdWithoutAjax();

		$data = array
					(
						'usedata' 			=>  $userdata,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization,
						'getallownerlist'	=>	json_decode($getallownerlist),
						'getcontractor'		=>	json_decode($getallcontractorlist),
						'getlinemanagerByContactorId'	=>	json_decode($getlinemanagerByContactorId),
						'getownerByContractorId'	=> json_decode($getownerByContractorId)
					);

		$this->load->view('admin/contractordetails',$data);
	}
	//end here

	// Add Another owner to this contractor
	public function addnewownerContractor()
	{
	//	echo '<pre>'; print_r($_POST); die;

		$contractor_id 	= 	$this->input->post('contractor_id');
		$contract_name 	= 	$this->input->post('contract_name');
		$cont_owner 	= 	$this->input->post('cont_owner');
		$processesid 	=	$this->input->post('processesid');
		$subproid 		=	$this->input->post('subproid');
		 $orgination_Id =	$this->input->post('orgination_Id'); 

		$implodeporid = implode(',',$processesid);
		$implodesubproid = implode(',',$subproid);
		//echo '<pre>'; print_r($processesid); die;
		$data = $this->UserModel->addnewownerContractor($contractor_id,$contract_name,$cont_owner,$processesid,$subproid,$implodeporid,$implodesubproid,$orgination_Id);
		 //echo '<pre>'; print_r($data); die;
		if ($data){
			 	 $msg = json_decode($data);
				// echo '<pre>'; print_r($msg); die;
				 if ($msg->type == 0){
				 		$this->session->set_flashdata('error',$msg->message);
				 		redirect(ADMIN_URL.'contractordetails/'.base64_encode($contractor_id));
				 		//echo '<pre>'; print_r($this->session); die;
					 }
				 	else {
							$this->session->set_flashdata('success',$msg->message);
				 			redirect(ADMIN_URL.'contractordetails/'.base64_encode($contractor_id));
						}
			 }
	}
	// end here
	 /* =========
	 	End here
		
	 All Line manager Start here
	 ==========*/
	 public function addlinemanager()
	 {
	 	if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 			= 	$this->session->userdata();
		$getallprocesses 	= 	$this->UserModel->getallprocesses();
		$getAlldivision  	= 	$this->UserModel->getAlldivision();
		$loginid 			= 	$this->session->userdata('userid');
		$getallcontractorlist = $this->UserModel->getallcontractorlist();
		//$con = json_decode($getallcontractorlist);
	//	$owner = $this->UserModel->getownerByContractorId($con[0]->contractor_id);

		 //echo '<pre>'; print_r(json_decode($getallcontractorlist)); die;
		if(!empty($_POST)){
			//echo '<pre>'; print_r($_POST); die;
			$line_contracter 	= 	$this->input->post('line_contracter');
			$processesid 		= 	$this->input->post('processesid');
			$subproid 			=	$this->input->post('subproid');
			$line_firstname 	= 	$this->input->post('line_firstname');
			$line_lastname 		= 	$this->input->post('line_lastname');
			$line_username 		= 	$this->input->post('line_username');
			$line_email 		= 	$this->input->post('line_email');
			$line_phone 		= 	$this->input->post('line_phone');
			$line_shift 		= 	$this->input->post('line_shift');
			$line_password 		= 	md5($this->input->post('line_password'));
			$usertype 	 		=  	MANAGER_UNIQ;
			 $uniqueId	 		=	$this->UserModel->uniqueId($usertype);
			$data = $this->UserModel->insertLinemanager($line_contracter,$processesid,$subproid,$line_firstname,$line_lastname,$line_username,$line_email,$line_phone,$line_shift,$line_password,$uniqueId,$loginid);
			if ($data){
				 $msg = json_decode($data);
				// echo '<pre>'; print_r($msg); die;
				 if ($msg->type == 0){
				 		$this->session->set_flashdata('error',$msg->message);
			 		redirect(ADMIN_URL.'addlinemanager');
			 		//echo '<pre>'; print_r($this->session); die;
				 }
			 	else {
						$this->session->set_flashdata('success',$msg->message);
			 			redirect(ADMIN_URL.'addlinemanager');
					}
			}
		}
		$data = array
					(
						'usedata' 			=>  $userdata,
						'getallprocesses' 	=>  $getallprocesses,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization ,
						'getAlldivision'	=>	$getAlldivision,
						'getallcontractorlist'	=>	json_decode($getallcontractorlist)
					);

		$this->load->view('admin/addlinemanager',$data);
	 }

	 // Get all linemager listing start here
	 public function linemanager()
		{ 
			if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 

			$userdata 						=	$this->session->userdata();
			$getallownerlist 				= 	$this->UserModel->getallownerlist(); 
			$getalllinemanagerlist 			=	$this->UserModel->getalllinemanagerlist();
		  //echo '<pre>'; print_r(json_decode($getalllinemanagerlist)); die;
		//$getProcesseAndSubprocesses = $this->UserModel->getAllProcessesWithSubProcessesWithIdWithoutAjax();

			$data = array
						(
						'usedata' 			=>  $userdata,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization, 
						'getalllinemanagerlist'	=> json_decode($getalllinemanagerlist),
						);

			$this->load->view('admin/linemanager',$data);
		}
	 // end here

	// get linemager details according to the linemanager Id
	public function linemangerdetails()
	{
		$lineid = base64_decode($this->uri->segment(3));
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 

		$userdata 						=	$this->session->userdata();
		$getallownerlist 				= 	$this->UserModel->getallownerlist(); 
		$getlinemangaerById 			=	$this->UserModel->getlinemangaerById($lineid);
	 	 //echo '<pre>'; print_r(json_decode($getlinemangaerById)); die;
	//$getProcesseAndSubprocesses = $this->UserModel->getAllProcessesWithSubProcessesWithIdWithoutAjax();

		$data = array
					(
						'usedata' 			=>  $userdata,
						'getstation' 		=> 	$this->getstation,
						'getprcesses' 		=>	$this->getprcesses,
						'getorganization' 	=> 	$this->getorganization, 
						'userdata'	=> json_decode($getlinemangaerById),
					);

		$this->load->view('admin/linemanagerdetails',$data);
	}
	// end here
	// setprocesses for linemanager start here
	// set Processes For line manager
	public function setprocesses()
	{
		$linemanid 		= 	base64_decode($this->uri->segment(3));
		$processesid 	= 	base64_decode($this->uri->segment(4));

		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 			= 	$this->session->userdata();
		$getlinemangaerById =	$this->UserModel->getlinemangaerById($linemanid);
		
		$linemanagerdata = json_decode($getlinemangaerById);
		$line_processes 	= 	$linemanagerdata[0]->processes_id;
		$line_sub_processes = 	$linemanagerdata[0]->sub_processes_id;

		$getallProcessesforSet = $this->UserModel->getProcessesWithSubprocessesInSetProcesses($line_processes,$line_sub_processes,$processesid);
		
		  ///echo '<pre>'; print_r(json_decode($getallProcessesforSet)); die;
		foreach (json_decode($getallProcessesforSet) as $key=>$val){
	 		$processes_name 	= 	$key;
	 		$subprocessesname 	= 	$val;
	 	}
		 
		if (!empty($_POST)){
			
			$selectprocsses = $_POST['selectprocsses'];
			// check chemical report
			if ($selectprocsses == '6'){
				print_r($_POST['Description_Of_Material']); die;
			}
		}

		$data = array( 
					'userdata' 				=> 	$userdata,
					'getorganization'		=>	$this->getorganization,
					'getprcesses'			=>	$this->getprcesses,
					'getstation'			=>	$this->getstation,  
					'getlinemangaerById'	=>	json_decode($getlinemangaerById),
					'getallProcessesforSet'	=>	json_decode($getallProcessesforSet),
					'processes_name'		=>	$processes_name,
					'subprocessesname'		=>	$subprocessesname,
					'linemanid'				=>	$linemanid,
					'processesid'			=>	$processesid

				);
		$this->load->view('admin/setprocesses',$data);
	}
	// end here
	 /* =========
	 	End here
	 ==========*/

	 /*
		Ajax Extra function start here
	 */
		public function getSubprocessByProcessesId()
		{

		}
		// checkuser name start here
		public function checkusername()
		{
			$username = $_POST['owner_username'];
			$data = $this->UserModel->checkusername($username);
			if (empty($data)){
				echo 'true';
			}else {
				echo 'false';
			}
		}
		// end here
	/*
		Ajax End here
	*/
}
?>