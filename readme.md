<p align="left">Template</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Template






jacos has done a system ( Template) for you to make user's sign up faster and more reliable on your website.

template  is a PHP based admin panel application for user authentication management.

It allows administrators to manage users and there roles. Some of the main features are roles, 
permissions, password, e-mail, blocking and deleting users, login/register,  With Template 
you can easily and quickly build your user management system and can easily manage access for your users.

Main Feature: 
Built with Laravel VERSION = '5.7.28' and Bootstrap 
Users, Roles, Permissions
User register, login,
password resets, e-mail verification







# php/composer already installed

# git clone
git clone https://repo.dev.jacos.jp/gitbucket/git/y_sakaki/template.git

composer install

# make .env
cp .env.example .env
# edit .env
# database info

composer update

php artisan key:generate

php artisan migrate

php artisan db:seed


### About Testcafe

#Ensure that Node.js and npm are installed on your computer and run the following command:

## For Running the Test

#You can run the test from a command shell by calling a single command where you specify the target browser and file path.

testcafe chrome test.js

N.B: TestCafe automatically opens the chosen browser and starts test execution within it.

##Test Speed

#TestCafe provides the capability to change test speed. 

testcafe chrome test.js --speed 0.1

#testcafe function check Example 

test('Check the page URL', async t => {
    await t
        Function code here 
});

#Testcafe select function checking 
testcafe chrome test.js -t "My Login"
