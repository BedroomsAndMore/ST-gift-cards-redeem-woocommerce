<?php
/**
 * Updates a giftcard's status from one status to another.
 *
 * @since 1.0
 * @param int $code_id Giftcard ID (default: 0)
 * @param string $new_status New status (default: active)
 * @return bool
 */
function wpr_update_giftcard_status( $code_id = 0, $new_status = 'active' ) {
	$giftcard = wpr_get_giftcard( $code_id );

	if ( $giftcard ) {
		do_action( 'wpr_pre_update_giftcard_status', $code_id, $new_status, $giftcard->post_status );

		wp_update_post( array( 'ID' => $code_id, 'post_status' => $new_status ) );

		do_action( 'wpr_post_update_giftcard_status', $code_id, $new_status, $giftcard->post_status );

		return true;
	}

	return false;
}

/**
 * Retrieve the giftcard number
 *
 * @since 1.4
 * @param int $code_id Giftcard ID
 * @return string $expiration Giftcard expiration
 */
function wpr_get_giftcard_number( $code_id = null ) {
	$number = get_post_meta( $code_id, '_wpr_giftcard_number', true );

	return apply_filters( 'wpr_get_giftcard_number', $number, $code_id );
}

/**
 * Retrieve the giftcard to name
 *
 * @since 1.4
 * @param int $code_id
 * @return string $code Giftcard To Name
 */
function wpr_get_giftcard_to( $code_id = null ) {
	$to = get_post_meta( $code_id, 'rpgc_to', true );

	return apply_filters( 'wpr_get_giftcard_to', $to, $code_id );
}

/**
 * Retrieve the giftcard to email
 *
 * @since 1.4
 * @param int $code_id
 * @return string $code Giftcard To Email
 */
function wpr_get_giftcard_to_email( $code_id = null ) {
	$toEmail = get_post_meta( $code_id, 'rpgc_email_to', true );

	return apply_filters( 'wpr_get_giftcard_toEmail', $toEmail, $code_id );
}

/**
 * Retrieve the giftcard from
 *
 * @since 1.4
 * @param int $code_id
 * @return string $code Giftcard From Name
 */
function wpr_get_giftcard_from( $code_id = null ) {
	$from = get_post_meta( $code_id, 'rpgc_from', true );

	return apply_filters( 'wpr_get_giftcard_from', $from, $code_id );
}

/**
 * Retrieve the giftcard from email
 *
 * @since 1.4
 * @param int $code_id
 * @return string $code Giftcard From Email
 */
function wpr_get_giftcard_from_email( $code_id = null ) {
	$fromEmail = get_post_meta( $code_id, 'rpgc_email_from', true );

	return apply_filters( 'wpr_get_giftcard_fromEmail', $fromEmail, $code_id );
}

/**
 * Retrieve the giftcard note
 *
 * @since 1.4
 * @param int $code_id
 * @return string $code Giftcard Note
 */
function wpr_get_giftcard_note( $code_id = null ) {
	$note = get_post_meta( $code_id, 'rpgc_note', true );

	return apply_filters( 'wpr_get_giftcard_note', $note, $code_id );
}

/**
 * Retrieve the giftcard code expiration date
 *
 * @since 1.4
 * @param int $code_id Giftcard ID
 * @return string $expiration Giftcard expiration
 */
function wpr_get_giftcard_expiration( $code_id = null ) {
	$expiration = get_post_meta( $code_id, 'rpgc_expiry_date', true );

	return apply_filters( 'wpr_get_giftcard_expiration', $expiration, $code_id );
}

/**
 * Retrieve the giftcard amount
 *
 * @since 1.4
 * @param int $code_id Giftcard ID
 * @return int $amount Giftcard code amount
 * @return float
 */
function wpr_get_giftcard_amount( $code_id = null ) {
	$amount = get_post_meta( $code_id, 'rpgc_amount', true );

	return (float) apply_filters( 'wpr_get_giftcard_amount', $amount, $code_id );
}

/*function socket_programming($string)
{
//echo $string;
$person='string_input Log'.date('Y-m-d H:i:s')."\n";
$person.=$string."\n";
$person.='string_ Out Put  Log'.date('Y-m-d H:i:s')."\n";
file_put_contents('t.txt',$string);
$response = '';
$domain = "www.smart-transactions.com";
$gateway = "gateway_no_lrc.php";
$domainForSocket = "ssl://".$domain;
$infoPacket = fsockopen($domainForSocket, '443', $errno, $errstr, 60);
if($infoPacket) {
$header = "POST /". $gateway ." HTTP/1.0\n" .
"Content-type: application/x-www-form-urlencoded\n" .
"Content-length: " . strlen($string) . "\n" .
"Connection: close\n\n";
//echo "<pre>$header</pre>";
$dataToWrite = $header . $string;
fwrite($infoPacket, $dataToWrite);
while(!feof($infoPacket)){
$response .= fgets($infoPacket,1024);
}
fclose($infoPacket);
}
//file_put_contents('rm.txt',json_encode($response));
$response = preg_replace('/\n/', ' ', preg_replace('/\r/', ' ', $response));
$response = trim($response);
preg_match("/<Response>(.*?)\<\/Response>/", $response, $xmlstg_pm);
$xmlstg = $xmlstg_pm[1];
$returnedArray = array();
preg_match_all("/<(.*?)>(.*?)\</", $xmlstg, $out, PREG_SET_ORDER);
$n = 0;
while(isset($out[$n])){
$returnedArray[$out[$n][1]] = strip_tags($out[$n][0]);
$n++;
}
file_put_contents('rt.txt',json_encode($returnedArray));
$person.=json_encode($returnedArray)."\n";
file_put_contents('rm.txt', $person, FILE_APPEND);
//echo $person;
//exit;
return $returnedArray;

}*/

function socket_programming($request)
{
	$ch = curl_init();	
	$url = "https://smarttransactions.net/gateway_no_lrc.php";
	$data_string = $request;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$xml = simplexml_load_string($response);		
	return (array)$xml;
	
}


function wpr_set_session_data($store_array,$new_card)
{
$assoc_array=json_decode($store_array);
if(count($assoc_array)>0)
{
$assoc_array[]=$new_card;
}
else
{
$assoc_array=array();
$assoc_array[]=$new_card;
}
$json_array=json_encode($assoc_array);
WC()->session->giftcard_post=$json_array;
//print_r($json_array);
//exit;
return true;
}
function wpr_get_total_giftcard_balance($array)
{
$assoc_array=json_decode($array);
$bal=0;
foreach($assoc_array as $row)
{

$giftcard_number=$row;
$newbal=wpr_get_giftcard_balance($giftcard_number);
$bal=$bal+$newbal;
}
return $bal;
}
function check_card_number_exist($store_array,$new_card)
{
$assoc_array=json_decode($store_array);
if(count($assoc_array)==0)
$assoc_array=array();
if(in_array($new_card, $assoc_array)) 
{
return true;
}
else
{
return false;
}
}


/**
 * Retrieve the giftcard balance
 *
 * @since 1.4
 * @param int $code_id Giftcard ID
 * @return int $amount Giftcard code balance
 * @return float
 */
function wpr_get_giftcard_balance( $code_id = null ) 
{
$merchant_id= get_option('woocommerce_giftcard_merchant_id');
$terminal_id= get_option('woocommerce_giftcard_terminal_id');
$card_id=$code_id;
//$xmlarray=$xmlRequest='<Request><Merchant_Number>'.$merchant_id.'</Merchant_Number><Terminal_ID>'.$terminal_id.'</Terminal_ID><Action_Code>05</Action_Code><Trans_Type>N</Trans_Type><POS_Entry_Mode>S</POS_Entry_Mode><Track_Data2>'.$card_id.'</Track_Data2></Request>';
  $xmlRequest='<Request><Merchant_Number>'.$merchant_id.'</Merchant_Number><Terminal_ID>'.$terminal_id.'</Terminal_ID><Action_Code>05</Action_Code><Trans_Type>N</Trans_Type><POS_Entry_Mode>S</POS_Entry_Mode><Track_Data2>'.$card_id.'</Track_Data2></Request>';
  //print_r($xmlRequest);
 $response_array=socket_programming($xmlRequest);
 //print_r($response_array);
 //exit;
  if($response_array['Response_Code']=='00')
  {
    $balance= (float)  $response_array['Amount_Balance'];
  }
  else
  {
  $balance= "Invalid";
  }
	//$balance = get_post_meta( $code_id, 'rpgc_balance', true );

	return  apply_filters( 'wpr_get_giftcard_balance', $balance, $code_id );
}


/**
 * Sets the giftcard balance
 *
 * @since 1.4
 * @param int $code_id Giftcard ID
 * @return int $amount Giftcard code amounts
 * @return float
 */
function wpr_set_giftcard_balance( $code_id = null, $newBalance = null )
 {
	
	update_post_meta( $code_id, 'rpgc_balance', $newBalance );
}


function wpr_update_stm_giftcard_balance($card_array,$newBalance,$deduct_amount,$transaction_id,$order_id)
{
    $assoc_array=json_decode($card_array);
    $bal=0;
    $au_array=array();
   $deduct_amount;
	foreach($assoc_array as $card_number)
	{
        if($deduct_amount==0)
	    { 
	     break;
	     }
	 	   $balance=wpr_get_giftcard_balance($card_number) ;
		     if($deduct_amount >= $balance)
			 {
			 $deducated_amount=$balance;
			 $deduct_amount=$deduct_amount-$deducated_amount;
			 }
			 else
			{
			$deducated_amount=$deduct_amount;
			$deduct_amount=0;
			}
			
			file_put_contents('elog.txt','rajesh');
			$merchant_id= get_option('woocommerce_giftcard_merchant_id');
			$terminal_id= get_option('woocommerce_giftcard_terminal_id');
			 $xmlReq='<Request><Merchant_Number>'.$merchant_id.'</Merchant_Number><Terminal_ID>'.$terminal_id.'</Terminal_ID><Business_Type>F</Business_Type><Action_Code>01</Action_Code><Trans_Type>N</Trans_Type><POS_Entry_Mode>M</POS_Entry_Mode><Card_Number>'.$card_number.'</Card_Number><Transaction_Amount>'.$deducated_amount.'</Transaction_Amount><Transaction_ID>'.$transaction_id.'</Transaction_ID></Request>';
			$response=socket_programming($xmlReq);

			if($response['Response_Code']=='00')
			{
			   $Auth_Reference= $response['Auth_Reference'];
			   $card_auth_ref=$card_number.'_'.$Auth_Reference;
			   $au_array[]=$card_auth_ref;
			
			   $balance= (float)  $response['Amount_Balance'];
			 // return true;
			}
			else
			{
			  // return false ;
			  // $balance= "Invalid";
			}
	}
	//print_r($au_array);
	//print_r($assoc_array);
	//exit;
	update_post_meta( $order_id, 'rpgc_Auth_Reference', json_encode($au_array));
	 return true;
  

}


// Order Gift Card Functions
// ******************************************************************************************

function wpr_get_order_card_number ( $order_id = null ) {
	
	$id = get_post_meta( $order_id, 'rpgc_gift_card_number', true );
	$number = get_the_title( $id );

	return apply_filters( 'wpr_get_order_card_number', $number, $order_id );
}

function wpr_get_order_card_balance ( $order_id = null ) {
	
	$balance = get_post_meta( $order_id, 'rpgc_balance', true );

	return apply_filters( 'wpr_get_order_card_balance', $balance, $order_id );
}

function wpr_get_order_card_payment ( $order_id = null ) {
	$payment = get_post_meta( $order_id, 'rpgc_payment', true );

	return apply_filters( 'wpr_get_order_card_payment', $payment, $order_id );
}

function wpr_get_order_refund_status ( $order_id = null ) 
{
    $refunded = get_post_meta( $order_id, 'rpgc_refunded', true );
	return apply_filters( 'wpr_get_order_refund_status', $refunded, $order_id );
}

	



function wpr_is_giftcard ( $giftcard_id ) {
	
	$giftcard = get_post_meta( $giftcard_id, '_giftcard', true );

	if ( $giftcard != 'yes' ) {
		return false;
	}

	return true;
}