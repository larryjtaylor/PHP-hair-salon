<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__.'/../src/Client.php';


    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post('/', function() use ($app) {
        $stylist_name = $_POST['stylist_name'];
        $stylist = new Stylist($stylist_name);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app) {
       $stylist = new stylist($_POST['stylist_name']);
       $stylist->save();
       return $app['twig']->render('stylists.html.twig', array('stylists' => $stylist));
   });

   $app->get('/edit_stylist', function() use ($app) {
       $new_name_st = $_GET['new_stylist_name'];
       $stylist_id = $_GET['stylist_id'];
       $stylist = Stylist::find($stylist_id);
       $stylist->update($new_stylist_name);
       return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
   });

   $app->get('/delete_stylist', function() use ($app) {
       $stylist_id = $_GET['stylist_id'];
       $stylist = Stylist::find($stylist_id);
       $stylist->delete();
       return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
   });

   $app->get('/stylist/{id}/edit', function($id) use ($app) {
       $stylist = Stylist::find($id);
       return $app['twig']->render('edit_stylist.html.twig', array('stylist' => $stylist));
   });

   $app->get('/all_stylists_deleted', function() use ($app) {
       Stylist::deleteAll();
       return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
   });

   $app->get('/stylist/{id}/delete_clients', function($id) use ($app) {
       $stylist = Stylist::find($id);
       $clients = $stylist->getClients();
       return $app['twig']->render('delete_select_clients.html.twig', array('stylist' => $stylist, 'clients' => $clients));
   });

   $app->get('/stylists/{id}', function($id) use ($app) {
       $stylist = Stylist::find($id);
       $clients = $stylist->getClients();
       return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $clients));
   });

///////////////////////////////////

$app->get("/clients", function() use ($app) {
    return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
});

$app->get('/edit_client', function() use ($app) {
    $new_client_name = $_GET['new_client_name'];
    $client_id = $_GET['client_id'];
    $client = Client::find($client_id);
    $client->update($new_client_name);
    $stylist_id = $_GET['stylist_id'];
    $stylist = Stylist::find($stylist_id);
    $clients = $stylist->getClients();
    return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $clients));
});

$app->get('/delete_clients', function() use ($app) {
    $stylist_id = $_GET['stylist_id'];
    $stylist = Stylist::find($stylist_id);
    $stylist->deleteClients();
    $clients = $stylist->getClients();
    return $app['twig']->render('stylists.html.twig', array('clients' => $clients, 'stylist' => $stylist));
});

$app->post('/clients', function() use ($app) {
    $client_name = $_POST['client_name'];
    $stylist_id = $_POST['stylist_id'];
    $client = new Client($client_name, $stylist_id);
    $client->save();
    $stylist = Stylist::find($stylist_id);
    return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
});

$app->get('/delete_client', function() use ($app) {
    $client_id = $_GET['client_id'];
    $client = Client::find($client_id);
    $client->delete();
    $stylist_id = $_GET['stylist_id'];
    $stylist = Stylist::find($stylist_id);
    $clients = $stylist->getClients();
    return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
});

$app->get('/client/{id}/edit', function($id) use ($app) {
    $client = Client::find($id);
    return $app['twig']->render('edit_client.html.twig', array('client' => $client));
});

$app->get('/all_clients_deleted', function() use ($app) {
    Client::deleteAll();
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
});

return $app;






?>
