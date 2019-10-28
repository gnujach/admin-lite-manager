# Admin Lite Manager
Is a admin manager  for laravel 6 with awesome funcionality and vue component.
## Installation
1.Clone the repo  
		    https://github.com/gnujach/admin-lite-manager.git  
2.Install composer packages:  
		    composer update .  
3.Copy and rename .env.example to .env, update the environmental variables and set an app key:   
		       php artisan key:generate . 
4.After that, run all migrations and seed the database:  
		    php artisan migrate . 
 		    php artisan db:seed . 
Or if your database is fresh and you haven't done any work yet, then it's safe to call the commands in a single line:  
    	    php artisan migrate:refresh --seed . 
## Credit
- Laravel [Laravel](https://www.laravel.com) . 
- Vue [vue](https://www.vuejs.org)   
- TailwindCSS [Tailwind](https://tailwindcss.com) . 
