<?php
// Path: gyn-main/models/Doctor.php
// To establish a connection to the database, you need to include the database options file.
include './databaseoptions.php';
// Compare this snippet from gyn-main/seeall.php:
class Doctor {
    private $id;
    private $name;
    private $specialization;
    private $email;
    private $phone;

    public function __construct($id, $name, $specialization, $email, $phone) {
        $this->id = $id;
        $this->name = $name;
        $this->specialization = $specialization;
        $this->email = $email;
        $this->phone = $phone;
    }

    // Getters
    public function getId() {
        return $id;
    }

    public function getName() {
        return $name;
    }

    public function getSpecialization() {
        return $specialization;
    }

    public function getEmail() {
        return $email;
    }

    public function getPhone() {
        return $phone;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setSpecialization($specialization) {
        $this->specialization = $specialization;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }
}
?>