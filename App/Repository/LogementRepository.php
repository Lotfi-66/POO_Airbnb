<?php

namespace App\Repository;

use App\Model\Type;
use App\Model\User;
use App\Model\Adress;
use App\AppRepoManager;
use App\Model\Logement;
use App\Model\Equipement;
use Core\Repository\Repository;

class LogementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'logement';
  }


  //fonction qui récupére toute les locations 

  public function getAllLogement(): ?array
  {
    //on déclare un tableau vide
    $array_result = [];

    //on crée la requête SQL
    $q = sprintf(
      'SELECT
      l.`id`, 
      l.`title`, 
      l.`description`, 
      l.`price_per_night`, 
      l.`nb_bed`, 
      l.`nb_rooms`, 
      l.`nb_traveler`, 
      l.`is_active`, 
      l.`taille`, 
      l.`type_id`, 
      l.`user_id`, 
      m.`image_path`,
      t.`label`



  FROM %1$s AS l
  INNER JOIN %2$s AS m 
  ON l.`id` = m.`logement_id`
  INNER JOIN %3$s AS t 
  ON l.`type_id` = t.`id`
  WHERE l.`is_active` = 1',


      $this->getTableName(), //correspond au %1$s
      AppRepoManager::getRm()->getMediaRepository()->getTableName(),
      AppRepoManager::getRm()->getTypeRepository()->getTableName()
    );

    //on peut directement executer la requete
    $stmt = $this->pdo->query($q);
    //on vérifie que la requete est bien executée
    if (!$stmt) return $array_result;
    //on récupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {

      //a chaque passage de la boucle on instancie un objet pizza
      $logement = new Logement($row_data);
      $logement->medias[] = $row_data['image_path'];
      $logement->type[] = $row_data['label'];
      $array_result[] = $logement;
    }
    //on retourne le tableau fraichement rempli
    return $array_result;
  }


  public function getLogementById(int $logement_id): ?Logement
  {
    //on crée la requete SQL
    $q = sprintf(
      'SELECT * FROM %s
       WHERE `id` = :id',
      $this->getTableName()
    );

    //on prépare la requete
    $stmt = $this->pdo->prepare($q);

    //on vérifie que la requete est bien préparée
    if (!$stmt) return null;

    //on execute la requete en passant les paramètres
    $stmt->execute(['id' => $logement_id]);

    //on récupère le résultat
    $result = $stmt->fetch();

    //si je n'ai pas de résultat, je retourne null
    if (!$result) return null;

    //si j'ai un résultat, j'instancie un objet Pizza
    $logement = new Logement($result);

    //on va hydrater les ingredients de la pizza
    $logement->medias = AppRepoManager::getRm()->getMediaRepository()->getMediaById($logement_id);

    //je retourne l'objet Pizza
    return $logement;
  }

  public function getAllLogementWithOneImg(): ?array
  {
    //on déclare un tableau vide
    $array_result = [];

    //on crée la requête SQL
    $q = sprintf(
      'SELECT
      l.`id`,
      l.`title`, 
      l.`description`, 
      l.`price_per_night`, 
      l.`nb_bed`, 
      l.`nb_rooms`, 
      l.`nb_traveler`, 
      l.`is_active`, 
      l.`taille`, 
      l.`type_id`, 
      l.`user_id`, 
      m.`image_path`

    FROM 
      logement AS l
    INNER JOIN 
      media AS m 
      ON l.`id` = m.`logement_id`
    INNER JOIN (
      SELECT 
          logement_id, 
          MIN(id) AS min_id
      FROM 
          media
      GROUP BY 
          logement_id
    ) AS subquery 
      ON m.`id` = subquery.min_id
    WHERE 
      l.`is_active` = 1',
      $this->getTableName(), //correspond au %1$s
      AppRepoManager::getRm()->getMediaRepository()->getTableName()

    );

    //on peut directement executer la requete
    $stmt = $this->pdo->query($q);
    //on vérifie que la requete est bien executée
    if (!$stmt) return $array_result;
    //on récupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {

      //a chaque passage de la boucle on instancie un objet pizza
      $logement = new Logement($row_data);
      $logement->medias[] = $row_data['image_path'];
      $logement->type = AppRepoManager::getRm()->getTypeRepository()->readById(Type::class, $logement->type_id);
      $logement->equipement = AppRepoManager::getRm()->getLogementEquipementRepository()->getEquipementByLogementId($logement->id);
    
      $array_result[] = $logement;
    }
    //on retourne le tableau fraichement rempli
    return $array_result;
  }


  public function insertLogement(array $data)
  {
    $q = sprintf(
      "INSERT INTO %s (user_id, price_per_night, nb_rooms,nb_bed, nb_traveler, taille, description, title, is_active, type_id, address_id)
           VALUES (:user_id, :price_per_night, :nb_rooms, :nb_bed, :nb_traveler, :taille, :description, :title, :is_active , :type_id, :address_id) ",
      $this->getTableName()
    );


    $stmt = $this->pdo->prepare($q);

    if (!$stmt) return false;

    $stmt->execute($data);

    return $this->pdo->lastInsertId();
  }



  public function getAllLogementByUserId(int $userId)
  {
    //on déclare un tableau vide
    $array_result = [];

    //on crée la requête SQL
    $q = sprintf(
      'SELECT *
    FROM %s   
    WHERE `user_id` = :userId 
    AND `is_active` = 1',
      $this->getTableName() //correspond au %1$s
     
    );

    //on peut directement executer la requete
    $stmt = $this->pdo->prepare($q);
    //on vérifie que la requete est bien executée
    if (!$stmt) return $array_result;
    $stmt->execute(['userId' => $userId]);

    //on récupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {

      //a chaque passage de la boucle on instancie un objet pizza
      $logement = new Logement($row_data);
      //$logement->medias[] = $row_data['image_path'];
      $logement->medias = AppRepoManager::getRm()->getMediaRepository()->getMediaById($logement->id);
      $logement->reservations = AppRepoManager::getRm()->getReservationRepository()->getReservationByLogementId($logement->id);
      $logement->user = AppRepoManager::getRm()->getUserRepository()->readById(User::class, $logement->user_id);
      $logement->type = AppRepoManager::getRm()->getTypeRepository()->readById(Type::class, $logement->type_id);
      $logement->adress = AppRepoManager::getRm()->getAdressRepository()->readById(Adress::class, $logement->address_id);
      $array_result[] = $logement;
    }
    //on retourne le tableau fraichement rempli
    return $array_result;
  }
  



  public function deleteLogement(int $id): bool
  {
    //on crée la requête
    $query = sprintf(
      'UPDATE %s  SET `is_active`=0 WHERE `id`=:id',
      $this->getTableName()
    );

    //on prépare la requete
    $stmt = $this->pdo->prepare($query);

    //on vérifie si la requete s'est bien préparée
    if (!$stmt) return false;

    //on execute la requete en bindant les paramètres
    return $stmt->execute(['id' => $id]);
  }


  public function getAllLogementByPrice(): ?array
  {
    //on déclare un tableau vide
    $array_result = [];

    //on crée la requête SQL
    $q = sprintf(
      'SELECT
          l.`id`, 
          l.`title`, 
          l.`description`, 
          l.`price_per_night`, 
          l.`nb_bed`, 
          l.`nb_rooms`, 
          l.`nb_traveler`, 
          l.`is_active`, 
          l.`taille`, 
          l.`type_id`, 
          l.`user_id`, 
          MAX(m.`image_path`) AS image_path
      FROM 
          %1$s AS l
      INNER JOIN 
          %2$s AS m 
      ON l.`id` = m.`logement_id`
      WHERE l.`is_active` = 1
      GROUP BY l.`id`
      ORDER BY l.`price_per_night` ASC
  ',
      $this->getTableName(), //correspond au %1$s
      AppRepoManager::getRm()->getMediaRepository()->getTableName()
  );
  

    //on peut directement executer la requete
    $stmt = $this->pdo->query($q);
    //on vérifie que la requete est bien executée
    if (!$stmt) return $array_result;
    //on récupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {

      //a chaque passage de la boucle on instancie un objet pizza
      $logement = new Logement($row_data);
      $logement->medias[] = $row_data['image_path'];
      $logement->type = AppRepoManager::getRm()->getTypeRepository()->readById(Type::class, $logement->type_id);
    
      $array_result[] = $logement;
    }
    //on retourne le tableau fraichement rempli
    return $array_result;
  }


  public function getAllLogementByType(): ?array
  {
    //on déclare un tableau vide
    $array_result = [];

    //on crée la requête SQL
    $q = sprintf(
      'SELECT
          l.`id`, 
          l.`title`, 
          l.`description`, 
          l.`price_per_night`, 
          l.`nb_bed`, 
          l.`nb_rooms`, 
          l.`nb_traveler`, 
          l.`is_active`, 
          l.`taille`, 
          l.`type_id`, 
          l.`user_id`, 
          MAX(m.`image_path`) AS image_path
      FROM 
          %1$s AS l
      INNER JOIN 
          %2$s AS m 
      ON l.`id` = m.`logement_id`
      WHERE l.`is_active` = 1
      GROUP BY l.`id`
      ORDER BY l.`type_id` ASC
  ',
      $this->getTableName(), //correspond au %1$s
      AppRepoManager::getRm()->getMediaRepository()->getTableName()
  );

    //on peut directement executer la requete
    $stmt = $this->pdo->query($q);
    //on vérifie que la requete est bien executée
    if (!$stmt) return $array_result;
    //on récupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {

      //a chaque passage de la boucle on instancie un objet pizza
      $logement = new Logement($row_data);
      $logement->medias[] = $row_data['image_path'];
      $logement->type = AppRepoManager::getRm()->getTypeRepository()->readById(Type::class, $logement->type_id);
    
      $array_result[] = $logement;
    }
    //on retourne le tableau fraichement rempli
    return $array_result;
  }


  
}
