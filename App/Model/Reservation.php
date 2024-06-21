<?php 

namespace App\Model;

use App\Model\User;
use Core\Model\Model;
use App\Model\Logement;


class Reservation extends Model
{
 
  public string $date_start;
  public string $date_end;
  public ?int $nb_adult;
  public ?int $nb_child;
  public ?int $price_total;


  public ?int $logement_id;
  public int $user_id;


  public ?User $user;
  public ?Logement $logement;
 
 
}