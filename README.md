<p align="center"><a href="https://laravel.com" target="_blank"><img src="./storage/app/public/img/br_admin/hexa_final_1.webp" width="400" alt="BRC Hex"></a></p>

<h2 align="center">Broken Reality Comics</h2>

## Setup
Welcome! I'd like to start by saying that I use Arch btw.

In all seriousness, the following setup method is what I used to get the site up and running on Arch Linux - this will likely be similar on other linux distros but if you're on Mac or for some unspeakable reason, Windows... Good luck I guess?

Firstly, you'll need to set up docker on your machine. If you prefer docker desktop, go for it! I don't tend to use it however.

Once you have these set up, clone the project.

We now need to create a shell function for entering the docker container we will be creating. To do this, follow these commands (I use bash, this might be different for you if you use zsh, or fish).

```sh
touch ~/.bash_functions
nvim ~/.bash_functions
```

Write the following function in your .bash_functions file

```sh                                      
function dockin() {
        if [ -z "$1" -o -z "$2" ]; then
                docker exec -it brc-web /bin/bash
        fi
}
```
And hit ctrl+x and y. Then add this to your .bashrc, or other equivalent;
```sh
source ~/.bash_functions
```

You'll now be able to enter the container from anywhere within your system by running dockin.

Next, cd into the directory where the project is cloned, and run the following;

```sh
docker compose build
docker compose up -d
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
dockin

php artisan migrate
php artisan db:seed
```
