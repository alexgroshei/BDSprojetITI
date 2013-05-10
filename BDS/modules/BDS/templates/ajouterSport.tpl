<h1 class="apptitle">{$TITLE}</h1>

<div class="block">
    <h2 id="titleForm">{$SUBTITLE}</h2>
    <div class="blockcontent">
        {formfull $FORMAJOUTSPORT, 'BDS~saveSportToDao@classic'}
    </div>
</div>

<div class="block" id="navigation">
    <h2>{$SUBTITLE2}</h2>
    <div class="blockcontent">
        <a href={jurl 'BDS~choixDuSport@classic'}>Retour</a><br>
        <a href={jurl 'BDS~deconnexion@classic'}>Se déconnecter</a>
    </div>
</div>