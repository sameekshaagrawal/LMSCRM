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
	<script>
	
	$(document).ready(function(){
		var beanId = '<?php echo $this->bean->id; ?>';
		
		$('.detail-view ul:first').append('<li id="tab-actions" class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" id = "send_mail">SEND EMAIL</a></li>');
		$(".pagination").hide();
		
		$(document).on('click','#send_mail',function(){
			
			window.open("index.php?module=Emails&action=ComposeView&return_module=Emails&return_action=index&related_module=Leads&related_record="+beanId, "_blank", "location=0,menubar=0,status=0,scrollbars=0,top=500,left=500,width=600,height=400");
		});	
	});
	
	</script>
	<?php
	parent::preDisplay();
	}
}
