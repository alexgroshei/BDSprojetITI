<h1 class="apptitle">{$TITLE}</h1>

<div class="block">
    <h2>{$SUBTITLE}</h2>
    <div class="blockcontent">

        {formfull $FORMCHOIXSPORT, 'BDS~generateProfile@classic'}

        <a href="{jurl 'BDS~addSport@classic'}">
            <input type="button" value="Ajouter un sport">
        </a>

    </div>
</div>

<div class="block">
    <h2>{$SUBTITLE2}</h2>
    <div class="blockcontent">
        <a href={jurl 'BDS~deconnexion@classic'}>Se déconnecter</a>
    </div>
</div>