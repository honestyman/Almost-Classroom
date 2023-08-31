
# Almost-Classroom

## About the project 
Almost-Classroom is a web application inspired by [Google Classroom](https://classroom.google.com/). This project was my the first bigger application I have created using Laravel. Almost-Classroom was also my IT high-school final project that I had to create - both the website and also documentation and then defend my work. Project has some of the more basic functions like user registering, authenticating, authorizing using email verification or even using Google. I have also implemented features such as real-time listing filtering and pagination, image uploading, nested comment section and more! The application supports both dark and light mode depending on user's browser settings.


## Technologies used to accomplish this solution are:

 - [Laravel](https://laravel.com/)
 - [Livewire v2](https://laravel-livewire.com/)
 - [TailwindCSS](https://tailwindcss.com/)
 
## Try it yourself!
First you need to clone the repository.

    git clone https://github.com/svareX/Almost-Classroom

Then install all the package and dependencies.

    composer install

After that you need to setup an .env file (use the .env.example as a template)

    copy .env.example .env

Generate a new application key

    php artisan key:generate

Create your database table.

    php artisan migrate


While you have a local database server like [XAMPP](https://www.apachefriends.org/)
Then all you need to do is to start a local Laravel server.

    php artisan serve

## Image gallery

<p align="center">
<img src="https://i.ibb.co/4279gvF/Fire-Shot-Capture-007-app-preview-png-PNG-obr-zek-1920-1200-bod-M-tko-80-localhost.png" alt="Fire-Shot-Capture-007-app-preview-png-PNG-obr-zek-1920-1200-bod-M-tko-80-localhost">
</p>


<p align="center">
<img src="https://i.ibb.co/g7NJBvr/Fire-Shot-Capture-008-Almost-Classroom-localhost.png" alt="Fire-Shot-Capture-008-Almost-Classroom-localhost">
</p>

<p align="center">
<img src="https://i.ibb.co/5R2yNPz/Fire-Shot-Capture-010-Almost-Classroom-localhost.png" alt="Fire-Shot-Capture-010-Almost-Classroom-localhost" >
</p>

<p align="center">
<img src="https://i.ibb.co/gPFVHbs/Fire-Shot-Capture-009-Almost-Classroom-localhost.png" alt="Fire-Shot-Capture-009-Almost-Classroom-localhost" >
</p>

<p align="center">
<img src="https://i.ibb.co/ZHVkj75/Fire-Shot-Capture-011-Almost-Classroom-localhost.png" alt="Fire-Shot-Capture-011-Almost-Classroom-localhost">
</p>

## License
MIT License

Copyright (c) [2023]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
