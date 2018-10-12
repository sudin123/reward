<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\PointHistory;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
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
        return redirect()->route('home');
    }

    public function savePointUsed($customerId)
    {
        $customer = $this->customer->find($customerId);
        if($customer->reward < request()->get('point_used')){
            Session::flash('error', 'Point not enough');
            return back();
        }
        $customer->reward = $customer->reward - request()->get('point_used');
        $customer->save();
        (new \App\PointHistory)->saveHistory();
        return back();
    }
}
