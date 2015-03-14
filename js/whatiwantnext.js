/**
 * Submits form specified by formID, after waiting for the specified seconds.
 * Displays the time left inside tag with an id "secondsLeft".
 * @param seconds: Seconds before submitting the form.
 * @param formID: Form id, to submit. If not specified, no form will be submitted.
 */
g_isPause = false; 
function startTimer(seconds, formID){
	var secondsLeft = seconds;
	var interval = setInterval(function() {
		messageDisplayTag = document.getElementById('secondsLeft');
		if(messageDisplayTag){
			if(!g_isPause){
				messageDisplayTag.innerHTML = --secondsLeft + " seconds left";
			}
		}
		var form = document.getElementById(formID);
		if (secondsLeft <= 0)
		{
			clearInterval(interval);
			if(form){
				form.submit();
			}
		}
	}, 1000);
}

/**
 * Stop/Start timer
 */
function toggleTimer(elem){
	if(g_isPause){
		g_isPause = false;
	}else{
		g_isPause = true;
	}
	if(elem.value == "Pause"){
		elem.setAttribute("value", "Resume");
	}else{
		elem.setAttribute("value", "Pause");
	}
}

/**
 * Add more input field to the What-I-Want-Next form.
 */
function addList(parentID){
	group = document.getElementById(parentID);
	inputs = group.getElementsByTagName("input");
	newList = document.createElement("input");
	newList.setAttribute("class", "listItem");
	newList.setAttribute("type", "text");
	newList.setAttribute("name", parentID + "_list_" + inputs.length);
	parentGuest = inputs[inputs.length-1];
	if (parentGuest.nextSibling) {
	  parentGuest.parentNode.insertBefore(newList, parentGuest.nextSibling);
	}
	else {
	  parentGuest.parentNode.appendChild(newList);
	}
}

/**
 * Onchange function for form4
 * Check no more than 3 checkbox is selected in a fieldset.
 * If more than 3 checkbox is selected, returns false.
 */
function form4FieldOnchangeValidation(fieldsetID){
	fieldset = document.getElementById(fieldsetID);
	if(!fieldset){
		return true; // If the form does not exists, return true. (For form4, because all the forms aren't mandatory.)
	}
	inputs = fieldset.getElementsByTagName("input");
	numChecked = 0;
	for(i=0; i < inputs.length; i++){
		if(inputs[i].checked){
			numChecked++;
		}
		// If each section has more than 3 items checked, display warning and return false.
		if(numChecked > 3){
			warningTag = document.getElementById(fieldsetID + "_warningParagraph");
			if(!warningTag){
				fieldset.appendChild(warningParagraph(fieldsetID, "Too many checkboxes selected."));
			}
			return false;
		}
	}
	// If warning tag already existed, remove it and return true.
	warningTag = document.getElementById(fieldsetID + "_warningParagraph");
	if(warningTag){
		fieldset.removeChild(warningTag);
	}
	return true;
}
/**
 * Onsubmit function for form4
 * Check no more than 3 checkbox is selected in each fieldset.
 * If more than 3 checkbox is selected, sets error message and returns false.
 */
function form4OnSubmitValidation(){
	numFalse = 0;
	fieldsetIDs = ["form1", "form2", "form3"]
	for(index in fieldsetIDs){
		fieldsetID  = fieldsetIDs[index]
		result = form4FieldOnchangeValidation(fieldsetID);
		if(result == false){
			numFalse++;
		}
	}
	if(numFalse > 0){
		return false;
	}else{
		return true;
	}
}
/**
 * Create a tag for warning text.
 */
function warningParagraph(fieldsetID, text){
	ptag = document.createElement("p");
	ptag.setAttribute("class", "warningParagraph");
	ptag.setAttribute("id", fieldsetID + "_warningParagraph");
	ptag.innerHTML = text;
	return ptag;
}

function form5InputOnchange(id){
	input = document.getElementById(id);
	if(input.checked){
		input.setAttribute("checked", true);
	}else{
		input.removeAttribute("checked");
	}
}