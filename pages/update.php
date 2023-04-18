<?php
$id = $_GET['id'];
$client = App\Table\Client::find($id);

if(isset($_POST["update"])){
    
    $lastname = htmlentities($_POST["lastname"]);
    $firstname = htmlentities($_POST["firstname"]);
    $email = htmlentities($_POST["email"]);
    $phone = htmlentities($_POST["phone"]);
    $address = htmlentities($_POST["address"]);  
    $data = [
        "lastname" => $lastname,
        "firstname" => $firstname,
        "email" => $email,
        "phone" => $phone,
        "address" => $address,
    ];      
    
    $formValidate = App\Form\FormValid::getEmptyFields($data); 
    $lastnameError = App\Form\FormValid::getErrorForField("lastname");
    $firstnameError = App\Form\FormValid::getErrorForField("firstname");
    $emailError = App\Form\FormValid::getErrorForField("email");
    $phoneError = App\Form\FormValid::getErrorForField("phone");
    $addressError = App\Form\FormValid::getErrorForField("address"); 

    if($formValidate){
        
        if($lastnameError === NULL && $firstnameError === NULL && $emailError === NULL && $phoneError === NULL && $addressError === NULL){
            $update = new App\form\Individual($data);  
            $success = $update->update($id, "client");
            $_SESSION["id"] = $id;
            $_SESSION["success"] = $success;  
            header('Location: index.php?page=viewClient&id=' . $id);
            exit;   
        } 
    }
        
        
      
} 
?>

<div class="form-fo-contain">
    <h2 class="h2">Modifier client</h2>
    <form action="" method="POST" enctype='multipart/form-data' >
    <input type="hidden" name="is_verified" value="0">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= isset($client->last_name) ? $client->last_name : null ?>">
                <?php if(isset($lastnameError)): ?>
                    <small class="form-text text-muted"><?= $lastnameError; ?></small>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="firstname" class="form-label">Prénom</label>
              <input type="text" class="form-control" name="firstname" id="firstname" value="<?= isset($client->first_name) ? $client->first_name : null ?>">
              <?php if(isset($firstnameError)): ?>
                  <small class="form-text text-muted"><?= $firstnameError; ?></small>
              <?php endif; ?>
            </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= isset($client->email) ? $client->email : null ?>">
        <?php if(isset($emailError)): ?>
            <small class="form-text text-muted"><?= $emailError; ?></small>
        <?php endif; ?>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-group">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="tel" maxlength="10" class="form-control" name="phone" id="phone" value="<?= isset($client->phone) ? $client->phone : null ?>">
              <?php if(isset($phoneError)): ?>
                  <small class="form-text text-muted"><?= $phoneError; ?></small>
              <?php endif; ?>
            </div>
        </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="address" class="form-label">Adresse</label>
                  <input type="text" class="form-control" name="address" id="address" value="<?= isset($client->address) ? $client->address : null ?>">
                  <?php if(isset($addressError)): ?>
                      <small class="form-text text-muted"><?= $addressError; ?></small>
                  <?php endif; ?>
                </div>
            </div>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Modifier</button>
    </form>
</div>



