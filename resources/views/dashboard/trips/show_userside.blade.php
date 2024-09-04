@extends("layouts/user_side_master")
@section("pagename" , "Trip Details")
@section("login_active" , "active")
@section("content")
    <!-- Trip Details Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-light p-5 rounded">
                        <h1 class="text-center mb-4">{{ $trip->name }}</h1>

                        <div class="mb-4 text-center text-muted">
                            <span class="me-2"><strong>Start Date:</strong> {{ date('Y/m/d', strtotime($trip->start_at)) }}</span> |
                            <span class="ms-2"><strong>End Date:</strong> {{ date('Y/m/d', strtotime($trip->end_at)) }}</span>
                        </div>

                        <div class="row mb-4">
                            @foreach($tripImages as $tripImage)
                                <div class="col-6">
                                    <img src="{{ asset($tripImage->image) }}" class="img-fluid mb-3 w-100 rounded" alt="Trip Image" style="height: 200px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>

                        <h5 class="mb-3">Description:</h5>
                        <p>{{ $trip->description }}</p>

                        <h5 class="mb-3">Guide Information:</h5>
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset($tripGuids->image) }}" class="img-fluid rounded-circle me-3" alt="Guide Image" style="width: 60px; height: 60px;">
                            <div>
                                <p class="mb-1"><strong>{{ $tripGuids->name }}</strong></p>
                                <p class="mb-0">{{ $tripGuids->description }}</p>
                                <small class="text-muted">{{ $tripGuids->gender }}, {{ $tripGuids->age }} years old</small>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('guides.index') }}" class="btn btn-light me-2">Back to List</a>
                            <a href="{{ route('trip.edit', $trip->id) }}" class="btn btn-warning me-2">Edit</a>
                            <form action="{{ route('trip.destroy', $trip->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Trip Details End -->
@endsection
