<?php
require "../app/form/formValid.php";
require "../app/form/addNew.php";
require '../app/Autoloader.php';
App\Autoloader::register(); 

if(isset($_GET['page'])){

    $page = $_GET['page'];

}else{

    $page = 'home';
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

}



ob_start();

if($page === 'home'){

    require '../pages/home.php';

}else if($page === 'clients'){

    require '../pages/clients.php';

}else if($page === 'viewClient' && isset($id)){

    require '../pages/viewClient.php';

}else if($page === 'workers'){

    require '../pages/workers.php';

}else if($page === 'interventions'){

    require '../pages/interventions.php';

}else{

    require '../pages/404.php';
}

$content = ob_get_clean();
require '../pages/templates/default.php';