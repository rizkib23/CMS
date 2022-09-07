@extends('../layouts.dashboard')
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h1> Role </h1>
          </div>
          <div class="card-body">
            @can('role_create')
            <a href="{{ route('roles.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">
                Tambah
                <i class="fas fa-plus-square"></i>
            </a>
            @endcan
                    <table class="table table-bordered"  id="myTable">   
                     <thead>
                            <tr class="text-center">
                                <th scope="col">no</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        
                     </thead>
                     <tbody>
                        <?php $no=1; ?>
                        <!-- list category -->
                        @foreach ($roles as $role)
                            <!-- category list -->
                            
                           <tr>
                                <td scope="col" class="text-center">
                                    {{ $no++ }}</td>
                                <td>
                                    <label class="mt-auto mb-auto">
                                        {{ $role->name }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <div>
                                        {{-- detail --}}
                                        @can('role_detail', 'role_delete', 'role_update')
                                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-primary" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- edit -->
                                        <a href="{{ route('roles.edit', ['role'=>$role]) }}" class="btn btn-sm btn-info" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- delete -->
                                        <form class="d-inline" action="{{ route('roles.destroy', ['role'=>$role]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                          <button type="submit"  class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection