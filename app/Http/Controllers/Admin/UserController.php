<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user){
        $this->repository = $user; // depositar em repository, um objeto de user
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
        {
            return redirect()->back();
        }
        return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
        {
            return redirect()->back();
        }

        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUserRequest $request, $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
        {
            return redirect()->back();
        }

        $data = $request->only('name', 'email');

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
        {
            return redirect()->back();
        }

        $user->delete();
        return redirect()->route('users.index');
    
    }

     /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $users = $this->repository
                                ->where(function($query) use($request){
                                    if ($request->filter)
                                    {
                                        $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                        $query->orWhere('email', 'LIKE', "%{$request->filter}%");
                                    }
                                })
                                ->latest()
                                ->tenantUser()
                                ->paginate();
        //SE PESQUISA FOR MAIOR, LEVAR PRO MODEL, COMO NOS PLANS

        return view('admin.pages.users.index', compact('users','filters'));
    }
}
