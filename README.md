Instructions on how to install the project locally:

Clone the repository:

git clone https://github.com/editbgoran/weather-app.git

Switch to the repo folder:

cd weather-app

Install all the dependencies using composer:

composer install

Create .env file, copy content from .env.example and paste it to .env,then make the required configuration changes in the .env file

Then register to https://openweathermap.org/ and generate your api_key,past it to .env file and store in environment variable 
that will be called OPENWEATHERMAP_API_KEY

Generate a new application key

php artisan key:generate

Run the database migrations (Set the database connection in .env before migrating)

php artisan migrate

Start the local development server

php artisan serve
