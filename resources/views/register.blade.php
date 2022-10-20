
@extends('templates/main')
@section('container')
<div class="container mt-5">
    <div class="row  d-flex justify-content-center p-5 mt-5 ">
      <form action="{{ url("/register") }}" method="post" class="col-md-5 border p-5 rounded-3">
        @csrf
        <h1 class="d-flex justify-content-center mb-5">Register</h1>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input value="{{ old('email') }}" autofocus required name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          @error('email') 
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input value="{{ old('password') }}" required name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
          @error('password') 
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="row">        
          <div class="col-md-6">          
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          <div class="col-md-6">
            <a class="text-success mt-2"  style="float:right;" href="{{url('/redirectgoogle')}}">Google</a>
          </div>
        </div>
        <div class="flex items-center justify-center mt-4">
            <a href="/auth/google" class="mr-2 inline-block items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Login  Google
            </a>
            <br>
            <a href="/auth/github" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">
                Login  GitHub
            </a>
        </div>
      </form>
    </div>
    
</div>    
@endsection