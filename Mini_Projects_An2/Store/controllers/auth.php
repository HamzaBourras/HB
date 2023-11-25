<?php
session_start();
include_once( 'geredata.php' );

if ( isset( $_POST[ 'email' ] ) && isset( $_POST[ 'password' ] ) ) {
    $user = getUserByEmail( $_POST[ 'email' ] );

    if ( $user[ 'password' ] == $_POST[ 'password' ] ) {
        header( 'location:../views/home.php' );
        $_SESSION[ 'user' ] = [
            'id' => $u[ 'id' ],
            'email' => $u[ 'email' ],
        ];

    }

    else {
        $_SESSION[ 'ereurLogin' ] = 'Email ou password incorrect !';
        echo '<script>';
        echo 'window.history.back();';
        echo '</script>';
    }

}
?>