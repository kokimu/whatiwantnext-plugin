<?php
/**
 * @package What I Want Next
 * @version 1.0
 */
/*
Plugin Name: What I Want Next
Description: Plugin created for "What I Want Next" exercise form.
Version: 1.0
*/

// Please set your page IDs inside "is_page()"

// You can remove the if statement and just load script for all the pages too, if you like...but this is more efficient and less trouble.

if(!(is_page(26) || is_page(48) || is_page(27) || is_page(28) || is_page(51) || is_page(53) )){
	add_action("wp_head", "whatiwantnext_css");
	add_action("wp_head", "whatiwantnext_scripts");
	add_action("wp_head", "on_load_script");
}

// Load css
function whatiwantnext_css() {
	$path = plugins_url("css/whatiwantnext.css", __FILE__);
	echo '<link rel="stylesheet" type="text/css" href="' .$path. '">';
}
// Load JavaScript
function whatiwantnext_scripts(){
	$path = plugins_url("js/whatiwantnext.js", __FILE__ );
	echo '<script type="text/javascript" src="' .$path.'"></script>';
}
// Set all the actions for this widget
function on_load_script()
{
	// Clear sesson when coming back to the first page.
	if(is_page(7)){ // Enter From 1 page_id
		wp_session_unset();
	}
	// Session
	$wp_session = WP_Session::get_instance();
	if(isset($_POST)){
		// Get the form values submitted from the previous page.
		$prevFormVals = array();
		foreach($_POST as $key => $value){
			//echo "Key: " . $key . ", Value: " . $value;
			if($key != null && $value != null){
				$prevFormVals[htmlspecialchars($key)] = htmlspecialchars($value);
			}
		}
		// Get the other values before the previous page (stored in session).
		$arr = array();
		if($wp_session["whatiwantnext"] != null){
			$arr = $wp_session["whatiwantnext"]->toArray();
		}
		// Puts all values in session.
		$wp_session["whatiwantnext"] = array_merge($arr, $prevFormVals);
	}
	// Timer
    if(is_page(26)){ // Please set Form 1 page_id
		?>
		<script type="text/javascript">
			window.onload = function(){ startTimer(90, "form1"); };
		</script>
		<?php
    }else if(is_page(48)){ // Please set Form 2 page_id
		?>
		<script type="text/javascript">
			window.onload = function(){ startTimer(90, "form2"); };
		</script>
		<?php
	}else if(is_page(27)){ // Please set Form 3 page_id
		?>
		<script type="text/javascript">
			window.onload = function(){ startTimer(90, "form3"); };
		</script>
		<?php
	}
	// Shortcode for What I Want Next exercise forms
	add_shortcode('form1', 'form1_content');
	add_shortcode('form2', 'form2_content');
	add_shortcode('form3', 'form3_content');
	add_shortcode('form4', 'form4_content');
	add_shortcode('form5', 'form5_content');
	add_shortcode('form6', 'form6_content');
	// add_shortcode('form7', 'form7_content');
}

//[form1]
function form1_content($atts){
    $attributes = shortcode_atts( array(
        'next_page_url' => ''
    ), $atts );
	
	$contentStr = '<div id=secondsLeft class=time>&nbsp;</div><input type=button value="Pause" onclick=toggleTimer(this) /><form id=form1 action=';
	$contentStr .= $attributes["next_page_url"];
	$contentStr .= <<< HTML
 method=post>
<fieldset id=form1List class=listGroup>
<legend>My Bucket List</legend>
<input class=listItem type=text name=form1_list_0 />
<input class=listItem type=text name=form1_list_1 />
<input class=listItem type=text name=form1_list_2 />
<input class=listItem type=text name=form1_list_3 />
<input class=listItem type=text name=form1_list_4 />
</fieldset>
<input type=button value="Add more list" onclick=addList('form1List') />
<input type=submit value="Don&#39;t wait 90 secnds. Go to next!" />
</form>
HTML;
	return $contentStr;
}

//[form2]
function form2_content($atts){
    $attributes = shortcode_atts( array(
        'next_page_url' => ''
    ), $atts );
	
	$contentStr = '<div id=secondsLeft class=time>&nbsp;</div><input type=button value="Pause" onclick=toggleTimer(this) /><form id=form2 action=';
	$contentStr .= $attributes["next_page_url"];
	$contentStr .= <<< HTML
 method=post>
<fieldset id=form2List class=listGroup>
<legend>My Bucket List</legend>
<input class=listItem type=text name=form2_list_0 />
<input class=listItem type=text name=form2_list_1 />
<input class=listItem type=text name=form2_list_2 />
<input class=listItem type=text name=form2_list_3 />
<input class=listItem type=text name=form2_list_4 />
</fieldset>
<input type=button value="Add more list" onclick=addList('form2List') />
<input type=submit value="Don&#39;t wait 90 secnds. Go to next!" />
</form>
HTML;
	return $contentStr;
}

//[form3]
function form3_content($atts){
    $attributes = shortcode_atts( array(
        'next_page_url' => ''
    ), $atts );
	
	$contentStr = '<div id=secondsLeft class=time>&nbsp;</div><input type=button value="Pause" onclick=toggleTimer(this) /><form id=form3 action=';
	$contentStr .= $attributes["next_page_url"];
	$contentStr .= <<< HTML
 method=post>
<fieldset id=form3List class=listGroup>
<legend>My Bucket List</legend>
<input class=listItem type=text name=form3_list_0 />
<input class=listItem type=text name=form3_list_1 />
<input class=listItem type=text name=form3_list_2 />
<input class=listItem type=text name=form3_list_3 />
<input class=listItem type=text name=form3_list_4 />
</fieldset>
<input type=button value="Add more list" onclick=addList('form3List') />
<input type=submit value="Don&#39;t wait 90 secnds. Go to next!" />
</form>
HTML;
	return $contentStr;
}

//[form4]
function form4_content($atts){
    $attributes = shortcode_atts( array(
        'next_page_url' => '',
        'form1' => '',
		'form2' => '',
		'form3' => '',
    ), $atts );
	
	$wp_session = WP_Session::get_instance();
	$allLists = array();
	// Session expires after 24 minutes
	if($wp_session["whatiwantnext"] != null){
		$allLists = $wp_session["whatiwantnext"]->toArray();
	}else{
		return "Sorry, your session has lost.";
	}
	
	$curForm = '';
	$contentStr = '<form id=form4 onsubmit="return form4OnSubmitValidation()" action=' .$attributes["next_page_url"]. ' method=post>';
	foreach($allLists as $key => $value){
		$form = substr($key, 0, 5); // Get the form name. The key is the input name (ex. form1_list_0).
		if($curForm != $form){
			// If the form name is different, that means a value from different section, so close the fieldset.
			if($curForm != ''){
				$contentStr .= '</fieldset>';
			}
			$curForm = $form;
			$contentStr .=  '<fieldset id=' .$curForm. ' class=listGroup onchange=form4FieldOnchangeValidation("' .$curForm. '")>';
			$contentStr .=  '<legend>' .$attributes[$curForm]. '</legend>';
		}
		$contentStr .=  '<input type=checkbox name=' .$key. ' value="' .$value. '" />&nbsp;' .$value. '</br>';
	}
	$contentStr .=  '</fieldset><input type=submit value=Next /></form>';
	return $contentStr;
}


//[form5]
function form5_content($atts){
    $attributes = shortcode_atts( array(
        'next_page_url' => '',
		'form5title' => '',
		'form6text' => '',
		'mail_title' => 'Your Exercise Result',
		'sender_email' => '',
    ), $atts );
	// Step 5
	$contentStr = '<form id=form5 action=' .$attributes['next_page_url']. ' method=post>';
	$contentStr .= '<fieldset id=&quot;form5&quot; class=listGroup >';
	$contentStr .=  '<legend>' .$attributes['form5title']. '</legend>';
	if(isset($_POST)){
		// Get the form values submitted from the previous page.
		foreach($_POST as $key => $value){
			$contentStr .=  '<input type=checkbox name=' .$key. ' id=' .$key. ' value="' .$value. '" checked=true onclick=form5InputOnchange("' .$key. '") >&nbsp;<label class=grayoutcb>' .$value. '</label></br>';
		}
	}
	else{
		echo "Error: Form is not submitted properly.";
	}
	// Step 6
	$weekArr = array("SUN","MON","TUE","WED","THU","FRI","SAT");
	$contentStr .= '<h1 class="page-title">Step 6</h1>';
	$contentStr .= '<h2>' .$attributes['form6text']. '</h2>';
	$contentStr .= '<table class=weeklyCalender width="100%" border="1"><tr>';
	$contentStr .= '<th scope="col" width="10%"></th><th scope="col" width="25%">Time</th><th scope="col" width="65%">Action</th>';	
	for($row = 0; $row < 7; $row++){ // Calender Rows
		$contentStr .= '<tr><th scope="row">' .$weekArr[$row]. '</th>';
		$contentStr .= '<td><input type="text" name="time_' . $weekArr[$row] . '" id="time_' . $weekArr[$row] . '"></textarea></td>';
		$contentStr .= '<td><input type="text" name="action_' . $weekArr[$row] . '" id="action_' . $weekArr[$row] . '"></textarea></td>';
		$contentStr .= '</tr>';
	}
	$contentStr .= '</table>';
	$contentStr .=  '</fieldset>';
	// Step 7
	$contentStr .= '<h1 class="page-title s_7">Step 7</h1>';
	$mailTitle = str_replace(' ','&nbsp;',htmlspecialchars($attributes['mail_title']));
	$contentStr .= '<h2>Study your goals and actions. Now make a sentence.</h2><br />'; // Instruction added
	$contentStr .= '<input type=text name=composition id=userComposition value="What I want next is..."/><br />';
	$contentStr .= '<h2>E-mail: <input type=text name=email><br /></h2>';
	$contentStr .= '<input type=hidden name=mailTitle value=' . $mailTitle . '><input type=hidden name=from value=' .$attributes['sender_email']. '><input type=submit value="Email My Result" /></form>';
	return $contentStr;
}

//[form6] (Your NEXT result page)
function form6_content(){
	if(isset($_POST)){
		$mailto = $_POST["email"];
		$mailTitle = $_POST["mailTitle"];
		$msg = "<h3>Your Bucket List</h3>";
		$timeFound = 0;
		if(isset($_POST)){
			foreach($_POST as $key => $value){
				if(startsWith($key, "form")){
					$msg .= "<li>" . $value . "</li>";
				}else if(startsWith($key, "time")){
					if($timeFound == 0){
						$msg .= "<h3>Your Weekly Action Plan</h3>";
						$timeFound = 1;
					}
					$msg .= '<p class="plan"><strong>' . substr($key, 5, 8) ." ". $value . " </strong>";
				}else if(startsWith($key, "action")){
					$msg .= $value . "</p>";
				}
				//print $key . ":" . $value;
			}
		}
				
		$msg .= "<h3>" . stripslashes($_POST["composition"]) . "</h3>";		
		// To make HTML tags work on email
		// $headers = "From:  " . $_POST["from"];
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From:  " . $_POST["from"] . "\r\n";
		$msg .= "<br /><br />";
		$msg .= '<div class="email_only">Your NEXT was generated by <a href="http://www.whatiwantnxt.com/wp/">What I want NEXT</a></div>';
		$msg .= "<br />";
		// This echoes correctly all the text that is not inside HTML tags
		$html_reg = '/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i';
		echo htmlentities( preg_replace( $html_reg, '', $html ) );
		
		$contentStr = $msg . "<br />";

		if($mailto && $mailTitle && $msg){
			mail($mailto, $mailTitle, $msg, $headers);
			$contentStr .= "<p>Your result was sent to " . $mailto . ". Thank you!<br /></p>";
			
		}else{
			$contentStr .= "<p>Error sending email to " . $mailto . ".<br /></p>";
		}
	}else{
		$contentStr .= "<p>Sorry, failed to send email.<br /><p>";
	}
	return $contentStr;
	
}


function startsWith($haystack, $needle) {
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}