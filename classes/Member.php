<?php

class Member
{
    private $_fName;
    private $_lName;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $_fName
     * @param $_lName
     * @param $_age
     * @param $_gender
     * @param $_phone
     * @param $_email
     * @param $_state
     * @param $_seeking
     * @param $_bio
     */
    public function __construct($fname="", $lname="", $age=0, $gender="", $phone="",
                                $email="", $state="", $seeking="", $bio="")
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_state = $state;
        $this->_seeking = $seeking;
        $this->_bio = $bio;
    }


    /**
     * @return mixed
     */
    public function getFName(): string
    {
        return $this->_fName;
    }

    /**
     * @param string $fName
     */
    public function setFName($fName): void
    {
        $this->_fName = $fName;
    }

    /**
     * @return string
     */
    public function getLName(): string
    {
        return $this->_lName;
    }

    /**
     * @param string $lName
     */
    public function setLName($lName): void
    {
        $this->_lName = $lName;
    }

    /**
     * @return string
     */
    public function getAge(): int
    {
        return $this->_age;
    }

    /**
     * @param string $age
     */
    public function setAge($age): void
    {
        $this->_age = $age;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->_gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender): void
    {
        $this->_gender = $gender;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->_phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->_state;
    }

    /**
     * @param string $state
     */
    public function setState($state): void
    {
        $this->_state = $state;
    }

    /**
     * @return string
     */
    public function getSeeking(): string
    {
        return $this->_seeking;
    }

    /**
     * @param string $seeking
     */
    public function setSeeking($seeking): void
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->_bio;
    }

    /**
     * @param string $bio
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }

}