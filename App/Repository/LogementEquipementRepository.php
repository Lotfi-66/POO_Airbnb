<?php 

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Equipement;
use Core\Repository\Repository;

class LogementEquipementRepository extends Repository
{
    public function getTableName(): string
    {
        return 'logement_equipement';
    }



    public function getEquipementByLogementId(int $logement_id):array
    {
        //on déclare un tableau vide
        $array_result = [];
        //on crée la requete SQL
        $q = sprintf(
            'SELECT *
            FROM %1$s AS le
            INNER JOIN %2$s AS e ON le.`equipement_id` = e.`id`
            WHERE le.`logement_id` = :id',
            $this->getTableName(), //correspond au %1$s
            AppRepoManager::getRm()->getEquipementRepository()->getTableName()
             //correspond au %2$s
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);
 
        //on vérifie que la requete est bien executée
        if (!$stmt) return $array_result;
 
        //on execute la requete en passant l'id de la pizza
        $stmt->execute(['id' => $logement_id]);
 
        //on récupère les résultats
        while ($row_data = $stmt->fetch()) {
            //a chaque passage de la boucle on instancie un objet ingredient
            $equipement = new Equipement($row_data);
 
        
            $equipement_data = [
                'label' => $row_data['label'],
                'icon' => $row_data['image_path']
            ];
 
            //on peut maintenant instancier un objet Size
            $equipement= new Equipement($equipement_data);
 
            $equipement->id = $row_data['equipement_id'];
 
            //on rempli le tableau avec l'objet Price
            $array_result[] = $equipement;
        }
 
        //on retourne le tableau fraichement rempli
        return $array_result;
    }


    public function insertEquipementByLogementId(array $data)
    {
        //on crée notre requete SQL
        $q = sprintf('INSERT INTO %s (logement_id, equipement_id) VALUES (:logement_id, :equipement_id)', $this->getTableName());
        //on prépare la requete
        $stmt = $this->pdo->prepare($q);
        //on verrifie que la requete est bien bien préparée
        if (!$stmt) return false;
        //si tout est bon, on bind les valeurs
        $stmt->execute($data);

    }
}