@extends('admin.layouts.master')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">List Country</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List country</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tile</th>
                                    <th scope="col" colspan="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $number = 1;
                                @endphp
                                @if (!empty($countries))
                                    @foreach ($countries as $country)
                                        <tr>
                                            <th scope="row">{{$number}}</th>
                                            <td>{{ $country->name }}</td>
                                            <td>
                                                <a href="{{ route('country.edit', $country->id) }}">
                                                    <button type="submit" class="btn btn-dark">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                            <td>
                                                <form action="{{ route('country.destroy', $country->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $number++;
                                        @endphp    
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class="row paginate">
                                <div class="paginate-left">
                                    <a href="{{ route('country.create') }}">
                                        <button class="btn btn-success">Add Country</button>
                                    </a>
                                </div>
                                <div class="paginate-right">
                                    {!! $countries->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection