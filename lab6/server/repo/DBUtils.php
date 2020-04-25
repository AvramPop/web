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

		public function selectBook($title) {
					$stmt = $this->pdo->query("SELECT * FROM Books where title='" . $title ."'");
					return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}

    public function selectAllStudents() {
    	$stmt = $this->pdo->query("SELECT * FROM Students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

		public function selectAllBooks() {
			$stmt = $this->pdo->query("SELECT * FROM Books");
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

	public function insertBook($id, $author, $title, $publisher, $genre) {
		$affected_rows = $this->pdo->exec("INSERT into Books values('". $id ."', '". $author ."', '". $title ."', '". $publisher ."', '". $genre ."', NULL)");
		return $affected_rows;
	}

	public function deleteBook($id) {
		$affected_rows = $this->pdo->exec("DELETE from Books where id=" . $id);
		return $affected_rows;
	}

	public function updateBook ($id, $author, $title, $publisher, $genre) {
		$affected_rows = $this->pdo->exec("UPDATE Books SET author='" . $author ."', title = '" . $title ."', publisher = '" . $publisher ."', genre =  '" . $genre ."' where id=" . $id);

	}
}


?>
