<p align="center">
<a href="https://incubator-eg.com" target="_blank">
<img src="https://incubator-eg.com/asset/img/brand.png" width="400"></a></p>



# Incubator Dashboard

## This is steps to install website dashboard

### 1. Make sure you have nodejs, npm and bower installed on your machine


```bash
sudo apt-get update
```

```bash
sudo apt-get install nodejs
```

```bash
sudo apt install yarn
```

### 2. Run composer require PackageName

```pash
composer require ahmed-bermawy/laravel-dashboard
```

### 3. Publish package files

```pash
php artisan vendor:publish --tag=dashboard --force
```
### 4. Make sure that you have created a database and modified the env file


### 5. Install package dependencies

```pash
php artisan dashboard:setup
```
This command will Install AdminLte package, install Spatie permission, install Fontawesome package, and install LaravelCollective package

### 6. Publish package dependencies files

```pash
php artisan vendor:publish --all --force
```
This command will publish dependencies packages files

### 7. Run migrate to install databases
```pash
php artisan migrate
```

### 8. Seed data
```pash
php artisan dashboard:seed
```
This command will seed data from seeders to database and edit webpack.mix.js put package assets files paths in to webpack.mix.js to compile and minimize them at next step
### 9. Compile and minimize scss & js files by laravel mix
```pash
npm run dev
```
### 10. Make sure your website is running
```pash 
php artisan serve
```
### 11. Default route, username and password
```

default dashboard path=> "http://127.0.0.1:8000/dashboard/login" 
default username=> "admin@admin.com" 
default password => "12345678"
```

# Documentation 
Please see
<a href="https://dashboard.incubator-eg.com/">Incubator</a>
for more information.

# Issues
If you discover any issues, please email <a href="mailto:info@incubator-eg.com?subject=New issue report" target="_blank">info@incubator-eg.com
</a>
