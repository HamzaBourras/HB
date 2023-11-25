<?php

include_once( 'db.php' );

// function pour récuperer tous les produits

function getproducts () {
    global $conn;
    $req = $conn->prepare( 'select * from produits' );
    $req->execute();
    $res = $req->fetchAll( PDO::FETCH_ASSOC );

    return $res;
}

// function pour récuperer tous les produits

function getproductById ($id) {
    global $conn;
    $req = $conn->prepare( 'select * from produits where id=:i' );
    $req->execute(["i"=>$id]);
    $res = $req->fetch( PDO::FETCH_ASSOC );

    return $res;
}

// function pour register

function register ( $email, $pass, $role ) {
    global $conn;
    $req = $conn->prepare( "insert into users (email,password,role) values ('$email','$pass','$role')" );
    $res = $req->execute();

    return $res;
}

// function pour recuperer tous les utilisateurs

function getUserByEmail($email) {
    global $conn;
    $req = $conn->prepare('select * from users where email=:e');
   
    $req->execute(["e"=>$email]);
    $res = $req->fetch( PDO::FETCH_ASSOC );

    return $res;
}

// function pour ajouter un produit 
function ajoutProduit ($titre,$prix,$detail,$image) {
    global $conn;
    $req = $conn->prepare( 'INSERT INTO produits (titre, prix, image, detail) values (:t, :p, :i, :d)' );
    $req->execute(["t"=>$titre, "p"=>$prix, "i"=>$image, "d"=>$detail]);
    
}
?>