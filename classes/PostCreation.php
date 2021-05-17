<?php
require_once 'DatabaseConnection.php';

class PostCreation
{
    protected $pdo = null;
    private $business_name;
    private $position_name;
    private $pay;
    private $min_age;
	private $job_application_link;
    private $indeed_link;
    private $location;

	public function __construct()
    {
        $this->pdo = DatabaseConnection::instance();
		$this->business_name = "";
        $this->position_name = "";
        $this->pay = "";
        $this->min_age = "";
	    $this->job_application_link = "";
        $this->indeed_link = "";
        $this->location = "";
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

    public function setIsVisible(string $is_visible): string
	{
        $this->is_visible = $is_visible;
        return "";
	}

    public function addPost(): bool
    {
		$sql = "INSERT INTO posts (business_name, position_name, pay, min_age, job_application_link, indeed_link, location)
			VALUES (:business_name, :position_name, :pay, :min_age, :job_application_link, :indeed_link, :location)";
		$stmt = $this->pdo->prepare($sql);
		$status = $stmt->execute(
			[
                'business_name' => $this->business_name,
				'position_name' => $this->position_name,
                'pay' => $this->pay,
				'min_age' => $this->min_age,
                'question' => $this->question,
				'job_application_link' => $this->job_application_link,
                'indeed_link' => $this->indeed_link,
                'location' => $this->location
			]);

		return $status;
	}
}
?>
