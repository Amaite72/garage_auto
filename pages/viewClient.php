<link rel="stylesheet" href="../public/css/viewClient.css">
<?php
$id = $_GET["id"];
$client = App\Table\Client::find($id);
$phone = App\Table\Client::formatPhoneNumber($client->phone);
$intervention = App\Table\Appointment::getInterByClient($id);
$id_vehicle = $intervention->vehicle_id;
$vehicle = App\Table\Vehicle::find($id_vehicle);

$updateUrl = "index.php?page=update&id=" . $id;
$deleteUrl = "index.php?page=delete&id=" . $id;
?>
<?php if(isset($_SESSION["success"]) && isset($_SESSION["id"])): ?>
    <?php if($_SESSION["id"] === $_GET["id"]): ?>
        <div class="alert alert-success" role="alert">
          <?= $_SESSION["success"]; ?>
        </div>
    <?php endif; ?>
<?php endif; ?>      

<div class="container">
    <a href="index.php?page=clients">
        <i class="fa-solid fa-arrow-left"></i>
        Liste clients
    </a>
    <div class="fontA">
        <!--<i class="fa-solid fa-users-line"></i>-->
        <!--<i class="fa-solid fa-people-group"></i>-->
        <!-- <i class="fa-solid fa-handshake-angle"></i> -->
        <img src="../public/images/client.png" alt="photo" class="img-profil">
    </div>
    <div class="d-flex align-items-center gap-2 mt-2">
        <p class="p-description"><?= ucfirst($client->first_name) . ' ' . ucfirst($client->last_name); ?></p>
        <a href="<?= $updateUrl; ?>">
            <i class="fa-solid fa-pencil"></i>
        </a>
    </div>
    <div class="info">
        <p class="details mt-3">Détails client</p>
        <div class="d-flex align-items-center gap-4 mt-3">
            <i class="fa-regular fa-envelope"></i>
            <p><?= $client->email; ?></p>
        </div>
        <div class="d-flex align-items-center gap-4 mt-3">
            <i class="fa-solid fa-phone"></i>
            <p><?= $phone; ?></p>
        </div>
        <div class="d-flex align-items-center gap-4 mt-3">
            <i class="fa-solid fa-location-dot"></i>
            <p><?= $client->address; ?></p>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2 mt-2">
        <p class="p-description"><?= $vehicle->brand . ' ' . $vehicle->model; ?></p>
        <a href="<?= $updateUrl; ?>">
            <i class="fa-solid fa-pencil"></i>
        </a>
    </div>
    <div class="info">
        <p class="details mt-3">Détails véhicule</p>  
            <div class="d-flex align-items-center gap-4 mt-3">
                <i class="fa-solid fa-calendar-days"></i>
                <p><?= $vehicle->year_manufacture; ?></p>
            </div>  
            <div class="d-flex align-items-center gap-4 mt-3">
                <i class="fa-solid fa-gauge"></i>
                <p><?= $vehicle->mileage . ' km'; ?></p>
            </div>
            <div class="matricule mt-3">
                <?= $vehicle->matriculation; ?>
            </div>
    </div>
      
</div>

