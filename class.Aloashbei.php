<?php

/**
 * Main Aloashbei class that holds the variables
 *
 * @author Tareq Hasan
 * @example http://tareq.weDevs.com
 */
class Aloashbei {

    /**
     * This will contain the SOAP object
     *
     * @var object
     */
    protected $soap;

    /**
     * This array will contain setup information
     *
     * @var array
     */
    protected $auth = array();

    /**
     * This ID will be created by each developer during the registration process.
     *
     * @var string
     */
    protected $registrationID;

    /**
     * Developer password
     *
     * @var string
     */
    protected $password;

    /**
     * In “88017xxxxxxxx” format. Always will be developers registered MSISDN.
     *
     * @var string
     */
    protected $sourceMsisdn;

    /**
     * Destination MSISDN  number. The number will be in “88017xxxxxxxx” format.
     *
     * @var string
     */
    protected $destinationMsisdn;

    /**
     * The following value should be populated in this parameter – 7424.
     *
     * @var integer
     */
    protected $smsPort;

    /**
     * Message Type accroding to content.
     *
     * @var integer
     */
    protected $msgType;

    /**
     * Charge amount for sending the SMS. Only whole numbers can be charged and
     * the amount must be provided in double format (i.e 2.00).
     *
     * @var double
     */
    protected $charge;

    /**
     * This must be the registered number of the developer.
     * @var string
     */
    protected $chargedParty;

    /**
     * The following value should be populated in this parameter – gpgp_psms.
     *
     * @var string
     */
    protected $contentArea;

    /**
     * Actual message.
     *
     * @var string
     */
    protected $msgContent;

    /**
     * Set's user's user id and password
     *
     * @param string $user_id registered user id
     * @param string $password registered password
     */
    function __construct( $user_id, $password ) {
        $this->registrationID = $user_id;
        $this->password = $password;
    }

}
