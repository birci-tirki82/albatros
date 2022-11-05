<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {

        $user = Auth::user();
        if ($user){
            $addresses = Address::where('user_id', $user->id)->get();
            return Inertia::render('Frontend/Address', compact('user', 'addresses'));
        } else {
            return Inertia::render('Frontend/Login');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $user = Auth::user();
        return Inertia::render('Frontend/AddAddress', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(AddressRequest $request)
    {
//        return $request;
        Address::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'surname' => $request->surname,
            'country' => $request->country,
            'city' => $request->city,
            'district' => $request->district,
            'zipcode' => $request->zipcode,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();

        return Inertia::render('Frontend/Address', compact('addresses', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function destroy($id)
    {
//        return $id;
        $addresses = Address::find($id);
        $addresses->delete();
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
//        ->with('publisher' , function($query) { $query->withTrashed(); })
        return Inertia::render('Frontend/Address', compact('addresses', 'user'));
    }
}
