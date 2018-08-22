<?php
	require_once "support/web_browser.php";
	require_once "support/tag_filter.php";

	// Retrieve the standard HTML parsing array for later use.
	$htmloptions = TagFilter::GetHTMLOptions();
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 900);
	// Retrieve a URL (emulating Firefox by default).
	 
		
		$url = "https://collegedunia.com/college/4192-shaheed-bhagat-singh-college-new-delhi";
		$web = new WebBrowser();
		$result = $web->Process($url);

		// Check for connectivity and response errors.
		if (!$result["success"])
		{
			echo "Error retrieving URL.  " . $result["error"] . "\n";
			exit();
		}

		if ($result["response"]["code"] != 200)
		{
			echo "Error retrieving URL.  Server returned:  " . $result["response"]["code"] . " " . $result["response"]["meaning"] . "\n";
			exit();
		}

		// Get the final URL after redirects.
		$baseurl = $result["url"];

		// Use TagFilter to parse the content.
		$html = TagFilter::Explode($result["body"], $htmloptions);

		// Retrieve a pointer object to the root node.
		$root = $html->Get();



		// Find all anchor tags.
		//echo "All the URLs:\n";
		$rows = $root->Find("div.address row");
		print_r($rows);exit;

		// foreach ($rows as $row)
		// {
		// 	//echo $row;
		// 	//$url2= $row->href;
		// 	//echo $url2;exit;
		// 	$array=array();
		// 	$array['college_name']=$row->GetInnerHTML();
		// 	$array['college_link']=$row->href;

			
		// 	$file = fopen("/home/ashutosh/Documents/college_data.csv","a");
		// 	fputcsv($file,$array);
		// 	fclose($file);
		// 	//echo "\t" . HTTP::ConvertRelativeToAbsoluteURL($baseurl, $row->href) . "\n";
		// }

		// // Find all table rows that have 'th' tags.
		// $rows = $root->Find("tr")->Filter("th");
		// foreach ($rows as $row)
		// {
		// 	echo "\t" . $row->GetOuterHTML() . "\n\n";
		// }
	
?>