<?php
class CrudController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Create a new tab
    public function createTab($name, $iconSvgPath = '') {
        $stmt = $this->db->prepare("INSERT INTO tabs (name, icon_svg) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $iconSvgPath);
        $stmt->execute();
        $stmt->close();
    }

    // Read all tabs
    public function readTabs() {
        $result = $this->db->query("SELECT * FROM tabs");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTabs() {
        $sql = "SELECT * FROM tabs";
        $result = $this->db->query($sql);
        $tabs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tabs[] = $row;
            }
        }
        return $tabs;
    }

    // Update a tab
    public function updateTab($id, $name) {
        $stmt = $this->db->prepare("UPDATE tabs SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }

    // Delete a tab
    public function deleteTab($id) {
        $stmt = $this->db->prepare("DELETE FROM tabs WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Create a new slide
    public function createSlide($title, $description, $image, $tabId) {
        $stmt = $this->db->prepare("INSERT INTO slides (title, description, image, tab_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $description, $image, $tabId);
        return $stmt->execute();
    }

    // Read all slides for a specific tab
    public function readSlides($tabId) {
        $stmt = $this->db->prepare("SELECT * FROM slides WHERE tab_id = ?");
        $stmt->bind_param("i", $tabId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllSlides() {
        $sql = "SELECT * FROM slides";
        $result = $this->db->query($sql);
        $slides = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $slides[] = $row;
            }
        }
        return $slides;
    }

    // Update a slide
    public function updateSlide($id, $title, $description, $image) {
        $stmt = $this->db->prepare("UPDATE slides SET title = ?, description = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $image, $id);
        return $stmt->execute();
    }

    // Delete a slide
    public function deleteSlide($id) {
        $stmt = $this->db->prepare("DELETE FROM slides WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>