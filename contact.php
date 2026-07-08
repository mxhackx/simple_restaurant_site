<!--Contact-->
<!doctype html>
<html lang="fr">
<!-- Inclusion du head pour definir les metadonnes et certaines informations lies a la page-->
  <?php include "./includes/head.php"?>
  <body>
    <!-- Header -->
    <?php include "./includes/header.php"?>
    <!-- Main -->
    <main>
      <!-- Formulaire de contact-->
       <?php
           function correct_input($data){
               $data = trim($data);
               $data = stripcslashes($data);
               $data = htmlspecialchars($data);
               return $data;
           }
           function checkmail($email){
            return !filter_var($email, FILTER_VALIDATE_EMAIL);
           }
           $fields = [
            "firstname" => '',
            "lastname" => '',
            "email" => '',
            "telephone" => '',
            "event" => '',
            "question" => '',
            "date" => '',
            "convives" => '',
            "conditions" => '',
           ];
           $errors = [];
           if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $fields = [
                "firstname" => correct_input($_POST['contact-form-firstname']),
                "lastname" => correct_input($_POST['contact-form-lastname']),
                "email" => correct_input($_POST['contact-form-email']),
                "telephone" => correct_input($_POST['contact-form-tel']),
                "event" => $_POST['contact-form-event'],
                "question" => correct_input($_POST['contact-form-question']),
                "date" => $_POST['contact-form-date'],
                "convives" => $_POST['contact-form-nb'],
                "conditions" => $_POST['contact-form-condition'],
           ];
           $errors = [];
           foreach ($fields as $name => $value){
            $errors[$name] = '';
                if (empty($value))
                    $errors[$name] = ucfirst($name) . ' is required';
                if ($name === "email"){
                  $errors[$name] = (checkmail($fields[$name])) ? (ucfirst($name) . ' is incorrect'): $errors[$name];
                }
                if ($name == 'firstname' || $name == 'lastname'){
                  if (preg_match('/\s/', $value))
                    $errors[$name] = ucfirst($name) . ' should not contain any space';
                }
                if ($name === "convives"){
                  if (filter_var($value, FILTER_VALIDATE_INT) === false)
                    $errors[$name] = ucfirst($name) . ' should be a number';
                  elseif ((int)$value <= 0)
                    $errors[$name] = ucfirst($name) . ' should be positive and non-null';
                }
                if ($name === "telephone") {
                   if (!preg_match('/^\+\d{1,3}\s\d{2}\s\d{2}\s\d{2}\s\d{2}\s\d{2}$/', $value)) {
                       $errors[$name] = "Telephone is incorrect";
                   }
                }
                if ($name === "conditions" && $value !== "yes") {
                   $errors[$name] = "You must accept the conditions";
                }
           }
           }
       ?>
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
          <!-- Prenom -->
          <span>
            <label for="contact-form-firstname">Prenom</label>
            <input
              id="contact-form-firstname"
              name="contact-form-firstname"
              type="text"
              class="contact-form-input"
              value='<?php if (isset($errors["firstname"])) echo $fields["firstname"]?>'
            >
            <span>*<?php if (isset($errors["firstname"])) echo $errors["firstname"]?></span>
          </span>
          <!-- Nom -->
          <span>
            <label for="contact-form-lastname">Nom</label>
            <input
              id="contact-form-lastname"
              name="contact-form-lastname"
              type="text"
              class="contact-form-input"
              value='<?php if (isset($errors["lastname"])) echo $fields["lastname"]?>'
            >
            <span>*<?php if (isset($errors["lastname"])) echo $errors["lastname"]?></span>
          </span>
          <!-- Email -->
          <span>
            <label for="contact-form-email">Email</label>
            <input
              id="contact-form-email"
              name="contact-form-email"
              type="email"
              placeholder="ex:johndoe@gmail.com"
              value='<?php if (isset($errors["email"])) echo $fields["email"]?>'
            >
            <span>*<?php if (isset($errors["email"])) echo $errors["email"]?></span>
          </span>
          <!-- Telephone -->
          <span>
            <label for="contact-form-tel">Telephone</label>
            <input
              id="contact-form-tel"
              name="contact-form-tel"
              placeholder="(+229) 01 99 99 99 99"
              value='<?php if (isset($errors["telephone"])) echo $fields["telephone"]?>'
            >
            <span>*<?php if (isset($errors["telephone"])) echo $errors["telephone"]?></span>
          </span>
          <!-- Nombres d'invites -->
          <span>
            <label for="contact-form-nb">Nombre de convives</label>
            <input id="contact-form-nb" name="contact-form-nb" type="number"
            value='<?php if (isset($errors["convives"])) echo $fields["convives"]?>'>
            <span>*<?php echo $errors["convives"]?></span>
          </span>
          <!-- Date de reservation -->
          <span>
            <label for="contact-form-date">Reservation</label>
            <input
              id="contact-form-date"
              name="contact-form-date"
              type="date"
              value='<?php if (isset($errors["date"])) echo $fields["date"]?>'
            >
            <span>*<?php if (isset($errors["date"])) echo $errors["date"]?></span>
          </span>
          <!-- Evenement -->
          <span>
            <label for="contact-form-event">Evenement</label>
            <select id="contact-form-event" name="contact-form-event" required>
              <option value="birth">Anniversaire</option>
              <option value="marry">Mariage</option>
              <option value="football">Match de foot</option>
            </select>
            <span>*<?php if (isset($errors["event"])) echo $errors["event"]?></span>
          </span>
          <!-- Question -->
          <span>
            <label for="contact-form-question">Question</label>
            <textarea
              rows="10"
              cols="100"
              id="contact-form-question"
              name="contact-form-question"
            ><?php if (isset($errors["question"])) echo $fields["question"]; else echo "Vous avez une question ?" ?></textarea>
          </span>
          <!-- Conditions d'utilisations -->
          <p>Acceptez vous les conditions d'utilisation ?</p>
          <input
            id="condition-yes"
            name="contact-form-condition"
            type="radio"
            value="yes"
          >
          <label for="condition-yes"
            >J'ai lu et j'accepte les conditions d'utilisation</label
          >
          <input
            id="condition-no"
            name="contact-form-condition"
            type="radio"
            value="no"
            checked
          >
          <label for="condition-no">Je n'accepte pas les conditions</label>
          <input type="submit" value="Soumettre">
          <span><?php if (isset($errors["conditions"])) echo $errors["conditions"]?></span>
      </form>
    </main>
    <!-- Footer -->
    <?php include "./includes/footer.php"?>
  </body>
</html>
