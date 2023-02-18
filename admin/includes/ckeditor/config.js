/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
                                                            
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' , groups: [ 'maximize', 'showblocks', 'iframe' ] },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
//		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
    { name: 'colors' },
		{ name: 'styles' , groups: [ 'styles', 'format', 'font', 'fontSize' ]}
		
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
  config.skin = 'moono-lisa';
  config.uiColor = '#eeeeee';
  config.entities = false;  // no encode greek

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
  
//  config.extraPlugins = 'uploadwidget';
 // config.extraPlugins = 'videodetector';
//  config.extraPlugins = 'uploadimage';   

  config.extraPlugins = 'sourcedialog';     
  config.extraPlugins = 'justify';   
  config.extraPlugins = 'btgrid';
  config.extraPlugins = 'iframe';

//  config.extraPlugins = 'font';  - WE SET IT INSIDE FILES! extraPlugins: 'sourcedialog,colorbutton,font',
  
  config.allowedContent = true;
  CKEDITOR.dtd.$removeEmpty.i = 0;
  CKEDITOR.dtd.$removeEmpty.span = 0;
  config.uploadUrl = 'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json';
};
