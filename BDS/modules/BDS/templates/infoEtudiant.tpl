<h1 class="apptitle">{$TITLE}</h1>

<div class="block">
    <h2>{$SUBTITLE}</h2>
    <div class="blockcontent">
        {foreach $ETUDIANT as $COURANTETUDIANT}
            <li>Nom : {$COURANTETUDIANT->nom}</li>
            <li>Prenom : {$COURANTETUDIANT->prenom}</li>
            <li>Classe : {$COURANTETUDIANT->classe}</li>
            <li>Telephone : {$COURANTETUDIANT->tel}</li>
            <li>Voiture ? {$COURANTETUDIANT->possede_voiture}</li>
            <li>Numero licence BDS : {$COURANTETUDIANT->num_licence}</li>
            <li>Date de remise du certificat medical : {$COURANTETUDIANT->date_remise_certif}</li>
            <li>Date de remise de la cotisation au BDS : {$COURANTETUDIANT->date_remise_cotis}</li>
            <li>Adresse mail : {$COURANTETUDIANT->login}</li>
        {/foreach}
    </div>
</div>

<div class="block">
    <h2>{$SUBTITLE2}</h2>
    <div class="blockcontent">
        <a href={jurl 'BDS~choixDuSport@classic'}>Retour Choix du sport</a> <br>
        <a href={jurl 'BDS~deconnexion@classic'}>Se déconnecter</a>
    </div>
</div>