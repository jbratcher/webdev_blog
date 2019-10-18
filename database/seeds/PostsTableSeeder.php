<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $post = new Post;
        $post->user_id = 1;
        $post->title = "Deploying Laravel 6 to a Digital Ocean Droplet";

        $post->body = <<<EOT
Ready to get my updated website live, I turned to Digital Ocean for hosting.  I created a new project and droplet to deploy the site as a Laravel app.  Digital Ocean's documentation is average but very straight-forward.  However, I found a couple of bugs and issues along the way that I had to do some Googling for answers.  This post is an attempt to make the process easier for others.

This guide is highly inspired by the [Digital Ocean Laravel](https://www.digitalocean.com/community/tutorials/how-to-deploy-a-laravel-application-with-nginx-on-ubuntu-16-04) setup guide.

Disclaimer:  It has been quite some time since I deployed a website to a hosting provider.  I had used Apache over Nginx in the past and my Linux skills are beginner level.

Tech stack:  Laravel 6, Vue 2, MySQL, Nginx*

*local dev is on windows using Xammp but the tutorial I followed used Nginx, there do not seem to be any noticiable differences between local and production in my case

One big downside I found was that a fresh droplet needs to be setup like a brand new system.  I was looking for a more containerized solution but didn't want to pay more for hosting, needed to get the site live even on a basic hosting platform, and knew I'd learn plenty along the way.

## Creating the droplet

Digital Ocean droplets are their branding of a Linux virtual machine.  They give you plenty of customization options for flexibility.

1. Create a new droplet.

* Choose a project (use the default or create a new one)
* Select "New Droplet"
* Under distributions, choose "Ubuntu".  I will be using 18.04 LTS (note the tutorial lists 16.04 but I had no issues using 18.04)
* Select the standard plan: 1 CPU - 1GB Memory - 25GB SSD - $5/month
* Select the closest DataCenter to you
* Select SSH and create a new SSH key if needed.
* Select "Create Droplet" at the bottom of the page

After the droplet, is created, from your console, we will login in via SSH

`ssh root@your_server_ip`

your_server_ip is will be the IP address listed under your droplet information on DO.  Select droplets and it will be listed there.

Since this is your first time logging in to this server, you will receive a warning message about not being able to establish its authenticity.  Answer "yes" to continue and ignore this warning.

## Setting up the server

After successful login, next is the [initial server set up](https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-16-04)

### Create a new user

For a number of reasons, we will create a new user for everyday usage and avoid using the root user.

`adduser username`

You will be prompted to enter a password.  Enter a strong password (i.e. a mix of letters, numbers, at least 1 uppercase/lowercase and at least 1 symbol).

You will be prompted with a series of questions.  Feel free to answer or skip.

Once the new user is created, we must give them root privileges.

`usermod -aG sudo username`

This will add the user to the 'sudo' group which allows root privileges with the use of the `sudo` command (i.e. sudo nano index.php).  This keeps us from switching back to the root user when we want to use root privileges.  When using `sudo`, you may be prompted to enter the user's password.

We want to be able to login in with this user via ssh so we must set up the ssh public key for this user even though root is already set up.

From your local machine's console

`cat ~/.ssh/id_rsa.pub`

This will output your public ssh key.  Copy this key.

Back in the Digital Ocean console, temporarily switch to the new user using

`su - username`

Create the ssh dir and change the permissions

```
    mkdir ~/.ssh
    chmod 700 ~/.ssh
```

Add the ssh key to a new file called 'authorized_keys'

`nano ~/.ssh/authorized_keys`

To save and exit nano: 1. Ctrl-x, y, Enter

We will then restrict the editing of this folder and go back to the root user

```
    chmod 600 ~/.ssh/authorized_keys
    exit
```

You can now test the login by logging out as root user and ssh-ing in as the new user

`ssh username@your_server_ip`

Optional:  You can add another layer of security by disabling password authentication completely and limit login to only devices that hold the private key by following step 5 of the [guide](https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-16-04).

### Set up a basic firewall

We don't need anything too fancy but the 'ufw' firewall is easy and quick to set up for additional security.

First, allow ssh connections then enable the firewall

```
    sudo ufw allow OpenSSH
    sudo ufw enable
```

## Adding the LEMP Stack

Now that our new user is fully set up, we will set up our tech stack to run our server, database, and app.

LEMP is Linux, Nginx, MySQL, and PHP

### Install Nginx

Nginx is an open-source web server that is freely available and common used instead or even with Apache.  I have little opinion on which is better but they both have their pros and cons.  Either can be used for most applicaitons.

Update the Linux distribution and packages then install Nginx

```
    sudo apt-get update
    sudo apt-get install nginx
```

Allow Nginx through the ufw firewall and check the status

```
    sudo ufw allow 'Nginx HTTP'
    sudo ufw status
```

You should now be able to see the Nginx default homepage at

`http://your_server_ip`

### Install MySQL for databases

* Warning: if you didn't choose a strong password as described above you may have issues installing MySQL securely.

First, let's install MySql server

`sudo apt-get install mysql-server`

Then run the secure installation command

`sudo mysql_secure_installation`

You will be prompted to create a password with the `VALIDATE PASSWORD PLUGIN`

* Enter y
* Enter 2 for strong password
* Enter a strong password and confirm it
* It will output the expected password strength
* You can accept by entering y
* This will be followed by a few questions; Enter y for each prompt

## Install PHP Processor

Install php-fpm and the MySQL driver for php.  FPM is 'fastCGI process manager' for PHP.

`sudo apt-get install php-fpm php-mysql`

Open the fpm config file to fix an issue

`sudo nano /etc/php/7.2/fpm/php.ini` (check your php version number to match)

Uncomment and/or change `cgi.fix_pathinfo=1` to `cgi.fix_pathinfo=0`.
Save and exit the file.

`sudo systemctl restart php7.2-fpm` (check version to match)

## Configure Nginx to use PHP Processor

Edit the Nginx server config file for the default site for Nginx

`sudo nano /etc/nginx/sites-available/default`

This will create and open a file for editing

`/etc/nginx/sites-available/default`

Initally, we will set up the serve for HTTP but later we will use LetsEncrypt to obtain an SSL certificate and use HTTPS for encrypted transfer of data.

* The server will listen on port 80 which we opened earlier with the UFW firewall.
* Set the root to the public folder for Laravel projects.
* Add index.php
* Set the server name to the IP address listed on the droplet (easy copy/paste)

```
    server {
        listen 80 default_server;
        listen [::]:80 default_server;

        root /var/www/html/laravel_project/public;
        index index.php index.html index.htm index.nginx-debian.html;

        server_name _; # ex. 228.191.23.50

        location / {
            try_files \$uri \$uri/ =404;
        }
    }
```

test the server

`sudo nginx -t`

reload the server

`sudo systemctl reload nginx`

### Set up a test connection to check the server

`sudo nano /var/www/html/info.php`

`/var/www/html/info.php`

```
    <?php
    phpinfo();
```

visiting `http://your_server_ip/info.php` should render an info page.

the server should be set up at this point and the LEMP stack set up complete

## Setting up Laravel

Now that we have the LEMP stack set up, the easy part is installing Laravel.

### Update dependencies

We want to update all our packages before installing composer and some helper packages.

`sudo apt-get update`

### Install new dependencies including composer

If you have set up a Laravel project before, most of these steps will be familiar.  I do recommmend following these the first time you set up Laravel on a Digital Ocean droplet since there are some differences in doing it on your local machine.

`sudo apt-get install php7.2-mbstring php7.2-xml composer unzip`

This installs composer and provides helpers for zipped files and xml files.
* Make sure your the php versions match the php version you have installed.  I'm using 7.2.

### Configure MySql

* Note MySql statements my end with a semi-colon.

Login as the root user with the password you previously set up when installing MySql

`mysql -u root -p`

Create a database for the Laravel project

`CREATE DATABASE laravel DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;`

Set admin privileges to a user and password combination (remeber to match password strength of current mysql user).

You can use a different name for the database user here.  It is seperate from the mysql user name and will be the value of the DB_USERNAME .env variable.

`GRANT ALL ON laravel.* TO 'laraveluser'@'localhost' IDENTIFIED BY 'abcD123$';`

Inform MySql of the permission changes and exit

```
    FLUSH PRIVILEGES;
    EXIT;
```

### Setting up the application

Now we are ready to install the Laravel project.  You can create a new Laravel project via composer, the Laravel CLI, or cloning an existing Laravel project.  We will clone a Github project.

CD into /var/www/html and clone the git repo into this folder

```
    cd /var/www/html/
    git clone https://github.com/laravel/quickstart-basic
```

Next set user admin permission to avoid using `sudo` repeatedly (optional)

`sudo chown user:user /var/www/html/quickstart-basic`

Run composer install to activate the Laravel project

`composer install`

### Configure the application envirionment

Let's start by making a .env file.

`sudo nano /var/www/html/quickstart-basic/.env`

If your repo already has a .env.example file.

```
    sudo cp /var/www/html/quickstart-basic/.env.example .env
    sudo nano /var/www/html/quickstart-basic/.env
```

Otherwise make a new .env file

`sudo nano /var/www/html/quickstart-basic/.env`

Make the follwing changes to the new .env file.  Notice we are in production mode.

`/var/www/html/quickstart-basic/.env`

```
    APP_ENV=production
    APP_DEBUG=false
    APP_KEY=b809vCwvtawRbsG0BmP1tWgnlXQypSKf
    APP_URL=http://example.com

    DB_HOST=127.0.0.1
    DB_DATABASE=laravel
    DB_USERNAME=laraveluser
    DB_PASSWORD=password
```

Save and exit the file

This will set up the environment for production and connect to the MySql database automatically.

Run the migrations

`php artisan migrate`

Answer yes when prompted as this is in production mode

## Configuring Nginx for Laravel

Laravel stores some data in special folders that it needs read/write permissions to.  Specifically the storage and bootstrap/cache folders.  We want to grant our system user read/write privileges to these folders through the server.

To accomplish this, we will change the group ownership of these folders to www-data and grant permissions to the group.

```
    sudo chgrp -R www-data storage bootstrap/cache
    sudo chmod -R ug+rwx storage bootstrap/cache
```

Next, copy over the default server code to a new file for editing for your server ip address

`sudo cp /etc/nginx/sites-available/default /etc/nginx/sites-available/your_server_ip`

Then, edit the file

`sudo nano /etc/nginx/sites-enabled/your_server_ip`

`/etc/nginx/sites-enabled/example.com`

```
server {
    listen 80;
    listen [::]:80;

    . . .

    root /var/www/html/quickstart/public;
    index index.php index.html index.htm index.nginx-debian.html;

    server_name example.com www.example.com;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    . . .
}
```

`sudo ln -s /etc/nginx/sites-available/your_server_ip /etc/nginx/sites-enabled/`

`sudo systemctl reload nginx`

If you have a domain, you can further secure your site with HTTPS via Let's Encrypt.

[Easily add HTTPS via Let's Encrypt using Nginx](https://www.digitalocean.com/community/tutorials/how-to-secure-nginx-with-let-s-encrypt-on-ubuntu-16-04)

#### Articles referenced:

[Full tutorial](https://www.digitalocean.com/community/tutorials/how-to-deploy-a-laravel-application-with-nginx-on-ubuntu-16-04)

[initial server set up](https://www.digitalocean.com/community/tutorials/initial-server-setup-with-ubuntu-16-04)

[Easily add HTTPS via Let's Encrypt using Nginx](https://www.digitalocean.com/community/tutorials/how-to-secure-nginx-with-let-s-encrypt-on-ubuntu-16-04)
EOT;

        $post->image_src = "/images/blog2.jpg";
        $post->slug = "rendering-html-from-a-mysql-database";
        $post->save();

    }
}
