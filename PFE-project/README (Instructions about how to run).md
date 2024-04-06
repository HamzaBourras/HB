# PFE: E-Learning Platform

### **Installation Instructions :**

1. cd <project_directory>     ***// change directory to project folder***

**ReactJS**

1. cd <project_directory>/frontend    ***// change directory to frontend***
2. npm install  ***// install dependencies***
3. npm run dev  ***// Start the React development server***

**Laravel**

1. cd <project_directory>/backend  ***// change director to backend***
2. delete the "composer.lock" file
3. cp .env.example .env
4. composer install  ******// install all dependencies declared in "composer.json" file***
5. php artisan key:generate ******// generate a key for the application***
6. change the name of database in the configuration in the file ".env" to e-learning-platform
7. php artisan migrate ******// add migrations to database***
8. php artisan serve ******// start the laravel server***

// open another terminal and run those commands

1. npm install
2. npm run dev
