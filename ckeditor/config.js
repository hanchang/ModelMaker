/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar = 'Custom';
	config.toolbar_Custom =
	[
		['Save'], ['Undo','Redo','-','Bold','Italic','Underline','Strike'],
		['NumberedList','BulletedList'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], ['Source'],
		['Link','Unlink','RemoveFormat'],
		['Image','Table','HorizontalRule','Smiley','SpecialChar'],
		['Styles','Format','Font','FontSize','-','TextColor','BGColor'],
	];
};
