<?php

namespace App\Http\Controllers;

use App\Models\t_category;
use App\Models\restaurant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = t_category::all();


        $dishes = restaurant::with('category')->orderBy('id', 'desc')->get();

        return view('hienthitheodanhmuc', [
            'categories' => $categories,
            'dishes' => $dishes
        ]);
    }
}
