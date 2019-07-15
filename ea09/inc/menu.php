      <div id="left">
          <?php
            if(user_is_logged()) {
                // ide jon majd
                $u=Doctrine_Core::getTable('User')->find($glob_uid);
                $kepsrc=userpicture_url($u->picture);
                print "<img src='$kepsrc' class='userkep' />";

                print "<p>Bejelentkezve:</p>";
                print "<p>$glob_usernev</p>";
                print "<ul>";
                print "<li><a href='index.php'>Főoldal</a></li>";
                print "<li><a href='logout.php'>Kijelentkezés</a></li>";
                print "<li><a href='useredit.php'>Adataim</a></li>";
                print "<li><a href='changepassword.php'>Jelszó módosítás</a></li>";
                print "<li><a href='blogs.php'>Összes blog</a></li>";
                print "<li><a href='newblog.php'>Új blog</a></li>";
                print "<li><a href='users.php'>Szerzők</a></li>";
                print "<li><a href='stats.php'>Statisztikák</a></li>";
                print "</ul>";
            } else {
                print "<ul>";
                print "<li><a href='index.php'>Főoldal</a></li>";
                print "<li><a href='register.php'>Regisztráció</a></li>";
                print "<li><a href='login.php'>Bejelentkezés</a></li>";
                print "<li><a href='blogs.php'>Összes blog</a></li>";
                print "<li><a href='users.php'>Szerzők</a></li>";
                print "</ul>";
            }
          ?>
                    
      </div>
      <div id="right">
          ide jönnek a reklámok
      </div>