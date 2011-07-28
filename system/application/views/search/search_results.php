<h2><?php echo lang('search.results'); ?></h2>

<?php
if (empty($results)) {
	echo lang('search.not_found');
}
else {
?>
<table id="search-results">
	<tr>
		<th><?php echo lang('profile.name'); ?></th>
		<th><?php echo lang('profile.pic_full'); ?></th>
		<th><?php echo lang('profile.gender'); ?></th>
		<th><?php echo lang('profile.ethnicity'); ?></th>
		<th><?php echo lang('profile.height'); ?></th>
		<th><?php echo lang('profile.weight'); ?></th>
		<th><?php echo lang('profile.hair_color'); ?></th>
		<th><?php echo lang('profile.hair_length'); ?></th>
	</tr>
<?php 
	foreach($results as $r) {
		$this->load->view('search/result_view', $r);
	}
}
?>
</table>