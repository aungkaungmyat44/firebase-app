<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $firestoreDB;
    protected $collection;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
        $this->collection = $this->firestoreDB->collection('users');
    }

    public function index() 
    {
        $documents = $this->collection->documents();

        // Convert Firestore documents to an array
        $users = [];
        foreach ($documents as $document) {
            $users[$document->id()] = $document->data();
        }
        return dd($users);
    }
    
    public function create()
    {
        $userRef = $this->collection->newDocument();
        $userRef->set([
            'name' => 'Abdul Moiz',
            'email' => 'abdulmoiz@example.com',
        ]);
        return dd($userRef);
    }

    public function update()
    {
        $userId = '6cecb7bf98894e8badba';
        $userRef = $this->collection->document($userId);

        $userRef->set([
            'name' => 'AKM Mobile Legend Bang Bang',
            'email' => 'aungkaungmyat@gmail.com'
        ], ['merge' => true]);

        return dd($userRef);
    }

    public function show()
    {
        $id = '6cecb7bf98894e8badba';
        $snapshot = $this->firestoreDB->collection('users')->document($id)->snapshot();
        return dd($snapshot->data());
    }

    public function destroy()
    {
        $userId = 1;
        $this->collection->document($userId)->delete();
        return dd("Success");
    }
}
