<h1 class="apptitle">{$TITLE}</h1>

<div class="block">
    <h2>{$SUBTITLE}</h2>
    <div class="blockcontent">

        {formfull $FORMCHOIXSPORT, 'BDS~generateProfile@classic'}

    </div>
</div>

<div class="block" id="navigation">
    <h2>{$SUBTITLE2}</h2>
    <div class="blockcontent">
        <a href={jurl 'BDS~deconnexion@classic'}>Se déconnecter</a>
    </div>
</div>