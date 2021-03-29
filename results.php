<?php require_once("partials/head.php"); ?>
<?php ensureLoggedin() ?>
<?php ensureAdmin() ?>

<style>
  .fake-button {
    border-radius: 3px;
  }
</style>

<div class="jumbotron">
  <h1>Auswertung</h1>
  <?php
  if (file_exists("./results.data")) {

    $data = file_get_contents("./results.data");
    $lines = explode(PHP_EOL, $data);
    array_pop($lines);
    sort($lines);

  ?>
    <details>
      <summary>Es haben <?php echo count($lines); ?> Personen abgestimmt.</summary>
      <ul>
        <?php foreach ($lines as $userdata) { ?>
          <li><?php echo explode(";", $userdata)[0]; ?></li>
        <?php } ?>
      </ul>
    </details>

    <details>
      <summary>Geordnet nach Antwort</summary>
      <?php

      $answers = array();
      foreach ($lines as $userdata) {
        $parts = explode(";", $userdata);
        foreach (json_decode($parts[1]) as $answer) {
          if (isset($answers[$answer])) {
            $answers[$answer] += 1;
          } else {
            $answers[$answer] = 1;
          }
        }
      }
      asort($answers);
      ?>


      <table class="my-3 table table-striped table-hover">
        <?php foreach ($answers as $answer => $count) { ?>
          <tr>
          <td> <?php echo $answer; ?></td>
          <td> <?php echo $count; ?></td>
         </tr>
        <?php } ?>
      </table>
    </details>

    <details>
      <summary>Geordnet nach Person</summary>
      <table class="my-3 table table-striped table-hover">
        <?php foreach ($lines as $userdata) {
        $parts = explode(";", $userdata); ?>
          <tr>
          <td> <?php echo $parts[0]; ?></td>
          <td> <?php echo implode("<br>", json_decode($parts[1])); ?></td>
         </tr>
        <?php } ?>
      </table>
    </details>


  <?php

  } else {
    echo "Es hat noch niemand abgestimmt.";
  }
  ?>
</div>


<?php require_once("partials/foot.php"); ?>