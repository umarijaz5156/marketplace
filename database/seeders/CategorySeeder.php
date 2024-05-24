<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first
        $category = Category::create([
            'name' => 'Graphics',
            'description' => 'Graphics and design',
            'parent_id' => null
        ]);

       CategoryDetail::create([
            'category_id' => $category->id,
            'tagline' => 'Graphics and design',
            'cover_photo' => 'lPldcK1BOBXQ5kHgPqZzWFLy5eJNBc-metaaGVhZGVyX2ltZy5wbmc=-.png',
            'icon' => 'zjXPUeQjiYYCGCgcXolKvFbYsgeq9s-metaMTAxOS5zdmc=-.svg'
        ]);

        $childCategory = Category::create([
            'name' => 'Logos',
            'description' => 'Logo and brand',
            'parent_id' => $category->id
        ]);

        CategoryDetail::create([
            'category_id' => $childCategory->id,
            'tagline' => 'Logo and brand',
            'cover_photo' => 'lPldcK1BOBXQ5kHgPqZzWFLy5eJNBc-metaaGVhZGVyX2ltZy5wbmc=-.png',
            'icon' => 'zjXPUeQjiYYCGCgcXolKvFbYsgeq9s-metaMTAxOS5zdmc=-.svg'
        ]);

    // second
        $category = Category::create([
            'name' => 'Programming',
            'description' => 'You think it. A programmer develops it.',
            'parent_id' => null
        ]);

        CategoryDetail::create([
            'category_id' => $category->id,
            'tagline' => 'You think it. A programmer develops it.',
            'cover_photo' => 'lPldcK1BOBXQ5kHgPqZzWFLy5eJNBc-metaaGVhZGVyX2ltZy5wbmc=-.png',
            'icon' => 'zjXPUeQjiYYCGCgcXolKvFbYsgeq9s-metaMTAxOS5zdmc=-.svg'
        ]);

        $childCategory = Category::create([
            'name' => 'Websites',
            'description' => 'You think it. A programmer develops it.',
            'parent_id' => $category->id
        ]);

        CategoryDetail::create([
            'category_id' => $childCategory->id,
            'tagline' => 'You think it. A programmer develops it.',
            'cover_photo' => 'lPldcK1BOBXQ5kHgPqZzWFLy5eJNBc-metaaGVhZGVyX2ltZy5wbmc=-.png',
            'icon' => 'zjXPUeQjiYYCGCgcXolKvFbYsgeq9s-metaMTAxOS5zdmc=-.svg'
        ]);

        // third
        $category = Category::create([
            'name' => 'Digital Marketing',
            'description' => 'Build your brand. Grow your business.',
            'parent_id' => null
        ]);

        CategoryDetail::create([
            'category_id' => $category->id,
            'tagline' => 'Build your brand. Grow your business.',
            'cover_photo' => 'lPldcK1BOBXQ5kHgPqZzWFLy5eJNBc-metaaGVhZGVyX2ltZy5wbmc=-.png',
            'icon' => 'zjXPUeQjiYYCGCgcXolKvFbYsgeq9s-metaMTAxOS5zdmc=-.svg'
        ]);

        $childCategory = Category::create([
            'name' => 'Search',
            'description' => 'Search Engine Optimization',
            'parent_id' => $category->id
        ]);

        CategoryDetail::create([
            'category_id' => $childCategory->id,
            'tagline' => 'Build your brand. Grow your business.',
            'cover_photo' => 'lPldcK1BOBXQ5kHgPqZzWFLy5eJNBc-metaaGVhZGVyX2ltZy5wbmc=-.png',
            'icon' => 'zjXPUeQjiYYCGCgcXolKvFbYsgeq9s-metaMTAxOS5zdmc=-.svg'
        ]);
    }
}
