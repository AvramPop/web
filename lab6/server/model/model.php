<?php

require_once '../repo/DBUtils.php';
require_once 'student.php';
require_once 'book.php';
require_once '../utils/ChromePhp.php';


class Model {
	private $db;

	public function __construct() {
		$this->db = new DBUtils ();
	}

	public function getStudent($data) {
		$resultset = $this->db->selectStudent($data);
	    //var_dump($resultset);
        $student = new Student($resultset[0]['id'], $resultset[0]['name'], $resultset[0]['password'], $resultset[0]['group_id']);
        return $student;
	}

	public function addStudent($name, $password, $groupId){
		$this->db->insertStudent($name, $password, $groupId);
	}

	public function updateStudent($id, $name, $password, $groupId){
		$this->db->updateStudent($id, $name, $password, $groupId);
	}

	public function removestudent($id){
		$this->db->deleteStudent($id);
	}


	public function addBook($author, $title, $publisher, $genre){
		$this->db->insertBook($author, $title, $publisher, $genre);
	}

	public function updateBook($id, $author, $title, $publisher, $genre){
		$this->db->updateBook($id, $author, $title, $publisher, $genre);
	}

	public function removeBook($id){
		$this->db->deleteBook($id);
	}

		public function inArray($value, $list){
			foreach ($list as $item) {
				if($item['id'] == $value['id']) return true;
			}
			return false;
		}

	public function searchBooks($query) {
				$books = array();
				$resultset = $this->db->selectBooksWithIdentifierLike('author', $query);
				foreach ($resultset as $key => $value) {
					if($this->inArray($value, $books) == false){
					 array_push($books, $value);
				 }
				}
				$resultset = $this->db->selectBooksWithIdentifierLike('title', $query);
				foreach ($resultset as $key => $value) {
					if($this->inArray($value, $books) == false){
					array_push($books, $value);
				}
				}
				$resultset = $this->db->selectBooksWithIdentifierLike('publisher', $query);
				foreach ($resultset as $key => $value) {
					if($this->inArray($value, $books)  == false){
					array_push($books, $value);
				}
				}
				$resultset = $this->db->selectBooksWithIdentifierLike('genre', $query);
				foreach ($resultset as $key => $value) {
					if($this->inArray($value, $books)  == false){
					array_push($books, $value);
				}
				}
				return $books;
	}


	public function getAllLentBooks(){
		$resultset = $this->db->getAllLentBooks();
		$books = array();
		foreach ($resultset as $key => $value) {
			array_push($books, $value);
		}
		return $books;
	}

	public function getAvailableBooks(){
		$resultset = $this->db->getAvailableBooks();
		$books = array();
		foreach ($resultset as $key => $value) {
			array_push($books, $value);
		}
		return $books;
	}

	public function lendBook($bid, $sid) {
		$this->db->lendBook($bid, $sid);
	}

	public function returnBook($bid) {
		$this->db->returnBook($bid);
	}

	public function getAllStudents() {
		$resultset = $this->db->selectAllStudents();
		$students = array();
		foreach ($resultset as $key => $value) {
			array_push($students, $value);
		}
		return $students;
	}

	public function getAllBooks() {
		$resultset = $this->db->selectAllBooks();
		$books = array();
		foreach ($resultset as $key => $value) {
			array_push($books, $value);
		}
		return $books;
	}
}

?>
