<?php

namespace App\Http\Controllers;


use App\Models\Group;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SortController extends Controller
{
    public function index()
    {
        $data = DB::table('groups')->orderBy('id', 'asc')->get();
        return view('test', compact($data));
    }


    function sort(Request $request)
    {
        if ($request->ajax()) {
            $vysl = '';
            $query = $request->get('query');
            switch ($query) {
                case 1:
                    $data = DB::table('groups')->orderBy('id', 'asc')->get();
                    break;
                case 2:
                    $data = DB::table('groups')->orderBy('id', 'desc')->get();
                    break;
                case 3:
                    $data = DB::table('groups')->orderBy('id', 'asc')->get();
                    break;
                case 4:
                    $data = DB::table('groups')->orderBy('id', 'desc')->get();
                    break;
                case 5:
                    $data = DB::table('groups')->orderBy('name', 'asc')->get();
                    break;
                case 6:
                    $data = DB::table('groups')->orderBy('name', 'desc')->get();
                    break;
                default:
                    $data = DB::table('groups')->orderBy('id', 'desc')->get();
                    break;
            }
            //echo json_encode($data);
            //return $data;
            //return response($data);
            return view('test', ['data' => $data])->render();
        }
    }

}