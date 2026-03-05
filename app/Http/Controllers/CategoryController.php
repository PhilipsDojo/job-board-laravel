<?php

// Controller nimmt Browser anfragen entgegen und ruft die entsprechenden Mehtoden auf

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // route: get/categories
    {
       $categories = Category::all(); // Zeigt ALLE Kategorien an (Listenansicht)
       return view('categories.index', compact('categories'));  // an View(FE) übergeben
    }

    /**
     * Show the form for creating a new resource.
     * route: Get /category/create
     */
    public function create()
    {
        return view ('categories.create');//
    }

    /**
     * Store a newly created resource in storage.
     * Route: POST /categories
     * Speichert neue kategorie
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());//       
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     * Route: GET /categories/{category}
     * zeige die gewünschte Kategorie
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));//
    }

    /**
     * Show the form for editing the specified resource.
     * * Zeigt das Bearbeitungs-Formular für eine Kategorie
     * Route: GET /categories/{category}/edit
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category')); //
    }

    /**
     * Update the specified resource in storage.
     * Route: PUT /categories/{category}
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categories.index');  //
    }

    /**
     * Remove the specified resource from storage.
     * Route: DELETE /categories/{category}
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index'); //
    }
}


// Merksatz 
// der Browser nimmt anfragen entgegen und schickt diese an den Controller via PUT / GET 
// hier wird dann entschieden, was damit passiert.

// erneut für mich bsp Category::create() 
// Category=Objekt  :: ich rufe dieses Objekt( den Baupklan) an möchte dann methode create() darauf anwenden. 
// die methode wird im Model geerbt. 
// vendor/laravel/framework/src/Illuminate/Database/Eloquent/model.php