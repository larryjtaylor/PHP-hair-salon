<?php
class Client
{
    private $name;
    private $stylist_id;
    private $id;

    function __construct($name, $stylist_id, $id = null)
    {
        $this->name = $name;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    function getClientName()
    {
        return $this->name;
    }

    function setClientName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function getStylistId()
   {
       return $this->stylist_id;
   }

   function setStylistId($new_stylist_id)
   {
       $this->new_stylist_id = (int) $new_stylist_id;
   }

   function getId()
   {
       return $this->id;
   }

    function save()
    {
        $executed = $GLOBALS['DB']->exec("INSERT INTO clients (client_name, stylist_id) VALUES ('{$this->getClientName()}', '{$this->getStylistId()}');");
        if ($executed) {
            $this->id= $GLOBALS['DB']->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    static function getAll()
   {
       $returned_clients = $GLOBALS['DB']->query('SELECT * FROM clients;');
        $clients = array();
        foreach($returned_clients as $client){
            $name = $client['name'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            $new_client = new Client($name, $stylist_id,  $id);
            array_push($clients, $new_client);
        }
        return $clients;
   }

   static function deleteAll()
    {
        $executed = $GLOBALS['DB']->exec('DELETE FROM clients;');
        if ($executed) {
            return true;
        } else {
            return false;
        }
    }

    static function find($search_id)
    {
        $found_client = null;
        $returned_clients = $GLOBALS['DB']->prepare("SELECT * FROM clients WHERE id = :id");
        $returned_clients->bindParam(':id', $search_id, PDO::PARAM_STR);
        $returned_clients->execute();
        foreach($returned_clients as $client) {
            $client_name = $client['name'];
            $stylist_id = $client['stylist_id'];
            $client_id = $client['id'];
            if ($client_id == $search_id) {
              $found_client = new Client($client_name, $stylist_id, $client_id);
            }
        }
        return $found_client;
    }

    function update($new_name)
    {
        $executed = $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
        if ($executed) {
           $this->setClientName($new_name);
           return true;
        } else {
           return false;
        }
    }

    function delete()
    {
        $executed = $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        if ($executed) {
           return true;
        } else {
           return false;
        }
    }
}
?>
