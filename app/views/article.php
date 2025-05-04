<?php include("layout/header.php"); ?>

<script>
function AffDiv() {
  let d1 = document.getElementById("AjoutArticle");
  d1.style.display = d1.style.display === "block" ? "none" : "block";
}
</script>

<div class="h41">
  <table width="100%">
    <tr>
      <td width="5%"><span class="avatar"><?= strtoupper($article['prenomMemb'][0]) ?></span></td>
      <td width="10%">
        Par <span class="<?= $article['typeMemb'] == 0 ? 'administrateur' : ($article['typeMemb'] == 1 ? 'moderateur' : 'utilisateur') ?>">
          <?= htmlspecialchars($article['prenomMemb']) ?>
        </span><br>
        Il y a <?= calculate_time_span($article['dateArt']) ?>.
      </td>
      <td width="85%">
        <span class="p1a p1" style="font-size:20px"><?= htmlspecialchars($article['titreArt']) ?></span><br><br>
        <span class="p1a p1"><?= htmlspecialchars($article['contenuArt']) ?></span>
      </td>
    </tr>
  </table>
</div>

<?php foreach ($reponses as $rep): ?>
  <h4>
    <table width="100%">
      <tr>
        <td width="5%"><span class="avatar"><?= strtoupper($rep['prenomMemb'][0]) ?></span></td>
        <td width="10%">
          Par <span class="<?= $rep['typeMemb'] == 0 ? 'administrateur' : ($rep['typeMemb'] == 1 ? 'moderateur' : 'utilisateur') ?>">
            <?= htmlspecialchars($rep['prenomMemb']) ?>
          </span><br>
          Il y a <?= calculate_time_span($rep['dateRep']) ?>.
        </td>
        <td width="<?= (isset($_SESSION['type']) && $_SESSION['type'] != 2) ? '80%' : '85%' ?>">
          <?= htmlspecialchars($rep['contenuRep']) ?>
        </td>
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] != 2): ?>
          <td width="5%">
            <a href="<?= base_url('/article/deleteRep?id=' . $rep['idRep'] . '&article=' . $article['idArt']) ?>"
               onclick="return confirm('Supprimer cette réponse ?');">
              <img src="<?= base_url('/images/supprimer.jpg') ?>" width="50">
            </a>
          </td>
        <?php endif; ?>
      </tr>
    </table>
  </h4>
<?php endforeach; ?>

<?php if (isset($_SESSION['idMemb'])): ?>
  <button class="buttonStatut gris" id="btnAjouter" onclick="AffDiv()">Ajouter une réponse</button>
  <div id="AjoutArticle" style="display: none;">
    <form method="post" action="<?= base_url('/article/createRep?id=' . $article['idArt']) ?>">
      <fieldset class="ajouterArt">
        <legend>Ajouter une réponse</legend>
        <label for="contenuRep">Contenu :</label><br>
        <textarea name="contenuRep" id="contenuRep" rows="10" cols="50" required></textarea><br>
        <input class="envoyerRep" type="submit" value="Ajouter" name="ajouter">
      </fieldset>
    </form>
  </div>
<?php endif; ?>

<?php include("layout/footer.php"); ?>
