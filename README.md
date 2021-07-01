# Backup Sail's Database

## Requirements
- PHP >= 7.4
- Laravel >= 8.0

## Installation
```
composer require revolution/sail-db-backup
```

## Usage
Be sure to run the command in Sail.
```
vendor/bin/sail art sail:backup:mysql
```

The SQL file will be saved in `/mysql_backup`.(Same as Homestead)

If you want to change the `mysql_backup`
```
sail art sail:backup:mysql--path=database/backup
```

## LICENSE
MIT
