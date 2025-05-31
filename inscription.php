<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion et Inscription</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            position: relative;
            width: 800px;
            height: 500px;
            background: #fff;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 10px;
        }
        
        .form-container {
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.6s ease-in-out;
            padding: 50px 40px;
            z-index: 100;
        }
        
        .sign-in-container {
            left: 0;
            z-index: 2;
        }
        
        .sign-up-container {
            left: 0;
            opacity: 0;
            z-index: 1;
        }
        
        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
            opacity: 0;
        }
        
        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }
        
        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }
        
        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }
        
        .overlay {
            position: relative;
            color: #fff;
            background: #1F7D53;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
            display: flex;
            align-items: center;
        }
        
        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }
        
        .overlay-panel {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }
        
        .overlay-left {
            transform: translateX(-20%);
        }
        
        .overlay-right {
            right: 0;
            transform: translateX(0);
        }
        
        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }
        
        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }
        
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        
        h1 {
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        p {
            margin: 20px 0 30px;
            font-size: 14px;
            line-height: 1.5;
        }
        
        input {
            background-color: #f5f5f5;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 5px;
        }
        
        button {
            border-radius: 20px;
            border: 1px solid #1F7D53;
            background: #1F7D53;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            cursor: pointer;
            margin-top: 15px;
        }
        
        button:active {
            transform: scale(0.95);
        }
        
        button.outline {
            background: transparent;
            border: 2px solid #fff;
        }
        
        .social-container {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }
        
        .social-container a {
            border: 1px solid #ddd;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
            text-decoration: none;
            color: #333;
        }
        
        .social-container a:hover {
            border-color: #1F7D53;
            color: #1F7D53;
        }
        
        span {
            font-size: 12px;
            margin: 15px 0;
        }
        
        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #888;
            font-size: 0.8rem;
        }
        
        .divider:before, .divider:after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: #ddd;
        }
        
        .divider span {
            padding: 0 15px;
            margin: 0;
        }
        
        .error-message {
            color: #f44336;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container sign-up-container">
            <form action="inscription.php" method="POST">
                <h1>Créer un Compte</h1>
                <div class="social-container">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="divider">
                    <span>ou utilisez votre email pour l'inscription</span>
                </div>
                <input type="text" name="nom" placeholder="Nom" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required />
                <button type="submit">S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="welcome.php" method="POST">
                <h1>Se Connecter</h1>
                <div class="social-container">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-google"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="divider">
                    <span>ou utilisez votre compte</span>
                </div>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required />
                <a href="#">Mot de passe oublié ?</a>
                <button type="submit">Se Connecter</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bon Retour !</h1>
                    <p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles</p>
                    <button class="outline" id="seConnecter">Se Connecter</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bonjour!</h1>
                    <p>Entrez vos informations personnelles et commencez votre parcours avec nous</p>
                    <button class="outline" id="sInscrire">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const boutonInscription = document.getElementById('sInscrire');
            const boutonConnexion = document.getElementById('seConnecter');
            const conteneur = document.querySelector('.container');

            boutonInscription.addEventListener('click', () => {
                conteneur.classList.add('right-panel-active');
            });

            boutonConnexion.addEventListener('click', () => {
                conteneur.classList.remove('right-panel-active');
            });
        });
    </script>
</body>
</html>