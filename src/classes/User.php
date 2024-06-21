<?php
class User {
    public $id;
    public $email;
    public $password;
    public $lastname;
    public $firstname;
    public $phone;
    public $is_active;
    public $address_id;

    public function __construct($id, $email, $password, $lastname, $firstname, $phone, $is_active, $address_id) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->phone = $phone;
        $this->is_active = $is_active;
        $this->address_id = $address_id;
    }
}
?>
