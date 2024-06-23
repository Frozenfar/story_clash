## Code Challenge for Story Clash

Hi!\
My name is Rahi and this is my solution for the code challenge from Story Clash. the PDF of this task should be in this repo as well :)

A short summary of what this code is:

This project is based on Laravel and sail environment so it needs you to have docker + docker-compose and composer installed on your PC/Mac and it needs to have the key for it first added to the .env file after pull from repo. I will add the parameters in the guide. The usage example is as described in the PDF but the command "copy --h" will give you all the info you need. In order to use the DB with data I suggest running the migration code with --seed arg, that way you have some data to test with. 

Here are the steps to start the project:

1. create a .env file from .env.example
2. update entries like this (you can copy and paste as is in the appropriate lines)
   
    ```.env
    APP_KEY=base64:B+z/Yp8Jqpb3lzmYVZyu56zrkCH/8KffUoiD/9OHJmY=
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=sail
    DB_PASSWORD=password
    ```
4. run command : composer install 
5. run command : ./vendor/bin/sail build
6. run command : (optional with -d at the end)  ./vendor/bin/sail up
7. run command : ./vendor/bin/sail artisan migrate --seed
<br /> 

That's it you are ready to test and use the app! Now some tips:
- run this command if you use -d to start the app, to shut the code down:  
./vendor/bin/sail down (if you want with -v to remove containers as well)
- I have added phpMyAdmin to the docker-compose as well for easier debug, its on localhost:8080 and the user and pass is the same as the .env
- for some reason if you might have a problem with first migration (only happend to me once and idk why) if there was an error after step 6 and said something like:<br />  "Integrity constraint violation: 1062 Duplicate entry" <br /> 
 run this command:  ./vendor/bin/sail artisan migrate:refresh --seed
- final note since this Laravel is running on sail you need to interact with it like this:\
 "./vendor/bin/sail" instead of "php" for example:\
 "./vendor/bin/sail artisan copy 123"

Just remember to create and modify the .env file as explained :)


Good Luck!
