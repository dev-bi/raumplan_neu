<?php

use BIKompass\Controller\FloorplanController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;

$route_map = [
    '/home' => 'index',
    '/something' => 'gnoo',
    '/floor-navigator' => 'floorplan'
];

$routes = [];
$collection = new RouteCollection();

foreach ($route_map as $key => $val) {
    //$routes []= new Route($key);
    $collection->add($val, new Route($key));
}
$collection->add('floorplan_api', new Route('api/floorplan'));

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($collection, $context);

try {
    extract($matcher->match($context->getPathInfo()), EXTR_SKIP);
    
    /* 
    * behandle floorplan API anders, als normale Routes.
    * normale Routes werden gerendert, die API gibt eine SVG als String zurück
    */
    if($_route === 'floorplan_api') {
        $roomId = $request->query->get('rid');
        $fc = new FloorplanController();
        echo $fc->getFloor($roomId);
        exit();
    } 

    ob_start();
    include sprintf('view/%s.php', $_route);

    $response = new Response(ob_get_clean());
        
} catch (ResourceNotFoundException $exception) {
    ob_start();
    include 'view/error/404.php';
    $response = new Response(ob_get_clean(), 404);
} catch (Exception $exception) {
    $response = new Response('500 - An error occurred', 500);
}

$response->send();