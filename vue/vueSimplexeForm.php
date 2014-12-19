<hr>
<form class="form-inline" role="form" method="POST" action="index.php">
    
    <!-- Génére le formulaire de la fonction économique Max[Z] -->
    <span><strong>Max[Z] = </strong></span>
    <?php foreach ($variable as $variables) : ?>
    <div class="form-group">        
        <input type="text" name="X<?= $variables ?>" class="form-control" id="X<?= $variables ?>" placeholder="Variable">
        <label for="X<?= $variables ?>">X<small><?=$variables ?></small></label>
    </div>
    <?php if($variables != count($variable))   : ?>
        <span> + </span>
    <?php endif;?>
   <?php endforeach; ?>
        
    <!-- génère le formulaire des inéquation -->
    <br>
    <br>
    <h4>Contraintes</h4>
    <?php foreach ($contrainte as $contraintes) :?>
        <?php foreach ($variable as $variables) : ?>
           <div class="form-group">        
                <input type="text" name="C<?= $contraintes ?>X<?= $variables ?>" class="form-control" id="X<?= $variables ?>" placeholder="Variable">
                <label for="X<?= $variables ?>">X<small><?=$variables ?></small></label>
           </div>
           <?php if($variables != count($variable))   : ?>
        <span> + </span>
    <?php endif;?>
        <?php endforeach; ?>
    <select>
        <option>&le;</option>
        <option disabled>&ge;</option>
        <option disabled>=</option>
    </select>
    <input type="text" name="C<?= $contraintes ?>" class="form-control" id="contrainte<?= $contraintes ?>" placeholder="Contrainte">
    <br><br>
    <?php endforeach; ?>
    
    <!-- ObjectForm pour transmettre l'objet $form avec la serialisation -->
    <input type="hidden" name="NbVariable" value="<?php echo $form->getNbVariable(); ?>" >
    <input type="hidden" name="NbContrainte" value="<?php echo $form->getNbContrainte() ?>" >
     
    <button type="submit" class="btn btn-primary">Calculer</button>
        
</form>


