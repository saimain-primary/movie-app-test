
# Muuvee DB (Movie DB)

A website for movie listing, detail and comment the movie.


## Screenshots

![App Screenshot](https://i.ibb.co/NsCNM8J/Screenshot-2023-06-21-at-10-45-50.jpg)


## Installation

- Clone the project  repo
- Config the database connection in .env file

Install the require packages
```bash
    composer install
    npm install
```
    
Migrate the database and seed the database

```bash
    php artisan migrate
    php artisan db:seed
```

Generate Passport Access Token

```bash
     php artisan passport:install
```

Run the project

```bash
    php artisan serve
    npm run dev
```

Go to Browser and enjoy the website

http://localhost:8000
## Documentation

This documenttion default url is `/docs`.

Example : `http://localhost:8000/docs`
