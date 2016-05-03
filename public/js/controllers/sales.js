'use strict';
angular.module('myApp')
  .controller('SaleCtrl', function ($scope,$http,apiUrl) {
    $scope.sales={};
    $scope.saleDetails={};
    $scope.total=0;
    var url= apiUrl;
    $http.get(url+ 'sale').then(function successCallback(response) {
                          console.log(response.data);
                          $scope.sales=  response.data;

                        }, function errorCallback(response) {
                            console.log(response.data);
                        });

    $scope.details= function(id){
      $http.get(url+ 'sale/'+id).then(function successCallback(response) {
                            console.log(response.data);
                            $scope.saleDetails=  response.data;
                            setTotal();
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
