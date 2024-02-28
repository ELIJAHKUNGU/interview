### Explain the difference between single-quoted and double-quoted strings in PHP. Provide examples of when you would use each.
double-quoted strings will evaluate and parse any variables or escape sequences(\n, \t) within the string while Single-quoted strings will output each character exactly as specified.

```
<?php>
// Example:
// Double-quoted string :
 echo "This is a newline \n"; // Output: This is a newline followed by a new line
// Single-quoted string : 
echo 'This is a newline \n'; // Output: This is a newline \n

?>
```

### 2. Describe the principles of Object-Oriented Programming (OOP) in PHP. How do you define a class and create objects in PHP? Provide an example of a class and its instantiation.
OOP - object-oriented programming is about creating objects that contain both data and functions.  helps to keep the PHP code DRY "Don't Repeat Yourself".
A class - template for objects 
A objects -
```
<?php
// Define the Person class
class Person {
    // Properties
    public $name;
    public $age;
    
    // Constructor
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
    
    // Method
    public function greet() {
        return "Hello, my name is $this->name and I am $this->age years old.";
    }
}

// Create objects (instances) of the Person class
$person1 = new Person("Alice", 30);
$person2 = new Person("Bob", 25);

// Accessing properties and calling methods
echo $person1->greet(); // Output: Hello, my name is Alice and I am 30 years old.
echo $person2->greet(); // Output: Hello, my name is Bob and I am 25 years old.


?>

```




### 3. Explain the purpose of exception handling in PHP. How do you catch and handle exceptions in your code? Provide an example of how you would use try-catch blocks.

### 4. Discuss different methods for connecting to a database in PHP. Describe the differences between MySQLi and PDO. Provide an example of how to perform a basic database query using one of these methods.

### 5. How would you protect a PHP application from common security vulnerabilities such as SQL injection and cross-site scripting (XSS)? Provide code examples or best practices for mitigating these threats.

### 6. Compare and contrast the major cloud service providers (e.g., AWS, Azure, Google Cloud). Describe the advantages and use cases for each. If you were to deploy a PHP application, which cloud provider would you choose, and why?

### 7. Explain the concept of Infrastructure as Code and its importance in cloud infrastructure management. Provide an example of how you would define infrastructure components using a tool like Terraform or AWS CloudFormation.

### 8. Write a PHP function that takes an array of integers and returns the sum of all even numbers in the array.

### 9. Create a PHP script that reads a text file, counts the number of words in the file, and displays the result. Ensure that your code handles file open and read errors gracefully.

### 10. Using PHP, make a GET request to a sample REST API (e.g., JSONPlaceholder) to retrieve a list of users. Parse the JSON response and display the user's name and email address.
### 11. Describe how you would design an auto-scaling setup in AWS to handle a PHP application with fluctuating traffic. What services and features would you use, and provide a high-level architecture diagram if possible.

Advanced questions:

### 12. Write a PHP script that performs asynchronous processing using a message queue system like RabbitMQ or Redis. The script should receive a task (e.g., an email sending request) and process it in the background without blocking the main application. Demonstrate how you would set up the message queue and create a worker script to handle the tasks.

### 13. Write a PHP script that serializes a large data structure (e.g., an array or object), compresses it, saves it to a file, and then unserializes and decompresses the data from the file. You can use standard PHP functions for serialization and a compression library like zlib to achieve this.

### 14. Write a PHP script that integrates with a REST API protected by OAuth 2.0 authentication. Implement the OAuth 2.0 authorization code flow to obtain an access token and use that token to make authenticated requests to the API. Provide a code example that demonstrates the complete authentication and data retrieval process.

### 15. Develop a PHP application that connects to an MS SQL Server database, retrieves data from multiple tables, performs a complex SQL query to join and aggregate data, and then returns the results as JSON. Demonstrate proper error handling and security measures in your code.