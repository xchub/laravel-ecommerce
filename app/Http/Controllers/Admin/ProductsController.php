<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;

use Ecommerce\Products\ProductRepositoryInterface;

class ProductsController extends Controller
{
    /**
     * Product repository.
     *
     * @var ProductRepositoryInterface
     */
    protected $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->middleware('auth');

        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', [
            'products' => $this->product->getAllPaginated(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param ProductRequest $request
     * @param type $id
     * @return type
     */
    public function store(ProductRequest $request)
    {
        try
        {
            DB::beginTransaction();

            $product = $this->product->save($request->all());

            DB::commit();

            return [
                'status' => true,
                'product' => $product
            ];
        }
        catch (\Exception $ex)
        {
            DB::rollback();

            return $ex->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.products.edit', [
            'product' => $this->product->findWithVariants($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();

            $product = $this->product->save($request->all(), $id);

            DB::commit();

            return [
                'status' => true,
                'product' => $product
            ];
        }
        catch (\Exception $ex)
        {
            DB::rollback();

            return $ex->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->delete((int)$id);

        return redirect()
                ->route('admin.products.index')
                ->with('Product has been deleted.');
    }

    /**
     * Find a product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function json($id)
    {
        return $this->product->findWithVariants($id);
    }
}
