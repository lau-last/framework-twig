# Project 5 PHP Blog

Project 5 of the OpenClassrooms **PHP/Symfony**: Create your first blog in PHP!

## Try the project

To install the project on your machine, follow these steps:

- Install a PHP / MySQL / Apache environment *(e.g.,[MAMP](https://www.mamp.info/en/))*
- Install  [Composer](https://getcomposer.org/download/)
- Clone the project into a directory and run: composer install.
- Create the database via *public/diagrams/framework.sql*

  >This script will create a "framework" database with a demo dataset. User access information is available at the beginning of this script.

- Modify  *.env.example to .env* and modify :
    - Constants starting with MAIL to use the [PHPMailer](https://github.com/PHPMailer/PHPMailer) and [Mailtrap](https://mailtrap.io/) / [Imitate](https://imitate.email/) section
    - Constants starting with DATABASE for the PDO part and database connection.

### Everything is ready!
Once Apache and MySQL are running, the blog will be accessible (by default at: http://localhost:8888) or go to the public folder and run the command 

>php -S localhost:8000
 