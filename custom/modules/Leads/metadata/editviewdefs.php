<?php
$viewdefs ['Leads'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="prospect_id" value="{if isset($smarty.request.prospect_id)}{$smarty.request.prospect_id}{else}{$bean->prospect_id}{/if}">',
          1 => '<input type="hidden" name="account_id" value="{if isset($smarty.request.account_id)}{$smarty.request.account_id}{else}{$bean->account_id}{/if}">',
          2 => '<input type="hidden" name="contact_id" value="{if isset($smarty.request.contact_id)}{$smarty.request.contact_id}{else}{$bean->contact_id}{/if}">',
          3 => '<input type="hidden" name="opportunity_id" value="{if isset($smarty.request.opportunity_id)}{$smarty.request.opportunity_id}{else}{$bean->opportunity_id}{/if}">',
        ),
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '<script type="text/javascript" language="Javascript">function copyAddressRight(form)  {ldelim} form.alt_address_street.value = form.primary_address_street.value;form.alt_address_city.value = form.primary_address_city.value;form.alt_address_state.value = form.primary_address_state.value;form.alt_address_postalcode.value = form.primary_address_postalcode.value;form.alt_address_country.value = form.primary_address_country.value;return true; {rdelim} function copyAddressLeft(form)  {ldelim} form.primary_address_street.value =form.alt_address_street.value;form.primary_address_city.value = form.alt_address_city.value;form.primary_address_state.value = form.alt_address_state.value;form.primary_address_postalcode.value =form.alt_address_postalcode.value;form.primary_address_country.value = form.alt_address_country.value;return true; {rdelim} </script>',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'LBL_CONTACT_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 'email1',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'full_name',
            'studio' => 
            array (
              'listview' => false,
            ),
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
        2 => 
        array (
          0 => 'phone_work',
          1 => 'phone_mobile',
        ),
        3 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'lead_stage',
            'comment' => 'This field store the current stage of lead (accepted or rejected by sales represtative)',
            'label' => 'LBL_LEAD_STAGE',
          ),
        ),
        4 => 
        array (
          0 => 'department',
          1 => 
          array (
            'name' => 'industry',
            'comment' => 'This field store industry of lead',
            'label' => 'LBL_INDUSTRY',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
            'type' => 'varchar',
            'validateDependency' => false,
            'customCode' => '<input name="account_name" id="EditView_account_name" {if ($fields.converted.value == 1)}disabled="true"{/if} size="30" maxlength="255" type="text" value="{$fields.account_name.value}">',
          ),
          1 => 'website',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'primary_address_street',
            'hideLabel' => true,
            'type' => 'address',
            'displayParams' => 
            array (
              'key' => 'primary',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
          ),
          1 => '',
        ),
        7 => 
        array (
          0 => 'description',
          1 => '',
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'last_activity',
            'comment' => 'This field store last activity of lead',
            'label' => 'LBL_LAST_ACTIVITY',
          ),
          1 => 'lead_source',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 'title',
          1 => 
          array (
            'name' => 'job_function',
            'label' => 'LBL_JOB_FUNCTION',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'project_desc',
            'label' => 'LBL_PROJECT_DESC',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'budget',
            'label' => 'LBL_BUDGET',
          ),
          1 => 
          array (
            'name' => 'skype_id',
            'label' => 'LBL_SKYPE_ID',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'project_type',
            'label' => 'LBL_PROJECT_TYPE',
          ),
          1 => 
          array (
            'name' => 'starting_time',
            'label' => 'LBL_STARTING_TIME',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'lead_image',
            'label' => 'LBL_IMAGE',
          ),
          1 => 
          array (
            'name' => 'filename',
            'label' => 'LBL_DOC',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'appointment_date_time',
            'label' => 'LBL_APPOINTMENT_DATE_TIME',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
;
?>
