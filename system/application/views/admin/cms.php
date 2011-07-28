<?php 
	$admin_page = 'cms'; 
	$current_language = $this->lang->lang();
	require_once 'admin-menu.php'; 
?>

<div class="clear"></div>

<h2><?php echo lang('admin.cms'); ?></h2>

<?php foreach ($content as $segment) { ?>
<div class="fright half-box">
	<h3><?php if (lang($segment->key) == '') echo $segment->key; else echo lang($segment->key); ?></h3>
	<form method="post" action="<?php echo site_url('admin/updateContent'); ?>">
	<input name="key" id="key" type="hidden" value="<?php echo $segment->key; ?>" />
	<input name="lang" id="lang" type="hidden" value="<?php echo $current_language; ?>" />
	<textarea rows="20" cols="100" name="value" id="<?php echo $segment->key . '-' . $current_language; ?>"><?php echo $segment->$current_language; ?></textarea><br />
	<div class="buttons"><button class="button" type="submit"><?php echo lang('global.update'); ?></button></div>
	</form>
</div>
<div class="clear"></div>
<?php } ?>

<script type="text/javascript" src="<?php echo site_url('js/tiny_mce/tiny_mce.js'); ?>"></script>

<script type="text/javascript">
tinyMCE.init({
        mode : "textareas",
		theme : "advanced",
		theme_advanced_statusbar_location : 'bottom', 
		theme_advanced_path : false, 
		theme_advanced_resizing : true, 
		plugins : "imagemanager", 
		// Theme options - button# indicated the row# only
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
		theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,insertimage,|,code,removeformat,|,forecolor,backcolor",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_resizing : true
});
</script>
