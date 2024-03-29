@section('title', 'Crédit')

@extends('master')

@section('content')


        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success"> Déblocage par marché</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Déblocage</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-2"></div>
                       <div class="col-xl-8" id="web">
                            <form  method="POST" action="{{route('etat_credit.store')}}" class="d-flex mb-4">
                                @csrf
                                <div class="col-xl-4"><input type="date" name="fdate" class="form-control"></div>
                                <div class="col-xl-4"><input type="date" name="sdate"  class="form-control"></div>
                                <div class="col-xl-4"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                            </form>
                        </div> 
                        <div class="col-xl-2"><a href="{{route('etat_credit.index')}}" class="btn btn-success btn-block  waves-effect waves-light"> DÉBLOCAGE DU JOUR</a></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('credit.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Nouveau déblocage</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Bénéficiaire</label>
                                                            <select class="form-control select2" name="client_id">
                                                                @foreach ($clients as $item)
                                                                <option value="{{$item->id}}">{{$item->nom_prenom}}</option>
                                                               @endforeach
                                                            </select>
                                                            
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">Marché</label>
                                                            <select class="form-control select2" name="marche_id">
                                                                @foreach ($marches as $item)
                                                                <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                               @endforeach
                                                            </select>
                                                            
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Montant</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="montant"  id="montant" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Taux d'intérêt</label>
                                                            <select class="form-control " name="taux">
                                                                <option value="0.2">20%</option>
                                                                <option value="0.15">15%</option>
                                                                <option value="0.1">10%</option>
                                                                <option value="0.05">5%</option>
                                                                
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date de déblocage</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_deblocage"  id="date_deblocage" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Date de fin</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date_fin"  id="date_fin" required>
                                                            </div>
                                                        </div>
                                                     
                                                        <div class="form-group ">
                                                            <label>Frais de carte</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="frais_carte"  id="frais_carte" required>
                                                            </div>
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
                                        <div class="row">
                                            <div class="mb-4 col-xl-4">
                                                <label for="">Afficher par :</label>
                                                @if (auth()->user()->role_id == 2)
                                                <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
                                                @else
                                                <a href="{{route('credit.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                                <a href="{{route('credit.create')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>
                                                <a href="{{route('credit.marche')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                                @endif
                                            </div>
                                        </div>

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Marché</th>
                                                <th>Montant</th>
                                                <th>Intérêt</th>
                                                <th>Frais de déblocage</th>
                                                <th>Frais de carte</th>
                                                <th>Montant & Intérêt</th>
                                                <th>Nombre client</th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>

                                            @foreach ($credits as $item)
                                                <tr>
                                                    <td>{{$item->Marche['libelle']}}</td>
                                                    <td>{{number_format($item->montant, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->interet, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->frais_deblocage, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->frais_carte, 0, ',', ' ')}} CFA</td>
                                                    <td>{{number_format($item->montant_interet, 0, ',', ' ')}} CFA</td>
                                                    <td>{{$item->id}} clients </td>
                                                </tr>
                                             @endforeach
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-4" id="web">
                            <div class="card">
                                <div class="card-body">
                                      
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>Désignations</b> </th>
                                                <th><b>Total</b> </th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Montant</td>
                                                <td class="text-success">{{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Intérêt</td>
                                                <td class="text-success">{{number_format($credits->sum('interet'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Frais de déblocage</td>
                                                <td class="text-success">{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Frais de carte</td>
                                                <td class="text-success">{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Montant & intérêt</td>
                                                <td class="text-success">{{number_format($credits->sum('montant_interet'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                                
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