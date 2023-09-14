## Task
- Create an API route using Laravel that allows the data to be searched
- Create a basic search form that will query the API using AJAX and display the results it receives from the backend. The searching result should be rendering to HTML table dynamically on the frontend, using reactive Vue.js.
There should be some sort of searching indicator, a spinning icon or similar.

### Main functionality of the task:

- Displaying data in a table with a specified number of rows
- Filtering data in the table across all columns
- Clearing filters and sorting
- Sorting columns in both directions
- Handling form errors and no results

### Features

- Support for filtering across multiple columns
- Sorting works for only one field at a time
- The default number of automatically generated data entries is 20, with the option to specify more

## Stack
- Back-end: PHP 8, Laravel 10, SQlite
- Front-end: HTML5, Inertia + Vue3, Axios, Tailwind CSS 

## System requirements:
PHP 8.1+, PHP SQLite lib, Git, NPM, Composer (PHP 8.1+)

## Install on Ubuntu VPS:

1) Clone the repository: <b>sudo git clone https://github.com/spitzer77/laravel_rest_api_vue_table.git vue_table</b>
2) Enter the directory laravel-map-marker: <b>cd vue table</b>
3) Install Composer dependencies: <b>composer install</b>
4) Install npm dependencies: <b>npm install</b>
5) Set appropriate permissions: <b>chmod 777 -R ./storage/</b>
6) Create a new SQLite database:
- <b>touch database/database.sqlite</b>
- <b>chmod 777 -R ./database/</b>
- <b>chmod 777 -R ./database/database.sqlite</b>
7) Run database migrations: <b>php artisan migrate --seed</b>
8) Build the project: <b>npm run build</b>
9) Run webserver:<br>
**Apache2**: put <i>DocumentRoot /var/www/laravel_rest_api_vue_table/public</i> to _<Virtualhost *:8814>_<br>
**nginx**: put '_root /var/www/laravel_rest_api_vue_table/public_' to _server { /settings/ }_

## Install on Windows

1) Clone the repository: <b>git clone https://github.com/spitzer77/laravel_rest_api_vue_table.git vue_table</b>
2) Enter the directory <b>vue_table</b>
3) Install Composer dependencies: <b>composer install</b>
4) Install npm dependencies: <b>npm install</b>
5) Run database migrations: <b>php artisan migrate</b> (say 'yes' to create sqlite database)
6) Build the project: <b>npm run build</b>
7) Run laravel php webserver: <b>php artisan serve</b> or external locally running web server

## Run app:

1) Run page app (http://127.0.0.1:8000/table on local machine or http://your_server:your_port/table on external server)
2) Use arrows to sort data, the form to filter data, and the 'Сlear' button to clear data. 
3) To verify error handling just fill numbers in the 'Name' filter field or letters in other filter fields, and click 'Apply filter'. 
