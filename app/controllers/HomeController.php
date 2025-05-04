<?php
// Controller: HomeController.php
require_once '../app/models/Categorie.php';
require_once '../app/models/Rubrique.php';
require_once '../app/models/Article.php';
require_once '../app/models/Reponse.php';
require_once '../app/models/User.php';
require_once 'BaseController.php';

class HomeController extends BaseController
{
    public function index()
    {
        $categorieModel = new Categorie($this->pdo);
        $rubriqueModel = new Rubrique($this->pdo);
        $articleModel = new Article($this->pdo);
        $reponseModel = new Reponse($this->pdo);
        $userModel = new User($this->pdo);

        $categories = $categorieModel->getAllCat();

        foreach ($categories as &$cat) {
            $cat['rubriques'] = $rubriqueModel->getRubByCat($cat['idCat']);

            foreach ($cat['rubriques'] as &$rub) {
                $rub['nbArticles'] = $articleModel->countByRubrique($rub['idRub']);
                $rub['nbReponses'] = $reponseModel->countByRubrique($rub['idRub']);

                $lastArticle = $articleModel->getLastByRubrique($rub['idRub']);
                $lastReponse = $reponseModel->getLastByRubrique($rub['idRub']);

                $idMembArt = $lastArticle['idMemb'];
                $userArt = $userModel->getUserById($idMembArt);
                $prenomArt = $userArt['prenomMemb'];
                $typeMembArt = $userArt['typeMemb'];

                $idMembRep = $lastReponse['idMemb'];
                $userRep = $userModel->getUserById($idMembRep);
                $prenomRep = $userRep['prenomMemb'];
                $typeMembRep = $userRep['typeMemb'];

                $rub['latest'] = $lastArticle['dateArt'] > $lastReponse['dateRep'] ? [
                    'prenom' => $prenomArt,
                    'titre' => $lastArticle['titreArt'],
                    'idArt' => $lastArticle['idArt'],
                    'date' => $lastArticle['dateArt'],
                    'typeMemb' => $typeMembArt
                ] : [
                    'prenom' => $prenomRep,
                    'titre' => $lastReponse['titreArt'],
                    'idArt' => $lastReponse['idArt'],
                    'date' => $lastReponse['dateRep'],
                    'typeMemb' => $typeMembRep
                ];
            }
        }

        require_once '../app/views/home.php';
    }
}
