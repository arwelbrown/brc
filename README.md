<p align="center"><a href="https://laravel.com" target="_blank"><img src="./storage/app/public/img/br_admin/hexa_final_1.webp" width="400" alt="BRC Hex"></a></p>

<h2 align="center">Broken Reality Comics</h2>

## Setup
Welcome! I'd like to start by saying that I use Arch btw.

In all seriousness, the following setup method is what I used to get the site up and running on Arch Linux - this will likely be similar on other linux distros but if you're on Mac or for some unspeakable reason, Windows... Good luck I guess?

Firstly, you'll need to set up docker on your machine. If you prefer docker desktop, go for it! I don't tend to use it however.

Next, you'll need to install DDEV. You can do so <a href="https://ddev.readthedocs.io/en/stable/#installation">here</a>

Once you have these set up, clone the project.

Next, cd into the directory where the project is cloned, and run the following;

```sh
ddev start
```

Next, once the container has built, run:

```sh
docker ps
```
To verify that it's working.

Now, we need to `dockin` to the container using this command:
```sh
dockin brc_web
```
Once we're in the container, we now need to run
```sh
composer install
```

Next, exit the container, and run
```sh
npm run build
```

We should be good to go! The project will not load with images however, so you'll need to get them directly from the server.

## Database
As part of the sail setup, you will create a MySQL database, running on port 3306 of your local machine. You should be able to download any SQL client, and connect using the information in the .env file.

#### Populating the database
In the project root directory, run the following commands;
```sh
dockin brc_web

php artisan migrate
php artisan db:seed
```
