<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
use PHPMailer\PHPMailer\PHPMailer;

//require '../vendor/autoload.php';

class LeadsViewDetail extends ViewDetail
{
	function preDisplay() {
		global $current_user;
		$isSR = false;
		if($current_user->title == 'Sales Representative') {
			$isSR = true;
		}
	?>

	<!-- HTML FOR UPDATING REJECTION REMARK BY SALES REPRESENTATIVE -->
	<div class="modal fade" id="modalForRejection" role="dialog">
		<div class="modal-dialog">     
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<label for = "rejection_remark">Reason For Rejection </label>
								<input type = 'hidden' name = 'beanId' id = 'beanId' value = '<?php echo $this->bean->id ; ?>'>
								<textarea class="form-control" id="rejection_remark" name="rejection_remark"  style="width:90%"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input name = 'button' type="button" class="btn btn-default" id="saveRejection" value = "Save">  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
  	</div>


	<!-- HTML FOR ADDING NOTES -->
	<div class="modal fade" id="modalForAddNote" role="dialog">
		<div class="modal-dialog">     
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<label for = "note">Note</label>
								<input type = 'hidden' name = 'beanId' id = 'beanId' value = '<?php echo $this->bean->id ; ?>'>
								<textarea class="form-control" id="note" name="note"  style="width:90%"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input name = 'button' type="button" class="btn btn-default" id="addNote" value = "Save">  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
  	</div>
	<script>
	
	$(document).ready(function(){
		var beanId = '<?php echo $this->bean->id; ?>';
		
		$('.detail-view ul:first').append('<li id="tab-actions" class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" id = "send_mail">SEND EMAIL</a></li>');
		$(".pagination, #loader").hide();
		
		$(document).on('click','#send_mail',function(){
			window.open("index.php?module=Emails&action=ComposeView&return_module=Emails&return_action=index&related_module=Leads&related_record="+beanId, "_blank", "location=0,menubar=0,status=0,scrollbars=0,top=500,left=500,width=600,height=400");
		});	

		// Update Status By Sales Representative 
		var isSR = '<?php echo $isSR; ?>';
		var srStatus = '<?php echo $this->bean->srStatus;?>';
		if(isSR) {
			if(srStatus != 'Accepted') {
				$('.detail-view ul:first').append('<li id="tab-actions" class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" id = "accept_lead">Accept Lead</a></li>');
				$(document).on('click','#accept_lead',function(){
					$.ajax({
						type:"post",
						data:{
							'fieldNeedToUpdate':'srStatus',
							'actionCstm': 'accept_lead',
							'beanId' : beanId
						},
						url:"index.php?module=Leads&action=updateLeadRecord&to_pdf=1",
						success:function(data){
						}
					});
				});	
			}

			if(srStatus != 'Rejected') {
				$('.detail-view ul:first').append('<li id="tab-actions" class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" id = "reject_lead">Reject Lead</a></li>');

				$(document).on('click','#reject_lead',function(){
					$('#modalForRejection').modal('toggle');
				});

				$(document).on('click','#saveRejection',function(){
					$.ajax({
						type:"post",
						data:{
							'fieldNeedToUpdate':'srStatus',
							'actionCstm': 'reject_lead',
							'rejection_remark': $('#rejection_remark').val(),
							'beanId' : $('#beanId').val()
						},
						url:"index.php?module=Leads&action=updateLeadRecord&to_pdf=1",
						success:function(data){
							$('#modalForRejection').modal('toggle');
						}
					});
				});	
			}
		}
		// END Update Status By Sales Representative 
		$('.detail-view ul:first').append('<li id="tab-actions" class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" id = "add_note">Add Note</a></li>');

		$(document).on('click','#add_note',function(){
			$('#modalForAddNote').modal('toggle');
		});

		$(document).on('click','#addNote',function(){
			$.ajax({
				type:"post",
				data:{
					'actionCstm': 'addNote',
					'notes': $('#note').val(),
					'beanId' : $('#beanId').val()
				},
				url:"index.php?module=Leads&action=updateLeadRecord&to_pdf=1",
				success:function(data){
					$('#modalForAddNote').modal('toggle');
					showSubPanel('history', null, true);
				}
			});
		});	
	});
	
	</script>
	<?php
	parent::preDisplay();
	}
}
