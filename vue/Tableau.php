<h3>Résultat du simplexe <small> | intération <?php echo $simplex->getNbIteration();  ?></small></h3>
<p>
    <?php echo $simplex->toString(); ?>
</p>
<hr>
<table class="table table-bordered">
    <tr>
        <th>Matrice</th>
    <?php foreach ($noms as $nom): ?>
    
        <th><?= $nom ?></th> 
    
    <?php endforeach; ?>
        <th>Xi</th>
  </tr>
  <?php for($i = 0; $i < $simplex->getMatrice()->getNbLignes(); $i++): ?>
  <tr>
      <td><?php if ($i != ($simplex->getMatrice()->getNbLignes()-1)){echo '<strong>'. $simplex->getMatriceNomVariableBase()[$i] .'</strong>';}else{echo'<strong>&Delta;j</strong>';}?></td>
      <?php for($j = 0; $j < $simplex->getMatrice()->getNbColonnes(); $j++): ?>
      <td><?php echo $simplex->getValeurMatrice($simplex->getMatrice(),$i, $j) ?></td>
      <?php endfor; ?> 
  </tr>    
  <?php endfor; ?>
</table>





