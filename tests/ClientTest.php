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
            $stylist_id = $test_stylist->getId();

            $client_name = 'Frank';
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
            $stylist_id = $test_stylist->getId();

            $client_name = 'Charlie';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals($client_name, $result);
        }

        function testSetClientName()
        {
            //Arrange

            $stylist_name = 'Melissa';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Charlie';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $new_client_name = 'Sammy';

            //Act
            $test_client->setClientName($new_client_name);
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals($new_client_name, $result);
        }

        function testGetStylistID()
        {
            // Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Frank';
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

            $stylist_name = 'Melissa';
            $test_stylist2 = new Stylist($stylist_name);
            $test_stylist2->save();
            $stylist_id2 = $test_stylist2->getId();

            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $test_client->setStylistId($stylist_id2);
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals($stylist_id2, $result);
        }

        function testGetAll()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = 'Frank';
            $test_client = new Client($client_name, $category_id);
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
            $result = Client::getAll();

            //Assert
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
            $id = $test_client->getId();
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

            $client_name = 'Frank';
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $new_client_name = 'Dean';

            //Act
            $test_client->update($new_client_name);

            //Assert
            $this->assertEquals($new_client_name, $test_client->getClientName());
        }

        function testDelete()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_client = new Client($stylist_name, $stylist_id);
            $test_client->save();
            $stylist_id = $test_stylist->getId();

            $client_name2 = 'Frank';
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            $client_name3 = 'Dean';
            $test_client3 = new Client($client_name3, $stylist_id);
            $test_client3->save();


            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }

        function testGetStylist()
        {
            //Arrange
            // create two categories.
            $name = 'Roger';
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist_id = $test_stylist->getId();

            $name2 = 'Melissa';
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();
            $test_stylist_id2 = $test_stylist2->getId();

            // create three tasks. Assign them to different categories.
            $client = 'Frank';
            $test_client = new Client($client, $test_stylist_id);
            $test_client->save();

            $client2 = 'Dean';
            $test_client2 = new Client($client2, $test_stylist_id);
            $test_client2->save();

            // assign this client to stylist2 so that we get stylist1's clients, they are the correct ones.
            $client3 = 'Sammy';
            $test_client3 = new Client($client3, $test_stylist_id2);
            $test_client3->save();

            //Act

            $result = $test_stylist->getClients();

            //Assert
            // be sure that our result does not include $test_client3.
            $this->assertEquals([$test_client, $test_client2], $result);
        }
    }
?>
