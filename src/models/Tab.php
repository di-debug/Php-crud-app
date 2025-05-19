<?php

class Tab {
    private $id;
    private $name;

    public function __construct($name, $id = null) {
        $this->name = $name;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function save($conn) {
        if ($this->id) {
            $stmt = $conn->prepare("UPDATE tabs SET name = ? WHERE id = ?");
            $stmt->bind_param("si", $this->name, $this->id);
        } else {
            $stmt = $conn->prepare("INSERT INTO tabs (name) VALUES (?)");
            $stmt->bind_param("s", $this->name);
        }
        return $stmt->execute();
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM tabs WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function findAll($conn) {
        $result = $conn->query("SELECT * FROM tabs");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function findById($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM tabs WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}