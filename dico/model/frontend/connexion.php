<?php

function subscribe($email)
{
    $db = dbConnect();
    $reqmail = $db->prepare("SELECT * FROM users WHERE email = ?");
    $reqmail->execute(array($email));
    $mailexist = $reqmail->rowCount();
    return $mailexist;
}
function member($email,$mdp1,$pseudo,$token)
{  
    $db = dbConnect();  
    $insertmbr = $db->prepare("INSERT INTO users(email, mdp1,pseudo,token) VALUES(?, ?,?,?)");
    $insertmbr->execute(array($email, $mdp1,$pseudo,$token));  
    return  $insertmbr; 
        
}
function mailConnex($mailconnect)
{   
    $db = dbConnect();
    $requser = $db->prepare("SELECT * FROM users WHERE email = ?");
    $requser->execute(array($mailconnect));    
    $userexist = $requser->rowCount();   
    return $userexist;   
    
} 
function usersInfo($mailconnect)
{
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM users WHERE email = ?");
    $req->execute(array($mailconnect));
    $userinfo = $req->fetch();
    return $userinfo;
} 
function miseAjourToken($token,$email){
    $db = dbConnect();
    $req = $db->prepare("UPDATE users SET token=?  WHERE email= ?");
    $reqToken=$req->execute(array($token,$email));
    return  $reqToken;

}
function  verificationToken($token){
    $db = dbConnect();
    $req = $db->prepare("SELECT email FROM users WHERE token = ?");
    $req->execute(array($token));
    $reqMail = $req->rowCount();  
    return $reqMail;
   
}
function nouveauMdp($mdp1,$email){
    $db = dbConnect();
    $req = $db->prepare('UPDATE users SET mdp1=?, token="" WHERE email= ?');
    $reqMdp1=$req->execute(array($mdp1,$email));
    return  $reqMdp1;

}
 function  recupererMot($mot,$definition,$user_id,$typeBoite){
     $db = dbConnect();
     $insertmot = $db->prepare("INSERT INTO mots(mot,def,user_id,typeBoite) VALUES(?, ?,?,?)");
     $insertmot->execute(array($mot,$definition,$user_id,$typeBoite));  
     return  $insertmot; 
 }
 function mesMotsaMoiMR($id){
    $db = dbConnect();
    $req=$db->prepare("SELECT* FROM users INNER JOIN mots ON users.id=mots.user_id WHERE users.id =?AND typeBoite='motRare' ORDER BY mots.id DESC");
    $req->execute(array($id));
    return $req;
 }
 function mesMotsaMoiMP($id){
    $db = dbConnect();
    $req=$db->prepare("SELECT* FROM users INNER JOIN mots ON users.id=mots.user_id WHERE users.id =?AND typeBoite='motPrefere' ORDER BY mots.id DESC");
    $req->execute(array($id));
    return $req;
 }
 function mesMotsaMoiAP($id){
    $db = dbConnect();
    $req=$db->prepare("SELECT* FROM users INNER JOIN mots ON users.id=mots.user_id WHERE users.id =?AND typeBoite='motApprendre' ORDER BY mots.id DESC");
    $req->execute(array($id));
    return $req;
 }
 function  supprimeTonMot($id){
    $db = dbConnect();
    $mot=$db->prepare('DELETE FROM mots WHERE id=?');
    $motSupp=$mot->execute(array($id));
    return $motSupp;
 }

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=dico;charset=utf8', 'root', '');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}