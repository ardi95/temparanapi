<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $data['nama'] = 'ardiansyah pratama';

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|numeric',
            'name' => 'required|numeric'
        ]);

        $data['nama'] = 'ardiansyah pratama';

        return response()->json($data);
    }

    //
}
