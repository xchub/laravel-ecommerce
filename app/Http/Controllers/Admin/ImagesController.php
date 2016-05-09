<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use Ecommerce\Products\ProductRepositoryInterface;
use Ecommerce\Products\Images\ImageRepositoryInterface;

class ImagesController extends Controller
{
    /**
     * The images repository.
     * 
     * @var ImageRepositoryInterface 
     */
    protected $repo;
    
    /**
     * The Product repository.
     * 
     * @var ProductRepositoryInterface 
     */
    protected $productRepo;

    public function __construct(ImageRepositoryInterface $repo,
            ProductRepositoryInterface $productRepo) 
    {
        $this->repo = $repo;

        $this->productRepo = $productRepo;
    }

    /**
     * Show the product images.
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id) 
    {
        $product = $this->productRepo->find($id);

        $product->load('images');

        return view('admin.products.images', [
            'product' => $product
        ]);
    }

    /**
     * Save the product images.
     * 
     * @param Request $request
     */
    public function save(ImageRequest $request, $id) 
    {
        $this->repo->save($request->file('image'), (int)$id);

        return redirect()
                ->route('admin.products.images', $id)
                ->with('image_sucess', 'The image(s) has been uploaded.');
    }

    /**
     * Delete a image of a product.
     * 
     * @param int $imageId
     */
    public function delete($productId, $imageId) 
    {
        $this->repo->delete($imageId);
        
        return redirect()
                ->route('admin.products.images', $productId)
                ->with('image_sucess', 'The image has been deleted.');
    }
}
