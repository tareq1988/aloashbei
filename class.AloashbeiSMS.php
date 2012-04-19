<?php

include_once 'class.Aloashbei.php';

/**
 * Send, Receive and Check SMS status through GrameenPhone's Aloashbei API
 *
 * @author Tareq Hasan
 * @example http://tareq.weDevs.com
 */
class AloashbeiSMS extends Aloashbei {

    /**
     * Constructor for setting up the class
     *
     * @param string $user_id registered user id
     * @param string $password registered account password
     * @param string $dev_phone test phone number
     */
    function __construct( $user_id, $password, $dev_phone ) {
        parent::__construct( $user_id, $password );

        $this->sourceMsisdn = $dev_phone;
        $this->smsPort = 7424;
        $this->chargedParty = $dev_phone;
        $this->contentArea = 'gpgp_psms';

        $this->soap = new SoapClient( 'includes/WebService_GP_ADP_BizTalk_SMS_Orchestrations.wsdl' );
    }

    /**
     * Set's message parameters
     *
     * @param string $destination message destination phone number
     * @param string $msg message content
     * @param integer $type type of the message. e.g: 1 = ringtone, 2 = logo, 3 = wap push, 4 = text
     * @param double $charge charge amount of the message
     */
    public function setSMS( $destination, $msg, $type, $charge ) {
        $this->destinationMsisdn = $destination;
        $this->msgContent = $msg;
        $this->msgType = $type;
        $this->charge = $charge;

        $this->auth = array(
            'registrationID' => $this->registrationID,
            'password' => $this->password,
            'sourceMsisdn' => $this->sourceMsisdn,
            'destinationMsisdn' => $this->destinationMsisdn,
            'smsPort' => $this->smsPort,
            'msgType' => $this->msgType,
            'charge' => $this->charge,
            'chargedParty' => $this->chargedParty,
            'contentArea' => $this->contentArea,
            'msgContent' => $this->msgContent
        );
    }

    /**
     * Sends the short message
     *
     * @return object send status information: status, msgID
     */
    public function send() {
        $result = $this->soap->sendSMS( array('SendSMSRequest' => $this->auth) );

        return $result;
    }

    /**
     * Retreive SMS with message ID
     *
     * @param string $msg_id sent message id
     * @return object received sms details: msgID, senderMSISDN, timeStamp, sourcePort, msgContent

     */
    public function getSMS( $msg_id ) {
        $this->auth = array(
            'registrationID' => $this->registrationID,
            'password' => $this->password,
            'smsPort' => $this->smsPort,
            'msgID' => $msg_id
        );

        $result = $this->soap->getReceivedSMS( array('ReceiveSMSRequest' => $this->auth) );

        return $result;
    }

    /**
     * Retrieve the SMS's current status
     *
     * @param string $msg_id sent message id
     * @return object status sms details: deliveryStatus
     */
    public function getStatus( $msg_id ) {
        $this->auth = array(
            'registrationID' => $this->registrationID,
            'password' => $this->password,
            'msgID' => $msg_id
        );

        $result = $this->soap->getSMSDeliveryStatus( array('SMSStatusRequest' => $this->auth) );

        return $result;
    }

}
