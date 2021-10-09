# VMS Comics API

Application runs via docker environment. Settings can be updated via docker-compose.yaml.

## Default Containers
* laravel-app : Runs on port 8233 which holds laravel app.
* mysql-db : Runs on port 3322. DB details listed under the config.
        dbname: homestead, 
        password: securerootpassword
 
 ## Running Application
 
 * Clone repo
 * From Root Folder run 
    ```
     docker-compose build --no-cache
     docker-compose up
    ```
 * SSH into the laravel container
    ```
     docker exec -it laravel-app bash
    ```
 * Run Migration Command
    ```
     php artisan migrate
    ```
 * Populate Database Authors and Comics tables
     ```
     php artisan marvel:populate_data
    ```
 * Test Endpoints (Bearer Token 'foo_bar' is mandatory to be passed)
     ```
     GET http://xxx/authors
     GET http://xxx/comics/{author_id}
    ```

  ## Running Test cases
  
  * Run test case
    ```
     php artisan test
    ```
  
