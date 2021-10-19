<?php session_start(); ?>

<div style='display:flex; flex-direction:row; width:100%; background-color: #eee; justify-content:space-between; padding: 1em 0.5em 0 0.5em; margin-bottom: 3em'>
        <div>
            <a href='../vues/vue-liste-ateliers.php'>Liste Ateliers</a>
        </div>
        <div>
            <a href='../controleurs/ctrl-deconnecter.php'><button style="color:red">Se déconnecter</button></a>
            <p><?php 
                echo $_SESSION[ 'nom' ] ." ". $_SESSION[ 'prenom' ]; 
                if($_SESSION[ 'admin' ]){
                    echo " (Admin)";
                } 
            ?></p>
        </div>
</div>
