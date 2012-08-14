<?php
add_plugin_hook('define_routes', 'item_id_define_route');
function item_id_define_route($router)
{
    $route = new Zend_Controller_Router_Route(
        'item-id/:dc-identifier', 
        array(
            'module' => 'item-id', 
            'controller' => 'index', 
            'action' => 'route', 
        )
    );
    $router->addRoute('item_id', $route);
}