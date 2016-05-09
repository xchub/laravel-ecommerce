<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Product</a></li>
    <li role="presentation"><a href="#sku" aria-controls="sku" role="tab" data-toggle="tab">SKU</a></li>
    <li role="presentation"><a href="#variants" aria-controls="variants" role="tab" data-toggle="tab">Variants</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="product">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit product form</div>
                    <div class="panel-body">   
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" ng-model="product.title" id="title" placeholder="Type the product name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control" ng-model="product.description" id="description" placeholder="Describe the product"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Bundle product?</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="bundle" id="optionsRadios1" value="1" ng-model="product.bundle"> Yes
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="bundle" id="optionsRadios2" value="0" ng-model="product.bundle" checked> No
                                </label>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="sku">
        @include('admin.products.parts.sku')
    </div>

    <div role="tabpanel" class="tab-pane" id="variants">
        @include('admin.products.parts.variants')
    </div>
</div>