<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	   	$this->load->model('AdminModel');
	   	$this->load->library('pagination');
	   	 
	   	$this->load->library('email'); 
	   	// get all station here
	   	$this->getstation = $this->AdminModel->getallstation();
	   	$this->getprcesses = $this->AdminModel->getallprocesses();
	   	$this->getorganization = $this->AdminModel->getallorgnization();
	    
	}

	public function index()
	{
		if(!empty($this->session->userdata('userid'))){redirect(ADMIN_URL.'dashboard');} 
			if (isset($_POST) && !empty($_POST)){
	 			$username = $this->input->post('username');
	 			$userpass = $this->input->post('userpass');

	 			$data = $this->AdminModel->loginadminuser($username,$userpass);
	 			$loginid = $this->session->userdata('userid');
	 			if(!empty($loginid)){
	 				$this->session->set_flashdata('message', 'Welcome to the daashboard');
	 				redirect(ADMIN_URL.'dashboard');
	 			}
	 			 
	 		}
		  
		$this->load->view('siteadmin/login');
	}

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
	// Admin Dashboard start here
	public function dashboard()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$data = array('userdata' => $userdata,'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses);
		$this->load->view('siteadmin/dashboard',$data);
	}
	// end here

	// add User Start From Here

	public function addowner()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 	 = 	$this->session->userdata();
		$getdevision =  $this->AdminModel->getalldevision();
		$loginuserid =  $this->session->userdata('userid');
		$usertype 	 =  OWNER_UNIQ;
		$uniqueId	 =	$this->AdminModel->uniqueId($usertype);

		//echo '<pre>'; print_r($getstation); die;
		if (!empty($_POST) && !empty($_POST['owner_username'])){
			//echo $uniqueId; die;
	 //	 echo '<pre>'; print_r($_POST);
	 //echo  $processes_id = implode('|', $this->input->post('processes')); die;
	 	  
			$owner_station = $this->input->post('owner_station');
			$checkstation = $this->AdminModel->checkstation($owner_station,$loginuserid);
			if (empty($checkstation))
			{
				$insertdata = array(
								'station_name'	=>	$owner_station,
								'devision_id'	=>	$this->input->post('owner_devision'),
								'created_by'	=>	$loginuserid,
								'created_date'	=>	TODAY_DATE
								);
				$query = $this->db->insert('baris_station',$insertdata);
					$lastid = $this->db->insert_id();
				
			}
			else{$lastid = $checkstation; }
		//	echo '<pre>'; print_r($checkstation); die;
			  

			$insertarry	=	array
							(
								'user_unique_id'=>	$uniqueId,
								'username'		=>	$this->input->post('owner_username'),
								'user_password'	=>	md5($this->input->post('owner_password')),
								'first_name '	=>	$this->input->post('owner_firstname'),
								'last_name'		=>	$this->input->post('owner_lastname'),
								'user_email'	=>	$this->input->post('owner_email'),
								'user_phone'	=>	$this->input->post('owner_phone'),
								
								'user_type'		=>	OWNER,
								'created_by'	=>	$loginuserid,
								'created_date'	=>	TODAY_DATE
							);
			$query = $this->db->insert('baris_user',$insertarry);
			if ($query){
				$lastuserid = $this->db->insert_id();
				$processes_id = implode('|', $this->input->post('processes'));

				$insertprocesses = array(
									'processes_id'	=>	$processes_id,
									'user_id'		=>	$lastuserid,
									'created_date'	=>	TODAY_DATE,
									);
				$queryprocesses = $this->db->insert('baris_user_processes',$insertprocesses);

				// Insert data to baris_owner
				$insertowner = array(
									'owner_id'	=>	$lastuserid,
									'devision_id'	=>	$this->input->post('owner_devision'),
									'station_id'	=>	$lastid,
									'created_date'	=>	TODAY_DATE
								);
				$ownerquery = $this->db->insert("baris_owner",$insertowner);
				

				$this->session->set_flashdata('success', 'New Owner Added Successfully');
			}
		}

		$data = array
				(
					'userdata' 		=> 	$userdata,
					'getdevision'	=>	$getdevision,
					'getstation'	=>	$this->getstation,
					'getprocsses'	=>	$this->getprcesses,
					'getorganization'=>	$this->getorganization,
				);
		$this->load->view('siteadmin/addowner',$data);
	}
	// end here
	// Edit Owner details start here
	public function editowner()
	{
		$ownerid = base64_decode($this->uri->segment(3));

		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getdevision = $this->AdminModel->getalldevision();
		$loginuserid = $this->session->userdata('userid');
		$getdata = $this->AdminModel->getownerById($ownerid);
		  //echo '<pre>'; print_r($getdata); 
		 $userprocesses_id = explode('|',$getdata[0]->processes_id);


		//echo '<pre>'; print_r($getstation); die;
		if (!empty($_POST) && !empty($_POST['owner_username'])){
			$owner_station = $this->input->post('owner_station');
			$checkstation = $this->AdminModel->checkstation($owner_station,$loginuserid);
			if (empty($checkstation))
			{
				$insertdata = array(
								'station_name'	=>	$owner_station,
								'devision_id'	=>	$this->input->post('owner_devision'),
								'created_by'	=>	$loginuserid,
								'created_date'	=>	TODAY_DATE
								);
				$query = $this->db->insert('baris_station',$insertdata);
					$lastid = $this->db->insert_id();
				
			}
			else{$lastid = $checkstation; }

			if (!empty($this->input->post('owner_password'))){ $password = md5($this->input->post('owner_password'));}else {$password = $this->input->post('prepassword');}
		//	echo '<pre>'; print_r($checkstation); die;
			$insertarry	=	array
							(
								'username'		=>	$this->input->post('owner_username'),
								'user_password'	=>	$password,
								'first_name '	=>	$this->input->post('owner_firstname'),
								'last_name'		=>	$this->input->post('owner_lastname'),
								'user_email'	=>	$this->input->post('owner_email'),
								'user_phone'	=>	$this->input->post('owner_phone'),
								'user_devision'	=>	$this->input->post('owner_devision'),
								'user_station'	=>	$lastid,
								'user_type'		=>	OWNER,
								'created_by'	=>	$loginuserid,
								'created_date'	=>	TODAY_DATE
							);
			$query = $this->db->where("id",$ownerid)->update('baris_user',$insertarry);
			if ($query){
				 
				$selectuser = $this->db->select("*")->from("baris_user_processes")->where("user_id",$ownerid)->get();
				$resultuser = $selectuser->result();
				if (empty($resultuser)){
				$processes_id = implode('|', $this->input->post('processes'));
				$insertprocesses = array(
									'processes_id'	=>	$processes_id,
									'user_id'		=>	$ownerid,
									'created_date'	=>	TODAY_DATE,
									);
				$queryprocesses = $this->db->insert('baris_user_processes',$insertprocesses);
			}else {
				$deleteuser = $this->db->where("user_id",$ownerid)->delete("baris_user_processes");

				$processes_id = implode('|', $this->input->post('processes'));
				$insertprocesses = array(
									'processes_id'	=>	$processes_id,
									'user_id'		=>	$ownerid,
									'created_date'	=>	TODAY_DATE,
									);
				$queryprocesses = $this->db->insert('baris_user_processes',$insertprocesses);
			}
				redirect(ADMIN_URL.'owner');
				$this->session->set_flashdata('success', ' Owner Updated Successfully');
			}
		}
		$data = array(
					'userdata'			=>	$userdata,
					'getdata'			=>	$getdata,
					'getdevision'		=> 	$getdevision,
					'getstation'		=>	$this->getstation,
					'getprocsses'		=>	$this->getprcesses,
					'userprocesses_id'	=>	$userprocesses_id,
					'getorganization'	=> 	$this->getorganization
				);
		$this->load->view('siteadmin/editowner',$data);
	}
	// end here
	// all qoner detail start here
	public function owner()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getallowner = $this->AdminModel->getallowner();
		//echo '<pre>'; print_r(json_decode($getallowner)); die;
		$data = array(
					'userdata' 		=> $userdata,
					'getallowner'	=> json_decode($getallowner),
					'getstation'	=>	$this->getstation,
					'getorganization'=>$this->getorganization
					);

		$this->load->view('siteadmin/allowner',$data);		
	}
	//
	// show owner detail
	public function showowner()
	{
		$ownerid = base64_decode($this->uri->segment(3));

		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 		= 	$this->session->userdata();
		$getallstation 	= 	$this->AdminModel->getallstation();
		$loginuserid 	= 	$this->session->userdata('userid');
	 	$getuserById	=	$this->AdminModel->getownerById($ownerid);
	 	$getcontractor  = 	$this->AdminModel->getContractorByOwnerId($ownerid);
	   //echo '<pre>'; print_r($getcontractor); die;
		$data = array
				(
					'userdata' 			=> 	$userdata, 
					'getstation'		=>	$this->getstation,
					'getprocsses'		=>	$this->getprcesses,
					'getorganization'	=>	$this->getorganization, 
					'getuserById'		=>	json_decode($getuserById),
					'getcontractor'		=>	$getcontractor
				);
				//echo '<pre>'; print_r(json_decode($getallcontractor)); die;
		$this->load->view('siteadmin/showowner',$data);	
	}
	// end here
	// get all contractor list start here
	public function contractor()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 		= 	$this->session->userdata();
		$getallstation 	= 	$this->AdminModel->getallstation();
		$loginuserid 	= 	$this->session->userdata('userid');
		$getallcontractor = $this->AdminModel->getallcontractor();
		//echo '<pre>'; print_r(json_decode($getallcontractor)); die;

		$data = array
				(
					'userdata' 			=> 	$userdata, 
					'getstation'		=>	$this->getstation,
					'getprocsses'		=>	$this->getprcesses,
					'getorganization'	=>	$this->getorganization,
					'getallcontractor'	=>	array_unique(json_decode($getallcontractor),SORT_REGULAR)
				);
				//echo '<pre>'; print_r(json_decode($getallcontractor)); die;
		$this->load->view('siteadmin/allcontractor',$data);
	}
	// end here
	// Add Contractor detail start here
	public function addcontractor()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 		= 	$this->session->userdata();
		$getallstation 	= 	$this->AdminModel->getallstation();
		$loginuserid 	= 	$this->session->userdata('userid');
		$getowner 		=	$this->AdminModel->getallowner();
		$usertype 		=	CONTRACTOR_UNIQ;
 		$uniqueId	=	$this->AdminModel->uniqueId($usertype);
		//echo '<pre>'; print_r(json_decode($getowner)); die;
		if (!empty($_POST) && !empty($_POST['cont_organization'])){
			// echo '<pre>'; print_r($_POST); die;
			$orgname = $this->input->post('cont_organization');
			$checkorg = $this->AdminModel->checkorgnization($orgname);
			if (!empty($checkorg)){
				$orgid = $checkorg[0]->id;
			}
			else {
				$orginsertarr = array(
									'organization_name'	=>	$this->input->post('cont_organization'),
									'created_by'		=>	$loginuserid,
									'created_date'		=>	TODAY_DATE
								);
				$insertorg = $this->db->insert("baris_organization",$orginsertarr);
				$orgid = $this->db->insert_id();
			}
			$ownerdetail = $this->input->post('cont_owner');	
			$useremail 	 = $this->input->post('cont_email');
			$firstname 	 = $this->input->post('cont_firstname');
			$lastname 	 = $this->input->post('cont_lastname');
			$username 	 = $this->input->post('cont_username');
			$phone 	 	 = $this->input->post('cont_phone');
			$passwrod 	 = $this->input->post('cont_password');
			$processesId = $this->input->post('processes');
			 
			$proidcheck  = implode(",",$processesId);
			 
			$checkcontractor = $this->AdminModel
								->checkcontratorInfo(
									$ownerdetail,
									$useremail,
									$proidcheck,
									$firstname,
									$lastname,
									$username,$phone,$passwrod,$loginuserid,$orgid,$uniqueId
								);
			if($checkcontractor == true){
				redirect(ADMIN_URL.'contractor');
				$this->session->set_flashdata('success', 'New Contractor Added Successfully');
			}

		}
		$data = array(
				'userdata'		=>	$userdata,
				'getallstation'	=>	$getallstation,
				'getowner'		=>	json_decode($getowner),
				'getstation'	=>	$this->getstation,
				'getorganization'=>$this->getorganization
				);
		$this->load->view('siteadmin/addcontractor',$data);
	}
	// end here

	// edit contractor inforation start here
	public function editcontractor()
	{
		$conid = base64_decode($this->uri->segment(3));
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 		= 	$this->session->userdata(); 
		$loginuserid 	= 	$this->session->userdata('userid');
		$getowner 		=	$this->AdminModel->getallowner();
		$getcontractor  =	$this->AdminModel->getcontractorById($conid);
		//echo '<pre>'; print_r(json_decode($getcontractor)); die;

		if (!empty($_POST) && !empty($_POST['cont_firstname'])){
			$cont_firstname = 	$this->input->post('cont_firstname');
			$cont_lastname	=	$this->input->post('cont_lastname');
			$cont_username	=	$this->input->post('cont_username');
			$cont_email		=	$this->input->post('cont_email');
			$cont_phone		=	$this->input->post('cont_phone');
			if (!empty($_POST['cont_password'])){
				$pass = md5($_POST['cont_password']);
			}else { $pass = $_POST['prepass'];}

			$update = array (

						'first_name'	=>	$cont_firstname,
						'last_name'		=>	$cont_lastname,
						'user_email'	=>	$cont_email,
						'user_phone'	=>	$cont_phone,
						'user_password'	=>	$pass
						);
			$updatepass = $this->db->where("id",$conid)->update('baris_user',$update);
			if ($updatepass){
				redirect(ADMIN_URL.'contractor');
				$this->session->set_flashdata('success', 'Contractor Updated Successfully');
			}
		}

		$data = array(
					'userdata'			=>	$userdata,
					  
					'getowner'			=>	json_decode($getowner),
					'getstation'		=>	$this->getstation,
					'getorganization'	=>	$this->getorganization,
					'getcontractor'		=>	json_decode($getcontractor)
				);

		$this->load->view('siteadmin/editcontractor',$data);
	}
	// end here
	// Show Contractor details start here
	public function showcontractor()
	{
		$conid = base64_decode($this->uri->segment(3));
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 		= 	$this->session->userdata(); 
		$loginuserid 	= 	$this->session->userdata('userid');
		$getowner 		=	$this->AdminModel->getallowner();
		$getcontractor  =	$this->AdminModel->getcontractorById($conid);

		$getlinemanager = $this->AdminModel->getLineManagerByConId($conid);
		$getownerbyCon = $this->AdminModel->getOwnerAccToCon($conid);

		//$getconowner = $this->AdminModel->getcontractorById($conid);
			 //  echo '<pre>'; print_r($getlinemanager); die;
		$data = array(
					'userdata'			=>	$userdata,
					'getowner'			=>	json_decode($getowner),
					'getstation'		=>	$this->getstation,
					'getorganization'	=>	$this->getorganization,
					'getcontractor'		=>	json_decode($getcontractor),
					'linemanagecount'	=>	$getlinemanager,
					'getownerbyCon'		=>	$getownerbyCon,
				);

		$this->load->view('siteadmin/showcontractor',$data);
	}
	// end here
	// add New Processes To Contractor at show detail page Start here
		public function addnewprocessesContractor()
		{
			$cont_owner_add = 	$this->input->post('cont_owner_add');
			$processes 		= 	$this->input->post('processes');
			$condetail 		= 	explode('|',$cont_owner_add);
			$ownerid 		= 	$condetail[0];
			$divid  		= 	$condetail[1];
			$stationid 		= 	$condetail[2];
			$contrctorid 	= 	$condetail[3];
			$conorg 		= 	$condetail[4]; 
			$processid 		=	implode(',',$processes);

			$checkcontdetails = $this->db->select("*")
								->from("baris_contractor")
								->where("contractor_id",$contrctorid)
								->where("owner_id",$ownerid)
								->where("organization_id",$conorg)
								->where("devision_id",$divid)
								->where("station_id",$stationid)
								//->where_in("processes_id",$cont_owner_add)
								->get();
			$checkquery = 	$checkcontdetails->result();
			if (empty($checkquery))
			{
				$insertdata = array(
									'contractor_id'		=>	$contrctorid,
									'owner_id'			=>	$ownerid,
									'organization_id'	=>	$conorg,
									'devision_id'		=>	$divid,
									'station_id'		=>	$stationid,
									'processes_id'		=>	$processid,
									'created_date'		=>	TODAY_DATE
								);
			//	echo '<pre>'; print_r($insertdata); die;
				$insertquery = $this->db->insert("baris_contractor",$insertdata);
				if ($insertquery){
					redirect(ADMIN_URL.'showcontractor/'.base64_encode($contrctorid));
				}
			}		
			else {
				$update = array(
									'contractor_id'		=>	$contrctorid,
									'owner_id'			=>	$ownerid,
									'organization_id'	=>	$conorg,
									'devision_id'		=>	$divid,
									'station_id'		=>	$stationid, 
								);
				$udpateval = array('processes_id'		=>	$processid,'updated_date'=>TODAY_DATE);
				$updatequery = $this->db->where($update)->update("baris_contractor",$udpateval);
				if ($updatequery){
					redirect(ADMIN_URL.'showcontractor/'.base64_encode($contrctorid));
				}
			}					
		}
	// end here 
	// Add Line Manage Start here`
	public function addlinemanager()
	{

		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 		= 	$this->session->userdata(); 
		$loginuserid 	= 	$this->session->userdata('userid');
		$getowner 		=	$this->AdminModel->getallowner(); 
		$getcontractorWithOrg = $this->AdminModel->getcontractorWithOrg();
		$usertype 		=	MANAGER_UNIQ;
 		$uniqueId	=	$this->AdminModel->uniqueId($usertype);
		 
		//  echo '<pre>'; print_r(json_decode($getcontractorWithOrg)); die;

		if (!empty($_POST) && !empty($_POST['line_firstname'])){
			// echo '<pre>'; print_r($_POST); die;
			$intarray = array(
							'user_unique_id'	=>	$uniqueId,
							'username'			=>	$this->input->post('line_username'),
							'first_name'		=>	$this->input->post('line_firstname'),
							'last_name'			=>	$this->input->post('line_lastname'),
							'user_email'		=>	$this->input->post('line_email'),
							'user_phone'		=>	$this->input->post('line_phone'),
							'user_password'		=>	$this->input->post('line_password'),
							'user_type'			=>	LINE_MANAGER,
							'created_by'		=>	$loginuserid,
							'created_date'		=>	TODAY_DATE
						);
			$insertquery = $this->db->insert("baris_user",$intarray);
			$lastid = $this->db->insert_id();
			if ($insertquery){
				$odata = explode('|',$_POST['line_contracter']);
				$conid = $odata[0];
				$orgid = $odata[1];
				$ownerid = $odata[2];

				$processesId = implode(',',$_POST['processes']); 
				$subprocessesId = implode(',',$_POST['subprocesses']); 
				$inserlinedata = array(
									'manager_id'		=>	$lastid,
									'contractor_id'		=>	$conid,
									'organization_id'	=>	$orgid,
									'owner_id'			=>	$ownerid,
									'created_by'		=>	$loginuserid,
									'processes_id'		=>	$processesId,
									'sub_processes_id'	=>	$subprocessesId,
									'created_date'		=>	TODAY_DATE
								);
				$query = $this->db->insert("baris_linemanager",$inserlinedata);
				if ($query)
				{
					$this->session->set_flashdata("success","Line Manager Added Successfully");
				}
			}

		}
		$data = array(
					'userdata'			=>	$userdata,
					'getowner'			=>	json_decode($getowner),
					'getstation'		=>	$this->getstation,
					'getorganization'	=>	$this->getorganization, 
					'getcontractor'		=>	json_decode($getcontractorWithOrg),
					//'getcontractor'		=>	array_unique(json_decode($getcontractorWithOrg),SORT_REGULAR)
				);
		$this->load->view('siteadmin/addlinemanager',$data);
	}
	// end here
	// show all line manager start here
	public function linemanager()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getalldevision = $this->AdminModel->getalldevision();
		$getalllinemager = $this->AdminModel->getalllinemager();
		$data = array(
					'getalldevision' 	=> 	$getalldevision , 
					'userdata' 			=> 	$userdata,
					'getorganization'	=>	$this->getorganization,
					'getprcesses'		=>	$this->getprcesses,
					'getstation'		=>	$this->getstation,
					'getalllinemager'	=>	json_decode($getalllinemager)
				);
		$this->load->view('siteadmin/alllinemanager',$data);
	}
	// end here
	// show all detail for line manager
	public function showlinemanager()
	{
		$linemanid = base64_decode($this->uri->segment(3));

		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 			= 	$this->session->userdata();
		$getalldevision 	= 	$this->AdminModel->getalldevision();
		$getalllinemager 	= 	$this->AdminModel->getlinemanagerWithId($linemanid);
		$processes_id 		= 	explode(',',$getalllinemager[0]->processes_id);
		$getallprocess 		=	$this->AdminModel->getSubproByPro($processes_id);
		//echo '<pre>'; print_r($getalllinemager); die;
		$data = array( 
					'userdata' 			=> 	$userdata,
					'getorganization'	=>	$this->getorganization,
					'getprcesses'		=>	$this->getprcesses,
					'getstation'		=>	$this->getstation, 
					'getallprocess'		=>	$getallprocess,
					'getalllinemager'	=>	$getalllinemager
				);
		$this->load->view('siteadmin/showlinemanager',$data);
	}
	// end here
	// set Processes For line manager
	public function setprocesses()
	{
		$linemanid 		= 	base64_decode($this->uri->segment(3));
		$processesid 	= 	base64_decode($this->uri->segment(4));

		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata 			= 	$this->session->userdata();
		$getalldevision 	= 	$this->AdminModel->getalldevision();
		$getalllinemager 	= 	$this->AdminModel->getlinemanagerWithId($linemanid);
		$processes_id 		= 	explode(',',$getalllinemager[0]->processes_id);
		$getallprocess 		=	$this->AdminModel->getSubproByPro($processesid);
		//echo '<pre>'; print_r($getallprocess); die;
		foreach ($getallprocess as $k=>$v){
				$pdata = explode("|",$k);
					$processesname = $pdata[1]; 
					$processesfullname = $pdata[2]; 
			}
		$userproceeses = explode(",",$getalllinemager[0]->sub_processes_id);

		$data = array( 
					'userdata' 			=> 	$userdata,
					'getorganization'	=>	$this->getorganization,
					'getprcesses'		=>	$this->getprcesses,
					'getstation'		=>	$this->getstation, 
					'getallprocess'		=>	$getallprocess,
					'getalllinemager'	=>	$getalllinemager,
					'userproceeses'		=>	$userproceeses,
					'processesname'		=>	$processesname,
					'processesfullname'	=>	$processesfullname
				);
		$this->load->view('siteadmin/setprocesses',$data);
	}
	// end here
	// Add Devision Start Here
	public function adddevision()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		if (!empty($_POST) && !empty($_POST['devision_name']))
		{
			$devision_name 	= 	$this->input->post('devision_name');
			$date		   	=	date('Y-m-d H:i:s');
			$createdby		=	'1';
			$insertdata		=	array(
									'devision_name'	=>	$devision_name,
									'created_by'	=>	$createdby,
									'created_date'	=>	$date
								);
			$data = $this->db->insert('baris_devision',$insertdata);
			if($data){
				$this->session->set_flashdata('success', 'New Devision Added Successfully');
			}	
		}
		$data = array ('userdata' => $userdata,'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses,'getstation'	=>		$this->getstation);
		$this->load->view('siteadmin/add_division' , $data);
	}
	// End Here
	// Get alll devision start here
	public function devision()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getalldevision = $this->AdminModel->getalldevision();
		$data = array('getalldevision' => $getalldevision , 
					'userdata' => $userdata,
					'getorganization'=>$this->getorganization,
					'getprcesses'=>$this->getprcesses,
					'getstation'	=>		$this->getstation
				);
		$this->load->view('siteadmin/alldevision',$data);
	}
	// end here

	// Edit devision start here
	public function editdevision()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$divid 		= 	base64_decode($this->uri->segment(3));
		$getdata 	= 	$this->AdminModel->getdevisionbyid($divid);
		if (!empty($getdata)){
			if (!empty($_POST) && !empty($_POST['devision_name'])){
				$devision_name 	= 	$this->input->post('devision_name');
				$date 			=	date('Y-m-d H:i:s');
				$updatedata 	=	array (
										'devision_name'	=>	$devision_name,
										'updated_date'	=>	$date,
										);
				$data = $this->db->where("id",$divid)->update("baris_devision",$updatedata);
				//echo $this->db->last_query(); die;
				if ($data)	{
					redirect(ADMIN_URL.'devision');
					$this->session->set_flashdata('success', 'Devision Name Updated Successfully');
				}
			}
			$data = array('getdata'=>$getdata , 'userdata' => $userdata , 'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses);

			$this->load->view('siteadmin/editdevision',$data);
		}else {
			$this->load->view('siteadmin/error');
		}
	}
	// end here
	// check devision 
	public function checkdevision()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$checkvalue = $_POST['devision_name'];
		$data = $this->AdminModel->checkdevision($checkvalue);
		if (empty($data)){
			echo 'true';
		}else {
			echo  "Alreay in database please choose another Devision Name";
		}
		//print_r($data);
	}
	// end here
	// check processes 
	public function checkprocesses()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$checkvalue = $_POST['processes_name'];
		$data = $this->AdminModel->checkprocesses($checkvalue);
		if (empty($data)){
			echo 'true';
		}else {
			echo  "Alreay in database please choose another Processes Name";
		}
	}
	// end here

	// Add Processes Start Here
	public function addprocesses()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		if (!empty($_POST) && !empty($_POST['processes_name']))
		{
			$processes_name 		= 	$this->input->post('processes_name');
			$processes_full_name 	= 	$this->input->post('processes_full_name');
			$date		   	=	date('Y-m-d H:i:s');
			$createdby		=	'1';
			$insertdata		=	array(
									'processes_name'		=>	$processes_name,
									'processes_full_name'	=>	$processes_full_name,
									'created_by'			=>	$createdby,
									'created_date'			=>	$date
								);
			$data = $this->db->insert('baris_processes',$insertdata);

			if($data){
				$this->session->set_flashdata('success', 'New Devision Added Successfully');
			}	
		}
		$data = array ('userdata' => $userdata,'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses);
		$this->load->view('siteadmin/addprocesses',$data);
	}
	// End here
	public function processes()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();

		$getdata = $this->AdminModel->getallprocesses();
		$data = array
				(
					'userdata'	=>	$userdata,
					'getdata'	=>	$getdata,
					'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses
				);
		$this->load->view('siteadmin/allprocesses',$data);
	}
	// edit process inforation acc id
	public function editprocesses()
	{
		$proid = base64_decode($this->uri->segment(3));

		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$loginuserid = $this->session->userdata('userid');
		$getdata = $this->AdminModel->getprocessesAccId($proid);
		if (!empty($getdata)){
			if (!empty($_POST) && !empty($_POST['processes_name']))
				{

					$processes_name 		= 	$this->input->post('processes_name');
					$processes_full_name 	= 	$this->input->post('processes_full_name');
					$date		   	=	date('Y-m-d H:i:s');
					 
					$insertdata		=	array(
											'processes_name'		=>	$processes_name,
											'processes_full_name'	=>	$processes_full_name,
											'created_by'			=>	$loginuserid,
											'updated_date'			=>	$date
										);
					$data = $this->db->where('id',$proid)->update('baris_processes',$insertdata);

					if($data){
						redirect(ADMIN_URL.'processes');
						$this->session->set_flashdata('success', 'New Devision Added Successfully');
					}	
			}

			$data = array
				(
					'userdata'	=>	$userdata,
					'getdata'	=>	$getdata,
					'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses
				);
			
			$this->load->view('siteadmin/editprocesses',$data);
		}
		else {
				$this->load->view('siteadmin/error');
			}
	}
	// end here

	// Add Sub processes Start Here
	public function addsubprocesses()
	{
		$proid = base64_decode($this->uri->segment(3));
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$loginuserid = $this->session->userdata('userid');
		$getdata = $this->AdminModel->getprocessesAccId($proid);

		if (!empty($getdata)){
			if (!empty($_POST)){
				//$processes_namearr = count($_POST['processes_name']);
				foreach ($_POST['processes_name'] as $key=>$val){
					$insertarry[] = array(
									'sub_processes_name'	=>	$val,
									'processes_id'			=>	$getdata[0]->id,
									'created_by'			=>	$loginuserid,
									'created_date'			=>	TODAY_DATE,
								  );
					
				}
				$query = $this->db->insert_batch('baris_subprocesses',$insertarry);
					if ($query){
						redirect(ADMIN_URL.'processes');
						$this->session->set_flashdata('success', 'Sub Processes Addes Successfully');
					}
			}
			$data = array
				(
					'userdata'	=>	$userdata,
					'getdata'	=>	$getdata,
					'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses
				);
			$this->load->view('siteadmin/addsubprocesses',$data);
		}
		else{
			$this->load->view('siteadmin/error');
		}

	}
	// End Here
	// edit sub processes start here
	public function editsubprocesses()
	{
		$proid = base64_decode($this->uri->segment(3));
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$loginuserid = $this->session->userdata('userid');
		$getdata = $this->AdminModel->getprocessesAccId($proid);
		$getsubpro = $this->AdminModel->getallsubprocessAccProId($proid);
		if (!empty($getdata)){
			 if (!empty($_POST)){
			 	//echo '<pre>'; print_r($_POST); die;
			 	if (!empty($_POST['presubpro'])){
			 		$presubpro = $_POST['presubpro'];
			 	}else { $presubpro = array(); }
			 	if (!empty($_POST['processes_name'])){
			 		$processes_name = $_POST['processes_name'];
			 	}else {$processes_name = array();}
			 	$finalarray = array_merge($presubpro,$processes_name);
			 	 // Delete all data by Processes Id from table
			 	 $deletedata = $this->db->where("processes_id",$proid)->delete("baris_subprocesses");

			 	 // insertdata start from here

			 	 foreach ($finalarray as $k=>$v){
			 		 $insertdata[]  = array(
										'sub_processes_name'	=>	$v,
										'processes_id'			=>	$proid,
										'created_by'			=>	$loginuserid,
										'created_date'			=>	TODAY_DATE,
							 		);
			 		 	
			 		}
			 	$query = $this->db->insert_batch('baris_subprocesses',$insertdata);
		 		 	//echo $this->db->last_query();
					if ($query){
					 	redirect(ADMIN_URL.'processes');
						$this->session->set_flashdata('success', 'Sub Processes Addes Successfully');
					}
			 }
			$data = array
				(
					'userdata'	=>	$userdata,
					'getdata'	=>	$getdata,
					'getsubpro'	=>	$getsubpro,
					'getorganization'=>$this->getorganization,'getprcesses'=>$this->getprcesses
				);
			$this->load->view('siteadmin/editsubprocesses',$data);
		}
		else{
			$this->load->view('siteadmin/error');
		}
	}
	// end here
	// Show All Sub Processes Start Here And Add Coloum here
	public function subprocesses()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$loginuserid = $this->session->userdata('userid');
		$data = array
				(
					'userdata'	=>	$userdata,
					'getorganization'=>$this->getorganization,
					'getprcesses'=>$this->getprcesses
					 
				);
		$this->load->view('siteadmin/subprocesses',$data);
	}
	// End here

	// User Permission Start here
	public function userpermission()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$loginuserid = $this->session->userdata('userid');
		$data = array
				(
					'userdata'	=>	$userdata,
					 
				);

		$this->load->view('siteadmin/permission');
	}
	// End Here
	// get all sub processes according to the processes
	public function getallsubprocessAccProId()
	{
		$proid = $_POST['proid'];
		$data = $this->AdminModel->getallsubprocessAccProId($proid);
		return print_r($data);	
	}
	//end here

	// Change Stauts start here
	public function changestatus()
	{
		$tablename 	= $_POST['tablename'];
		$statuvalue = $_POST['statuvalue'];
		$statusid 	= $_POST['statusid'];
		//echo '<pre>'; print_r($_POST); die;
		$data = $this->AdminModel->changestatus($tablename,$statuvalue,$statusid);
		//echo '<pre>'; print_r($data); die;
	}
	// end here

	// checkuser name start here
	public function checkusername()
	{
		$username = $_POST['owner_username'];
		$data = $this->AdminModel->checkusername($username);
		if (empty($data)){
			echo 'true';
		}else {
			echo 'false';
		}
	}
	// end here
	// check username when edit information start here
	public function checkeditusername()
	{
		$username = $_POST['owner_username'];
		$ownerid = $_POST['owner_id'];
		$data = $this->AdminModel->checkeditusername($username,$ownerid);
		echo '<pre>'; print_r($data); die;
		if (empty($data)){
			echo 'true';
		}else {
			echo 'false';
		}
	}
	// end here
	// check user email if already in database
	public function chackuseremail()
	{
		$useremail = $_POST['owner_email'];
		$data = $this->AdminModel->chackuseremail($useremail);
		if (empty($data)){
			echo 'true';
		}else {
			echo 'false';
		}
	}
	// end here
	// Get all selected processes by owner 
	public function getallprocessAccToOwner()
	{
		$ownerId = $_POST['ownerId'];
		$data = $this->AdminModel->getallprocessAccToOwner($ownerId);
		print_r(json_encode($data));
	}
	// end here
	// Get all selected processes by owner 
	public function getallprocessAccToOwnerCon()
	{
		$ownerId = $_POST['ownerId'];
	//	echo $ownerId; die;

		$data = $this->AdminModel->getallprocessAccToOwnerCon($ownerId);
		//print_r($data); 
		print_r(json_encode($data));
	}
	// end here
	// get all processes by contractor 
		public function getallprocessAccToCnontractor()
		{
			$conid = $_POST['conID'];
			$data = $this->AdminModel->getallprocessAccToCnontractor($conid);
		}
	// end here


}
