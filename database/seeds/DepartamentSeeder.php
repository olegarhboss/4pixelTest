<?php

use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Для добавления уникальных имеющихся изображений
        for ($i=1; $i < 16; $i++) {
            $departament = factory(App\Models\Departament::class)
           ->create([
               'logo' => 'logo/' . $i . '.png'
           ])
           ->each(function ($departament) {
                // генерация случайных наборов пользователей
                $users = [];
                for ($i=1; $i < rand(2, 17); $i++) { 
                    $users[] = rand(1, 16);
                }
                // Привязка случайных пользователей
                $departament->users()->sync(array_unique($users));
            });
        }
        
    }
}
