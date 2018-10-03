<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config/connect_files.php");
class AdminModel
{
    public $cat;
    public $class;
    public $book;
    public $download;
    public $userdata;
    public $author;
    public $editusername;
    public $deleteuserid;
    

    public function __construct()
    {
        # R::exec("set @i := 0;update users set id = (@i := @i+1 ) order by id");
    }

    public function getUser($userdata)
    {
        $data = R::getAll('SELECT * FROM users WHERE login like :login LIMIT 1', array(':login' => $userdata));
        return $data;
    }

    public function editUser($userid,$editusername,$edituserrole)
    {
        try {
            R::exec("UPDATE users SET login = :editusername, role= :edituserrole WHERE id= :userid",
            array(':editusername' => $editusername,':edituserrole' => $edituserrole,':userid'=>$userid));
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
    public function deleteUser($userid)
    {

        try {
            R::exec("DELETE FROM users WHERE id= :userid", array(':userid' => $userid));
        } catch (Exception $e) {
          return false;
        }
        return true;

    }

    public function addStudent($student,$amount,$year)
    {

        $check_true = R::getAll("SELECT quantity from students WHERE id=?", array($student));
        $check_true = $check_true[0]['quantity'] + $amount;
        if (($check_true < 0)||empty($check_true))  return false;

        R::exec("UPDATE students SET quantity=quantity+ :quantity,date= :year WHERE id= $student ",
            array(':quantity' => $amount,':year' => $year));

        $get_students = R::getAll('SELECT quantity from students WHERE id = ? ', array($student));

        R::exec('UPDATE workbooks SET need= ? WHERE class= ?',
            array($get_students[0]['quantity'],$student));

        return true;

    }

    public function addWorkbook($workclass,$author,$subject,$year_add,$shelf_life,$publishing,$amount)
    {
        
        $sql = R::getAll("SELECT * FROM workbooks WHERE class=? AND author LIKE ? AND subject LIKE ?",
            array($workclass,$author,$subject));
        if (empty($sql)) {
            try {
                
            R::exec("INSERT INTO workbooks (subject,author,class,dateadd,life,publishing,amount) values(:subject,:author,:class,:dateadd,:shelf,:publish,:amount)",
                array(':subject' => $subject,':author' => $author,':author' => $author,':class' => $workclass,':dateadd' => $year_add,
                ':shelf' => $year_add + $shelf_life,':publish' => $publishing,':amount' => $amount));

            $get_students = R::getAll('SELECT quantity from students WHERE id = ? ', array($workclass));

            R::exec('UPDATE workbooks SET need= ? WHERE class= ?', array($get_students[0]['quantity'],$workclass));

            $result = array("worked" => "success");
            return json_encode($result);
            } catch (Exception $e) {
                $result = array("worked" => "error");
                 return json_encode($result);
            }
        } else {
            R::exec("UPDATE workbooks SET subject=:subject,author=:author,class=:class,dateadd=:dateadd,life=:shelf,publishing=:publish,amount=:amount WHERE class=:class AND author LIKE :author AND subject LIKE :subject ",
                array(':subject' => $subject,':author' => $author,':author' => $author,':class' => $workclass,':dateadd' => $year_add,
                ':shelf' => $year_add + $shelf_life,':publish' => $publishing,':amount' => $amount));

            $get_students = R::getAll('SELECT quantity from students WHERE id = ? ', array($workclass));

            R::exec('UPDATE workbooks SET need= ? WHERE class= ?', array($get_students[0]['quantity'],$workclass));

            $result = array("worked" => "success");
            return json_encode($result);
        }
    }

    public function updateData()
    {
        R::exec('UPDATE students SET date= ' . date('Y'));
        R::exec('DELETE from workbooks WHERE life= ' . date('Y'));
        $sql = R::getAll("SELECT * FROM students");
        for ($i = 10; $i >= 1; $i--) {
          R::exec("UPDATE students SET quantity= " . $sql[$i - 1]['quantity'] . ", date= " . $sql[$i - 1]['date'] . " WHERE id= $i+1");
        }
          R::exec("UPDATE students SET quantity= 0, date= date+1 WHERE id=1");
    }

    public function takeReport()
    {
        $get_data = R::getAll("SELECT * from workbooks");
        return $get_data;
    }

    public function takeUsers()
    {
        $users=R::getAll("SELECT * FROM users");
        return $users;
    }

    public function transletter($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
         'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',' ');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E',
         'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya','_');
        return str_replace($rus, $lat, $str);
    }

    public function download($uploaddir,$uploaddirim,$bookname,$fileauthor,$date,$about,$level,$rank,$category,$mas1)
    {

        if ($level =='Доступна всем'){$table='books';}else{$table='techniques';}
        $numberid=R::getAll("SELECT id FROM category WHERE category LIKE :cat",array(':cat'=>$category));
        if(empty($numberid)){
            if ($table == 'books') {
                $catrank=1;
            }else{$catrank=2;}
            R::exec("INSERT INTO category (category,rank) VALUES (?,?)",array($category,$catrank));
            $numberid=R::getAll("SELECT id FROM category WHERE category LIKE :cat",array(':cat'=>'%'.$category.'%'));
        }
        
        if (is_uploaded_file($_FILES["filename"]["tmp_name"]))
        {
            $info = new SplFileInfo($_FILES["filename"]["name"]);
            $fileextention= $info->getExtension();
            $filename=$this->transletter($_FILES["filename"]["name"]);
            $name=$mas1.rand(0,50).$filename;
            move_uploaded_file($_FILES["filename"]["tmp_name"], $uploaddir . $name);
        }
        else
        {
            die("<script>alert('Неудача!!!');</script>");
        }
        
        if (is_uploaded_file($_FILES["fileimage"]["tmp_name"]))
        {
            $infoim = new SplFileInfo($_FILES["fileimage"]["name"]);
            $imgextention= $infoim->getExtension();
            $fileimage=$this->transletter($_FILES["fileimage"]["name"]);
            $nameimg=$mas1.rand(1,50).$fileimage;
            move_uploaded_file($_FILES["fileimage"]["tmp_name"], $uploaddirim . $nameimg);
        }
        
        $sql = count(R::getAll('SELECT id FROM '.$table));
        $validId = R::getAll('ALTER TABLE $table auto_increment= ' . $sql);
        try {
            $book = R::dispense($table);
            $book->name = $bookname;
            $book->author = $fileauthor;
            $book->date = $date;
            $book->category = $numberid[0]['id'];
            $book->about=$about;
            $book->filesize=$_FILES["filename"]["size"];
            if ($table=='books') $book->class=$rank;
            $book->file=$name;
            if(!empty($_FILES["fileimage"]["name"])){$book->img=$nameimg;}
            $newbook = R::store($book);
        }catch (Exception $e) {
            return false;
        }
        return true;
    }



public function reloadLocation()
{
    exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
}

}
?>
