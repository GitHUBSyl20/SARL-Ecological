
<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LdCFaYUAAAAAJsqKkYKVFbJmsTBe3pnAWBisjig',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Assurez-vous de valider la box anti-spam merci.</p><br>';
    } else {

/* header('Location: http://www.sarl-ecological.com');
// grab recaptcha library
/* require_once "recaptchalib.php" */

if(!empty($errors))
{ // si erreur on renvoie vers la page précédente
	$_SESSION['errors'] = $errors;//on stocke les erreurs
	$_SESSION['inputs'] = $_POST;
 	header('Location: http://www.sarl-ecological.com');
}
else
{
	$_SESSION['success'] = 1;
  $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'FROM:' . htmlspecialchars($_POST['email']);
	$to = 'contact@sarl-ecological.com'; 
	$subject = 'Message envoyé par ' . htmlspecialchars($_POST['nom']) . htmlspecialchars($_POST['prenom']);
	$message_content = '
	<table>
		<tr>
	  		<td><b>Emetteur du message:</b></td>
	  	</tr>
	  	<tr>
	  		<td>'. $subject . '</td>
		</tr>
		<tr>
		  	<td><b>Adresse expediteur:</b></td>
	  	</tr>
	  	<tr>
	  		<td>' . htmlspecialchars($_POST['adresse']) . '</td>
		</tr>
		<tr>
		  <td><b>Telephone exp&eacute;diteur:</b></td>
		</tr>
		<tr>
		  <td>' . htmlspecialchars($_POST['telephone']) . '</td>
		</tr>
		<tr>
		  <td><b>Objet message:</b></td>
	  	</tr>
	  	<tr>
	  		<td><b>' . htmlspecialchars($_POST['objetmessage']) . '</b></td>
		</tr>
		<tr>
		  <td><b>Contenu du message:</b></td>
	  	</tr>
	  	<tr>
	  		<td>'. htmlspecialchars($_POST['message']) .'</td>
	  	</tr>
	</table>';
	
	$frontMsg = 'Message Bien Envoyé, merci!';
	
	mail($to, $subject, $message_content, $headers);
 
		echo '<p> Message Bien Envoyé, merci!</p>';
	}
	}
}
?>