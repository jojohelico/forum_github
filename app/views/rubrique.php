<?php
 include("layout/header.php"); 
 ?>

<script>
function AffDiv() {
  let d1 = document.getElementById("AjoutArticle");
  d1.style.display = d1.style.display === "block" ? "none" : "block";
}
</script>

<div class="man"><span class="p1a"><?= htmlspecialchars($rubrique['nomRub']) ?></span></div>

<?php foreach ($articles as $article): ?>
  <h4>
    <table width="100%">
      <tr>
        <td width="65%">
          <a href="<?= base_url('/article/show?id=' . $article['idArt']) ?>" class="p1c"><?= htmlspecialchars($article['titreArt']) ?></a>
        </td>
        <td width="10%"><?= $article['nbMessages'] ?><br>Messages</td>
        <td width="5%"><span class="avatar"><?= strtoupper($article['prenomMemb'][0]) ?></span></td>
        <td width="10%">
          Par <span class="<?= $article['typeMemb'] == 0 ? 'administrateur' : ($article['typeMemb'] == 1 ? 'moderateur' : 'utilisateur') ?>">
            <?= htmlspecialchars($article['prenomMemb']) ?>
          </span><br><?= calculate_time_span($article['dateArt']) ?>
        </td>
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] != 2): ?>
          <td width="10%">
            <a href="<?= base_url('/rubrique/supprimer?Rub=' . $article['idRub'] . '&Article=' . $article['idArt']) ?>"
            onclick="return confirm('CONFIRMATION DE SUPPRESSION\n\nÊtes-vous sûr ?')">
              <img src="<?php echo base_url('/images/supprimer.jpg'); ?>" width="50">
            </a>
          </td>
        <?php endif; ?>
      </tr>
    </table>
  </h4>
<?php endforeach; ?>

<?php if (isset($_SESSION['idMemb'])): ?>
  <button class="buttonStatut gris" id="btnAjouter" onclick="AffDiv()">Ajouter un article</button><br>
  <div id="AjoutArticle" style="display: none;">
    <form method="post" action="<?= base_url('/rubrique/create?Rub=' .  $rubrique['idRub']) ?>">
      <fieldset class="ajouterArt">
        <legend>Ajouter un article</legend>
        <label for="Art">Titre de l'article :</label><br>
        <input type="text" name="Art" id="Art" required><br><br>
        <label for="contenuArt">Contenu :</label><br>
        <textarea name="contenuArt" id="contenuArt" rows="10" cols="50" required></textarea><br>
        <input class="envoyerArt" type="submit" value="Ajouter" name="ajouter">
      </fieldset>
    </form>
  </div>
<?php endif; ?>

<?php
 include("layout/footer.php"); 
 ?>
