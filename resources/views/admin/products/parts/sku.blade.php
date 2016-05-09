<div class="row form-inline" style="margin-bottom:20px;">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" class="form-control" ng-model="newSku.id" style="min-width:300px;" id="skuCode" placeholder="SKU code">
        </div>
        <button type="button" ng-click="addSku()" class="btn btn-default">Add SKU</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Skus</div>
    <ul class="list-group">
        <li ng-repeat="sku in product.skus" class="list-group-item" ng-init="sku.show = 1">
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left"><strong>[[sku.id]]</strong></div>
                    <div class="pull-right text-right">
                        <button type="button" class="btn btn-xs btn-default" ng-click="sku.show = !sku.show">[[sku.show ? 'Show Details' : 'Hide Details']]</button>
                        <button type="button" ng-click="deleteSku($index)" class="btn btn-xs btn-danger">Delete</button>
                    </div>
                </div>
                <div class="col-sm-12" ng-show="!sku.show" style="margin-top: 10px;">
                    <div class="details">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" ng-model="sku.id"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Before Price</label>
                                    <input type="number" class="form-control" min="1" ng-model="sku.before_price"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" min="1" ng-model="sku.price"/>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" class="form-control" min="1" ng-model="sku.stock"/>
                                </div>
                            </div>
                        </div>
                        <div ng-show="product.variants.length > 0">
                            <hr/>
                            <div class="form-horizontal">
                                <div class="form-group" ng-repeat="variant in product.variants">
                                    <label class="col-sm-1 control-label">[[variant.title]]</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" 
                                        ng-options="option.title for option in variant.options track by option.id"
                                        ng-model="sku.variants[variant.id]">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>

<!--<div class="row form-inline" style="margin-bottom:20px;">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" class="form-control" ng-model="newSku.id" style="min-width:300px;" id="skuCode" placeholder="SKU code">
        </div>
        <button type="button" ng-click="addSku()" class="btn btn-default">Add SKU</button>
    </div>
</div>

<div class="panel panel-default" ng-repeat="sku in product.skus">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-left"><span class="text-bold">SKU:</span> [[sku.id ? sku.id : 'Undefined']]</div>
                <div class="pull-right">
                    <button type="button" ng-click="deleteSku($index)" class="btn btn-xs btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>SKU</label>
                    <input type="text" class="form-control" ng-model="sku.id"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Before Price</label>
                    <input type="number" class="form-control" min="1" ng-model="sku.before_price"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" min="1" ng-model="sku.price"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" class="form-control" min="1" ng-model="sku.stock"/>
                </div>
            </div>
        </div>
        <div ng-show="product.variants.length > 0">
            <hr/>
            <div class="form-horizontal">
                <div class="form-group" ng-repeat="variant in product.variants">
                    <label class="col-sm-1 control-label">[[variant.title]]</label>
                    <div class="col-sm-10">
                        <select class="form-control">
                            <option value="">N/A</option>
                            <option value="[[option.id]]" ng-repeat="option in variant.options">[[option.title]]</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->