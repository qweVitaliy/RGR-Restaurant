This project demonstrates a web application implementing a role-based authorization system with different levels of database access. 
Users can log in with their accounts, and depending on their roles, they are granted access to specific functionalities. 
The project also includes interaction with a database to display, edit, and view data.
### Main Features:
- **User Authorization:**
  - Login via a web form.
  - Password hashing (`password_hash`) for secure storage.
- **User Roles and Permissions:**
  - `global_admin`: Full access to all application features.
  - `db_full_admin`: Access to all database features except the administrators' table.
  - `db_admin`: Access to data manipulation without modifying the structure, excluding the administrators' and chefs' tables.
  - `table_admin`: Access to specific tables (clients, food, and orders) with data manipulation only.
  - `user`: View-only access to the list of dishes.
- **Application Pages:**
  - Login page.
  - Separate pages for each role with access to respective functionalities.
  - Table to display a list of dishes (accessible to guests).
- **Security Against Unauthorized Access:**
  - Sessions are used to identify authenticated users.
  - Page access is restricted based on roles.
  - 
  - ## How to Deploy the Project
1. **Set Up the Server Environment:**
   - Install [XAMPP](https://www.apachefriends.org/).
   - Start Apache and MySQL.

2. **Import the Database:**
   - Create a new database, e.g., `volodkovs_lab2`.
   - Import the SQL file with the tables and test data.

3. **Configure Database Connection:**
   - Edit the `includes/db.php` file:
     ```php
     <?php
     $host = '127.0.0.1'; 
     $user = 'your_username';     
     $password = 'your_password';   
     $db_name = 'your_database_name'; 
     $conn = new mysqli($host, $user, $password, $db_name);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```

4. **Run the Project:**
   - Copy the project files into the `htdocs` folder in your XAMPP directory.
   - Access the application through your browser at `http://localhost/lab2`.
