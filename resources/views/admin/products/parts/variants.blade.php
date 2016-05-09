<div class="row form-inline" style="margin-bottom:20px;">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" class="form-control" ng-model="newVariant.title" style="min-width:300px;" id="exampleInputEmail2" placeholder="Variant name">
        </div>
        <button type="button" ng-click="addVariant()" class="btn btn-default">Add variant</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Variants</div>
    <ul class="list-group">
        <li ng-repeat="variant in product.variants" class="list-group-item" ng-init="variant.show = 1">
            <div class="row">
                <div class="col-sm-12">
                    <div class="pull-left"><strong>[[variant.title]]</strong></div>
                    <div class="pull-right text-right">
                        <button type="button" class="btn btn-xs btn-default" ng-click="variant.show = !variant.show">[[variant.show ? 'Show Options' : 'Hide Options']]</button>
                        <button type="button" ng-click="deleteVariant($index)" class="btn btn-xs btn-danger">Delete</button>
                    </div>
                </div>
                <div class="col-sm-12" ng-show="!variant.show" style="margin-top: 10px;">
                    <div class="details">
                        <table class="table table-condensed table-hover">
                            <tr ng-repeat="option in variant.options">
                                <td><input type="text" class="form-control" ng-model="option.title" /></td>
                                <td>
                                    <a href ng-click="deleteOption(variant, $index)"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" ng-init="variant.newOption" ng-model="variant.newOption.title" placeholder="Title of variant" /></td>
                                <td>
                                    <a ng-click="addOption(variant, variant.newOption)" class="btn btn-sm btn-info">Add</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>