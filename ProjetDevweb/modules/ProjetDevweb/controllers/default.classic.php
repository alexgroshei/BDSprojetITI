<?php
/**
* @package   ProjetDevweb
* @subpackage ProjetDevweb
* @author    your name
* @copyright 2011 your name
* @link      http://www.yourwebsite.undefined
* @license    All rights reserved
*/

class defaultCtrl extends jController {
    
    function index() {
        $rep = $this->getResponse('html');
        
        /* @var $rep jResponseHtml */
        
        $rep->bodyTpl = "main";
        
        // thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'].'design/';
        $rep->addCSSLink($chemin.'jelix.css');
        $rep->addCSSLink(jApp::config()->urlengine['basePath'].'css/mes_styles.css');
        
        // Pour le JS
        $rep->addCssLink('http://code.jquery.com/ui/1.8.24/themes/base/jquery-ui.css');
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js');
        $rep->addJSLink('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
        $rep->addJSLink(jApp::config()->urlengine['basePath'].'js/mes_scripts.js');
        
        
        $medecinFactory = jDao::get("medecin");
        $listOfAllMedecin = $medecinFactory->findAll();
        $rep->body->assign('ALLMEDECIN', $listOfAllMedecin);
        
        $speFactory = jDao::get("possede_spe");
        $listOfAllSpe = $speFactory->findAll();
        $rep->body->assign('ALLSPE', $listOfAllSpe);        
        
        
        // valeur des zones définies
        $rep->body->assign('TITLE', 'Bienvenue sur la page de mon projet de Developpement Web');
        $rep->body->assign('SUBTITLE', 'Voici les différents noms de médecins à contacter');
        $rep->body->assign('SUBTITLE2', 'Voici les différentes spécialités des médecins présents');
        
                                
        return $rep;
    }
    
    function updateData() {
        
        $rep = $this->getResponse('html');
        
        /* @var $rep jResponseHtml */
        
        $rep->bodyTpl = "data";
        
        // thème CSS jelix
        $chemin = jApp::config()->urlengine['jelixWWWPath'].'design/';
        $rep->addCSSLink($chemin.'jelix.css');
        $rep->addCSSLink(jApp::config()->urlengine['basePath'].'css/mes_styles.css');
        
        //formulaire pour modifier medecin
        $paramIdMedecin = $this->param('medecin_id', 0);
        $medecinForm = jForms::create("ProjetDevweb~medecin", $paramIdMedecin);
        $medecinForm->initFromDao("ProjetDevweb~medecin");
        $rep->body->assign('FORMULAIRE', $medecinForm);
        
        // valeur des zones définies
        $rep->body->assign('TITLE', 'Modifier les données selectionnées');
        $rep->body->assign('SUBTITLE', 'Remplir le forumlaire ci-dessous pour modifier les coordonnées du medecin');
        
        return $rep;
                
    }
    
    function saveMyData() {
        
        // $rep->addCSSLink(jApp::config()->urlengine['basePath'].'css/mes_styles.css');
                        
        $medecinForm = jForms::fill("ProjetDevweb~medecin", $this->param('medecin_id'));
        $medecinForm->initFromRequest();
        if($medecinForm->check()) {
            $result = $medecinForm->prepareDaoFromControls('ProjetDevweb~medecin');
            
            $medecinFactory = $result['dao'];
            $courantMedecin = $result['daorec'];
            $medecinFactory->update($courantMedecin);
        }
        
        return $this->index();
        
    }
    
    function deleteData() {
        
       // $rep->addCSSLink(jApp::config()->urlengine['basePath'].'css/mes_styles.css');
        
        $paramIdMedecin = $this->param('medecin_id');
        
        $medecinFactory = jDao::get("medecin");
        $medecinFactory->delete($paramIdMedecin);
        
        return $this->index();
    }
    
}
