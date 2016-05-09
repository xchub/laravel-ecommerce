var app = angular.module('EcommerceApp', ['ngMaterial']);

app.config(function($interpolateProvider) {

    $interpolateProvider.startSymbol('[[');

    $interpolateProvider.endSymbol(']]');

});

app.controller('ProductController', function($scope, $http){

    $scope.productId = null;
    $scope.product = {};
    $scope.errors = [];
    $scope.newOption = {};

    $scope.newSku = {
        id:null, 
        main:false
    };

    $scope.newVariant = {
        id:null, 
        title:null
    };

    $scope.loadModel = function(productId){
        $scope.productId = productId;
        console.log(productId);
        $http({
            url: '/admin/product/json/' + productId, 
            method: "GET"
        }).then(function(response){
            $scope.product = response.data;
        }, function(error){
            console.log('Error: ', error);
        });
    };

    $scope.addSku = function() {

        if($scope.product.skus === undefined){
            $scope.product.skus = [];
        }

        if($scope.newSku.id){
            $scope.product.skus.unshift({
                id: $scope.newSku.id,
                main: false
            });
        }
    };

    $scope.deleteSku = function(index){
        $scope.product.skus.splice(index,1);
    };

    $scope.addVariant = function() {

        if($scope.product.variants === undefined){
           $scope.product.variants = []; 
        }

        if($scope.newVariant.title){
            $scope.product.variants.push({
                id: null,
                title: $scope.newVariant.title
            });
        }
    };

    $scope.deleteVariant = function(index){
        $scope.product.variants.splice(index,1);
    };

    $scope.addOption = function(variant, newOption)
    {
        if(variant.options === undefined){
           variant.options = []; 
        }

        if(newOption.title){
            variant.options.push({
                id: null,
                title: newOption.title
            });
            newOption.title = null;
        }
    };

    $scope.deleteOption = function(variant, index){
        variant.options.splice(index, 1);
    };

    $scope.openVariantOptions = function(variant){
        console.log('open variant options');
    };

    $scope.submitCreate = function(form)
    {
        event.preventDefault();
        $scope.errors = [];
        $http.post('/admin/products', $scope.product)
                .then(success, error);
        return false;
    };

    $scope.submitUpdate = function(form)
    {
        event.preventDefault();
        $scope.errors = [];
        $http.put('/admin/products/' + $scope.productId, $scope.product)
                .then(success, error);
        return false;
    };

    function success(response) 
    {
        $scope.statusSubmit = response.data.status ? response.data.status : false;

        if(response.data.status === true) {
            $scope.product = response.data.product;    
        }else{
            Object.keys(response.data).forEach(function(key) {
                angular.forEach(response.data[key], function(value, key) {
                    $scope.errors.push(value);
                });
            });
        }
    }

    function error(response){
        console.log('Error', response);
    }
});