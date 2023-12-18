@extends('layouts.main')

@section('main-content')
    <main>
        <section class="py-2 container">
            <div class="col-lg-6 col-md-8 mx-auto d-flex justify-content-center">
                <button type="button" class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Yours Meme
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Your Meme</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="/meme" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="col-form-label">Title
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title">
                                        @error('title')
                                            <div class="invalid-feedback mb-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="col-form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="col-form-label">Image
                                            <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="image" name="image" accept="image/*">
                                        <small>Max image size is 4MB</small>
                                        @error('image')
                                            <div class="invalid-feedback mb-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                    @forelse ($memes as $meme)
                        <div class="col-md-4">
                            <div class="card shadow h-100">
                                <img src="https://storage.googleapis.com/meme-buckets/{{ $meme->img_url }}"
                                    class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $meme->title }}</h5>
                                    <p class="card-text">{{ $meme->description }}</p>
                                    <div class="d-flex justify-content-start align-items-center grid gap-2">
                                        <a href="https://storage.googleapis.com/meme-buckets/{{ $meme->img_url }}"
                                            target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                                        @auth
                                            {{-- <a class="btn btn-sm btn-outline-secondary">Delete</a> --}}
                                            <form action="/meme/{{ $meme->id }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm btn-outline-secondary"
                                                    onclick="return confirm('Apakah anda yakin untuk menghapus data?')">Delete
                                                </button>
                                            </form>
                                        @else
                                            <a class="btn btn-sm btn-outline-secondary d-none">Delete</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3 class="text-center">No memes to show</h3>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center pt-5">
                    {{ $memes->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
