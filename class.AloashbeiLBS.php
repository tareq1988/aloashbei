<?php

include_once 'class.Aloashbei.php';

/**
 * Description of class
 *
 * @author Tareq Hasan
 * @link http://tareq.weDevs.com
 */
class AloashbeiLBS extends Aloashbei {

    /**
     * The mobile number that to be located
     *
     * @var string
     */
    private $msisdn;

    /**
     * Set's user's user id and password
     *
     * @param string $user_id registered user id
     * @param string $password registered password
     */
    function __construct( $user_id, $password ) {
        parent::__construct( $user_id, $password );

        $this->soap = new SoapClient( 'includes/WebService_Aloashbei_LBS_WS.wsdl' );
    }

    /**
     * Retreives current mobile location
     *
     * @param string $number mobile number
     * @return object location details: Status, Latitude, Longitude, Timestamp

     */
    function getLocation( $number ) {
        $this->msisdn = $number;

        $this->auth = array(
            'registrationID' => $this->registrationID,
            'password' => $this->password,
            'msisdn' => $this->msisdn
        );

        $result = $this->soap->requestLocation( array('LBSRequest' => $this->auth) );

        return $result;
    }

}