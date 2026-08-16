<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\EventModel;
class AdminController extends Controller
{
public function index()
{
    return view('admin.index', [
        'totalUser' => UserModel::count(),
        'totalRole' => RoleModel::count(),
        'totalEvent' => EventModel::count(),
    ]);
}
}