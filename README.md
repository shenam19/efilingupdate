# Efiling



## How to run test

1. Start database for test environment using Docker.

        docker run --name test-mysql -e MYSQL_DATABASE=efiling_test -e MYSQL_USER=sail -e MYSQL_PASSWORD=password -e MYSQL_ROOT_PASSWORD=password -p 3306:3306 -d mysql:8.0.39

1. Run test

        php artisan test 

1. Run specific test class

        php artisan test --filter=ClassName


1. If you specifically want to run only the unit tests.
   
        php artisan test tests/unit
    
