@extends('layouts.app')

@section('content')
    <div class="container-fluid" ng-controller="MainCtrl">
        <div class="row pl-md-5 p-sm-4 bg-white">
            <div class="col-md-12 mb-5">
                <h1 class="text-dark mb-3 mt-4"> Dashboard</h1>

                <h5> Welcome <span class="text-danger"> Guest</span>, here's all your listings </h5>
            </div>

            <div class="col-md-12 mb-5">
                <button class="btn btn-dark btn-lg shadow" data-toggle="modal" data-target="#addListing">
                    <i class="fa fa-plus"></i>
                    Add New Listing
                </button>
                @include('includes.add-listings')

                {{--<span class="float-right">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg shadow">
                        <i class="fa fa-lock"></i>
                        Logout
                    </button>
                </form>
                </span>--}}

            </div>
        </div>
        <!--search -->
        <div class="row mt-4 pl-md-5">
            <div class="col-md-12">
                <form>
                    <div class="form-group row">
                        <div class="col-md-4 mb-3">
                            <input type="text" ng-model="query" placeholder="Search" class="form-control shadow-sm">
                        </div>
                        <div class="col-md-4 mb-3 mt-1">
                            <button type="submit" ng-click="getResults(query)" class="btn btn-dark shadow"><i
                                    class="fa fa-search"></i> Search
                            </button>
                            <button type="reset" ng-click="getAll()" class="btn btn-danger shadow"><i
                                    class="fa fa-recycle"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12" id="loader">
            <div class="card bg-light">
                <div class="loader"></div>
            </div>
        </div>

        <!--cars listing -->
        <div class="row pl-md-5 p-sm-5 mt-5">
            @if ($listings->count() > 0)
                <div dir-paginate="car in items | itemsPerPage: itemsPerPage" total-items="totalItems" class="col-md-3 mb-5">
                    <div class="card shadow">
                        <img src="<% car.picture %>" class="img-fluid imageThumb" alt="image">
                        <div class="card-body">
                            <div class="mb-4">
                                <strong><% car.maker %> <% car.model %> </strong><br>
                                <strong> Year :</strong> <% car.year %> <br>
                                <strong class="text-muted mb-3"><% car.created_at %> </strong><br>
                            </div>

                            <div>
                                <strong>Price</strong> <% car.price %> <br>
                            </div>

                            <div class="row mt-4">
                                <div class="col-6 col-sm-6">
                                    <strong> Add By :</strong> <% car.user.name %>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <a href="/delete-item/<% car.uuid %>"
                                       class="btn btn-danger shadow delete btn-block"> Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <dir-pagination-controls on-page-change="pageChanged(newPageNumber)"></dir-pagination-controls>
                </div>
                <!-- item end-->
            @else
                <div class="col-md-6 offset-3">
                    <div class="card shadow-sm">
                        <i class="fa fa-warning fa-5x text-danger text-center mt-5 mb-3"></i>
                        <h4 class="text-danger text-center">
                            You dont have items in your list
                        </h4>

                        <small class="mt-5 text-muted">
                        </small>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
