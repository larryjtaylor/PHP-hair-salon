# _Hair Salon_

#### _Epicodus-PHP, Week 3 Solo Project, 07.14.2017_

#### By _**Larry Taylor**_

## Description

A site for a hair salon in which a user can add and remove stylists, add and remove clients, and assign clients to a stylist.

## Prerequisites

_You will need the following properly installed on your computer:_

* [MAMP](https://www.mamp.info/en/) for Windows or MacOS
* [PHP](https://secure.php.net/)
* [Composer](https://getcomposer.org/)

## Configuration/Dependencies

_The app will use PHPunit,  Silex, and Twig._

## Setup/Installation

* Open GitHub site on your browser: https://github.com/larryjtaylor/PHP-hair-salon
* Select the dropdown (green box) "Clone or download"
* Copy the link for the GitHub repository
* Open Terminal on your computer
* In Terminal, perform the following steps:
````
  $ cd desktop
  $ git clone <paste repository link>
  $ cd PHP-hair-salon
  $ composer install
  ````
* To view app in browser:
  * Open MAMP and click Preferences
  * Click Ports and set Apache Port to 8888, and Msql port to 8889
  * Click Web Server and set the document root to the web folder of DeathStar directory and click OK
  * In MAMP click Start Servers
  * In MAMP click Open WebStart page
  * In Tools menu of WebStart page, click phpMyAdmin
  * Once in phpmyadmin page, click Import tab, click browse button, then navigate to the death_star.sql file in the project directory
  * In your browser, enter 'localhost:8888' to view the webpage on your browser

## Specifications

* The program will allow a user to create a stylist.
    * Input: Roger
    * Output: Roger

* The program will allow a user to list all stylists in the salon.
    * Input: All stylists
    * Output: Roger, Becky, Charlie, Melissa

* The program will allow a user to delete all stylists.
    * Input: Stylists
    * Output: ''

* The program will allow a user to create a client.
    * Input: Francois
    * Output: Francois

* The program will allow a user to delete a client.
    * Input: Francois
    * Output: ''

* The program will allow a user to assign a client to a stylist.
    * Input: Francois
    * Output: Becky's client

* The program will allow a user to see all clients assigned to a stylist.
    * Input: Becky
    * Output: Francois, Stephanie, Jack

* The program will allow a user to delete all clients from a stylist.
    * Input: clients
    * Output: ''


## Technologies Used

* _PHP_
* _HTML_
* _Silex_
* _Twig_
* _Composer_
* _MAMP_
* _PHPUnit_
* _MySql_
* _phpMyAdmin_

### License

MIT License

Copyright &copy; 2017 Larry Taylor

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
