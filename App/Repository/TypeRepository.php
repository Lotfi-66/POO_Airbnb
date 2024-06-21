<?php 

namespace App\Repository;

use App\Model\Type;
use App\AppRepoManager;
use Core\Repository\Repository;

class TypeRepository extends Repository
{
    public function getTableName(): string
    {
        return 'type';
    }


    public function getAllTypebyName(): ?array
    {
        //on déclare un tableau vide
        $array_result = [];
        $sql = 'SELECT * FROM %s WHERE `is_active` = 1
        ORDER BY `label` ASC';
        $q = sprintf($sql, $this->getTableName());
        $stmt = $this->pdo->query($q);
        if(!$stmt) return $array_result;
        while($row_data = $stmt->fetch()){
            $array_result[] = new Type($row_data);
        }
        return $array_result;
    }

}