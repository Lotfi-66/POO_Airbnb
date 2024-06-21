<?php 

namespace App\Model;

use Core\Model\Model;


class Logement extends Model
{

  public string $title;
  public string $description;
  public int $price_per_night;
  public int $nb_rooms;
  public int $nb_bed;
  public int $nb_bath;
  public int $nb_traveler;
  public bool $is_active;
  public int $taille;

  public int $type_id;
  public int $user_id;
  public int $address_id;

  public ?User $user;
  public ?Type $type;
  public ?Adress $adress;
  

  public array $medias;
  public array $reservations;
  
  
 
}