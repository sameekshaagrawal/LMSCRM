<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class LeadsController extends SugarController
{
    public function action_updateLeadRecord(){
        if(isset($_REQUEST['fieldNeedToUpdate']) && isset($_REQUEST['actionCstm'])) {
            $lead  = new Lead();
            $lead->retrieve($_REQUEST['beanId']);
            if($_REQUEST['actionCstm'] == 'accept_lead' && $_REQUEST['fieldNeedToUpdate'] == 'srStatus') {
                $lead->srStatus = 'Accepted';
                $lead->save();
                
            } else if($_REQUEST['actionCstm'] == 'reject_lead' && $_REQUEST['fieldNeedToUpdate'] == 'srStatus') {
                $lead->srStatus = 'Rejected';
                if($_REQUEST['rejection_remark']) {
                    $lead->lead_rejection_remark = $_REQUEST['rejection_remark'];
                }
                $lead->save();
            }
            
           echo json_encode(array('status'=>'success'));
        } else if(isset($_REQUEST['actionCstm']) && $_REQUEST['actionCstm'] == 'addNote') { 
            $note = new Note();
            $note->parent_type = 'Leads';
            $note->parent_id = $_REQUEST['beanId'];
            $note->name = date("Y-m-d h:m:s");
            $note->description = $_REQUEST['notes'];
            if($note->save()) {
                echo json_encode(array('status'=>'success'));
            }
         } else {
           echo json_encode(array('status'=>'failure'));
        }
    }
    
}

