<?php
if(isset($_POST['email'])){
    $token=uniqid();
    $url="http://localhost/dico/index.php?action=connexion&token=".$token;
    $message="Bonjour, voici votre lien pour la réinitialisation de votre mot de passe:$url";
    $headers='Content-Type:text/plain;charset="utf-8"'." ";
    if(mail($_POST['email'],'Mot de passe oublié',$message,$headers))
}