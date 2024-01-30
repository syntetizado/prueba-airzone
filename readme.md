## Welcome to my Solution!

Here you will find all comments about how I did plan my solution.

## -- Setting up --

1. Put the `docker` secret file I gave you into `/secrets` folder (so you can pull my image).
2. Execute ` ./up ` to start the application.
3. Start reviewing!




## -- Infrastructure -- 

For this solution you just need a linux computer with <b>docker</b> and <b>docker-compose</b> installed.

It's basically a nginx sending php files to a php-fpm server, with a mysql database also listening.

Available ports:

```
80 -> api
3306 -> db
9000 -> fpm
```

Available commands:

```shell
./up -- Brings up the project
```

```shell
./composer -- container composer api  
```

```shell
./test -- container pest api
```

## -- Models -- 

I decided to make simple models, casting values that are not keys.

## -- Factory/Seeders -- 

I'm placing factory/seeders on a simplified hexagonal architectory-like structure.

Will only use Domain & Infrastructure Layers.

I'm doing it for allowing testing of domain logic, 
removing the application layer as we will put all the logic on the controllers.

