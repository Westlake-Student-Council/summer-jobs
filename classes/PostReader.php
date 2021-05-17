<?php
require_once 'DatabaseConnection.php';

class PostReader {
	protected $pdo = null;

	public function __construct()
	{
		$this->pdo = DatabaseConnection::instance();
	}

	public function getVisiblePosts(): ?array
	{
		$sql =
		   "SELECT  *
			FROM    posts
            WHERE   is_visible = true
			ORDER   BY business_name DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if(!$posts) {
			return null;
		}
		else {
			return $posts;
		}
    }

    public function getPosts(): ?array
	{
		$sql =
		   "SELECT  *
			FROM    posts
			ORDER   BY business_name DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if(!$posts) {
			return null;
		}
		else {
			return $posts;
		}
    }

}
?>
