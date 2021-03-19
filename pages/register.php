<h1>Registracija novog korisnika</h1>

<div class="row">
    <div class="col-12">
        
        <form method="post">
            
            <div class="form-group">
                <label for="email">Imejl/korisničko ime</label>
                <input type="text" class="form-control" placeholder="Unesite imejl ili korisničko ime" id="email" name="Member[email]" required>
            </div>

            <div class="form-group">
                <label for="full-name">Ime za prikaz</label>
                <input type="text" class="form-control" placeholder="Unesite ime za prikaz" id="full-name" name="Member[full_name]" required>
            </div>            
            
            <div class="form-group">
                <label for="type">Tip korisnika</label>
                <select class="form-control" id="type" name="Member[type_id]" required>
                    <?php foreach ($types as $type):?>
                        <option value="<?= $type['id'] ?>">
                            <?= htmlspecialchars($type['type_name']) ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="pwd">Lozinka</label>
                <input type="password" class="form-control" placeholder="Unesite lozinku" id="pwd" name="Member[password]" required>
            </div>

            <button type="submit" class="btn btn-primary">Registruj</button>

        </form>

    </div>    
</div>