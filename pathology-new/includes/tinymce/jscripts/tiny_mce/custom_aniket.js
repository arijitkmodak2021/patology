// JavaScript Document
function edit_node(id)
{
	$('#'+id).dialog('open');
}
function delete_node_video(id_counter,click_to_call_id,video_file_name)
{
	var SITEURL = document.getElementById('SITEURL').value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[VIDEO_FILE]'+id_counter+'[SEPARETOR]'+video_file_name+'[END_VIDEO_FILE]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
}
function delete_node_audio(id_counter,click_to_call_id,audio_file_name)
{
	var SITEURL = document.getElementById('SITEURL').value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[AUDIO_FILE]'+id_counter+'[SEPARETOR]'+audio_file_name+'[END_AUDIO_FILE]';
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
}
function delete_node_hit(id_counter,click_to_call_id)
{
	var SITEURL = document.getElementById('SITEURL').value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[HIT_COUNTER]'+id_counter+'[END_HIT_COUNTER]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
}
function delete_node_tell(id_counter,click_to_call_id)
{
	var SITEURL = document.getElementById('SITEURL').value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[TELL_A_FRIEND]'+id_counter+'[END_TELL_A_FRIEND]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);	
}
function delete_node_call(id_counter,click_to_call_id,telephomne_no_dialouge_id,display_text_dialouge_id)
{
	var telephomne_no_old = document.getElementById('hidden_'+telephomne_no_dialouge_id).value;
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	
	var SITEURL = document.getElementById('SITEURL').value;
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[CLICK_TO_CALL]'+id_counter+'[SEPARETOR]'+telephomne_no_old+'[SEPARETOR]'+display_text_old+'[END_CLICK_TO_CALL]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "click_to_call_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function create_dialouge_call(click_to_call_dialouge_id,telephomne_no_dialouge_id,display_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var telephomne_no = addslashes(document.getElementById(telephomne_no_dialouge_id).value);
				var display_text = addslashes(document.getElementById(display_text_dialouge_id).value);
				
				var telephomne_no_old = document.getElementById('hidden_'+telephomne_no_dialouge_id).value;
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				
				var SITEURL = document.getElementById('SITEURL').value;
				
				var editor_html = '[CLICK_TO_CALL]'+id_counter+'[SEPARETOR]'+telephomne_no_old+'[SEPARETOR]'+display_text_old+'[END_CLICK_TO_CALL]';
				
				document.getElementById('hidden_'+telephomne_no_dialouge_id).value = telephomne_no;
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[CLICK_TO_CALL]'+id_counter+'[SEPARETOR]'+telephomne_no+'[SEPARETOR]'+display_text+'[END_CLICK_TO_CALL]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;	
			}, 
			"Cancel": function() {
				$(this).dialog("close"); 
			} 
		}
	});
}
function create_dialouge_drive(click_to_call_dialouge_id,display_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var display_text = addslashes(document.getElementById(display_text_dialouge_id).value);
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				
				var editor_html = '[DRIVING_DIRECTION]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_DRIVING_DIRECTION]';
				
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[DRIVING_DIRECTION]'+id_counter+'[SEPARETOR]'+display_text+'[END_DRIVING_DIRECTION]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;	
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_drive(id_counter,click_to_call_id,display_text_dialouge_id)
{
	var SITEURL = document.getElementById('SITEURL').value;
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[DRIVING_DIRECTION]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_DRIVING_DIRECTION]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "driving_direction_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function delete_node_phonebook(id_counter,add_to_phonebook_id,telephone_no_dialouge_id,link_text_dialouge_id,contact_name_dialouge_id)
{
	var telephone_no_old = document.getElementById('hidden_'+telephone_no_dialouge_id).value;
	var link_text_old = document.getElementById('hidden_'+link_text_dialouge_id).value;
	var contact_name_old = document.getElementById('hidden_'+contact_name_dialouge_id).value;
	
	var SITEURL = document.getElementById('SITEURL').value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[ADD_TO_PHONEBOOK]'+id_counter+'[SEPARETOR]'+link_text_old+'[SEPARETOR]'+contact_name_old+'[SEPARETOR]'+telephone_no_old+'[END_ADD_TO_PHONEBOOK]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var add_to_phonebook_dialouge_id = "add_to_phonebook_div_"+id_counter;
	$( "#"+add_to_phonebook_dialouge_id ).dialog( "destroy" );
}
function create_dialouge_phonebook(add_to_phonebook_dialouge_id,telephone_no_dialouge_id,link_text_dialouge_id,contact_name_dialouge_id,id_counter)
{
	$('#'+add_to_phonebook_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var telephone_no = addslashes(document.getElementById(telephone_no_dialouge_id).value);
				var link_text = addslashes(document.getElementById(link_text_dialouge_id).value);
				var contact_name = addslashes(document.getElementById(contact_name_dialouge_id).value);
				
				var telephone_no_old = document.getElementById('hidden_'+telephone_no_dialouge_id).value;
				var link_text_old = document.getElementById('hidden_'+link_text_dialouge_id).value;
				var contact_name_old = document.getElementById('hidden_'+contact_name_dialouge_id).value;
				
				var editor_html = '[ADD_TO_PHONEBOOK]'+id_counter+'[SEPARETOR]'+link_text_old+'[SEPARETOR]'+contact_name_old+'[SEPARETOR]'+telephone_no_old+'[END_ADD_TO_PHONEBOOK]';
				
				document.getElementById('hidden_'+telephone_no_dialouge_id).value = telephone_no;
				document.getElementById('hidden_'+link_text_dialouge_id).value = link_text;
				document.getElementById('hidden_'+contact_name_dialouge_id).value = contact_name;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[ADD_TO_PHONEBOOK]'+id_counter+'[SEPARETOR]'+link_text+'[SEPARETOR]'+contact_name+'[SEPARETOR]'+telephone_no+'[END_ADD_TO_PHONEBOOK]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
}
function create_dialouge_map(click_to_call_dialouge_id,display_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var display_text = addslashes(document.getElementById(display_text_dialouge_id).value);
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				
				var editor_html = '[GOOGLE_MAP]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_GOOGLE_MAP]';
				
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[GOOGLE_MAP]'+id_counter+'[SEPARETOR]'+display_text+'[END_GOOGLE_MAP]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_map(id_counter,click_to_call_id,display_text_dialouge_id)
{
	var SITEURL = document.getElementById('SITEURL').value;
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[GOOGLE_MAP]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_GOOGLE_MAP]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "google_map_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function create_dialouge_youtube(click_to_call_dialouge_id,display_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var display_text = addslashes(document.getElementById(display_text_dialouge_id).value);
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				
				var editor_html = '[YOUTUBE_LINK]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_YOUTUBE_LINK]';
				
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[YOUTUBE_LINK]'+id_counter+'[SEPARETOR]'+display_text+'[END_YOUTUBE_LINK]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_youtube(id_counter,click_to_call_id,display_text_dialouge_id)
{
	var SITEURL = document.getElementById('SITEURL').value;
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[YOUTUBE_LINK]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_YOUTUBE_LINK]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "youtube_link_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog("destroy");
}
function create_dialouge_paypal(click_to_call_dialouge_id,display_text_dialouge_id,item_desc_dialouge_id,item_price_dialouge_id,currency_code_dialouge_id,return_url_dialouge_id,link_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var display_text = addslashes(stripslashes(document.getElementById(display_text_dialouge_id).value));
				var item_desc = addslashes(stripslashes(document.getElementById(item_desc_dialouge_id).value));
				var item_price = addslashes(stripslashes(document.getElementById(item_price_dialouge_id).value));
				var currency_code = addslashes(stripslashes(document.getElementById(currency_code_dialouge_id).value));
				var return_url = addslashes(stripslashes(document.getElementById(return_url_dialouge_id).value));
				var link_text = addslashes(stripslashes(document.getElementById(link_text_dialouge_id).value));
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				var item_desc_old = document.getElementById('hidden_'+item_desc_dialouge_id).value;
				var item_price_old = document.getElementById('hidden_'+item_price_dialouge_id).value;
				var currency_code_old = document.getElementById('hidden_'+currency_code_dialouge_id).value;
				var return_url_old = document.getElementById('hidden_'+return_url_dialouge_id).value;
				var link_text_old = document.getElementById('hidden_'+link_text_dialouge_id).value;
				
				var editor_html = '[PAYPAL_CHECKOUT]'+id_counter+'[SEPARETOR]'+display_text_old+'[SEPARETOR]'+item_desc_old+'[SEPARETOR]'+item_price_old+'[SEPARETOR]'+currency_code_old+'[SEPARETOR]'+return_url_old+'[SEPARETOR]'+link_text_old+'[END_PAYPAL_CHECKOUT]';
				
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				document.getElementById('hidden_'+item_desc_dialouge_id).value = item_desc;
				document.getElementById('hidden_'+item_price_dialouge_id).value = item_price;
				document.getElementById('hidden_'+currency_code_dialouge_id).value = currency_code;
				document.getElementById('hidden_'+return_url_dialouge_id).value = return_url;
				document.getElementById('hidden_'+link_text_dialouge_id).value = link_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[PAYPAL_CHECKOUT]'+id_counter+'[SEPARETOR]'+display_text+'[SEPARETOR]'+item_desc+'[SEPARETOR]'+item_price+'[SEPARETOR]'+currency_code+'[SEPARETOR]'+return_url+'[SEPARETOR]'+link_text+'[END_PAYPAL_CHECKOUT]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;	
			}, 
			"Cancel": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_paypal(id_counter,click_to_call_id,display_text_dialouge_id,item_desc_dialouge_id,item_price_dialouge_id,currency_code_dialouge_id,return_url_dialouge_id,link_text_dialouge_id)
{
	var SITEURL = document.getElementById('SITEURL').value;
	
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	var item_desc_old = document.getElementById('hidden_'+item_desc_dialouge_id).value;
	var item_price_old = document.getElementById('hidden_'+item_price_dialouge_id).value;
	var currency_code_old = document.getElementById('hidden_'+currency_code_dialouge_id).value;
	var return_url_old = document.getElementById('hidden_'+return_url_dialouge_id).value;
	var link_text_old = document.getElementById('hidden_'+link_text_dialouge_id).value;
		
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[PAYPAL_CHECKOUT]'+id_counter+'[SEPARETOR]'+display_text_old+'[SEPARETOR]'+item_desc_old+'[SEPARETOR]'+item_price_old+'[SEPARETOR]'+currency_code_old+'[SEPARETOR]'+return_url_old+'[SEPARETOR]'+link_text_old+'[END_PAYPAL_CHECKOUT]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "paypal_checkout_div"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function delete_node_google(id_counter,click_to_call_id,display_text_dialouge_id,item_name_dialouge_id,item_desc_dialouge_id,item_price_dialouge_id,quantity_dialouge_id,currency_code_dialouge_id,link_text_dialouge_id)
{
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	/*var telephomne_no_old = document.getElementById('hidden_'+telephomne_no_dialouge_id).value;*/
	var item_name_old = document.getElementById('hidden_'+item_name_dialouge_id).value;
	var item_desc_old = document.getElementById('hidden_'+item_desc_dialouge_id).value;
	var item_price_old = document.getElementById('hidden_'+item_price_dialouge_id).value;
	var quantity_old = document.getElementById('hidden_'+quantity_dialouge_id).value;
	var currency_code_old = document.getElementById('hidden_'+currency_code_dialouge_id).value;
	/*var return_url_old = document.getElementById('hidden_'+return_url_dialouge_id).value;*/
	var link_text_old = document.getElementById('hidden_'+link_text_dialouge_id).value;
	
	var SITEURL = document.getElementById('SITEURL').value;
		
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[GOOGLE_CHECKOUT]'+id_counter+'[SEPARETOR]'+display_text_old+'[SEPARETOR]'+item_name_old+'[SEPARETOR]'+item_desc_old+'[SEPARETOR]'+item_price_old+'[SEPARETOR]'+quantity_old+'[SEPARETOR]'+currency_code_old+'[SEPARETOR]'+link_text_old+'[END_GOOGLE_CHECKOUT]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "google_checkout_div"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function create_dialouge_google(click_to_call_dialouge_id,display_text_dialouge_id,item_name_dialouge_id,item_desc_dialouge_id,item_price_dialouge_id,quantity_dialouge_id,currency_code_dialouge_id,link_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				
				var display_text = addslashes(stripslashes(document.getElementById(display_text_dialouge_id).value));
				/*var telephomne_no = addslashes(stripslashes(document.getElementById(telephomne_no_dialouge_id).value));*/
				var item_name = addslashes(stripslashes(document.getElementById(item_name_dialouge_id).value));
				var item_desc = addslashes(stripslashes(document.getElementById(item_desc_dialouge_id).value));
				var item_price = addslashes(stripslashes(document.getElementById(item_price_dialouge_id).value));
				var quantity = addslashes(stripslashes(document.getElementById(quantity_dialouge_id).value));
				var currency_code = addslashes(stripslashes(document.getElementById(currency_code_dialouge_id).value));
				/*var return_url = addslashes(stripslashes(document.getElementById(return_url_dialouge_id).value));*/
				var link_text = addslashes(stripslashes(document.getElementById(link_text_dialouge_id).value));
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				/*var telephomne_no_old = document.getElementById('hidden_'+telephomne_no_dialouge_id).value;*/
				var item_name_old = document.getElementById('hidden_'+item_name_dialouge_id).value;
				var item_desc_old = document.getElementById('hidden_'+item_desc_dialouge_id).value;
				var item_price_old = document.getElementById('hidden_'+item_price_dialouge_id).value;
				var quantity_old = document.getElementById('hidden_'+quantity_dialouge_id).value;
				var currency_code_old = document.getElementById('hidden_'+currency_code_dialouge_id).value;
				/*var return_url_old = document.getElementById('hidden_'+return_url_dialouge_id).value;*/
				var link_text_old = document.getElementById('hidden_'+link_text_dialouge_id).value;
				
				var SITEURL = document.getElementById('SITEURL').value;
				
				var editor_html = '[GOOGLE_CHECKOUT]'+id_counter+'[SEPARETOR]'+display_text_old+'[SEPARETOR]'+item_name_old+'[SEPARETOR]'+item_desc_old+'[SEPARETOR]'+item_price_old+'[SEPARETOR]'+quantity_old+'[SEPARETOR]'+currency_code_old+'[SEPARETOR]'+link_text_old+'[END_GOOGLE_CHECKOUT]';
				
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				/*document.getElementById('hidden_'+telephomne_no_dialouge_id).value = telephomne_no;*/
				document.getElementById('hidden_'+item_name_dialouge_id).value = item_name;
				document.getElementById('hidden_'+item_desc_dialouge_id).value = item_desc;
				document.getElementById('hidden_'+item_price_dialouge_id).value = item_price;
				document.getElementById('hidden_'+quantity_dialouge_id).value = quantity;
				document.getElementById('hidden_'+currency_code_dialouge_id).value = currency_code;
				/*document.getElementById('hidden_'+return_url_dialouge_id).value = return_url;*/
				document.getElementById('hidden_'+link_text_dialouge_id).value = link_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[GOOGLE_CHECKOUT]'+id_counter+'[SEPARETOR]'+display_text+'[SEPARETOR]'+item_name+'[SEPARETOR]'+item_desc+'[SEPARETOR]'+item_price+'[SEPARETOR]'+quantity+'[SEPARETOR]'+currency_code+'[SEPARETOR]'+link_text+'[END_GOOGLE_CHECKOUT]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;	
			}, 
			"Cancel": function() {
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_subpage(id_counter,add_link_id,current_sub_page_dialouge_id,previous_sub_page_dialouge_id,sub_page_text_dialouge_id)
{
	var current_sub_page = document.getElementById(current_sub_page_dialouge_id).value;
	var previous_sub_page = document.getElementById(previous_sub_page_dialouge_id).value;
	var sub_page_text = document.getElementById(sub_page_text_dialouge_id).value;
	var sub_page_text_old = document.getElementById("old_"+sub_page_text_dialouge_id).value;
	
	var editor_html = '<a id="link_'+id_counter+'" href="index.php?page_id='+current_sub_page+'">'+sub_page_text_old+'</a>';
	document.getElementById(add_link_id).style.display = 'none';
	var total_html = $('#custom_button').html();
	//$('#custom_button').tinymce().execCommand('mceReplaceContent',false,'<b>{editor_html}</b>');
	var total_html_final = total_html.replace(editor_html,'');
	var click_to_call_dialouge_id = "add_link_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
	$('#custom_button').html(total_html_final);
}
function create_dialouge_subpage(add_link_div_dialouge_id,current_sub_page_dialouge_id,previous_sub_page_dialouge_id,sub_page_text_dialouge_id,id_counter)
{
	$('#'+add_link_div_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var current_sub_page = document.getElementById(current_sub_page_dialouge_id).value;
				var previous_sub_page = document.getElementById(previous_sub_page_dialouge_id).value;
				var sub_page_text = document.getElementById(sub_page_text_dialouge_id).value;
				var sub_page_text_old = document.getElementById("old_"+sub_page_text_dialouge_id).value;
				
				var editor_html = '<a id="link_'+id_counter+'" href="index.php?page_id='+previous_sub_page+'">'+sub_page_text_old+'</a>';
				
				var total_html = $('#custom_button').html();
				
				var editor_html_2 = '<a id="link_'+id_counter+'" href="index.php?page_id='+current_sub_page+'">'+sub_page_text+'</a>';
				
				document.getElementById("old_"+sub_page_text_dialouge_id).value = sub_page_text;
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				
				document.getElementById('text_add_link_id_'+id_counter).innerHTML = sub_page_text;
				$('#custom_button').html(total_html_final);	
			}, 
			"Cancel": function() {
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_facebook(id_counter,click_to_call_id,display_text_dialouge_id)
{
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	
	var SITEURL = document.getElementById('SITEURL').value;
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[FACEBOOK_LINK]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_FACEBOOK_LINK]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "facebook_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function create_dialouge_facebook(click_to_call_dialouge_id,display_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var display_text = addslashes(document.getElementById(display_text_dialouge_id).value);
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				
				var SITEURL = document.getElementById('SITEURL').value;
				
				var editor_html = '[FACEBOOK_LINK]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_FACEBOOK_LINK]';
				
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[FACEBOOK_LINK]'+id_counter+'[SEPARETOR]'+display_text+'[END_FACEBOOK_LINK]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;	
			}, 
			"Cancel": function() {
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_twitter(id_counter,click_to_call_id,display_text_dialouge_id)
{
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	
	var SITEURL = document.getElementById('SITEURL').value;
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[TWITTER_LINK]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_TWITTER_LINK]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "twitter_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function create_dialouge_twitter(click_to_call_dialouge_id,display_text_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				var display_text = addslashes(document.getElementById(display_text_dialouge_id).value);
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				
				var SITEURL = document.getElementById('SITEURL').value;
				
				var editor_html = '[TWITTER_LINK]'+id_counter+'[SEPARETOR]'+display_text_old+'[END_TWITTER_LINK]';
				
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[TWITTER_LINK]'+id_counter+'[SEPARETOR]'+display_text+'[END_TWITTER_LINK]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;	
			}, 
			"Cancel": function() {
				$(this).dialog("close"); 
			} 
		}
	});
}
function delete_node_image(id_counter,display_text_dialouge_id,telephomne_no_dialouge_id,item_name_dialouge_id,item_desc_dialouge_id,item_price_dialouge_id,quantity_dialouge_id)
{
	var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
	var telephomne_no_old = document.getElementById('hidden_'+telephomne_no_dialouge_id).value;
	var item_name_old = document.getElementById('hidden_'+item_name_dialouge_id).value;
	var item_desc_old = document.getElementById('hidden_'+item_desc_dialouge_id).value;
	var item_price_old = document.getElementById('hidden_'+item_price_dialouge_id).value;
	var quantity_old = document.getElementById('hidden_'+quantity_dialouge_id).value;
	
	var SITEURL = document.getElementById('SITEURL').value;
		
	var tooltip = ' onmouseover="domTT_activate(this,event,\'content\',window.parent.document.getElementById(\'edit_delete\').innerHTML,\'type\',\'velcro\');"';
	var editor_html = '[IMAGE_FILE]'+id_counter+'[SEPARETOR]'+display_text_old+'[SEPARETOR]'+telephomne_no_old+'[SEPARETOR]'+item_name_old+'[SEPARETOR]'+item_desc_old+'[SEPARETOR]'+item_price_old+'[SEPARETOR]'+quantity_old+'[END_IMAGE_FILE]';
	
	var parent = window.child.document.getElementById('myInstance1');
	var elem = window.child.document.getElementById(editor_html);
	var old = (elem.parentNode).removeChild(elem);
	
	var click_to_call_dialouge_id = "image_file_div_"+id_counter;
	$( "#"+click_to_call_dialouge_id ).dialog( "destroy" );
}
function create_dialouge_image(click_to_call_dialouge_id,display_text_dialouge_id,telephomne_no_dialouge_id,item_name_dialouge_id,item_desc_dialouge_id,item_price_dialouge_id,quantity_dialouge_id,id_counter)
{
	$('#'+click_to_call_dialouge_id).dialog({
		autoOpen: false,
		modal: true,
		width: 350,
		buttons: {
			"Submit": function() { 
				$(this).dialog("close");
				
				var display_text = addslashes(stripslashes(document.getElementById(display_text_dialouge_id).value));
				var telephomne_no = addslashes(stripslashes(document.getElementById(telephomne_no_dialouge_id).value));
				var item_name = addslashes(stripslashes(document.getElementById(item_name_dialouge_id).value));
				var item_desc = addslashes(stripslashes(document.getElementById(item_desc_dialouge_id).value));
				var item_price = addslashes(stripslashes(document.getElementById(item_price_dialouge_id).value));
				var quantity = addslashes(stripslashes(document.getElementById(quantity_dialouge_id).value));
				
				var display_text_old = document.getElementById('hidden_'+display_text_dialouge_id).value;
				var telephomne_no_old = document.getElementById('hidden_'+telephomne_no_dialouge_id).value;
				var item_name_old = document.getElementById('hidden_'+item_name_dialouge_id).value;
				var item_desc_old = document.getElementById('hidden_'+item_desc_dialouge_id).value;
				var item_price_old = document.getElementById('hidden_'+item_price_dialouge_id).value;
				var quantity_old = document.getElementById('hidden_'+quantity_dialouge_id).value;
				
				var SITEURL = document.getElementById('SITEURL').value;
				
				var editor_html = '[IMAGE_FILE]'+id_counter+'[SEPARETOR]'+display_text_old+'[SEPARETOR]'+telephomne_no_old+'[SEPARETOR]'+item_name_old+'[SEPARETOR]'+item_desc_old+'[SEPARETOR]'+item_price_old+'[SEPARETOR]'+quantity_old+'[END_IMAGE_FILE]';
								
				document.getElementById('hidden_'+display_text_dialouge_id).value = display_text;
				document.getElementById('hidden_'+telephomne_no_dialouge_id).value = telephomne_no;
				document.getElementById('hidden_'+item_name_dialouge_id).value = item_name;
				document.getElementById('hidden_'+item_desc_dialouge_id).value = item_desc;
				document.getElementById('hidden_'+item_price_dialouge_id).value = item_price;
				document.getElementById('hidden_'+quantity_dialouge_id).value = quantity;
				
				var total_html = window.child.document.getElementById('myInstance1').innerHTML;
				
				var editor_html_2 = '[IMAGE_FILE]'+id_counter+'[SEPARETOR]'+display_text+'[SEPARETOR]'+telephomne_no+'[SEPARETOR]'+item_name+'[SEPARETOR]'+item_desc+'[SEPARETOR]'+item_price+'[SEPARETOR]'+quantity+'[END_IMAGE_FILE]';
				
				var total_html_final = total_html.replace(editor_html,editor_html_2);				
				window.child.document.getElementById('myInstance1').innerHTML = total_html_final;
				
				window.child.document.getElementById(editor_html_2).style.float = display_text;
				window.child.document.getElementById(editor_html_2).style.width = telephomne_no+"px";
				window.child.document.getElementById(editor_html_2).style.height = item_name+"px";
				window.child.document.getElementById(editor_html_2).style.marginTop = item_desc+"px";
				window.child.document.getElementById(editor_html_2).style.marginBottom = item_desc+"px";
				window.child.document.getElementById(editor_html_2).style.marginLeft = item_price+"px";
				window.child.document.getElementById(editor_html_2).style.marginRight = item_price+"px";
				window.child.document.getElementById(editor_html_2).style.border = quantity+"px solid #000000";
			}, 
			"Cancel": function() {
				$(this).dialog("close"); 
			} 
		}
	});
}