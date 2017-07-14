<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
       {
         Stylist::deleteAll();
       }

       function testSave()
       {
           //Arrange
           $name = 'Roger';
           $test_stylist = new Stylist($name);

           //Act
           $executed = $test_stylist->save();

           //Assert
           $this->assertTrue($executed, 'Task not successfully saved to database');
       }

       function testGetId()
       {
           //Arrange
           $name = 'Roger';
           $test_stylist = new Stylist($name);
           $test_stylist->save();

           //Act
           $result = $test_stylist->getId();

           //Assert
           $this->assertEquals(true, is_numeric($result));
       }

        function testGetName()
        {
            // Arrange
            $name = 'Roger';
            $test_stylist = new Stylist($name);

            //Act
            $result = $test_stylist->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = 'Roger';
            $test_stylist = new Stylist($name);
            $new_name = 'Charlie';

            //Act
            $test_stylist->setName($new_name);
            $result = $test_stylist->getName();

            //Assert
            $this->assertEquals($new_name, $result);
        }


        function testGetAll()
         {
             //Arrange
             $name = 'Roger';
             $test_stylist = new Stylist($name);
             $test_stylist->save();
             $name2 = 'Melissa';
             $test_stylist2 = new Stylist($name2);
             $test_stylist2->save();

             //Act
             $result = Stylist::getAll();
             //Assert
             $this->assertEquals([$test_stylist, $test_stylist2], $result);
         }

         function testDeleteAll()
         {
             // Arrange
             $name = 'Roger';
             $test_stylist = new Stylist($name);
             $test_stylist->save();
             $name2 = 'Melissa';
             $test_stylist2 = new Stylist($name2);
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
            $name = 'Roger';
            $name2 = "Melissa";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();
            //Act
            $id = $test_stylist->getId();
            $result = Stylist::find($id);
            //Assert
            $this->assertEquals($test_stylist, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = 'Roger';
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $new_name = 'Melissa';

            //Act
            $test_stylist->update($new_name);

            //Assert
            $this->assertEquals('Melissa', $test_stylist->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Roger";
            $test_stylist = new Stylist($name);
            $test_stylist->save();

            $name2 = "Melissa";
            $test_stylist2 = new Stylist($name2);
            $test_stylist2->save();


            //Act
            $test_stylist->delete();

            //Assert
            $this->assertEquals([$test_stylist2], Stylist::getAll());
        }
    }
?>
