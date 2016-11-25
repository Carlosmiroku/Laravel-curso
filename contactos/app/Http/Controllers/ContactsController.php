<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Contact;
use App\Group;
class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$contacts = Contact::all();
        $contacts = Contact::paginate(5);
        return view('contacts.index', compact('contacts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::pluck('name', 'id');
        return view('contacts.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        Contact::create($request->all());
        return redirect()->route('contacts.index');
        /*$contact = new Contact;
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->group = $request->group;
        $contact->save();
        return redirect()->route('contacts.index'); */

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact')); //Esta linea ahorra todo el codigo anterior.
       /* $contact = Contact::findOrFail($id);
       return view('contacts.show', compact('contact')); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
     //$contact = Contact::findOrFail($id); //de igual forma que en show, ahorra todo el código.
    $groups= Group::pluck('name', 'id');
    return view('contacts.edit', compact('contact', 'groups'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //$contact = Contact::findOrFail($id);
       /* $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->group = $request->group;
        $contact->save(); */
        $contact->update($request->all());
        return redirect()->route('contacts.show', $contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //$contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index');
    }

    public function confirmDestroy(Contact $contact) {
        //$contact = contact::findOrFail($id);


    return view('contacts.confirmDestroy', compact('contact'));
    }


    public function __construct(){

        // $this->middleware('family',['only'=>['show']]);
        $this->middleware('auth');
    }
}