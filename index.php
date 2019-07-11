<?php
	$people = array(
		array('id'=>1, 'first_name'=>'John', 'last_name'=>'Smith', 'email'=>'john.smith@hotmail.com'),
		array('id'=>2, 'first_name'=>'Paul', 'last_name'=>'Allen', 'email'=>'paul.allen@microsoft.com'),
		array('id'=>3, 'first_name'=>'James', 'last_name'=>'Johnston', 'email'=>'james.johnston@gmail.com'),
		array('id'=>4, 'first_name'=>'Steve', 'last_name'=>'Buscemi', 'email'=>'steve.buscemi@yahoo.com'),
		array('id'=>5, 'first_name'=>'Doug', 'last_name'=>'Simons', 'email'=>'doug.simons@hotmail.com')
	);

	$document = new DOMDocument();
	$document->preserveWhiteSpace = true;
	$document->formatOutput = true;
	libxml_use_internal_errors(true);
	$document->loadHTML("<!DOCTYPE html>");

	$html = $document->createElement("html");
	$html->setAttribute("lang", "en-CA");
	$document->appendChild($html);

	$meta = $document->createElement("meta");
	$meta->setAttribute("charset", "UTF-8");

	$title = $document->createElement("title");
	$title->nodeValue = "Application Test";

	$css = $document->createElement("style");
	$css->nodeValue = "body { font-family:Arial;font-size:12pt; }\n"
		. ".tbl { border-collapse:collapse; }\n"
		. "th, td { border:solid 1px #000000;padding:5px; }\n"
		. "button { border:none;border-radius:5px; }\n"
		. "thead tr, button { background-color:#336699;color:#ffffff; }\n"
		. "tbody tr:nth-child(even) { background-color:#dfdfdf; }";

	$js = $document->createElement("script");
	$js->nodeValue = "function showPerson(n,e) { alert('Name: ' + n + '\\nEmail: ' + e); };";

	$head = $document->createElement("head");
	$head->appendChild($meta);
	$head->appendChild($title);
	$head->appendChild($css);
	$head->appendChild($js);

	$tbl = $document->createElement("table");	
	$tbl->setAttribute("class", "tbl");

	$caption = $document->createElement("caption");
	$caption->nodeValue = "Application Test - Table";
	$tbl->appendChild($caption);

	$thead = $document->createElement("thead");
	$tbl->appendChild($thead);

	$tbody = $document->createElement("tbody");
	$tbl->appendChild($tbody);

	$rows = 0;
	foreach($people as $person)
	{
		if($rows == 0)
		{
			$tr = $document->createElement("tr");
			foreach($person as $key=>$value)
			{
				$th = $document->createElement("th");
				$th->nodeValue = $key;
				$tr->appendChild($th);
			}

			$th = $document->createElement("th");
			$th->nodeValue = "&nbsp;";
			$tr->appendChild($th);

			$thead->appendChild($tr);
		}
		$tr = $document->createElement("tr");

		$name = $person["first_name"] . " " . $person["last_name"];

		$btn = $document->createElement("button");
		$btn->setAttribute("onclick", "showPerson('$name','" . $person["email"] . "')");
		$btn->nodeValue = "Click Me";

		$td = $document->createElement("td");
		$td->nodeValue = $person["id"];
		$tr->appendChild($td);

		$td = $document->createElement("td");
		$td->nodeValue = $person["first_name"];
		$tr->appendChild($td);

		$td = $document->createElement("td");
		$td->nodeValue = $person["last_name"];
		$tr->appendChild($td);

		$td = $document->createElement("td");
		$td->nodeValue = $person["email"];
		$tr->appendChild($td);

		$td = $document->createElement("td");
		$td->appendChild($btn);
		$tr->appendChild($td);

		$tbody->appendChild($tr);
		$rows++;
	}

	$body = $document->createElement("body");
	$body->appendChild($tbl);
	$html->appendChild($body);

	echo $document->saveHTML();
?>
