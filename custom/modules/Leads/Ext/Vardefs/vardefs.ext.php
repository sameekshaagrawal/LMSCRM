<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2021-08-04 08:54:16
$dictionary['Lead']['fields']['lead_stage'] = array(
	'name'		=> 'lead_stage',
	'vname'		=> 'LBL_LEAD_STAGE',
	'size' 		=> 15,
	'type' 		=> 'enum',
	'options'	=> 'lead_stage_dom',
	'comment'	=> 'This field store the current stage of lead (accepted or rejected by sales represtative)',
);

$dictionary['Lead']['fields']['lead_rejection_remark'] = array(
	'name'		=> 'lead_rejection_remark',
	'vname'		=> 'LBL_REJECTION_REMARK',
	'type' 		=> 'text',
	'comment'	=> 'This field store rejection mark given by sales represtative',
);

$dictionary['Lead']['fields']['last_activity'] = array(
	'name'		=> 'last_activity',
	'vname'		=> 'LBL_LAST_ACTIVITY',
	'type' 		=> 'varchar',
	'size'		=> 100,
	'comment'	=> 'This field store last activity of lead',
);

 

 // created: 2021-08-04 11:33:15
$dictionary['Lead']['fields']['jjwg_maps_address_c']['inline_edit']=1;

 

 // created: 2021-08-04 11:33:15
$dictionary['Lead']['fields']['jjwg_maps_geocode_status_c']['inline_edit']=1;

 

 // created: 2021-08-04 11:33:15
$dictionary['Lead']['fields']['jjwg_maps_lat_c']['inline_edit']=1;

 

 // created: 2021-08-04 11:33:15
$dictionary['Lead']['fields']['jjwg_maps_lng_c']['inline_edit']=1;

 
?>