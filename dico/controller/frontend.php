<?php
session_start();

require('model/frontend/connexion.php');



// function listPosts()
// { 
  
//     require('view/frontend/index1.php');    
// }
function concept(){
    require('view/frontend/index2.php');
}
function boiteAmots($id){
   $motsAmoiMeme=mesMotsaMoiMR($id);
   $motsAmoiMemeMP=mesMotsaMoiMP($id);
   $motsAmoiMemeAP=mesMotsaMoiAP($id);
   header('location:index.php?action=page&amp;id='.$userinfo['id']);
    require('view/frontend/index6.php');
}
function boiteAmotsSeule(){
   if(isset($_POST['submitMot'])){
      $erreur="Veuillez vous connecter pour enregistrer dans la boîte à mots !";
      header('location:index.php');
   }

   require('view/frontend/index1.php');
}
function menuConnexion(){
    require('view/frontend/index4.php');
}
function subscribe2(){
    if(isset($_POST['submit'])){
    
        $email = htmlspecialchars($_POST['email']);
        $mdp1=$_POST['mdp1'];
        $mdp2=$_POST['mdp2']; 
        $pseudo=htmlspecialchars($_POST['pseudo']); 
        $token="";
    
        if(!empty($_POST['email']) AND !empty($_POST['mdp1']) AND !empty($_POST['mdp2']) AND !empty($_POST['pseudo'])) {  
         $pseudolength = strlen($pseudo);
         if($pseudolength <= 255) {
                 if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mailexist=subscribe($email);
                    if($mailexist == 0) {
                       if($mdp1 == $mdp2) {
                         $mdp1= password_hash($_POST['mdp1'], PASSWORD_DEFAULT);
                         $mdp2 = password_hash($_POST['mdp2'], PASSWORD_DEFAULT);
                         $mailconnect =htmlspecialchars($_POST['email']) ;   
                         $insertmbr=member($email,$mdp1,$pseudo,$token);   
                        //   $userinfo=usersInfo($mailconnect);   
                        //   $_SESSION['email']=$userinfo['email']; 
                        //   $_SESSION['pseudo']=$userinfo['pseudo'];            
                          $erreur = "Votre compte a bien été créé !";
                       } else {
                          $erreur = "Vos mots de passe ne correspondent pas !";
                       }
                    } else {
                       $erreur = "Adresse mail déjà utilisée !";
                    }
                 } else {
                    $erreur = "Votre adresse mail n'est pas valide !";
                 }              
           
        } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }

}   
    require('view/frontend/index4.php'); 
}
function connexion()
{
   if(isset($_POST['submit2'])){
      $mailconnect =htmlspecialchars($_POST['email']) ;   
      $mdpconnect=htmlspecialchars($_POST['mdp1']);
    
        if(isset($mailconnect) AND !empty($mdpconnect)) {         
         $userexist=mailConnex($mailconnect);
                        
          
                 if($userexist == 1) {     
                  $userinfo=usersInfo($mailconnect);
                  if(password_verify($mdpconnect,$userinfo['mdp1'])){       
                   
                     $_SESSION['mdp1']=$userinfo['mdp1']; 
                     $_SESSION['email']=$userinfo['email']; 
                     $_SESSION['pseudo']=$userinfo['pseudo']; 
                     $_SESSION['id']=$userinfo['id']; 
                     $_SESSION ['users']= $mailconnect;          
                     header('location:index.php');
          
                
                  }  
                 
                  else{
                      $erreur = "Mauvais mail ou mot de passe !";
                     
                   
                  } 
                                
      
               } else {
                 $erreur = "Mauvais mail ou mot de passe !";
                
                   }
           
           
   } else {
    $erreur = "Tous les champs doivent être complétés !";
  
   
   }
   //   header('location:index.php?action=page&amp;id='.$userinfo['id']);
}    

   require('view/frontend/index4.php');   
}
function token(){
   if(isset($_POST['email'])){
      $token=uniqid();
      $url="http://localhost/dico/index.php?action=nouveauMdp&token=$token";
      $message="Bonjour, voici votre lien pour la réinitialisation de votre mot de passe:".$url;
      $headers='Content-Type:text/plain;charset="utf-8"'." ";
      if(mail($_POST['email'],'Mot de passe oublié',$message,$headers)){
                     miseAjourToken($token,$_POST['email']);
                
      }else{
         echo"Une erreur est survenue !";
      }
  }

   require('view/frontend/index4.php');
}
function changeMdp($token){
   
   if(isset($_GET['token']) && $_GET['token']!=""){
      $reqMail=verificationToken($token);   
    if($reqMail==1){
if(isset($_POST['submit4'])){
   $email = htmlspecialchars($_POST['email']);
   $mdp1=$_POST['mdp1'];
   $token=$_GET['token'];
   if(isset($_POST['email'])  && isset($_POST['mdp1']) ){
   
      $mdp1= password_hash($_POST['mdp1'], PASSWORD_DEFAULT);
      nouveauMdp($mdp1,$email);
   }else{
      $erreur="Tous les champs doivent être remplis !";
   }
  
}
    }
   
   }   
   require('view/frontend/index5.php');
}

function pagePrincipale($id){

   if(isset($_POST['submitMot'])&& isset($_SESSION['id'])){
      $mot=htmlspecialchars($_POST['mot']);
      $definition=htmlspecialchars($_POST['def']);
      $typeBoite=$_POST['typeBoite'];    
      $user_id=$_SESSION['id'];
      $insertmot=recupererMot($mot,$definition,$user_id,$typeBoite);      

      }
  
      $motsAmoiMeme=mesMotsaMoiMR($id);  
      $motsAmoiMemeMP=mesMotsaMoiMP($id);
      $motsAmoiMemeAP=mesMotsaMoiAP($id);
  require('view/frontend/index6.php');
}
function supprimer($id){
 
      $motsAmoiMeme=mesMotsaMoiMR($id);
      $motsAmoiMemeMP=mesMotsaMoiMP($id);
      $motsAmoiMemeAP=mesMotsaMoiAP($id);
      supprimeTonMot($id);
      header('location:index.php');
 
      require('view/frontend/index6.php');
}