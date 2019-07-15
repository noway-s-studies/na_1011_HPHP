<?php



class User {
    public $login;
    public $nev;
    public $email;
      
    private $password;
    private $password2;
    
    public function __construct($login="",$nev="",$email="") {
        $this->login=trim($login);
        $this->nev=trim($nev);
        $this->email=trim($email);
    }
    
    function SetPassword($p) {
        $this->password=trim($p);
    }
    function SetPassword2($p) {
        $this->password2=trim($p);
    }
    
    // helyes user parameterek:
    // min 4 karakter login
    // nev min 5 karakter
    // ket password azonos, legalabb 6 karakter
    // email legyen valid
    function IsValidUserReg() {
        $uzenet = array();
        global $db;
        $stmt = $db->prepare("select count(*) darab from users where login = ?");
        $stmt->bindColumn('darab', $darab);
        $stmt->execute(array($this->login));
        $stmt->fetch(PDO::FETCH_BOUND);
        if($darab>0)
            array_push ($uzenet, create_uzi("Ilyen felhasználónév már van!", "error"));
        if(strlen($this->login)<4) 
            array_push ($uzenet, create_uzi("A felhasználónév túl rövid (min. 4 karakter)!", "error"));
        if(strlen($this->nev)<5) 
            array_push ($uzenet,  create_uzi("A név túl rövid (min. 5 karakter)!", "error"));
        if(strlen($this->password)<6) 
            array_push ($uzenet,  create_uzi("A jelszó túl rövid (min. 6 karakter)!", "error"));
        if($this->password!=$this->password2) 
            array_push ($uzenet,  create_uzi("A két jelszó nem azonos!", "error"));
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
                array_push ($uzenet,  create_uzi("Az email cím hibás!", "error"));
        return $uzenet;
    }
    
    function Insert() {
        global $db;
        global $salt;
        $stmt = $db->prepare("insert into users (login, passmd5, nev, email) values (?,?,?,?)");
        $stmt->execute(array($this->login, md5($salt.$this->password), $this->nev, $this->email));        
    }
    
    public static function TryLogin($login, $pass) {
        global $db;
        global $salt;
        $stmt = $db->prepare("select count(*) darab from users where login = ?");
        $stmt->bindColumn('darab', $darab);
        $stmt->execute(array($login));
        $stmt->fetch(PDO::FETCH_BOUND);
        if($darab!=1) {
            return "Sajnos nincs ilyen felhasználói név a rendszerben!";
        } else {
            $stmt = $db->prepare("select nev, email, passmd5 from users where login = ?");
            $stmt->bindColumn('nev', $nev);
            $stmt->bindColumn('email', $email);
            $stmt->bindColumn('passmd5', $passmd5);
            $stmt->execute(array($login));
            $stmt->fetch(PDO::FETCH_BOUND);
            if(md5($salt.$pass)!=$passmd5) {
                return "Hibás jelszó";
            } else {
                return new User($login, $nev, $email);
            }
        }        
    }
    
    public static function ChangePasswordForm($isposted=false, $oldpassword="", $password="", $password2="") {
        global $salt;
        $uzenet=array();
        $iserror=false;
        if($isposted) {
            $trylogin = User::TryLogin($_SESSION["user"]->login, $oldpassword);
            if(is_object($trylogin)) {
                if(strlen($password)<6) 
                    array_push ($uzenet,  create_uzi("A jelszó túl rövid (min. 6 karakter)!", "error"));
                if($password!=$password2) 
                    array_push ($uzenet,  create_uzi("A két jelszó nem azonos!", "error"));
            } else {
                $uzenet[]=  create_uzi($trylogin, "error");
            }
            if(count($uzenet)==0) {
                global $db;
                if(false) { $db = new PDO(); }
                $stmt = $db->prepare("update users set passmd5 = ? where login = ?");
                $stmt->execute(array(md5($salt.$password), $_SESSION["user"]->login));
                $uzenet[]=  create_uzi("Sikeres módosítás", "accept");
            } else $iserror=true;
        }
        
        print '<head><meta charset="UTF-8" /></head>';
        print "<div id='changepasswordform'>";
        foreach ($uzenet as $uzi) {
            print $uzi;
        }
        if(!$isposted || $iserror) {
            print "<form action='#' method='post'>";
            print "<table border='4'>";
            print "<tr>";
            print "    <td>Eredeti jelszó</td>";
            print "    <td><input type='password' name='oldpassword' id='oldpassword' value='' /></td>";
            print "</tr>";
            print "<tr>";
            print "    <td>Jelszó</td>";
            print "    <td><input type='password' name='password' id='password' value='' /></td>";
            print "</tr>";
            print "<tr>";
            print "    <td>Jelszó mégegyszer</td>";
            print "    <td><input type='password' name='password2' id='password2' value='' /></td>";
            print "</tr>";
            print "<tr>";
            print "    <td colspan='2' align='center'><input type='submit' name='elkuld' id='elkuld' value='Módosít' onClick='Save_ChangePasswordForm(); return false;' /></td>";
            print "</tr>";
            print "</table>";
            print "</form>";
        }
        print "</div>";
        
    }
    
    
}
