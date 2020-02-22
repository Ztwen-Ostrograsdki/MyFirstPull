<?php 
namespace MyFramework\Connected;
use \PDO;

class Connected{
    
    private $dbname;
    
    public function __construct(string $dbname = 'school')
    {
        $this->dbname = $dbname;
        
    }
    
    
    public function connectedToDataBase () 
    {
        $cbd = new PDO("mysql:dbname={$this->dbname};host=127.0.0.1",'ztwen','reussite',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $cbd;
    }
    
}










?>
