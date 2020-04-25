<?php
require_once '../utils/ChromePhp.php';

class Book implements JsonSerializable {
	private $id;
	private $author;
	private $title;
	private $publisher;
  private $genre;
  private $borrower_id;

	public function __construct($id, $author, $title, $publisher, $genre, $borrower_id) {
		$this->id = $id;
    $this->author = $author;
    $this->title = $title;
    $this->publisher = $publisher;
    $this->genre = $genre;
    $this->$borrower_id = $borrower_id;
	}

	public function getId() {
		return $this->id;
	}
	public function getTitle() {
		return $this->title;
  }

  	public function getAuthor() {
  		return $this->author;
  	}
  	public function getPublisher() {
  		return $this->publisher;
    }

    	public function getGenre() {
    		return $this->genre;
    	}
    	public function getBorrower() {
    		return $this->borrower_id;
      }

	public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}

?>
