<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Ennova Test</h1>
    <br>
</p>


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      import/		   contains the database import test files for the project


USAGE
------------

### 

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

After cloning the project execute the following commands:

~~~
composer install
~~~

~~~
./yii serve
~~~


### Import customers and practices into the databse

After reaching the login page of the application, login with the admin account and go to the Import page fromn the top menu.
Upload the customers.csv file from the `import` folder and after this import the practices.csv file too.

After this operation you will be redirected to the search page and you can start searching through the database with the data included in the CSV files.

