<? require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config/connect_files.php");
/*Модель паггинации
Отвечает за паггинацию
Формирует данные для жанров и авторов в header
категорий, поиска, и т.д. */

class PagginateModel
{
    public $lmt = 4;
    public $cat;
    public $table;
    public $classbytable;
    public $page;
    public $rank;
    public $author;
    public $sort;

    public function __construct()
    {
        if (isset($_GET['cat'])) {

            $this->cat = htmlspecialchars($_GET['cat']);
            $this->table = $this->TableToReturn();
            $this->classbytable = 'class';
        }

        isset($_GET['page']) ? $this->page = $_GET['page'] : $this->page = 1;

        if (isset($_GET['class']))  $this->rank = htmlspecialchars($_GET['class']);
        if (isset($_GET['authors'])) $this->author = htmlspecialchars($_GET['authors']);
    }

    public function TableToReturn()
    {
        $cat = $this->cat;
        if (isset($_GET['class'])) {
            $class = htmlspecialchars($_GET['class']);
        } else {
            if (!empty($_SESSION['user_valid'])) {
                return 'books';
            }

        }
        if ((isset($cat)) && (isset($class))) {
            $sql = R::getAll('SELECT * FROM books INNER JOIN category ON books.category=category.id WHERE category.category LIKE :cat AND class LIKE :class',
                array(':cat' => $cat,':class' => $class));
        }
        empty($sql) ? $table = "techniques" : $table = "books";

        return $table;
    }

    public function paggination($sort=null)
    {

       $lmt = $this->lmt;
        if ($sort=='Все') $sort=null;
        $this->sort=$sort;
        $page = $this->page;
        if (isset($_GET['search_list'])&& (!empty($_GET['search_list']))) {
            $ask = $_GET['search_list'];
            $parsed_sql = $this->QueryController($ask);
        } else {
            $parsed_sql = $this->QueryController();
        }
       /* $Count_pages = count($parsed_sql);
        $total = ceil($Count_pages / $lmt);
        if (empty($page) || $page < 0)
            $page = 1;
        if ($page > $total)
            $page = $total;
        $start = $page * $lmt - $lmt;
        if ($start < 0) $start = 0;*/
        #$result = array_slice($parsed_sql, $start, $lmt);

        return $parsed_sql;
    }

    public function QueryController($ask = null)
    {

            $rank = $this->rank;
            $author=$this->author;
            $table = $this->table;
            $classbytable = $this->classbytable;
            $cat = $this->cat;

        #try {
            if ((empty($rank)) && (is_null($ask)) && (!empty($cat))) {
                $arr = $this->GenrePag($cat);
                return($arr);
            } else if (isset($ask)) {
                $arr = $this->AskPag($ask);
                return $arr;
            } else if (!empty($author)) {
                $arr = $this->AuthorPag($author);
                return $arr;
            } else {
                try {
                    $arr = $this->StandPag($rank, $table, $cat, $classbytable);
                 }catch (Exception $e) {
                    #echo 'Вы не передали никаких данных!';
                    #die;
               }
               if (isset($arr)) return $arr;
                
            }
        /*} catch (Exception $e) {
            #echo "Обнаружена ошибка, перейдите на главную страницу, и повторите снова.";
        }*/
    }

    public function GenrePag($cat)
    {
        $sort=$this->sort;
        is_null($sort) ? $sort='' : $sort=" AND author LIKE '".$this->sort."%'";
        $all = R::getAll("SELECT * FROM books INNER JOIN category ON books.category=category.id WHERE category.category LIKE ? $sort",
            array($cat));
        if (!empty($_SESSION['user_valid'])) {
            $vip = R::getAll("SELECT * FROM techniques INNER JOIN category ON techniques.category=category.id WHERE category.category LIKE ? $sort",
                array($cat));
            $answer = $all + $vip;
        } else {
            $answer = $all;
        }
        return $answer;
    }

    public function AskPag($ask = null)
    {
         $sort=$this->sort;
        is_null($sort) ? $sort='' : $sort=" author LIKE '".$this->sort."%' AND ";
        $ask = trim($ask);echo $sort;
        $ask = htmlspecialchars($ask);
        if (empty($_SESSION['user_valid'])) {
            $answer = R::getAll("SELECT * FROM books INNER JOIN category ON books.category=category.id WHERE $sort name LIKE :ask OR author LIKE :ask OR about LIKE :ask ",
             array(":ask" => '%' . $ask . '%'));

        } else {
            $all = R::getAll("SELECT * FROM books INNER JOIN category ON books.category=category.id WHERE $sort name LIKE :ask OR author LIKE :ask",
                array(":ask" => '%' . $ask . '%'));
            $vip = R::getAll("SELECT * FROM techniques INNER JOIN category ON techniques.category=category.id WHERE $sort name LIKE :ask OR author LIKE :ask ",
                array(":ask" => '%' . $ask . '%'));

            $answer = array_merge($all, $vip);
        }
        return $answer;
    }

    public function AuthorPag($author)
    {
        
        $all = R::getAll("SELECT * FROM books INNER JOIN category ON books.category=category.id WHERE author LIKE :author ", 
            array(':author' => $author . '%'));
        if (!empty($_SESSION['user_valid'])) {
            $vip = R::getAll("SELECT * FROM techniques INNER JOIN category ON techniques.category=category.id WHERE author LIKE :author",
                array(':author' => $author . '%'));
            $answer = $all + $vip;
        } else {
            $answer = $all;
        }
        return $answer;
    }

    public function StandPag($rank, $table, $cat, $classbytable)
    {$sort=$this->sort;
        is_null($sort) ? $sort='' : $sort=' AND author LIKE "'.$this->sort.'%"';
        $answer = R::getAll("SELECT * FROM books INNER JOIN category ON books.category=category.id WHERE category.category LIKE :cat AND $classbytable LIKE :rank $sort",
            array(':cat' => $cat, ':rank' => $rank));

        if (!empty($_SESSION['user_valid'])) {
            $vip=R::getAll("SELECT * FROM techniques INNER JOIN category ON techniques.category=category.id WHERE category.category LIKE :cat AND $classbytable LIKE :rank $sort",
            array(':cat' => $cat, ':rank' => $rank));
            $answer=array_merge($answer,$vip);
        }
        return $answer;
    }

    public function print_pages()
    {
        $TemplatePath = $this->parseURI();
        $lmt = $this->lmt;

        $page = intval($this->page);
        if (isset($_GET['search_list'])) {
            $ask = $_GET['search_list'];
            $parsed_sql = $this->QueryController($ask, null);
        } else {
            $parsed_sql = $this->QueryController();
        }
        $Count_pages = count($parsed_sql);
        $total = ceil($Count_pages / $lmt);
        if (empty($page) || $page < 0)
            $page = 1;
        if ($page > $total)
            $page = $total;
        if ($page != 1)
            $pervpage = "<li class=\"page-item\"><a href= " . $TemplatePath . "page-1>В начало</a></li> 
      <li><a href= " . $TemplatePath . "page-" . ($page - 1) . ">Предыдущая</a></li>";

        // Проверяем нужны ли стрелки вперед

        if ($page != $total)
            $nextpage = "<li><a href= " . $TemplatePath . "page-" . ($page + 1) . ">Следующая </a></li> 
                                   <li><a href= " . $TemplatePath . "page-" . $total . ">В конец</a></li>";

        // Находим две ближайшие станицы с обоих краев, если они есть

        if ($page - 2 > 0)
            $page2left = "<li><a href= " . $TemplatePath . "page-" . ($page - 2) . ">" . ($page - 2) . "</a></li>";
        if ($page - 1 > 0)
            $page1left = "<li><a href= " . $TemplatePath . "page-" . ($page - 1) . ">" . ($page - 1) . "</a></li>";
        if ($page + 2 <= $total)
            $page2right = "<li><a href= " . $TemplatePath . "page-" . ($page + 2) . ">" . ($page + 2) . "</a></li>";
        if ($page + 1 <= $total)
            $page1right = "<li><a href= " . $TemplatePath . "page-" . ($page + 1) . ">" . ($page + 1) . "</a></li>";

        // Вывод меню

        isset($pervpage) ? $pervpage : $pervpage = '';
        isset($page2left) ? $page2left : $page2left = '';
        isset($page1left) ? $page1left : $page1left = '';
        isset($page1right) ? $page1right : $page1right = '';
        isset($page2right) ? $page2right : $page2right = '';
        isset($nextpage) ? $nextpage : $nextpage = '';
        if ($total > 1)
            echo $pervpage . $page2left . $page1left . '<li class="active"><a href=\'#\'><b>' . $page . '</b></a></li>' . $page1right . $page2right . $nextpage;
    }

    public function parseURI()
    {
      /*  $url = $_SERVER['REQUEST_URI'];
        $parse = (parse_url($url));
        $URIpath = $parse['path'];
        isset($_GET['page']) ? $TemplatePath = stristr($URIpath, 'page', true) : $TemplatePath = $URIpath . '/';
        if (isset($_GET['search_list'])) {
            $TemplatePath = "/search/ask-" . $_GET['search_list'] . "/";
        }*/

        $url = $_SERVER['REQUEST_URI'];
  $parse = (parse_url($url));
  $URIpath = $parse['path'];
  $URIquery = parse_str($parse['query']);
  $TemplatePath = $URIpath . "?";
  if (filter_input(INPUT_SERVER, 'QUERY_STRING'))
    {
    foreach($_GET AS $key => $value)
      {
      if (($key != 'page') && (empty($value) == FALSE)) $TemplatePath.= "$key=" . urlencode($value) . "&";
      }
    }
        return urldecode($TemplatePath);
    }
}

?>