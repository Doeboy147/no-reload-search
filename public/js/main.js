angular.module('MainApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).controller('MainCtrl', function ($scope, $http) {
    $scope.getAll = function () {
        $http.get('/getCars').then(function (response) {
            $scope.cars = response.data.listings.data;
            console.log(response.data.listings.data );
        }).catch(function (error) {
            console.log(error.data);
        });
    };

    $scope.getAll();

    $scope.search = function (query) {
        let data = {};
        if (query.length > 2) {
            data.search = query;
            $http.post('/search', data).then(function (response) {
                $scope.cars = response.data.listings.data;
            }).catch(function (error) {
                console.log(error.data)
            })
        } else {
            $scope.getAll();
        }
    }
});
