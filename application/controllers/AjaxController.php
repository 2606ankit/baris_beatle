<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxController extends CI_Controller {

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
	   	$this->load->model('AjaxModel');
	   	$this->load->library('pagination');
	   
	   	$this->load->library('email'); 

	   	$this->getprocsses = $this->UserModel->getAllProcessesWithSubProcesses();
	   	// get all station here
	}

	// get all sub procsses by processes id  Start here
	public function getSubprocessByProcessesId()
	{
		$proid = $_POST['proid'];
		$data = $this->AjaxModel->getSubprocessByProcessesId($proid);
		print_r($data);

	}
	// end here
	// checkuser name start here
	public function checkusername()
	{
		$username = $_POST['owner_username'];
		$data = $this->AjaxModel->checkusername($username);
		if (empty($data)){
			echo 'true';
		}else {
			echo 'false';
		}
	}
	// change status start here
	public function changestatus()
	{

		$tablename 	= $_POST['tablename'];
		$statuvalue = $_POST['statuvalue'];
		$statusid 	= $_POST['statusid'];
		//echo '<pre>'; print_r($_POST); die;
		$data = $this->AjaxModel->changestatus($tablename,$statuvalue,$statusid);
		//echo '<pre>'; print_r($data); die;
	 
	}
	// end here
	// Change Stauts for link table start here
	public function changestatuslinktable()
	{
		$tablename 	= 	$_POST['tablename'];
		$statuvalue = 	$_POST['statuvalue'];
		$statusid 	= 	$_POST['statusid'];
		$checkid 	=	$_POST['checkid'];
		/*$divid 		=	$_POST['divid'];
		$staid 		=	$_POST['staid'];*/

		//echo '<pre>'; print_r($_POST); die;
		$data = $this->AjaxModel->changestatuslinktable($tablename,$statuvalue,$statusid,$checkid);
		 echo '<pre>'; print_r($data);  
	}
	// end here

	// get all processes from baris_owner 
	public function getprocessesOfownerfrombarisOwner()
	{
		$ownerdata = explode('|',$_POST['ownerdata']);
		$ownerid 	 = $ownerdata[0];
		$devision_id = $ownerdata[1];
		$station_id  = $ownerdata[2];
		$barisOwnerid = $ownerdata[3];

		$data = $this->AjaxModel->getprocessesOfownerfrombarisOwner($barisOwnerid);
		print_r($data);
	}
	// end here
	// get subprocesses by processes id
	public function getAllProcessesWithSubProcessesWithId()
	{
		$proid 	= $_POST['processid'];
		$subproid = $_POST['subproid'];
		//foreach ($proid as $key=>$proid){
			$data = $this->UserModel->getAllProcessesWithSubProcessesWithId($proid,$subproid);
		//}


		  print_r($data);
	}
	// end here

	// get all processes and subprocesses of contractor by id
	public function getAllprocessesAndSubprocessesOfContractor()
	{
		$line_contracter = explode('|',$_POST['line_contracter']);

		$cont_table_con_id	  	= 	$line_contracter[0];
		$contId  				= 	$line_contracter[1];
		$orgId   				=	$line_contracter[2];
		$ownerId 				= 	$line_contracter[3];

		$data = $this->AjaxModel->getAllprocessesAndSubprocessesOfContractor($cont_table_con_id);
		print_r($data);
	}
	// end here
}
?>