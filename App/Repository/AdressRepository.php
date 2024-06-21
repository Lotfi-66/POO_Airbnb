<?php 
namespace App\Repository;

use App\Model\Adress;
use Core\Repository\Repository;

class AdressRepository extends Repository
{
    public function getTableName(): string
    {
        return 'adress';
    }


    public function insertAdress(array $data): ?int
    {
      //on crée la requete SQL
      $q = sprintf(
        'INSERT INTO `%s` (`adress`, `country`, `zip_code`, `phone`) 
        VALUES (:adress, :country, :zip_code  , :phone)',
        $this->getTableName()
      );
  
      //on prépare la requete
      $stmt = $this->pdo->prepare($q);
  
      //on vérifie que la requete est bien préparée
      if (!$stmt) return null;
  
      //on execute la requete en passant les paramètres
      $stmt->execute($data);
  
      //on retourne l'id de la pizza insérée
      return $this->pdo->lastInsertId();
    }

    public function getAdressByLogement(int $logement_id): ?object
    {
      //on crée la requete SQL
      $q = sprintf(
        'SELECT * FROM %s
         WHERE `id` = :logement_id',
        $this->getTableName()
      );

      //on prépare la requete
      $stmt = $this->pdo->prepare($q);

      //on vérifie que la requete est bien préparée
      if (!$stmt) return null;

      //on execute la requete en passant les paramètres
      $stmt->execute(['logement_id' => $logement_id]);

      //on retourne l'objet Adress
      $data = $stmt->fetch();

      return new Adress($data);
        
    }
}