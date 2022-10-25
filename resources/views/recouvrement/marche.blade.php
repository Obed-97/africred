@section('title', 'Bienvenue à AFRICRED')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    
                   
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Recouvrement Global </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Recouvrement Global</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-4">
                           <form  method="POST" action="{{route('date.store')}}" class="d-flex mb-4">
                               @csrf
                               <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                               <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
                           </form>
                        </div>
                          <div class="col-xl-6">
                               <form  method="POST" action="{{route('etat_recouvrement.store')}}" class="d-flex mb-4">
                                   @csrf
                                   <div class="col-xl-3"><input type="date" name="fdate" class="form-control"></div>
                                   <div class="col-xl-3"><input type="date" name="sdate"  class="form-control"></div>
                                   <div class="col-xl-3"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                               </form>
                           </div> 
                           <div class="col-xl-2"><a href="{{route('etat_recouvrement.index')}}" class="btn btn-success btn-block  waves-effect waves-light"> ÉTAT DU JOUR</a></div>
                       </div>
            
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-right mb-4">
                                        @if (auth()->user()->role_id == 2)
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#staticBackdrop">Recouvrement</button>
                                        @endif
                                    </h4>
                                        <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog" >
                                                <form action="{{route('recouvrement.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Recouvrement journalier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label" name>Client</label>
                                                            <select class="form-control " name="credit_id" required>
                                                               @foreach ($credits as $item)
                                                                <option value="{{$item->id}}">{{$item->Client['nom_prenom']}} </option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label" name>Marché</label>
                                                            <select class="form-control " name="marche_id" required>
                                                               @foreach ($marches as $item)
                                                                <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                               @endforeach
                                                            </select>
                                                        </div>
                                                       

                                                        <div class="form-group ">
                                                            <label>Intérêt</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="interet_jrs"  id="interet_jrs" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label>Capital</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="recouvrement_jrs"  id="recouvrement_jrs" required>
                                                            </div>
                                                         </div>
                                                        <div class="form-group ">
                                                            <label>Epargne</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="epargne_jrs"  id="epargne_jrs" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label>Assurance</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="assurance"  id="assurance" required>
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
                                            <a href="{{route('recouvrement.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                            <a href="{{route('recouvrement.create')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>  
                                            @else
                                            <a href="{{route('recouvrement.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>

                                            <a href="{{route('recouvrement.create')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> Marché</a>
                                            @endif
                                        </div>
                                    </div>

                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            @if (auth()->user()->role_id == 2)
                                                <tr>
                                                   
                                                    <th>Marché</th>
                                                    <th>Capital à ce jour</th>
                                                    <th>Intérêt à ce jour</th>
                                                    <th>Epargne à ce jour</th>
                                                    <th>Assurance</th>
                                                    
                                                </tr>
                                            @else
                                            <tr>
                                                <th>Marché</th>
                                                <th>Capital à ce jour</th>
                                                <th>Intérêt à ce jour</th>
                                                <th>Epargne à ce jour</th>
                                                <th>Assurance</th>
                                               
                                            </tr>
                                            @endif

                                        </thead>


                                        <tbody>
                                            @if (auth()->user()->role_id == 2)
                                                @foreach ($par_marche as $item)
                                                    <tr>
                                                       
                                                        <td>{{$item->Marche['libelle']}}</td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>

                                                        

                                                    </tr>
                                                @endforeach
                                            @else
                                               @foreach ($par_marche as $item)
                                                    <tr>
                                                        <td>{{$item->Marche['libelle']}}</td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>

                                                        

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                         
                    </div> <!-- end row -->
                     
                   
                    
                      <!-- start page title -->
                      <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">STATISTIQUES  </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
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
                                                <td>Capital recouvré</td>
                                                <td class="text-success">{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Intérêt net</td>
                                                <td class="text-success">{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Épargne</td>
                                                <td class="text-success">{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Assurance</td>
                                                <td class="text-success">{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection