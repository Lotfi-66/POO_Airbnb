<?php
class Address {
    public $id;
    public $address;
    public $zip_code;
    public $country;
    public $city;

    public function __construct($id, $address, $zip_code, $country, $city) {
        $this->id = $id;
        $this->address = $address;
        $this->zip_code = $zip_code;
        $this->country = $country;
        $this->city = $city;
    }
}
?>
