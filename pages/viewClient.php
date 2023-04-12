<link rel="stylesheet" href="../public/css/viewClient.css">
<?php
$client = App\Table\Client::find($_GET["id"]);
?>

<div class="client-name p-3 d-flex justify-content-around align-items-center">

<p><?= $client->last_name; ?></p>
<p><?= $client->first_name; ?></p>

</div>