<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<?php

//définit les variables et les initialise à des valeurs vides
    $nom = $prenom = $tel = $email = $message = "";
    
   
//définit les variables d'erreur et les initialise à des valeurs vides
    $nomError = $prenomError = $telError = $emailError = $messageError = "";

//définit la variable de succès et l'initialise à une valeur vide
    $success = "";
//verifier si le champs est vide ou pas
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nom = verifyInput($_POST["nom"]);
        $prenom = verifyInput($_POST["prenom"]);
        $tel = verifyInput($_POST["tel"]);
        $email = verifyInput($_POST["email"]);
        $message = verifyInput($_POST["message"]);
    }
//fonction qui verifie si le champs est vide ou pas
    function verifyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }
//si le champs et vide affiche un message d'erreur
    if(empty($nom)){
        $nomError = "Veuillez saisir votre nom";
    }
    if(empty($prenom)){
        $prenomError = "Veuillez saisir votre prénom";
    }
    if(empty($tel)){
        $telError = "Veuillez saisir votre numéro de téléphone";
    }
    if(empty($email)){
        $emailError = "Veuillez saisir votre email";
    }
    if(empty($message)){
        $messageError = "Veuillez saisir votre message";
    }

//si le champs et pas vide verifier les données saisies par l'utilisateur
    if(!empty($nom) && !empty($prenom) && !empty($tel) && !empty($email) && !empty($message)){
        $nom = verifyInput($_POST["nom"]);
        $prenom = verifyInput($_POST["prenom"]);
        $tel = verifyInput($_POST["tel"]);
        $email = verifyInput($_POST["email"]);
        $message = verifyInput($_POST["message"]);
        $emailText = "";
        $success = "Message envoyé avec succès";
    }
//fonction qui verifie l'email
    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
//fonction qui verifie le numero de telephone
    function isTel($var){
        return preg_match("/^[0-9 ]*$/", $var);
    }
//fonction qui verifie le nom et le prenom
    function isName($var){
        return preg_match("/^[a-zA-Z ]*$/", $var);
    }
//fonction qui verifie le message
    function isMessage($var){
        return preg_match("/^[a-zA-Z ]*$/", $var);
    }
//affiche un message d'erreur si les données saisies par l'utilisateur ne sont pas valide
    if(!isEmail($email)){
        $emailError = "Veuillez saisir un email valide";
    }
    if(!isTel($tel)){
        $telError = "Veuillez saisir un numéro de téléphone valide";
    }
    if(!isName($nom)){
        $nomError = "Veuillez saisir un nom valide";
    }
    if(!isName($prenom)){
        $prenomError = "Veuillez saisir un prénom valide";
    }
    if(!isMessage($message)){
        $messageError = "Veuillez saisir un message valide";
    }
//si le champ est pas vide et que les donnée son valide affiche un message de succes
    if(!empty($nom) && !empty($prenom) && !empty($tel) && !empty($email) && !empty($message) && isEmail($email) && isTel($tel) && isName($nom) && isName($prenom) && isMessage($message)){
        $emailText .= "Nom : $nom\n";
        $emailText .= "Prénom : $prenom\n";
        $emailText .= "Tel : $tel\n";
        $emailText .= "Email : $email\n";
        $emailText .= "Message : $message\n";
        $success = "Message envoyé avec succès";
        $nom = $prenom = $tel = $email = $message = "";
    }
//function qui affiche un message de succes
    function success(){
        echo '<div class="alert alert-success" role="alert">
        Message envoyé avec succès
      </div>';
    }
//si le champs et pas vide et que la valeur n'est pas correct affiche un message d'erreur
    if(!empty($nom) && !empty($prenom) && !empty($tel) && !empty($email) && !empty($message) && !isEmail($email) && !isTel($tel) && !isName($nom) && !isName($prenom) && !isMessage($message)){
        $emailText .= "Nom : $nom\n";
        $emailText .= "Prénom : $prenom\n";
        $emailText .= "Tel : $tel\n";
        $emailText .= "Email : $email\n";
        $emailText .= "Message : $message\n";
        $success = "Message non envoyé";
        $nom = $prenom = $tel = $email = $message = "";
    }
//function qui affiche un message d'erreur
    function error(){
        echo '<div class="alert alert-danger" role="alert">
        Message non envoyé
      </div>';
    }

    




?>

<body>
    
<!--formulaire-->
    <form id="Contact-from" action="<?php echo htmlspecialchars ($_SERVER['PHP_SELF']); ?>" method="post" role="form">
        
    <h2>Formulaire de Contact</h2>
       <!--nom-->
        <p>
            <label for="nom">Nom :</label>
            <input type="name" name="nom" id="nom" placeholder="Votre nom" value="<?php echo $nom; ?>" >
            
        </p>
        <p>
            <?php echo $nomError; ?>
        </p>
        <!--prenom-->
        <p>
            <label for="prenom">Prénom :</label>
            <input type="name" name="prenom" id="prenom" placeholder="Votre prénom" value="<?php echo $prenom; ?>" >
        </p>
        <p>
            <?php echo $prenomError; ?>   
        </p>
        <!--tel-->
        <p>
            <label for="tel">Tel :</label>
            <input type="tel" name="tel" id="tel" placeholder="Votre numero" value="<?php echo $tel; ?>"    >
        </p>
        <p>
            <?php echo $telError; ?>
        </p>
        <!--email-->
        <p>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" placeholder="Votre email" value="<?php echo $email; ?>" >
        </p>
        <p>
            <?php echo $emailError; ?>
        </p>
        <!--message-->
        <p>
            <label for="message">Message :</label>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Votre message"> <?php echo $message; ?></textarea>
        </p>
        <p>
            <?php echo $messageError; ?>
        </p>
        
        <p>
            <?php echo $success; ?>
        </p>
        <!--bouton-->
        <p>
            <button id="button" type="submit" name="submit" value="Envoyer">Envoyé</button>    
        </p>
    </form>

</body>
</html>