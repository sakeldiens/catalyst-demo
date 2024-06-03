#!/usr/local/bin/php
<?php
$version = "0.0.1";
$file = "";
$user = "";
$passwd = "";
$host = "";
$isDryRun = false;

// Command Line options
$shortopts = 'h::' . 'f:' . 'c' . 'u::' . 'p::' . 'H::' . 'd' . 'v';
$longopts = array("help::", "file:", "create-table", "user::", "password::", "host::", "dry-run", "version");
$options = getopt($shortopts, $longopts);

// Display help
if (isset($options['h']) || isset($options['help']) ) {
   include ('./display_help.php');
   exit(1);
}

// Display version
if (isset($options['v']) || isset($options['version']) ) {
   fwrite(STDOUT, "App version: $version" . PHP_EOL);
   exit(1);
}

// Path to CSV file
if (isset($options['f']) || isset($options['file']) ) {
   $file = isset($options['f']) ? $options['f'] : $options['file'];
   if (!file_exists($file) || !is_readable($file)) {
      echo "File does not exists or is not readable." . PHP_EOL;
      exit(1);
   }
} else {
   echo "No file option found. Pleace specify a file.";
   exit(1);
}

// Create tables and (optionally) populate it
if (isset($options['c']) || isset($options['create-table']) ) {
   global $file;
   
   if (isset($options['u']) || isset($options['user']) ) {
      $user = isset($options['u']) ? $options['u'] : $options['user'];
   }
   if (isset($options['p']) || isset($options['password']) ) {
      $passwd = isset($options['p']) ? $options['p'] : $options['password'];
   }
   if (isset($options['H']) || isset($options['host']) ) {
      $host = isset($options['H']) ? $options['H'] : $options['host'];
   }

   // Fail if either one of these options are empty
   if ($user === "" || $passwd === "" || $host === "") {
      echo "Insufficient argumets for create table. Please execute the script and provide the username, password and host of MySql." . PHP_EOL;
      echo "EXAMPLE: php ./import_users --create-table -u <user> -p <password> -H <host>"  . PHP_EOL;
      exit(1);
   }

   // Check for a dry run
   if (isset($options['d']) || isset($options['dry-run']) ) {
      $isDryRun = true;
   }

   // Create the table
   include ('./exec_mysql.php');
}
?>