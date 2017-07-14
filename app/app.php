<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->post("/stylists", function() use ($app) {
       $stylist = new stylist($_POST['name']);
       $stylist->save();
       return $app['twig']->render('stylists.html.twig', array('stylists' => $stylist));
   });

   $app->get("/stylists/{id}", function($id) use ($app) {
       $stylist = Stylist::find($id);
       return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getTasks()));
   });

   $app->post("/delete_stylist", function() use ($app) {
       Task::deleteAll();
       return $app['twig']->render('delete_tasks.html.twig');
   });
   $app->get("/categories", function() use ($app) {
       return $app['twig']->render('categories.html.twig', array('categories' => Category::getAll()));
   });






?>
