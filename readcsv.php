<?php 	
if (isset($_POST['send']))
{

	$contactsfile = $_POST['csv'];
	$singleMessage = $_POST['message'];

	$file = fopen($contactsfile,"r");
	while(!feof($file))
	{
		$selectedRow = fgetcsv($file);//get the next row in CSV

		if(!empty($selectedRow))
		{
			foreach($selectedRow as $sendingContact)	
			{
				if(!empty($sendingContact))
				{
					//check if contacts are separated by white space characters e.g. space, tab, carriage return, new line
					if(preg_match('/\s/',$sendingContact) > 0)//more than one in this
					{
						$parts = preg_split('/\s+/', $sendingContact);

						foreach($parts as $theSelectedContact)
						{
							if(!empty($theSelectedContact))
							{
								sendSMS($theSelectedContact,$singleMessage);
							}
						}
					}
					else
					{						
						sendSMS($sendingContact,$singleMessage);
					}
				}
			}	
		}				
	}

}
	function sendSMS($contacts, $message)
	{
		$data = '{
	        "message":"'.$message.'",
	        "recipient":"'.$contacts.'",
	        "username":" xxxxx",
	        "apikey":"xxxxx",
	        "senderId":"xxxxxxx"
	    }';//Replace the username, APIKEY and senderID with your own

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

	               	echo "<script type='text/javascript'>
            				alert( '$phoneNumber.",".$status.",".$messageId.",",$cost.",".$response ');
            				</script>";
            		echo "<script>
            				window.location = 'sms2.php'
            			</script>";
            		
	               
	            }
	        }
	    }
	    else
	    {
	        echo "My internet is down";
	    }
	}
					
?>