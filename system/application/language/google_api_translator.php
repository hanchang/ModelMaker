<?php

function extractDefinition($def) {
	$def = trim($def);
	$def = str_replace(';', '', $def);
	$def = str_replace("'", '', $def);
	$def = str_replace('"', '', $def);
	$def = str_replace(' ', '+', $def);
	return $def;
}

$langfiles = array('admin', 'global', 'home', 'profile', 'search');
$language = 'zh-CN';
// $language = 'zh-TW';

foreach ($langfiles as $lf) {
	// Read in a language file.
	$input_fh = fopen("english/{$lf}_lang.php", 'r');
	$output_fh = fopen("chinese/{$lf}_lang.php", 'w');
	fwrite($output_fh, "<?php\n");

	// Parse each line.
	while ($line = fgets($input_fh)) {
		if ($line == "\n" || strpos($line, '<?') !== FALSE) { continue; }
		$line_parts = explode(' = ', $line);
		// print_r($line_parts);
		$query = extractDefinition($line_parts[1]);
		echo "\n$query\n";

		$url = "https://ajax.googleapis.com/ajax/services/language/translate?" .
       "v=1.0&q=$query&langpair=en%7C$language&key=ABQIAAAAI2n1t2CkDCFQlSIJVgaYCBSZf9mMLfpKTszrFm6B3HJl4nXKRBQ5hbk4EEAQl3tuddEvPlCT67dCgg&userip=10.177.6.242";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, 'http://modelmaker.pillarofeden.com');
		$body = curl_exec($ch);
		curl_close($ch);

		$json = json_decode($body);
		// print_r($json);
		if (isset($json->responseData)) {
			if (isset($json->responseData->translatedText)) {
				// Output to file.
				$output = $line_parts[0] . " = '" . $json->responseData->translatedText . "';\n";
				fwrite($output_fh, $output);
			}
		}

		sleep(rand(3, 10));
	}
}
