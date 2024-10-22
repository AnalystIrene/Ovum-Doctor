<?php

namespace App\Models;

class Patient
{
    private $id;
    private $name;
    private $age;
    private $gender;
    private $address;
    private $phone;
    private $email;

    public function __construct($id, $name, $age, $gender, $address, $phone, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;
        $this->address = $address;
        $this->phone = $phone;
        $this->email = $email;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    // Setters
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
?>