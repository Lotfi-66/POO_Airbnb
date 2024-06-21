<?php 

namespace App\Model;

use Core\Model\Model;

class User extends Model
{
  public string $email;
  public string $password;
  public string $lastname;
  public string $firstname;
  public bool $is_active;
  public bool $adress_id;


  public ?Adress $adress;
 
}