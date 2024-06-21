<?php

namespace App;

use App\Model\Equipement;
use App\Model\Logement;
use App\Repository\TypeRepository;
use App\Repository\UserRepository;
use App\Repository\MediaRepository;
use App\Repository\AdressRepository;
use App\Repository\FavorisRepository;
use App\Repository\LogementRepository;
use App\Repository\EquipementRepository;
use App\Repository\ReservationRepository;
use Core\Repository\RepositoryManagerTrait;
use App\Repository\LogementEquipementRepository;

class AppRepoManager
{
  //on récupère le trait RepositoryManagerTrait
  use RepositoryManagerTrait;

  //on déclare une propriété privée qui va contenir une instance du repository
// exemple: private Repository $Repository;

private AdressRepository $adressRepository;
private EquipementRepository $equipementRepository;
private FavorisRepository $favorisRepository;
private LogementRepository $logementRepository;
private LogementEquipementRepository $logementEquipementRepository;
private MediaRepository $mediaRepository;
private ReservationRepository $reservationRepository;
private TypeRepository $typeRepository;
private UserRepository $userRepository;

  //on crée ensuite les getter pour accéder à la propriété privée
  public function getAdressRepository(): AdressRepository
  {
    return $this->adressRepository;
  }

  public function getEquipementRepository(): EquipementRepository
  {
    return $this->equipementRepository;
  }

  public function getFavorisRepository(): FavorisRepository
  {
    return $this->favorisRepository;
  }

  public function getLogementRepository(): LogementRepository
  {
    return $this->logementRepository;
  }

  public function getLogementEquipementRepository(): LogementEquipementRepository
  {
    return $this->logementEquipementRepository;
  }

  public function getMediaRepository(): MediaRepository
  {
    return $this->mediaRepository;
  }

  public function getReservationRepository(): ReservationRepository
  {
    return $this->reservationRepository;
  }

  public function getTypeRepository(): TypeRepository
  {
    return $this->typeRepository;
  }

  public function getUserRepository(): UserRepository
  {
    return $this->userRepository;
  }
    
  //exemple: public function getRepository(): Repository
  //{
  //  return $this->Repository;
  //}

  //enfin, on declare un construct qui va instancier les repositories
  protected function __construct()
  {
    $config = App::getApp();
    //on instancie le repository

    $this->adressRepository = new AdressRepository($config);
    $this->equipementRepository = new EquipementRepository($config);
    $this->favorisRepository = new FavorisRepository($config);
    $this->logementRepository = new LogementRepository($config);
    $this->logementEquipementRepository = new LogementEquipementRepository($config);
    $this->mediaRepository = new MediaRepository($config);
    $this->reservationRepository = new ReservationRepository($config);
    $this->typeRepository = new TypeRepository($config);
    $this->userRepository = new UserRepository($config);
    
    //exemple: $this->Repository = new Repository($config);
  }
}
