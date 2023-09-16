@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Blog Categories All</h4>


                            <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 118px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">SL</th>
                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 190px;" aria-label="Position: activate to sort column ascending">Name</th>

                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 87px;" aria-label="Office: activate to sort column ascending">Action</th>
                                            </tr>
                                            </thead>


                                            <tbody>

                                            @php($i=1)
                                            @foreach($categories as $item)

                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control" tabindex="0">{{$i++}}</td>
                                                    <td class="sorting_1 dtr-control" tabindex="0">{{$item->name}}</td>


                                                    <td>
                                                        <a href="{{route('blog.category.edit',$item->id)}}" class="btn btn-info sm" title="Edit data" ><i class="fas fa-edit"></i> </a>
                                                        <a href="{{route('blog.category.delete',$item->id)}}" class="btn btn-danger sm" title="Delete data" id = "delete"><i class="fas fa-trash-alt"></i> </a>
                                                    </td>


                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table></div></div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
@endsection
