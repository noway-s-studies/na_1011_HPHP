      <div id="left">
          <?php
            if(user_is_logged()) {
                print "<p>Bejelentkezve:</p>";
                print "<p>$glob_usernev</p>";
            } else {

            }
          ?>
          <ul>
              <li><a href="register.php">Regisztráció</a></li>
              <li><a href="login.php">Bejelentkezés</a></li>
              <li><a href="logout.php">Kijelentkezés</a></li>
          </ul>
      </div>
      <div id="right">
          ide jönnek a reklámok
      </div>