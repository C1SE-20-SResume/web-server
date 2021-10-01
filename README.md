<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About SResume

API Url: [http://localhost/]

## Enviroment requirements

- [Composer](https://getcomposer.org/)
- [Nodejs](https://nodejs.org/en/)
- [Laragon](https://laragon.org/) (Optional: [XAMPP](https://www.apachefriends.org/index.html))

## How to install

First, you need to open your terminal at the project path
**Do all to use this!!!**

### Install dependencies

- Install vendor

```bash
composer install
```

- Install node_modules

```bash
npm install
npm run dev
```

### Configuration

- Rename .env.example to .env and fill in it with your information
  - DB_DATABASE: MySQL Database name
  - DB_USERNAME: MySQL Database username
  - DB_PASSWORD: MySQL Database password

- Migrate database & seed data

```bash
php artisan migrate --seed
```

- Run the command below to generate key

```bash
php artisan key:generate
```

### After pulled, updated code

- Run the command below if have any change in composer ("composer: ..." commit)

```bash
composer update
```

- If you want to reinstall / refresh the database and seed data, run the command below

```bash
php artisan migrate:refresh --seed
```

### Run 

- If you are using Laragon, then just start Apache (or Nginx) and MySQL
- If you are not, start MySQL and run the command below

```bash
php artisan serve
```

#### XAMPP, Laragon, etc

- If you are using Laragon, then your website will be at [localhost](http://localhost) or [projectfolder.test](projectname.test)

- If you are not, then your website will be at [http://127.0.0.1:8000](http://127.0.0.1:8000)

#### Hosting

- Not available

### Document

- You can login with the following account:
  - email: recruiter@example.org | password: password | level: Recruiter
  - email: candidate@example.org | password: password | level: Candidate

- API document: Not available

## Known bug(s)

- Run seed command sometime return error alert about existed primary key. Just run the command [here](#configuration) until it work.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
