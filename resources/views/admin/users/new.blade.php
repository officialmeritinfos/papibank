@extends('admin.base')
@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Create User</h4>
        </div>
        <div class="card-body">
            @include('templates.notification')
            <form class="user-form" method="post" action="{{route('admin.users.new.process')}}" enctype="multipart/form-data" id="registerForm">
                @csrf

                <h4 class="section-title"><i class="fas fa-user mr-2"></i> Personal Details</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" value="{{old('first_name')}}" placeholder="Enter your first name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" value="{{old('last_name')}}" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username" value="{{old('username')}}" placeholder="Enter your username">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Enter your email">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone" value="{{old('phone')}}" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input class="form-control" type="date" name="dob" value="{{old('dob')}}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-control" name="gender">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="Other">Others</option>
                            </select>
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-key mr-2"></i> Security</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Repeat your password">
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-briefcase mr-2"></i> Employment Information</h4>
                <div class="form-group">
                    <label>Occupation</label>
                    <select class="form-control" name="occupation">
                        <option value="Self Employed">Self Employed</option>
                        <option value="Public/Government Office">Public/Government Office</option>
                        <option value="Private/Partnership Office">Private/Partnership Office</option>
                        <option value="Business/Sales">Business/Sales</option>
                        <option value="Trading/Market">Trading/Market</option>
                        <option value="Military/Paramilitary">Military/Paramilitary</option>
                        <option value="Politician/Celebrity">Politician/Celebrity</option>
                    </select>
                </div>

                <h4 class="section-title"><i class="fas fa-map-marked-alt mr-2"></i> Address Information</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Country</label>

                            <select class="form-control" name="country" >
                                @foreach($countries as $country)
                                    <option value="{{ $country->iso2 }}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>State</label>
                            <input class="form-control" type="text" name="state" value="{{old('state')}}" placeholder="Enter your state">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>City</label>
                            <input class="form-control" type="text" name="city" value="{{old('city')}}" placeholder="Enter your city">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input class="form-control" type="text" name="postal_code" value="{{old('postal_code')}}" placeholder="Enter your postal code">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Street Address</label>
                            <textarea class="form-control" type="text" name="street_address"  placeholder="Enter your street address">{{old('street_address')}}</textarea>
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-piggy-bank mr-2"></i> Banking Details</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Account Type</label>
                            <select class="form-control" name="account_type">
                                <option value="Savings Account">Savings Account</option>
                                <option value="Current Account">Current Account</option>
                                <option value="Crypto Currency Account">Crypto Currency Account</option>
                                <option value="Investment Account">Investment Account</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Account Currency</label>
                            <select class="form-control" name="account_currency" >
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->currency }}">{{$currency->currency}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h4 class="section-title"><i class="fas fa-camera mr-2"></i> Upload Passport Photograph</h4>
                <div class="form-group">
                    <input type="file" class="form-control" name="picture" accept="image/*" required>
                </div>

                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary" type="submit">Add User</button>
                </div>
            </form>
        </div>
    </div>

@endsection
