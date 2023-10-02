# Laravel Project Name

Welcome to the LiteNote Laravel application. This repository contains the source code for a Laravel project, and this README provides instructions on how to set up and run the project locally using Visual Studio Code and XAMPP.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- [Visual Studio Code](https://code.visualstudio.com/) installed
- [XAMPP](https://www.apachefriends.org/index.html) installed

## Getting Started

To get this project up and running on your local machine, follow these steps:

1. Clone this repository:

   ```bash
   
   git clone https://github.com/AzharAbbas10/LiteNotes.git

Change your working directory to the project folder:

    cd LiteNotes
   
Install PHP dependencies using Composer:

    composer install

Generate a new application key:

    php artisan key:generate

Open the .env file in your text editor and configure your database settings:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=litenotes
    DB_USERNAME=root
    DB_PASSWORD=

Create a new MySQL database for your project.

Migrate the database:

    php artisan migrate

Start the Laravel development server:

    php artisan serve

Your Laravel application should now be running at http://127.0.0.1:8000.
