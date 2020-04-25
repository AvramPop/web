<?php

require_once '../model/model.php';
require_once '../view/view.php';
require_once '../utils/ChromePhp.php';

class Controller
{
    private $view;
    private $model;

    public function __construct(){
    	$this->model = new Model ();
        $this->view = new View();
    }

    public function service() {
	   if (isset($_GET['action']) && !empty($_GET['action'])) {
ChromePhp::log($_GET['action']);
            if ($_GET['action'] == "getUser") {
              ChromePhp::log($_GET['user']);

   	            $this->{$_GET['action']}($_GET['user']);
          } else if ($_GET['action'] == "getBook") {
            ChromePhp::log($_GET['title']);

               	$this->{$_GET['action']}($_GET['title']);
	         }
    }
  }

    public function getUser($user) {
	   $student = $this->model->getStudent($user);
     ChromePhp::log('getting users', $student);

	   return $this->view->output($student);
    }

    public function getBook($title) {
     $book = $this->model->getBook($title);
     ChromePhp::log('getting book', $book);

     return $this->view->output($book);
    }
}

$controller = new Controller();
$controller->service();

?>
