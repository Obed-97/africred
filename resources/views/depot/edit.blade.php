@section('title', 'Dépôt')

@extends('master')

@section('content')
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                   

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                            <li class="breadcrumb-item active"> {{$depot->Client['nom_prenom']}} </li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                  
                        <div class="row">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                      
                                       
                                        <form class="custom-validation" action="{{route('historique_depot.update', $depot->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                             {{method_field('PUT')}}
                                             
                                            <div class="form-group">
                                                <label class="control-label" >Type</label>
                                                <select class="form-control " name="type_depot_id">
                                                    <option value="{{$depot->type_depot_id}}">{{$depot->Type_depot['libelle']}} </option>
                                                   @foreach ($types as $item)
                                                    <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                   @endforeach
                                                </select>
                                            </div>
                                         
                                             <div class="form-group">
                                                
                                                <label class="control-label" name>Client</label>
                                                <select class="form-control select2" name="client_id" required>
                                                   <option value="{{$depot->id}}|{{$depot->type_compte_id}}|{{$depot->sexe}}">{{$depot->Client['nom_prenom']}}</option>
                                                   @foreach ($clients as $item)
                                                    <option value="{{$item->id}}|{{$item->type_compte_id}}|{{$item->sexe}}">{{$item->nom_prenom}}</option>
                                                   @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                                <label>Date</label>
                                                <div>
                                                    <input class="form-control" type="date" name="date" value="{{$depot->date}}"  id="date" required >
                                                </div>
                                            </div>

                                           

                                            
                                             <div class="modal-footer">
                                                   
                                                    <a href="{{URL::previous()}}" type="reset" class="btn btn-secondary waves-effect">
                                                        Annuler
                                                    </a>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                                        Mettre à jour
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            
                           
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

               
            <!-- end main content-->
         
            <!-- end main content-->

  @endsection
    
