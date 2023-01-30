<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $customers = Customer::all()->sortBy('name')->sortBy('surname');

        $perPageShow = in_array($request->per_page, Customer::PER_PAGE) ? $request->per_page : 'all';

        $customers = Customer::where('id', '>', 0);

        $customers = match($request->sort ?? '') {
            'asc_name' => $customers->orderBy('name')->orderBy('surname'),
            'desc_name' => $customers->orderBy('name', 'desc')->orderBy('surname', 'desc'),
            'asc_surname' => $customers->orderBy('surname')->orderBy('name'),
            'desc_surname' => $customers->orderBy('surname', 'desc')->orderBy('name', 'desc'),
            'asc_balance' => $customers->orderBy('balance'),
            'desc_balance' => $customers->orderBy('balance', 'desc'),
            default => $customers->orderBy('surname')->orderBy('name')
        };

        $customers = match($request->filter ?? '') {
            'balanceZero' => Customer::where('balance', '=', '0'),
            'balanceNotZero' => Customer::where('balance', '>', '0'),
            default => Customer::where('id', '>', 0)
        };


            if( $perPageShow == 'all') {
                $customers = $customers->get();
            } else {
                $customers = $customers->paginate($perPageShow)->withQueryString();
            }
        

        return view('back.index', [
            'customers' => $customers,

            'sortSelect' => Customer::SORT,
            'sortShow' => isset(Customer::SORT[$request->sort]) ? $request->sort : '',

            'filterSelect' => Customer::FILTER,
            'filterShow' => isset(Customer::FILTER[$request->filter]) ? $request->filter : '',
            
            'perPageSelect' => Customer::PER_PAGE,
            'perPageShow' => $perPageShow
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           return view('back.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required|alpha|min:3',
            'surname' => 'required|alpha|min:3',
            'personal_id' => 'required|integer|unique:customers,personal_id|regex:/^([3-6]{1})([0-9]{2})([0-1]{1})([0-9]{1})([0-3]{1})([0-9]{1})([0-9999]{4})$/'
            ],
            [
                'name.required' => 'Field can not be empty',
                'name.min' => 'Please enter at least 3 characters',
                'name.alpha' => 'Please enter correct name',
                'surname.required' => 'Field can not be empty',
                'surname.min' => 'Please enter at least 3 characters',
                'surname.alpha' => 'Please enter correct surname',
                'personal_id.required' => 'Field can not be empty',
                'personal_id.regex' => 'Id doesn`t exist',
                'personal_id.integer' => 'Id doesn`t exist, please enter numbers only',
                'personal_id.unique' => 'Account with this ID already exists',

            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
                
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->surname = $request->surname;
                $customer->personal_id = $request->personal_id;
                $customer->iban = 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999);
                $customer->balance = 0;
        
                $customer->save();
                
                return redirect()->route('customers-index')->with('ok', 'Account succesfully added');
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('back.edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
{
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required|alpha|min:3',
            'surname' => 'required|alpha|min:3',
            'personal_id' => 'required|integer|regex:/^([3-6]{1})([0-9]{2})([0-1]{1})([0-9]{1})([0-3]{1})([0-9]{1})([0-9999]{4})$/'
            ],
            [
                'name.required' => 'Name field can not be empty',
                'name.min' => 'Please enter at least 3 characters',
                'name.alpha' => 'Please enter correct name',
                'surname.required' => 'Surname field can not be empty',
                'surname.min' => 'Please enter at least 3 characters',
                'surname.alpha' => 'Please enter correct surname',
                'personal_id.required' => 'Field can not be empty',
                'personal_id.regex' => 'Id doesn`t exist',
                'personal_id.integer' => 'Id doesn`t exist, please enter numbers only',

            ]);
            
            $request->flash();
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
                
                $customer->name = $request->name;
                $customer->surname = $request->surname;
                $customer->iban = $customer->iban;
                $customer->personal_id = $request->personal_id;
                $customer->balance = $customer->balance;
        
                $customer->save();
                
                return redirect()->route('customers-index')->with('ok', 'Account succesfully edited');
        }

    public function showDeposit(Customer $customer)
    {
         return view('back.deposit', [
            'customer' => $customer
        ]);
    }

    public function deposit(Request $request, Customer $customer)
    {
         $validator = Validator::make(
            $request->all(),
            [
            'naujaSuma' => 'numeric|min:0.01',
            ],
            [
                'naujaSuma.numeric' => 'Please enter number',
                'naujaSuma.min' => 'Please enter number greater than 0',
               
            ]);

             if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $customer->balance = $customer->balance + $request->naujaSuma;
        $customer->save();
        return redirect()->back()->with('ok', 'Money succesfully added');
        
    }

    public function showWithdraw(Customer $customer)
    {
         return view('back.withdraw', [
            'customer' => $customer
        ]);
    }

    public function withdraw(Request $request, Customer $customer)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'naujaSuma' => 'numeric|min:0.01',
            ],
            [
                'naujaSuma.numeric' => 'Please enter number',
                'naujaSuma.min' => 'Please enter number greater than 0',
               
            ]);

             $request->flash();

             if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

        if ($customer->balance >= $request->naujaSuma){
            $customer->balance = $customer->balance - $request->naujaSuma;    
        $customer->save();
        return redirect()->back()->with('ok', 'Money succesfully deducted');
        }else{
        return redirect()->back()->with('no', 'Please type correct withdrawal amount');
        }    
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if ($customer->balance == 0){
            $customer->delete();
            return redirect()->route('customers-index')->with('ok', 'Account successfully deleted');
        }
        return redirect()->back()->with('no', 'Account can`t be deleted, balance is not 0');
    }


    //     public function logout(Request $request)
    // {
    //     auth()->logout();
    //     return redirect()->route('show-login');
    // }
}