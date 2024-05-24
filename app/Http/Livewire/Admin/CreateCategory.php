<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\MaxWords;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $parent_id;
    public $child_categories;
    public $catId;
    public $tagline;
    public $cover_photo;
    public $category_icon;

    public $showHideLevel2;
    public $showHideLevel3;
    public $updateCatId;
    public $addNewCategory = false;
    public $editCategoryModal = false;
    public $deleteConfirmModal = false;


    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|max:50|unique:categories,name,' . $this->updateCatId,
            'description' => ['required', 'string','max:250'],
            'parent_id' => 'numeric|nullable',
            'tagline' => ['required','string','min:5',new MaxWords(15,true)],
            'cover_photo' => ['required','image','dimensions:min_width=200,min_height=300,max_width=250,max_height=350'],
            'category_icon' => ['required','image','dimensions:min_width=200,min_height=300,max_width=250,max_height=350']
        ];
    }

    public function updatedName()
    {
        $this->validateOnly('name');
    }

    public function updatedCoverPhoto()
    {
        $this->validateOnly('cover_photo');
    }

    public function updatedDescription()
    {
        $this->validateOnly('description');
    }

    public function updatedParentId()
    {
        $this->validateOnly('parent_id');
    }

    public function updatedTagline()
    {
        $this->validateOnly('tagline');
    }

    // public function updatedCoverPhoto()
    // {
    //     $this->validateOnly('cover_photo');
    // }

    public function updatedCategoryIcon()
    {
        $this->validateOnly('category_icon');
    }

    // Close Modal
    public function closeModal($modal)
    {
        $this->$modal = false;
    }

    // Show Modal
    public function showModal($modal)
    {
        if($modal == "addNewCategory") $this->clearForm();
        $this->$modal = true;
    }

    //////////////////// DropDown Menu Show Sub Categories
    public function getSubCategories($parentCategory)
    {
        $this->child_categories = Category::where('parent_id', '=', $parentCategory)->get();
    }

    public function createCategory()
    {
        $this->validate();


        $this->parent_id = $this->parent_id > 0 ? $this->parent_id : NULL;

        $cover_photo_name = basename(parse_url($this->cover_photo->temporaryUrl(), PHP_URL_PATH));
        $icon_name = basename(parse_url($this->category_icon->temporaryUrl(), PHP_URL_PATH));

        $last_insert_id = Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id
        ])->id;

        if (isset($this->cover_photo)) {
            $path  = Storage::disk('local')->get('/livewire-tmp/' . $cover_photo_name);
            Storage::disk('public')->put('/images/categories/' . $cover_photo_name, $path);
        }

        if (isset($this->category_icon)) {
            $path  = Storage::disk('local')->get('/livewire-tmp/' . $icon_name);
            Storage::disk('public')->put('/images/categories/' . $icon_name, $path);
        }

        CategoryDetail::create([
            'category_id' => $last_insert_id,
            'tagline' => $this->tagline,
            'cover_photo' => $cover_photo_name,
            'icon' => $icon_name
        ]);

        $message = $this->parent_id > 0 ? "Sub Category successfully added" : "Category successfully added";

        // session()->flash('success', $message);
        $this->clearForm(); // reset form in modal
        $this->addNewCategory = false;

        return redirect()->route('admin.categories')->with('success', $message);


        // $this->dispatchBrowserEvent('refresh'); // refresh page
    }

    //////////////////// Clear Form Data
    public function clearForm()
    {
        $this->name = '';
        $this->description = '';
        $this->parent_id = '';
        $this->sectionTitle = '';
        $this->tagline = '';
        $this->cover_photo = '';
        $this->category_icon;
        $this->updateCatId = '';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function deleteCategory($id)
    {
        $this->catId = $id;
        $this->deleteConfirmModal = true;
    }

    public function delete(Category $category)
    {
        if(Category::find($this->catId)->delete()){
            session()->flash('success', 'Category successfully deleted.');
        }
        $this->catId = '';
        $this->deleteConfirmModal = false;
    }

    // show edit details
    public function editCategory($id)
    {
        $this->clearForm();
        $showCatDetail = Category::where('id', $id)->with(['parentCategory', 'detail'])->first();
        $this->updateCatId = $id;
        $this->name = $showCatDetail->name;
        $this->description = $showCatDetail->description;
        $this->tagline = $showCatDetail->detail->tagline;
        $this->editCategoryModal = true;
    }

    // update category
    public function updateCategory()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:50|unique:categories,name,' . $this->updateCatId,
            'description' => 'required|string|max:250',
            'tagline' => 'required|string|min:5|max:300',
        ]);

        $category = Category::findorFail($this->updateCatId);
        $data = ['name' => $this->name, 'description' => $this->description];
        $category->update($data);

        $catDetaiData = ['tagline' => $this->tagline];

        if (isset($this->cover_photo) && !empty($this->cover_photo)) {
            $cover_photo_name = basename(parse_url($this->cover_photo->temporaryUrl(), PHP_URL_PATH));
            $path  = Storage::disk('local')->get('/livewire-tmp/' . $cover_photo_name);
            if (Storage::disk('public')->put('/images/categories/' . $cover_photo_name, $path)) {
                Storage::disk('public')->delete('/images/categories/' . CategoryDetail::where('category_id', $category->id)->first()->cover_photo);
                $catDetaiData['cover_photo'] = $cover_photo_name;
            }
        }

        if (isset($this->category_icon) && !empty($this->category_icon)) {
            $icon_name = basename(parse_url($this->category_icon->temporaryUrl(), PHP_URL_PATH));
            $path  = Storage::disk('local')->get('/livewire-tmp/' . $icon_name);
            if (Storage::disk('public')->put('/images/categories/' . $icon_name, $path)) {
                Storage::disk('public')->delete('/images/categories/' . CategoryDetail::where('category_id', $category->id)->first()->cover_photo);
                $catDetaiData['icon'] = $icon_name;
            }
        }

        $category->detail()->update($catDetaiData);

        // session()->flash('success', 'Category updated successfully.');
        $this->editCategoryModal = false;
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
        // $this->dispatchBrowserEvent('refresh'); // refresh page
    }

    // show hide child accordion
    public function collapseSubChild($id, $parent1 = -1)
    {
        if ($id == $parent1) {
            $this->showHideLevel2 = NULL;
            $this->showHideLevel3 = NULL;
        } else {
            $this->showHideLevel2 = $id;
        }
    }

    // show hide subchild accordion
    public function collapseChildOfSubChild($id, $parent2 = -1)
    {
        if ($id == $parent2) {
            $this->showHideLevel3 = NULL;
        } else {
            $this->showHideLevel3 = $id;
        }
    }

    public function render()
    {
        return view('livewire.admin.create-category', [
            'categories' => Category::with(['childCategories' => function ($query) {
                $query->with('childCategories');
            }])->whereNull('parent_id')->get()
        ]);
    }
}
