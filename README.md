
# Challenge: Accommodation management service  

Dockeried Laravel app to create, update and list accommodations of different users, taking as database a CSV file.


## Installation


- Install both [Docker](https://docs.docker.com/engine/install/ubuntu/) and [Docker-compose](https://docs.docker.com/compose/install/).

- Once this is done, go to the folder "docker/" and copy the file ".unix.conf", ".windows.conf" or ".mac-arm.conf" (depending on the operating system you use) and paste it with the name ".env" in the same folder.

- Create the network with "docker network inspect avaibook-network >/dev/null || docker network create avaibook-network".

- Now from the project folder we launch 
```"docker-compose --env-file docker/.env up -d --remove-orphans"```

- Then, in the root of the project copy the example env file (.env.example) and make the required configuration changes in the .env file

    ```cp .env.example .en```

Generate a new application key, running this in the php shell 

   ```php artisan key:generate```

Or with this command in the native terminal of your OS:

```docker exec -it avcodt_php php artisan key:generate```


- Once this is done, let's launch "composer install" with the command "docker exec -it avcodt_php composer install" or open from the PHP shell with docker or VSCode and run "composer install" from the root of the project.



- We have everything ready, now we go from the browser to "http://127.0.7.14" if we are in Linux, to "http://localhost:87" if we are in Windows, or "http://127.0.0.1.1:80" if we are using a Mac with ARM processor.


## Usage


First, run the tests in order to check if everything is ok.

Php Shell:
```
php artisan test
```
Native Terminal:
```
docker exec -it avcodt_php php artisan test
```


If you want to test the routes with postman, you have to use real User IDs that you can find in the file storage/app/csv/data.csv.

## API Routes

```
Public routes

Create Accommodation => POST /user/{user_id}/accommodations
Update Accommodation => PUT /user/{user_id}/accommodations/{id}
Get all Accommodations by User ID => GET /user/{user_id}/accommodations
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

