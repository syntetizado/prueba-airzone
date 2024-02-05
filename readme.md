## Welcome to my Solution!

Here you will find all comments about how I did plan my solution.

I decided to do it the TDD way, I don't have a Postman Collection,
because I wasn't in need for using an external program.

Of course I didnt have to incorporate some Hexagonal Features, but the time is limited
and I just want to show some of my skills.

This is just a demo of what I can do, enjoy!

## -- Setting up --

1. Put the `docker` secret file I gave you into `/secrets` folder (so you can pull my image).
2. Execute ` ./up ` to start the application.
3. Start reviewing!

You can launch coverage to see all the code is covered ` ./test --coverage `

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

## -- Code Structure --

After creating all the features, I keep developing to make a
fully Hexagonal Architecture Application, with hand made, very simple Command/Query Buses.

I keep moving all logic until I had some interesting structure, that you can see it's divided into 3 layers.

- Domain
  - It keeps all the Business logic, we have just simple Domain entities that has some property management logic.

- Application
  - Here, is were all logic that we had on the controllers, moved to a place were you have no need to worry about
    some infrastructure issues that can distract you, and already have all the data you need to work with and test.
  - Because of all tests I did at first, almost all the coverage it's done on the Infrastructure Layer, 
    so we should keep going this way, so all the testing logic should be encapsulated on it's corresponding Layer.

- Infrastructure
  - Here we should do all the proper tests that implies the logic that is done on the controllers and
    the most external elements of our application. That implies testing the parameters we query, and if response is ok.
    Anything extra tested is a waste of time, it's already tested on it's respective Use Case.

- Shared
  - Here resides the code that can be use anywhere on the application, it just doesn't fit anywhere
    on Domain, so it should fit here

Considerations:

<span style="color: #68a8cb"> This is not a pure Hexagonal Arch, it's simplified for a Monolith Application. </span>

## -- Testing --

I did enough testing to raise the coverage of the application to it's maximum, but this doesnt assure the tests
are the best that you can do.

There's also something we can consider, I'm not just doing it here but it adds robustness to the application:
- Mutant testing 
  - Adding code modifications that should make the tests fail.
  - They are a proof that our tests are High Quality and offer real coverage.
  - There is a framework useful for doing this (Infection PHP) but it's focus is on PhPUnit 
    and it't still on development, I tried it and things failed with all well configured,
    I've read and Pest it's not fully supported yet, maybe it's just about talking to the project owner
- Database / Requests Stress Testing
  - It can test if our application can allow a big ammount of requests / queries
  - Not something to do regularly, but it's good to have a set of tests to do in a regular basis
- Database Data Quality Test
  - These tests can be really slow, as they test if a database has a problem with it's data,
    colliding a big chunk of it with the business logic.
  - They are useful for doing some cleansing on the database
