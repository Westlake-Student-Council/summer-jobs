<?php
require_once 'DatabaseConnection.php';

class PostDeletion
{
    protected $pdo = null;
    private $post_id;

	public function __construct($post_id)
    {
        $this->pdo = DatabaseConnection::instance();
		$this->post_id = $post_id;
	}

    public function deletePost(): bool
    {
		$sql = 
            "DELETE FROM 
                posts 
            WHERE 
                post_id = :post_id";
		$stmt = $this->pdo->prepare($sql);
		$status = $stmt->execute(
			[
                'post_id' => $this->post_id
			]);

		return $status;
	}
}
?>
