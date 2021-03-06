@extends('adminlte::page')
<style>
    #img {
        width: 350px;
        height: 400px;
        float: left;
        margin-right: 25px;
        border: 1px solid black;
    }

    .btn-outline-danger {
        position: absolute;
        bottom: 0;
        left: 15px;
    }

    td a {
        color: black;
        text-decoration: none;
    }

    :hover {
        color: blue
    }
</style>
@section('content-photo-details')
    <div class="container-fluid" style="background: white">
        <br>
        <div class="row">
            <div class="col-md-6">
                <img src="/storage/{{$photoDetails[0]->photo }}" id="img" class=" shadow p-3 mb-5 bg-white rounded">

                <a onclick="return confirm('Are you sure u want to delete this Photo?')"
                   href="{{$photoDetails[0]->id}}/delete" class="btn btn-outline-danger ">
                    <i class="far fa-trash-alt"> Delete Photo</i></a>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th colspan="2">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Photo Id</th>
                        <td>{{$photoDetails[0]->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Photo Name</th>
                        <td colspan="2">{{$photoDetails[0]->photo}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Photo Created Time</th>
                        <td>{{$photoDetails[0]->created_at}}</td>
                    </tr>
                    <tr>
                        <th scope="row">User Id</th>
                        <td>{{$photoDetails[0]->user->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">User Name</th>
                        <td>
                            <a href="/admin/users/{{$photoDetails[0]->user->id}}">{{$photoDetails[0]->user->fullName}}</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">User Email</th>
                        <td><a href="/admin/users/{{$photoDetails[0]->user->id}}">{{$photoDetails[0]->user->email}}</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">User Type</th>
                        <td>{{$photoDetails[0]->user->type}}</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
        <br>
        <hr>
        <a href="{{ route('photos.table') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-circle-left"></i>
            Back</a>
    </div>
@endsection
