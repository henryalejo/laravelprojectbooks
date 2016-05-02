'use strict';

/**
 * @ngdoc function
 * @name yeomanApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the yeomanApp
 */
angular.module('myApp')
  .controller('MainCtrl', function ($scope,$http) {

      //$scope.url='https://laravelprojectbooks.herokuapp.com/';
    var url= 'http://localhost/laravelproject/public/';
    $scope.books=[];
    $scope.placeDisable=false;
    $scope.cart= [];
    $scope.successPanel=false;
    $scope.total=0;
    $http.get(url+ 'book').then(function successCallback(response) {
                          console.log(response.data);
                          $scope.books=  response.data;

                        }, function errorCallback(response) {
                            console.log(response.data);
                        });
    $scope.placeOrder = function (){
      $scope.placeDisable=true;
      $scope.successPanel=false;

      if ($scope.cart.length > 0){
        var data={};
        data.books =$scope.cart
        $http.post(url+ 'sale',data).then(function successCallback(response) {
                              console.log(response);
                              $scope.successPanel=true;
                              $scope.placeDisable=false;
                              $scope.cart=[];//$scope.books=  response.data;
                              setTotal();
                            }, function errorCallback(response) {
                                console.log(response);
                            });
      }
    }
    var setTotal = function(){
      var temp =0;
      angular.forEach($scope.cart, function(data, key) {
        temp= temp + parseFloat( data.value);
      });
      $scope.total =temp;
    };
    $scope.remove =function(index){
      $scope.cart.splice(index,1);
      setTotal();

    };
    $scope.add = function (index){
      if($scope.cart.length==0){
        var carTemp=$scope.books[index];
        carTemp.num_books=1;
        $scope.cart.push(carTemp);
      }
      else {
        var temp = true;
        angular.forEach($scope.cart, function(value, key) {
          if(value.id ==$scope.books[index].id){
                    temp = false;
        }
        });
        if(temp){
          var carTemp=$scope.books[index];
          carTemp.num_books=1;
          $scope.cart.push(carTemp);
          console.log($scope.cart);
        }
      }
      setTotal();
    };



  });
