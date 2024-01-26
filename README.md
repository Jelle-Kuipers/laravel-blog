# School-Blog 
This is a simple blogpost site I made for school, to help showcase that I am ready for my exams.

## Cloning and running the project locally
### 1. Requirements
To clone and use this project there are only 3 required programs you need to install, the rest will be handled in the set-up step.

1. Working GIT for source control.
2. PHP 8.2 for composer.
3. Composer for Docker to be able to run.
4. Docker to be able to run the project quickly.

### 2. Set-up
Copy and paste the .env.example file
Change your .env file to match the values you'd like
Run `bash first_time_setup.sh` to configure and start your containers for the first time.

To start and stop the containers after setup, run `./vendor/bin/sail up` to start or `./vendor/bin/sail down` to stop.

Now, you should be able to see the starting page after going to ```localhost``` in your browser. <br>

## School requirements:
This project had some requirements, such as:
- Laravel Jetstream for authentication and user managament
- Unique Database designed to work with Laravel migrations, [With ERD](https://lucid.app/lucidchart/52b253b3-3d93-4d82-bb35-b978f105942f/edit?invitationId=inv_69eaa6cb-9f54-438a-9419-99b71440da94)
- Users with CRUD control, multiple roles and a permission system that allows for granular control of a users permission
- Categories with CRUD control that can be limited to certain user roles
- Blogposts with CRUD control, containing a title, thumbnail, short description and text in a WYSIWYG editor which is assinged to a Category
- Like/Dislike system for blogposts, where a user can only vote once on a post.
- Userfriendly design with reponsiveness
- Security against CSRF and SQL injections
- Unit testing to verify the functionality of the application
- Documentation on how to clone/run the application and how to use the application.

## Extra
- I am running a Dockerized instane of Laravel using Laravel Sail. Since I have had some experience using Docker at my internship and have now grown quite fond of it.
- PHPMyAdmin image was added to the default Laravel Sail Docker Images so I am more easily able to work and see my database instead of relying on CLI based MYSQL containers.
- first_time_setup.sh was added purely for convience with development set-up.

- Sentry will be added in the future for easier error logging via a 3rd party.
- Eslinter will be added in the future and merged with Laravel pint for single command project linting.

when these functions are added, more documentation will appear here.