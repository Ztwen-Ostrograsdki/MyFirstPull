<?php 
namespace Ostro\PupilsInfos;
use Ostro\Maths\Operators;
use Ostro\DataBaseConnect\Connected;
use \PDO;



/**
 * @author Ztwen-Oströgrasdki HOUNDEKINDO <houndekz@gmail.com>
 * 
 */
class Pupils{
    

    /**
     * the class using
     * @var string
     */
    protected $classe;
    
    /**
     * the using table of the current class $class
     * @var string
    */
    protected $table;

    /**
     * The id of the pupil in the database
     * @var int
     */
    protected $id;

    /**
     * The name of the pupil
     * @var [string]
     */
    protected $name;

    /**
     * the surname of the pupil
     * @var string
     */
    protected $surname;

    /**
     * the first mark of the pupil
     * @var float
     */
    protected $interro1;

    /**
     * the second mark of the pupil
     * @var float
     */
    protected $interro2;

    /**
     * the third mark of the pupil
     * @var float
     */
    protected $interro3;

    /**
     * The bonus
     * @var int
     */
    protected $bonus;

    /**
     * The first mark "exam"
     * @var float
     */
    protected $devoir1;

    /**
     * The second mark "exam"
     * @var float
     */
    protected $devoir2;

    /**
     * the better mark of the pupil in the all marks
     * @var [float]
     */
    protected $bestMark;

    /**
     * The average of the pupil
     * @var float
     */
    protected $moyenne;

    /**
     * An observation based on these marks
     * @var string
     */
    protected $observation;

    /**
     * The observation based on average "$moyenne"
     * @var string
     */
    protected $mention;
    

    /**
     * [getTable description]
     * @return [string] [description]
     */
    public function getTable () :string
    {
        return $this->table;
    }

    /**
     * [getClasse description]
     * @return [string] [description]
     */
    public function getClasse () :string
    {
        return $this->classe;
    }
    
    /**
     * [setClasse description]
     * @param string $classe [description]
     * @return the current instance [<description>]
     */
    public function setClasse (string $classe) :self
    {
        $this->classe = $classe;
        return $this;
    }
    
    /**
     * [getID description]
     * @return int 
     */
    public function getID () :?int
    {
        return $this->id;
    }
    
    /**
     * [setID description]
     * @param string $id [description]
     * @return the current instance [<description>]
     */
    public function setID (string $id) :self
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * [getName description]
     * @return string [description]
     */
    public function getName () :string
    {
        return $this->name;
    }
    
    /**
     * [setName description]
     * @param string $name [description]
     * @return The current instance [<description>]
     */
    public function setName (string $name) :self
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * [getSurname description]
     * @return string [description]
     */
    public function getSurname () :string
    {
        return $this->surname;
    }
    
    /**
     * [setSurname description]
     * @param string $surname [description]
     * @return The current instance [<description>]
     */
    public function setSurname (string $surname) :self
    {
        $this->surname = $surname;
        return $this;
    }
    
    /**
     * [getInterro1 description]
     * @return float|null [description]
     */
    public function getInterro1 () :?float
    {
        return $this->interro1;
    }
    
    /**
     * [setInterro1 description]
     * @param string $interro1 [description]
     * @return The current instance [<description>]
     */
    public function setInterro1 (string $interro1) :self
    {
        $this->interro1 = $interro1;
        return $this;
    }

    /**
     * [getInterro1Formatted description]
     * Used to formatted the mark on the displayed, replace 0 by "-"
     * @return string|null|float 
     */
    public function getInterro1Formatted ()
    {
        if($this->interro1 == 0) {
            return '-';
        }
        return $this->interro1;
    }
    
    /**
     * [getInterro2 description]
     * @return float|null 
     */
    public function getInterro2 () :?float
    {
        return $this->interro2;
    }
    

    /**
     * [setInterro2 description]
     * @param string $interro2 
     * @return the current instance 
     */
    public function setInterro2 (string $interro2) :self
    {
        $this->interro2 = $interro2;
        return $this;
    }

    /**
     * [getInterro1Formatted description]
     * Used to formatted the mark on the displayed, replace 0 by "-"
     * @return string|null|float
     */

    public function getInterro2Formatted ()
    {
        if($this->interro2 == 0) {
            return '-';
        }
        return $this->interro2;
    }
    
    /**
     * [getInterro3 description]
     * @return float|null
     */
    public function getInterro3 () :?float
    {
        return $this->interro3;
    }
    

    /**
     * [setInterro3 description]
     * @param string $interro3 
     * @return The current instance 
     */
    public function setInterro3 (string $interro3) :self
    {
        $this->interro3 = $interro3;
        return $this;
    }

     /**
     * [getInterro1Formatted description]
     * Used to formatted the mark on the displayed, replace 0 by "-"
     * @return string|null|float 
     */

    public function getInterro3Formatted ()
    {
        if($this->interro3 == 0) {
            return '-';
        }
        return $this->interro3;
    }
    

    /**
     * [getBonus description]
     * @return float|null
     */
    public function getBonus () :?float
    {
        return $this->bonus;
    }
    

    /**
     * [setBonus description]
     * @param string $bonus 
     * @return The current instance
     */
    public function setBonus (string $bonus) :self
    {
        $this->bonus = $bonus;
        return $this;
    }
    
    /**
     * [getDevoir1 description]
     * @return float|null
     */
    public function getDevoir1 () :?float
    {
        return $this->devoir1;
    }
    
    /**
     * [setDevoir1 description]
     * @param string $devoir1 
     * @return The current instance
    */
    public function setDevoir1 (string $devoir1) :self
    {
        $this->devoir1 = $devoir1;
        return $this;
    }

    /**
     * [getInterro1Formatted description]
     * Used to formatted the mark on the displayed, replace 0 by "-"
     * @return string|null 
    */
    public function getDevoir1Formatted ()
    {
        if($this->devoir1 == 0) {
            return '-';
        }
        return $this->devoir1;
    }
    

    /**
     * [getDevoir2 description]
     * @return float|null
     */
    public function getDevoir2 () :?float
    {
        return $this->devoir2;
    }
    

    /**
     * [setDevoir2 description]
     * @param string $devoir2 
     * @return The current instance [<description>]
     */
    public function setDevoir2 (string $devoir2) :self
    {
        $this->devoir2 = $devoir2;
        return $this;
    }

    /**
     * [getInterro1Formatted description]
     * Used to formatted the mark on the displayed, replace 0 by "-"
     * @return string|null 
    */
    public function getDevoir2Formatted ()
    {
        if($this->devoir2 == 0) {
            return '-';
        }
        return $this->devoir2;
    }
    

    /**
     * [getBestMark description]
     * @return float|null
     */
    public function getBestMark () :?float
    {
        return $this->bestMark;
    }
    

    /**
     * [setBestMark description]
     * @param string $bestMark 
     * @return The current instance 
     */
    public function setBestMark (string $bestMark) :self
    {
        $this->bestMark = $bestMark;
        return $this;
    }

    /**
     * [getInterro1Formatted description]
     * Used to formatted the mark on the displayed, replace 0 by "-"
     * @return string|null 
    */
    public function getBestMarkFormatted ()
    {
        if($this->bestMark == 0) {
            return '-';
        }
        return $this->bestMark;
    }
    
    /**
     * [getMoyenne description]
     * @return float|null
     */
    public function getMoyenne () :?float
    {
        return $this->moyenne;
    }

    /**
     * getMoyenneFormatted
     * Used to formatted the mark on the displayed, replace 0 by "-"
     * @return string|null|float 
    */
    public function getMoyenneFormatted ()
    {
        if($this->moyenne == 0) {
            return '-';
        }
        return $this->moyenne;
    }
    

    /**
     * [setMoyenne description]
     * @param string $moyenne 
     * @return The current instance 
     */
    public function setMoyenne (string $moyenne) :self
    {
        $this->moyenne = $moyenne;
        return $this;
    }
    
    
    /**
     * [getMention description]
     * @return string|null
     */
    public function getMention () :?string
    {
        return $this->mention;
    }
    
        
    /**
     * [getObservation description]
     * @return string|null
     */
    public function getObservation () :?string
    {
        return $this->observation;
    }
    
    /**
     * [setMention description]
     * @param string $mention 
     * @return The current instance
     */
    public function setMention (string $mention) :self
    {
        $this->mention = $mention;
        return $this;
    }
    
    /**
     * Used to set the average [$moyenne] and the observation based on the average
     * @param array $notesTab all the marks of the pupil
     * @return The current instance The average [$moyenne] and The observation [$mention]
     */
    public function SetMentionAndAverage(array $notesTab):self
    {
        $moyenneMention = [];
        $noteTotal1 = 0;
        $nombreDeNotes1 = 0;
        $tabInterro = [$notesTab[0], $notesTab[1], $notesTab[2]];
        
        $taux = 0;
        $success = 0;
        for ($k = 0; $k < 5; $k++){
            if($notesTab[$k] > 0) {
                $taux ++;
                if($notesTab[$k] >= 10) {
                    $success ++;
                }  
            }
        }
        if($taux !== 0) {
            $percentage = ($success / $taux) * 100;
        }
        else{
            $percentage = 0;
        }
        $moyenneMention['observation'] = Operators::Observator($percentage);
        $this->observation = $moyenneMention['observation'];
        
        
        $tabDev = [$notesTab[3], $notesTab[4]];
        for ($i = 0; $i <= 2; $i++){
           if($tabInterro[$i] != 0) {
               $noteTotal1 += $tabInterro[$i];
               $nombreDeNotes1 ++;
           }
        }

        if($nombreDeNotes1 != 0) {
            $moyenneInterro = $noteTotal1/$nombreDeNotes1;
            $noteDev = 0;
            $nombreDeNotesDev = 0;
            for ($j = 0; $j < 2 ; $j++) {
               if($tabDev[$j] != 0) {
                    $noteDev += $tabDev[$j];
                    $nombreDeNotesDev ++;
                } 
            }
            $nombreDeNotes = $nombreDeNotesDev + 1;

            $noteTotal = $noteDev + $moyenneInterro;

            $moyenne = $noteTotal/$nombreDeNotes;

            $moyenneMention['moyenne'] = $moyenne;
        }
        elseif($nombreDeNotes1 == 0){
            $noMoyenne = "Vous n'avez aucune note. Veuillez vous rapprochez de votre professeur pour regler ce problème!";
            $moyenneMention['moyenne'] = 0;
        }
        
        $this->moyenne = number_format($moyenneMention['moyenne'], 2, '.', ' ');
        $moy = $moyenneMention['moyenne'];
        if($moy == 0) {
            $this->mention = $moyenneMention['mention'] = "-";
        }
        elseif($moy <= 5) {
            $this->mention = $moyenneMention['mention'] = "Mal";
        }
        elseif(5 < $moy and $moy <= 7) {
            $this->mention = $moyenneMention['mention'] = "Faible";
        }
        elseif(7 < $moy and $moy <= 9.99) {
            $this->mention = $moyenneMention['mention'] = "Insuffisant";
        }
        elseif(9.99 < $moy and $moy <= 11.99) {
            $this->mention = $moyenneMention['mention'] = "Passable";
        }
        elseif(11.99 < $moy and $moy <= 13.99) {
            $this->mention = $moyenneMention['mention'] = "A. Bien";
        }
        elseif(13.99 < $moy and $moy <= 15.99) {
            $this->mention = $moyenneMention['mention'] = "Bien";
        }
        elseif(15.99 < $moy and $moy <= 17.99) {
            $this->mention = $moyenneMention['mention'] = "T. bien";
        }
        elseif(17.99 < $moy and $moy <= 20) {
            $this->mention = $moyenneMention['mention'] = "Excellent";
        }
        return $this;
    }


    /**
     * Used to search content
     * @param  string $tableTarget the table in the database where we're going to make the searching
     * @param  string $tableName  The table in the database joined to $tabletarget to get the name and the surname of the object [the instance == pupil]
     * @param  string $q the key or the keyword where we're going the search in the data          
     * @return array contained the response [these getting information] and the occurence of the search             
     */
    public function showSearchContent(string $tableTarget, string $tableName, string $q)
    {
        $cbd = (new Connected())->connectedToDataBase();
        $request = $cbd->query("SELECT * FROM {$tableTarget} tt JOIN {$tableName} tn ON tt.eleve_id = tn.id WHERE name LIKE \"%".$q."%\" or surname LIKE \"%".$q."%\" ORDER BY name");
        $count = $request->rowCount();
        if($count !== 0) {
            $reqFinal = $request->fetchAll(PDO::FETCH_CLASS, self::class);
        }
        elseif($count == 0) {
            $reqFinal = [];
        }
        return [$reqFinal, $count];
    }


    /**
     * Use to insert a datum into a table in database
     * @param  array  $data [name, surname]
     * @return [int]       [id of the last insertion]
     */
    public function insertInto (array $data) :?int 
    {
        $cbd = (new Connected())->connectedToDataBase();
        $req = $cbd->prepare("INSERT INTO {$this->table} (name, surname) VALUES(?,?)");
        $req->execute($data);
        return $cbd->lastInsertId();
    }
    
    /**
     * use to set the default values of the marks in the table of the marks
     * @param  int    $id   [the id of the pupil]
     * @param  string $trim [the current trimestre]
     * @return [void]       [anything]
     */
    public function inMarkTableByDefault (int $id, string $trim) :void
    {
        $cbd = (new Connected())->connectedToDataBase();
        $req = $cbd->prepare("INSERT INTO {$trim} (eleve_id, interro1, interro2, interro3, bonus, devoir1, devoir2, moyenne, mention) VALUES(?,?,?,?,?,?,?,?,?)");
        $req->execute([$id, 0, 0, 0, 0, 0, 0, 0, 'En cours']);
    }

    /**
     * Use to update the data in the table, the current table
     * @param  int    $id   [the id of the pupil]
     * @param  string $trim [the current trimestre]
     * @return [void]       
     */
    public function udateTable(int $id, string $trim)
    {
        $cbd = (new Connected())->connectedToDataBase();
        $cbd->beginTransaction();
        $req1 = $cbd->prepare("UPDATE {$this->table} SET name = ?, surname = ? WHERE id = $id");
        $req1->execute([$this->name, $this->surname]);
        $req2 = $cbd->prepare("UPDATE {$trim} SET interro1 = ?, interro2 = ?, interro3 = ?, devoir1 = ?, devoir2 = ?, moyenne = ?, mention = ? WHERE eleve_id = $id");
        $req2->execute([$this->interro1, $this->interro2, $this->interro3, $this->devoir1, $this->devoir2, $this->moyenne, $this->mention]);
        $cbd->commit();
    }

    // public function showContentByAverage() 
    // {
    //     $request = ($this->connectedToDatabase())->query("SELECT * FROM ".self::$tableName." ORDER BY moyenne desc");
    //     $reqFinal = $request->fetchAll(PDO::FETCH_OBJ);
    //     return $reqFinal;
        
    // }


    
}



?>
