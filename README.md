# Arslaan Muhammad Ali
## Coding Assignment PHP

[![N|Solid](https://www.wundermobility.com/uploads/redesign/logo-darkblue.svg)](https://www.wundermobility.com/)

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

## Prerequisites
- Any server such as wamp Version 3.2.6 - 64bit is required.
- Latest PHP 8.0 and MySQL 5.x must be available

## Instruction to Run
- Update the configurations related to the Database in the mvc/app/config/DB.cfg to the appropriate db settings
- import the database wmt.sql to your phpmyadmin.
- import the folder wmt to your server root
- Currently, it worked using the url http://localhost/wmt/public
- composer install

## Describe possible performance optimizations for your Code.
- Add more native functions for php.
- Some functions could have been written in javascript to make use of localstorage to optimize the performance.
- To save the Data in the POST API, AJAX could have been written.
- I chose to develop this solution with simplicity in mind, using only one table to store data of various entities is not the optimal solution in the matter of data modeling. Altought to keep this project simple to evaluate and run I opted to make it this way. So there is a possibility of normalizing the database structure, creating table for address and payment information

## Which things could be done better, than you’ve done it?
- Handle database connection and instructions on separate class
- add more error handling to the PHP
- Backend validation of data can be done more clearly
- Post Api call could have been made using jQuery and showing error message accordingly.
- Unit Testing and test coverage could have been added.
- Add Database transactions to ensure we don't insert data into the database if any of the database transactions fails.
- Implement functionality to alert a user when they try to register again when we already have their details such as telephone and iban which are stored as unique fields in the database.

## Design Pattern of my code?
- I have created and used MVC(Model, View, Controller) design pattern because it provides a clean separation of the UI , Business Logic , Model or Data.
- Using the MVC methodology allows easy modification of the entire application. Adding/updating the new type of views is simplified in the MVC pattern (as a single section is independent of the other sections). So, any changes in a certain section of the application will never affect the entire architecture. This, in turn, will help to increase the flexibility and scalability of the application.

## Repository links
- Bitbucket Link https://bitbucket.org/arsal4113/wmt/src/master/
- Github https://github.com/arsal4113/wmt
