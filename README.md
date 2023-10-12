After downloading the zip, you need to do the following steps

1.composer install (or composer update)

2.cp .env.example .env

3.create a database and include the name in the .env

4.put your email in these files 
        .env,
        app/Jobs/SendEmailJob.php,
        App/Mail/NeeApplication.php

5.php artisan key:generate

6.php artisan migrate

7.php artisan migrate --seed

8.php artisan serve

