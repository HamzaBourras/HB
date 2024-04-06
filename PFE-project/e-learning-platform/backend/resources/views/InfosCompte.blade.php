<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="font-family: 'Poppins'; color: black">
    <div>
        <h1 style="font-size: 1.870rem; font-weight: 600;">E-Learning Platform</h1>
        <p style="font-size: 1rem;"> Bonjour <span style="font-weight: 600; font-size: 20px;">{{strtoupper($firstLastName)}}</span></p>
        <p style="font-size: 1rem;">Voici vos informations d'authentification à notre plateforme :</p>
        <p>Username : <span style="font-weight: 600; font-size: 14px;">{{$username}}</span></p>
        <p>Password : <span style="font-weight: 600; font-size: 14px;">{{$password}}</span></p>
        <p><a href="http://localhost:5173/" style="color: #3182ce; text-decoration: underline; font-size: 13px;">E-Learning Platform</a></p>
    </div>
</body>

</html>
