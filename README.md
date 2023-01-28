# Backup Sail's Database

## Requirements
- PHP >= 8.0
- Laravel >= 9.0

## Installation
```
composer require revolution/sail-db-backup --dev
```

## Usage
Be sure to run the command in Sail.
```
vendor/bin/sail art sail:backup:mysql
```

The SQL file will be saved in `/mysql_backup`.(Same as Homestead)

If you want to change the `mysql_backup`
```
sail art sail:backup:mysql --path=database/backup
```

## Global .gitignore
Recommend exclusion in global .gitignore

```
mysql_backup
```

## LICENSE
MIT
