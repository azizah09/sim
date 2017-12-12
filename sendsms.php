<?php 
	if(isset($_POST['phone']) && isset($_POST['message']))
	{
		$phone = $_POST['phone'];
		$message = $_POST['message'];

		echo "$phone, $message";

		sendSMS($phone, $message);
	}
	else
	{
		echo "Enter all details";
	}

	function sendSMS($contacts, $message)
	{
		$data = '{
	        "message":"'.$message.'",
	        "recipient":"'.$contacts.'",
	        "username":"xxxxxx",
	        "apikey":"xxxxxxxxx",
	        "senderId":"xxxxxxxxx"
	    }';
	    // replace the xxx with your own useerame, apikey and senderid.

	    $ch = curl_init('http://mobilesasa.com/sendsmsjson.php');
	    curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false); //set this to false if you are getting the error message -SSL certificate problem: unable to get local issuer certificate
	    curl_setopt($ch,CURLOPT_HTTPHEADER,array(
	        'Content-Type:application/json',
	        'Content-Length:'.strlen($data))
	    );

	    $result = curl_exec($ch);
	    $decodedresult = json_decode($result,true);

	    /*Uncomment the code below to get any error messages and raw response*/
	    /*var_dump($result);
	    var_dump(curl_getinfo($ch));
	    var_dump(curl_errno($ch));
	    var_dump(curl_error($ch));*/

	    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);//used to find out if the response reached the Mobilesasa servers
	    if($resultStatus == 200)//if successful
	    {
	        foreach($decodedresult as $itemouter)
	        {
	            foreach($itemouter as $item)
	            {
	                $phoneNumber = $item['phonenumber'];//the SMS phone number
	                $status = $item['status'];//1701 indicates sent and 0 indicates failed
	                $messageId = $item['messageId'];//unique message identifier
	                $cost = $item['cost'];//total SMS cost
	                $response = $item['message'];//the response explaining why status is as it is

	                echo $phoneNumber.",".$status.",".$messageId.",",$cost.",".$response."<br/>";
	                echo "<script type='text/javascript'>
            				alert( '$phoneNumber.",".$status.",".$messageId.",",$cost.",".$response \n');
            				</script>";
            		echo "<script>
            				window.location = 'sms2.php'
            			</script>";
	            }
	        }
	    }
	    else
	    {
	        echo "My internet is low";
	    }
	}

?>