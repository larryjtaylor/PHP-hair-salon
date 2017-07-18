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
            Stylist::deleteAll();
            Client::deleteAll();
        }

       function testSave()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();
            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);

            //Act
            $executed = $test_client->save();

            //Assert
            $this->assertTrue($executed, "The new client has NOT been added to the database");
        }

       function testGetId()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Frank';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetClientName()
        {
            // Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Charlie';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals('Charlie', $result);
        }

        function testSetClientName()
        {
            //Arrange

            $stylist_name = 'Melissa';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Charlie';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $new_client_name = 'Sammy';

            //Act
            $test_client->setClientName($new_client_name);
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals('Sammy', $result);
        }

        function testGetStylistID()
        {
            // Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Frank';
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            // Act
            $result = $test_client->getStylistID();

            // Assert
            $this->assertEquals($stylist_id, $result);
        }

        function test_setStylistId()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $test_client->setStylistId($stylist_id);
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);
        }

        function testGetAll()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();
            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Dean';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();
            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function testDeleteAll()
        {
            // Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();
            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Dean';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            Client::deleteAll();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);
        }


        function testFind()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();
            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Dean';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client2->getId());
            //Assert
            $this->assertEquals($test_client2, $result);
        }

        function testUpdate()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Dean';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $new_client_name = 'Dean';

            //Act
            $test_client->update($new_client_name);

            //Assert
            $this->assertEquals('Dean', $test_client->getClientName());
        }

        function testDelete()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = 'Dean';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();


            //Act
            $test_client2->delete();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }
    }
?>
