<h1 class="apptitle">{$TITLE}</h1>

<div class="block">
    <h2>{$SUBTITLE}</h2>
    <div class="blockcontent">
        L'etudiant a {$COMPTEURABS} absence(s).<br><br>
        {foreach $ABSENCES as $COURANTABS}
            <li>
                Date : {$COURANTABS->date_abs} - 
                Excusee : {$COURANTABS->excusee} - 
                Justifiee : {$COURANTABS->justificatif}
            </li>  
        {/foreach}
    </div>
</div>

<div class="block" id="navigation">
    <h2>{$SUBTITLE2}</h2>
    <div class="blockcontent">
        <a href={jurl 'BDS~choixDuSport@classic'}>Retour Choix du sport</a> <br>
        <a href={jurl 'BDS~deconnexion@classic'}>Se déconnecter</a>
    </div>
</div>