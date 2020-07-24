<?php

namespace App\Http\Controllers;

use App\Models\Departament;
//use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartament;
use App\Http\Requests\UpdateDepartament;
use Illuminate\Support\Facades\Storage;

class DepartamentController// extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departament.index', ['departaments' => Departament::paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departament.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreDepartament  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartament $request)
    {
        // Создание нового Отдела
        $departament = Departament::create([
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $request->logo->store('logo')
        ]);

        // Привязка пользователей к отделу
        $departament->users()->sync($request->users);
        // Перенаправление на индексную страницу с уведомление об успешном добавлении
        return redirect()->route('departaments.index')->with('create-departament', $departament->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function show(Departament $departament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function edit(Departament $departament)
    {
        return view('departament.form', ['departament' => $departament]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateDepartament  $request
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartament $request, Departament $departament)
    {
        // Обновление названия Отдела
        $departament->name = $request->name;
        // Обновление описания отдела
        $departament->description = $request->description;
        // Привязка пользователей к отделу
        $departament->users()->sync($request->users);

        // Если добален новый логотип
        if ($request->has('logo')){
            // Удалить файл старого
            Storage::delete($departament->logo);
            // Сохранить новый
            $departament->logo = $request->logo->store('logo');
        }
        
        // Сохранение обновлённого экземпляра модели Отдела
        $departament->save();
        // Перенаправление на индексную страницу с уведомление об успешном обновлении
        return redirect()->route('departaments.index')->with('update-departament', $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departament $departament)
    {
        // Удаление файла логотипа
        Storage::delete($departament->logo);
        // Удаление экземпляра модели
        $departament->delete();
        // Перенаправление на индексную страницу с уведомление об успешном удалении
        return redirect()->route('departaments.index')->with('delete-departament', $departament->name);
    }
}
