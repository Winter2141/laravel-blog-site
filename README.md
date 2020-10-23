
git에서 프로젝트를 다운로드하고 composer를 설치합니다.

phpmyadmin 에서 db_blog 자료기지를 새로 만듭니다.

```
git clone https://github.com/ZhuYi0101/laravel-blog-site.git
cd laravel-blog-site
composer install
npm install
copy .env.example .env(windows)/cp .env.example .env(Linux)
php artisan key:generate
```
.env 파일에서 DB_DATABASE 의 항목을 db_blog 로 수정합니다.

```
php artisan migrate
php artisan db:seed
php artisan serve
Homepage URL::localhost:8000
```


```
Admin Account Information : 
Admin Name : superadmin
Admin Email : admin@gmail.com
Admin Password : 12345678
```
