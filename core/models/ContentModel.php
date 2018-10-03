<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/core/config/connect_files.php");
/**
 * Работа с контентом, формирование данных для сайдбара, header, и прочее
 */
class ContentModel
{
    
    public function BookOnIndex($table)
    {
        $result = /*array_reverse*/ (R::getAll("SELECT * FROM $table ORDER BY viewed DESC LIMIT 10"));
        return ($result);
    }
    
    public function ShowMenu($cat = null)
    {
        $result = R::getAll("SELECT DISTINCT category.category,class FROM books Inner JOIN category ON books.category=category.id ORDER BY category.category");
        if (!empty($_SESSION['user_valid'])) {
            $vip    = R::getAll("SELECT DISTINCT category.category,class FROM techniques Inner JOIN category ON techniques.category=category.id ORDER BY category.category");
            $result = array_merge($result, $vip);
        }
        $res = array();
        foreach ($result as $l) {
            $res[$l['category']][] = $l['class'];
        }
        
        return $res;
    }
    public function updateViews($book = null, $bookauthor = null)
    {
        $sql = R::getAll('SELECT * FROM books WHERE name LIKE :book AND author LIKE :bookauthor', array(
            ':book' => $book,
            ':bookauthor' => $bookauthor
        ));
        if (empty($sql)) {
            R::exec('UPDATE techniques SET viewed = viewed+1 WHERE name LIKE :book AND author LIKE :bookauthor', array(
                ':book' => $book,
                ':bookauthor' => $bookauthor
            ));
        } else {
            R::exec('UPDATE books SET viewed = viewed+1 WHERE name LIKE :book AND author LIKE :bookauthor', array(
                ':book' => $book,
                ':bookauthor' => $bookauthor
            ));
        }
        
    }
    
    public function getAuthor()
    {
        if (isset($_GET['author'])) {
            $author = htmlspecialchars($_GET['author']);
            $result = R::getAll("SELECT DISTINCT author FROM books WHERE author LIKE :author", array(
                ':author' => $author . '%'
            ));
            if (!empty($_SESSION['user_valid'])) {
                $vip    = R::getAll("SELECT DISTINCT author FROM techniques WHERE author LIKE :author", array(
                    ':author' => $author . '%'
                ));
                $result = array_merge($result, $vip);
            }
            $result = array_unique($result, SORT_REGULAR);
            return ($result);
        }
        return $result;
    }
    
    public function ShowAuthors($category = null)
    {
        $result = R::getAll("SELECT DISTINCT author FROM books ORDER BY author ");
        if (!empty($_SESSION['user_valid'])) {
            $vip    = R::getAll("SELECT DISTINCT author FROM techniques ORDER BY author");
            $result = array_merge($result, $vip);
        }
        $result = array_unique($result, SORT_REGULAR);
        foreach ($result as $c => $key)
            $sort_cat[] = $key['author'];
        array_multisort($sort_cat, SORT_ASC, $result);
        return ($result);
    }
    
    public function categoryname($category = null)
    {
        if ((isset($category)) && (empty($_GET['authors']))) {
            if (empty($_SESSION['user_valid'])) {
                $sql = R::getAll("SELECT category from category WHERE category IN (SELECT :category FROM books) ", array(
                    ':category' => $category
                ));
                foreach ($sql as $key => $value) {
                    return $value['category'];
                }
            } else {
                $sql = R::getAll("SELECT category from category WHERE category = ? ", array(
                    $category
                ));
                foreach ($sql as $key => $value) {
                    return $value['category'];
                }
            }
        } elseif (isset($_GET['authors'])) {
            $author = htmlspecialchars($_GET['authors']);
            return 'Книги автора:' . $author;
        } else {
            return 'Таких данных не существует, либо у вас нет доступа!';
        }
    }
    
    public function detailsBook()
    {
        $bookauthor = htmlspecialchars($_GET['bookauthor']);
        $bookname   = htmlspecialchars($_GET['book']);
        if (isset($_SESSION['user_valid'])) {
            $sql = R::getAll('SELECT * FROM techniques INNER JOIN category ON techniques.category=category.id WHERE name LIKE :bookname AND author LIKE :author LIMIT 1', array(
                ":bookname" => $bookname,
                ':author' => $bookauthor
            ));
        }
        
        if (empty($sql)) {
            $sql = R::getAll('SELECT * FROM books INNER JOIN category ON books.category=category.id WHERE name LIKE :bookname AND author LIKE :author LIMIT 1', array(
                ":bookname" => $bookname,
                ':author' => $bookauthor
            ));
        }
        
        return $sql;
    }
    
}
?>