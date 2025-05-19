<?php
class Slide {
    private $id;
    private $title;
    private $description;
    private $image;
    private $tab_id;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO slides (title, description, image, tab_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $this->title, $this->description, $this->image, $this->tab_id);
        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM slides WHERE tab_id = ? ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->tab_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update() {
        $query = "UPDATE slides SET title = ?, description = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $this->title, $this->description, $this->image, $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM slides WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setTabId($tab_id) {
        $this->tab_id = $tab_id;
    }
}
?>