<?php

namespace App\form;

use App\Table;

class FormRender {

    public function render(string $id, string $titleForm, string $nameInput, string $nameButton) {   
        
        $client = Table\Client::find($id);
        
        return '<div class="form-fo-contain">
                <h2 class="h2">' . $titleForm . '</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="is_verified" value="0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname" class="form-label">Nom</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="'. $client->last_name . ' ">
                                <?php if(isset(' . $lastnameError  . ')): ?>
                                    <small class="form-text text-muted"><?= ' . $lastnameError . '; ?></small>
                                <?php endif; ?>
                            </div>                                         
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="' . $client->first_name . '">
                                <?php if(isset(' . $firstnameError . ')): ?>
                                    <small class="form-text text-muted"><?=' . $firstnameError . '; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="' . $client->email . '">
                        <?php if(isset(' . $emailError . ')): ?>
                            <small class="form-text text-muted"><?=' . $emailError . '; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="tel" maxlength="10" class="form-control" name="phone" id="phone" value="' . $client->phone . '">
                                <?php if(isset(' . $phoneError . ')): ?>
                                    <small class="form-text text-muted"><?=' . $phoneError . '; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control" name="address" id="address" value="' . $client->address . '">
                                <?php if(isset(' . $addressError . ')): ?>
                                    <small class="form-text text-muted"><?=' . $addressError . '; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="' . $nameInput . '" class="btn btn-primary">' . $nameButton . '</button>
                </form>
            </div>
            ';
    }

    public function getError($data){

        var_dump($data->lastnameError);
        var_dump($data->firstnameError);
        var_dump($data->emailError);
        var_dump($data->phoneError);
        var_dump($data->addressError);

    } 
    
}
    
