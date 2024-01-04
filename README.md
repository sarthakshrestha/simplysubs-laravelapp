## About SimplySubs

<h1>SimplySubs is a Laravel based e-commerce subscription website.</h1>
<p> - made by Sarthak Shrestha </p>

## Installation Guide

1) Clone the directory

2) Now for creating the database, Have MySQL installed and configure the .env file

by running the command 'copy .env.example .env' if you are on Windows or 'cp .env.example .env' if you are on macOS

Make a database called 'simplysubs' through MySQL and run 'php artisan key:generate' and then finally 'php artisan migrate' 

3) Run npm install, composer install and php artisan storage:link on the terminal of the cloned directory

4) Now use the web app by the commands 'npm run dev' and then 'php artisan serve' to start browsing SimplySubs