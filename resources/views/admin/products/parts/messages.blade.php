<div ng-show="errors.length > 0" class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <ul>
        <li ng-repeat="error in errors">[[error]]</li>
    </ul>
</div>

<div ng-show="statusSubmit" class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    The product has been saved.
</div>