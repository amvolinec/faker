<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    private $table = 'fv_addressbook_contact';
    protected $faker;

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        if (Schema::connection('mysql2')->hasTable($this->table)) {

            $columns = Schema::connection('mysql2')->getColumnListing($this->table);
            $items = DB::connection('mysql2')->table($this->table)->orderBy('id', 'desc')->paginate(25);
            return view('contacts.index', ['columns' => $columns, 'items' => $items, 'name' => $this->table]);
        } else {
            session()->flash('status', 'Table not found!');
            return view('tables.error');
        }
    }

    public function add(ContactRequest $request)
    {
        $qty = (int)$request->get('qty');
        factory(Contact::class, $qty)->create();
        return back()->withInput();
    }
}
