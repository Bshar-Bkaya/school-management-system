# school-management-system

## Installation

Here is how you can run the project locally:
1. Clone this repo
    ```sh
    git clone https://github.com/Bshar-Bkaya/school-management-system.git
    ```

1. Go into the project root directory
    ```sh
    cd school-management-system
    ```

1. Copy .env.example file to .env file
    ```sh
    cp .env.example .env
    ```
1. Create database `school` (you can change database name)

1. Go to `.env` file 
    - set database credentials (`DB_DATABASE=school`, `DB_USERNAME=root`, `DB_PASSWORD=`)
    - paste `TMDB_TOKEN=(your API key)` 
    > Make sure to follow your database username and password

1. Install PHP dependencies 
    ```sh
    composer install
    ```

1. Generate key 
    ```sh
    php artisan key:generate
    ```

1. install front-end dependencies
    ```sh
    npm install && npm run dev
    ```

1. Run migration
    ```
    php artisan migrate
    ```
    
1. Run seeder
    ```
    php artisan db:seed
    ```

1. Run server 
    > for valet users visit `velflix.test` in your favorite browser
   
    ```sh
    php artisan serve
    ```  

1. Visit `localhost:8000` in your favorite browser.     

    > Make sure to follow your Laravel local Development Environment.