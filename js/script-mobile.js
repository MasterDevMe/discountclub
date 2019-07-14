window.formSubmitted = false;

window.internalLink = false;

function ValidateExpDate() {

    var ccExpYear = '20'+$("#expirationYear").val();

    var ccExpMonth = $("#expirationMonth").val();

    var expDate=new Date();

    expDate.setFullYear(ccExpYear, ccExpMonth, 1);

    var today = new Date();

    if (expDate<today)

    {

        // Credit Card is expire

        return false;

    }

    else

    {

        // Credit is valid

        return true;

    }

}

function validate_form(){

    skip=1;

	var alertText = new Array();

	var errors = new Array();

	var filter = /[a-z A-Z]{1,64}$/;

	var phonefilter = /^([0-9\-\+\(\) ]{8,22})+$/ ;

	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	var flag = 0;

	var fcs = '';

	//var is_terms_cheked = $('#terms_checkbox').attr('checked'); 

	$("#name").addClass('valid').removeClass('error');

	//$("#lastName").addClass('valid').removeClass('error');

	$("#address").addClass('valid').removeClass('error');

	$("#City").addClass('valid').removeClass('error');

	$("#country").addClass('valid').removeClass('error');

	$("#states").addClass('valid').removeClass('error');

	$("#postalCode").addClass('valid').removeClass('error');

	$("#phone").addClass('valid').removeClass('error');

	$("#email").addClass('valid').removeClass('error');

	

	



	if ($("#name").val().replace(/\s/g,"") =='' || $('#name').val()=='') {

		$("#name").addClass('error').removeClass('valid');

/*		$("#firstName_e").addClass('error').removeClass('valid');*/

		//var label = $("#firstName").closest(":has('label')").find('label');

		alertText.push("First Name");

		flag = 1;

		if(fcs =='')

				fcs = 'firstName';

	}

	else if(!filter.test($('#name').val())){

		$("#name").addClass('error').removeClass('valid');

/*		$("#firstName_e").addClass('error').removeClass('valid');*/

		var label = $("#name").closest(":has('label')").find('label');

		alertText.push("First Name");

		flag = 1;

		if(fcs =='')

				fcs = 'firstName';

	}

// 	if ($("#lastName").val().replace(/\s/g,"") =='' || $('#lastName').val()=='') {

// 		$("#lastName").addClass('error').removeClass('valid');

// /*		$("#lastName_e").addClass('error').removeClass('valid');*/

// 		var label = $("#lastName").closest(":has('label')").find('label');

// 		alertText.push("Last Name");

// 		flag = 1;

// 		if(fcs =='')

// 				fcs = 'lastName';

// 	}

// 	else if(!filter.test($('#lastName').val())){

// 		$("#lastName").addClass('error').removeClass('valid');

// /*		$("#lastName_e").addClass('error').removeClass('valid');*/

// 		var label = $("#lastName").closest(":has('label')").find('label');

// 		alertText.push("Last Name");

// 		flag = 1;

// 		if(fcs =='')

// 				fcs = 'lastName';

// 	}

	if ($("#address").val().replace(/\s/g,"") =='' || $('#address').val()=='') {

		$("#address").addClass('error').removeClass('valid');

/*		$("#address_e").addClass('error').removeClass('valid');*/

		//var label = $("#address").closest(":has('label')").find('label');

		alertText.push("Address");

		flag = 1;

		if(fcs =='')

				fcs = 'address';

	}

	

	if ($("#City").val().replace(/\s/g,"") =='' || $('#City').val()=='') {

		$("#City").addClass('error').removeClass('valid');

/*		$("#City_e").addClass('error').removeClass('valid');*/

		//var label = $("#City").closest(":has('label')").find('label');

		alertText.push("City");

		flag = 1;

		if(fcs =='')

				fcs = 'City';

	}

	if ($("#country").val().replace(/\s/g,"") =='' || $('#country').val()=='') {

		$("#country").addClass('error').removeClass('valid');

/*		$("#states_e").addClass('error').removeClass('valid');*/

		//var label = $("#country").closest(":has('label')").find('label');

		alertText.push("Country");

		flag = 1;

		if(fcs =='')

				fcs = 'country';

	}

	if ($("#states").val().replace(/\s/g,"") =='' || $('#states').val()=='') {

		$("#states").addClass('error').removeClass('valid');

/*		$("#states_e").addClass('error').removeClass('valid');*/

		//var label = $("#states").closest(":has('label')").find('label');

		alertText.push("State");

		flag = 1;

		if(fcs =='')

				fcs = 'states';

	}

	if ($("#postalCode").val().replace(/\s/g,"") =='' || $('#postalCode').val()=='') {

		$("#postalCode").addClass('error').removeClass('valid');

/*		$("#postalCode_e").addClass('error').removeClass('valid');*/

		//var label = $("#postalCode").closest(":has('label')").find('label');

		alertText.push("Zip Code");

		flag = 1;

		if(fcs =='')

				fcs = 'postalCode';

	}

	

	if ($("#phone").val().replace(/\s/g,"") =='' || $('#phone').val()=='') {

		$("#phone").addClass('error').removeClass('valid');

/*		$("#phone_e").addClass('error').removeClass('valid');*/

		//var label = $("#phone").closest(":has('label')").find('label');

		alertText.push("Phone");

		flag = 1;

		if(fcs =='')

				fcs = 'phone';

	} 

	else if(!phonefilter.test($('#phone').val()) ) {

        $("#phone").addClass('error').removeClass('valid');

/*		$("#phone_e").addClass('error').removeClass('valid');*/

		//var label = $("#phone").closest(":has('label')").find('label');

		alertText.push("Phone");

		flag = 1;

		if(fcs =='')

				fcs = 'phone';

    }

	if ($("#email").val().replace(/\s/g,"") =='' || $('#email').val()=='') {

		$("#email").addClass('error').removeClass('valid');

/*		$("#email_e").addClass('error').removeClass('valid');*/

		//var label = $("#email").closest(":has('label')").find('label');

		alertText.push("Email");

		flag = 1;

		if(fcs =='')

				fcs = 'email';

	} else if ( !emailReg.test($('#email').val()) ) {

		$("#email").addClass('error').removeClass('valid');

/*		$("#email_e").addClass('error').removeClass('valid');*/

		//var label = $("#email").closest(":has('label')").find('label');

		alertText.push("Email");

		flag = 1;

		if(fcs =='')

				fcs = 'email';

	}

		//alert(flag);

	if (flag == 0) {

			//alert("Step2");

		//$("#subBtn").hide();

		//$("#rashover").show();

		skip=1;

		// grayOut();

		window.internalLink = true;

		//$('#pop_overlay').fadeIn(300);

		return true;

	} else {

	    skip=1;

		var text = '';

		for(i=0; i<alertText.length; i++){

			text += '<li>'+alertText[i]+'</li>';

		}

		text = '<ul>'+text+'</ul>';

		//Alert(text);

		$('#'+fcs).focus();

		return false;

	}

}

function validate_checkout_form(){

    skip = 1;

	var alertText = new Array();

	var errors = new Array();

	var filter = /[a-z A-Z]$/;

	var phonefilter = /[0-9]$/;

	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	var flag = 0;

	var fcs = '';

	

	$("#cardNumber").addClass('valid').removeClass('error');

	//$("#cc_type").addClass('valid').removeClass('error');

	$("#expirationMonth").addClass('valid').removeClass('error');

	$("#expirationYear").addClass('valid').removeClass('error');

	$("#securityCode").addClass('valid').removeClass('error');

	

	$("#billing_fname").addClass('valid').removeClass('error');

	$("#billing_lname").addClass('valid').removeClass('error');

	$("#billing_street_address").addClass('valid').removeClass('error');

	$("#billing_city").addClass('valid').removeClass('error');

	$("#billing_state").addClass('valid').removeClass('error');

	$("#billing_postcode").addClass('valid').removeClass('error');

	

	if($('#billingSameAsShipping').val() == 'NO'){

	    

		if ($("#billing_fname").val().replace(/\s/g,"") =='' || $('#billing_fname').val()=='') {

			$("#billing_fname").addClass('error').removeClass('valid');

	/*		$("#address_e").addClass('error').removeClass('valid');*/

			var label = $("#billing_fname").prev('label');

			alertText.push('Billing First Name');

			flag = 1;

			if(fcs =='')

					fcs = 'billing_fname';

		}

		if ($("#billing_lname").val().replace(/\s/g,"") =='' || $('#billing_lname').val()=='') {

			$("#billing_lname").addClass('error').removeClass('valid');

	/*		$("#address_e").addClass('error').removeClass('valid');*/

			var label = $("#billing_lname").prev('label');

			alertText.push('Billing Last Name');

			flag = 1;

			if(fcs =='')

					fcs = 'billing_lname';

		}

		if ($("#billing_street_address").val().replace(/\s/g,"") =='' || $('#billing_street_address').val()=='') {

			$("#billing_street_address").addClass('error').removeClass('valid');

	/*		$("#address_e").addClass('error').removeClass('valid');*/

			var label = $("#billing_street_address").prev('label');

			alertText.push('Billing Address');

			flag = 1;

			if(fcs =='')

					fcs = 'billing_street_address';

		}

		if ($("#billing_city").val().replace(/\s/g,"") =='' || $('#billing_city').val()=='') {

			$("#billing_city").addClass('error').removeClass('valid');

	/*		$("#City_e").addClass('error').removeClass('valid');*/

			var label = $("#billing_city").prev('label');

			alertText.push('Billing City');

			flag = 1;

			if(fcs =='')

					fcs = 'billing_city';

		}

		if ($("#billing_state").val().replace(/\s/g,"") =='' || $('#billing_state').val()=='') {

			$("#billing_state").addClass('error').removeClass('valid');

	/*		$("#states_e").addClass('error').removeClass('valid');*/

			var label = $("#billing_state").prev('label');

			alertText.push('Billing State');

			flag = 1;

			if(fcs =='')

					fcs = 'billing_state';

		}

		if ($("#billing_postcode").val().replace(/\s/g,"") =='' || $('#billing_postcode').val()=='') {

			$("#billing_postcode").addClass('error').removeClass('valid');

	/*		$("#postalCode_e").addClass('error').removeClass('valid');*/

			var label = $("#billing_postcode").prev('label');

			alertText.push('Billing Zip');

			flag = 1;

			if(fcs =='')

					fcs = 'billing_postcode';

		}

		

		

	}

	/*if( $("#cc_type").val().replace(/\s/g,"") =='' || $("#cc_type").val() == '') {

		$("#cc_type").addClass('error').removeClass('valid');

		var label = $("#cc_type").prev('label');

		alertText.push('Card Type');

		flag = 1;

		if(fcs =='')

				fcs = 'cc_type';

	}*/

	if( $("#cardNumber").val().replace(/\s/g,"") =='' || $("#cardNumber").val() == '' || !phonefilter.test($("#cardNumber").val())) {

		$("#cardNumber").addClass('error').removeClass('valid');

		var label = $("#cardNumber").prev('label');

		alertText.push('Card #');

		flag = 1;

		if(fcs =='')

				fcs = 'cardNumber';

	}

	

	if( $("#expirationMonth").val().replace(/\s/g,"") =='' || $("#expirationMonth").val() == '' ) {

		$("#expirationMonth").addClass('error').removeClass('valid');

		alertText.push('Expiration Month');

		flag = 1;

		if(fcs =='')

				fcs = 'expirationMonth';

	}

	if( $("#expirationYear").val().replace(/\s/g,"") =='' || $("#expirationYear").val() == '' ) {

		$("#expirationYear").addClass('error').removeClass('valid');

		alertText.push('Expiration Year');

		flag = 1;

		if(fcs =='')

				fcs = 'expirationYear';

	} 

	else if( ValidateExpDate()==false ) {

		$("#expirationYear").addClass('error').removeClass('valid');

		$("#expirationMonth").addClass('error').removeClass('valid');

		alertText.push('Expiration Date');

		flag = 1;

		if(fcs =='')

				fcs = 'expirationMonth';

	}

	if( $("#securityCode").val().replace(/\s/g,"") =='' || $("#securityCode").val() == '' || !phonefilter.test($("#securityCode").val())) {

		$("#securityCode").addClass('error').removeClass('valid');

		var label = $("#securityCode").prev('label');

		alertText.push('CVV');

		flag = 1;

		if(fcs =='')

				fcs = 'securityCode';

	}

	if(!document.getElementById('terms').checked) {

		$("#terms").addClass('error').removeClass('valid');

		alert("Please agree to terms and conditions");

		flag = 1;

		if(fcs =='')

				fcs = 'terms';

	}

	

	

	if (flag == 0 ) {

				

				skip = 1;

				grayOut();

				window.internalLink = true;

		$('#pop_overlay').fadeIn(300);

		return true;

				

            } else {

		skip = 1;

				var text = '';

				for(i=0; i<alertText.length; i++){

					text += '<li>'+alertText[i]+'</li>';

				}

				text = '<ul>'+text+'</ul>';

				//Alert(text);

				$('#'+fcs).focus();

				return false;

	}

}





function isNumber(evt) {

    evt = (evt) ? evt : window.event;

    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

        return false;

    }

    return true;

}

$(document).ready(function() {

	if (typeof String.prototype.startsWith != 'function') {

	  // see below for better implementation!

	  String.prototype.startsWith = function (str){

		return this.indexOf(str) == 0;

	  };

	}

    $('#cc_number').keyup(function(){

		if($('#cc_number').val().startsWith('4')){

			$('.cards li').not('.visa').addClass('off');

			$('#cc_type').val('visa');

		}

		else if($('#cc_number').val().startsWith('51')){

			$('.cards li').not('.mastercard').addClass('off');

			$('#cc_type').val('master');

		}

		else if($('#cc_number').val().startsWith('65')){

			$('.cards li').not('.discover').addClass('off');

			$('#cc_type').val('discover');

		}

		else{

			$('.cards li').removeClass('off');

			$('#cc_type').val('');

		}

	});

});



function togglebill(c){

	if(c=='NO'){

		$('div.billing').fadeIn(1);

		$('#billingSameAsShipping').val('NO');

	}

	else{

		$('div.billing').fadeOut(1);

		$('#billingSameAsShipping').val('YES');

	}

}

function validate_single(id){

	var errors = new Array();

	var phonefilter = /[0-9]$/;

	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	var flag = 0;

	switch(id){

		case "firstName":

		case "billing_fname":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "lastName":

		case "billing_lname":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "address":

		case "billing_street_address":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "City":

		case "billing_city":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "states":

		case "billing_state":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "country":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "phone":

		case "phone1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '' || !phonefilter.test($("#"+id).val())) {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		case "phone":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

		}

		break;

		case "email":

		case "email1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '' || !emailReg.test($("#"+id).val())) {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "postalCode":

		case "billing_postcode":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		

		

		

	case "cc_type":

		if( $("#cc_type").val().replace(/\s/g,"") =='' || $("#cc_type").val() == '') {

			$("#cc_type").addClass('error').removeClass('valid');

		}

		else{

			$("#cc_type").addClass('valid').removeClass('error');

		}

		break;	

		

	case "cardNumber":

		if( $("#cardNumber").val().replace(/\s/g,"") =='' || $("#cardNumber").val() == '' || !phonefilter.test($("#cardNumber").val())) {

			$("#cardNumber").addClass('error').removeClass('valid');

		}

		else{

			$("#cardNumber").addClass('valid').removeClass('error');

		}

		break;

	case "expirationMonth":

		if( $("#expirationMonth").val().replace(/\s/g,"") =='' || $("#expirationMonth").val() == '' ) {

			$("#expirationMonth").addClass('error').removeClass('valid');

		}

		else{

			$("#expirationMonth").addClass('valid').removeClass('error');

		}

		break;

	case "expirationYear":

		if( $("#expirationYear").val().replace(/\s/g,"") =='' || $("#expirationYear").val() == '' ) {

			$("#expirationYear").addClass('error').removeClass('valid');

		} 

		else{

			$("#expirationYear").addClass('valid').removeClass('error');

		}

		break;

	case "securityCode":

		if( $("#securityCode").val().replace(/\s/g,"") =='' || $("#securityCode").val() == '' || !phonefilter.test($("#securityCode").val())) {

			$("#securityCode").addClass('error').removeClass('valid');

		}

		else{

			$("#securityCode").addClass('valid').removeClass('error');

		}

	}

}



function validate_single_index(id){

	var errors = new Array();

	var filter = /[a-z A-Z]{1,64}$/;

	var phonefilter = /^([0-9\-\+\(\) ]{8,22})+$/ ;

	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	

	switch(id){

		case "firstName":

		case "firstName1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "lastName":

		case "lastName1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "address":

		case "address1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "City":

		case "city1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "country":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "states":

		case "states1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "cc_type":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "expirationMonth":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "expirationYear":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "postalCode":

		case "postalCode1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "cardNumber":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

		}

		break;

		case "securityCode":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "phone":

		case "phone1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '' || !phonefilter.test($("#"+id).val())) {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		case "phone":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

		}

		break;

		case "email":

		case "email1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '' || !emailReg.test($("#"+id).val())) {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

	}

}



function validate_single_thankyou(id){

	var errors = new Array();

	var filter = /[a-z A-Z]{1,64}$/;

	var phonefilter = /^([0-9\-\+\(\) ]{8,22})+$/ ;

	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

	

	switch(id){

		case "order_process":

		case "order_process1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "reason":

		case "reason1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;

		case "achieve":

		case "achieve1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

		break;		

		case "find_us":

		case "find_us1":

		if( $("#"+id).val().replace(/\s/g,"") =='' || $("#"+id).val() == '') {

			$("#"+id).addClass('error').removeClass('valid');

			$("#"+id+"_e").addClass('error').removeClass('valid');

		}

		else{

			$("#"+id).addClass('valid').removeClass('error');

			$("#"+id+"_e").addClass('valid').removeClass('error');

		}

	}

}



function onlyNumbers(e,type)

{

   var keynum;

   var keychar;

   var numcheck;

   if(window.event) // IE

   {

      keynum = e.keyCode;

   }

   else if(e.which) // Netscape/Firefox/Opera

   {

      keynum = e.which;

   }

   keychar = String.fromCharCode(keynum);

   numcheck = /\d/;



   switch (keynum)

   {

      case 8:    //backspace

      case 9:    //tab

      case 35:   //end

      case 36:   //home

      case 37:   //left arrow

      case 38:   //right arrow

      case 39:   //insert

      case 45:   //delete

      case 46:   //0

      case 48:   //1

      case 49:   //2

      case 50:   //3

      case 51:   //4

      case 52:   //5

      case 54:   //6

      case 55:   //7

      case 56:   //8

      case 57:   //9

      case 96:   //0

      case 97:   //1

      case 98:   //2

      case 99:   //3

      case 100:  //4

      case 101:  //5

      case 102:  //6

      case 103:  //7

      case 104:  //8

      case 105:  //9

         result2 = true;

         break;

      case 109: // dash -

         if (type == 'phone')

         {

            result2 = true;

         }

         else

         {

         result2 = false;

         }

      break;

      default:

         result2 = numcheck.test(keychar);

         break;

   }



   return result2;

}