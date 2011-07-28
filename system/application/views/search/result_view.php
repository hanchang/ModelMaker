<tr>
	<td><?php echo anchor("profile/view/$id", $name); ?></td>
	<td><?php $props = array('src' => "img/uploads/$pic_full", 'width' => 250); 
		echo anchor("profile/view/$id", img($props)); ?></td>
	<td><?php echo lang("profile.$gender"); ?></td>
	<td><?php echo lang("profile.$ethnicity"); ?></td>
	<td><?php echo $height; ?> cm</td>
	<td><?php echo $weight; ?> kg</td>
	<td><?php echo lang("profile.$hair_color"); ?></td>
	<td><?php echo lang("profile.$hair_length"); ?></td>
</tr>