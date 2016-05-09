<?php

namespace Ecommerce\Products\Variants\Options;

use DB;
use Ecommerce\Products\Variants\Options\Option as Model;
use Ecommerce\Products\Variants\Options\OptionRepositoryInterface;

class DbOptionRepository implements OptionRepositoryInterface
{
    /**
     * Fetch a option by id.
     * 
     * @param int $id
     * @return type
     */
    public function find($id) 
    {
        return Model::findOrFail($id);
    }

    /**
     * Save options.
     * 
     * @param type $data
     * @param type $productId
     * @param type $variantId
     */
    public function save($data, $productId, $variantId)
    {
        $optionsId = [];

        if(is_array($data))
        {
            foreach($data as $item)
            {
                $obj = Model::firstOrCreate([
                    'id' => $item['id']
                ]);

                $obj->fill([
                    'title' => $item['title'],
                    'product_id' => $productId,
                    'variant_id' => $variantId
                ]);

                $obj->save();
                
                $optionsId[] = $obj->id;
            }
        }
        
        Model::where('product_id', $productId)
                    ->where('variant_id', $variantId)
                    ->whereNotIn('id', $optionsId)
                    ->delete();
    }
}