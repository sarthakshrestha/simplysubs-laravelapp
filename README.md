## About SimplySubs

<h1>SimplySubs is a Laravel based e-commerce subscription website.</h1>
<p> - made by Sarthak Shrestha </p>

<h2> YouTube Link: </h2>
https://youtu.be/mcCiBk885-0

<h2> Documentation </h2>
<code>is within the SarthakShrestha_SimplySubsDocumentationPHP.pdf</code>

## Installation Guide

1) Clone the directory

2) Now for creating the database, Have MySQL installed and configure the .env file

by running the command 'copy .env.example .env' if you are on Windows or 'cp .env.example .env' if you are on macOS

Make a database called 'simplysubs' through MySQL and run 'php artisan key:generate' and then finally 'php artisan migrate' 

3) Run npm install, composer install and php artisan storage:link on the terminal of the cloned directory

4) Now use the web app by the commands 'npm run dev' and then 'php artisan serve' to start browsing SimplySubs

5) Please run the commands to populate the database of Users and Subscriptions with seeding.
<code>php artisan db:seed</code>
<code>php artisan db:seed --class=SubscriptionsTableSeeder</code>
