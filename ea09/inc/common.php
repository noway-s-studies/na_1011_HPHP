<?php
      // emailcim ellenorzes
      function validemail($email) {
        if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email))
            return true;
        else
            return false;
      }
      // warning: figyelmeztetes
      // error: hiba
      // accept: minden rendben
      function create_uzi($szoveg,$tipus="warning") {
          return "<div class='".$tipus."_uzi'>$szoveg</div>";
          // .warning_uzi
          // .error_uzi
          // .accept_uzi
      }
      function show_uzenet() {
        if(isset($_SESSION["uzenet"]) && is_array($_SESSION["uzenet"])) {
            foreach ($_SESSION["uzenet"] as $uzi) {
                print $uzi;
            }
            unset($_SESSION["uzenet"]);
        }
      }
      // ide mi meg vissza fogunk jonni
      function userpicture_url($picture) {
          global $glob_userpicdir;
          if(is_null($picture) || trim($picture)=="")
              return $glob_userpicdir."nophoto.gif?id=".md5(uniqid(time()));
          else
              return $glob_userpicdir.$picture."?id=".md5(uniqid(time()));
      }
      function pics_extension($type) {
          if(strpos($type,"jpg")!==false) return ".jpg";
          if(strpos($type,"jpeg")!==false) return ".jpg";
          if(strpos($type,"gif")!==false) return ".gif";
          if(strpos($type,"png")!==false) return ".png";
          if(strpos($type,"bmp")!==false) return ".bmp";
          return "";
      }
      function honapnev($h) {
          switch ($h) {
              case 1: return "jan."; break;
              case 2: return "feb."; break;
              case 3: return "márc."; break;
              case 4: return "ápr."; break;
              case 5: return "máj."; break;
              case 6: return "jún."; break;
              case 7: return "júl."; break;
              case 8: return "aug."; break;
              case 9: return "szept."; break;
              case 10: return "okt."; break;
              case 11: return "nov."; break;
              case 12: return "dec."; break;
              default: return "???"; break;
          }
      }
?>
