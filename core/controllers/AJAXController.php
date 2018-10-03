<?php 
require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");
$ajax=new AJAXController;


class AjaxController
{
    public $adminmodelobj;

    public function __construct()
    {
        $this->adminmodelobj=new AdminModel; 
        $this->setMethod();
    }


    public function setMethod()
    {
        if (isset($_POST['userdata']))     $this->getAjaxUserdata();
        if(isset($_POST['editusername']))  $this->editAjaxUsername();
        if (isset($_POST['deleteuserid'])) $this->deleteAjaxUserdata();
        if (isset($_POST['download']))     $this->AjaxUploader();
        if (isset($_POST['addstudent']))   $this->newAjaxStudent();
        if (isset($_POST['addworkbook']))  $this->newAjaxWorkbook();
    }

    public function getAjaxUserdata()
    {
        $userdata = htmlspecialchars($_POST['userdata']);
        $data=$this->adminmodelobj->getUser($userdata);
         if (empty($data))
         {
            $result = array('id' => 'no');
            die(json_encode($result));
         }

        $result = array("id" => $data[0]['id'],"username" => $data[0]['login'],"rank" => $data[0]['role']);
        echo json_encode($result);
    }

    public function editAjaxUsername()
    {
        $userid       = htmlspecialchars($_POST['edituserid']);
        $editusername = htmlspecialchars($_POST['editusername']);
        $edituserrole = htmlspecialchars($_POST['edituserrole']);

         $show=$this->adminmodelobj->editUser($userid,$editusername,$edituserrole);
         if($show==true){
            $result = array("ok" => "AllOk");
         }elseif($show=='userhave'){
             $result = array("userhave" => "userhave");
         }else{
           $result = array("bad" => "AllBad");
         }
         echo json_encode($result);
    }

    public function deleteAjaxUserdata()
    {
        $userid = htmlspecialchars($_POST['deleteuserid']);

        $show=$this->adminmodelobj->deleteUser($userid);
        if ($show==true){
            $result = array("deleted" => "UserDeleted");
            R::exec("set @i := 0;update users set id = (@i := @i+1 ) order by id");
        }else{
            $result = array("deleted" => "SomeError");
        }

        echo json_encode($result);
    }

    public function AjaxUploader()
    {
        if ((isset($_POST['bookname']))&& (isset($_POST['fileauthor']))&&(isset($_POST['about']))&&(isset($_POST['rank']))){
            $uploaddir = ROOT . "/files/";
            $uploaddirim = ROOT . "/public/img/Books/";
            $bookname=htmlspecialchars($_POST['bookname']);
            $fileauthor=$_POST['fileauthor'];
            $date=date("Y-m-d");
            $about=$_POST['about'];
            $level=$_POST['level'];
            $rank=$_POST['rank'];
            $category=ucwords(strtolower($_POST['downloadcat']));
            $category=mb_convert_case($_POST['downloadcat'], MB_CASE_TITLE, "UTF-8");
            $mas1=chr(rand(97,122)).chr(rand(97,122));
        }else{die();}
        $status_upload=$this->adminmodelobj->download($uploaddir,$uploaddirim,$bookname,$fileauthor,$date,$about,$level,$rank,$category,$mas1);
        /*echo $status_upload;*/
        if ($status_upload==true){
        R::exec("set @i := 0;update books set id = (@i := @i+1 ) order by id;");
        R::exec("set @i := 0;update techniques set id = (@i := @i+1 ) order by id;");
        $this->adminmodelobj->reloadLocation();
        }else{
            echo"<script>alert('Извините, но при добавлении данных возникла непредвиденная ошибка, пожалуйста проверьте правильность введенных данных, и повторите загрузку.');</script>";
        }
    }

    public function newAjaxStudent()
    {
         if (isset($_POST['class'])) $student = htmlspecialchars($_POST['class']);
        if (is_numeric($_POST['amount'])) $amount = (int) $_POST['amount'];
        if ((isset($_POST['class'])) && ($_POST['class'] == 1)) {
            $year = (int) $_POST['date'];
        } else {
            $year = date('Y');
        }

        $return_added_stud=$this->adminmodelobj->addStudent($student,$amount,$year);
            if($return_added_stud==true){
                $result = array("studadd" => "success");
            }else{
               $result = array("studadd" => "error");
            }
        echo json_encode($result);
    }

    public function newAjaxWorkbook()
    {
        $workclass  = htmlspecialchars($_POST['work_class']);
        $author     = htmlspecialchars($_POST['author']);
        $subject    = htmlspecialchars($_POST['subject']);
        $year_add   = htmlspecialchars($_POST['year_add']);
        $shelf_life = htmlspecialchars($_POST['shelf_life']);
        $publishing = htmlspecialchars($_POST['publishing']);
        $amount     = htmlspecialchars($_POST['amount']);
       $return_added_book=$this->adminmodelobj->addWorkbook($workclass,$author,$subject,$year_add,$shelf_life,$publishing,$amount);
       echo $return_added_book;
    }

}


 #$obj->updateData();

?>
