<?php
// Display the help message
fwrite(STDOUT, "Usage: php path/to/csv/file" . PHP_EOL);
echo "Options:" . PHP_EOL;
echo "  -h, --help            Displays the help message" . PHP_EOL;
echo "  -f, --file            Specify the CSV file name" . PHP_EOL;
echo "  -c, --create-table    Specify whether the MySQL users table should be built" . PHP_EOL;
echo "  -u, --user            MySQL username" . PHP_EOL;
echo "  -p, --password        MySQL password" . PHP_EOL;
echo "  -H, --host            MySQL host" . PHP_EOL;
echo "  -v, --verbose         Outputs more detailed information about a particular operation or process." . PHP_EOL;
echo "  -V, --version         Version number" . PHP_EOL;