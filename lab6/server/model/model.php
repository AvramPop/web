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

	public function getBookWithTitleLike($data) {
		$resultset = $this->db->selectBooksWithIdentifierLike('title', $data);
			//var_dump($resultset);
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

	// public function getAllGrades() {
	// 	$resultset = $this->db->selectAllStudents();
	// 	$students = array();
	// 	foreach($resultset as $key=>$val) {
	// 		$stud = $val;
	//
	//     	$grades = $this->db->selectGradeForStudent($stud['id']);
	//     	$stud['grades'] = $grades;
	//
	//     	array_push($students, $stud);
	// 	}
	//
	//     return $students;
	// }

}

?>
