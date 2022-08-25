@extends('item/layouts/main')

{{-- @section('title'){{ 'Dashboard' }} @endsection --}}

@section('container')
<h3 class="text-primary">Dashboard</h3>
<div class="row">
  <div>
    <a href="{{ route('home.create') }}" type="button" class="btn btn-primary float-end btn-lg" style="width: 10rem">Add Item</a>        
  </div>
</div>
<div class="card mt-4">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <h5 class="card-title mb-4" style="width: 20rem">Tabel Elektronik</h5>
        </div>
        <div class="col-6">
          @if(request()->get('status') == 'archived')
            <a href="/home" class="nav-link float-end" >Back</a>
          @else
            <a href="/home?status=archived" class="nav-link float-end" >Archive History</a>
          @endif
          
        </div>
      </div>

      @if(request()->get('status') == 'archived')
        <form action="{{ route('home.restore-all') }}" method="post" class="d-inline">
          @csrf
          <input type="submit" value="Restore All" class="btn btn-primary btn-sm">
        </form>
      @endif


        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Stock</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <th scope="row">{{ $loop -> iteration }}</th>
                <td>{{ $item -> kode_barang }}</td>
                <td>{{ $item -> nama_barang }}</td>
                <td>{{ $item -> stock }}</td>
                <td>{{ $item -> harga }}</td>
                <td>
                  @if(request()->get('status') == 'archived')
                    <form action="{{ route('home.restore', $item->id) }}" method="post" class="d-inline">
                      @csrf
                      <input type="submit" value="Restore" class="btn btn-outline-warning">
                    </form>
                  @else
                    <a href="{{route("home.edit", $item->id) }}" type="button" class="btn btn-outline-primary">Edit</a>
                  @endif
                    
                  @if(request()->get('status') == 'archived')
                    <form action="{{ route('home.fdel',$item->id) }}" method="post" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return confirm('Are you sure want to delete permanently this item ?')" type="button" class="btn btn-outline-danger">Delete</button>
                    </form>
                  @else
                    <form action="{{ route('home.destroy',$item->id) }}" method="post" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return confirm('Are you sure want to delete this item ?')" type="button" class="btn btn-outline-danger">Delete</button>
                    </form>
                  @endif
                    
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
@endsection
        
    