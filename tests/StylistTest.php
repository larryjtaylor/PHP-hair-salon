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

        function testGetStylistName()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            //Act
            $result = $test_stylist->getStylistName();
            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function testSetStylistName()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);

            $new_stylist_name = 'Jackie';
            //Act
            $test_stylist->setStylistName($new_stylist_name);
            $result = $test_stylist->getStylistName();
            //Assert
            $this->assertEquals('Jackie', $result);
        }

        function testGetId()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            //Act
            $result = $test_stylist->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            //Act
            $executed = $test_stylist->save();
            //Assert
            $this->assertTrue($executed, 'The stylist was not successfully saved to the database');
        }

        function testGetAll()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_name_2 = 'Jackie';
            $test_stylist_2 = new Stylist($stylist_name_2);
            $test_stylist_2->save();
            //Act
            $result = Stylist::getAll();
            //Assert
            $this->assertEquals([$test_stylist, $test_stylist_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_name_2 = 'Jackie';
            $test_stylist_2 = new Stylist($stylist_name_2);
            $test_stylist_2->save();
            //Act
            Stylist::deleteAll();
            //Assert
            $result = Stylist::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_name_2 = 'Jackie';
            $test_stylist_2 = new Stylist($stylist_name_2);
            $test_stylist_2->save();
            //Act
            $result = Stylist::find($test_stylist->getId());
            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $new_stylist_name = 'Jackie';
            //Act
            $test_stylist->update($new_stylist_name);
            //Assert
            $this->assertEquals('Jackie', $test_stylist->getStylistName());
        }

        function testDelete()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $stylist_name_2 = 'Jackie';
            $test_stylist_2 = new Stylist($stylist_name_2);
            $test_stylist_2->save();
            //Act
            $test_stylist->delete();
            //Assert
            $this->assertEquals([$test_stylist_2], Stylist::getAll());
        }

        function testGetClients()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $test_stylist_id = $test_stylist->getId();

            $client_name = 'Julie';
            $test_client = new Client($client_name, $test_stylist_id);
            $test_client->save();

            $client_name_2 = 'Alex';
            $test_client_2 = new Client($client_name_2, $test_stylist_id);
            $test_client_2->save();
            //Act
            $result = $test_stylist->getClients();
            //Assert
            $this->assertEquals([$test_client, $test_client_2], $result);
        }

        function deleteStylistClients()
        {
            //Arrange
            $stylist_name = 'Carol';
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $client_name = 'Julie';
            $test_stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $test_stylist_id);
            $test_client->save();
            //Act
            $test_stylist->delete();
            //Assert
            $this->assertEquals([], Client::getAll());
        }
    }
?>
