<?php

namespace Ecommerce\Products\Skus;

use Ecommerce\Products\Skus\SkuValue;
use Ecommerce\Products\Skus\Sku as Model;
use Ecommerce\Products\Skus\SkuRepositoryInterface;

class DbSkuRepository implements SkuRepositoryInterface
{
    /**
     * Fetch the SKU.
     * 
     * @param string $id
     * @return Sku
     */
    public function find($id) 
    {
        return Model::findOrFail($id);
    }

    /**
     * Save SKUs.
     * 
     * @param type $skus
     */
    public function save($skus, $productId) 
    {
        $skuIds = [];

        if(is_array($skus))
        {
            foreach($skus as $sku)
            {
                $obj = Model::firstOrNew([
                    'id' => $sku['id']
                ]);

                $obj->fill([
                    'product_id' => $productId,
                    'before_price' => $sku['before_price'],
                    'price' => $sku['price'],
                    'main' => $sku['main'],
                    'stock' => $sku['stock']
                ]);

                $obj->save();
                
                if(count($sku['variants']))
                {
                    foreach($sku['variants'] as $option)
                    {
                        $sku = SkuValue::firstOrNew([
                            'product_id' => $option['product_id'],
                            'variant_id' => $option['variant_id'],
                            'sku_id' => $obj->id
                        ]);
                        
                        $sku->fill([
                            'product_id' => $option['product_id'],
                            'variant_id' => $option['variant_id'],
                            'option_id' => $option['id'],
                            'sku_id' => $obj->id
                        ]);
                        
                        $sku->save();
                    }
                }

                $skuIds[] = $obj->id;
            }
        }

        Model::where('product_id', $productId)
                ->whereNotIn('id', $skuIds)
                ->delete();
    }
}