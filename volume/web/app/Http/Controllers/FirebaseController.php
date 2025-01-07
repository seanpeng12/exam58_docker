<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    // -------------------- [ Insert Data ] ------------------
    public function index()
    {

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/FirebaseKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://sna-master.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();
        $createPost = $database
            ->getReference('blog/posts')
            ->push([
                'title' => 'Laravel 6',
                'body' => 'This is really a cool database that is managed in real time.',
                'names' => 'I am Emma.',
            ]);

        echo '<pre>';
        print_r($createPost->getvalue());
        echo '</pre>';
    }

    // --------------- [ Listing Data ] ------------------
    public function getData()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/FirebaseKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://sna-master.firebaseio.com/
')
            ->create();

        $database = $firebase->getDatabase();
        $createPost = $database->getReference('blog/posts')->getvalue();
        return response()->json($createPost);
    }
}
