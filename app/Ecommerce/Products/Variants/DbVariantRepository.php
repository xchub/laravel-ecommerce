<?php

namespace Ecommerce\Products\Variants;

use Ecommerce\Products\Variants\Variant as Model;
use Ecommerce\Products\Variants\VariantRepositoryInterface;
use Ecommerce\Products\Variants\Options\OptionRepositoryInterface;

class DbVariantRepository implements VariantRepositoryInterface
{
    /**
     * Variant option repository.
     * 
     * @var OptionRepositoryInterface
     */
    protected $option;

    public function __construct(OptionRepositoryInterface $option) 
    {
        $this->option = $option;
    }
    
    /**
     * Save a product into database.
     * 
     * @param array $data
     * @param int $productId
     * @return Product
     */
    public function save($data, $productId)
    {
        $variants = [];
        if(is_array($data))
        {
            foreach($data as $item)
            {
                $obj = Model::firstOrCreate([
                    'id' => $item['id']
                ]);

                $obj->fill([
                    'title' => $item['title'],
                    'product_id' => $productId
                ]);

                $obj->save();

                if(isset($item['options'])){
                    $this->option->save($item['options'], $productId, $obj->id);
                }
                
                $variants[] = $obj->id;
            }
        }

        Model::where('product_id', $productId)
                    ->whereNotIn('id', $variants)
                    ->delete();
    }
}