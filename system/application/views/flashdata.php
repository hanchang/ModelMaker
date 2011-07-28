<?php if ($this->session->flashdata('positive_message') != '') {
	echo "<div class='positive'>" . $this->session->flashdata('positive_message') . "</div>\n"; 
}?>

<?php if ($this->session->flashdata('error_message') != '') {
	echo "<div class='negative'>" . $this->session->flashdata('error_message') . "</div>\n"; 
}?>

<?php if ($this->session->flashdata('info_message') != '') {
	echo "<div class='info'>" . $this->session->flashdata('info_message') . "</div>\n"; 
}?>