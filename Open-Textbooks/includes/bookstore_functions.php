
<?php
//Bookstore functions: functions for querying bookstores.
//Got rid of bookstores that aren't follett or b&n


function format_item($item) //returns an item result with the proper formatting
{

	$format_arr = array('Necessity', 'Title', 'Edition', 'Authors', 'Publisher');
	
	foreach ($format_arr as $name)
	{
		if (isset                         ($item[$name]) && $item[$name])
		{
			$item[$name] = ucwords(strtolower(trim($item[$name], " \t\n\r\0\x0B\xA0")));
		}
	}
	if (isset($item['Year']) && $item['Year'])
	{
		$item['Year'] = date('Y', strtotime(trim($item['Year'])));
	}
	if (isset($item['ISBN']) && $item['ISBN'])
	{
		$item['ISBN'] = get_ISBN13(str_replace('&nbsp;', '', trim($item['ISBN'])));
	}
	if (isset($item['Bookstore_Price']) && $item['Bookstore_Price'])
	{
		$item['Bookstore_Price'] = priceFormat($item['Bookstore_Price']);
	}
	
	if (isset($item['New_Price']) && $item['New_Price'])
	{
		$item['New_Price'] = priceFormat($item['New_Price']);
	}
	if (isset($item['Used_Price']) && $item['Used_Price'])
	{
		$item['Used_Price'] = priceFormat($item['Used_Price']);
	}
	if (isset($item['New_Rental_Price']) && $item['New_Rental_Price'])
	{
		$item['New_Rental_Price'] = priceFormat($item['New_Rental_Price']);
	}
	if (isset($item['Used_Rental_Price']) && $item['Used_Rental_Price'])
	{
		$item['Used_Rental_Price'] = priceFormat($item['Used_Rental_Price']);
	}
	return $item;
}
function format_dropdown($dropdown) //takes a dropdown array include name and value.  also instructor sometimes in the case of class.
{
	//ucwords term_name and class_code
	$title_caps = array('Term_Name', 'Class_Code');
	foreach ($dropdown as $name => $val)
	{
		if (is_array($val)) //so we can get sections, or really anything, recursively.
		{
			$dropdown[$name] = format_dropdown($val);
		}
		else
		{
			$dropdown[$name] = trim($val); //trim everything
			
			if (in_array($name, $title_caps))
			{
				$dropown[$name] = ucwords($val); 
			}
		}
	}
	
	return $dropdown;
}

function get_classes_and_items_from_follett($valuesArr)
{
	
	//We hardcode Program_Value and Campus_Value in the Campuses table because they are campus-specific and pretty much static.  Division_Value varies and is sometimes like a higher level department, so we give it it's own table..
	
	$returnArray = array();
	$url = $valuesArr['Fetch_URL'] . 'webapp/wcs/stores/servlet/';
	$referer = $valuesArr['Storefront_URL'];
	
	//We need to set these to empty or spaces appropraitely, because Follet expects them even when they aren't existent. 
	if (!$valuesArr['Campus_Value'])
	{
		//Do all Follett schools have Campus_Values?  Answer: No, some do not.  And in fact, when they don't have it it's not even sent as a parameter.  To simplify things we just set it as an empty string for those cases..
		$valuesArr['Campus_Value'] = '';
	}
	if (isset($valuesArr['Division_ID']) && !$valuesArr['Division_Value'])
	{
		//We set it to " " (a space) when it's not there, cus it needs to be sent.
		$valuesArr['Division_Value'] = ' ';
	}
	
	//Note: Follett schools *always* have a Program_Value.  When they don't have a real world one, the store adds one with the display name "ALL".	
	
	//Initial request to start the session with follett if we haven't already.. Follett won't let you do anything w/o one... 
	if (!isset($valuesArr['Class_ID'])) //note that we only need to do this for the dropdowns, not for booklook, which is on a seperate HEOA page which doesn't require a session.
	{
		$options = array(CURLOPT_URL => $valuesArr['Storefront_URL'], CURLOPT_HTTPPROXYTUNNEL => true, CURLOPT_PROXY => PROXY_1, CURLOPT_PROXYUSERPWD => PROXY_1_AUTH);
		
		$response = curl_request($options); //query the main page to pick up the cookies
		
		if (!$response)
		{
			echo "Something!";
			throw new Exception('Unable to fetch Follett Storefront for session with values '. print_r($valuesArr, true));
		}else{
			echo "Not connected to follett";
		}
	}
		
	//Prepare for the request and its handling depending on whats up next..
	if (!isset($valuesArr['Term_ID']))
	{
		$url .= 'LocateCourseMaterialsServlet?demoKey=d&programId='. urlencode($valuesArr['Program_Value']) . '&requestType=TERMS&storeId=' . urlencode($valuesArr['Store_Value']);
		
		$response_name = 'TERMS';
		$display_name = 'Term_Name';
		$value_name = 'Term_Value';
	}
	else if (!isset($valuesArr['Division_ID']))
	{							
	
		//The divisions request is always sent, even when there aren't any.  	//http://www.bkstr.com/webapp/wcs/stores/servlet/LocateCourseMaterialsServlet?requestType=DIVISIONS&storeId=10415&demoKey=d&programId=727&termId=100019766&_=
		
		$url .= 'LocateCourseMaterialsServlet?requestType=DIVISIONS&storeId='. urlencode($valuesArr['Store_Value']) . '&campusId='. urlencode($valuesArr['Campus_Value']) .'&demoKey=d&programId='. urlencode($valuesArr['Program_Value']) .'&termId='. $valuesArr['Term_Value'];
		
		$response_name = 'DIVISIONS';
		$display_name = 'Division_Name';
		$value_name = 'Division_Value';
	}
	else if (!isset($valuesArr['Department_ID']))
	{
		$url .= 'LocateCourseMaterialsServlet?demoKey=d&divisionName='. urlencode($valuesArr['Division_Value']) .'&campusId='. urlencode($valuesArr['Campus_Value']) .'&programId='. urlencode($valuesArr['Program_Value']) .'&requestType=DEPARTMENTS&storeId='. urlencode($valuesArr['Store_Value']) .'&termId='. urlencode($valuesArr['Term_Value']);
		
		$response_name = 'DEPARTMENTS';
		$display_name = 'Department_Code';
		$value_name = 'Department_Value';
	}
	else if (!isset($valuesArr['Course_ID']))
	{	
		$url .= 'LocateCourseMaterialsServlet?demoKey=d&divisionName='. urlencode($valuesArr['Division_Value']).'&campusId='. urlencode($valuesArr['Campus_Value']) .'&programId='. urlencode($valuesArr['Program_Value']) .'&requestType=COURSES&storeId='. urlencode($valuesArr['Store_Value']) .'&termId='. urlencode($valuesArr['Term_Value']) .'&departmentName='. urlencode($valuesArr['Department_Code']). '&_=';
		
		$response_name = 'COURSES';
		$display_name = 'Course_Code';
		$value_name = 'Course_Value';
	}
	else if (!isset($valuesArr['Class_ID']))
	{
		$url .= 'LocateCourseMaterialsServlet?demoKey=d&divisionName='. urlencode($valuesArr['Division_Value']) .'&programId='. urlencode($valuesArr['Program_Value']) .'&requestType=SECTIONS&storeId='. urlencode($valuesArr['Store_Value']) .'&termId='. urlencode($valuesArr['Term_Value']) .'&departmentName='. urlencode($valuesArr['Department_Code']). '&courseName='. urlencode($valuesArr['Course_Code']) .'&_=';
		
		$response_name = 'SECTIONS';
		$display_name = 'Class_Code';
		$value_name = 'Class_Value';
	}
	else
	{	
		//class books query.. it's special.
		$url .= 'booklookServlet?bookstore_id-1='. urlencode($valuesArr['Follett_HEOA_Store_Value']) .'&term_id-1='. urlencode($valuesArr['Follett_HEOA_Term_Value']) .'&div-1='. urlencode($valuesArr['Division_Value']) . '&dept-1='. urlencode($valuesArr['Department_Value']) . '&course-1='. urlencode($valuesArr['Course_Value']) .'&section-1='. urlencode($valuesArr['Class_Value']);
	}
	
	//make the request and reutrn the response
	$response = curl_request(array(CURLOPT_URL => $url, CURLOPT_REFERER => $referer, CURLOPT_HTTPPROXYTUNNEL => true, CURLOPT_PROXY => PROXY_1, CURLOPT_PROXYUSERPWD => PROXY_1_AUTH));
	
	if ($response)
	{
		$doc = new DOMDocument();
		@$doc->loadHTML($response); //because their HTML is imperfect
	
		if (!isset($valuesArr['Class_ID'])) //dropdown response..
		{	
			//example $response: <script>parent.doneLoaded('{"meta":[{"request":"TERMS","skip":"false","campusActive":"true","progActive":"true","termActive":"true","size":"3"}],"data":[{"FALL 2011":"100019766","WINTER 2011-2012":"100021395","SPRING 2012":"100021394"}]}')</script>
			
			$script = $doc->getElementsByTagName('script');
			
			if ($script->length != 0)
			{
				$script = $script->item(0)->nodeValue;
						
				preg_match("/'[^']+'/", $script, $matches);
				
				$json = substr($matches[0], 1, -1);
				
				$json = json_decode($json, true);
				
				if (isset($json['meta'][0]['request']) && $json['meta'][0]['request'] == $response_name)
				{
					foreach ($json['data'][0] as $key => $value)
					{	
						$returnArray[] = array($display_name => $key, $value_name => $value);
					}
				}
				else
				{
					throw new Exception('Request for URL: '. $url . ' gave inappropriate response: '. $script .' with values '. print_r($valuesArr, true));
				}
			}
			else
			{
				throw new Exception('Missing script response with values '. print_r($valuesArr, true));
			}
		}
		
		else //class-book response from Follett's booklook system
		{	
			$finder = new DomXPath($doc);
			
			$error_tag = $finder->query('//*[@class="error"]'); //sometimes errors are in an <h2>, sometimes in a <p>, it depends on the error.
			
			//when there are no results (but the request is valid), there is also a class="error" tag, but its directly inside //div[@class="paddingLeft1em results"]/ .  So this will return $returnArray('class_id' => whatever, 'items' => array()) as its supposed to. 
			
			if ($error_tag->length != 0)
			{
				$error = $error_tag->item(0)->nodeValue;
					
				if (!stripos($error, 'to be determined') && !stripos($error, 'no course materials required') && !stripos($error, 'no information received')) //these are the two exceptions where there genuinely are 0 results.
				{		
					throw new Exception('Error: '. $error .' on Follett booklook with values '. print_r($valuesArr, true)); //we report the specific error that Follett's booklook gives us.
				}
			}
			$results = $finder->query('//div[@class="paddingLeft1em results"]/*');
			
			$items = array();
			$i = 0; //counter for $items
			foreach ($results as $resultNode)
			{
				if ($resultNode->nodeName == 'h2')
				{
					$necessity = $resultNode->nodeValue;
				}
				else if ($resultNode->nodeName == 'h3' && $resultNode->getAttribute('class') == 'paddingChoice')
				{
					$necessity = 'Choose One';
				}
				else if ($resultNode->nodeName == 'div' && $resultNode->getAttribute('class') == 'paddingLeft5em')
				{
					$resultLIs = $finder->query('.//ul/li', $resultNode);
					foreach ($resultLIs as $resultLI)
					{
						$span = $resultLI->getElementsByTagName('span');
						if ($span->length)
						{
							$resultLI->removeChild($span->item(0));
						}
						$result = explode(':', $resultLI->nodeValue);
						$items[$i]['Necessity'] = $necessity;
						switch (strtolower(trim($result[0])))
						{
							case 'title':
								$items[$i]['Title'] = $result[1];
								break;
							case 'author':
								$items[$i]['Authors'] = $result[1];
								break;
							case 'edition':
								$items[$i]['Edition'] = $result[1];
								break;
							case 'copyright year':
								$items[$i]['Year'] = $result[1];
								break;
							case 'publisher':
								$items[$i]['Publisher'] = $result[1];
								break;
							case 'isbn':
								$items[$i]['ISBN'] = $result[1];
								break;
							case 'new':
								$items[$i]['Bookstore_Price'] = $result[1];
								$items[$i]['New_Price'] = $result[1];
								break;
							case 'used':
								$items[$i]['Used_Price'] = $result[1];
								if (!isset($items[$i]['Bookstore_Price']))
								{
									$items[$i]['Bookstore_Price'] = $result[1];
								}
								break;
						}
					}
					$i++;
				}
			}
		
			$returnArray['Class_ID'] = $valuesArr['Class_ID'];
			$returnArray['items'] = $items; //trim them all
		}
		
		return $returnArray;
	}
	else
	{
		throw new Exception("No response with values ". print_r($valuesArr, true));
	}
}
function get_classes_and_items_from_bn($valuesArr)
{
	if (isset($valuesArr['Term_ID']) && !isset($valuesArr['Division_ID']))
	{
		return array(); //because BN doesn't have Division values.
	}
	
	$url = $valuesArr['Fetch_URL'] . 'webapp/wcs/stores/servlet/';
	
	$referer = $url . 'TBWizardView?catalogId=10001&storeId='. $valuesArr['Store_Value'] .'&langId=-1';
	
	if (!isset($valuesArr['Class_ID']))
	{
		//make initialization request if they don't have a session yet...
		curl_request(array(CURLOPT_URL => $valuesArr['Storefront_URL'], CURLOPT_COOKIESESSION => true, CURLOPT_PROXY => PROXY_2, CURLOPT_PROXYUSERPWD => PROXY_2_AUTH));
		
		//pt 2 of initialization is requesting the textbook lookup page
		$options = array(CURLOPT_URL => $referer, CURLOPT_PROXY => PROXY_2, CURLOPT_PROXYUSERPWD => PROXY_2_AUTH);
		
		$response = curl_request($options);
		
		if (!$response)
		{
			throw new Exception('Failed to initialize the BN session with values '. print_r($valuesArr, true));
		}
		
		//prepare appropriate dropdown query depending on what they're trying to get...
		if (!isset($valuesArr['Term_ID']))
		{
			//We're doing this Multiple_Campuses thing for now, until we improve the system..
			if ($valuesArr['Multiple_Campuses'] == 'Y') //they have a campus dropdown.
			{
				$url .= 'TextBookProcessDropdownsCmd?campusId='. $valuesArr['Campus_Value'] .'&termId=&deptId=&courseId=&sectionId=&storeId='. $valuesArr['Store_Value'] .'&catalogId=10001&langId=-1&dojo.transport=xmlhttp&dojo.preventCache='. time();
			}
			else
			{
				$url = $referer;
			}
		}
		else if (!isset($valuesArr['Department_ID']))
		{
			$url .= 'TextBookProcessDropdownsCmd?campusId='. $valuesArr['Campus_Value'] .'&termId='. $valuesArr['Term_Value'] .'&deptId=&courseId=&sectionId=&storeId='. $valuesArr['Store_Value'] .'&catalogId=10001&langId=-1&dojo.transport=xmlhttp&dojo.preventCache='. time();
		}
		else if (!isset($valuesArr['Course_ID']))
		{
			$url .= 'TextBookProcessDropdownsCmd?campusId='. $valuesArr['Campus_Value'] .'&termId='. $valuesArr['Term_Value'] .'&deptId='. $valuesArr['Department_Value'] .'&courseId=&sectionId=&storeId='. $valuesArr['Store_Value'] . '&catalogId=10001&langId=-1&dojo.transport=xmlhttp&dojo.preventCache='. time();
		}
		else if (!isset($valuesArr['Class_ID']))
		{
			$url .= 'TextBookProcessDropdownsCmd?campusId='. $valuesArr['Campus_Value'] .'&termId='. $valuesArr['Term_Value'] .'&deptId='. $valuesArr['Department_Value'] .'&courseId='. $valuesArr['Course_Value'] .'&sectionId=&storeId='. $valuesArr['Store_Value'] . '&catalogId=10001&langId=-1&dojo.transport=xmlhttp&dojo.preventCache='. time();
		}
		
		$options = array(CURLOPT_URL => $url, CURLOPT_REFERER => $referer, CURLOPT_PROXY => PROXY_2, CURLOPT_PROXYUSERPWD => PROXY_2_AUTH);
	}
	else //prepare the class-items query
	{
		//x and y values indicate to the script which pixels you clicked for their analytics purposes.  we play it safe by randomizing them within the possible range.
		
		$x = rand(0, 115);
		$y = rand(0, 20);
		
		$postdata = 'storeId='. $valuesArr['Store_Value'] .'&langId=-1&catalogId=10001&savedListAdded=true&clearAll=&viewName=TBWizardView&removeSectionId=&mcEnabled=N&section_1='. $valuesArr['Class_Value'] .'&numberOfCourseAlready=0&viewTextbooks.x='. $x .'&viewTextbooks.y='. $y .'&sectionList=newSectionNumber';//get the class-book data.
		
		//$options = array(CURLOPT_URL => $url .'TBListView', CURLOPT_REFERER => $referer, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $postdata);
		$options = array(CURLOPT_URL => $url .'TBListView', CURLOPT_REFERER => $referer, CURLOPT_POST => true, CURLOPT_POSTFIELDS => $postdata, CURLOPT_PROXY => PROXY_2, CURLOPT_PROXYUSERPWD => PROXY_2_AUTH);
	}
	
	$response = curl_request($options);
	
	
	if (!$response)
	{
		throw new Exception('Failed to get a response with values '. print_r($valuesArr, true));
	}
	else
	{
		$returnArray = array();
		//continue here with finder stuff for term...
		$doc = new DOMDocument();
	
		@$doc->loadHTML($response); //supress the error cus HTML is imperfect
		
		$finder = new DomXPath($doc);
		
		//time to process the response...
		if (!isset($valuesArr['Term_Value']))
		{
			$select_tags = $doc->getElementsByTagName('select');
			
			$term_options = $finder->query('//select[@name="s2"]/option');
			
			if ($term_options->length == 0)
			{
				throw new Exception('Failed to get term select with values '. print_r($valuesArr, true));
			}
			else
			{
				for ($j = 1; $j < $term_options->length; $j++) //skip the first "select"
				{
					$term_option = $term_options->item($j);
					$returnArray[] = array('Term_Value' => $term_option->getAttribute('value'), 'Term_Name' => $term_option->nodeValue);
				}
			}
		}
		else if (!isset($valuesArr['Department_Value']))
		{
			$option_tags = $doc->getElementsByTagName('option');
			for ($i = 1; $i < $option_tags->length;  $i++) //skip the first "select"
			{
				$option_tag = $option_tags->item($i);
				$returnArray[] = array('Department_Value' => $option_tag->getAttribute('value'), 'Department_Code' => $option_tag->nodeValue);
			}
		}
		else if (!isset($valuesArr['Course_Value']))
		{
			$option_tags = $doc->getElementsByTagName('option');
			
			for ($i = 1; $i < $option_tags->length;  $i++) //skip the first "select"
			{
				$option_tag = $option_tags->item($i);
				$returnArray[] = array('Course_Value' => $option_tag->getAttribute('value'), 'Course_Code' => $option_tag->nodeValue);
			}
		}
		else if (!isset($valuesArr['Class_Value']))
		{
			$option_tags = $doc->getElementsByTagName('option');
			
			for ($i = 1; $i < $option_tags->length;  $i++)
			{
				$option_tag = $option_tags->item($i);
				if (substr($option_tag->getAttribute('value'), -2) == "N_")
				{
					$value = substr($option_tag->getAttribute('value'), 0, -2); //clear up the N_ shit.
				}
				else
				{
					$value = $option_tag->getAttribute('value');
				}
				
				$returnArray[] = array('Class_Value' => $value, 'Class_Code' => $option_tag->nodeValue);
			}
		}
		//continue with other dropdown responses..
		else
		{
			$cb_divs = $finder->query('//div[@class="tbListHolding"]');
			
			$items = array();
			
			foreach ($cb_divs as $i => $cb_div)
			{
				//Begin by getting Title and Necessity..
				$title_search = $finder->query('.//div[@class="sectionProHeading"]//li/a', $cb_div);
				
				if ($title_search->length != 0)
				{
					$items[$i]['Title'] = $title_search->item(0)->nodeValue;
					$items[$i]['Necessity'] = $finder->query('.//div[@class="sectionProHeading"]//li[@class="required"]', $cb_div)->item(0)->nodeValue;
					
					//Next get more Items data..
					$item_lis = $finder->query('.//ul[@class="TBinfo"]/li', $cb_div); //these lis have the item data..
					
					foreach($item_lis as $li)
					{
						$span = $li->getElementsByTagName('span');
						if ($span->length)
						{
							$span = $span->item(0);
							$span_val = trim($span->nodeValue);
							$li->removeChild($span); //so its not included in nodeValue
							switch ($span_val)
							{
								case 'Author:':
									$items[$i]['Authors'] = $li->nodeValue;
									break;
								case 'Edition:':
									$items[$i]['Edition'] = $li->nodeValue;
									break;
								case 'Publisher:':
									$items[$i]['Publisher'] = $li->nodeValue;
									break;
								case 'ISBN:':
									$items[$i]['ISBN'] = $li->nodeValue;
									break;
							}
						}
					}
					
					//Next we get the Bookstore Price...
					$pricing_labels = $finder->query('.//td[@class="sectionSelect"]/ul/li/label', $cb_div);
					
					$pricingList = array();
					
					
					//need to fix this up to extract only the price..
					foreach($pricing_labels as $label)
					{
						$span = $label->getElementsByTagName('span');
						if ($span->length)
						{
							$span = $span->item(0);
							$label->removeChild($span); //so its not included in nodeValue
							$pricingList[] = priceFormat($label->nodeValue); //format so we can compare
						}
					}
					
					if ($pricingList)
					{
						$items[$i]['Bookstore_Price'] = max($pricingList);
					}
				}
			}
			
			$returnArray['Class_ID'] = $valuesArr['Class_ID'];
			$returnArray['items'] = $items; //trim them all 
			
		}
		
		return $returnArray;
	}
}	
//clearcheck1
function update_classes_from_bookstore($valuesArr) //$valuesArr is an array of values to send to the bookstore (usually its from a $row result).  Depending on what's there, we query the next thing:  Bookstore vars, Term_Value, Department_Value, Course_Value. 
{
	$wait_times = array(FALSE, 250000, 400000); //double retries
	$results = false;
	
	for ($n = 0; $n < count($wait_times) && !$results; $n++)
	{
		if ($wait_times[$n])
		{
			usleep($wait_times[$n]);
		}
		try //we need to catch exceptions because they might change their layouts
		{
			switch ($valuesArr['Bookstore_Type_Name'])
			{
				case 'Barnes and Nobles':
					$results = get_classes_and_items_from_bn($valuesArr);
					break;
				
				case 'Follett':
					$results= get_classes_and_items_from_follett($valuesArr);
					break;
				
				//These functions will return false or empty array on error or 0 $results...	
			}
		}
		catch (Exception $e)
		{
			$results = false;
			trigger_error('Bookstore query problem: '. $e->getMessage() . ' on line '. $e->getLine());
		}	
	}
	
	if (!$conn = connect())
	{
		echo "not connected\n";//nkh6
		trigger_error('Connect failure', E_USER_WARNING);
	}else{//nkh6
		echo "there is a connection fail\n";
		}
	
	if ($results !== false)
	{
		foreach ($results as $key => $result)
		{
			$results[$key] = format_dropdown($result);
		}
		
		if ($results && !isset($valuesArr['Term_ID'])) //it's getting terms
		{
			$query = 'INSERT INTO Terms_Cache (Campus_ID, Term_Name, Term_Value) VALUES ';
			foreach($results as $term)
			{
				$query .= '(' . $valuesArr['Campus_ID'] . ', "'. mysql_real_escape_string($term['Term_Name']) . '", "' . mysql_real_escape_string($term['Term_Value']) .'"),'; //Title Capitalize the Term_Name with ucwords()
			}	
			$query = substr(($query), 0, -1); //remove final comma
			$query .=  ' ON DUPLICATE KEY UPDATE Term_Name=VALUES(Term_Name),Cache_TimeStamp=NOW()';
		}
		else if (!isset($valuesArr['Division_ID'])) //no reuslts is interpreted as placeholder no division null insert.
		{
			$query = 'INSERT INTO Divisions_Cache (Term_ID, Division_Name, Division_Value) VALUES ';
			//we allow for empty results on this one
			if (!$results)
			{
				//insert NULL placeholder row
				$query .= '('. $valuesArr['Term_ID'] .', NULL, NULL)';
			}
			else
			{
				//insert actual programs
				foreach ($results as $program)
				{
					$query .= '('. $valuesArr['Term_ID'] . ', "'. mysql_real_escape_string($program['Division_Name']) . '", "'. mysql_real_escape_string($program['Division_Value']) .'"),';
				}
				$query = substr(($query), 0, -1); //remove final comma
			}
			
			$query .=  ' ON DUPLICATE KEY UPDATE Division_Name=VALUES(Division_Name),Cache_TimeStamp=NOW()';
		}
		else if ($results && !isset($valuesArr['Department_ID'])) //it's getting departments
		{
			$query = 'INSERT INTO Departments_Cache (Division_ID, Department_Code, Department_Value) VALUES ';
			foreach($results as $dept)
			{
				$query .= '(' . $valuesArr['Division_ID'] . ', "'. mysql_real_escape_string($dept['Department_Code']) . '", "' . mysql_real_escape_string($dept['Department_Value']) .'"),';
			}	
			$query = substr(($query), 0, -1); //remove final comma
			$query .=  ' ON DUPLICATE KEY UPDATE Department_Code=VALUES(Department_Code),Cache_TimeStamp=NOW()';
		}
		
		else if ($results) //it's getting classes aka sections.  by definition its not neebo which gets those when it gets courses. 
		{
			//we need to update this to store instructor.
			$query = 'INSERT INTO Classes_Cache (Course_ID, Class_Code, Class_Value, Instructor) VALUES ';
			foreach($results as $class)
			{
				if (isset($class['Instructor']))
				{
					$class['Instructor'] = '"'. $class['Instructor'] .'"';
				}
				else
				{
					$class['Instructor'] = 'NULL';
				}
			
				$query .= '(' . $valuesArr['Course_ID'] . ', "'. mysql_real_escape_string($class['Class_Code']) . '", "' . mysql_real_escape_string($class['Class_Value']) .'", '. $class['Instructor'] .'),'; //Title capitalize Class_Code with ucwords() in case prof was in it
			}	
			$query = substr(($query), 0, -1); //remove final comma
			$query .=  ' ON DUPLICATE KEY UPDATE Class_Code=VALUES(Class_Code),Cache_TimeStamp=NOW()';
		}
		
		
		if (isset($query) && !mysql_query($query)) //only applies to non-neebo.
		{
			
			trigger_error(mysql_error() .' on cache update query: '. $query);
		}
	}
	else
	{
		trigger_error('Failed to query bookstore with '. print_r($valuesArr, true), E_USER_WARNING);
	}
	if (isset($results))
	{
		return $results;
	}
	else
	{
		return array();
	}
	
}
function update_class_items_from_bookstore($classValuesArr) //$classValuesArr is an *array of arrays* of values to send to the bookstore (usually its from a $row result).  Expects Bookstore vars, Term_Value, Department_Value, Course_Value, and Class_Value.  This function updates the Class-Items and Items tables with the results.
{
	$resultsArray = array();
	$Items = array();
	
	$wait_times = array(FALSE, 250000, 400000); //double retries
	
	foreach($classValuesArr as $valuesArr)
	{
		$results = array();
		for ($n = 0; $n < count($wait_times) && !$results; $n++)
		{
			if ($wait_times[$n])
			{
				usleep($wait_times[$n]);
			}
			try
			{
				switch ($valuesArr['Bookstore_Type_Name'])
				{
					case 'Barnes and Nobles':
						$results = get_classes_and_items_from_bn($valuesArr);
						break;
					
					case 'Follett':
						$results = get_classes_and_items_from_follett($valuesArr);
						break;
					
					//These functions will return false or empty array on error or 0 $results...
				}
			}
			catch (Exception $e)
			{
				$results = false;
				trigger_error('Bookstore query problem: '. $e->getMessage());
			}
			if ($results)
			{
				$Items = array();
				
				foreach ($results['items'] as $i => $item)
				{
					//Set data source and format the item.. Also add it to $Items for later update.
					//**make it so it ignores the ones with the bad titles..
					$exclude = array('As Of Today,No Book Order Has Been Submitted,Pleas,'); #Note that this is their typo, not mine
					$item = format_item($item);
					
					if (!in_array(trim($item['Title']), $exclude) && 
					(!isset($item['Necessity']) || !$item['Necessity'] || isNecessary($item['Necessity']) || (isset($item['ISBN']) && valid_book_ISBN13($item['ISBN'])))
					) //we lso require that its either (possibly) required or has an ISBN
					{
						$Items[] = $item;
					}
				}
				
				$results['items'] = $Items;
				
				$resultsArray[] = $results;
			}
		}
	}
	
	if ($resultsArray)
	{
		if (!$Items || update_items_db($Items)) //makes sure the update query works before proceeding
		{
			if (!$conn = connect())
			{
				trigger_error('DB connect failed');
			}
			else
			{
				$class_items_query = '';
					
				foreach($resultsArray as $result)
				{
					if (isset($result['items']) && $result['items'])
					{	
						/* we build a union select to get the Item_ID's for the books we just inserted into Items based on ISBN, or if ISBN isn't there, all the other fields.  The reason we select the info we already have is so we can easily match it with our data. */
						
						$selectArray = array(); //cus we break it into a union
						foreach($result['items'] as $item)
						{
							$New_Price = 'NULL';
							$Used_Price = 'NULL';
							$New_Rental_Price = 'NULL';
							$Used_Rental_Price = 'NULL';
							$Bookstore_Price = 'NULL';
							$Necessity = 'NULL';
							$Comments = 'NULL';
							
							if (isset($item['Bookstore_Price']))
							{
								$Bookstore_Price = "'". mysql_real_escape_string($item['Bookstore_Price']) . "'";
							}
							if (isset($item['New_Price']))
							{
								$New_Price = "'". mysql_real_escape_string($item['New_Price']) . "'";
							}
							if (isset($item['Used_Price']))
							{
								$Used_Price = "'". mysql_real_escape_string($item['Used_Price']) . "'";
							}
							if (isset($item['New_Rental_Price']))
							{
								$New_Rental_Price = "'". mysql_real_escape_string($item['New_Rental_Price']) . "'";
							}
							if (isset($item['Used_Rental_Price']))
							{
								$Used_Rental_Price = "'". mysql_real_escape_string($item['Used_Rental_Price']) . "'";
							}
							
							if (isset($item['Necessity']))
							{
								$Necessity = "'". mysql_real_escape_string($item['Necessity']) . "'"; //title capitalize Necessity
							}
							if (isset($item['Comments']))
							{
								$Comments = "'". mysql_real_escape_string($item['Comments']) . "'";
							}
							
							$select = 'SELECT Item_ID, '. 
							$Bookstore_Price .' AS Bookstore_Price, '.
							$New_Price .' AS New_Price, '.
							$Used_Price .' AS Used_Price, '.
							$New_Rental_Price .' AS New_Rental_Price, '.
							$Used_Rental_Price .' AS Used_Rental_Price, '.
							$Necessity .' AS Necessity, '. 
							$Comments .' AS Comments 
							
							FROM Items WHERE ';
							
							if (isset($item['ISBN']) && valid_ISBN13($item['ISBN']))
							{
								$select .= 'ISBN = '. $item['ISBN'];
							}
							else
							{
								$Edition = "''";
								$Authors = "''";
								$Year = 0000;
								$Publisher = "''";
								
								$Title = "'". mysql_real_escape_string($item['Title']) ."'";
								
								if (isset($item['Edition']))
								{
									$Edition =  "'". mysql_real_escape_string($item['Edition']) . "'";
								}
								if (isset($item['Authors']))
								{
									$Authors = "'". mysql_real_escape_string($item['Authors']) . "'"; //title capitalize authors
								}
								if (isset($item['Year']))
								{
									$Year = $item['Year'];
								}
								if (isset($item['Publisher']))
								{
									$Publisher = "'". mysql_real_escape_string($item['Publisher']) . "'"; //Title capitalize  Publisher
								}
								
								$select .= 'ISBN IS NULL AND Title = '. $Title .' AND Edition = '. $Edition .' AND Authors = '. $Authors . ' AND Year = '. $Year .' AND Publisher = '. $Publisher;
							}
							
							$selectArray[] = $select;
						}
						$select_items_query = implode($selectArray, ' UNION ALL ');					
						
						if (!$select_result = mysql_query($select_items_query))
						{
							trigger_error(mysql_error() . ' with select items query '. $select_items_query, E_USER_WARNING);
						}
						else if (mysql_num_rows($select_result) == 0)
						{
							trigger_error('0 rows on select items query '. $select_items_query, E_USER_WARNING);
						}
						else
						{	
							while ($row = mysql_fetch_assoc($select_result))
							{
								$Bookstore_Price = 'NULL';
								$New_Price = 'NULL';
								$Used_Price = 'NULL';
								$New_Rental_Price = 'NULL';
								$Used_Rental_Price = 'NULL';
								$Necessity = 'NULL';
								$Comments = 'NULL';
								
								if ($row['Bookstore_Price'])
								{
									$Bookstore_Price = "'". mysql_real_escape_string($row['Bookstore_Price']) . "'";
								}
								if ($row['New_Price'])
								{
									$New_Price = "'". mysql_real_escape_string($row['New_Price']) . "'";
								}
								if ($row['Used_Price'])
								{
									$Used_Price = "'". mysql_real_escape_string($row['Used_Price']) . "'";
								}
								if ($row['New_Rental_Price'])
								{
									$New_Rental_Price = "'". mysql_real_escape_string($row['New_Rental_Price']) . "'";
								}
								if ($row['Used_Rental_Price'])
								{
									$Used_Rental_Price = "'". mysql_real_escape_string($row['Used_Rental_Price']) . "'";
								}
				
								if ($row['Necessity'])
								{
									$Necessity = "'". mysql_real_escape_string($row['Necessity']) . "'";
								}
								if ($row['Comments'])
								{
									$Comments = "'". mysql_real_escape_string($row['Comments']) . "'";
								}
								
								$class_items_query .= '('. 
								$result['Class_ID'] .', '. 
								$row['Item_ID'] .', '. 
								$Bookstore_Price . ', '. 
								$New_Price . ', '. 
								$Used_Price . ', '. 
								$New_Rental_Price . ', '. 
								$Used_Rental_Price . ', '. 
								$Necessity .', '. 
								$Comments .
								'),';
							}
						}
					}
					else
					{
						$Comments = 'NULL'; 
						if (isset($item['Comments'])) //there still might be some comments even if no items.
						{
							$Comments = "'". mysql_real_escape_string($item['Comments']) . "'";
						}
						$class_items_query .= '('. $result['Class_ID'] .', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '. $Comments .'),';
					}
				}
				
				$class_items_query = 'INSERT INTO Class_Items_Cache (Class_ID, Item_ID, Bookstore_Price, New_Price, Used_Price, New_Rental_Price, Used_Rental_Price, Necessity, Comments) VALUES '. substr($class_items_query, 0, -1) . ' ON DUPLICATE KEY UPDATE Item_ID=VALUES(Item_ID),Bookstore_Price=VALUES(Bookstore_Price),New_Price=VALUES(New_Price),Used_Price=VALUES(Used_Price),New_Rental_Price=VALUES(New_Rental_Price),Used_Rental_Price=VALUES(Used_Rental_Price),Necessity=VALUES(Necessity),Comments=VALUES(Comments),Cache_TimeStamp=NOW()';
							
				if (!mysql_query($class_items_query))
				{
					trigger_error(mysql_error() . ' on class_items_query: '. $class_items_query, E_USER_WARNING);
				}
			}
		}
	}
	else
	{
		trigger_error('Failed to query bookstore with '. print_r($classValuesArr, true), E_USER_WARNING);
	}		
}
?>


