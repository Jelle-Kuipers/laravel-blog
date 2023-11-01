# School-Blog 
This is a simple blogpost site I made for school, to help showcase that I am ready for my exams.

## Set-up
1. Make sure your [Docker](), [Composer]() and [GIT]() are fully operational.
2. Clone this repository to a directory.
3. Edit the .env.example with your own values.
4. Run: ```Composer Install```
5. Docker compose up with: ```./vendor/bin/sail up```
6. After its done building and starting the image, go to ```localhost``` in your browser.

Now, if you see something along the line of:<br> ```file_put_contents(/var/www/html/storage/framework/views/275c7c02e2528e6029079c885e2d2418.php): Failed to open stream: Permission denied```<br>
You will need to:
1. Set a storage link
2. Set the ownership of the public/ and storage/

#### Set a storage link & ownership
This is how I solved my permission stream error
1. We need to open a bash terminal in our laravel container, using ```docker exec -it {docker-network-name}-{container-name} /bin/bash```.
2. Now we set the storage link using ```php artisan storage:link```
3. Once that is done, navigate to ```storage/``` using ```cd storage/```.
4. After we are in, set the ownership of all files to use sail:sail, by executing ```chown -R sail:sail .```
5. Check our ownership with ```ls -l``` to verify.
6. If all is good, leave the ```storage/``` directory and go to ```public/``` using: ```cd .. && cd public/```
7. Repeat steps 4 and 5.
8. Almost done! for good measure run: ```php artisan config:clear``` and ```php artisan cache:clear```.
9. Now, we exit the terminal by using ```exit``` twice.

Now, you should be able to see the starting page after going to ```localhost``` in your browser. <br>
## Requirements for the project where:
Making this project for school came with some requirements, such as:
- Userstories,
- Multipe user "roles",
- [A Database ERD,](https://lucid.app/lucidchart/52b253b3-3d93-4d82-bb35-b978f105942f/edit?invitationId=inv_69eaa6cb-9f54-438a-9419-99b71440da94)
- Give it a WYSIWYG editor,
- Atleast some basic front-end,
- Unit/Feature testing,

## Extra
So for my personal practice and interests, I decided to run a Dockerized version of Laravel 10.x<br>
Choosing to do so mainly to practice working with Docker, as previous experiences with Docker were quite good. <br>
I added PHPMyAdmin to the base image aswell (personal preference over MYSQL cli). <br>

