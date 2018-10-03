<?php
require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");
$mainobj=new PaginateController;

/*Отвечает за пагинацию, работает с AJAX запросами
Принимает данные для сортировки автора и вывода паггинации
Кодирует все массивы данных в content.json*/

class PaginateController
{
	public $content;

	function __construct()
	{
		$this->content=new PagginateModel;
		$this->DataGet();
		if (isset($_GET['getpages'])) {$this->SortData($_GET['getpages']);}	
		if (isset($_GET['countpages'])) {$this->CountPages();}	
	}

	public function DataGet()
	{
			$arr=$this->content->paggination();
			$arr=json_encode($arr);
          $json_file=fopen(ROOT.'/public/libs/content.json','w');
          file_put_contents(ROOT.'/public/libs/content.json',$arr);
          fclose($json_file);
	}

	public function SortData($sort_val)
	{
		$sort_val=htmlspecialchars($sort_val);
			$arr=$this->content->paggination($sort_val);
        //  echo json_encode($arr);
			$arr=json_encode($arr);
          $json_file=fopen(ROOT.'/public/libs/content.json','w');
          file_put_contents(ROOT.'/public/libs/content.json',$arr);
          fclose($json_file);
	}

}




?>
