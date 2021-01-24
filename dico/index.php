<?php
require('controller/frontend.php');
try {

    if (isset($_GET['action'])) {
    if ($_GET['action'] == 'concept') {
            concept();
        }
     if ($_GET['action'] == 'boite') {
//   if(isset($_SESSION['id'])){
//     boiteAmots($_SESSION['id']);
//   }else{
//       boiteAmotsSeule();
//   }          
         } 
            
        
    if ($_GET['action'] == 'menuConnexion') {
            menuConnexion();
        }
     if($_GET['action'] == 'subscribe')  {
            subscribe2();          
        }
        if($_GET['action'] == 'connexion')  {
          connexion();        
        }
        if($_GET['action'] == 'token')  {
            token();       
          }
        if($_GET['action']=='nouveauMdp'){
            changeMdp($_GET['token']);
        }
         if($_GET['action']=='page' && isset($_SESSION['id'])){
        pagePrincipale($_SESSION['id']);
         }
         if($_GET['action']=='supprimer'){
            supprimer($_GET['id']);
             }     
        
        
}else{
    if(isset($_SESSION['id'])){
        boiteAmots($_SESSION['id']);
      }else{
          boiteAmotsSeule();
      }          
 
 
}
}
        catch(Exception $e) { 
            echo 'Erreur : ' . $e->getMessage();
        }
    