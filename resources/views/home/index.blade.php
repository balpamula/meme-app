<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="/meme">{{ env('APP_NAME') }}</a>
            <a class="btn btn-primary" aria-current="page" href="/admin">Admin</a>
        </div>
    </header>

    <main>
        <section class="py-2 container">
            <div class="col-lg-6 col-md-8 mx-auto d-flex justify-content-center">
                <button type="button" class="btn btn-success my-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Add Yours
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
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
                                        @error('image')
                                            <div class="invalid-feedback mb-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="https://storage.googleapis.com/meme-buckets/{{ $meme->img_url }}"
                                                target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                                            @can('auth')
                                                <a class="btn btn-sm btn-outline-secondary">Delete</a>
                                            @endcan
                                        </div>
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

    <div class="container">
        <footer class="my-4">
            <p class="text-center text-body-secondary border-top pt-3">© 2023 Iqbal Pamula</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
