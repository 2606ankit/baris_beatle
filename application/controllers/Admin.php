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
		$data = array('userdata' => $userdata);
		$this->load->view('siteadmin/dashboard',$data);
	}
	// end here

	// add User Start From Here

	public function addowner()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getdevision = $this->AdminModel->getalldevision();
		$loginuserid = $this->session->userdata('userid');
		
		//echo '<pre>'; print_r($getstation); die;
		if (!empty($_POST) && !empty($_POST['owner_username'])){
			$owner_station = $this->input->post('owner_station');
			$checkstation = $this->AdminModel->checkstation($owner_station,$loginuserid);
			if (empty($checkstation))
			{
				$insertdata = array(
								'station_name'	=>	$owner_station,
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
								'username'		=>	$this->input->post('owner_username'),
								'user_password'	=>	md5($this->input->post('owner_password')),
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
			$query = $this->db->insert('baris_user',$insertarry);
			if ($query){
				$this->session->set_flashdata('success', 'New Owner Added Successfully');
			}
		}

		$data = array
				(
					'userdata' 		=> 	$userdata,
					'getdevision'	=>	$getdevision,
					'getstation'	=>	$this->getstation
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
		// echo '<pre>'; print_r($getdata); die;

		//echo '<pre>'; print_r($getstation); die;
		if (!empty($_POST) && !empty($_POST['owner_username'])){
			$owner_station = $this->input->post('owner_station');
			$checkstation = $this->AdminModel->checkstation($owner_station,$loginuserid);
			if (empty($checkstation))
			{
				$insertdata = array(
								'station_name'	=>	$owner_station,
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
				redirect(ADMIN_URL.'owner');
				$this->session->set_flashdata('success', ' Owner Updated Successfully');
			}
		}
		$data = array(
					'userdata'	=>	$userdata,
					'getdata'	=>	$getdata,
					'getdevision'	=> $getdevision,
					'getstation'	=>	$this->getstation
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
					'getstation'	=>	$this->getstation
					);

		$this->load->view('siteadmin/allowner',$data);		
	}
	//

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
		$data = array ('userdata' => $userdata);
		$this->load->view('siteadmin/add_division' , $data);
	}
	// End Here
	// Get alll devision start here
	public function devision()
	{
		if($this->session->userdata('userid') == ''){redirect(ADMIN_URL.'index');} 
		$userdata = $this->session->userdata();
		$getalldevision = $this->AdminModel->getalldevision();
		$data = array('getalldevision' => $getalldevision , 'userdata' => $userdata);
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
			$data = array('getdata'=>$getdata , 'userdata' => $userdata);

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
		$data = array ('userdata' => $userdata);
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
					'getdata'	=>	$getdata
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
					'getdata'	=>	$getdata
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
					'getdata'	=>	$getdata
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
					'getsubpro'	=>	$getsubpro
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


}
