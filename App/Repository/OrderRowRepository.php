<?php

namespace App\Repository;

use App\Model\Pizza;
use App\AppRepoManager;
use App\Model\OrderRow;
use Core\Repository\Repository;

class OrderRowRepository extends Repository
{
    public function getTableName(): string
    {
        return 'order_row';
    }

    /**
     * méthode qui permet d'ajouter une ligne de commande
     * @param array $data
     * @return bool
     */
    public function insertOrderRow(array $data): bool
    {
        //on crée la requete SQL
        $q = sprintf(
            'INSERT INTO `%s` (`order_id`, `pizza_id`, `quantity`, `price`, `size_id`) 
            VALUES (:order_id, :pizza_id, :quantity, :price, :size_id)',
            $this->getTableName()
        );
        //on prepare la requete
        $stmt = $this->pdo->prepare($q);
        //on execute la requete
        //si la requete n'est pas executée on retourne false
        if (!$stmt->execute($data)) return false;
        //on retourne true
        return true;

    }

    /**
     * méthode qui récupère les lignes de commande lié a une commande
     * @param int $order_id
     * @return array
     */
    public function findOrderRowByOrderId(int $order_id): ?array
    {
        //on déclare un tableau vide
        $array_result = [];

        //on crée notre requete SQL
        $q = sprintf(
            'SELECT * 
            FROM `%s` 
            WHERE `order_id` = :order_id',
            $this->getTableName()
        );
        //on prepare la requete
        $stmt = $this->pdo->prepare($q);
        //on execute la requete
        //si la requete n'est pas executée on retourne un tableau vide
        if (!$stmt->execute(['order_id' => $order_id])) return null;
        //on retourne le resultat
        while($result = $stmt->fetch()){
            $orderRow = new OrderRow($result);
            //on va hydrater OrderRow pour avoir les infos de la pizza
            $orderRow->pizza = AppRepoManager::getRm()->getPizzaRepository()->readById(Pizza::class, $orderRow->pizza_id);
            $array_result[] = $orderRow;
        }
        return $array_result;
    }

    /**
     * méthode qui calcule le montant total d'une commande
     * @param int $order_id
     * @return float
     */

    public function findTotalPriceByOrder(int $order_id): ?float
    {
        //les backtit pour les noms de collones
        //on cree la requete sql
        $q = sprintf(
          'SELECT SUM(`price`) AS total_price
          FROM `%s`
          WHERE `order_id` = :order_id',
          $this->getTableName()
        );

        //on prepare la requete
        $stmt = $this->pdo->prepare($q);

        //on execute la requete
        //si la requete n'est pas executée on retourne null
        if (!$stmt->execute(['order_id' => $order_id])) return null;
        //on retourne le resultat
        $result = $stmt->fetchObject();
        //on retourne le total
        return $result->total_price ?? 0;
    }

    /**
     * méthode qui additionne le nombre de pizza pour chaque ligne de commande
     * @param int $order_id
     * @return ?int
     */
    public function countOrderRow(int $order_id): ?int
    {
        //query qui additionne le nombre de ligne de commande
        $q = sprintf(
            'SELECT SUM(quantity) AS count
            FROM `%s`
            WHERE `order_id` = :order_id',
            $this->getTableName()
        );

        //on prepare la requete
        $stmt = $this->pdo->prepare($q);

        //on verifie la requete
        if (!$stmt->execute(['order_id' => $order_id])) return 0;

        //on recupère le resultat
        $result = $stmt->fetchObject();

        return $result->count ?? 0;
    }

    /**
     * méthode qui permet de mettre a jour une ligne de commande
     * @param array $data
     * @return bool
     */
    public function updateOrderRow(array $data): bool
    {
        //on doit recuperer le prix de la pizza
        $pizza_price = AppRepoManager::getRm()->getPriceRepository()->getPriceByPizzaIdBySize($data['pizza_id'], $data['size_id']);
        //on va calculer le prix total avec la nouvelle quantité
        $price = $pizza_price * $data['quantity'];
        //on crée notre requete SQL
        $q = sprintf(
            'UPDATE `%s` 
            SET `price` = :price, `quantity` = :quantity
            WHERE `id` = :id',
            $this->getTableName()
        );
        //on prepare la requete
        $stmt = $this->pdo->prepare($q);
        //on execute la requete
        //si la requete n'est pas executée on retourne false
        if (!$stmt->execute($data)) return false;
        //on retourne true
        return $stmt->execute([
            'price' => $price,
            'quantity' => $data['quantity'],
            'id' => $data['id']
        ]);

    }
}
