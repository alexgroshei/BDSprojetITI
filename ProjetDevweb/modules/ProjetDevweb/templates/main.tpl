<h1 class="apptitle">
    {$TITLE}
</h1>

<div class="block">
    <h2>
        {$SUBTITLE}
    </h2>
    <div class="blockcontent">
        <ul>
            {foreach $ALLMEDECIN as $COURANTMEDECIN}
                <li>
                    {$COURANTMEDECIN->nom} {$COURANTMEDECIN->prenom} 
                    <div class="liens">
                        <a href="{jurl 'ProjetDevweb~updateData@classic', array('medecin_id'=>$COURANTMEDECIN->medecin_id)}">
                            Modifier
                        </a>
                        <a id="supprimer" href="{jurl 'ProjetDevweb~deleteData@classic', array('medecin_id'=>$COURANTMEDECIN->medecin_id)}" 
                           onclick="return confirmDelete()">
                            Supprimer
                        </a>
                    </div>
                </li>
            {/foreach}
        </ul>
        <div id="logo">
            <img src="{$j_basepath}image/logo.jpg"/>
        </div>
    </div>

    <h2>
        {$SUBTITLE2}
    </h2>
    <div class="blockcontent">
        <ul>
            {foreach $ALLSPE as $COURANTSPE}
                <li>{$COURANTSPE->medecinNom} : {$COURANTSPE->nomSpecialite}</li>
            {/foreach}
        </ul>
    </div>

</div>

