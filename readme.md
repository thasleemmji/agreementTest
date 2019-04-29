# Agent Agreement System (Laravel)

The admin can create, edit, delete Agreements. Another role called agents has to accpet these agreements on login to successfully get into the welcome page.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Need to have basic knowledge of Laravel PHP framework and other web related technologies, a text editor to edit the codes,

### Installing & Deployment

A step by step series of examples that tell you how to get a development env running

1. Open Command Prompt and change the directory to the required location (using cd command) and run the following to Clone the project:

```
git clone https://github.com/thasleemmji/agreementTest.git projectName
```

2 .cd into your project directory
   Now Install Composer Dependencies for this project

```
composer install
```

3. Create a copy of your .env file

```
cp .env.example .env (Linux)

copy .env.example .env (Windows)
```
4. Generate an app encryption key

```
php artisan key:generate
```
5 .Create an empty database for our application


6. In the .env file, add database information to allow the application to connect to the database


7 .Migrate the database
```
php artisan migrate
```
8. Now Seed the database with random data

```
php artisan db:seed
```

That's it, You are pretty good to go and start the application.

## Running the tests

Login as Admin > Create new Agreements
Login as an Agent > 'Accept & Continue'  the new agreements

## Built With

* Laravel - PHP Framework
* MySQL Database
* HTML,CSS,JQuery,Bootstrap
* Sweet Alert,JQuery Toaste

## Versioning
V 1.0

## Authors

* **Thasleem C** - [Full Stack Web Developer](http://thasleem.me)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
