<?php

// @ the loader.controller is just reponsible of create objects and execute methods, it should be as thin as possible 

include '../soprano/lib/library.php';
include '../soprano/secure/config.php';
include '../soprano/secure/database.php';
include '../soprano/model/sql.model.php';
include '../soprano/controller/router.controller.php';
include '../soprano/view/view.php';
//include 'model/logic.model.php';
//include 'view/view.php'; // the view just select the template.
//include 'controller/router.controller.php';




$_secure_config_obj = new config();

$_secure_database_obj = new database($_secure_config_obj);

$_controller_router_obj = new router();

$_model_sql_driver_obj = new sql_driver($_secure_database_obj, $_secure_config_obj, $_controller_router_obj);

$content = $_model_sql_driver_obj->get_everything_from_uri();

//print_r ($content);

$_view_view_obj = new view($content, $_secure_config_obj);

$_view_view_obj->render_template();





?>