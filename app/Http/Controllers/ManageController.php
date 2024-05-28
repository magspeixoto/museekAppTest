<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;


class ManageController extends Controller
{
    public function index()
    {
        return inertia(
            'Manage/Index',
            [
                
            ]
        );
    }
}
