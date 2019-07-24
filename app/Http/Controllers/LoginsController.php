<?php

namespace App\Http\Controllers;

use Datatables;
use DB;
use Hash;
use App\DataTables\LoginsDataTable;
use App\DataTables\LoginsUsersDataTable;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Flashy;
use App\Common\Utility; 
use Illuminate\Support\Facades\Auth;
use App\Login;

class LoginsController extends Controller
{
    public function __construct()
    {
        
        $this->middleware(['permission:user-create']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
  
       public function index()
    {

             
      
    }


    public function logslist(LoginsDataTable $dataTable)
    {

             
        return $dataTable->render('Logs.index');
    }

     public function mylogins(LoginsUsersDataTable $dataTable)
    {

             
        return $dataTable->render('Logs.mylogins');
    }


       public function deletelogs(LoginsDataTable $dataTable)
    {
           Login::truncate();
             
       Flashy::error('Eliminados correctamente');
        return redirect()->route('logs.logslist');
    }





}
