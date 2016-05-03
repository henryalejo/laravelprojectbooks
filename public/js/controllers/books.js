'use strict';
angular.module('myApp')
  .controller('BookCtrl', function ($scope,$http,apiUrl) {
    $scope.books={};
    $scope.edit={};
    $scope.postBook={};
    $http.get(apiUrl+ 'book').then(function successCallback(response) {
                          $scope.books=  response.data;

                        }, function errorCallback(response) {
                            console.log(response.data);
                        });

  $scope.save = function(){
    console.log($scope.edit);
  $http.put(apiUrl+ 'book/'+$scope.edit.id, $scope.edit).then(function successCallback(response) {
                          console.log(response.data);
                          $scope.edit={};
                          $scope.postBook={};

                        }, function errorCallback(response) {
                            console.log(response.data);
                        });

  }
  $scope.editModel = function(book){

    $scope.postBook={};
    $scope.edit = book;

  }
  $scope.deleteBook = function (id){
    $http.delete(apiUrl+'book/'+id).then(function successCallback(response) {
                            console.log(response.data);

                          }, function errorCallback(response) {
                              console.log(response.data);
                          });
  }
  $scope.add = function(){
    $scope.edit={};
    $scope.postBook.id = 0;
  };
  $scope.new = function (){
    console.log($scope.postBook);
    $http.post(apiUrl+'book',$scope.postBook).then(function successCallback(response) {
                            console.log(response.data);
                            $scope.edit={};
                            $scope.postBook={};

                          }, function errorCallback(response) {
                              console.log(response.data);
                          });
  }
  });
