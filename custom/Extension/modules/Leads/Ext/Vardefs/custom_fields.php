<?php
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

$dictionary['Lead']['fields']['industry'] = array(
	'name'		=> 'industry',
	'vname'		=> 'LBL_INDUSTRY',
	'type' 		=> 'varchar',
	'size'		=> 100,
	'comment'	=> 'This field store industry of lead',
);

$dictionary['Lead']['fields']['job_function'] = array(
	'name'		=> 'job_function',
	'vname'		=> 'LBL_JOB_FUNCTION',
	'type' 		=> 'varchar',
	'size'		=> 100,	
);

$dictionary['Lead']['fields']['skype_id'] = array(
	'name'		=> 'skype_id',
	'vname'		=> 'LBL_SKYPE_ID',
	'type' 		=> 'varchar',
	'size'		=> 50,	
);

$dictionary['Lead']['fields']['project_type'] = array(
	'name'		=> 'project_type',
	'vname'		=> 'LBL_PROJECT_TYPE',
	'type' 		=> 'enum',
	'size'		=> 100,	
	'options'	=> 'project_type_dom',
);

$dictionary['Lead']['fields']['budget'] = array(
	'name'		=> 'budget',
	'vname'		=> 'LBL_BUDGET',
	'type' 		=> 'enum',
	'size'		=> 100,	
	'options'	=> 'budget_range_dom',
);

$dictionary['Lead']['fields']['starting_time'] = array(
	'name'		=> 'starting_time',
	'vname'		=> 'LBL_STARTING_TIME',
	'type' 		=> 'enum',
	'size'		=> 100,	
	'options'	=> 'starting_time_dom',
);

$dictionary['Lead']['fields']['project_desc'] = array(
	'name'		=> 'project_desc',
	'vname'		=> 'LBL_PROJECT_DESC',
	'type' 		=> 'text',
);

$dictionary['Lead']['fields']['lead_image']= array( 
	'name' => 'lead_image',
	'vname' => 'LBL_IMAGE',
	'type' => 'image',
	'massupdate' => false,
	'comments' => '',
	'help' => '',
	'importable' => false,
	'reportable' => true,
	'len' => 255,
	'dbType' => 'varchar',
	'width' => '160',
	'height' => '160',
);

$dictionary['Lead']['fields']['doc_url'] = array(
  'name' => 'doc_url',
  'vname' => 'LBL_DOC_URL',
  'type' => 'function',
  'function_class' => 'UploadFile',
  'function_name' => 'get_upload_url',
  'function_params' => array('$this'),
  'source' => 'function',
  'reportable' => false,
  'importable' => false,
);

$dictionary['Lead']['fields']['filename'] = array(
  'name' => 'filename',
  'vname' => 'LBL_DOC',
  'type' => 'file',
  'dbType' => 'varchar',
  'len' => '255',
  'reportable'=>true,
  'importable' => false,
);

$dictionary['Lead']['fields']['srStatus'] = array(
	'name' => 'srStatus',
	'vname' => 'LBL_SRSTATUS',
	'type' => 'enum',
	'len' => '50',
	'options' => 'srStatus_dom',
	'reportable'=>true,
	'importable' => false,
);

$dictionary['Lead']['fields']['appointment_date_time'] = array(
	'name' => 'appointment_date_time',
	'vname' => 'LBL_APPOINTMENT_DATE_TIME',
	'type' => 'datetime',
	'reportable'=>true,
	'importable' => false,
);
 

 ?>