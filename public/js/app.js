'use strict';
angular.module('myApp',['ngRoute'])
.config(function ($routeProvider) {
  var myUrl='https://laravelprojectbooks.herokuapp.com/';
  //var myUrl='http://localhost/laravelproject/public/';
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl',
        resolve: {apiUrl : function(){return myUrl;}}

      })
      .when('/books', {
        templateUrl: 'views/books.html',
        controller: 'BookCtrl',
        resolve: {apiUrl : function(){return myUrl;}}
      })
      .when('/sales', {
        templateUrl: 'views/sales.html',
        controller: 'SaleCtrl',
        resolve: {apiUrl : function(){return myUrl;}}
      })
      .when('/booksales', {
        templateUrl: 'views/sale_book.html',
        controller: 'SaleBookCtrl',
        resolve: {apiUrl : function(){return myUrl;}}
      })
      .otherwise({
        redirectTo: '/'
      });
  })
