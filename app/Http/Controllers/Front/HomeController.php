<?php

namespace App\Http\Controllers\Front;

use App\Shop\Categories\Category;
use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class HomeController
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * HomeController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cat = Category::whereNull('parent_id')->orderBy('id','desc')->get();
        $cat1 = null;
        $cat2 = null;

        if (!empty($cat)) {
            $cat1 = $this->categoryRepo->findCategoryById($cat[0]->id);
            if (!empty($cat[1])) {
                $cat2 = $this->categoryRepo->findCategoryById($cat[1]->id);    
            }
        }
        
        return view('front.index', compact('cat1', 'cat2'));
    }
}
