<p align="center"><img src="https://www.cesi.fr/wp-content/uploads/2018/09/cesi-logo.png"></p>

## About the project

Our goal is to make a website for the BDE of our school. We use multiples technolgies :
- <b>Laravel Framework :</b> It own our website in back-end.
- <b>Node.js :</b> It own our homemade API.

You can have more details about our project <a href="https://moodle-exia.cesi.fr/course/view.php?id=762">here</a> (Only if you have a CESI account).

## About us

We are three in the team. Each one has its own speciality.

- <b> Charlotte Madroux :</b> She is specialized in javascript back-end and front-end. She manages to create the API and helped to create the database.
- <b> Maxime Maître :</b> He works in all the part in front-end. He build all the pages of the website using HTML5 and CSS3.
- <b> Tristan Boulesteix :</b> He is the team leader. He built the back-end of the website using the PHP language and the Laravel framework. He also built the database.

## How to run the website ?
1) Clone the repository.
2) Create two mysql databases (one for user account and one for everything else).
3) Update configuration files ("/laravel/.env" and "/Node/server.js") in function of the pathes and names of the two databases.
4) Start the Node.js server named "server.js".
5) In the laravel folder, run the command "composer update".
6) In the laravel folder, run the command "php artisan migrate".
7) In the laravel folder, run the command "php artisan storage:link".
8) Run the werbsite (located in "/laravel/public") (You need to create a VirtualHost to make the website work properly).


## ! The projet is still in development !
