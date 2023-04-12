<?php

if(isset($_POST["addClient"])){

    $firstname = htmlentities($_POST["firstname"]);
    $lastname = htmlentities($_POST["lastname"]);
    $email = htmlentities($_POST["email"]);
    $phone = htmlentities($_POST["phone"]);
    $address = htmlentities($_POST["address"]);
    echo $email;
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
               
        
} 
?>

<div class="form-fo-contain">
    <h2 class="h2">Nouveau client</h2>
    <form action="" method="POST" enctype='multipart/form-data'>
    <input type="hidden" name="is_verified" value="0">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="lastname" class="form-label">Nom</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= isset($lastname) ? $lastname : null ?>">
                <?php if(isset($lastnameError)): ?>
                    <small class="form-text text-muted"><?= $lastnameError; ?></small>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="firstname" class="form-label">Prénom</label>
              <input type="text" class="form-control" name="firstname" id="firstname" value="<?= isset($firstname) ? $firstname : null ?>">
              <?php if(isset($firstnameError)): ?>
                  <small class="form-text text-muted"><?= $firstnameError; ?></small>
              <?php endif; ?>
            </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= isset($email) ? $email : null ?>">
        <?php if(isset($emailError)): ?>
            <small class="form-text text-muted"><?= $emailError; ?></small>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label for="phone" class="form-label">Téléphone</label>
              <input type="tel" maxlength="10" class="form-control" name="phone" id="phone" value="<?= isset($phone) ? $phone : null ?>">
              <?php if(isset($phoneError)): ?>
                  <small class="form-text text-muted"><?= $phoneError; ?></small>
              <?php endif; ?>
            </div>
        </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="address" class="form-label">Adresse</label>
                  <input type="text" class="form-control" name="address" id="address" value="<?= isset($address) ? $address : null ?>">
                  <?php if(isset($addressError)): ?>
                      <small class="form-text text-muted"><?= $addressError; ?></small>
                  <?php endif; ?>
                </div>
            </div>
        </div>
        <button type="submit" name="addClient" class="btn btn-primary">Ajouter</button>
    </form>
</div>



