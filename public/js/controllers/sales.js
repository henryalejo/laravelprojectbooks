'use strict';
angular.module('myApp')
  .controller('SaleCtrl', function ($scope,$http,apiUrl) {
    $scope.sales={};
    $scope.saleDetails={};
    $scope.total=0;
    $scope.tempSale={};
    var url= apiUrl;
    $http.get(url+ 'sale').then(function successCallback(response) {
                          console.log(response.data);
                          $scope.sales=  response.data;

                        }, function errorCallback(response) {
                            console.log(response.data);
                        });

    $scope.details= function(sale){
      $http.get(url+ 'sale/'+sale.id).then(function successCallback(response) {
                            console.log(response.data);
                            $scope.saleDetails=  response.data;
                            setTotal();
                            $scope.tempSale = sale;
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
