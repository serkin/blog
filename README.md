#Simple blog


- no libraries
- no frameworks
- even no composer


## Installation
---

Clone repository

git clone repo blog


Set database credentials in `blog/app/config.php` and be sure your mysql instance up and running

Import database schema from `blog/blog.dump.sql`


## Usage
---

cd blog/public
php -S localhost:4000 index.php

## TODO
---

- Migration
- Managing users in command line
