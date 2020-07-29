<p align="center">Setup: </p>

<ol>
    <li>Run docker-compose up -d</li>
    <li>Configure your .env file</li>
    <li>Run command docker-compose exec app bash</li>
    <li>Install all dependencies via composer install</li>
    <li>Execute command php artisan key:generate</li>
    <li>Run command php artisan migrate</li>
    <li>Run command php artisan db:seed</li>
    <li>Go to browser and type localhost:80 </li>
</ol>
