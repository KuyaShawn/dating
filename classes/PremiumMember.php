<?php

/**
 * Class PremiumMember
 * Represents a premium member of the dating site
 */
class PremiumMember extends Member
{
    private $_inDoorInterests;
    private $_outDoorInterests;

    /**
     * PremiumMember constructor.
     * @param $_inDoorInterests
     * @param $_outDoorInterests
     */
    public function __construct($fname = "", $lname = "", $age = 0, $gender = "", $phone = "",
                                $email = "", $state = "", $seeking = "", $bio = "",
                                $_inDoorInterests = array(), $_outDoorInterests = array())
    {
        parent::__construct($fname, $lname, $age, $gender,
            $phone, $email, $state, $seeking, $bio);
        $this->_inDoorInterests = $_inDoorInterests;
        $this->_outDoorInterests = $_outDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getInDoorInterests(): array
    {
        return $this->_inDoorInterests;
    }

    /**
     * @param mixed $inDoorInterests
     */
    public function setInDoorInterests($inDoorInterests): void
    {
        $this->_inDoorInterests = $inDoorInterests;
    }

    /**
     * @return mixed
     */
    public function getOutDoorInterests(): array
    {
        return $this->_outDoorInterests;
    }

    /**
     * @param mixed $outDoorInterests
     */
    public function setOutDoorInterests($outDoorInterests): void
    {
        $this->_outDoorInterests = $outDoorInterests;
    }

}