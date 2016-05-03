'use strict';
angular.module('myApp')
  .controller('SaleBookCtrl', function ($scope,$http,apiUrl) {
    $scope.books={};
    $scope.saleDetails={};
    $scope.tempBook={};
    $scope.total=0;
    var url= apiUrl;
    $http.get(url+ 'book').then(function successCallback(response) {
                          console.log(response.data);
                          $scope.books=  response.data;

                        }, function errorCallback(response) {
                            console.log(response.data);
                        });

    $scope.details= function(book){
      $http.get(url+ 'sale/book/'+book.id).then(function successCallback(response) {
                            console.log(response.data);
                            $scope.saleDetails=  response.data;
                            setTotal();
                            $scope.tempBook=book;
                          }, function errorCallback(response) {
                              console.log(response.data);
                          });
    }
    var setTotal = function(){
      var temp =0;
      angular.forEach($scope.saleDetails, function(data, key) {
        temp= temp + (parseFloat( data.pivot.num_books)*parseFloat(data.pivot.book_curr_val));
           });
      $scope.total =temp;
    };
  })
