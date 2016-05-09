<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Ecommerce\User;
use Ecommerce\Users\UserRepositoryInterface;
use Ecommerce\Customers\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use Ecommerce\Events\CustomerHasRegistered;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     *
     * @var CustomerRepositoryInterface
     */
    protected $customerRepo;

    /**
     *
     * @var UserRepositoryInterface 
     */
    protected $userRepo;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(CustomerRepositoryInterface $customer, 
            UserRepositoryInterface $user)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->customerRepo = $customer;
        
        $this->userRepo = $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $customer = $this->customerRepo->create($data);

        $user = $this->userRepo->create($data, $customer->id);

        event(new CustomerHasRegistered($customer));

        return $user;
    }
}
