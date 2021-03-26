<?php require_once("partials/head.php"); ?>
<?php require_once("./lib.php"); ?>

<div class="jumbotron">
  <h1>AG Klassenfotos 2021</h1>
  <p class="lead mb-5">Portraitfotos der Schüler für den Jahresbericht 2021 hochladen</p>
  <?php if (isLoggedin()) {
  ?>
    <h4>Willkommen <?php echo $_SESSION["username"] ?>!</h4>

<?php
    $error = "";
    if (isset($_POST["submit"])) {
      ensureSurveyNotDone();

      if (!isset($_POST["question"])) {
        $error .= "Du musst mindestens ein Motto auswählen!";
      } else if (count($_POST["question"]) > 4) {
        $error .= "Du darfst maximal 4 Mottos auswählen!";
      } else {
        $u = getMySafeUsername();
        $d = json_encode($_POST["question"]);
        file_put_contents("./results.data", "$u;$d".PHP_EOL, FILE_APPEND);
        $statement = $db->prepare("UPDATE users SET survey_done = ? WHERE id = ?");
        $statement->execute(array(true, $_SESSION["id"]));
      }
    }

    ?>


    <?php if ($error) { ?>
      <div class="alert alert-danger">
        <b>Fehler:</b><br><?php echo htmlspecialchars($error); ?>
      </div>
    <?php } ?>

    <?php if (surveyDone()) { ?>
      <div class="alert alert-success">Deine Antwort wurde erfolgreich gespeichert.</div>
    <?php } else { ?>
    <div class="alert alert-success">
      <b>Abimotto 2022</b><br>
      Bitte wähle deine Motto-Favoriten aus. Du hast 4 Stimmen.<br><br><br>
      <form method="POST" action="index.php">

        <?php foreach ($_ENV["OPTIONS"] as $option) { ?>
          <div class="form-check">
            <input class="form-check-input" name="question[]" type="checkbox" value="<?php echo htmlspecialchars($option); ?>" id="<?php echo htmlspecialchars($option); ?>">
            <label class="form-check-label" for="<?php echo htmlspecialchars($option); ?>">
              <?php echo htmlspecialchars($option); ?>
            </label>
          </div>
        <?php } ?>
        <input type="hidden" name="submit" value="true">
        <input type="submit" class="mt-3 btn btn-outline-success" value="Absenden">
      </form>
    </div>
    <?php } ?>



    <a class="btn btn-outline-primary mt-5" href="signout.php">Abmelden</a>
  <?php } else { ?>
    <p>Bitte einloggen:</p>
    <a href="signin.php" class="btn btn-primary btn-large">Mit Microsoft Teams anmelden</a>
  <?php } ?>
</div>

<?php require_once("partials/foot.php"); ?>