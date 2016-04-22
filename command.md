php artisan make:migration create_coursewares_table --create=coursewares
php artisan make:migration create_elements_table --create=elements
php artisan make:migration create_users_table --create=users
php artisan make:migration create_class_types_table --create=class_types


php artisan migrate

php artisan make:model Courseware
php artisan make:model Element
php artisan make:model User
php artisan make:model ClassType

//controller
php artisan make:controller ElementController --resource
php artisan make:controller ElementCollectionController --resource  //获取切片集合
php artisan make:controller CoursewareController --resource

//授权
php artisan make:policy ElementPolicy
php artisan make:policy CoursewarePolicy

//添加验证机制
php artisan make:auth


//seeder
php artisan make:seeder UsersTableSeeder
php artisan make:seeder ElementTableSeeder
php artisan make:seeder CoursewareTableSeeder

//执行seeder
php artisan db:seed

//回滚
php artisan migrate:refresh --seed