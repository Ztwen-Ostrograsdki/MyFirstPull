<?php

namespace MyFramework\Classe;

use MyFramework\Connected\Connected;
use MyFramework\PupilsInfos\Pupil\Pupil;
use MyFramework\SqlRequests\Requestor;
use MyFramework\Teacher\Teacher;


class Classe{

    private $tableName = 'list_of_classes';

	private $id;

	private $classe;

	private $responsable1;

    private $responsable1OnObject;

	private $responsable2;

    private $responsable2OnObject;

    private $level;

    private $principal;

    private $principalOnObject;

	private $effectif;

    private $studyPlan; //array

    private $teachers; // slug




    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     *
     * @return self
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponsable1()
    {
        return $this->responsable1;
    }


    /**
     * @return object
     */
    public function getResponsable1OnObject()
    {
        $id = (int)Requestor::getSomethink('id', 'list_of_pupils', $this->getResponsable1(), 'name', 'surname');
        if ($id !== 0) {
            $responsable1OnObject = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'id', $id, 'name')[0];
        }
        else{
            $responsable1OnObject = null;
        }
        
        $this->responsable1OnObject = $responsable1OnObject;
        return $this->responsable1OnObject;
    }


    /**
     * @param mixed $responsable1
     *
     * @return self
     */
    public function setResponsable1($responsable1)
    {
        $this->responsable1 = $responsable1;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponsable2()
    {
        return $this->responsable2;
    }

     /**
     * @return object
     */
    public function getResponsable2OnObject()
    {
        $id = (int)Requestor::getSomethink('id', 'list_of_pupils', $this->getResponsable2(), 'name', 'surname');
        if ($id !== 0) {
            $responsable2OnObject = (new Requestor(Pupil::class))->getContentsWithWhere('list_of_pupils', 'id', $id, 'name')[0];
        }
        else{
            $responsable2OnObject = null;
        }
        
        $this->responsable2OnObject = $responsable2OnObject;
        return $this->responsable2OnObject;
    }

    /**
     * @param mixed $responsable2
     *
     * @return self
     */
    public function setResponsable2($responsable2)
    {
        $this->responsable2 = $responsable2;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEffectif()
    {
        return (int)Requestor::theCounterWithWhere('classe', 'list_of_pupils', $this->getClasse());
    }

    /**
     * @param mixed $effectif
     *
     * @return self
     */
    public function setEffectif($effectif)
    {
        $this->effectif = $effectif;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     *
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

     /**
     * @return object
     */
    public function getPrincipalOnObject()
    {

        $id = (int)Requestor::getSomethink('id', 'list_of_teachers', $this->getPrincipal(), 'name', 'surname');
        if ($id !== 0) {
            $principalOnObject = (new Requestor(Teacher::class))->getContentsWithWhere('list_of_teachers', 'id', $id, 'name')[0];
        }
        else{
            $principalOnObject = null;
        }
        
        $this->principalOnObject = $principalOnObject;
        return $this->principalOnObject;
    }

    /**
     * @param mixed $principal
     *
     * @return self
     */
    public function setPrincipal($principal)
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param mixed $tableName
     *
     * @return self
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }


    public function updatethisClasse()
    {
        $cbd = (new Connected())->connectedToDataBase();

        $query1 = "UPDATE list_of_classes SET classe = ?, responsable1 = ?, responsable2 = ?, principal = ? WHERE id = ? ";
        $query3 = "UPDATE list_of_pupils SET is_responsable = ? WHERE id IN (?, ?)";
        $query2 = "UPDATE list_of_pupils SET is_responsable = ?";

        $req1 = $cbd->prepare($query1);
        $req2 = $cbd->prepare($query2);
        $req3 = $cbd->prepare($query3);

        $req1->execute([$this->getClasse(), $this->getResponsable1(), $this->getResponsable2(), $this->getPrincipal(), $this->getId()]);
        $req2->execute([0]);
        
        $req3->execute([1, $this->getResponsable1OnObject()->getId(), $this->getResponsable2OnObject()->getId()]);

    }
}		