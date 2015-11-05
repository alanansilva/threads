<?php

class ConexaoPDO {

    private static $db_dsn  = 'mysql:host=localhost;dbname=3heads';
    private static $db_user = 'root';
    private static $db_pass = 'root';
    private static $objInstance;

    /*
     * Class Constructor - Create a new database connection if one doesn't exist
     * Set to private so no-one can create a new instance via ' = new DB();'
     */
    private function __construct() {
        
    }

    /*
     * Like the constructor, we make __clone private so nobody can clone the instance
     */
    private function __clone() {
        
    }
    
    /**
     * Set parameters in connection
     * @param string $db_dsn
     * @param string $db_user
     * @param string $db_pass
     */
    public static function setParameters ($db_dsn, $db_user, $db_pass) {
        self::$db_dsn  = $db_dsn;
        self::$db_user = $db_user;
        self::$db_pass = $db_pass;
    }

    /*
     * Returns DB instance or create initial connection
     * @param
     * @return $objInstance;
     */
    public static function getInstance() {

        if (!self::$objInstance) {
            self::$objInstance = new PDO(self::$db_dsn, self::$db_user, self::$db_pass, array(PDO::ATTR_PERSISTENT => true));
            self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$objInstance;
    }

# end method

    /*
     * Passes on any static calls to this class onto the singleton PDO instance
     * @param $chrMethod, $arrArguments
     * @return $mix
     */

    final public static function __callStatic($chrMethod, $arrArguments) {

        $objInstance = self::getInstance();

        return call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
    }

# end method
}

