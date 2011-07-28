<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script src="<?php echo site_url('js/jquery.Jcrop.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo site_url('css/jquery.Jcrop.css'); ?>" type="text/css" />

<script language="Javascript">
	function activateface() {
		$("#img_face").Jcrop({
        	aspectRatio: 1,
        	setSelect: [20, 20, 100, 100],
        	onSelect: function(c) {
				$('#xface').val(c.x);
		    	$('#yface').val(c.y);
		    	$('#wface').val(c.w);
		    	$('#hface').val(c.h);
			}
		});
	}
	function activateupper() {
		$("#img_upper").Jcrop({
        	aspectRatio: 1,
        	setSelect: [20, 20, 100, 100],
        	onSelect: function(c) {
				$('#xupper').val(c.x);
		    	$('#yupper').val(c.y);
		    	$('#wupper').val(c.w);
		    	$('#hupper').val(c.h);
			}
		});
	}
	function activatefull() {
		$("#img_full").Jcrop({
        	aspectRatio: 1,
        	setSelect: [20, 20, 100, 100],
        	onSelect: function(c) {
				$('#xfull').val(c.x);
		    	$('#yfull').val(c.y);
		    	$('#wfull').val(c.w);
		    	$('#hfull').val(c.h);
			}
		});
	}

    $(document).ready(function() {
		$("#tabs").tabs();
		var url = window.location;
		var anchor = url.hash.substring(1);
		if (anchor == '') { anchor = 'face'; }
		$('#img_' + anchor).Jcrop({
        	aspectRatio: 1,
        	setSelect: [20, 20, 100, 100],
        	onSelect: function(c) {
				$('#x' + anchor).val(c.x);
		    	$('#y' + anchor).val(c.y);
		    	$('#w' + anchor).val(c.w);
		    	$('#h' + anchor).val(c.h);
			}
		});
	});
</script>

<h2><?php echo lang('profile.manage_photos'); ?></h2>

<div id="tabs">
	<ul>
		<?php 
		$typelist = array('face', 'upper', 'full');
		foreach ($typelist as $type) { ?>
		<li>
			<a href="<?php echo "#$type"; ?>" onclick="activate<?php echo $type; ?>()">
				<span><?php echo lang("profile.pic_$type"); ?></span>
			</a>
		</li>
		<?php } ?>
	</ul>
<?php 
	foreach ($typelist as $type) { 
	$thumbname = "thumb_$type";
	$varname = "pic_$type"; ?>
	<div id="<?php echo $type; ?>">
		<div style="float: left; width: 400px; padding: 10px">
		<?php 
			echo '<h3>' . lang("profile.pic_$type") . '</h3>';
			if (empty($$varname)) {
				echo lang('profile.no_photos_yet');
			}
			else {
				echo img(array('src' => "img/uploads/${$varname}", 'id' => "img_$type"));
			}
		?>
		</div>
		
		<div style="float: left; width: 400px; padding: 10px">
			<?php 
			echo '<h3>' . lang('profile.thumbnail') . '</h3>';
			if (!empty($$thumbname)) {
				echo img("img/uploads/{$this->tank_auth->get_username()}_{$type}_thumb.jpg");
			}
			else {
				echo lang('profile.no_thumbnail');
			}
			?>
		</div>
		
		<div class="clear"></div>
		
		<div style="float: left; width: 400px; padding: 10px">
		<h3><?php echo lang('profile.upload_photo'); ?></h3>
		<?php if (empty($pic_{$type})) { echo "Choose a photo and upload!"; } else { echo "You can update your photo if you wish."; } ?>
		<?php $attributes = array('class' => '', 'id' => 'form_' . $varname, 'name' => 'form_' . $varname);
		echo form_open_multipart("profile/upload_pic/$type", $attributes); ?>
			<input id="<?php echo $varname; ?>" name="<?php echo $varname; ?>" type="file" value="<?php echo set_value($varname); ?>" />
			<div class="buttons" style="margin-top: 20px; padding: 10px;">
				<button type="submit" class="positive">
					<?php echo img('img/icons/photo_add.png') . ' ' . lang('profile.upload_photo'); ?>
				</button>
			</div>
		</form>
		</div>
		
		<?php if (!empty($$varname)) { ?>
		<div style="float: left; width: 400px; padding: 10px">
			<h3><?php echo lang('profile.crop_photo'); ?></h3>
			<p>Please select a thumbnail from your picture on the left, the click the button below.</p>
			<form action="<?php echo site_url("profile/crop_pic/$type"); ?>" method="post">
				<input id="x<?php echo $type; ?>" name="x<?php echo $type; ?>" type="hidden" value="" />
				<input id="y<?php echo $type; ?>" name="y<?php echo $type; ?>" type="hidden" value="" />
				<input id="h<?php echo $type; ?>" name="h<?php echo $type; ?>" type="hidden" value="" />
				<input id="w<?php echo $type; ?>" name="w<?php echo $type; ?>" type="hidden" value="" />
				<div class="buttons" style="margin-top: 20px; padding: 10px;">
					<button type="submit" class="positive">
						<?php echo img('img/icons/picture_go.png') . ' ' . lang('profile.crop_photo'); ?>
					</button>
				</div>
			</form>
		</div>
		<?php } ?>
		
		<div class="clear"></div>
	</div>
	<?php } ?>
</div>
