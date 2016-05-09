<?php

namespace Ecommerce\Products;

use DB;
use Ecommerce\Products\Product as Model;
use Ecommerce\Products\ProductRepositoryInterface;
use Ecommerce\Products\Skus\SkuRepositoryInterface;
use Ecommerce\Products\Variants\VariantRepositoryInterface;
use Ecommerce\Products\Variants\Options\OptionRepositoryInterface;

class DbProductRepository implements ProductRepositoryInterface
{
    /**
     * The SKU repository.
     *
     * @var SkuRepositoryInterface
     */
    protected $sku;

    /**
     * The variant repository.
     * 
     * @var VariantRepositoryInterface
     */
    protected $variantRepo;

    /**
     * The option reposutory.
     * 
     * @var OptionRepositoryInterface
     */
    protected $optionRepo;

    public function __construct(SkuRepositoryInterface $sku,
            VariantRepositoryInterface $productVariant, 
            OptionRepositoryInterface $optionRepo)
    {
        $this->sku = $sku;

        $this->variantRepo = $productVariant;
        
        $this->optionRepo = $optionRepo;
    }

    /**
     * Fetch a product by ID
     * @param int $id
     * @return Ecommerce\Products\Product
     */
    public function find($id)
    {
        return Model::findOrFail($id);
    }

    /**
     * Fetch a product by Slug.
     *
     * @param strint $slug
     * @return Ecommerce\Products\Product
     */
    public function findBySlug($slug)
    {
        $object = Model::where('slug', $slug)->firstOrFail();

        $object->sku = $object->skus()->main()->first();

        return $object;
    }

    /**
     * Fetch a product with variants.
     *
     * @param int $id
     * @return Product
     */
    public function findWithVariants($id) 
    {
        $product = Model::with([
            'skus',
            'variants' => function($query){
                $query->with('options');
            }]
        )->findOrFail($id);
    
        if(count($product->skus))
        {
            foreach($product->skus as $sku)
            {
                $variants = [];
                if($product->variants)
                {
                    foreach($product->variants as $variant)
                    {
                        $variants[$variant->id] = $sku->options()
                                ->where('options.variant_id', $variant->id)->first();
                    }
                }
                $sku->variants = $variants;
            }
        }

        return $product;
    }

    /**
     * Fetch all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Model::with('skus')->get();
    }

    /**
     * Fetch all products paginated.
     *
     * @param int $take
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPaginated($take = 20)
    {
        return Model::paginate($take);
    }

    /**
     * Fetch featured products.
     *
     * @param int $take
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFeatured($take = 20)
    {
        return Model::take($take)->get();
    }

    /**
     * Return the
     * @param type $id
     * @return type
     */
    public function variants($id)
    {
        $result = DB::table('skus as s')->select([
                    's.id',
                    'pv.title as attribute',
                    'o.title as value '
                ])->join('sku_values as sv', 's.id', '=', 'sv.sku_id')
                ->join('variants as pv', 'pv.id', '=',
                        'sv.variant_id')
                ->join('options as o', 'o.id', '=',
                        'sv.option_id')
                ->where('s.product_id', $id)
                ->get();

        $details = [];

        foreach($result as $detail)
        {
            if(!isset($details[$detail->id])){
                $details[$detail->id] = null;
            }

            $details[$detail->id] .= $detail->attribute . ' : ' .
                    $detail->value . ', ';
        }

        if(count($details)) {
            return $details;
        } else {
            return null;
        }
    }

    /**
     * Save a product into database.
     *
     * @param array $data
     * @param int $id
     * @return Product
     */
    public function save($data, $id = null)
    {
        $product = Model::firstOrNew([
            'id' => $id
        ]);

        $product->fill($data);

        $product->slug = str_slug($product->title);

        $product->save();

        if(isset($data['variants'])){
            $this->variantRepo->save($data['variants'], $product->id);    
        }

        if(isset($data['skus'])){
            $this->sku->save($data['skus'], $product->id);    
        }

        return $this->findWithVariants($product->id);
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * @return type
     */
    public function delete($id)
    {
        return Model::findOrFail($id)->delete();
    }
}