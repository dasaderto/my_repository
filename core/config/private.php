<?php require_once ( $_SERVER['DOCUMENT_ROOT']."/core/config/connect_files.php");

$url = $_SERVER['REQUEST_URI'];
$parse = (parse_url($url));

  if ((empty($_SESSION['user_valid']))||($_SESSION['user_valid'] ==1))
{
   if((stristr($parse['path'],'admin',true)=='/')||(stristr($parse['path'],'upload',true)=='/')||($parse['path']=='/views/admin/')){
   header('location: /error403/');
   }
}

if (($parse['path']=='/category/')&&(empty($parse['query']))) {header('location: /error404/');}
if (($parse['path']=='/search/')&&(empty($parse['query']))) {header('location: /error404/');}
if ($parse['path']=='/index.php') {header('location: /');}
if(($parse['path']=='/views/public/category.php')||($parse['path']=='/views/public/search.php')){header('location: /error404/');}
#if (stripos($parse['path'],'search')!==false) header('location: /search/ask-'.$_GET['search_list'].'/page-1');
?>