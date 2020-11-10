angular.module('MainApp', ['angularUtils.directives.dirPagination'], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).controller('MainCtrl', function ($scope, $http) {
    $scope.totalItems = 0;
    $scope.pageSize = 5;
    $scope.currentPage = 1;
    $scope.itemsPerPage = 0;


    $('#loader').hide();

    $scope.getAll = function () {
        $scope.query = '';
        $http.get('/getCars').then(function (response) {
            $scope.items = response.data.data;
            $scope.totalItems = response.data.total;
            $scope.itemsPerPage = response.data.per_page;
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
                $scope.items = response.data.data;
                $scope.totalItems = response.data.total;
                $scope.itemsPerPage = response.data.per_page;
            }).catch(function (error) {
                console.log(error.data)
            })
        } else {
            $('#loader').hide();
            $scope.getAll();
        }
    };

    $scope.pageChanged = function (newPage) {
        if(newPage !== 1) {
            getResultsPage(newPage);
        }
    };

    function getResultsPage(pageNumber) {
        $http.get('/getCars?page=' + pageNumber)
            .then(function (response) {
                $scope.items = response.data.data;
                $scope.totalItems = response.data.total;
                $scope.itemsPerPage = response.data.per_page;
            });
    }
}).config(function (paginationTemplateProvider) {
        paginationTemplateProvider.setPath('js/pagination.html')
    }
);
