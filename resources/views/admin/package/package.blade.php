@extends('layouts.backend.master')
@section('title', 'Package')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Package')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Package</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add New Package
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Package</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('store.packege')}}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="head">Packege Name</label>
                                                <input type="text" class="form-control" name="packege_name" id="head"
                                                    placeholder="Project Name">
                                                    @error('packege_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="head">Select Service</label>
                                                <!-- <select name="service_id" id="" class="select form-control" style="width: 200px;">
                                                    @foreach ($service as $item)
                                                        <option value="{{$item->id}}">{{$item->service_name}}</option>
                                                    @endforeach
                                                </select> -->

                                            <div class="d-flex">
                                                @foreach($service as $item)
                                                    <div style="margin-right: 10px;">
                                                        <input type="checkbox" name="service_id[]" value="{{ $item->id }}">
                                                        <label>{{ $item->service_name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('service_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            </div>

                                            <div class="form-group">
                                                <label for="head">Packege Value</label>
                                                <input type="number" step="any" class="form-control" name="packege_value" id="value"
                                                    placeholder="Ex: 12.56">
                                                    @error('packege_value')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="die">Select Currency</label>
                                                <select name="currency" class="form-control" id="">
                                                    <option value="bdt">BDT</option>
                                                    <option value="usd">USD</option>
                                                    <option value="aed">AED</option>
                                                </select>
                                                @error('currency')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="head">Packege Share</label>
                                                <input type="number" class="form-control" name="packege_share" id="share"
                                                    placeholder="Ex: 45">
                                            </div> -->
                                            <div class="form-group">
                                                <label for="dsc">Description</label>
                                                <textarea class="form-control" id="dsc" name="packege_dsc" rows="3"></textarea>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Share</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($package as $key => $project)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $project->packege_name }}</td>
                                            <td>{{ $project->packege_value }}</td>
                                            <td>{{ $project->packege_share }}</td>
                                            {{--<td>{{ $project->services->service_name ?? 'N/A' }}</td>--}}
                                          
                                            <td>
                                                @if ($project->services && $project->services->count() > 0)
                                                    @foreach ($project->services as $service)
                                                        {{ $service->service_name }},
                                                    @endforeach
                                                @else
                                                    No services
                                                @endif
                                            </td>


                                            <td>{{ $project->currency}}</td>
                                            <td>{{ Str::limit($project->packege_dsc, 20) }}</td>
                                            <td>
                                                <a data-toggle="modal" data-target="#edit_customer_modal{{$project->id}}" class="btn btn-primary"><i class="fa fa-pen-to-square" style="color: white"></i></a>
                                                <a href="{{route('delete.package',$project->id)}}" onclick="return confirm('Are you sure delete this ')" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                           <!-- Modal -->
                                           <div class="modal fade" id="edit_customer_modal{{$project->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update New
                                                            Serive</h5>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('update.package',$project->id) }}" method="POST">
                                                        
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="head">Packege Name</label>
                                                                <input type="text" class="form-control" value="{{$project->packege_name}}" name="packege_name" id="head"
                                                                    placeholder="Project Name">
                                                            </div>
                                                            <div class="form-group">
                                                            <label for="head">Select Service</label>
                                                            {{-- <select name="service_id" id="" class="select form-control" style="width: 200px;">
                                                                @foreach ($service as $item)
                                                                    <option value="{{$item->id}}" {{$item->id == $project->service_id}}>{{$item->service_name}}</option>
                                                                @endforeach
                                                            </select> --}}


                                                           {{-- <div class="d-flex">
                                                                @foreach($service as $item)
                                                                    <div class="checkbox-label-container" style="margin-right: 10px;">
                                                                        <input type="checkbox" 
                                                                            name="service_id[]" 
                                                                            value="{{ $item->id }}" 
                                                                            {{ $project->services->contains('id', $item->id) ? 'checked' : '' }}>
                                                                        <label>{{ $item->service_name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>--}}



                                                            </div>

                                                            <div class="form-group">
                                                                <label for="head">Packege Value</label>
                                                                <input type="number" step="any" class="form-control" value="{{$project->packege_value}}" name="packege_value" id="value"
                                                                    placeholder="Ex: 12.56">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="die">Select Currency</label>
                                                                <select name="currency" class="form-control" id="">
                                                                    <option value="bdt">{{$project->currency}}</option>
                                                                    <option value="usd">USD</option>
                                                                    <option value="aed">AED</option>
                                                                </select>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label for="head">Packege Share</label>
                                                                <input type="number" class="form-control" value="{{$project->packege_share}}" name="packege_share" id="share"
                                                                    placeholder="Ex: 45">
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label for="dsc">Description</label>
                                                                <textarea class="form-control" id="dsc"  name="packege_dsc" rows="3">{{$project->packege_dsc}}</textarea>
                                                            </div>
                
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('backend/dist-assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/dist-assets/js/scripts/datatables.script.min.js') }}"></script>
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
@endpush
