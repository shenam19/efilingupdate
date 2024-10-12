## Collaborating process 

1. Fork the repo

2. Clone the repo from your GitHub 

3. Work on your repo in working directory

4. Keep the repo sync with the upstream/dev (Click fetch upstream button in your GitHub repo -> fetch and merge)

5. Pull request to dev branch

## How to run test

1.  ```
    php artisan test 
    ```

2. if specifically want to run the unit tests: run
    ```
    php artisan test tests/unit
    ```
    

## How to install using Docker

1. Prerequisites
    - Docker 
    - Docker Compose 

    ```
    cp .env.example .env
    ```
2. Start Docker for linux:
    ```
    sudo service docker start or sudo systemctl start docker
    ```
    - Start Docker for mac and windows:
    
    - start from Docker Desktop
    
3. Install Composer dependencies for sail from application root
    ```
      docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php80-composer:latest \
        composer install --ignore-platform-reqs
    ```
4. set alias for /vendor/bin/sail
    ```
      alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
    ```

5. Run the app
    ```
    sail up -d
    ```
6. Database Migration
      b. Run Migration in application root
        *note: while running your laravel app on sail all the artisan commands will be preceded by sail instead of php.
            ```
            sail artisan migrate
            ```

7. Key generate
    ```
    sail artisan key:generate
    ```
8. Visit localhost to check if app is running


9. To debug in your local machine 
    * add this line to your .env file 
    ```
    SAIL_XDEBUG_MODE=develop,debug
    ```

    * If you are using VSCode, in launch.json file add a new configaration
    
    (Note: Xdebug uses part 9003 if there is other configurations using the same port, change the other configuration's port number) 
    ```
    "configurations": [

        {
            "name": "Xdebug for Docker",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "log": true,
            "pathMappings": {
                "/var/www/html": "${workspaceFolder}"
            }
        }...
    ```

    * To trouble shoot run the following lines in your controller 
    ```
    xdebug_info();
    exit;
    ```
