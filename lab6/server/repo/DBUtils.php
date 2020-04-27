<?php


require_once '../utils/ChromePhp.php';

class DBUtils {
	private $host = '127.0.0.1';
	private $db   = 'library';
	private $user = 'root';
	private $pass = '';
	private $charset = 'utf8';

	private $pdo;
	private $error;

	public function __construct () {
		$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
		$opt = array(PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false);
		try {
			$this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);
		} // Catch any errors
		catch(PDOException $e){
			$this->error = $e->getMessage();
			echo "Error connecting to DB: " . $this->error;
		}
	}

	public function selectStudent($name) {
        $stmt = $this->pdo->query("SELECT * FROM Students where name='" . $name ."'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

		public function selectBooksWithIdentifierLike($identifier, $title) {
			ChromePhp::log("SELECT * FROM Books where title LIKE '%" . $title ."%'");
					$stmt = $this->pdo->query("SELECT * FROM Books where ". $identifier ." LIKE '%" . $title ."%'");

					return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}

    public function selectAllStudents() {
    	$stmt = $this->pdo->query("SELECT * FROM Students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

		public function selectAllBooks() {

			$stmt = $this->pdo->query("SELECT b.id, b.author, b.title, b.publisher, b.genre, s.name as borrowed_by FROM books b left join students s on b.borrower_id = s.id");
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}


	public function insertBook($author, $title, $publisher, $genre) {
		$affected_rows = $this->pdo->exec("INSERT into Books(`author`, `title`, `publisher`, `genre`, `borrower_id`) values('". $author ."', '". $title ."', '". $publisher ."', '". $genre ."', NULL)");
		return $affected_rows;
	}

	public function insertStudent($name, $password, $group_id) {
		$this->pdo->exec("INSERT INTO `students`(`name`, `password`, `group_id`) VALUES ('". $name ."', '". $password ."', ". $group_id .")");
	}

	public function deleteBook($id) {
		$affected_rows = $this->pdo->exec("DELETE from Books where id='". $id ."' ");
		return $affected_rows;
	}

	public function updateBook($id, $author, $title, $publisher, $genre){
		ChromePhp::log("UPDATE Books SET author = '". $author ."', title = '". $title ."', publisher = '". $publisher ."', genre = '". $genre ."' where id= ". $id ." ");
			$this->pdo->exec("UPDATE Books SET author = '". $author ."', title = '". $title ."', publisher = '". $publisher ."', genre = '". $genre ."' where id= ". $id ." ");
	}

	public function deleteStudent($id) {
		$affected_rows = $this->pdo->exec("DELETE from Students where id='". $id ."' ");
		return $affected_rows;
	}

	public function updateStudent($id, $name, $password, $groupId){
	//	ChromePhp::log("UPDATE Students SET name = '". $name ."', password = '". $password ."', group_id = ". $groupId ." where id= ". $id ." ");
			$this->pdo->exec("UPDATE Students SET name = '". $name ."', password = '". $password ."', group_id = ". $groupId ." where id= ". $id ." ");
	}

	public function lendBook ($id, $borrower_id) {
		$this->pdo->exec("UPDATE Books SET borrower_id = '". $borrower_id ."' where id= ". $id ." ");
	}
}


?>
