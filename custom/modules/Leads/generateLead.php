<?php

/*
{
    "requestType" : "generateLeadFromWeb",
    "name" : "Sample Lead",
    "email" : "sameeksha@gmail.com",
    "phone_number": "92192903834",
    "country": "India",
    "skype_id": "xys@skype",
    "about_project" : "project title",
    "project_looking_for": "Enterprise Mobility",
    "project_budget": "Less than $5,000",
    "project_started": "Immediately",
    "image": {
        "name": "Error-512.png",
        "url": "https://cdn0.iconfinder.com/data/icons/shift-free/32/Error-512.png"
    },
    "document": {
        "name": "java_tutorial.pdf",
        "url": "https://www.tutorialspoint.com/java/java_tutorial.pdf"
    }
}
*/

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_json = file_get_contents('php://input');
    $request_obj = json_decode($request_json);
    //print_r($request_obj);
    $response  = array();
    if($request_obj->requestType == "generateLeadFromWeb") {
        global $db;
        $sql = "SELECT contacts.id,contacts.first_name,email_addresses.email_address FROM contacts
                LEFT JOIN email_addr_bean_rel eabr ON eabr.bean_id = contacts.id AND eabr.deleted=0 AND eabr.bean_module='Contacts' 
                LEFT JOIN email_addresses ON email_addresses.id = eabr.email_address_id AND email_addresses.deleted=0 
                WHERE email_addresses.email_address = '".$request_obj->email."'";
        $exe = $db->query($sql);
        
        if($exe->num_rows > 0) {
            $res = $db->fetchByAssoc($exe);
           
            $lead = new Lead();
            $lead->id = create_guid();
            $lead->new_with_id = true;
            $lead->last_name  = $request_obj->name;
            $lead->email1 = $request_obj->email;
            $lead->phone_work = $request_obj->phone_number;
            $lead->primary_address_country = $request_obj->country;
            $lead->skype_id = $request_obj->skype_id;
            $lead->title = $request_obj->about_project;
            $lead->project_type = $request_obj->project_looking_for;
            $lead->budget = str_replace( "," , "", $request_obj->project_budget);
            $lead->starting_time = str_replace( "," , "", $request_obj->project_started);
            $lead->lead_source = 'Web Site';

            if($request_obj->image->url != ''  && $request_obj->image->name != '') {
                $sourceUrlImage = $request_obj->image->url;
                $lead->lead_image = $request_obj->image->name;
                $destinationUrlImage = 'upload/'.$lead->id.'_lead_image';
                file_put_contents($destinationUrlImage, file_get_contents($sourceUrlImage));
            }
            
            if($request_obj->document->url != ''  && $request_obj->document->name != '') {
                $sourceUrlDoc = $request_obj->document->url;
                $lead->filename = $request_obj->document->name;
                $destinationUrlDoc = 'upload/'.$lead->id;
                file_put_contents($destinationUrlDoc, file_get_contents($sourceUrlDoc));
            }
            
            if($lead->save()) {
                $lead->load_relationship('contacts');
                $lead->contacts->add($res['id']);
            }

            $response = array(
                "status" => "Ok", 
                "error_code" => 200,
                "message" => "Lead Created"
            );


        } else {
            
            $contact = new Contact();
            $contact->last_name  = $request_obj->name;
            $contact->email1 = $request_obj->email;
            $contact->phone_work = $request_obj->phone_number;
            $contact->primary_address_country = $request_obj->country;
            $contact->save();

            $lead = new Lead();
            $lead->id = create_guid();
            $lead->new_with_id = true;
            $lead->last_name  = $request_obj->name;
            $lead->email1 = $request_obj->email;
            $lead->phone_work = $request_obj->phone_number;
            $lead->primary_address_country = $request_obj->country;
            $lead->skype_id = $request_obj->skype_id;
            $lead->title = $request_obj->about_project;
            $lead->project_type = $request_obj->project_looking_for;
            $lead->budget = str_replace( "," , "", $request_obj->project_budget);
            $lead->starting_time = str_replace( "," , "", $request_obj->project_started);
            $lead->lead_source = 'Web Site';

            if($request_obj->image->url != ''  && $request_obj->image->name != '') {
                $sourceUrlImage = $request_obj->image->url;
                $lead->lead_image = $request_obj->image->name;
                $destinationUrlImage = 'upload/'.$lead->id.'_lead_image';
                file_put_contents($destinationUrlImage, file_get_contents($sourceUrlImage));
            }
            
            if($request_obj->document->url != ''  && $request_obj->document->name != '') {
                $sourceUrlDoc = $request_obj->document->url;
                $lead->filename = $request_obj->document->name;
                $destinationUrlDoc = 'upload/'.$lead->id;
                file_put_contents($destinationUrlDoc, file_get_contents($sourceUrlDoc));
            }
            
            if($lead->save()) {

                $lead->load_relationship('contacts');
                $lead->contacts->add($contact->id);
            }

            $response = array(
                "status" => "Ok", 
                "error_code" => 200,
                "message" => "Lead Created"
            );


        }


    } else if ($request_arr === null) {
        $response = array(
            "status" => "Error", 
            "error_code" => 400,
            "message" => "Invalid request"
        );
    } else  {
        $response = array(
            "status" => "Error", 
            "error_code" => 400,
            "message" => "Invalid requestType"
        );
    }
} else {
    $response = array(
        "status" => "Error", 
        "error_code" => 405,
        "message" => "Only HTTP method POST is supported by this URL"
    );
}
print_r(json_encode($response));

