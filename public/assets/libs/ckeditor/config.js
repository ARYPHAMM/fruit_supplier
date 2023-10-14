/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// 
		// Define changes to default configuration here. For example:
	// config.uiColor = '#AADC6E';
	config.language = 'vi';
	// config.extraPlugins = 'youtube,widget,btgrid,bt_table,blockquote,glyphicons,emojione,btbutton,lineutils';
	// config.extraPlugins = 'youtube,widget,btgrid,bt_table,blockquote,glyphicons,emojione,btbutton,lineutils,simpleImageUpload,simpleImagesUpload';

	// config.uploadUrl = '../assets/ckeditor/upload.php'; // Kèm theo plugin simpleImageUpload
	// config.extraPlugins = 'simpleImageUpload';

	config.youtube_width = '500';
	config.youtube_height = '480';
	config.youtube_related = true;
	config.youtube_older = false;
	config.youtube_privacy = false;

	config.allowedContent = true;
	config.bootstrapTab_managePopupContent = true;
	config.mj_variables_allow_html = false;
	config.image_removeLinkByEmptyURL = false;

	// config.filebrowserBrowseUrl = '../app/assets/ckfinder/ckfinder.html';
	// config.filebrowserImageBrowseUrl = '../app/assets/ckfinder/ckfinder.html?Type=Images';
	// config.filebrowserFlashBrowseUrl = '../app/assets/ckfinder/ckfinder.html?Type=Flash';
	// config.filebrowserUploadUrl = '../app/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	// config.filebrowserImageUploadUrl = '../app/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	// config.filebrowserFlashUploadUrl = '../app/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
	config.toolbar = [
		['TextColor','BGColor'],//, 'BGColor'
		['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
		// { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		// { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
		{ name: 'links', items: [ 'Link'] },//, 'Unlink', 'Anchor' 
		{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		{ name: 'tools', items: [ 'Maximize' ] },
		{ name: 'document', /*groups: [ 'mode', 'document', 'doctools' ],*/ items: [ 'Source' ] },
		// { name: 'others', items: [ '-' ] },
		// '/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ]
		 , items: [ 'NumberedList', 'BulletedList'] //, '-', 'Outdent', 'Indent', '-', 'Blockquote'
	  },
		{ name: 'styles', items: [ 'Styles', 'Format' ] },
		
		// { name: 'about', items: [ 'About' ] }
	];
	
	// Toolbar groups configuration.
	config.toolbarGroups = [
		// { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		// { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
		// { name: 'links' },
		// { name: 'insert' },
		// { name: 'forms' },
		// { name: 'tools' },
		// { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		// { name: 'others' },
		// '/',
		// { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		// { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		// { name: 'styles' },
		// { name: 'colors' },
		// { name: 'about' }
	];
	config.extraPlugins = "justify";
};
