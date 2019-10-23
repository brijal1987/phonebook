<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('phonebook');
});
Route::get('/contacts', function (Request $request) {
    $contacts = App\Contact::query();
    if($request->search) {
        $searchWords = str_split($request->search);
        foreach($searchWords as $word){
            $contacts->where('name', 'LIKE', '%'.$word.'%');
        }
    }
    $count = $contacts->get()->count();

    $contacts = $contacts
    ->orderBy('name','ASC')
    ->distinct()
    ->skip(0)
    ->take(3)
    ->get();
    return response()->json([
        "totalCount" => $count,
        "Contacts" => $contacts,
        "searchWords" => $searchWords
    ]);
});
