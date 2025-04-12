# DBMS-HW-6

## Requirements
- XAMPP (for Apache server, MySQL, and phpMyAdmin)
- A web browser

---

## How to set up the environment?
  ### 1. Download & Install XAMPP
    - Go to the official XAMPP website: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
    - Download the version best for your operating system

  ### 2. Launch XAAMP
    - Open the XAMPP Control Panel
    - Start the the following servers:
      - Apache
      - MySQL

  ### 3. Access phpMyAdmin
    - In the XAMPP Control Panel, clock **"Admin"** next to MySQL
    - This open **phpMyAdmin** in your web browser
    - From here, make sure the database 'supplierpartshipment' exists
      - If not, create it and import the necessary tables: supplier, shipment, part



## Running the Program
### 4. Place your files
  - Copy 'HW6.php', 'HW6.html', and 'HW6.css' into your XAMPP 'htdocs' folder: Example path: 'C:\xampp\htdocs\HW.php'

### 5. Edit Database Connection
  - In 'HW6.php', make sure the connection settings match your systems. Example:
    ```php
    $servername = "127.0.0.1:3308";
    $username = "root";
    $password = "";
    $dbname = "supplierpartshipment";
    $conn = new mysqli($servername, $username, $password, $dbname);


