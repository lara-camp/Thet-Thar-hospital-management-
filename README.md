# Hospital Management

This is a Hospital Management System developed by Team Fresher. We use laravel breeze , sanctum and next js for frontend.

<a target="_blank" align="center">
  <img align="right" top="500" height="300" width="400" alt="GIF" src="https://media.giphy.com/media/SWoSkN6DxTszqIKEqv/giphy.gif">
</a>


## The Functions We Fought
1. CRUD
2. Mail Notification
3. Authorization and Authentication
4. Filter Function
5. Log Rotation with laravel scheduler
6. RealTime Chatting
7. Oauth 2 function (github , gmail)
8. RealTime Video Chatting

## Recommended IDE Setup for local

[VSCode](https://code.visualstudio.com/) + [mysql wordbrench](https://www.mysql.com/products/workbench/) 

## Project Setup

```sh
composer install
```

### key generate
```sh
php artisan key:generate
```

### migration and seeding for Development

```sh
php artisan migrate
```

### To Run 

```sh
php artisan serve
```

## API EndPoints
You can check the  API documentation below.  
 [postman](https://lively-crater-677764.postman.co/workspace/LMA~4936dc03-b87a-4b87-b653-22a314bdd5c9/collection/7575557-b858b49a-b84f-4962-bd4c-45106d4f660a?action=share&creator=7575557&active-environment=7575557-5ae7ec5d-7d37-453b-bf23-6ad16d03e69f) 

## Environment Varibles (optional)

Copy `.env.example` to `.env` and set the environment variables.

## Frontend code 

You can follow this link for frontend code if you want . You can download code from any branch.
[Frontend](https://github.com/SpringArts/HospitalManagement-fe)

## Login Account

- For Superadmin
```sh
superadmin@gmail.com
12345678
```

- For Hospital Admin
```sh
aungzawphyo1102@gmail.com
12345678
```

- For Doctor
```sh
doctorone@gmail.com
12345678
```

- For Patient
```sh
patientone@gmail.com
12345678
```

### For Mail Setup 

 You need to setup your own mail address . If you don't want you can test from this .[mailtrap](https://mailtrap.io/)
We setup with this in .env and we also uploaded that file . If we want to this real time mail setup , you can test with this .
```sh
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=happy.friday.helloworld@gmail.com
MAIL_PASSWORD=loelzxxdpbcldzpz
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="${APP_NAME}"
```
