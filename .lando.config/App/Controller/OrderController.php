<?php

namespace App\Controller;

use App\Model\Order;
use App\AppRepoManager;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Form\FormSuccess;
use Core\Controller\Controller;
use Laminas\Diactoros\ServerRequest;

class OrderController extends Controller
{
    /**
     * méthode qui permet de générer un numero de commande unique
     */
    private function generateOrderNumber()
    {
        //je veux un numero de commande du type: FACT2406_00001 par exemple
        $order_number = 1;
        $order = AppRepoManager::getRm()->getOrderRepository()->findLastOrder();
        $order_number = str_pad($order_number, 5, "0", STR_PAD_LEFT);
        $year = date('y');
        $month = date('m');
        $final = "FACT{$year}{$month}_{$order_number}";
        return $final;
    }
    public function addOrder(ServerRequest $request)
    {

        //on va devoir définir les champs du formulaire
        $form_data = $request->getParsedBody();

        $form_result = new FormResult();
        //on definit nos variables
        $order_number = $this->generateOrderNumber();
        $date_order = date('Y-m-d H:i:s');
        $status = Order::IN_CART;
        $user_id = $form_data['user_id'];
        $size_id = $form_data['size_id'];
        $has_order_in_cart = AppRepoManager::getRm()->getOrderRepository()->findLastStatusByUser($user_id, Order::IN_CART);
        // var_dump($has_order_in_cart);
        $pizza_id = $form_data['pizza_id'];
        $quantity = $form_data['quantity'];
        $price = $form_data['price'] * $quantity;
        //on vérifie que la quantité est bien superieur à 0
        if ($quantity <= 0) {
            $form_result->addError(new FormError('La quantité doit être superieur à 0'));
            //on vérifie que la quantité est bien supérieue a 10
        } elseif ($quantity > 10) {
            $form_result->addError(new FormError('La quantité doit être inferieur à 10'));
            //on vérifie que l'utilisateur n'a pas de commande en cours
        } elseif (!$has_order_in_cart) {
            //on doit crée une nouvelle commande (order)
            //on reconstruit un tableau de données
            $data_order = [
                'order_number' => $order_number,
                'date_order' => $date_order,
                'status' => $status,
                'user_id' => $user_id,
            ];
            //on insert la commande
            $order_id = AppRepoManager::getRm()->getOrderRepository()->insertOrder($data_order);

            if ($order_id) {
                //on peut inserer la ligne de commande
                $data_order_row = [
                    'order_id' => $order_id,
                    'pizza_id' => $pizza_id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'size_id' => $size_id
                ];
                //on insert la commande
                $order_line = AppRepoManager::getRm()->getOrderRowRepository()->insertOrderRow($data_order_row);
                if ($order_line) {
                    $form_result->addSuccess(new FormSuccess('Vite elles vont refroidir !'));
                } else {
                    $form_result->addError(new FormError('Une erreur est survenue lors de creation de la commande'));
                }
            } else {
                $form_result->addError(new FormError('Une erreur est survenue lors de creation de la commande'));
            }
        } else {
            //si l'utilisateur a déja une commande en cours
            //on recupere la commande en cours
            $order_id = AppRepoManager::getRm()->getOrderRepository()->findOrderIdByStatus($user_id);
            if ($order_id) {
                //on peut inserer la ligne de commande
                $data_order_row = [
                    'order_id' => $order_id,
                    'pizza_id' => $pizza_id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'size_id' => $size_id
                ];
                //on insert la commande
                $order_line = AppRepoManager::getRm()->getOrderRowRepository()->insertOrderRow($data_order_row);
                if ($order_line) {
                    $form_result->addSuccess(new FormSuccess('Vite elles vont refroidir !'));
                } else {
                    $form_result->addError(new FormError('Une erreur est survenue lors de l\'insertion de la commande'));
                }
            } else {
                $form_result->addError(new FormError('Une erreur est survenue lors de l\'insertion de la commande'));
            }
            //si on a des erreurs on les met en session
            if ($form_result->hasErrors()) {
                Session::set(Session::FORM_RESULT, $form_result);
                //on redirige vers la page d'accueil
                self::redirect('/pizza/' . $pizza_id);
            }
            //si on a des success on les met en session
            if ($form_result->getSuccessMessage()) {
                Session::set(Session::FORM_RESULT, $form_result);
                Session::set(Session::FORM_SUCCESS, $form_result);
                //on redirige vers la page d'accueil
                self::redirect('/pizza/' . $pizza_id);
            }
        }
    }

    /**
     * méthode statique qui regarde si on a des lignes dans le panier (en cours)
     * @return bool
     */
    public static function hasOrderInCart(): bool
    {
        $user_id = Session::get(Session::USER)->id;
        $has_order_in_cart = AppRepoManager::getRm()->getOrderRepository()->findLastStatusByUser($user_id,Order::IN_CART);

        return $has_order_in_cart;
    }

    /**
     * méthode qui permet de modifier la quantité d'une ligne de commande
     * @param ServerRequest $request
     * @return void
     */
    public function updateOrder(ServerRequest $request, int $id): void
    {
        $form_data = $request-> getParsedBody();
        $form_result = new FormResult();
        $order_row_id = $form_data['order_row_id'];
        $quantity = $form_data['quantity'];
        $pizza_id = $form_data['pizza_id'];
        $size_id = $form_data['size_id'];
        $user_id = Session::get(Session::USER)->id;

        //on vérifie que la quantité est comprise entre 1 et 10
        if ($quantity <= 0) {
            $form_result->addError(new FormError('La quantité doit être comprise entre 1 et 10'));
            //on verifie que la quantité est bien inférieur à 10
        }elseif($quantity > 10){
            $form_result->addError(new FormError('La quantité doit être comprise entre 1 et 10'));
        }else{
            //on reconstruit un tableau de données pour mettre à jour la ligne de commande
            $data_order_line = [
                'id' => $order_row_id,
                'quantity' => $quantity,
                'pizza_id' => $pizza_id,
                'size_id' => $size_id
            ];
            //on appelle la methode qui permet de modifier la ligne de commande
            $order_line = AppRepoManager::getRm()->getOrderRowRepository()->updateOrderRow($data_order_line);
            //on redirige vers la page d'accueil
            
            

        }
    }


}
