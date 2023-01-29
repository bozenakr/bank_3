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
    public function index()
    {
        $customers = Customer::all()->sortBy('name')->sortBy('surname');
        return view('back.index', [
            'customers' => $customers
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
                'personal_id.regex' => `Id doesn't exist`,
                'personal_id.integer' => `Id doesn't exist, please enter numbers only`,
                'personal_id.unique' => 'Account with this ID already exists',

            ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }
        
                
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->surname = $request->surname;
                $customer->iban= 'LT' . rand(40,60) . 35000 . rand(10000000000,99999999999);
                $customer->personal_id = $request->personal_id;
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
                'personal_id.regex' => `Id doesn't exist`,
                'personal_id.integer' => `Id doesn't exist, please enter numbers only`,

            ]);
            
            $request->flash();
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
                
                $customer->name = $request->name;
                $customer->surname = $request->surname;
                $customer->iban = $request->iban;
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
                'naujaSuma.numeric' => 'Please enter numbers',
                'naujaSuma.min' => 'Please enter numbers greater than 0',
               
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
                'naujaSuma.numeric' => 'Please enter numbers',
                'naujaSuma.min' => 'Please enter numbers greater than 0',
               
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
         return redirect()->back()->with('no', `Account can't be deleted, balance is not 0`);
    }
}