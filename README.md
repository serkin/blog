#Simple blog


- no libraries
- no frameworks
- even no composer


## Installation
---

Clone repository

``` bash
git clone https://github.com/serkin/blog blog
```

Edit `blog/app/config.php` for database credentials and be sure your mysql instance up and running

Create new database and import database schema from `blog/blog.dump.sql`


## Usage
---

``` bash
cd blog/public
php -S localhost:4000 index.php
```

## Requirements
---

PHP >= 5.5

## TODO
---

- Migration
- Managing users in command line
