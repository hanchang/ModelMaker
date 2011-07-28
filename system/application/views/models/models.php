<h2><?php echo lang('global.models'); ?></h2>

<?php $this->load->view('search/search_form_horizontal.php'); ?>

<h3><?php echo lang('home.top_models'); ?></h3>

<?php
$count = 0;
if (empty($results)) {
	echo lang('models.not_found');
}
else {
?>
<h3><?php echo lang('home.newest_models'); ?></h3>
<table border="0" style="padding: 10px; border: 0">
<tr class="center">
<?php 
	foreach($results as $r) { 
		if ($count % 4 == 0) { echo "</tr><tr>\n"; }
		$count++;
		echo "<td class='grid' style='padding:5px'>\n";
		$props = array('src' => "$r->thumb_full");
		echo anchor("profile/view/$r->id", img($props)) . br();
		echo anchor("profile/view/$r->id", $r->name) . br(); 
		echo "$r->height cm, $r->weight kg";
		if ($r->bra_size) {
			echo " ($r->bra_size-$r->waist-$r->hips)";
		}
		echo "</td>\n";
	}
}
?>
</tr>
</table>
