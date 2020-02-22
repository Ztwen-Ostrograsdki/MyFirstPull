<?php
namespace Ostro\Paginate;
use Ostro\Routing\Router;
use Ostro\DataBaseConnect\Connected;
use \PDO;

class Pagination{

    
    private $cbd;

    // private $targetTable;

    // private $column;

    private $perPage;

    // private $currentPage;

    // private $pageTotal;

    // private $classMapping;
    // 
    
    public function __construct() {
        $this->cbd = (new Connected())->connectedToDataBase();
        $this->perPage = 8;
    } 
    /**
     * [Parcours une table dans la base de données puis retourne le nombre total de lignes]
     * @param  [string] $table  [description]
     * @param  [string] $column [description]
     * @return [int]         [description]
     */
    public function queryTable(string $table, string $column, $targetCount = null):int
    {
        $query = "SELECT COUNT($column) FROM $table";
        if($targetCount !== null) {
            $query .= " WHERE $column = $targetCount";
        }
        $reqCount = (int)$this->cbd->query($query)->fetch(PDO::FETCH_NUM)[0];
    
        $pageTotal = (int)ceil($reqCount/$this->perPage);

        return $pageTotal;
    }


    
    public function getPaginated (string $query, int $currentPage, string $classMapping, string $tableCount, string $columnCount, $targetCount = null) : array
    {
        $pageTotal = $this->queryTable($tableCount, $columnCount, $targetCount);
        $query .=" LIMIT $this->perPage ";
        if(isset($currentPage) AND $currentPage > 1) {
                
            if($currentPage > $pageTotal) {
                echo "<h3 class='alert alert-danger'>Le numero de page que vous demandez n'existe pas! PageMax = $pageTotal </h3>";
            }
            $offset = (int)$this->perPage*($currentPage - 1);
            $query .= "OFFSET $offset";
            $req = $this->cbd->prepare(e($query));
            $req->execute(['id' => $targetCount]);
            $shows = $req->fetchAll(PDO::FETCH_CLASS, $classMapping);
            
        }
        
        $req = $this->cbd->prepare(e($query));
        $req->execute(['id' => $targetCount]);
        $shows = $req->fetchAll(PDO::FETCH_CLASS, $classMapping);
        return $shows;
    }
    
    public static function PaginateExceptionIsIntPositive ($page):void
    {
        if(!filter_var($page, FILTER_VALIDATE_INT) || $page <= 0) {
            echo "<h3 class='alert alert-danger'>Le numero de page que vous demandez est invalide! </h3>"; 
        }
        
    }

    
    public function simplePaginated (string $targetTable, string $id, int $currentPage, $classMapping,string $column = '') 
    {
        $pageTotal = $this->queryTable($targetTable, $id);
        $defaultReq = "SELECT * FROM $targetTable ";
        if ($column !== '') {
            $defaultReq .="ORDER BY $column DESC ";
        }
        $defaultReq .= "LIMIT $this->perPage";

            if(isset($currentPage) AND $currentPage > 1) {
                
                if($currentPage > $pageTotal) {
                    echo "<h3 class='alert alert-danger'>Le numero de page que vous demandez n'existe pas! PageMax = $pageTotal </h3>";
                    
                }
                
                $offset = $this->perPage*($currentPage - 1);
                
                $defaultReq .=" OFFSET $offset";
                
                $req = $this->cbd->query($defaultReq);
                
                $shows = $req->fetchAll(PDO::FETCH_CLASS, $classMapping);
            }
    
        $req = $this->cbd->query($defaultReq);
        $shows = $req->fetchAll(PDO::FETCH_CLASS, $classMapping);
        
        return $shows;
    }
    
    
    
}
