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
	public function getBookWithTitleLike($data) {
		$resultset = $this->db->selectBooksWithIdentifierLike('title', $data);
				$book = new Book($resultset[0]['id'], $resultset[0]['author'], $resultset[0]['title'], $resultset[0]['publisher'], $resultset[0]['genre'], $resultset[0]['borrower_id']);
				return $book;
	}

	public function getAllStudents() {
		$resultset = $this->db->selectAllStudents();
		ChromePhp::log($resultset);
		$students = array();
		foreach ($resultset as $key => $value) {
			array_push($students, $value);
		}
		ChromePhp::log($students);
		return $students;
	}

	public function getAllBooks() {
		$resultset = $this->db->selectAllBooks();
		ChromePhp::log($resultset);
		$books = array();
		foreach ($resultset as $key => $value) {
			array_push($books, $value);
		}
		ChromePhp::log($books);
		return $books;
	}
}

?>
