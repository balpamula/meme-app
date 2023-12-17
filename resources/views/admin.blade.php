@extends('layouts.main')

@section('main-content')
    <main>
        <section class="py-2 container">
            <div class="col-lg-6 col-md-8 mx-auto d-flex justify-content-center">
                <h1>Iqbal's personal private space</h1>
            </div>
        </section>
        <div class="album py-5 bg-body-tertiary">
            <div class="container col-md-4">
                <form action="/login" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                            name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback mb-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" id="password" value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback mb-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
