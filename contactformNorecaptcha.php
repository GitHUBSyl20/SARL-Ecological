<?php 
header('Location: http://www.sarl-ecological.com');
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
	$to = 'sylvainmagana@ymail.com'; 
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
 
		echo '<div>', $frontMsg, '</div>';

}
	/* foreach ($_POST as $key => $value) {
		echo '<p><strong>' . $key.':</strong> '.$value.'</p>';
	  } */


