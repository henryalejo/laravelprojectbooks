angular.module('myApp',[])
.controller('mainController',function($scope,$http){
  $scope.books=  $scope.getBooks();



  $scope.getBooks =function(){

    $http.get('http://localhost/laravelproject/public/books').then(function(res){

        return res.data;

    });

  };

});
