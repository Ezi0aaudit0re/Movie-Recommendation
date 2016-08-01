angular.module('myApp', [])
.controller('myController', function($scope, myFactory){
    $scope.data = {};
    $scope.message = undefined;
    $scope.getSuggestion = function(){
        myFactory.getSuggestion(function(data){
            if(data.code = 200){
                $scope.data = data.response;
                console.log($scope.data);
            }
            else {
                $scope.message = data.message;
            }
        })
    }

})
.factory('myFactory', function($http){
    var factory = {};
    var urlPrefix = "http://localhost:8000/api/v1/admin";
    factory.getSuggestion = function(callback){
        $http.get(urlPrefix + '/getSuggestion').success(function(data){
            callback(data);
        })
    }


    return factory;
})
