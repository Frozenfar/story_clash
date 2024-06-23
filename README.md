## Code Challenge for Story Clash

Hi!
My name is Rahi and this is my solution for the code challenge from Story Clash. the PDF of this task should be in this repo as well :)

A short summary of what this code is:

This project is based on Laravel and sail environment so it needs you to have docker + docker-compose and composer installed on your PC/Mac and it needs to have the key for it first added to the .env file after pull from repo. I will add the parameters at the bottom. The usage example is as described in the PDF but the command "copy --h" will give you all the info you need. In order to use the DB with data I suggest running the migration code with --seed arg, that way you have some data to test with. 

Here is a guide to start the project:

1. create an .env file from .env.example
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
3. run command : composer install 
4. run command : ./vendor/bin/sail build
5. run command : (optional with -d at the end)  ./vendor/bin/sail up
6. run command : ./vendor/bin/sail artisan migrate --seed
- That's it you are ready to test and use the app!
- run command this command if you use -d to shut down the code :  ./vendor/bin/sail down (if you want with -v)

Just remember to create and modify the .env file as explained :)


Good Luck!