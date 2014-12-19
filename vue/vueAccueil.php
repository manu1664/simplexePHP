<?php $this->titre = "Le simplexe en toute simplicité";?>

<!-- Formulaire du simplexe -->
<div class="col-md-8">
    <img src="img/Simplex_description.png" class="img-responsive" alt="Description du simplexe">
</div>
<div class="col-md-4 col-xs-6">
            <form class="form-horizontal" role="form" method="GET" action="index.php?">
                <h3>Simplexe en PHP</h3>
                <hr/>
                
                <div class="form-group">
                    <label>Méthode</label>
                    <select class="form-control">
                        <option selected="" value="maximiser">Maximiser</option>
                        <option disabled value="minimiser">Minimiser</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nbreVariable">Définir le nombre de variables :</label>
                    <input type="text" name="nbreVariable" id="nbreVariable" class="form-control" placeholder="Veuillez indiquer le nombre de variable"/>
                </div>
                <div class="form-group">
                    <label for="nbreContrainte">Définir le nombre de contraintes :</label>
                    <input type="text" name="nbreContrainte" id="nbreContrainte" class="form-control" placeholder="Veuillez indiquer le nombre de contrainte"/>
                </div>
                <button type="submit" class="btn btn-default">Continuer</button>             
            </form>
</div>