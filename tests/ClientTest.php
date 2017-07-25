<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once 'src/Client.php';
    require_once 'src/Stylist.php';
    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function testGetClientName()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Eric';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            //Act
            $result = $test_client->getClientName();
            //Assert
            $this->assertEquals($client_name, $result);
        }

        function testSetClientName()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Eric';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);

            $new_client_name = 'Beatrice';
            //Act
            $test_client->setClientName($new_client_name);
            $result = $test_client->getClientName();
            //Assert
            $this->assertEquals('Beatrice', $result);
        }

        function testSave()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Eric';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            //Act
            $executed = $test_client->save();
            //Assert
            $this->assertTrue($executed, 'The client was not successfully saved to the database');
        }

        function testGetId()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Eric';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $executed = $test_client->save();
            //Act
            $result = $test_client->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetStylistId()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Eric';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            //Act
            $result = $test_client->getStylistId();
            //Assert
            $this->assertEquals($stylist_id, $result);
        }

        function testGetAll()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Eric';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name_2 = 'Beatrice';
            $test_client_2 = new Client($client_name_2, $stylist_id);
            $test_client_2->save();
            //Act
            $result = Client::getAll();
            //Assert
            $this->assertEquals([$test_client, $test_client_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Eric';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name_2 = 'Beatrice';
            $test_client_2 = new Client($client_name_2, $stylist_id);
            $test_client_2->save();
            //Act
            Client::deleteAll();
            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Eric';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();


            $client_name_2 = 'Beatrice';
            $test_client_2 = new Client($client_name_2, $stylist_id);
            $test_client_2->save();
            //Act
            $result = Client::find($test_client->getId());
            //Assert
            $this->assertEquals($test_client, $result);
        }

        function testUpdateName()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Eric';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $new_client_name = 'Beatrice';
            //Act
            $test_client->updateName($new_client_name);
            //Assert
            $this->assertEquals('Beatrice', $test_client->getClientName());
        }

        function testDelete()
        {
            //Arrange
            $stylist_name = 'Peter';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Eric';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name_2 = 'Beatrice';
            $test_client_2 = new Client($client_name_2, $stylist_id);
            $test_client_2->save();
            //Act
            $test_client->delete();
            //Assert
            $this->assertEquals([$test_client_2], Client::getAll());
        }
    }
?>
