@extends('layout.main')
@section ('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Tambah User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
  <section class="content">
    <div class="container-fluid">
        <form action="{{ route('user.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Form Tambah User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                      <div class="card-body">
                        <div class="form-group">
                          <label for="exampleInputName">Nama</label>
                          <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Name">
                          @error('name')
                           <small>{{ $message }}</small>   
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail">Email</label>
                          <input type="email" class="form-control" id="exampleInputEmail" name="email" placeholder="Enter email">
                          @error('email')
                           <small>{{ $message }}</small>   
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputNumber">Number</label>
                          <input type="number" class="form-control" id="exampleInputNumber" name="number" placeholder="Enter Number">
                          @error('number')
                           <small>{{ $message }}</small>   
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputSosmed">Sosmed</label>
                          <input type="text" class="form-control" id="exampleInputSosmed" name="sosmed" placeholder="Enter Sosmed">
                          @error('sosmed')
                           <small>{{ $message }}</small>   
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          @error('password')
                           <small>{{ $message }}</small>   
                          @enderror
                        </div>
                      </div>
                      <!-- /.card-body -->
        
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card -->
                      <!-- /.card-footer -->
                    </form>
                  </div>
                  <!-- /.card -->
        
                </div>
              </div>
        </form>
    </div><!-- /.container-fluid -->
  </section>
</div>
@endsection