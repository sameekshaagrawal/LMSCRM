<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
use PHPMailer\PHPMailer\PHPMailer;

//require '../vendor/autoload.php';

class LeadsViewDetail extends ViewDetail
{
	function preDisplay() {
		
	?>
	
	

            
        
	<div class="modal fade" id="myModalforSendFinalSubmission" role="dialog">
    <div class="modal-dialog">
	<form method="post" enctype="multipart/form-data" id = "sendMAILFORM">
     
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Send Mail</h4>
        </div>
        <div class="modal-body">
          <div class="panel panel-default">
            <div class="panel-body">
            <div class="form-group">
				  <label for = "email_to">To</label>
				  <input type="text" class="form-control" id="email_to" name="email_to" placeholder="Recipients" style="width:90%">
                  <p id = "ccp" style="float:right;margin-top:-5%; margin-right:6%">Cc</p>
				  <p id = "bccp" style="float:right;margin-top:-5%; margin-right:0.5%">Bcc</p>

                  <input type="hidden" class="form-control" id="send_attach" name="send_attach">
				 
				  <label for = "email_cc" id="email_cc_label" class = "hidden" >Cc</label><input type="text" class="form-control hidden" id="email_cc" name="email_cc" placeholder="Recipients" >
				  
				  <label for = "email_bcc" id="email_bcc_label" class = "hidden" >Bcc</label><input type="text" class="form-control hidden"  id="email_bcc" name="email_bcc" placeholder="Recipients">
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" id="email_subject" name="email_subject" placeholder = "Subject">
              </div>
              <div class="form-group">
				<input type="file" id='files' name="files[]" multiple><br>
                <label for="message">Email Body</label>
                <textarea class="form-control" id="email_body" rows="5" name="email_body"></textarea>
				<textarea class="form-control" id="email_body_html" rows="5" name="email_body_html"></textarea>
            </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
		 <input name = 'button' type="button" class="btn btn-default" id="sendFinal1" value = "Send1">  <input name = 'button' type="button" class="btn btn-default" id="sendFinal" value = "Send">  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
        </form>
    </div>
  </div>

  
  

  <script src="https://cdn.tiny.cloud/1/xg6ruk0cehcz87dnisy1jfb7fy0t1ew8r548cnrr3assbte9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
	
	$(document).ready(function(){
		tinymce.init({
		  selector: 'textarea#email_body',
		  menubar: false,
		  plugins: "image imagetools",
		  toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code',
		  toolbar_location: 'bottom',
   
		});
		
		$('.detail-view ul').append('<li id="tab-actions" class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" id = "send_mail">SEND EMAIL</a></li>');
		$(".pagination").hide();
		
		$(document).on('click','#ccp',function(){
			$("#email_cc, #email_cc_label").removeClass("hidden");
		});
		$(document).on('click','#bccp',function(){
			$("#email_bcc, #email_bcc_label").removeClass("hidden");
		});
		$(document).on('click','#send_mail',function(){
			var formdata=$('#chooseforpdf').serialize();
			window.open("index.php?module=Emails&action=ComposeView&return_module=Emails&return_action=index", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
			//$('#myModalforSendFinalSubmission').modal('toggle');

		});
		
		/*$(document).on('click','#sendFinal',function(e){
		  alert("hello");
		  var form_data = new FormData();
		  
		   var totalfiles = document.getElementById('files').files.length;
		   for (var index = 0; index < totalfiles; index++) {
			  form_data.append("files[]", document.getElementById('files').files[index]);
		   }
	  //tinymce.activeEditor.getContent();
	  $.ajax({
			type:'post',
			url:'index.php?module=Leads&action=sendMail&to_pdf=1',
			
			dataType: 'json',
			contentType: false,
			processData: false,
			data:{
				'mail_subject'	:$("#email_subject").val(),
				'mail_body'		:tinyMCE.get("email_body").getContent(),
				'send_attach'	:$("#send_attach").val(),
				'email_bcc'		:$("#email_bcc").val(),
				'email_cc'		:$("#email_cc").val(),
				'email_to'		:$("#email_to").val(),
				'fileData'		: form_data
			},
			success:function(data){
				if(data!=''){
				  alert(data);
				}
			//window.location.reload();
			}
		});

	});*/
	
	
	$('#sendFinal').click(function(e){
	  alert("hello submit");
	  var content = tinyMCE.get("email_body").getContent();
	  $('#email_body_html').val(content);
	  var form = $('#sendMAILFORM')[0];
	  var data = new FormData(form);

        // If you want to add an extra field for the FormData
      // data.append("CustomField", "This is some extra data, testing");

	  //var formData = $('#sendMAILFORM').serializeArray();
	  var totalfiles = document.getElementById('files').files.length;
		for (var index = 0; index < totalfiles; index++) {
			data.append("files[]", document.getElementById('files').files[index]);
		}
	  $.ajax({
			type:'post',
			url:'index.php?module=Leads&action=sendMail&to_pdf=1',
			type: 'POST',
			data: data,
			success: function (data) {
				alert(data)
			},
			cache: false,
			contentType: false,
			processData: false,
			success:function(data){
				if(data!=''){
				  alert(data);
				}
			//window.location.reload();
			}
		});

	});
		
		
		
		
	});
	
	</script>
	<?php
	parent::preDisplay();
	/*if(isset($_REQUEST['submit'])) {
		
		print_R($_REQUEST);
		
		$to_arr = $cc_arr = $bcc_arr = [];
		$subject = $_REQUEST['mail_subject'];
		$body_html = $_REQUEST['mail_body'];
		if (strpos($_REQUEST['email_to'], ',') !== false) {
			$to_arr =  explode( ',', $_REQUEST['email_to']);
		} else {
			array_push($to_arr, $_REQUEST['email_to']);
		}
		if (strpos($_REQUEST['email_cc'], ',') !== false) {
			$cc_arr =  explode( ',', $_REQUEST['email_cc']);
		} else {
			array_push($cc_arr, $_REQUEST['email_cc']);
		}
		if (strpos($_REQUEST['email_bcc'], ',') !== false) {
			$bcc_arr =  explode( ',', $_REQUEST['email_bcc']);
		} else {
			array_push($bcc_arr, $_REQUEST['email_bcc']);
		}


		if(!empty($body_html)){
			if(count($to_arr)>0){
				$emailObj = new Email();  
				$defaults = $emailObj->getSystemDefaultEmail(); 
				print_R($defaults);
				$mail = new SugarPHPMailer();  
				$mail->setMailerForSystem();  
				$mail->From = $defaults['email'];  
				$mail->FromName = $defaults['name'];  
				$mail->Subject  =   $subject;
				$mail->Body     =  $body_html ; 
				$mail->prepForOutbound();  
				for($i = 0 ; $i < count($to_arr); $i++) {
					$mail->AddAddress(trim($to_arr[$i]));
				}
				for($i = 0 ; $i < count($cc_arr); $i++) {
					$mail->AddCC(trim($cc_arr[$i]));
				}
				for($i = 0 ; $i < count($bcc_arr); $i++) {
					$mail->addBcc(trim($bcc_arr[$i]));
				}
				
				/*$ext = PHPMailer::mb_pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				//Define a safe location to move the uploaded file to, preserving the extension
				$uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['userfile']['name'])) . '.' . $ext;

				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
					 if (!$mail->addAttachment($uploadfile, 'My uploaded file')) {
						$msg .= 'Failed to attach file ' . $_FILES['userfile']['name'];
					}
				}*/
				/*if(!empty($pdf)){ 
					$mail->addAttachment($pdf);
				}
				if(!empty($attachments)){
					foreach($attachments as $attachment){
						$mail->addAttachment('upload/'.$attachment->document_revision_id,$attachment->document_name);
					}
				}*/
				/*$mail->IsHTML(true);
				if(!$mail->send()) {
				   echo 'Message could not be sent.';
				   echo 'Mailer Error: ' . $mail->ErrorInfo;
				   exit;
				}
				
			}
		}
	}*/


	}
}
