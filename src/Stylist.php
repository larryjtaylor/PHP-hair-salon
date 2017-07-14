<?php
class Stylist
{
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getName()}');");
        if ($executed) {
            $this->id= $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
   {
       $returned_stylists = $GLOBALS['DB']->query('SELECT * FROM stylists;');
        $stylists = array();
        foreach($returned_stylists as $stylist){
            $name = $stylist['name'];
            $id = $stylist['id'];
            $new_stylist = new Stylist($name, $id);
            array_push($stylists, $new_stylist);
        }
        return $stylists;
   }

   static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec('DELETE FROM stylists;');
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

}
?>
