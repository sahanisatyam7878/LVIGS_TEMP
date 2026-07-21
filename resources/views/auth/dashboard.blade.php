@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container py-5">

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-body">

            <h2 class="mb-4">
                Welcome, {{ Auth::user()->name }}
            </h2>

            <table class="table table-bordered">

                <tr>
                    <th width="200">User ID</th>
                    <td>{{ Auth::user()->id }}</td>
                </tr>

                <tr>
                    <th>Name</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ Auth::user()->phone }}</td>
                </tr>

            </table>

            <div class="mt-4">

                <a href="{{ route('investment') }}" class="btn btn-success">
                    Invest Now
                </a>

                <form action="{{ route('logout') }}"
                      method="POST"
                      class="d-inline">

                    @csrf

                    <button class="btn btn-danger">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection