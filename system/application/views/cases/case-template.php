<?php 
function printCases($cases, $accepted_cases, $my_cases, $user_id) {
foreach ($cases as $rc) { ?>
<div class="case border" style="overflow: auto; width: 928px">
	<br />
	<div class="photos" style="float: left; width: 300px; margin-right: 25px;">
		<?php echo img(array('src' => $rc->photo, 'width' => '300')); ?>
	</div>
	
	<div style="float: left; width: 600px">
		<div style="float: left"><h2><?php echo $rc->name; ?></h2></div>
		
		<?php 
			$hasApplied = FALSE;
			foreach ($accepted_cases as $acase) { 
				if ($rc->id == $acase->case_id) { 
					$hasApplied = TRUE;
					echo '<span class="fright">' . lang('case.already_accepted') . "</span>\n"; 
				} 
			}
			foreach ($my_cases as $mycase) { 
				if (!$hasApplied && $rc->id == $mycase->case_id) { 
					$hasApplied = TRUE;
					echo '<span class="fright">' . lang('case.already_applied') . "</span>\n"; 
				}
			}
			if (!$hasApplied && $user_id) { ?>
		<div class="buttons" style="float: right">
			<button type="button" class="positive" onclick='window.location.href="<?php echo site_url("cases/apply/$rc->id"); ?>"'>
			<?php echo img('img/icons/table_edit.png') . ' ' . lang('case.apply_now'); ?></button>
		</div>
		<?php } ?>
		<div class="clear"></div>
		
		<div style="float: left; width: 200px">
			<p><strong><?php echo lang('case.information'); ?></strong></p>
			<?php 
			echo "<p>$rc->client</p>\n";
			echo "<p>$rc->type</p>\n";
			echo "<p>$rc->location</p>\n";
			?>
		</div>
		
		<div style="float: left; width: 200px">
			<p><strong><?php echo lang('case.requirements'); ?></strong></p>
			<?php
			echo lang("profile.$rc->gender_req") . br();
			echo lang('case.greater_than') . ' ' . $rc->height_req . ' cm' . br();
			echo lang('case.less_than') . ' ' . $rc->weight_req . ' kg' . br() . br();
			echo "0 / $rc->models_needed " . lang('case.models_hired'); 
			?>
		</div>
		
		<div style="float: left; width: 200px">
			<p class="blue">
				<strong><?php echo lang('case.event_date'); ?></strong><br />
				<?php echo $rc->case_date . ' ' . $rc->case_time; ?>
			</p>
			<p class="yellow">
				<strong><?php echo lang('case.casting_date'); ?></strong><br />
				<?php echo $rc->casting_date . ' ' . $rc->casting_time; ?>
			</p>
			<p class="red">
				<strong><?php echo lang('case.apply_by'); ?></strong><br />
				<?php echo $rc->application_deadline; ?>
			</p>
		</div>
		
		<div class="clear"></div>
		
		<div>
			<?php if (!empty($rc->details)) { ?>
			<p><strong><?php echo lang('case.details'); ?></strong></p>
			<?php echo $rc->details; } ?>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<?php } // end foreach
} // end function declaration ?>