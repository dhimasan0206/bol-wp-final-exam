# bol-wp-tk3-tk4

## development

1. `docker-compose exec myapp composer require jeroennoten/laravel-adminlte`
2. `docker-compose exec myapp php artisan adminlte:install`
3. `docker-compose exec myapp composer require laravel/ui`
4. `docker-compose exec myapp php artisan ui bootstrap --auth`
5. `docker-compose exec myapp php artisan adminlte:install --only=auth_views`
6. `docker-compose exec myapp php artisan adminlte:plugins install --plugin=icheckBootstrap`
7. `docker-compose exec myapp npm install`
8. `docker-compose exec myapp npm run dev` atau `docker-compose exec myapp npm run build`
9. ikuti `https://spatie.be/docs/laravel-permission/v5/installation-laravel`
10. `docker-compose exec myapp composer require spatie/laravel-permission`
11. `docker-compose exec myapp php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"`
12. tambah `use Spatie\Permission\Traits\HasRoles;` ke `app/Models/User.php`
13. tambah permission, role dan user seeder di DatabaseSeeder
14. `docker-compose exec myapp php artisan migrate:fresh --seed`
15. `docker-compose exec myapp php artisan make:model Membership -a`
16. tambah seeder Membership di DatabaseSeeder
17. `docker-compose exec myapp php artisan migrate:fresh --seed`
18. `docker-compose exec myapp php artisan make:model Customer -a`
19. tambah seeder Customer di DatabaseSeeder
20. `docker-compose exec myapp php artisan migrate:fresh --seed`
21. `docker-compose exec myapp php artisan make:model ExchangeRate -a`
22. tambah seeder ExchangeRate di DatabaseSeeder
23. `docker-compose exec myapp php artisan migrate:fresh --seed`
24. `docker-compose exec myapp composer require laravelcollective/html`
25. tambah CRUD membership, customer, dan exchange rate
26. `docker-compose exec myapp php artisan make:model Transaction -a`
27. `docker-compose exec myapp php artisan make:model TransactionDetail -a`
28. tambah CRUD transaction

## local deployment

1. `docker-compose up` or `docker-compose up -d`
2. `docker-compose exec myapp php artisan migrate:fresh --seed`
3. buka `http://localhost:8000` atau `http://0.0.0.0:8000`
4. Login sebagai:
   1. Super Admin:
      1. email: superadmin@laravel.com
      2. password: superadmin1234
      3. Bisa semuanya (manajemen valas, customer, transaksi, dan membership)
   2. Admin:
      1. email: admin@laravel.com
      2. password: admin1234
      3. Bisa manajemen valas, customer, dan transaksi
