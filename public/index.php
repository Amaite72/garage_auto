<?php

require '../app/Autoloader.php';
App\Autoloader::register(); 

if(isset($_GET['page'])){

    $page = $_GET['page'];

}else{

    $page = 'home';
}




ob_start();

if($page === 'home'){

    require '../pages/home.php';

}else if($page === 'clients'){

    require '../pages/clients.php';

}else if($page === 'workers'){

    require '../pages/workers.php';

}else if($page === 'interventions'){

    require '../pages/interventions.php';

}else{

    require '../pages/404.php';
}

$content = ob_get_clean();
require '../pages/templates/default.php';