<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
class ClientController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:read_clients'])->only('index');
        $this->middleware(['permission:create_clients'])->only('create');
        $this->middleware(['permission:update_clients'])->only('edit');
        $this->middleware(['permission:delete_clients'])->only('destroy');

    }

    public function index(Request $request)
    {
        $clients = Client::when($request->input('search'),function($q) use($request) {
        
            return $q->where('name','like','%'.$request->input('search').'%')->orwhere('address','like','%'.$request->input('search').'%');
        })->latest()->paginate(4);

        return view('dashboard.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
'name'=>'required',
'phone.0'=>'required|min:5',
'address'=>'required'

        ]);
        Client::create($request->all());
        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');
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

    
    public function edit(Request $request,Client $client)
    {
      return view('dashboard.clients.edit',compact('client'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    { $request->validate([
        'name'=>'required',
        'phone.0'=>'required|min:5',
        'address'=>'required'
        
                ]);
                $client->update($request->all());
                session()->flash('success',__('site.updated_successfully'));
                return redirect()->route('dashboard.clients.index');
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success',__('site.deleted_successfully'));
                return redirect()->route('dashboard.clients.index');
            
    }
}
