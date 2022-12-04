# Programming-languages-backend

this is the backend repo for the programming languages

## Installation

- first clone the project using git clone
- then make sure your mysql database is running if your using XAMP make sure it is running
- then rename the .env.example to .env and enter your DB_USERNAME , DB_PASSWORD and add a name for the database in DB_DATABASE
- then open your terminal using the short cut ctrl + ` if you are using visual studio code or open your terminal and go to the folder where you clone the project
- and run the `composer install`
- after the installation is complete run `php artisan migrate` and press yes to create the database
- congrats 😃

## To Run the server

- open your terminal using the short cut ctrl + `
- and run `php artisan serve`

## General Info

### the database files

- the database models are in a folder called database/Info and inside
- each folder name is the time where it has modefied and each one contain a screenshoot of the database and a model and a builder script
- if you want to edit it plasse keep the same format

### the API

- all the api are in the folder routes/api.php
- the available api routes are
  - api/expert for adding editing showing and deleting an expert
  - api/experience for adding editing showing and deleting an experience

**note**: you can see the available route using `php artisan route:list`
**note 2** : to see a specific route use `php artisan route:list --path=api` where api is the begining of the route expample "expert"
