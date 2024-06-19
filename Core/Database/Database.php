<?php

namespace Core\Database;
use PDO;
use Core\Database\DatabaseConfigInterface;
//SINGLETON PATTERN
class Database
{
    //on demande au pdo de retourner les choses sous forme de tableau assoc
    private const PDO_OPTIONS = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    private static ?PDO $pdoInstance = null;
    //on crée une methode statique en publique pour recuperer l'instance de pdo
    public static function getPDO(DatabaseConfigInterface $config): PDO
    {
        // si l'instance n'existe pas on la crée 
        if(is_null(self::$pdoInstance)){
            $dsn = sprintf('mysql:dbname = %s;host=%s',$config->getName(), $config->getHost());
            self::$pdoInstance = new PDO(
            $dsn, 
            $config->getUser(),
            $config->getPass(),
            self::PDO_OPTIONS
            );
        }
        //si oui on retourne une instance de pdo
        return self::$pdoInstance;
    }

    //on protege notre database
    private function __construct(){}
    private function __clone(){}
    
}