<?php
define("DB_NAME", "webfinal");
define("DB_PORT", 3306);
define("DB_USER", "webfinal_24");
define("DB_PASSWORD", "web24finPWD");
define("DB_HOST", "db1.ibu.edu.ba");
class ExamDao {

    protected $connection;

    /**
     * constructor of dao class
     */
    public function __construct(){
        try {
          /** TODO
           * List parameters such as servername, username, password, schema. Make sure to use appropriate port
           */
          //listed them above since code looks neater
          /** TODO
           * Create new connection
           */
          $options=[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
          ];
          $this->connection = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT,
            DB_USER,
            DB_PASSWORD, 
            $options
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    /** TODO
     * Implement DAO method used to get customer information
     */
    public function get_customers(){
      $query = 'SELECT id, first_name, last_name FROM customers';
      $statement = $this->connection->query($query);
      $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $customers;
    }

    /** TODO
     * Implement DAO method used to get customer meals
     */
    
     public function get_customer_meals($customer_id) {
      $query = '
          SELECT 
              foods.name AS food_name, 
              foods.brand AS food_brand, 
              meals.created_at AS meal_date
          FROM 
              meals
          JOIN 
              foods 
          ON 
              meals.food_id = foods.id
          WHERE 
              meals.customer_id = :customer_id
      ';
      $statement = $this->connection->prepare($query);
      $statement->bindParam(':customer_id', $customer_id);
      $statement->execute();
      $meals = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $meals;
  }  

    /** TODO
     * Implement DAO method used to save customer data
     */
    public function add_customer($data){
      $query = "INSERT INTO customers (first_name, last_name, birth_date)
                  VALUES (:first_name, :last_name, :birth_date)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':first_name', $data['first_name']);
        $statement->bindParam(':last_name', $data['last_name']);
        $statement->bindParam(':birth_date', $data['birth_date']);
        $statement->execute();
        return $this->connection->lastInsertId();
    }

    /** TODO
     * Implement DAO method used to get foods report
     */
    public function get_foods_report(){
      $query = 'SELECT id, name, brand, image_url FROM foods';
      $statement = $this->connection->query($query);
      $foods = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $foods;
  }
  
  
}
?>
