<?php

include_once("db.php");

if (!class_exists('db_submit'))
{
class db_submit extends DB
{
	function db_submit()
	{


		$this->database = "";
		$this->table = "tbl_submissions";
		$this->idfield = "sub_id";
		$this->formsubmit =	"sub_submit";

		$this->props = array(
		"sub_id" => "",
		"sub_name"	=> "",
		"sub_applying"	=> "",
		"sub_salary"	=> "",
		"sub_salary2"	=> "",
		"sub_children"	=> "",
		"sub_loan"	=> "",
		"sub_pension"	=> "",
		"sub_credit"	=> "",
		"sub_gym"	=> "",
		"sub_food"	=> "",
		"sub_drink"	=> "",
		"sub_childcare"	=> "",
		"sub_travel"	=> "",
		"sub_email"	=> "",
		"sub_date"	=> ""
	);


		$this->debug=true;
		$this->required	= array();
	}


	function deletefromget(){
		$sql = "DELETE FROM ".$this->table." WHERE ".$this->idfield." = ".$_GET['deleteap'];
		$this->execute($sql);

	}


	function sendconfirm()
	{


		echo $this->props['sub_id'];

		$this->getSingle();

		if( $this->props['sub_id']!=1){

		echo "1";


			require_once("PHPMailer/PHPMailerAutoload.php");
		   	echo "2";

		   $mail = new PHPMailer();
		   $mail->IsSMTP();
		   $mail->CharSet = 'UTF-8';

		   $mail->Mailer = "smtp";
		   $mail->Host = "mail.smtp2go.com"; //Enter your SMTP2GO account's SMTP server.
		   $mail->Port = "2525"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
		   $mail->SMTPAuth = true;
		   //$mail->SMTPSecure = 'ssl'; // Uncomment this line if you want to use SSL.
		   $mail->Username = "david@homeonfilm.com";
		   $mail->Password = "patchdog1966DV";

		   $mail->From     = "chirpy@tmpmortgages.co.uk";

		   $mail->FromName = "TMP The Mortgage People ";

		  	//$mail->AddAddress($this->props['sub_email']);

		  	//$mail->AddAddress('chirpy@tmpmortgages.co.uk');

		  	$mail->AddAddress('mike@underneaththestars.co.uk');

		  		$mail->IsHTML(true);
			   $mail->Subject  = "Thank you for completing the calculator on TMP.";
			   $mail->Body     = $this->getTemplate();
			$body = $this->getTemplate();

				echo "3";


			   $mail->WordWrap = 50;
			  // To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: '.$this->props['sub_name'].' <'.$this->props['sub_email'].'>' . "\r\n";
$headers .= 'To: TMP <chirpy@tmpmortgages.co.uk>' . "\r\n";

$headers .= 'From: TMP The Mortgage People <chirpy@tmpmortgages.co.uk>' . "\r\n";
//$headers .= 'Bcc: chirpy@tmpmortgages.co.uk' . "\r\n";


			  mail('chirpy@tmpmortgages.co.uk',"Thank you for completing the calculator on TMP.", $body, $headers);
			 /*

				 if(!$mail->Send()) {

					echo 'Message was not sent.';
					echo 'Mailer error: ' . $mail->ErrorInfo;

			   } else {
					echo 'Message has been sent.';

			   }
		  	*/
		  	echo "4";

		}else{
			echo "no id";
		}
	}



	function getTemplate(){

	$htnl = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>TMP</title>

  <style type="text/css">
<!--
body{
	background-color:#FFFFFF;
	color:#646464;
	font-family:Arial, Helvetica, sans-serif;
	font-size:16px;
}
*{

	color:#646464;
	font-family:Arial, Helvetica, sans-serif !important;
	font-size:16px;

}
li{
	margin-left:20px;
}

table, td, p{
	color:#646464;
}
-->
</style>
</head>

<body>
<table width="600" >
<tr><td>
';
$html .="Name: ".$this->props['sub_name']." <br/>";

if($this->props['sub_applying']=='myself'){
	$html .="Applying by myself <br/>";

	$html .="Salary: &pound;".$this->props['sub_salary']." <br/> " ;



}else{
	$html .="Applying by with someone else  <br/>";

	$html .="Salary 1: &pound;".$this->props['sub_salary']." <br/> " ;

	$html .="Salary 2: &pound;".$this->props['sub_salary2']." <br/> " ;
}

$html .="Number of children: ".$this->props['sub_children']." <br/> " ;

$html .="Monthly loan payments: &pound;".$this->props['sub_loan']." <br/> " ;

$html .="Monthly pension payments: &pound;".$this->props['sub_pension']." <br/> " ;

$html .="The total owed on credit cards: &pound;".$this->props['sub_credit']." <br/> " ;

$html .="Gym cost: &pound;".$this->props['sub_gym']." <br/> " ;

$html .="Food cost: &pound;".$this->props['sub_food']." <br/> " ;

$html .="Spend on coffee: &pound;".$this->props['sub_drink']." <br/> " ;

$html .="Childcare costs: &pound;".$this->props['sub_childcare']." <br/> " ;

$html .="Travel costs: &pound;".$this->props['sub_travel']." <br/> " ;

$html .="Email address: ".$this->props['sub_email']." <br/> " ;





$html .='
</td></tr>

</table>
</body>

</html> ';

return $html;

	}

}
}

?>