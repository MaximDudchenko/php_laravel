@extends('layouts.app')

@section('content')
    @include('accounts.parts.navigation')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                <h3 class="text-center">{{ __('My Account ('. $user->name .' ' . $user->surname. ')') }}</h3>
                <br>
            </div>
            <div class="col-md-12">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table align-self-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center" scope="col"> Name </th>
                                        <th class="text-center" scope="col"> Value <th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Role')}}</td>
                                        <td class="text-center"> {{ $user->role->name }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Name')}}</td>
                                        <td class="text-center"> {{ $user->name }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Surname')}}</td>
                                        <td class="text-center"> {{ $user->surname }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Phone')}}</td>
                                        <td class="text-center"> {{ $user->phone }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('E-Mail')}}</td>
                                        <td class="text-center"> {{ $user->email }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Birthday')}}</td>
                                        <td class="text-center"> {{ $user->birthdate }} </td>
                                    </tr>
                                    <tr>
                                        <td scope="row" class="text-center">{{__('Balance')}}</td>
                                        <td class="text-center"> {{ $user->balance }} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
