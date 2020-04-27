<?php

require_once '../model/model.php';
require_once '../view/view.php';
require_once '../utils/ChromePhp.php';

class Controller
{
    private $view;
    private $model;

    public function __construct(){
             ChromePhp::log("getting");
    	$this->model = new Model ();
        $this->view = new View();
    }

    public function service() {

	   if (isset($_GET['action']) && !empty($_GET['action'])) {

      if ($_GET['action'] == "getUser") {
        $this->{$_GET['action']}($_GET['user']);
      } else if ($_GET['action'] == "getBook") {
     	  $this->{$_GET['action']}($_GET['title']);
      } else if ($_GET['action'] == "getAllStudents") {
      	$this->{$_GET['action']}();
      }  else if ($_GET['action'] == "getAllBooks") {
        $this->{$_GET['action']}();
      } else if ($_GET['action'] == "getAllLentBooks") {
        $this->{$_GET['action']}();
      } else if ($_GET['action'] == "getAvailableBooks") {
        $this->{$_GET['action']}();
      } else if ($_GET['action'] == "searchBooks") {
        $this->{$_GET['action']}($_GET['query']);
      }
    }

  if (isset($_POST['action']) && !empty($_POST['action'])) {
    if ($_POST['action'] == "addStudent"){
      $this->{$_POST['action']}($_POST['name'], $_POST['password'], $_POST['groupId']);
    } else if ($_POST['action'] == "removeStudent"){
      $this->{$_POST['action']}($_POST['id']);
    } else if ($_POST['action'] == "updateStudent"){
      $this->{$_POST['action']}($_POST['id'], $_POST['name'], $_POST['password'], $_POST['groupId']);
    } else if ($_POST['action'] == "addBook"){
      $this->{$_POST['action']}($_POST['author'], $_POST['title'], $_POST['publisher'], $_POST['genre']);
    } else if ($_POST['action'] == "removeBook"){
      $this->{$_POST['action']}($_POST['id']);
    } else if ($_POST['action'] == "updateBook"){
      $this->{$_POST['action']}($_POST['id'], $_POST['author'], $_POST['title'], $_POST['publisher'], $_POST['genre']);
    } else if ($_POST['action'] == "lendBook"){
      $this->{$_POST['action']}($_POST['bid'], $_POST['sid']);
    } else if ($_POST['action'] == "returnBook"){
      $this->{$_POST['action']}($_POST['bid']);
    }
  }

}
  public function searchBooks($query){
    $books = $this->model->searchBooks($query);
    return $this->view->output($books);
  }

  public function getAllLentBooks(){
    $books = $this->model->getAllLentBooks();
    return $this->view->output($books);
  }

  public function getAvailableBooks(){
    $books = $this->model->getAvailableBooks();
    return $this->view->output($books);
  }

  public function lendBook($bid, $sid) {
    $this->model->lendBook($bid, $sid);
  }

  public function returnBook($bid) {
    $this->model->returnBook($bid);
  }

    public function getUser($user) {
	   $student = $this->model->getStudent($user);
	   return $this->view->output($student);
    }

    public function getBook($title) {
     $book = $this->model->getBookWithTitleLike($title);
     return $this->view->output($book);
    }

    public function getAllStudents() {
      $students = $this->model->getAllStudents();
      return $this->view->output($students);
    }

    public function getAllBooks() {
      $books = $this->model->getAllBooks();
      return $this->view->output($books);
    }

    public function addStudent($name, $password, $groupId) {
      $this->model->addStudent($name, $password, $groupId);
    }

    public function removeStudent($id) {
      $this->model->removeStudent($id);
    }

    public function updateStudent($id, $name, $password, $groupId){

      $this->model->updateStudent($id, $name, $password, $groupId);
    }

    public function addBook($author, $title, $publisher, $genre) {
      $this->model->addBook($author, $title, $publisher, $genre);
    }

    public function removeBook($id) {
      $this->model->removeBook($id);
    }

    public function updateBook($id, $author, $title, $publisher, $genre){
      $this->model->updateBook($id, $author, $title, $publisher, $genre);
    }
}

$controller = new Controller();
$controller->service();

?>
