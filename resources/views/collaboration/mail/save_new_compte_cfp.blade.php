<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formation.mg</title>
</head>
<body>
    <p>
        Bonjour {{$nom_resp_cfp.'('.$email_resp_cfp.')'}}, <br>
        <strong>Félicitations!</strong>votre compte est activé. <br>
    </p>

    <p>vous êtes le responsable principale de <strong>Numerika Center</strong> </p>
    <p>Etant que responsable, vous pouvez vous connecter en tant que: <br>
        nom: {{$nom_resp_cfp}} <br>
        adresse mail: {{$email_resp_cfp}}
        mot de passe : 0000
    </p>

    <p><strong>Vos information est modifiable dans votre profile !</strong>  <br><br>
        Merci d'avoir choisi <a href="{{route('sign-in')}}">formation.mg</a>
    </p>
    <p>
        Cordialement <br>
        L’équipe de <strong>app.formation.mg</strong> <br>
    </p>
</body>
</html>
