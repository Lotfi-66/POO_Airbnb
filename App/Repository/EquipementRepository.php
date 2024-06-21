<?php 

namespace App\Repository;

use App\Model\Equipement;
use Core\Repository\Repository;

class EquipementRepository extends Repository
{
    public function getTableName(): string
    {
        return 'equipement';
    }


    public function getAllEquipement():array
    {
        return $this->readAll(Equipement::class);

    }


}