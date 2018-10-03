<? require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");

class AuthModel
{
    public $rank;
    
    public function Registration($username,$password,$role)
{
    if (isset($_POST['reg_login']) && isset($_POST['reg_password']))
    {
        $username = htmlspecialchars(trim($_POST['reg_login']));
        $password = htmlspecialchars(trim($_POST['reg_password']));
        $password2 = htmlspecialchars(trim($_POST['password2']));
        if ((empty($username))||(empty($password))||($password!==$password2)||(!preg_match('/[a-zA-Z_0-9]+/', $username))) {
            return false;
        }
        
        
            R::exec("set @i := 0;update users set id = (@i := @i+1 ) order by id;");
            $user = R::dispense('users');
            $user->login = $username;
            $user->password = md5($password);
            $user->role = $role;
            $newuser = R::store($user);
            return true;
        }
    }

 public function Login($username,$password)
    {

    if (!$this->CheckLoginInDB($username, $password))
        {
            $result = array("name" => "false");
           return json_encode($result); 
        #return false;

        }else{
            $result = array("name" => "true");
            $this->startAuth($username);
           return json_encode($result); 
           
        }
  }      

public function startAuth($username)
    {
            $_SESSION["user_valid"] = $this->rank;
            $_SESSION["username"] = $username;
            #reloadLocation();
            #return true;
    }

public function exitAuth()
    {
        $parse=(parse_url($_SERVER['REQUEST_URI']));
        unset($_SESSION["user_valid"]);
        session_destroy();
        isset($parse['query']) ? $query='?'.$parse['query'] : $query='';
        header('location:'. $parse['path'].$query);
    }

public function CheckLoginInDB($username, $password)
    {
    $username = $username;

    $pwdmd5 = md5($password);
    $result = R::getAll("Select * from users where login= :username and password= :pass ", 
        array(':username' => $username,':pass' => $pwdmd5));

    if (!$result || count($result) <= 0)
        {
            return false;
        }

    $this->rank = $result[0]['role'];
    return true;
    }

   public function testlogin($login,$rolework=null)
    {
    if (is_null($rolework)) $rolework='';
    $test = R::getAll('SELECT * FROM users WHERE login LIKE ? AND login NOT LIKE ?', array($login,$rolework));
    if (empty($test)){
         $result = array("haveinDB" => "yes");
    }else{
         $result = array("haveinDB" => "no");
    }
        return json_encode($result);
    }
}


?>
