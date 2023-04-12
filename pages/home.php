<link rel="stylesheet" href="../public/css/home.css">
<!-- Inclure la bibliothèque de graphiques Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Créer un élément canvas pour afficher le graphique -->
<div class="graph d-flex m-1">
    <div class="canvas-size">
        <canvas id="myChart" style="width:100%; height:100%;"></canvas>
    </div>
    <div class="canvas-size doughnut">
        <canvas id="myChart2"></canvas>
        <select class="form-select" aria-label="Default select example">
          <option selected value="Pneus">Pneus</option>
          <option value="Freins">Freins</option>
          <option value="Filtres">Filtres</option>
          <option value="Huiles">Huiles</option>
        </select>
    </div>
    
</div>

<?php

//Affichage date, semaine, mois, année en cours dans les labels du graphique
$today = date('d');
$week_number = date('W');
//traduire le mois en français
setlocale(LC_TIME, 'fr_FR.utf8');
$month_name = ucfirst(strftime("%B"));
$year = date('Y');

//variables utiliser comme parametre aux méthodes qu'on fait appel
$now = date('Y-m-d');
$month = date("m"); 

//donne le nombre de rdv journalier selon l'employé connecter
$inter_today = App\Table\Appointment::myDailyInterventions(2, $now); 
//donne le nombre de rdv de la semaine en cours selon l'employé connecter
$inter_per_week = App\Table\Appointment::weekInterventions(2); 
//donne le nombre de rdv mensuel selon l'employé connecter
$inter_per_month = App\Table\Appointment::periodInterventions(2, $month); 
//donne le nombre de rdv annuel selon l'employé connecter
$inter_per_year = App\Table\Appointment::periodInterventions(2, $year); 
/* echo '<pre>';
var_dump($inter_per_week);
echo '</pre>';  */
?>

<!-- \\\\\\\\\\\\\\\\\\ GRAPHIQUE \\\\\\\\\\\\\\\\\\ -->

<script>
//GESTION RDV EMPLOYE


// Récupérer les données de vente de voitures de votre base de données
//let data = [10, 20, 30, 60];
let data = [<?= $inter_today; ?>, <?= $inter_per_week; ?>, <?= $inter_per_month; ?>, <?= $inter_per_year; ?>];
let delayed;
// Créer un graphique à barres à partir des données
let ctx = document.getElementById('myChart').getContext('2d');
let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Aujourd\'hui le <?= $today; ?>', 'Semaine <?= $week_number; ?>', '<?= $month_name; ?>', 'Année <?= $year; ?>'],
        datasets: [{
            label: 'Nombre d\'interventions',
            data: data,
            backgroundColor: [
                'rgba(23, 170, 146, 1)',
                'rgba(23, 99, 111, 1)',
                'rgba(37, 138, 142, 1)',
                'rgb(0, 225, 188)'
            ],
            borderColor: [
                'rgba(17, 129, 110, 1)',
                'rgba(17, 72, 81, 1)',
                'rgba(29, 100, 103, 1)',
                'rgb(0, 184, 157)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        animation: {
            onComplete: () => {
                delayed = true;
            },
            delay: (context) => {
                let delay = 0;
                if (context.type === 'data' && context.mode === 'default' && !delayed) {
                  delay = context.dataIndex * 200 + context.datasetIndex * 200;
                }
                return delay;
            },
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>


<?php
//Consulter le stock de pneus
$all_tires = App\Table\Inventory::stock(1,'Pneus');
?>

<!-- \\\\\\\\\\\\\\\\\\ DONUT \\\\\\\\\\\\\\\\\\ -->

<script>
//GESTION STOCK MARCHANDISES

let ctx2 = document.getElementById('myChart2').getContext('2d');
let myChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Stock disponible', 'Stock en cours de commande', 'Stock réservé'],
        datasets: [{
            label: 'Stocks',
            data: [<?= $all_tires; ?>, 20, 10],
            backgroundColor: [
                'rgba(23, 170, 146, 1)',
                'rgba(23, 99, 111, 1)',
                'rgba(37, 138, 142, 1)'
            ],
            borderColor: [
                'rgba(17, 129, 110, 1)',
                'rgba(17, 72, 81, 1)',
                'rgba(29, 100, 103, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        title: {
            display: true,
            text: 'Stocks'
        },
        legend: {
            position: 'bottom',
        }
    }
});

</script>

<div class="container table-pc" id="table-pc">

<?php 
$interventions = App\Table\Appointment::firstThreeInter(2, $now);
    //en cas d'intervention(s) celles-ci s'affichent
    if($interventions != null):

?>


<h2 class="inter-title">Interventions du jour</h2>
<section class="table-container">
    <table>
        <thead>
            <!-- ////////////////////////////// ENTETE TABLEAU PC /////////////////////////// --> 
            <tr>
                <th><i class="fa-solid fa-circle-info"></i></th>
                <th class="text-left th">Client</th>
                <th>Véhicule</th>
                <th>Immatriculation</th>
                <th>Motif</th>
                <th>Heure</th>
            </tr>
            <!-- ////////////////////////////// ENTETE TABLEAU PC /////////////////////////// --> 
            
        </thead>
        <tbody>       
                <?php foreach($interventions as $rdv): ?> 
                <?php   
                    $client = App\Table\Client::find($rdv->client_id);
                    $vehicule = App\Table\Vehicle::find($rdv->vehicle_id);
                    //changer le format de l'heure
                    $format_time = date('H : i', strtotime($rdv->time));
                    
                ?>   
                <!-- ////////////////////////////// LIGNE PC /////////////////////////// -->           
                <tr>               
                    <td class="table-button"><a href="index.php?page=viewClient&id=<?= $rdv->client_id; ?>" class="button"><i class="fa-solid fa-chevron-right"></i></a></td>
                    <td class="text-left td"><?= ucfirst($client->last_name) . ' ' . ucfirst($client->first_name); ?></td>
                    <td><?= $vehicule->brand; ?></td>
                    <td><?= $vehicule->matriculation; ?></td>
                    <td style="background-color:<?= $rdv->pattern_color; ?>; color:#ffffff; font-weight:600;"><?= $rdv->pattern; ?></td>
                    <td><?= $format_time; ?></td>               
                </tr> 
                <!-- ////////////////////////////// LIGNE TELEPHONE /////////////////////////// -->               
              <?php endforeach; ?>       
        </tbody>
    </table>
</section> 

<?php else: ?>

    <h2 class="inter-title">Aucune intervention</h2>
    <div class="img-relax">
        <img src="../public/images/relax.webp" alt="relax">
    </div>
<?php endif; ?>  

</div>


<!-- /////////////////////////////////////////////////////////////////////////// 
                                        TABLEAU TELEPHONE
/////////////////////////////////////////////////////////////////////////////////-->


<div class="container appointment" id="table-phone">

<?php 

    //en cas d'intervention(s) celles-ci s'affichent
    if($interventions != null):

?>


<h2 class="inter-title">Interventions du jour</h2>
<section class="table-container">
    <?php foreach($interventions as $rdv): ?> 
    <a class="client-link" href="index.php?page=viewClient&id=<?= $rdv->client_id; ?>">
    <table class="m-3">
        <thead>
            <tr>
                <th><i class="fa-solid fa-circle-info thead-client"></i></th>
                <td><?= ucfirst($client->last_name) . ' ' . ucfirst($client->first_name); ?></td> 
                
            </tr>
        </thead>
        <tbody>   
            <tr>
                <th>Marque</th>
                <td><?= $vehicule->brand; ?></td>      
            </tr>
            <tr>
                <th>Matricule</th> 
                <td class="td-column"><?= $vehicule->matriculation; ?></td>     
            </tr>
            <tr>
                <th>Motif</th> 
                <td><?= $rdv->pattern; ?></td>     
            </tr>
            <tr>
                <th>Heure</th> 
                <td><?= $format_time; ?></td>     
            </tr>                                
        </tbody>
    </table>
    </a>
    <?php endforeach; ?> 
</section> 

<?php else: ?>

    <h2 class="inter-title">Aucune intervention</h2>
    <div class="img-relax">
        <img src="../public/images/relax.webp" alt="relax">
    </div>
<?php endif; ?>  

</div>

