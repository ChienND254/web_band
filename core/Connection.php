<?php
class Connection
{
    private static $instance = null, $conn = null;

    public function __construct($config)
    {
        try {
            $dsn = 'mysql:dbname='.$config['db'].';host='.$config['host'].';port='.$config['port'].'';
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            
            $con= new PDO($dsn, $config['user'], isset($config['pass']), $options);
            self::$conn = $con;

        } catch(Exception $e) {
            $mess = $e->getMessage();
            $data['message'] = $mess;
            App::$app->loadError('database', $data);
            die();
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}
