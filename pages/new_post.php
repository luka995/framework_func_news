<h1>Nova vest</h1>

<div class="row">
    <div class="col-12">
        
        <form method="post">
            
            <div class="form-group">
                <label for="title">Naslov</label>
                <input type="text" class="form-control" placeholder="Unesite naslov vesti" id="title" name="Post[title]" required>
            </div>

            <div class="form-group">
                <label for="img">Slika</label>
                <input type="text" class="form-control" placeholder="Unesite adresu slike" id="img" name="Post[img]" required>
            </div>            

            <div class="form-group">
                <label for="content">Vest</label>
                <textarea class="form-control" rows="20" placeholder="Unesite vest" id="img" name="Post[content]" required></textarea>
            </div>            
            
            <button type="submit" class="btn btn-primary">Objavi</button>

        </form>

    </div>    
</div>