<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Client.php';

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
           $name = 'Frank';
           $stylist_id = 2;
           $test_client = new Client($name, $stylist_id);

           //Act
           $executed = $test_client->save();

           //Assert
           $this->assertTrue($executed, 'Client not successfully saved to database');
       }

       function testGetId()
       {
           //Arrange
           $name = 'Frank';
           $stylist_id = 2;
           $test_client = new Client($name, $stylist_id);
           $test_client->save();

           //Act
           $result = $test_client->getId();

           //Assert
           $this->assertEquals(true, is_numeric($result));
       }

        function testGetName()
        {
            // Arrange
            $name = 'Frank';
            $stylist_id = 2;
            $test_client = new Client($name, $stylist_id);

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = 'Roger';
            $stylist_id = 2;
            $test_client = new Client($name, $stylist_id);
            $new_name = 'Charlie';

            //Act
            $test_client->setName($new_name);
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }

        function testGetStylistID()
        {
            // Arrange
            $name = "Frank";
            $stylist_id = 2;
            $test_client = new Client($name, $stylist_id);

            // Act
            $result = $test_client->getStylistID();

            // Assert
            $this->assertEquals($stylist_id, $result);
        }

        function testGetAll()
         {
             //Arrange
             $name = 'Roger';
             $stylist_id = 2;
             $test_client = new Client($name, $stylist_id);
             $test_client->save();
             $name2 = 'Melissa';
             $stylist_id2 = 3;
             $test_client2 = new Client($name2, $stylist_id2);
             $test_client2->save();

             //Act
             $result = Client::getAll();
             //Assert
             $this->assertEquals([$test_client, $test_client2], $result);
         }

         function testDeleteAll()
         {
             // Arrange
             $name = 'Roger';
             $stylist_id = 2;
             $test_client = new Client($name, $stylist_id);
             $test_client->save();
             $name2 = 'Melissa';
             $stylist_id = 3;
             $test_client2 = new Client($name2, $stylist_id2);
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
            $name = 'Roger';
            $stylist_id = 2;
            $test_client = new Client($name, $stylist_id);
            $test_client->save();
            $name2 = "Melissa";
            $stylist_id2 = 3;
            $test_client2 = new Client($name2, $stylist_id2);
            $test_client2->save();
            //Act
            $result = Client::find($test_client->getId());
            //Assert
            $this->assertEquals($test_client, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = 'Roger';
            $stylist_id = 2;
            $test_client = new Client($name, $stylist_id);
            $test_client->save();

            $new_name = 'Melissa';

            //Act
            $test_client->update($new_name);

            //Assert
            $this->assertEquals('Melissa', $test_client->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Roger";
            $stylist_id = 2;
            $test_client = new Client($name, $stylist_id);
            $test_client->save();

            $name2 = "Melissa";
            $stylist_id2 = 3;
            $test_client2 = new Client($name2, $stylist_id2);
            $test_client2->save();


            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }
    }
?>
