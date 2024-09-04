@extends('layouts.dashboard_master')

@section('headTitle', 'Bookings')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1>Bookings</h1>
            @if ($bookings->isEmpty())
                <p>No booking found.</p>
            @else
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::get('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <table class="table-responsive table--no-card m-b-40 table table-bordered">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>name</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>price</th>
                            <th>status</th>
                            <th>accepted</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->user->email }}</td>
                                <td>{{ $booking->user->phone }}</td>
                                <td>{{ $booking->trip->price }}</td>
                                <td>{{ $booking->status }}</td>
                                @if ($booking->accepted)
                                    <td>Accepted</td>
                                @else
                                    <td>pending</td>
                                @endif
                                <td>
                                    <div class="container d-flex justify-content-center flex-wrap">
                                        <a href="{{ route('booking.show', $booking->id) }}" class="btn btn-primary btn-sm">
                                            View</a>
                                        <a href="{{ route('booking.edit', $booking->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="confirmDeletion(event, '{{ route('booking.destroy', $booking->id) }}')">Delete</button>
                                        </form>
                                        <a href="{{ route('book.confirm', $booking->id) }}" class="btn btn-success btn-sm">
                                            Confirm </a>
                                        <a href="{{ route('booking.accept', $booking->id) }}"
                                            class="btn btn-success btn-sm"> Accept</a>
                                    </div>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection
