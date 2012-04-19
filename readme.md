
## GrameenPhone Aloashbei API

A PHP Class to send SMS and retrieve phone location with ease.

## Usage

### Send SMS
    include_once 'class.AloashbeiSMS.php';
    
    $user_id = '***'; //your registered user id
    $password = '***'; // your account password
    $dev_phone = '***'; //your registered phone number
    $destination = '***'; // destination phone number
    
    $msg = 'Test sms message from GP Aloashbei API'; //message to send
    $type = 4; //type of the message. e.g: 1 = ringtone, 2 = logo, 3 = wap push, 4 = text
    $charge = 0.00; //sms charge
    
    //setup constructor
    $sms = new AloashbeiSMS( $user_id, $password, $dev_phone );

    //setup sms
    $sms->setSMS( $destination, $msg, $type, $charge );

    //send sms
    $result = $sms->send();

    if ( $result->SendSMSResponse->status == 'OK' ) {
        echo '<h2>Message Sent</h2>';
        echo 'Message ID: ' . $result->SendSMSResponse->msgID;
    } else {
        echo "<h1>" . $result->SendSMSResponse->status . "</h1>";
    }

### Check SMS Status
    $sms = new AloashbeiSMS( $user_id, $password, $dev_phone );
    $status = $sms->getStatus($msg_id);
    echo $status->SMSStatusResponse->deliveryStatus;

### Receive SMS
    $receive = $sms->getSMS( $msg_id );
    echo 'Sender: ' . $receive->ReceiveSMSResponse->senderMSISDN . '<br>';
    echo 'Timestamp: ' . $receive->ReceiveSMSResponse->timeStamp . '<br>';
    echo 'Source Port: ' . $receive->ReceiveSMSResponse->sourcePort . '<br>';
    echo 'Message: ' . $receive->ReceiveSMSResponse->msgContent . '<br>';

### Get Phone Location
    include_once 'class.AloashbeiLBS.php';
    
    $lbs = new AloashbeiLBS( $user_id, $password );

    try {
        $result = $lbs->getLocation( PHONE );

        $latitude = $result->LBSResponse->Latitude;
        $longitude = $result->LBSResponse->Longitude;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

## Blog Post
Original link to the [release post 1][1], [release post 2][2]


[1]:http://tareq.wedevs.com/2010/09/php-class-for-sending-receiving-and-checking-sms-status-with-grameenphones-aloashbei-api/
[2]:http://tareq.wedevs.com/2010/09/locate-phone-location-with-gp-aloshbei-location-api-and-visualize-with-google-maps-api/
