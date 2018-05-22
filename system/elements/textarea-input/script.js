function leaveInput(input) {
	if (input.value.length > 0) {
		if (!input.classList.contains('active')) {
			input.classList.add('active');
		}
	} else {
		if (input.classList.contains('active')) {
			input.classList.remove('active');
		}
	}
}

function setupTextAreaInputs(){
	var inputs = document.getElementsByClassName("m-textareainput");
    
    for (var i = 0; i < inputs.length; i++) {
    	var input = inputs[i];
    	
		if(input.value != ""){
			input.classList.add('active');
		}
		
    	input.addEventListener("blur", function() {
    		leaveInput(this);
    	});
    }
}