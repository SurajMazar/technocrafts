@extends('admin.layout')

@section('content')
<div id="app">

<div class="container">
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info btn-blue">
        <div class="inner">
          <h3>{{ $blog_count }}</h3>

          <p>Blogs</p>
        </div>
        <div class="icon">
          <i class="fas fa-newspaper"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success btn-grn">
        <div class="inner">
          <h3>{{ $blog_cat_count }}</h3>

          <p>Blog Categories</p>
        </div>
        <div class="icon">
          <i class="far fa-clipboard"></i>
        </div>
       {{--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning btn-yellow">
        <div class="inner">
          <h3>{{ $subscriber_count }}</h3>

          <p>Subscribers</p>
        </div>
        <div class="icon">
          <i class="fas fa-user"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger btn-red">
        <div class="inner">
          <h3>{{ $underreview }}</h3>

          <p>Writings under review</p>
        </div>
        <div class="icon">
          <i class="fas fa-pen"></i>
        </div>
        {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info btn-blue elevation-1"><i class="fas fa-laptop"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Laptops</span>
          <span class="info-box-number">
            {{ $laptop_count }}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon  bg-success btn-grn elevation-1"><i class="  fas fa-dice"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Laptop Brands</span>
          <span class="info-box-number">{{ $laptop_brands_count }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning btn-yellow elevation-1"><i class="fas fa-mobile-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Smartphones</span>
          <span class="info-box-number">{{ $smartphone_count }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger btn-red elevation-1"><i class="fas fa-dice"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Smartphone brands</span>
          <span class="info-box-number">{{ $smartphone_brands_count }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Recently Added Smartphone</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach($smartphones as $smartphone)
            <dashboard-smartphone :smartphone='{{ json_encode($smartphone) }}'></dashboard-smartphone>
            @endforeach
            <!-- /.item -->
            
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
          <a href="/smartphones" target="_blank" class="uppercase">View All Products</a>
        </div>
        <!-- /.card-footer -->
      </div>
    </div>
   
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Recently Added Laptops</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach($laptops as $laptop)
            <dashboard-laptop :laptop='{{ json_encode($laptop) }}'></dashboard-laptop>
            @endforeach
            <!-- /.item -->
            
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
          <a href="/laptops" target="_blank" class="uppercase">View All Products</a>
        </div>
        <!-- /.card-footer -->
      </div>
    </div>
  </div>

   <div class="row">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Latest blogs</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Created date</th>
              </tr>
              </thead>
              <tbody>
                @foreach($blogs as $blog)
                  <tr>
                    <td><a href="/blog/{{ $blog->slug }}" target="_blank">{{ substr($blog->title, 0, 25).'...' }}</a></td>
                    <td>
                      @foreach($blog->blogcategory as $cat)
                      <span class='mr-1'>{{ $cat->name }}</span><br>
                      @endforeach
                    </td>
                    <td>
                      @foreach($blog->bloguser as $user)
                      <span class='mr-1'>{{substr($user->name, 0, 9).'...' }}</span>
                      @endforeach
                    </td>
                    <td>{{ date_format($blog->created_at,"Y/m/d H:i:s")  }}</td>
                  </tr>
                @endforeach
             
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
      </div>
    </div>
     <div class="col-md-5">
        <!-- USERS LIST -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Latest Members</h3>

            <div class="card-tools">
              
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> --}}
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="users-list clearfix">

              @foreach($users as $user)
              <li>
                <div class="dashboard-image">
                  <img src="{{ $user->image }}" alt="User Image">
                </div>
                <a class="users-list-name" href="#">{{ $user->name }}</a>
                <span class="users-list-date">{{ $user->role }}</span>
              </li>
              @endforeach
            </ul>
            <!-- /.users-list -->
          </div>
        </div>
        <!--/.card -->
     </div>

  </div>
</div>
</div>
@endsection
