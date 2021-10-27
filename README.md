<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Test</h1>
    <br>
</p>


USAGE
------------

### 

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

After cloning the project, config the database connection by editing the `db.php` file in the `config` folder, then execute the following commands:

~~~
composer install
~~~

~~~
./yii serve
~~~


### Import customers and practices into the database

After reaching the login page of the application, login with the admin account and go to the Import page from the top menu (only the admin account can use the import function, while the demo account can't).
Upload the `customers.csv` file from the `import` folder and after this import the `practices.csv` file too.

### Searching and exporting

After this operation you will be redirected to the search page and you can start searching through the database with the data included in the CSV files.
Click on `Export results to CSV` for exporting the search results to a CSV file or click on `Export all to CSV` for exporting all the practices to a CSV file.

