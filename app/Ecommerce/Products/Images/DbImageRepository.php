<?php

namespace Ecommerce\Products\Images;

use Image;
use Ecommerce\Products\Images\Image as Model;
use Ecommerce\Products\Images\ImageRepositoryInterface;

class DbImageRepository implements ImageRepositoryInterface
{
    /**
     * Save a image of a product.
     * 
     * @param array $files
     * @param int $productId
     */
    public function save(array $files, $productId) 
    {
        foreach($files as $file)
        {
            $image = Image::make($file)
                ->resize(500,500)
                ->encode('data-url');

            Model::create([
                'product_id' => $productId,
                'image' => $image
            ]);
        }
    }

    /**
     * Delete a image of a product.
     * 
     * @param int $id
     * @return boolean
     */
    public function delete($id) 
    {
        return Model::findOrFail($id)->delete();
    }
}