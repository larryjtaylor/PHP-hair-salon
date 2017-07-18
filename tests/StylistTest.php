<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';
    require_once 'src/Client.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
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

           //Act
           $executed = $test_stylist->save();

           //Assert
           $this->assertTrue($executed, 'Stylist not successfully saved to the database');
       }

       function testGetId()
       {
           //Arrange
           $stylist_name = 'Roger';
           $test_stylist = new Stylist($stylist_name);
           $test_stylist->save();

           //Act
           $result = $test_stylist->getId();

           //Assert
           $this->assertEquals(true, is_numeric($result));
       }

        function testGetStylistName()
        {
            // Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);

            //Act
            $result = $test_stylist->getStylistName();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function testSetStylistName()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $new_name = 'Charlie';

            //Act
            $test_stylist->setStylistName($new_stylist_name);
            $result = $test_stylist->getStylistName();

            //Assert
            $this->assertEquals($new_stylist_name, $result);
        }


        function testGetAll()
         {
             //Arrange
             $stylist_name = 'Roger';
             $test_stylist = new Stylist($stylist_name);
             $test_stylist->save();
             $stylist_name2 = 'Melissa';
             $test_stylist2 = new Stylist($stylist_name2);
             $test_stylist2->save();

             //Act
             $result = Stylist::getAll();
             //Assert
             $this->assertEquals([$test_stylist, $test_stylist2], $result);
         }

         function testDeleteAll()
         {
             // Arrange
             $stylist_name = 'Roger';
             $test_stylist = new Stylist($stylist_name);
             $test_stylist->save();
             $stylist_name2 = 'Melissa';
             $test_stylist2 = new Stylist($stylist_name2);
             $test_stylist2->save();

             //Act
             Stylist::deleteAll();
             $result = Stylist::getAll();

             //Assert
             $this->assertEquals([], $result);
         }


        function testFind()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_name2 = "Melissa";
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();
            //Act
            $result = Stylist::find($test_stylist->getId());
            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $new_stylist_name = 'Melissa';

            //Act
            $test_stylist->update($new_stylist_name);

            //Assert
            $this->assertEquals('Melissa', $test_stylist->getStylistName());
        }

        function testDelete()
        {
            //Arrange
            $stylist_name = "Roger";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_name2 = "Melissa";
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();


            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }

        function testGetClients()
        {
            //Arrange
            $stylist_name = 'Roger';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist_id = $test_stylist->getId();

            $stylist_name2 = 'Melissa';
            $test_stylist2 = new Stylist($stylist_name2);
            $test_stylist2->save();
            $test_stylist_id2 = $test_stylist2->getId();

            $client_name = 'Frank';
            $test_client = new Client($client_name, $test_stylist_id);
            $test_client->save();

            $client_name2 = 'Dean';
            $test_client2 = new Client($client_name2, $test_stylist_id);
            $test_client2->save();

            $client_name3 = 'Sammy';
            $test_client3 = new Client($client_name3, $test_stylist_id2);
            $test_client3->save();

            //Act

            $result = $test_stylist->getClients();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }
    }
?>
