<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $menuDir = public_path('img/menu');
        $menuItems = [];
        $categories = ['All'];

        if (File::exists($menuDir)) {
            $files = File::files($menuDir);
            foreach ($files as $file) {
                $filename = $file->getFilename();

                if (str_contains(strtolower($filename), 'unknown') || str_contains(strtolower($filename), 'image')) {
                    continue;
                }

                $parts = explode('-', $filename);
                $category = count($parts) > 1 ? ucfirst($parts[0]) : 'Other';

                $menuItems[] = [
                    'filename' => $filename,
                    'category' => $category,
                ];

                if (! in_array($category, $categories)) {
                    $categories[] = $category;
                }
            }

            usort($menuItems, function ($a, $b) {
                return strcmp($a['filename'], $b['filename']);
            });
        }

        $activeCategory = $request->query('category', 'All');

        if ($activeCategory !== 'All') {
            $menuItems = array_filter($menuItems, function ($item) use ($activeCategory) {
                return $item['category'] === $activeCategory;
            });
        }

        return view('gallery', compact('menuItems', 'categories', 'activeCategory'));
    }
}
