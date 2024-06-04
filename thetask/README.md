# Overview

demo/thetask is a PHP script that gets executed from the command line. It reads a CSV data file from a given path, validates and processes it, then imports the data into a MySQL database.

## Prerequisites

* Ubuntu 2.04
* PHP 8.1.*
* MySQL database server 5.7+

# Using the script

Executed the script with the following command:

```
php ./user_upload.php --file <filename>
```

Execute the script and build database and table, and populate the database.

```
php ./user_upload.php --file <filename> --create-table -u<user> -p<password> -h<host>
```

Execute the script and build database and table, without populating the database.

```
php ./user_upload.php --file <filename> --create-table -u<user> -p<password> -h<host> --dry-run
```

Show help:

```
php ./user_upload.php --help
```

Display version:

```
php ./user_upload.php --version
```

# List of Command Line Options

Following is a table illustrating the various command line options (directives) that could be passed to the script:

| Short | Long             | Description
| ----- | ---------------- | -----------
| -f    | --file           | Path and name of the CSV file
| -c    | --create_table   | Indicates that the MySQL database and table need to be built
| -u    | --user           | MySQL user
| -p    | --password       | MySQL password
| -H    | --host           | MySQL host
| -d    | --dry-run        | Run script without populating the database
| -h    | --help           | Show help message
| -v    | --version        | Show application version

# Limitations:

* When attempting to recreate database and tables, message says "Successful" though nothing got created.

* Command line options with long value (e.g. --user <user>) do not work, only the short ones, e.g -u<user>
