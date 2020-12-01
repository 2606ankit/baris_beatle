<?php 
	
	// Url Set here
	define('SERVER_URL','http://localhost/beatle_baris/');

	define('BASE_URL'	,	SERVER_URL);
	define('ASSETS_URL'	, 	SERVER_URL.'assets/');
	define('ADMIN_URL'	, 	SERVER_URL.'index.php/admin/');

	// table prefix 
	define('TABLE_PREFIX','baris');
	define('TODAY_DATE',date('Y-m-d H:i:s'));

	// All Status
	define('ACTIVE_STATUS'	,'1');
	define('INACTIVE_STATUS','0');
	define('DELETE_STATUS'	,'2');

	// User Type start here
	define('MASTER_ADMIN', '1');
	define('OWNER','2');
	define('CONTRACTOR','3');
	define('LINE_MANAGER','4');
	// end here

?>