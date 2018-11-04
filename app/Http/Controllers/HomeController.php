<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public $customer;
    public $transaction;

    public function __construct
    (
        Customer $customer,
        Transaction $transaction
    )
    {
        $this->customer = $customer;
        $this->transaction = $transaction;
    }

    public function createUser()
    {
        if(request()->get('password') !=  request()->get('password_confirmation')){
            Session::flash('error', 'Password Do not match');
            return back();
        }
        $user = User::where('email', request()->get('email'))->first();
        if($user){
            Session::flash('error', 'User already Exists');
            return back();
        }
        if(request()->has('user_id') && request()->get('user_id') > 0){
            $user = User::find(request()->get('user_id'));
            $user->update([
                'name' => request()->get('name'),
                'email' => request()->get('email'),
                'password' => Hash::make(request()->get('password')),
            ]);
            $message = "Profile Updated";
        }else{
            User::create([
                'name' => request()->get('name'),
                'email' => request()->get('email'),
                'password' => Hash::make(request()->get('password')),
            ]);
            $message = 'User Created Successfully';
        }
        Session::flash('message', $message);
        return back();
    }

    public function index()
    {
        $customers = $this->customer->getCustomers();
        $data = [
            'customers' => $customers
        ];
        return view('customer.index')->with($data);
    }

    public function store(CustomerRequest $customerRequest)
    {
        if(request()->get('customer_id') == 0 && $this->customer->checkCustomerIfExists()){
            Session::flash('error', 'Customer Already Exists');
            return back();
        }
        $customer = $this->customer->saveCustomer();
        return redirect()->route('home');
    }

    public function show($customerId)
    {
        $customer = $this->customer->find($customerId);
        return view('customer.partials._edit-customer', compact('customer'));
    }

    public function destroy($customerId)
    {
        $customer = $this->customer->find($customerId);
        if($customer){
            $customer->delete();
            return back();
        }
        return back();
    }

    public function showPoints($customerId)
    {
        $customer = $this->customer->find($customerId);
        return view('customer.partials._update-points', compact('customer'));
    }

    public function usePoints($customerId)
    {
        $customer = $this->customer->find($customerId);
        $histories = $customer->histories;
        $data =  [
            'customer' => $customer,
            'histories' => $histories
        ];

        return view('customer.partials._use-points')->with($data);
    }

    public function updateRewardPoints()
    {
        $status = $this->customer->updatePoints();
        Session::flash('message', 'Reward Points Updated');
        return redirect()->route('home');
    }

    public function savePointUsed($customerId)
    {
        $customer = $this->customer->find($customerId);
        if($customer->reward_amount < request()->get('reward_amount')){
            Session::flash('error', 'Reward Amount not enough');
            return back();
        }
        $customer->reward_amount = $customer->reward_amount - request()->get('reward_amount');
        $customer->save();
        (new \App\PointHistory)->saveHistory();
        return back();
    }

    public function getTransactionForm($customerId, $transactionId = 0)
    {
        $data= [
            'customerId' => $customerId,
            'transaction' => $this->transaction->find($transactionId)
        ];
        return view('customer.partials._transaction')->with($data);

    }

    public function saveTransaction()
    {
        $transaction = $this->transaction->saveTransaction();
        Session::flash('message', 'Transaction Saved Successfully');
        return redirect()->route('home');
    }

    public function getTransactions($customerId)
    {
        $customer = $this->customer->find($customerId);
        return view('customer.partials._transactions', compact('customer'));
    }

    public function deleteTransaction($transactionId)
    {
        $this->transaction->find($transactionId)->delete();

        return back();
    }

    public function editMyProfile(){
        $user = auth()->user();
        return view('auth.register', compact('user'));
    }
}
