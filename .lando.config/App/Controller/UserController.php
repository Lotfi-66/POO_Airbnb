<?php

namespace App\Controller;


use Core\View\View;
use App\AppRepoManager;
use Core\Controller\Controller;

class UserController extends Controller
{
    /**
     * méthode qui renvoie la vue panier d'un utilisateur
     * @param int|string $id
     * @return void
     */
    public function order(int|string $id): void
    {
        $order = AppRepoManager::getRm()->getOrderRepository()->findOrderInProgressWithOrderRow($id);
        //on récupere le total de la commande
        $total = $order ? AppRepoManager::getRm()->getOrderRowRepository()->findTotalPriceByOrder($order->id) : 0;
        //on récupere les quantité de pizzas dans le panier
        $countRow = $order ? AppRepoManager::getRm()->getOrderRowRepository()->countOrderRow($order->id) : 0;

        $view_data = [
            'order' => $order,
            'total' => $total,
            'count_row' => $countRow
        ];

        $view = new View('user/order');
        
        $view->render($view_data);
    }
}