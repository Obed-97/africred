@section('title', 'Compte')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row ">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">{{(new DateTime($date1))->format('d-M-Y')}} ---> {{(new DateTime($date2))->format('d-M-Y')}}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Compte</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8">
                            <form  method="POST" action="{{route('etat_client.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div> 
                        <div class="col-xl-2"><a href="{{route('etat_client.index')}}" class="btn btn-success btn-block  waves-effect waves-light">NOUVEAUX COMPTES</a></div>
                    </div>
    
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 2)
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Nouveau compte</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Nouveau compte</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="modal-body">
                                                      
                                                        <div class="form-group ">
                                                            <label>Nom & Pr??nom</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="nom_prenom"  id="nom_prenom" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Activit??</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="activite"  id="activite" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="input-ip">T??l??phone</label>
                                                            <input id="telephone" class="form-control input-mask" name="telephone"  data-inputmask="'alias': 'ip'">
                                                            <span class="text-muted">ex: "00.00.00.00"</span>
    
                                                        </div>
                                                         <div class="form-group ">
                                                            <label>Adresse</label>
                                                            <div>
                                                                <input class="form-control" type="text" name="adresse"  id="adresse" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">March??</label>
                                                            <select class="form-control select2" name="marche_id">
                                                                @foreach ($marches as $item)
                                                                <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                               @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                      
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div> 
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                               <th>N?? Compte</th>
                                                <th>Nom & Pr??nom</th>
                                                <th>Activit??</th>
                                                <th>T??l??phone</th>
                                                <th>March??</th>
                                                @if (auth()->user()->role_id == 1)
                                                <th>Agent</th>
                                                @endif
                                                <th>Enregistrer le :</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
    
    
                                        <tbody>
                                        @foreach ($clients as $item)
                                            <tr>
                                                <td>ABF-{{$item->id}}</td>
                                                <td>{{$item->nom_prenom}}</td>
                                                <td>{{$item->activite}}</td>
                                                <td>{{$item->telephone}}</td>
                                                <td>{{$item->Marche['libelle']}}</td>
                                                @if (auth()->user()->role_id == 1)
                                                <td>{{$item->User['nom']}}</td>
                                                @endif
                                                <td>{{(new DateTime($item->created_at))->format('d-m-Y')}}</td>
                                                <td class="d-flex">
                                                    <a href="{{route('client.edit', $item->id)}}" class="mr-3 text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editer"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                        
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->



@endsection