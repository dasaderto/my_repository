<?php require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");
$user=new UserController;
/**
* 
*/
class UserController
{
	public function __construct()
	{
		if (isset($_POST['inc'])) $this->addViews();
	}

	public function addViews()
	{
		$book=htmlspecialchars($_POST['book']);
		$bookauthor=htmlspecialchars($_POST['bookauthor']);

		ContentModel::updateViews($book,$bookauthor);
	}
}

?>