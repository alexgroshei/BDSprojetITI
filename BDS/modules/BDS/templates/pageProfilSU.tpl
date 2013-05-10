<h1 class="apptitle">{$TITLE} {foreach $SPORT as $NOMSPORT} {$NOMSPORT->nom_sport} {/foreach}</h1>

<div class="block">
    <h2>{$SUBTITLE1}</h2>
    <div class="blockcontent">
        <ul>
            {$COMPTEUR} étudiant(s) présent(s) dans ce sport. <br><br><br>

            {foreach $LISTETUDIANTSPORT as $COURANTETUDIANTSPORT}

                <li>{$COURANTETUDIANTSPORT->nomEtudiant} 
                    {$COURANTETUDIANTSPORT->prenomEtudiant} 
                    - Equipe {$COURANTETUDIANTSPORT->num_equipe}<br>

                    <div id="liens">

                        <a href="{jurl 'BDS~afficherInfo@classic', array('id_etudiant'=>$COURANTETUDIANTSPORT->id_etudiant)}">
                            [Informations]
                        </a><br> 

                        <a href="{jurl 'BDS~afficherAbs@classic', array('id_etudiant'=>$COURANTETUDIANTSPORT->id_etudiant)}">
                            [Visualiser absences]
                        </a>
                            
                    </div>

                </li><br>
            {/foreach}

        </ul>
    </div>
</div>

<div class="block">
    <h2>{$SUBTITLE2} {foreach $SPORT as $NOMSPORT} {$NOMSPORT->nom_sport} {/foreach}</h2>
    <div class="blockcontent">       
        {foreach $SPORT as $COURANTCOMM}
            {$COURANTCOMM->commentaire}
        {/foreach}
    </div>
</div>

<div class="block" id="navigation">
    <h2>{$SUBTITLE5}</h2>
    <div class="blockcontent">
        <a href={jurl 'BDS~choixDuSportSU@classic'}>Retour Choix du sport</a> <br>
        <a href={jurl 'BDS~deconnexion@classic'}>Se déconnecter</a>
    </div>
</div>