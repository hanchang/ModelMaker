<h2><?php echo lang('case.cases'); ?></h2>

<?php 
	require_once 'case-template.php';
	
	echo '<h3 class="center">' . lang('case.upcoming_cases') . "</h3>\n"; 
	if (empty($upcoming_cases)) {
		echo '<p>' . lang('case.no_upcoming') . "</p>\n";
	}
	else {
		printCases($upcoming_cases, $accepted_cases, $my_cases, $user_id);
	}
	
	echo '<h3 class="center">' . lang('case.past_cases') . "</h3>\n";
	if (empty($past_cases)) {
		echo '<p>' . lang('case.no_past') . "</p>\n";
	}
	else {
		printCases($past_cases, $accepted_cases, $my_cases, $user_id);
	}
?>