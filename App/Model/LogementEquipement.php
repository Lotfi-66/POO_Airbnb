<?php 

namespace App\Model;

use Core\Model\Model;


class LogementEquipement extends Model
{


  public int $equipement_id;
  public int $logement_id;
  

  public ?Logement $logement;
  public ?Equipement $equipement;
  
 
}