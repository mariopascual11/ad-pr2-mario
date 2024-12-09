1.Primer paso entraremos en guake y creamos una carpeta donde guardaremos nuestros proyectos y inicamos el git init

2. Despues iremos a git y copiaremos el link de clone , git clone https://github.com/mariopascual11/ad-pr2-mario.git

3. Una vez tengamos el clon desde el guake entraremos a la carpeta clonada con el comando, cd projects/ad-pr2-mario , una vez dentro pondremos .code ( nos abrira el visual studio)

4. Dentro abrimos un terminal y entramos en backend con el comando cd backend

5. Pondremos los siguientes comandos

6. composer install -n --prefer-dist

7. cp .env.ci .env

8. php artisan key:generate

9. php artisan serve

10. Con esto ya ejecutariamos el servidor es hora de ir a front end y abrir el index.html el cual se abrira con el navegador que tengamos puesto de predeterminado.

