<?php
class Role
{

    private $id;
    private $name;

    function __construct($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
