
<link rel="stylesheet" href="../public/css/tableau.css">
<?php
$page = isset($_GET['number']) ? intval($_GET['number']) : 1;

if ($page <= 0) {
    // Rediriger l'utilisateur vers la première page
    header('Location: index.php?page=clients&number=1');
    exit;
}
$limit = 10;
// Indice de l'enregistrement à partir duquel commencer à afficher
$offset = ($page - 1) * $limit;

$workers = App\Table\Worker::tenFirst($limit, $offset);

// nombre total d'enregistrements
$count_workers = App\Table\Client::count();
$total_workers = $count_workers[0]->count;
$total_pages = ceil($total_workers / $limit); // nombre total de pages




?>
<div class="container table-pc" id="table-pc">
<section class="table-container">
    <table>
        <thead>
            <!-- ////////////////////////////// ENTETE TABLEAU PC /////////////////////////// --> 
            <tr>
                <th><i class="fa-solid fa-circle-info"></i></th>
                <th class="text-left th">Employé</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
            </tr>
            <!-- ////////////////////////////// ENTETE TABLEAU PC /////////////////////////// -->          
        </thead>
        <tbody>
        <?php foreach($workers as $worker): ?> 
                <!-- ////////////////////////////// LIGNE PC /////////////////////////// -->           
                <tr>               
                    <td class="table-button">
                        <a href="index.php?page=viewClient&id=<?= $worker->id; ?>" class="button">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </td>
                    <td class="text-left td"><?= ucfirst($worker->last_name) . ' ' . ucfirst($worker->first_name);  ?></td>
                    <td><?= $worker->email; ?></td>
                    <td><?= $worker->phone; ?></td>
                    <td><?= $worker->address; ?></td>              
                </tr> 
                <!-- ////////////////////////////// LIGNE TELEPHONE /////////////////////////// -->                   
        <?php endforeach; ?>  
        </tbody>
    </table>
</section> 
</div>
<!-- /////////////////////////////////////////////////////////////////////////// 
                                        TABLEAU TELEPHONE
/////////////////////////////////////////////////////////////////////////////////-->
<div class="container appointment" id="table-phone">
<section class="table-container"> 
    <a class="client-link" href="index.php?page=viewClient&id=">
    <table class="m-3">
        <thead>
            <tr>
                <th><i class="fa-solid fa-circle-info thead-client"></i></th>
                <td></td>  
            </tr>
        </thead>
        <tbody>   
            <tr>
                <th>Email</th>
                <td></td>      
            </tr>
            <tr>
                <th>Téléphone</th> 
                <td class="td-column"></td>     
            </tr>
            <tr>
                <th>Adresse</th> 
                <td></td>     
            </tr>                            
        </tbody>
    </table>
    </a>
</section> 
</div>




<nav aria-label="..." class="position-relative top-0 start-50">
    <ul class="pagination pagination-sm">
    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>  
        <?php if($i === $page): ?>
            <li class="page-item active" aria-current="page">
            <a class="page-link"><?= $i; ?></a>
            </li>
        <?php else: ?>
        <li class="page-item"><a class="page-link" href="?page=workers&number=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>  
    </ul>
</nav>

