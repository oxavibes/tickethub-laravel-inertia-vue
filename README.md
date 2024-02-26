![screenshot](https://github.com/oxavibes/tickethub/assets/8161360/bf57944b-78ed-42d2-bbe5-b8bf85295761)


# Getting started

#### This is a demo Laravel project to manage support tickets between regular users, agents, and admins, aimed to practice Laravel, Vue.js through Inertia.js

## Installation

Clone the repository
		
	git clone https://github.com/oxavibes/tickethub-laravel-inertia-vue.git

Switch to the repo folder

    cd tickethub

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the backend local development server

    php artisan serve

Start the client local development server
		
	npm run dev

You can now access the server at http://localhost:8000

## Database seeding

**Populate the database with seed data with relationships which includes users, categories, and tags. This can help you to quickly start using it with ready content.**

Open the UserSeeder and check the default user credentials or modify them at your convenience.

    database/seeders/UserSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
    
