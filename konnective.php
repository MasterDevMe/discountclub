<?php
 session_start();

function safeRequestKonnective($strGet) {
      $strGet = preg_replace("/[^\-a-zA-Z0-9\_]*/m","",$strGet);
      //$strGet = preg_replace("/[^a-zA-Z0-9(\040)\(\)']*/m","",$strGet); //<--to allow space \040
      $strGet = str_ireplace("javascript","",$strGet);
      $strGet = str_ireplace("encode","",$strGet);
      $strGet = str_ireplace("decode","",$strGet);
      return trim($strGet);
}
function NewLeadKonnective($campaign_id,$fields_fname,$fields_lname,$fields_address1,$fields_address2,$fields_city,$fields_state,$fields_zip,$country_2_digit,$fields_phone,$fields_email,$AFID,$SID,$AFFID,$C1,$C2,$C3,$AID,$OPT,$click_id,$notes=''){
	  global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	  $_SESSION['fname'] = $fields_fname;
	  $_SESSION['lname'] = $fields_lname;
	  $_SESSION['address'] = $fields_address1;
	  $_SESSION['city'] = $fields_city;
	  $_SESSION['state'] = $fields_state;
	  $_SESSION['phone'] = $fields_phone;
	  $_SESSION['zip'] = $fields_zip;
	  $_SESSION['email'] = $fields_email;
	  $_SESSION['country'] = $country_2_digit;
	  if($campaign_id == "1")
	  {
	    $AFFID = "";
	    $SID = "";
	    $C1 = "";
	    $C2 = "";
	    $C3 = "";
	    $click_id = "";
	  }
	  $fields =   array('loginId'=>'jimdev',
						'password'=>'Jim123#',
						'campaignId'=>$campaign_id,
						'firstName'=>trim($fields_fname),
						'lastName'=>trim($fields_lname),
						'address1'=>trim($fields_address1),
						'address2'=>trim($fields_address2),
						'city'=>trim($fields_city),
						'state'=>trim($fields_state),
						'postalCode'=>trim($fields_zip),
						'country'=>$country_2_digit, 
						'phoneNumber'=>trim($fields_phone),
						'emailAddress'=>trim($fields_email),
						'affId'=>trim($AFFID),
						'sourceValue1'=>trim($SID),
						'sourceValue2'=>trim($C1),
						'sourceValue3'=>trim($C2),
						'sourceValue4'=>trim($C3),
						'sourceValue5'=>trim($click_id),
						'ipAddress'=>$_SERVER['REMOTE_ADDR']);
	  
		$Curl_Session = curl_init();
        curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/leads/import/');
        curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	return $content = curl_exec($Curl_Session);
	
	
		//return $content = curl_exec($Curl_Session);
        //$header = curl_getinfo($Curl_Session);
	
}

function PreOrdeAuthKonnective($cardNumber,$cardMonth,$cardYear,$cardSecurityCode, $orderId, $customerId){
	$fields = array('loginId'=>'nexgenapi',
                    'password'=>'n3Xg3n_api420gogo',
					'cardNumber'=>$cardNumber,
					'cardMonth'=>$cardMonth,
					'cardYear'=>$cardYear,
					'cardSecurityCode'=>$cardSecurityCode,
					'paySource'=>'CREDITCARD',
					'orderId'=>$orderId,
					'customerId'=>$customerId
					);
		
					//echo "<pre>".print_r($fields,true)."</pre>";die();
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/order/preauth/');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($Curl_Session);
    return $content;

}


function NewOrderWithLeadKonnective($productId, $upsale = NULL, $shipping_price = NULL){
	  //global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	  $post_info = json_decode($_SESSION['post_info'], TRUE);
	  $card_info = json_decode($_SESSION['card_info'], TRUE);
	  $order_info = json_decode($_SESSION['order_info'], TRUE);
	  $billing_fields = array();
	  if(!empty($billingSameAsShipping) && $billingSameAsShipping=='NO') {
		  $billing_fields = array('shipFirstName' => $order_info['firstName'],
		  						  'shipLastName' => $order_info['lastName'],
								  'shipAddress1' =>$order_info['address1'],
								  'shipCity' => $order_info['city'],
								  'shipState' =>$order_info['state'],
								  'shipPostalCode' => $order_info['postalCode'],
								  'shipCountry' => $order_info['country']
		  						 );
	  }
	  if($campaign_id == "1")
	  {
	    $AFFID = "";
	    $SID = "";
	    $C1 = "";
	    $C2 = "";
	    $C3 = "";
	    $click_id = "";
	  }
	  $fields1 = array('loginId'=>'jimdev',
						'password'=>'Jim123#',
					  'orderId'=> $order_info['orderId'],
					  'paySource' => 'CREDITCARD',
					  'firstName'=> $order_info['firstName'],
						'lastName'=>$order_info['lastName'],
						'address1'=>$order_info['address1'],
						'city'=>$order_info['city'],
						'state'=>$order_info['state'],
						'postalCode'=> $order_info['postalCode'],
						'country'=> $order_info['country'], 
						'phoneNumber'=>$order_info['phoneNumber'], 
						'emailAddress'=>$order_info['emailAddress'], 
					  'cardNumber'=>$card_info['credit_card_number'],
					  'cardMonth'=>$card_info['credit_card_exp_date_month'],
					  'cardYear'=>$card_info['credit_card_exp_date_year'],
					  'cardSecurityCode'=>$card_info['security_code'],
					  'tranType'=>'Sale',
					  'product1_id'=>$productId,
					  'campaignId'=>$order_info['campaignId'],
					  'product1_shipPrice'=>$shipping_price,
					'shipFirstName' => $order_info['firstName'],
		  						  'shipLastName' => $order_info['lastName'],
								  'shipAddress1' =>$order_info['address1'],
								  'shipCity' => $order_info['city'],
								  'shipState' =>$order_info['state'],
								  'shipPostalCode' => $order_info['postalCode'],
								  'shipCountry' => $order_info['country'],

					  'billShipSame'=>$billingSameAsShipping,
					  'affId'=>trim($AFFID),
						'sourceValue1'=>trim(''),
						'sourceValue2'=>trim(''),
						'sourceValue3'=>trim(''),
						'sourceValue4'=>trim(''),
						'sourceValue5'=>trim(''),
					  'ipAddress'=>$_SERVER['REMOTE_ADDR']);
					 // print_r($fields1);
					  //echo "<pre>".print_r($fields1,true)."</pre>";
					  
		if(!empty($billing_fields)) {
			$fields = array_merge($fields1, $billing_fields);
		} else {
			$fields = $fields1;
		}
		//echo "<pre>";
		//print_r($fields);
		
		$Curl_Session = curl_init();
        curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/order/import/');
        curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($Curl_Session);
	    //$ret = json_decode($content);
	
// 	if( $ret->result == 'SUCCESS' ){
// 	    if($upsale != NULL){
// 	     $data2 =  $ret->message;
		
// 		$orderId = $data2->orderId;
// 	    $upsale_products = array_unique($upsale);
// 		foreach($upsale_products as $product_id){
// 	    $fields2 = array(   'loginId'=>'nexgenapi',
//                             'password'=>'n3Xg3n_api420gogo',
// 							'method'=>'NewOrderCardOnFile',
// 							'orderId'=>$orderId,
// 							'productId'=>$product_id,
// 							'product1_shipPrice'=>'0.00');
					  
				  
		
// 	$Curl_Session = curl_init();
// 	curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/upsale/import/');
// 	curl_setopt($Curl_Session, CURLOPT_POST, 1);
// 	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
// 	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields2));
// 	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
//         $content1 = curl_exec($Curl_Session);
		
// 	 }
// 	}
// }	
    //unset($_SESSION['oto']);
	return $content;
}

function upsale($orderId, $upsale){

	    $upsale_request = array('loginId'=>'nexgenapi',
                            'password'=>'n3Xg3n_api420gogo',
							'method'=>'NewOrderCardOnFile',
							'orderId'=>$orderId,
							'productId'=>$upsale,
							'product1_shipPrice'=>'0.00');

	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/upsale/import/');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields2));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
       return $content1 = curl_exec($Curl_Session);
}
	



//echo upsale("D7FD6D2337","11");




///NewOrderWithLeadKonnective($campaign_id,$orderTempId,$creditCardType,$creditCardNumber,$cardMonth,$cardYear,$cvv,$productId,$shippingId,$upsellCount,$billingSameAsShipping,$product_qty,$custom_product_price,$AFID,$SID,$AFFID,$C1,$C2,$C3,$AID,$OPT,$notes='',$billingaddress='',$billingcity='',$billingstate='',$billingzip='',$billingcountry='',$billingfanme='',$billinglanme='',$sessionId='',$insure_campaign_id,$insure_custom_product,$insure_shipping_id,$shipping_price,$extraproduct)

function NewOrderCheckout($campaign_id,$fields_fname,$fields_lname,$fields_address1,$fields_address2,$fields_city,$fields_state,$fields_zip,$country_2_digit,$fields_phone,$fields_email,$creditCardType,$creditCardNumber,$cardMonth,$cardYear,$cvv,$productId,$shippingId,$upsellCount,$billingSameAsShipping,$product_qty,$custom_product_price,$AFID,$SID,$AFFID,$C1,$C2,$C3,$AID,$OPT,$notes='',$billingaddress='',$billingcity='',$billingstate='',$billingzip='',$billingcountry='',$billingfanme='',$billinglanme='',$sessionId='',$insure_campaign_id,$insure_custom_product,$insure_shipping_id,$shipping_price,$extraproduct){
	  //global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	  $_SESSION['fname'] = $fields_fname;
	  $_SESSION['lname'] = $fields_lname;
	  $_SESSION['address'] = $fields_address1;
	  $_SESSION['city'] = $fields_city;
	  $_SESSION['state'] = $fields_state;
	  $_SESSION['phone'] = $fields_phone;
	  $_SESSION['zip'] = $fields_zip;
	  $_SESSION['email'] = $fields_email;
	  $billing_fields = array();
	  if(!empty($billingSameAsShipping) && $billingSameAsShipping=='NO') {
		  $billing_fields = array('shipFirstName' => $billingfanme,
		  						  'shipLastName' => $billinglanme,
								  'shipAddress1' => $billingaddress,
								  'shipCity' => $billingcity,
								  'shipState' => $billingstate,
								  'shipPostalCode' => $billingzip,
								  'shipCountry' => $billingcountry
		  						 );
	  }
	 
	  $fields1 = array('loginId'=>'nexgenapi',
						'password'=>'n3Xg3n_api420gogo',
					  'paySource'=>'CREDITCARD',
					  'firstName'=>trim($fields_fname),
						'lastName'=>trim($fields_lname),
						'address1'=>trim($fields_address1),
						'address2'=>trim($fields_address2),
						'city'=>trim($fields_city),
						'state'=>trim($fields_state),
						'postalCode'=>trim($fields_zip),
						'country'=>$country_2_digit, 
						'phoneNumber'=>trim($fields_phone),
						'emailAddress'=>trim($fields_email),
					  'cardNumber'=>$creditCardNumber,
					  'cardMonth'=>$cardMonth, //mmyy
					  'cardYear'=>$cardYear, //mmyy
					  'cardSecurityCode'=>$cvv,
					  'tranType'=>'Sale',
					   'product1_id'=>$productId,
					  'campaignId'=>$campaign_id,
					  'product1_qty'=>$product_qty,
					  'product1_price'=>$custom_product_price,
					  'product1_shipPrice'=>$shipping_price,
					  'billShipSame'=>'yes',
					  'affId'=>trim($AFFID),
						'sourceValue1'=>trim($SID),
						'sourceValue2'=>trim($C1),
						'sourceValue3'=>trim($C2),
						'sourceValue4'=>trim($C3),
						'sourceValue5'=>trim($click_id),
					  'ipAddress'=>$_SERVER['REMOTE_ADDR']);
					  
					  					  //echo "<pre>".print_r($fields1,true)."</pre>";
					  
		if(!empty($billing_fields)) {
			$fields = array_merge($fields1, $billing_fields);
		} else {
			$fields = $fields1;
		}
		
		$Curl_Session = curl_init();
        curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/order/import/');
        curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($Curl_Session);
	$ret = json_decode($content);
	$data2 =  $ret->message;
		
		$orderId = $data2->orderId;
	
	if( $ret->result == 'SUCCESS' ) {
	  if($extraproduct){
	   
	
	
	$fields = array('loginId'=>'nexgenapi',
					'password'=>'n3Xg3n_api420gogo',
					'method'=>'NewOrderCardOnFile',
					'orderId'=>$orderId,
					'productId'=>'10',
					'product1_shipPrice'=>'0.00');
		
					//echo "<pre>".print_r($fields,true)."</pre>";die();
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/upsale/import/');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	$content1 = curl_exec($Curl_Session);
	
	  }
	     
	
	
	$fields = array('loginId'=>'nexgenapi',
                    'password'=>'n3Xg3n_api420gogo',
					'method'=>'NewOrderCardOnFile',
					'orderId'=>$orderId,
					'productId'=>'1766',
					'product1_shipPrice'=>'0.00');
		
					//echo "<pre>".print_r($fields,true)."</pre>";die();
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/upsale/import/');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	$content1 = curl_exec($Curl_Session);
	}
	/*echo "<pre>";
	print_r($content);
	die();*/

	
	return $content;
}
function NewOrder($campaign_id,$fields_fname,$fields_lname,$fields_address1,$fields_address2,$fields_city,$fields_state,$fields_zip,$country_2_digit,$fields_phone,$fields_email,$creditCardType,$creditCardNumber,$cardMonth,$cardYear,$cvv,$productId,$shippingId,$upsellCount,$billingSameAsShipping,$product_qty,$custom_product_price,$AFID,$SID,$AFFID,$C1,$C2,$C3,$AID,$OPT,$notes='',$billingaddress='',$billingcity='',$billingstate='',$billingzip='',$billingcountry='',$billingfanme='',$billinglanme='',$sessionId='',$insure_campaign_id,$insure_custom_product,$insure_shipping_id,$shipping_price,$extraproduct){
	  //global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	  $_SESSION['fname'] = $fields_fname;
	  $_SESSION['lname'] = $fields_lname;
	  $_SESSION['address'] = $fields_address1;
	  $_SESSION['city'] = $fields_city;
	  $_SESSION['state'] = $fields_state;
	  $_SESSION['phone'] = $fields_phone;
	  $_SESSION['zip'] = $fields_zip;
	  $_SESSION['email'] = $fields_email;
	  $billing_fields = array();
	  if(!empty($billingSameAsShipping) && $billingSameAsShipping=='NO') {
		  $billing_fields = array('shipFirstName' => $billingfanme,
		  						  'shipLastName' => $billinglanme,
								  'shipAddress1' => $billingaddress,
								  'shipCity' => $billingcity,
								  'shipState' => $billingstate,
								  'shipPostalCode' => $billingzip,
								  'shipCountry' => $billingcountry
		  						 );
	  }
	  if($campaign_id == "28")
	  {
	    $AFFID = "";
	    $SID = "";
	    $C1 = "";
	    $C2 = "";
	    $C3 = "";
	    $click_id = "";
	  }
	  $fields1 = array( 'loginId'=>'nexgenapi',
                        'password'=>'n3Xg3n_api420gogo',
					    'paySource'=>'CREDITCARD',
					    'firstName'=>trim($fields_fname),
						'lastName'=>trim($fields_lname),
						'address1'=>trim($fields_address1),
						'address2'=>trim($fields_address2),
						'city'=>trim($fields_city),
						'state'=>trim($fields_state),
						'postalCode'=>trim($fields_zip),
						'country'=>$country_2_digit, 
						'phoneNumber'=>trim($fields_phone),
						'emailAddress'=>trim($fields_email),
					  'cardNumber'=>$creditCardNumber,
					  'cardMonth'=>$cardMonth, //mmyy
					  'cardYear'=>$cardYear, //mmyy
					  'cardSecurityCode'=>$cvv,
					  'tranType'=>'Sale',
					   'product1_id'=>$productId,
					  'campaignId'=>$campaign_id,
					  'product1_qty'=>$product_qty,
					  'product1_price'=>$custom_product_price,
					  'product1_shipPrice'=>$shipping_price,
					  'billShipSame'=>'yes',
					  'affId'=>trim($AFFID),
						'sourceValue1'=>trim($SID),
						'sourceValue2'=>trim($C1),
						'sourceValue3'=>trim($C2),
						'sourceValue4'=>trim($C3),
						'sourceValue5'=>trim($click_id),
					  'ipAddress'=>$_SERVER['REMOTE_ADDR']);
					  
					  //echo "<pre>".print_r($fields1,true)."</pre>";
					  
		if(!empty($billing_fields)) {
			$fields = array_merge($fields1, $billing_fields);
		} else {
			$fields = $fields1;
		}
		
		$Curl_Session = curl_init();
        curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/order/import/');
        curl_setopt($Curl_Session, CURLOPT_POST, 1);
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($Curl_Session);
	    $ret = json_decode($content);
	
	return $content;
}
function NewOrderIdKonnective($orderId,$product_id,$shipping_price){
	//global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	$fields = array('loginId'=>'nexgenapi',
                    'password'=>'n3Xg3n_api420gogo',
					'method'=>'NewOrderCardOnFile',
					'orderId'=>$orderId,
					'productId'=>$product_id,
					'product1_shipPrice'=>$shipping_price);
		
					//echo "<pre>".print_r($fields,true)."</pre>";die();
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/upsale/import/');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($Curl_Session);
	//echo "<pre>";
	//print_r($content);
      return $content;
	//$header = curl_getinfo($Curl_Session);
}



function NewOrderViewWithOrderIdKonnektive($orderid) {
      //echo $orderid;
	//global $limelight_api_username,$limelight_api_password,$limelight_crm_instance;
	$fields =   array('loginId'=>'nexgenapi',
                      'password'=>'n3Xg3n_api420gogo',
					  'orderId'=>$orderid
					  );
	$data = array();			  
	$Curl_Session = curl_init();
	curl_setopt($Curl_Session,CURLOPT_URL,'https://api.konnektive.com/order/query/');
	curl_setopt($Curl_Session, CURLOPT_POST, 1);
	curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec($Curl_Session);
	
	//$header = curl_getinfo($Curl_Session);
	if(!empty($content)) {
	    $ret = json_decode($content);
	    
	$data = $ret->message->data[0];
	}
	
	return $data;
}
function CreditCardCompany($ccNum)
{
       /*
	   * mastercard: Must have a prefix of 51 to 55, and must be 16 digits in length.
	   * Visa: Must have a prefix of 4, and must be either 13 or 16 digits in length.
	   * American Express: Must have a prefix of 34 or 37, and must be 15 digits in length.
	   * Diners Club: Must have a prefix of 300 to 305, 36, or 38, and must be 14 digits in length.
	   * Discover: Must have a prefix of 6011, and must be 16 digits in length.
	   * JCB: Must have a prefix of 3, 1800, or 2131, and must be either 15 or 16 digits in length.
       */
       if($ccNum == "1444444444444440")
       return "visa";
       if (ereg("^5[1-5][0-9]{14}$", $ccNum))
	       return "master";

       if (ereg("^4[0-9]{12}([0-9]{3})?$", $ccNum))
	       return "visa";

       /*if (ereg("^3[47][0-9]{13}$", $ccNum))
	       return "American Express";

       if (ereg("^3(0[0-5]|[68][0-9])[0-9]{11}$", $ccNum))
	       return "Diners Club";*/

       if (ereg("^6011[0-9]{12}$", $ccNum))
	       return "discover";

       /*if (ereg("^(3[0-9]{4}|2131|1800)[0-9]{11}$", $ccNum))
	       return "JCB";*/
}

if($_POST){

$campaign_path = "http://".$_SERVER['SERVER_NAME']."/";
$fullname = $_POST['name'];
$fullname = explode(" ",$fullname);
$first_name  = $fullname[0];
$last_name  = $fullname[1];
if($last_name=='') $last_name = 'Test';
$email  = $_POST['email'];
$phone  = $_POST['phone'];
$shipping_address1  = $_POST['address1'];
//$shipping_address2  = $_POST['shipping_address2'];
$shipping_address2  = '';
$shipping_city  = $_POST['city1'];
$shipping_state  = $_POST['state1'];
$shipping_zip  = $_POST['zip'];
$shipping_country  = $_POST['country'];
$jsonresponse =  NewLeadKonnective($campaign_id='213',$first_name,$last_name,$shipping_address1,$shipping_address2,$shipping_city,$shipping_state,$shipping_zip,$shipping_country,$phone,$email,$AFID = '',$SID= '' ,$AFFID='',$C1='',$C2='',$C3='',$AID='',$OPT='',$click_id='',$notes='');
$response = json_decode($jsonresponse, TRUE);
if(!empty($response)){
	if($response['result'] == "ERROR"){
	$errorMessage = "Please fix the following errors:<br>".$jsonresponse->message;
	$order_id = 'mode=failure';
	$url = $campaign_path.'checkout.php?orderId='.$orderId.'&errorMessage='.$errorMessage;

	header("Location:$url");
	die();
	}
	if($response['result'] == "SUCCESS"){
		$_SESSION["order_info"] = json_encode($response['message']);
		$_SESSION["post_info"] = json_encode($_POST);
		$_SESSION["card_info"] = json_encode($_POST['purchase']);
		//echo json_encode($response);
		$productId = '3817';
		$jsonresponse = NewOrderWithLeadKonnective($productId, NULL, $shipping_price = NULL);
		$response = json_decode($jsonresponse, TRUE);
		if(!empty($response)){
			if($response['result'] == "ERROR"){
				echo json_encode($response);
			}
			if($response['result'] == "SUCCESS"){
				$_SESSION["order_id"] = json_encode($response['message']);
				echo json_encode($response['result']);
			}  
		} 

	}  
}	
if(isset($_POST['preauthorder'])){	
$cardNumber  = $_POST['card_num'];
$cardSecurityCode = $_POST['cvc'];
$cardMonth  = $_POST['exp_month'];
$cardYear  = $_POST['exp_year'];
if(isset($_SESSION["order_info"]) && $_SESSION["order_info"] != ''){
$order_info = json_decode($_SESSION["order_info"], TRUE);
  $jsonresponse = PreOrdeAuthKonnective($cardNumber,$cardMonth,$cardYear,$cardSecurityCode, $order_info['orderId'], $order_info['customerId']);
  $response = json_decode($jsonresponse, TRUE);
  	  if(!empty($response)){
		 if($response['result'] == "ERROR"){
			 echo json_encode($response);
		 }
		 if($response['result'] == "SUCCESS"){
			$_SESSION["auth_info"] = json_encode($response['message']);
			$_SESSION["card_info"] = json_encode($_POST);
			 echo json_encode($response);
		 }  
	  }
 }
}
  
if(isset($_POST['oto'])){	
if(isset($_SESSION["order_info"]) && $_SESSION["order_info"] != ''){ 
$card_info = json_decode($_SESSION['card_info'], TRUE);
if($card_info['purchase']== "on"){
 $productId = '12';
}else{
$productId = '9';
}
$upsale = $_POST['oto'];
if(isset($_SESSION["oto"]) && !empty($_SESSION["oto"])){
$oto = $_SESSION["oto"];
}else{
$oto = array();
}
array_push($oto,$_POST['oto']);
$_SESSION["oto"] = $oto;
echo "SUCCESS";
 // $jsonresponse = NewOrderWithLeadKonnective($productId, $upsale, $shipping_price = NULL);
 // $response = json_decode($jsonresponse, TRUE);
 /*  if(!empty($response)){
		 if($response['result'] == "ERROR"){
			 echo json_encode($response);
		 }
		 if($response['result'] == "SUCCESS"){
		     $_SESSION["order_id"] = json_encode($response['message']);
			 echo json_encode($response);
		 }  
     } */
  }
 }
 
 if(isset($_POST['oto_purchase'])){	
if(isset($_SESSION["order_info"]) && $_SESSION["order_info"] != ''){ 
$card_info = json_decode($_SESSION['card_info'], TRUE);

$productId = '9';
$upsale = $_POST['oto_purchase'];
if(isset($_SESSION["oto"]) && !empty($_SESSION["oto"])){
$oto = $_SESSION["oto"];
}else{
$oto = array();
}
if($card_info['purchase']== "on"){
  array_push($oto, '12');
}
array_push($oto,$_POST['oto_purchase']);
$_SESSION["oto"] = $oto;

  $jsonresponse = NewOrderWithLeadKonnective($productId, $_SESSION["oto"], $shipping_price = NULL);
  $response = json_decode($jsonresponse, TRUE);
 if(!empty($response)){
		 if($response['result'] == "ERROR"){
			 echo json_encode($response);
		 }
		 if($response['result'] == "SUCCESS"){
		     $_SESSION["order_id"] = json_encode($response['message']);
			 echo json_encode($response);
		 }  
     } 
  }
 }
 
}

?>