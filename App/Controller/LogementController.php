<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use App\Model\Logement;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Form\FormSuccess;
use Core\Controller\Controller;
use Laminas\Diactoros\ServerRequest;

class LogementController extends Controller
{
  public function details(int $id): void
  {


    $view_data = [

      'logements' => AppRepoManager::getRm()->getLogementRepository()->getLogementById($id)
    ];
    $view = new View('home/details');


    $view->render($view_data);
  }


  public function addLogement()
  {



    $view = new View('home/add_logement');


    $view->render();
  }








  public function mesBiens(int $id)
  {

    $view_data = [

      'logements' => AppRepoManager::getRm()->getLogementRepository()->getAllLogementByUserId($id),

    ];



    $view = new View('home/mesBiens');

    $view->render($view_data);
  }


  public function deleteLogement(int $id): void
  {

    $form_result = new FormResult();

    // appel de la méthode qui désactive une pizza
    $deleteLogement = AppRepoManager::getRm()->getLogementRepository()->deleteLogement($id);
    // appel de la méthode qui désactive une pizza


    // vérification du résultat de la suppression
    if (!$deleteLogement) {
      $form_result->addError(new FormError('Une erreur est survenue lors de la suppression du logement'));
    } else {
      $form_result->addSuccess(new FormSuccess('logement desactivé'));
    }

    // gestion des erreurs
    if ($form_result->hasErrors()) {
      // enregistrement des erreurs en session
      Session::set(Session::FORM_RESULT, $form_result);
      self::redirect('/');
    }

    // si tout est OK, redirection vers la liste des pizzas
    // suppression de la session form_result
    if ($form_result->hasSuccess()) {
      Session::set(Session::FORM_SUCCESS, $form_result);
      Session::remove(Session::FORM_RESULT);
     self::redirect('/mesBiens/' . Session::get(Session::USER)->id );
    }


    // vérification du résultat de la suppression

  }




  public function deleteReservation(int $id): void
  {

    $form_result = new FormResult();

    // appel de la méthode qui désactive une pizza
    $deleteLogement = AppRepoManager::getRm()->getReservationRepository()->deleteReservation($id);
    // appel de la méthode qui désactive une pizza


    // vérification du résultat de la suppression
    if (!$deleteLogement) {
      $form_result->addError(new FormError('Une erreur est survenue lors de la suppression du bien'));
    } else {
      $form_result->addSuccess(new FormSuccess('Bien désactivée avec succès'));
    }

    // gestion des erreurs
    if ($form_result->hasErrors()) {
      // enregistrement des erreurs en session
      Session::set(Session::FORM_RESULT, $form_result);
      self::redirect('/');
    }

    // si tout est OK, redirection vers la liste des pizzas
    // suppression de la session form_result
    if ($form_result->hasSuccess()) {
      Session::set(Session::FORM_SUCCESS, $form_result);
      Session::remove(Session::FORM_RESULT);
      self::redirect('/mes_reservation/' . Session::get(Session::USER)->id );
    }


    // vérification du résultat de la suppression

  }



  public function logementByPrice()
  {

    $view_data = [

      'logements' => AppRepoManager::getRm()->getLogementRepository()->getAllLogementByPrice()

    ];


    $view = new View('home/home_price');

    $view->render($view_data);
  }


  public function logementByType()
  {
    $view_data = [
      'logements' => AppRepoManager::getRm()->getLogementRepository()->getAllLogementByType()

    ];

    $view = new View('home/home_type');


    $view->render($view_data);
  }



  public function reservationMesLogements()
  {
 $view_data = [
   'logements' => AppRepoManager::getRm()->getLogementRepository()->getAllLogementByUserId(Session::get(Session::USER)->id)
 ];



    $view = new View('home/les-reservations');
    $view->render($view_data);
  }
}
