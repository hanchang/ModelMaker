<?php include 'admin-menu.php'; ?>

<div class="half-box">
<h2><?php echo lang("case.$page"); ?></h2>
<?php echo form_open_multipart('admin/update_case'); ?>
	<input id="id" name="id" type="hidden" value="<?php isset($id) ? print $id : print set_value('id'); ?>" />
	<table cellpadding="5">
		<tr>
			<td><?php echo lang('case.name'); ?></td>
			<td><input id="name" name="name" type="text" value="<?php isset($name) ? print $name : print set_value('name'); ?>" /></td>
		</tr>
		<tr>
			<td><?php echo lang('case.client'); ?></td>
			<td><input id="client" name="client" type="text" value="<?php isset($client) ? print $client : print set_value('client'); ?>" /></td>
		</tr>
		<tr>
			<td><?php echo lang('case.type'); ?></td>
			<td><input id="type" name="type" type="text" value="<?php isset($type) ? print $type : print set_value('type'); ?>" /></td>
		</tr>
		<tr>
			<td><?php echo lang('case.case_date'); ?></td>
			<td>
				<select id="case_month" name="case_month">
					<?php $months = range(1, 12); foreach ($months as $month) { ?>
					<option value="<?php echo $month; ?>"
						<?php if (isset($case_month) && $case_month == $month) echo set_select('case_month', $month, TRUE); ?>><?php echo $month; ?></option>
					<?php } ?>
				</select>
				<select id="case_day" name="case_day">
					<?php $days = range(1, 31); foreach ($days as $day) { ?>
					<option value="<?php echo $day; ?>"
						<?php if (isset($case_day) && $case_day == $day) echo set_select('case_day', $day, TRUE); ?>><?php echo $day; ?></option>
					<?php } ?>
				</select>
				<select id="case_year" name="case_year">
					<?php $years = range(date('Y'), 2050); foreach ($years as $year) { ?>
					<option value="<?php echo $year; ?>"
						<?php if (isset($case_year) && $case_year == $year) echo set_select('case_year', $year, TRUE); ?>><?php echo $year; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo lang('case.case_time'); ?></td>
			<td>
				<select id="case_hour" name="case_hour">
					<?php $hours = range(0, 23); foreach ($hours as $hour) { ?>
					<option value="<?php echo $hour; ?>"
						<?php if (isset($case_hour) && $case_hour == $hour) echo set_select('case_hour', $hour, TRUE); ?>><?php echo $hour; ?></option>
					<?php } ?>
				</select>
				<select id="case_minute" name="case_minute">
					<?php $minutes = range(00, 59); foreach ($minutes as $minute) { if ($minute % 5 == 0) { ?>
					<option value="<?php echo $minute; ?>"
						<?php if (isset($case_minute) && $case_minute == $minute) echo set_select('case_minute', $minute, TRUE); ?>>
						<?php if ($minute < 10) { echo 0; } echo $minute; ?>
					</option>
					<?php }} ?>
				</select>
		</tr>
		<tr>
			<td><?php echo lang('case.location'); ?></td>
			<td><input id="location" name="location" type="text" /></td>
		</tr>
		<tr>
			<td><?php echo lang('case.models_needed'); ?></td>
			<td><input id="models_needed" name="models_needed" type="text" /></td>
		</tr>
		<tr>
			<td><?php echo lang('case.payrate'); ?></td>
			<td><input id="payrate" name="payrate" type="text" /> 元</td>
		</tr>
		<tr>
			<td><?php echo lang('case.height_req'); ?> </td>
			<td><input id="height_req" name="height_req" type="text" /> cm</td>
		</tr>
		<tr>
			<td><?php echo lang('case.weight_req'); ?> </td>
			<td><input id="weight_req" name="weight_req" type="text" /> kg</td>
		</tr>
		<tr>
			<td><?php echo lang('case.gender_req'); ?> </td>
			<td>
				<input id="gender_req" name="gender_req" type="radio" value="male" /><?php echo lang('case.male'); ?>
				<input id="gender_req" name="gender_req" type="radio" value="female" /><?php echo lang('case.female'); ?>
				<input id="gender_req" name="gender_req" type="radio" value="any" /><?php echo lang('case.any'); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo lang('case.casting_date'); ?></td>
			<td>
				<select id="casting_month" name="casting_month">
					<?php $months = range(1, 12); foreach ($months as $month) { ?>
					<option value="<?php echo $month; ?>"
						<?php if (isset($casting_month) && $casting_month == $month) echo set_select('casting_month', $month, TRUE); ?>><?php echo $month; ?></option>
					<?php } ?>
				</select>
				<select id="casting_day" name="casting_day">
					<?php $days = range(1, 31); foreach ($days as $day) { ?>
					<option value="<?php echo $day; ?>"
						<?php if (isset($casting_day) && $casting_day == $day) echo set_select('casting_day', $day, TRUE); ?>><?php echo $day; ?></option>
					<?php } ?>
				</select>
				<select id="casting_year" name="casting_year">
					<?php $years = range(date('Y'), 2050); foreach ($years as $year) { ?>
					<option value="<?php echo $year; ?>"
						<?php if (isset($casting_year) && $casting_year == $year) echo set_select('casting_year', $year, TRUE); ?>><?php echo $year; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo lang('case.casting_time'); ?> </td>
			<td>
				<select id="casting_time_hour" name="casting_time_hour">
					<?php $hours = range(0, 23); foreach ($hours as $hour) { ?>
					<option value="<?php echo $hour; ?>"
						<?php if (isset($casting_time_hour) && $casting_time_hour == $hour) echo set_select('casting_time_hour', $hour, TRUE); ?>><?php echo $hour; ?></option>
					<?php } ?>
				</select>
				<select id="casting_time_minute" name="casting_time_minute">
					<?php $minutes = range(00, 59); foreach ($minutes as $minute) { if ($minute % 5 == 0) { ?>
					<option value="<?php echo $minute; ?>"
						<?php if (isset($casting_time_minute) && $casting_time_minute == $minute) echo set_select('casting_time_minute', $minute, TRUE); ?>>
						<?php if ($minute < 10) { echo 0; } echo $minute; ?>
					</option>
					<?php }} ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo lang('case.casting_location'); ?> </td>
			<td><input id="casting_location" name="casting_location" type="text" /></td>
		</tr>
		<tr>
			<td><?php echo lang('case.application_deadline'); ?></td>
			<td>
				<select id="deadline_month" name="deadline_month">
					<?php $months = range(1, 12); foreach ($months as $month) { ?>
					<option value="<?php echo $month; ?>"
						<?php if (isset($deadline_month) && $deadline_month == $month) echo set_select('deadline_month', $month, TRUE); ?>><?php echo $month; ?></option>
					<?php } ?>
				</select>
				<select id="deadline_day" name="deadline_day">
					<?php $days = range(1, 31); foreach ($days as $day) { ?>
					<option value="<?php echo $day; ?>"
						<?php if (isset($deadline_day) && $deadline_day == $day) echo set_select('deadline_day', $day, TRUE); ?>><?php echo $day; ?></option>
					<?php } ?>
				</select>
				<select id="deadline_year" name="deadline_year">
					<?php $years = range(date('Y'), 2050); foreach ($years as $year) { ?>
					<option value="<?php echo $year; ?>"
						<?php if (isset($deadline_year) && $deadline_year == $year) echo set_select('deadline_year', $year, TRUE); ?>><?php echo $year; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo lang('case.details'); ?></td>
			<td><textarea name="details" rows="10" cols="50"></textarea></td>
		</tr>
		<tr>
			<td><?php echo lang('case.photo'); ?></td>
			<td><?php echo form_upload(array('id' => 'photo', 'name' => 'photo', 'value' => 'photo')); ?></td>
		</tr>
	</table>
	
	<div class="buttons">
		<button type="submit" class="positive"><?php echo img('img/icons/calendar_add.png'); ?> Add Case</button>
	</div>
</form>
</div>