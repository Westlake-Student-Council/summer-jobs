<?php
require_once 'DatabaseConnection.php';

class PostUpdate
{
    protected $pdo = null;
    private $post_id;
    private $business_name;
    private $position_name;
    private $pay;
    private $min_age;
	private $job_application_link;
    private $indeed_link;
    private $location;
    private $is_visible;

    public function __construct($post_id)
    {
        $this->pdo = DatabaseConnection::instance();
        $this->post_id = $post_id;
        $this->business_name = "";
        $this->position_name = "";
        $this->pay = "";
        $this->min_age = "";
	    $this->job_application_link = "";
        $this->indeed_link = "";
        $this->location = "";
        $this->is_visible = 0;
    }

    public function loadCurrentPostDetails(): bool
    {
        $sql =
            "SELECT
                *
            FROM
                posts
            WHERE
                post_id = :post_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['post_id' => $this->post_id]);
        $post = $stmt->fetch();

        if ($post) {
            $this->business_name = $post["business_name"];
            $this->position_name = $post["position_name"];
            $this->pay = $post["pay"];
            $this->min_age = $post["min_age"];
	        $this->job_application_link = $post["job_application_link"];
            $this->indeed_link = $post["indeed_link"];
            $this->location = $post["location"];
            $this->is_visible = $post["is_visible"];

            return true;
        } else {
            return false;
        }
    }

    public function setBusinessName(string $business_name): string
	{
		if(empty($business_name)) {
			return "Please enter a business name.";
		}
		else {
			$this->business_name = $business_name;
			return "";
		}
	}

    public function setPositionName(string $position_name): string
	{
		if(empty($position_name)) {
			return "Please enter the position name.";
		}
		else {
			$this->position_name = $position_name;
			return "";
		}
	}

    public function setPay(string $pay): string
	{
		if(empty($pay)) {
			return "Please enter a pay estimate.";
		}
		else {
			$this->pay = $pay;
			return "";
		}
	}

    public function setMinAge(string $min_age): string
	{
		if(empty($min_age)) {
			return "Please enter an age minimum.";
		}
		else {
			$this->min_age = $min_age;
			return "";
		}
	}

    public function setJobApplicationLink(string $job_application_link): string
	{
        $this->job_application_link = $job_application_link;
        return "";
	}

    public function setIndeedLink(string $indeed_link): string
	{
        $this->indeed_link = $indeed_link;
        return "";
	}

    public function setLocation(string $location): string
	{
        $this->location = $location;
        return "";
	}


    public function setIsVisible($is_visible)
    {
        if($is_visible == "0") {
            $this->is_visible = 0;
        } else {
            $this->is_visible = 1;
        }
        
        return "";
    }

    public function updatePost(): bool
    {
        $sql =
            "UPDATE posts
            SET
                business_name = :business_name,
                position_name = :position_name,
                pay = :pay, 
                min_age = :min_age,
                job_application_link = :job_application_link, 
                indeed_link = :indeed_link, 
                location = :location,
                is_visible = :is_visible
            WHERE
                post_id = :post_id";
        $stmt = $this->pdo->prepare($sql);
        $status = $stmt->execute(
            [
                'business_name' => $this->business_name,
				'position_name' => $this->position_name,
                'pay' => $this->pay,
				'min_age' => $this->min_age,
				'job_application_link' => $this->job_application_link,
                'indeed_link' => $this->indeed_link,
                'location' => $this->location,
                'is_visible' => $this->is_visible,
                'post_id' => $this->post_id
            ]
        );
    
        return $status;
    }


    public function getBusinessName(): string
	{
		return $this->business_name;
	}

    public function getPositionName(): string
	{
		return $this->position_name;
	}

    public function getPay(): string
	{
		return $this->pay;
	}

    public function getMinAge(): string
	{
		return $this->min_age;
	}

    public function getJobApplicationLink(): string
	{
        return $this->job_application_link;
	}

    public function getIndeedLink(): string
	{
        return $this->indeed_link; 
	}

    public function getLocation(): string
	{
        return $this->location; 
	}

    public function getIsVisible(): bool 
    {
        return $this->is_visible;
    }
}
?>
