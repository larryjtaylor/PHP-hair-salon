<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once 'src/Stylist.php';

    $server = 'mysql:host=localhost:8889;dbname=salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TaskStylist extends PHPUnit_Framework_TestCase
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
           $name = "Roger";
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
    }
?>
