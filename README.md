# PHP interview assignment

## Description

Your task is to build a simple web-based image hosting service.
Users can fetch images metadata from an external service (flickr, google images, facebook etc, you choose),
server side or client side it's up to you, and can also set pictures as favorites.
Image metadata are fetched, not the image itself.
Favorite images can have a description.
Favorite images appear on the user's home page.
Users can also delete favourited images.
Users can also delete favourited image descriptions.

### You have to implement the following user stories:

* AS a user, I WANT TO fetch 20 random images data from the choosen external service.
  and see them on the homepage.
* AS a user, I WANT TO favorite an image. (ajax)
* AS a user, I WANT TO add a description to a favourite image. (ajax)
* AS a user, I WANT TO view favorite images.
* AS a user, I WANT TO delete favorite images.
* AS a user, I WANT TO delete favorite image descriptions.

**No user login required.**

You have high expecations from your web app and figure that it's best to provide an API for
developers/other services/mobile devices.
The API should allow the developer to do all of the above using calls to the API. You
can design and implement the API however you want. Of course, we'd also like to see an API client.


## Rules:

* Clone this repo to your github account.
* PHP 5.3 .
* You are not allowed to use any PHP framework. However, you are free to use any PHP library.
* You are free to use any Javascript library.
* You get huge bonus points for writing unit/functional tests.
* Provide a SQL file for creating the database.
* Provide a configuration file and instructions for how to run the app on our machines. An automaded scripts is a plus.
* You have to push the code on your Github account and make a pull request to YakimbiICT/php_dev_interview_assignment repo.
* Not required, but it would be great if you can host the app on the Internet so that we can play
  with it without having to install/configure it. ;-) 

**IF YOU CAN'T USE A PUBLIC REPO ON GITHUB, USE BITCUCKET [[ https://bitbucket.org/ ]] AND SET UP A PRIVATE REPO**

---

# Implementation

## Demo
You can see the application in action at [[ http://yakimbi.danilosanchi.net ]]

## System Requirment

### CURL
_Guzzle HTTP client_ need CURL
```shell
$ sudo apt-get install php5-curl
$ sudo service apache2 restart
```

### PEAR and PHING
To install PHING you can install PEAR
```shell
$ sudo apt-get install php-pear
$ pear config-set auto_discover 1
```

To enable the installation script you need PHING.
You can otherwise to read *build.xml* and to execute the command lines inside it

```shell
$ sudo pear channel-discover pear.phing.info
$ pear install phing/phing
```

## Virtual Host Setting
Create the file _/etc/apache2/sites-available/yakimbi_
```text
# /etc/apache2/sites-available/yakimbi

<VirtualHost *:80>
    ServerAdmin danilo.sanchi@gmail.com
    ServerName yakimbi
    DocumentRoot /var/www/php_dev_interview_assignment/web
    DirectoryIndex index.php index.html
    <Directory /var/www/php_dev_interview_assignment/web>
            AllowOverride all
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/yakimbi.error.log
    # Possible values include: debug, info, notice, warn, error, crit,
    # alert, emerg.
    LogLevel notice
    CustomLog ${APACHE_LOG_DIR}/yakimbi.access.log combined
</VirtualHost>
```
Enable the new virtual host
```shell
$ sudo a2ensite yakimbi
```
Edit the file _/etc/hosts_
```text
# /etc/hosts

...
127.0.0.1 yakimbi
...
```

Restart Apache
```shell
$ sudo a2enmod rewrite
$ sudo service apache2 restart
```

## Installation
Clone this repo and run _phing install_
```shell
cd /var/www/
git clone git@github.com:danielsan80/php_dev_interview_assignment.git
cd php_dev_interview_assignment
phing install
```

