
## Flashcard app made with Laravel + Artisan

## Installation

first, you have to clone the project.
then simply get all laravel required packages with composer install.
set your DB connection via .env file .
in case you want to use docker :
write this command "./vendor/bin/sail up" it will set some containers for you but you don't need to since it's an easy script and use PHP and MySQL.

then run "PHP artisan migrate"

if you are using docker go to Laravel container with "docker exec -it <container_name> bash" and run that command.

then you need some fake records for your DB.
in order to  do that simply use "PHP artisan db:seed"

again, in you are using docker go to the container and run this command.

the last part is running this command "PHP artisan flashcard:interactive" and enjoy :).

