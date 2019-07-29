<?php
// On change le type de retour à application/json pour la requete ajax
header('Content-Type: application/json');

// Email qui recoit la demande
$emailContact = 'o-point@iatlab.ch';

// Récupération des données du formulaire
$email = $_POST['email'];
$name = $_POST['name'];
$firstname = $_POST['firstname'];
$subject = $_POST['subject'];
$message = $_POST['Message'];

// Si l'email n'est pas valide, on renvoie une erreur
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $return = ['status'=>'error', 'message'=>'Adresse email invalide'];
    echo json_encode($return);
    exit();
}

// Si on a l'info du captcha
if(isset($_POST['recaptcha_response'])) {

    // Infos pour l'appel a recaptcha
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LfqGYwUAAAAAN9Zi81zgPKojAiGLVBXMRMMxVXu';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Appel à recaptcha
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    
    // Test du score recaptcha
    if ($recaptcha->score < 0.5) {
        // Score faible, surement un bot
        // Message d'erreur et arrêt
        $return = ['status'=>'error', 'message'=>'Captcha invalide.', 'score'=>$recaptcha->score];
        echo json_encode($return);
        exit();
    }

// Préparation des données pour l'email pour l'admin
$to      = $emailContact;
$subject = 'Contact O-Point: '.$subject;
$message = 'Demande de la part de : '.$firstname.' '.$name."\r\n\r\n".$message;
$headers = 'From: ' .$email. "\r\n" .
    'Reply-To: ' . $email. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Envoi de l'email
mail($to, $subject, $message, $headers);

// Préparation des données pour le visiteur
$to      = $email;
$subject = 'Contact O-Point: '.$subject;
$message = "Bonjour,\r\n\r\nNous avons bien reçu votre demande et la traiterons dans les plus brefs délais.\r\n\r\nL'équipe O-Point";
$headers = 'From: ' .$emailContact. "\r\n" .
    'Reply-To: ' . $emailContact. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Envoi de l'email
mail($to, $subject, $message, $headers);

// On renvoie un message de validation
$return = ['status'=>'ok', 'message'=>'Nous avons bien reçu votre demande, merci!'];
echo json_encode($return);

}