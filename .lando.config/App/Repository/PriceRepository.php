<?php

namespace App\Repository;

use App\Model\Size;
use App\Model\Price;
use App\AppRepoManager;
use Core\Repository\Repository;

class PriceRepository extends Repository
{
    public function getTableName(): string
    {
        return 'price';
    }


    /**
     * méthode qui permet de récuperer tout les prix et la taille d'une pizza grace a son id
     * @param int $pizza_id
     * @return array
     */
    public function getPriceByPizzaId(int $pizza_id): array
    {
        //on déclare un tableau vide
        $array_result = [];
        //on crée la requete sql
        $q = sprintf(
            'SELECT p.*, s.`label` 
            FROM %1$s AS p
            INNER JOIN %2$s AS s 
            ON p.`size_id` = s.`id`
            WHERE p.`pizza_id` = :id',
            $this->getTableName(), //correspond au %1$s
            AppRepoManager::getRm()->getSizeRepository()->getTableName() //correspond au %2$s
        );

        //on prépare la requete 
        $stmt = $this->pdo->prepare($q);

        //on vérifie que la requete est bien executée
        if (!$stmt) return $array_result;

        //on execute la requete en passant l'id de la pizza
        $stmt->execute(['id' => $pizza_id]);

        //on récupere les resultats
        while ($row_data = $stmt->fetch()) {
            // a chaque passage de la boucle on instancie un objet pizza
            $price = new Price($row_data);

            //on va reconstruire a la main un tableau pour crée une instance de size
            $size_data = [
                'id' => $row_data['size_id'],
                'label' => $row_data['label']
            ];

            $size = new Size($size_data);

            //on va hydrater Price avec Size
            $price->size = $size;

            //on rempli le tableau avec notre objet pizza
            $array_result[] = $price;
        }

        //on retourne le tableau fraichement rempli
        return $array_result;
    }

    /**
     * méthode qui permet de récuperer le prix et la taille d'une pizza grace a son id
     * @param int pizza_id
     * @return ?float
     */
    public function getPriceByPizzaIdBySize(int $pizza_id, int $size_id): float
    {

        //on crée la requete sql
        $q = sprintf(
            'SELECT p.*, s.`label` 
            FROM %1$s AS p
            INNER JOIN %2$s AS s 
            ON p.`size_id` = s.`id`
            WHERE p.`pizza_id` = :id
            AND p.`size_id` = :size_id',
            $this->getTableName(), //correspond au %1$s
            AppRepoManager::getRm()->getSizeRepository()->getTableName() //correspond au %2$s
        );

        //on prépare la requete
        $stmt = $this->pdo->prepare($q);

        //on execute la requete en passant l'id de la pizza
        $stmt->execute(['id' => $pizza_id, 'size_id' => $size_id]);

        $result = $stmt->fetchObject();
        if (!$result) return null;

        return $result->price;
    }
}
