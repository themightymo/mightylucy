var saveTitle = function(form) {

	jQuery.ajax({
		method: "POST",
		dataType: "json",
		url: '/wp-admin/admin-ajax.php?action=tmm_save_title',
		data: {'title': form.elements['title-value'].value,
			'ID': form.elements['ID'].value},

	}).done(function(myAjaxData){

		hideSaveTitleForms();
		jQuery('#entry-title-text-' + form.elements['ID'].value).html(form.elements['title-value'].value);

	});

}

var showForm = function(id) {
	jQuery('#title-editor-' + id).show();
	jQuery('#entry-title-text-' + id).hide();
}

var hideSaveTitleForms = function() {
	jQuery('.title-editor').hide();
	jQuery('.entry-title-text').show();

}
jQuery(document).ready(function($) {

	
});