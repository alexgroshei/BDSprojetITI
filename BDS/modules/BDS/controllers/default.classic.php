<?php

/**
 * @package   BDS
 * @subpackage BDS
 * @author    GROS Alexandre - FILLIETTE Florent
 * @copyright 2013 GROS Alexandre - FILLIETTE Florent
 * @license    All rights reserved
 */
class defaultCtrl extends jController {

    // Fonctions permettant d'empecher les connexions intempestives
    public $pluginParams = array(
        '*' => array('auth.required' => false),
        'choixDuSport' => array('auth.required' => true),
        'generateProfile' => array('auth.required' => true),
        'addEtudiant' => array('auth.required' => true),
        'addEtudiantToDao' => array('auth.required' => true),
        'updateEtudiant' => array('auth.required' => true),
        'saveEtudiant' => array('auth.required' => true),
        'deleteEtudiant' => array('auth.required' => true),
        'updateComment' => array('auth.required' => true),
        'saveCommentaire' => array('auth.required' => true),
        'addSport' => array('auth.required' => true),
        'saveSportToDao' => array('auth.required' => true),
        'ajouterAbsence' => array('auth.required' => true),
        'saveAbsenceToDao' => array('auth.required' => true),
        'afficherInfo' => array('auth.required' => true),
        'afficherAbs' => array('auth.required' => true),
    );

    function index() {

        jAuth::logout();

        $rep = $this->getResponse('html');

        /* @var $rep JResponseHtml */

// pour la vue
        $rep->bodyTpl = "main";

// CSS
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');
        $rep->addCSSLink('http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css');

// jQuery et jQuery UI
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');

// Formulaire
        $connexionForm = jForms::create("BDS~connexionEtudiant");

// Valeur des zones définies
        $rep->body->assign('TITLE', 'Bienvenue sur la page de gestion d absences du Bureau Des Sports HEI');
        $rep->body->assign('SUBTITLE', 'Connexion');
        $rep->body->assign('FORMETUDIANT', $connexionForm);

        return $rep;
    }

    function connexion() {

// Connexion
        $login = $this->param('login');
        $password = $this->param('password');
        jAuth::login($login, $password, true);

        if (jAuth::isConnected()) {
            return $this->choixDuSport();
        }
        else
            return $this->ErreurConnexion();
    }
    
    function ErreurConnexion() {
        
        jAuth::logout();

        $rep = $this->getResponse('html');

        /* @var $rep JResponseHtml */

// pour la vue
        $rep->bodyTpl = "erreurConnexion";

// CSS
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');
        $rep->addCSSLink('http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css');

// jQuery et jQuery UI
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');

// Formulaire
        $connexionForm = jForms::create("BDS~connexionEtudiant");

// Valeur des zones définies
        $rep->body->assign('TITLE', 'Bienvenue sur la page de gestion d absences du Bureau Des Sports HEI');
        $rep->body->assign('SUBTITLE', 'Connexion');
        $rep->body->assign('FORMETUDIANT', $connexionForm);
        $rep->body->assign('ERREUR', 'Identifiants incorrects');

        return $rep;
        
    }

    function deconnexion() {
        jAuth::logout();
        return $this->index();
    }

    function choixDuSport() {
        $rep = $this->getResponse('html');

        /* @var $rep JResponseHtml */

// pour la vue
        $rep->bodyTpl = "choixSport";

// CSS
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        $choixSportForm = jForms::create("BDS~choixSportForm");

// liste vers vue
        $rep->body->assign('TITLE', 'Choix du sport');
        $rep->body->assign('SUBTITLE', 'Veuillez choisir votre sport');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('FORMCHOIXSPORT', $choixSportForm);

        return $rep;
    }

    function generateProfile() {
        $rep = $this->getResponse('html');

        /* @var $rep JResponseHtml */

        $rep->bodyTpl = "pageProfil";

        //CSS
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        //JS
        $rep->addCssLink('http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css');
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
        $rep->addJSLink(jApp::config()->urlengine['basePath'] . 'js/mes_scripts.js');

// Factory sport
        $sportFactory = jDao::get("sport");
        $idSportChoisi = $this->param('id_sport');

// Factory appartenir_eq
        $appartenirEqFactory = jDao::get("appartenir_eq");

// Conditions pour commentaire et nom du sport
        $conditions = jDao::createConditions();
        $conditions->addCondition('id_sport', '=', $idSportChoisi);
        $sport = $sportFactory->findBy($conditions);

        // Cond pour affichage étudiants par sport
        $etudiantParSport = $appartenirEqFactory->findBy($conditions);

        // Compteur d'élèves
        $countEtudiant = $appartenirEqFactory->countBy($conditions);

        $rep->body->assign('TITLE', 'Bienvenue sur la page ');
        $rep->body->assign('SUBTITLE1', 'Etudiants - Equipes');
        $rep->body->assign('SUBTITLE2', 'Commentaires sur ');
        $rep->body->assign('SUBTITLE3', 'Administration');
        $rep->body->assign('SUBTITLE4', 'Absences');
        $rep->body->assign('SUBTITLE5', 'Navigation');
        $rep->body->assign('SPORT', $sport);
        $rep->body->assign('LISTETUDIANTSPORT', $etudiantParSport);
        $rep->body->assign('COMPTEUR', $countEtudiant);

        return $rep;
    }

    function addEtudiant() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "ajouterEtudiant";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        $sportChoisi = $this->param('id_sport');

//formulaire pour ajouter Etudiant initialisé pour le sport actuel
        $addStudentForm = jForms::create("BDS~ajoutEtudiant", $sportChoisi);
        $addStudentForm->initFromDao("BDS~sport");

// valeur des zones définies
        $rep->body->assign('TITLE', 'Ajouter un etudiant au sport');
        $rep->body->assign('SUBTITLE', 'Remplir le forumlaire ci-dessous pour ajouter un etudiant');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('FORMULAIREAJOUT', $addStudentForm);

        return $rep;
    }

    function addEtudiantToDao() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "ajouterEtudiant";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        $idSport = $this->param('id_sport');
        $numEquipe = $this->param('num_equipe');

        $addStudentForm = jForms::fill("BDS~ajoutEtudiant", $idSport);
        $addStudentForm->initFromRequest();

        $result = $addStudentForm->prepareDaoFromControls('BDS~etudiant');
        $etudiantFactory = $result['dao'];
        $courantEtudiant = $result['daorec'];

        $etudiantFactory->insert($courantEtudiant);

        $appartenirEqFactory = jDao::get("appartenir_eq");
        $record = $etudiantFactory->getFewRecord();
        $courantEtudiant->id_etudiant = $record->id_etudiant;

        $appartenirEqFactory->insert($courantEtudiant);

        $courantEtudiant->num_equipe = $numEquipe;
        $courantEtudiant->id_sport = $idSport;

        $appartenirEqFactory->update($courantEtudiant);

        return $this->choixDuSport();
    }

    function updateEtudiant() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "modifierEtudiant";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        $paramIdStudent = $this->param('id_etudiant');
        $updateStudentForm = jForms::create("BDS~modifEtudiant", $paramIdStudent);
        $updateStudentForm->initFromDao("BDS~etudiant");

        $rep->body->assign('TITLE', 'Modifier un etudiant');
        $rep->body->assign('SUBTITLE', 'Modifier le forumlaire ci-dessous');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('FORMULAIREUPDATE', $updateStudentForm);

        return $rep;
    }

    function saveEtudiant() {

        $updateStudentForm = jForms::fill("BDS~modifEtudiant", $this->param('id_etudiant'));
        $updateStudentForm->initFromRequest();
        $result = $updateStudentForm->prepareDaoFromControls('BDS~etudiant');

        $etudiantFactory = $result['dao'];
        $courantEtudiant = $result['daorec'];
        $etudiantFactory->update($courantEtudiant);

        return $this->choixDuSport();
    }

    function deleteEtudiant() {

        $paramIdEtudiant = $this->param('id_etudiant');

        $etudiantFactory = jDao::get("etudiant");
        $etudiantFactory->delete($paramIdEtudiant);

        return $this->choixDuSport();
    }

    function updateComment() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "ajouterCommentaire";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

//formulaire pour ajouter Etudiant 
        $sportChoisi = $this->param('id_sport');
        $addCommentaryForm = jForms::create("BDS~ajoutCommentaire", $sportChoisi);
        $addCommentaryForm->initFromDao("BDS~sport");

// valeur des zones définies
        $rep->body->assign('TITLE', 'Ajouter un commentaire au sport');
        $rep->body->assign('SUBTITLE', 'Remplir le forumlaire ci-dessous pour ajouter un commentaire');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('FORMAJOUTCOMM', $addCommentaryForm);

        return $rep;
    }

    function saveCommentaire() {

        $sportChoisi = $this->param('id_sport');

        $form = jForms::fill("BDS~ajoutCommentaire", $sportChoisi);
        $form->initFromRequest();

        $result = $form->prepareDaoFromControls('BDS~sport');
        $sportFactory = $result['dao'];
        $courantComm = $result['daorec'];

        $sportFactory->update($courantComm);

        return $this->choixDuSport();
    }

    function addSport() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "ajouterSport";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

//formulaire pour ajouter Etudiant 
        $addSportForm = jForms::create("BDS~ajoutSport");

// valeur des zones définies
        $rep->body->assign('TITLE', 'Ajouter un sport');
        $rep->body->assign('SUBTITLE', 'Remplir le forumlaire ci-dessous pour ajouter un sport');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('FORMAJOUTSPORT', $addSportForm);

        return $rep;
    }

    function saveSportToDao() {

        $sportFactory = jDao::get("BDS~sport");
        $record = jDao::createRecord("BDS~sport");

//$record->id_sport = $this->param('id_sport');
        $record->nom_sport = $this->param('nom_sport');
        $record->commentaire = $this->param('commentaire');

        $sportFactory->insert($record);

        return $this->choixDuSport();
    }

    function ajouterAbsence() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "ajoutAbs";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        // formulaire absences
        $paramIdStudent = $this->param('id_etudiant');
        $absencesForm = jForms::create("BDS~formAbs", $paramIdStudent);
        $absencesForm->initFromDao("BDS~etudiant");

        // valeur des zones définies
        $rep->body->assign('TITLE', 'Ajouter une absence');
        $rep->body->assign('SUBTITLE', 'Remplir le forumlaire ci-dessous pour ajouter une absence');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('FORMAJOUTABS', $absencesForm);

        return $rep;
    }

    function saveAbsenceToDao() {

        $idEtudiant = $this->param('id_etudiant');

        $absForm = jForms::fill("BDS~formAbs", $idEtudiant);
        $absForm->initFromRequest();

        $result = $absForm->prepareDaoFromControls('BDS~absence');
        $absFactory = $result['dao'];
        $courantAbs = $result['daorec'];

        $absFactory->insert($courantAbs);

        $courantAbs->id_etudiant = $idEtudiant;
        $absFactory->update($courantAbs);

        return $this->choixDuSport();
    }

    function afficherInfo() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "infoEtudiant";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        // Factory etudiant
        $etudiantFactory = jDao::get('BDS~etudiant');
        $etudiant = $this->param('id_etudiant');
        $conditions = jDao::createConditions();
        $conditions->addCondition('id_etudiant', '=', $etudiant);
        $infoEtudiant = $etudiantFactory->findBy($conditions);

        $rep->body->assign('TITLE', 'Informations personnelles');
        $rep->body->assign('SUBTITLE', 'Voici quelques informations personnelles');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('ETUDIANT', $infoEtudiant);

        return $rep;
    }

    function afficherAbs() {

        $rep = $this->getResponse('html');

        /* @var $rep jResponseHtml */

        $rep->bodyTpl = "absencesEtudiant";

// thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'] . 'design/';
        $rep->addCSSLink($chemin . 'jelix.css');

        // Factory absences
        $absFactory = jDao::get('BDS~absence');
        $idEtudiant = $this->param('id_etudiant');
        $conditions = jDao::createConditions();
        $conditions->addCondition('id_etudiant', '=', $idEtudiant);
        $absEtudiant = $absFactory->findBy($conditions);
        $countEtudiant = $absFactory->countBy($conditions);

        $rep->body->assign('TITLE', 'Absences etudiant');
        $rep->body->assign('SUBTITLE', 'Liste des absences');
        $rep->body->assign('SUBTITLE2', 'Navigation');
        $rep->body->assign('ABSENCES', $absEtudiant);
        $rep->body->assign('COMPTEURABS', $countEtudiant);

        return $rep;
    }

}