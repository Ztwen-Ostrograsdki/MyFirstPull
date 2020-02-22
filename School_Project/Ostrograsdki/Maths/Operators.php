<?php 
namespace Ostro\Maths;
use \PDO;
use Ostro\DataBaseConnect\Connected;

class Operators{

    public static function Observator (float $percentage) :string
    {
        if($percentage == 0) {
            $observation = ' En vue';
        }
        elseif($percentage !== null) {
            
            $decimal = explode('.',$percentage);
            if (!isset($decimal[1])) {
                $p = (int)$percentage;
            }
            else{
               $p = number_format($percentage, 2, '.', ' '); 
            }
            
            $observation = "(".$p." %)";
            if($p >= 0 and $p < 25) {
                $observation .= ' Mauvaise';
            }
            elseif($p >= 25 and $p < 45) {
                $observation .= ' Mieux';
            }
            elseif($p >= 45 and $p < 50) {
                $observation .= ' Acceptable';
            }
            elseif($p >= 50 and $p < 65) {
                $observation .= ' Bonne';
            }
            elseif($p >= 65 and $p < 90) {
                $observation .= ' Très bonne';
            }
            elseif($p >= 90 and $p <= 100) {
                $observation .= ' Magnifique';
            }
        }
        return $observation;
    }

    public function findMaxInTable($tableName, int $id):float
    {
        $cbd = (new Connected())->connectedToDataBase();
        $table1 = $tableName.'_t1';
        $table2 = $tableName.'_t2';
        $table3 = $tableName.'_t3';

        $query = "SELECT t1.interro1, t1.interro2, t1.interro3, t1.devoir1, t1.devoir2, t2.interro1, t2.interro2, t2.interro3, t2.devoir1, t2.devoir2, t3.interro1, t3.interro2, t3.interro3, t3.devoir1, t3.devoir2 FROM ({$table1} t1, {$table2} t2, {$table3} t3) JOIN {$tableName} tn ON (t1.eleve_id = tn.id AND t2.eleve_id = tn.id AND t3.eleve_id = tn.id) WHERE tn.id = {$id}";
        $req = $cbd->query($query);
        return max($req->fetch());          
         
    }


    public function findMaxIn2Tables($tableName, int $id):float
    {
        $cbd = (new Connected())->connectedToDataBase();
        $table1 = $tableName.'_t1';
        $table2 = $tableName.'_t2';
        $table3 = $tableName.'_t3';

        $query = "SELECT t2.interro1, t2.interro2, t2.interro3, t2.devoir1, t2.devoir2, t3.interro1, t3.interro2, t3.interro3, t3.devoir1, t3.devoir2 FROM ({$table2} t2, {$table3} t3) JOIN {$tableName} tn ON (t2.eleve_id = tn.id AND t3.eleve_id = tn.id) WHERE tn.id = {$id}";
        $req = $cbd->query($query);
        return max($req->fetch());          
         
    }
}



?> 

