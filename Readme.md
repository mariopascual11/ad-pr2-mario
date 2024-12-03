Primer paso entraremos en mi github
git clone https://github.com/mariopascual11/ad-pr2-mario.git
Una vez tengamos el clon desde el guake entraremos a la carpeta y pondremos .code
Dentro abrimos un terminal y entramos en backend
Pondremos los comandos
composer install -n --prefer-dist
cp .env.ci .env
php artisan key:generate
php artisan serve
con esto ya ejecutariamos el servidor es hora de ir a front end y abrir el index.html

