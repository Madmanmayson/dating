<?php


class PremiumMember extends Member
{
    private $_outdoorInterests;
    private $_indoorInterests;

    /**
     * Premium constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_outdoorInterests = array();
        $this->_indoorInterests = array();
    }

    /**
     * @return array
     */
    public function getOutdoorInterests(): array
    {
        return $this->_outdoorInterests;
    }

    /**
     * @param array $outdoorInterests
     */
    public function setOutdoorInterests(array $outdoorInterests): void
    {
        $this->_outdoorInterests = $outdoorInterests;
    }

    /**
     * @return array
     */
    public function getIndoorInterests(): array
    {
        return $this->_indoorInterests;
    }

    /**
     * @param array $indoorInterests
     */
    public function setIndoorInterests(array $indoorInterests): void
    {
        $this->_indoorInterests = $indoorInterests;
    }
}