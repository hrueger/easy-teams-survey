<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a href="index.php" class="navbar-brand"><?php echo htmlspecialchars($_ENV["TITLE"]) ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a href="index.php" class="nav-link <?php onPageActive("index.php") ?>">Home</a>
        </li>
        <?php if (isLoggedin() && isAdmin()) { ?>
          <li class="nav-item" data-turbolinks="false">
            <a href="classes.php" class="nav-link <?php onPageActive("classes.php") ?>">Auswertung</a>
          </li>
        <?php } ?>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
        <?php if (isLoggedin()) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="profileImage.php" class="rounded-circle align-self-center mr-1" style="height: 25px;">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <h5 class="dropdown-item-text mb-0"><?php echo $_SESSION["username"] ?></h5>
                  <p class="dropdown-item-text text-muted mb-0"><?php echo $_SESSION["email"] ?></p>
                  <div class="dropdown-divider"></div>
                  <a href="signout.php" class="dropdown-item">Abmelden</a>
            </ul>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a href="signin.php" class="nav-link">Anmelden</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>