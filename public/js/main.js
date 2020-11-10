angular.module('MainApp', ['angularUtils.directives.dirPagination'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).controller('MainCtrl', function ($scope, $http) {
    $scope.totalItems = 0;
    $scope.pageSize = 4;
    $scope.currentPage = 1;

    $('#loader').hide();
    $scope.getAll = function () {
        $scope.query = '';
        $http.get('/getCars').then(function (response) {
            $scope.items = response.data.listings.data;
            $scope.totalItems = response.data.listings.total;
            $scope.itemsPerPage = response.data.listings.per_page;
        }).catch(function (error) {
            console.log(error.data);
        });
    };

    $scope.getAll();

    $scope.getResults = function (query) {
        $('#loader').fadeIn();
        setTimeout(function () {
        $scope.search(query);
        }, 1000);
    };

    $scope.search = function (query) {
        let data = {};
        if (query.length > 1) {
            data.search = query;
            $http.post('/search', data).then(function (response) {
                $('#loader').hide();
                $scope.items = response.data.listings.data;
                $scope.totalItems = response.data.listings.total;
                $scope.itemsPerPage = response.data.listings.per_page;
            }).catch(function (error) {
                console.log(error.data)
            })
        } else {
            $('#loader').hide();
            $scope.getAll();
        }
    }
}).config(function (paginationTemplateProvider) {
        paginationTemplateProvider.setPath('js/pagination.html')
    }
);
