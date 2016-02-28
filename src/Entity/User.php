<?php
namespace ThirdPartyAuthModule\Entity;

class User
{
    protected $id      = null;
    protected $user_id = null;
    protected $api_key = null;

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of User Id
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the value of Api Key
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->api_key;
    }
}
