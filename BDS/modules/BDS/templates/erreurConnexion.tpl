<h1 class="apptitle">{$TITLE}</h1>

<div class="block" id="formConnexion">

    <h2 id="titleForm">{$SUBTITLE}</h2>

    <div class="blockcontent">
        <p id="erreurConnexion">{$ERREUR}</p>
        {formfull $FORMETUDIANT, 'BDS~connexion@classic'}
    </div>

</div>

<div class="block" id="description">

    <h2 id="titleForm">{$SUBTITLE2}</h2>

    <div class="blockcontent">
        Bienvenue sur le site web de gestion d'absences du Bureau des Sports d'HEI. <br>
        Merci de vous connecter avec votre login (adresse e-mail HEI) et mot de passe 
        via le formulaire présent sur cette page.<br>
        Si vous ne vous rappelez pas de vos identifiants, merci de contacter un membre de BDS.
    </div>

</div>

<div id="logo">
    <a href="http://www.bds-hei.com/"><img src="{$j_basepath}image/logobds.jpg"/></a>
</div>