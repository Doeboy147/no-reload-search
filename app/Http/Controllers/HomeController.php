<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Repositories\Listing as Repository;
use Illuminate\Support\Facades\Auth;
use Laravel5Helpers\Exceptions\LaravelHelpersExceptions;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/


    public function index()
    {
        try {
            $data['listings'] = $this->getRepository()->setResultOrder('created_at', 'DESC')->getPaginated();
            return view('home', $data);
        } catch (QueryException $exception) {
            return $this->ajaxError($exception->getMessage());
        }
    }

    public function getCars()
    {
        try {
            $cars = $this->getRepository()->setResultOrder('created_at', 'DESC')->getPaginated();
            foreach ($cars as $car) {
                $car['picture'] = $car->getUrl();
            }
            return $cars;
        } catch (QueryException $exception) {
            return $this->ajaxError($exception->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $cars = $this->getRepository()->searchCars($request['search']);
            foreach ($cars as $car) {
                $car['picture'] = $car->getUrl();
            }
            return $cars;
        } catch (LaravelHelpersExceptions $exception) {
            return $exception->getMessage();
        }
    }

    protected function getRepository()
    {
        return new Repository;
    }

}
