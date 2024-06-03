#!/usr/local/bin/php
<?php
$conn = null;

try {
   // Establish connection to db
   $dsn = "mysql:host=$host;charset=utf8mb4";
   $conn = new PDO($dsn, $user, $passwd, [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
   ]);

   // Create database
   $res = $conn->exec("CREATE DATABASE IF NOT EXISTS sampledb");
   echo "Database created successfully" . PHP_EOL;

   // Change database to sampldb
   $conn->exec("USE sampledb");
   echo "Database changed" . PHP_EOL;
   
   // Create table
   $sql = file_get_contents("create_table.sql");
   $conn->exec($sql);
   echo "Table created successfully" . PHP_EOL;

   if (!$isDryRun) {
      import_data();
   }

} catch (PDOException $ex) {
   echo 'Database error: ' . $ex->getMessage() . PHP_EOL;
   exit;
}

function import_data() {
   global $conn;

   $data = validate_data();
   $stmt = $conn->prepare(
      "INSERT INTO users (name, surname, email) VALUES (:name, :surname, :email)"
   );

   foreach ($data as $row) {
      try {
         $stmt->execute([
            ':name'     => $row['name'],
            ':surname'  => $row['surname'],
            ':email'    => $row['email']
         ]);
      } catch (PDOException $ex) {
         echo "Error inserting data: " . $ex->getMessage() . "\n";
      }
   }
   echo "Data imported successfully" . PHP_EOL;
}

function validate_data() {
   global $file;
   $header = array();
   $data = array();
   $validate = (object) ['hasError' => false, 'email' => null];

   if (false !== ($handle = fopen($file, 'r'))) {
      while (false !== ($line = fgetcsv($handle, 1000, ','))) {
         
         if (empty($header)) {
            $header = $line;
            $header[2] = trim($line[2]); // email right trim
            continue;
         }

         // Fix up data - name & surname to upper case first letter; email to lower case
         array_walk($line, function (&$val, $key) {
            $val = rtrim($key === 2 ? strtolower($val) : ucfirst(ucfirst($val)));
         });

         $row = array_combine($header, $line);
         
         // Validate email
         if (!filter_var($row['email'], FILTER_VALIDATE_EMAIL)) {
            $validate->hasError = true;
            $validate->email = $row['email'];
            break;
         }
         $data[] = $row;
      }
      fclose($handle);
   }
   
   // Fail if any validation errors occurred
   if ($validate->hasError) {
      echo "Error in data file. Invalid email format: $validate->email" . PHP_EOL;
      exit(1);
   }
   return $data;
}
?>