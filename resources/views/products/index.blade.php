@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">
                    <table id="contact-table" class="table">
                        <thead>
                              <th>
                                    Name
                              </th>
                              <th>
                                    Price
                              </th>
                        <th>
                            Action
                        </th>

                        </thead>
                        <tbody>
                             {{-- @foreach($products as $product)
                                    <tr>
                                          <td>{{ $product->name }}</td>
                                          <td>{{ $product->price }}</td>
                                          <td>
                                                <a href="{{ route('products.edit', ['id' => $product->id ]) }}" class="btn btn-info btn-xs">Edit</a>
                                          </td>
                                          <td>
                                                <form action="{{ route('products.destroy', ['id' => $product->id ]) }}" method="post">
                                                      {{ csrf_field() }}
                                                      {{ method_field('DELETE') }}
                                                      <button class="btn btn-xs btn-danger">Delete</button>
                                                </form>
                                          </td>
                                    </tr>
                              @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('#contact-table').DataTable({
                procesing: true,
                serveSide: true,
                //    pageLength:20,
                ajax:"{{route('api.contact')}}",
                columns: [

                    {data: 'name', name:'name'},
                    {data: 'price', name:'price'},
                    {data: 'action', name:'action'}




                ]
            });
        });

    </script>
@stop
