<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class StudentController extends Controller
{
    protected $database = null;
    protected $userTable = null;
    public function __construct()
    {
        $this->database = $this->connect();
        $this->userTable = $this->database->getReference('users');
    }

    public function connect()
    {
        //$database = app('firebase.database'); Service Container Usage
        $firebase = (new Factory) 
                    ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
                    ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        return $firebase->createDatabase();
    }

    public function index() 
    {
        $users = $this->userTable->getSnapshot()->getValue();
        dd($users);
    }

    public function create()
    {
        $this->userTable
             ->push([
                'name' => "Aung Kaung Myat",
                'position' => "Professional Programmer",
                'age' => "24",
                'level' => 99
             ]);
        dd("Success");
    }

    public function update()
    {
        $id = '-O-QxeqWs8vLi9SNhQqr';
        $users = $this->userTable->getChild($id)->update([
            'name' => "Aung Kaung Myat (Pro Dota 2)",
            'position' => "Professional Programmer And Also Handsome",
            'age' => "25",
            'level' => 100
        ]);
        return dd("Success");
    }

    public function show()
    {
        $id = '-O-QxeqWs8vLi9SNhQqr';
        $user = $this->userTable->getChild($id)->getSnapshot()->getValue();
        dd($user);
    }

    public function destroy()
    {
        $id = 1;
        $this->userTable->getChild($id)->remove();
        dd("Success");
    }
}
