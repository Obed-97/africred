@section('title', 'Recouvrement')

@extends('master')

@section('content')

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                   
                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">
                                    Aujourd'hui,&nbsp; le &nbsp;
                                    <?php
                                    echo date('d-m-Y');
                                    ?> 
                                </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0" id="web">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                        <li class="breadcrumb-item active">Recouvrement du jour</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row mb-4">
                        <div class="col-xl-4" id="web">
                           <form  method="POST" action="{{route('date.store')}}" class="d-flex mb-4">
                               @csrf
                               <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                               <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
                           </form>
                        </div>
                          <div class="col-xl-6" id="web">
                               <form  method="POST" action="{{route('etat_recouvrement.store')}}" class="d-flex mb-4">
                                   @csrf
                                   <div class="col-xl-3"><input type="date" name="fdate" class="form-control"></div>
                                   <div class="col-xl-3"><input type="date" name="sdate"  class="form-control"></div>
                                   <div class="col-xl-3"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                               </form>
                           </div> 
                           <div class="col-xl-2"><a href="{{route('recouvrement.index')}}" class="btn btn-primary btn-block  waves-effect waves-light"> ??TAT GLOBAL</a></div>
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
                                                        <div class="form-group ">
                                                            <label>Date</label>
                                                            <div>
                                                                <input class="form-control" type="date" name="date"  id="date" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Client</label>
                                                            <select class="form-control select2" name="credit_id" required>
                                                                @foreach ($credits as $item)
                                                                <option value="{{$item->id}}">
                                                                    {{$item->Client['nom_prenom']}} -- {{number_format($item->montant_interet, 0, ',', ' ')}} CFA --
                                                                    @if (($item->encours($item->montant_interet)) == 0 || ($item->encours($item->montant_interet)) < 0)
                                                                        <div class="text-success font-size-12">Pay??</div>
                                                                    @else
                                                                        <div class="text-danger font-size-12">Encours</div>
                                                                    @endif
                                                                </option>
                                                               @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">March??</label>
                                                            <select class="form-control select2" name="marche_id" required>
                                                               @foreach ($marches as $item)
                                                                <option value="{{$item->id}}">{{$item->libelle}} </option>
                                                               @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                       

                                                        <div class="form-group ">
                                                            <label>Capital</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="recouvrement_jrs"  id="recouvrement_jrs" required>
                                                            </div>
                                                         </div>
                                                        <div class="form-group ">
                                                            <label>Int??r??t</label>
                                                            <div>
                                                                <input class="form-control" type="number" name="interet_jrs"  id="interet_jrs" required>
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
                                            <a href="{{route('etat_recouvrement.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Client</a>
                                            <a href="{{route('etat_recouvrement.create')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> March??</a>  
                                            @else
                                            <a href="{{route('etat_recouvrement.index')}}" class="btn btn-success btn-sm waves-effect waves-light mr-2"><i class="ri-user-3-line"></i> Agent</a>

                                            <a href="{{route('etat_recouvrement.create')}}" class="btn btn-success btn-sm waves-effect waves-light"><i class="ri-store-2-line "></i> March??</a>
                                            @endif
                                        </div>
                                    </div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            @if (auth()->user()->role_id == 2)
                                                <tr>
                                                    <th>Client</th>
                                                    <th>March??</th>
                                                    <th>Montant & Int??r??t</th>
                                                    
                                                    <th>Capital du jour</th>
                                                    <th>Int??r??t du jour</th>
                                                    <th>Epargne du jour</th>
                                                    <th>Assurance du jour</th>
                                                    <th>Jours restant</th>
                                                    <th>Statut</th>
                                                    
                                                    
                                                </tr>
                                            @else
                                            <tr>
                                                <th>Agent</th>
                                                <th>Capital du jour</th>
                                                <th>Int??r??t du jour</th>
                                                <th>Epargne du jour</th>
                                                <th>Assurance du jour</th>
                                                <th style="background-color: #569ad2; color:white">Frais d??blocage</th>
                                                <th style="background-color: #569ad2; color:white">Frais carte</th>
                                                <th style="background-color: #1cbb8c;; color: white ">Total</th>
                                               
                                            </tr>
                                            @endif

                                        </thead>


                                        <tbody>
                                            @if (auth()->user()->role_id == 2)
                                                @foreach ($recouvrements as $item)
                                                    <tr>
                                                        <td>{{$item->Credit->Client['nom_prenom']}}</td>
                                                        <td>{{$item->Credit->Client->Marche['libelle']}}</td>
                                                        <td>{{number_format(($item->Credit['montant_interet']), 0, ',', ' ')}} CFA</td>
                                                       
                                                       
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                       
                                                        
                                                        @if ((\Carbon\Carbon::now() < $item->Credit['date_fin']) && (\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin']) != 0))
                                                            <td class="text-success font-size-15">{{\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin'])}} jours</td>
                                                        @elseif(\Carbon\Carbon::now()->diffInDays($item->Credit['date_fin']) == 0)
                                                            <td class="text-primary font-size-15">Aujourd'hui </td>
                                                        @else
                                                            <td class="text-danger font-size-15">D??lai expir?? </td>
                                                        @endif
                                                        @if ((intval($item->Credit->montant_interet) - (intval($item->interet_jrs) + intval($item->recouvrement_jrs))) == 0)
                                                            <td>
                                                                <div class="badge badge-soft-success font-size-12">Termin??</div>
                                                            </td>  
                                                        @else
                                                            <td>
                                                                <div class="badge badge-soft-warning font-size-12">Encours</div>
                                                            </td>
                                                        @endif
                                                        

                                                    </tr>
                                                @endforeach
                                            @else
                                               @forelse ($recouvrements as $item)
                                                    <tr style="background-color: #1cbb8c;; color: white ">
                                                        <td>{{$item->User['nom']}}</td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->getFraisDeblocageDay($item->user_id), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->getFraisCarteDay($item->user_id), 0, ',', ' ')}} CFA</td>
                                                        <td >{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->getFraisDeblocageDay($item->user_id) + $item->getFraisCarteDay($item->user_id)) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                @empty
                                                    <tr style="background-color: #1cbb8c;; color: white ">
                                                        <td>Souma??la Ciss??</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td >0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td >0 CFA</td>
                                                     
                                                        

                                                    </tr>
                                                    <tr style="background-color: #1cbb8c;; color: white ">
                                                        <td>Awa Diallo</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td >0 CFA</td>
                                                         <td>0 CFA</td>
                                                        <td >0 CFA</td>
                                                       
                                                        

                                                    </tr>
                                                    <tr style="background-color: #1cbb8c;; color: white ">
                                                        <td>Awa Tounkara</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td >0 CFA</td>
                                                        <td>0 CFA</td>
                                                        <td >0 CFA</td>
                                                        
                                                        

                                                    </tr>
                                                @endforelse
                                                @foreach ($hier as $item)
                                                    <tr>
                                                        <td>{{$item->User['nom']}}  <div class="badge badge-soft-danger font-size-12">Hier</div></td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->DeblocageHier($item->user_id), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->CarteHier($item->user_id), 0, ',', ' ')}} CFA</td>
                                                        <td class="text-success">{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->DeblocageHier($item->user_id) + $item->CarteHier($item->user_id)) , 0, ',', ' ')}} CFA</td>
                                                        

                                                    </tr>
                                                @endforeach
                                                @foreach ($avant_hier as $item)
                                                    <tr>
                                                        <td>{{$item->User['nom']}}  <div class="badge badge-soft-danger font-size-12">J-2</div></td>
                                                        <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->epargne_jrs, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->DeblocageJ_2($item->user_id), 0, ',', ' ')}} CFA</td>
                                                        <td>{{number_format($item->CarteJ_2($item->user_id), 0, ',', ' ')}} CFA</td>
                                                        <td class="text-success">{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance + $item->DeblocageJ_2($item->user_id) + $item->CarteJ_2($item->user_id) ) , 0, ',', ' ')}} CFA</td>
                                                        

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
                      <div class="row" id="web">
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
                    <div class="row" id="web">
                        @if(auth()->user()->role_id == 1)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                     <div class="badge badge-soft-success font-size-18 mb-4">Aujourd'hui = {{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte')), 0, ',', ' ')}} CFA</div> 
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>D??signations</b> </th>
                                                <th><b>Total</b> </th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Capital recouvr??</td>
                                                <td class="text-success">{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Int??r??t net</td>
                                                <td class="text-success">{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>??pargne</td>
                                                <td class="text-success">{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Assurance</td>
                                                <td class="text-success">{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                             <tr>
                                                <td>Frais d??blocage</td>
                                                <td class="text-success">{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                             <tr>
                                                <td>Frais carte</td>
                                                <td class="text-success">{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                      
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                     <div class="badge badge-soft-primary font-size-18 mb-4">Hier = {{number_format(($total_hier->sum('recouvrement_jrs') + $total_hier->sum('interet_jrs') + $total_hier->sum('epargne_jrs') + $total_hier->sum('assurance') + $credits_hier->sum('frais_deblocage') + $credits_hier->sum('frais_carte') ), 0, ',', ' ')}} CFA</div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>D??signations</b> </th>
                                                <th><b>Total</b> </th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Capital recouvr??</td>
                                                <td class="text-primary">{{number_format($total_hier->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Int??r??t net</td>
                                                <td class="text-primary">{{number_format($total_hier->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>??pargne</td>
                                                <td class="text-primary">{{number_format($total_hier->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Assurance</td>
                                                <td class="text-primary">{{number_format($total_hier->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                             <tr>
                                                <td>Frais d??blocage</td>
                                                <td class="text-primary">{{number_format($credits_hier->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                             <tr>
                                                <td>Frais carte</td>
                                                <td class="text-primary">{{number_format($credits_hier->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                     <div class="badge badge-soft-danger font-size-18 mb-4">Avant-hier = {{number_format(($total_j_2->sum('recouvrement_jrs') + $total_j_2->sum('interet_jrs') + $total_j_2->sum('epargne_jrs') + $total_j_2->sum('assurance') + $credits_j_2->sum('frais_deblocage') + $credits_j_2->sum('frais_carte')), 0, ',', ' ')}} CFA</div>
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>D??signations</b> </th>
                                                <th><b>Total</b> </th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Capital recouvr??</td>
                                                <td class="text-danger">{{number_format($total_j_2->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Int??r??t net</td>
                                                <td class="text-danger">{{number_format($total_j_2->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>??pargne</td>
                                                <td class="text-danger">{{number_format($total_j_2->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Assurance</td>
                                                <td class="text-danger">{{number_format($total_j_2->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Frais d??blocage</td>
                                                <td class="text-danger">{{number_format($credits_j_2->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Frais carte</td>
                                                <td class="text-danger">{{number_format($credits_j_2->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                        @elseif(auth()->user()->role_id == 2)
                         <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                     <div class="badge badge-soft-success font-size-18 mb-4">Aujourd'hui = {{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') + $credit_j->sum('frais_deblocage') + $credit_j->sum('frais_carte')), 0, ',', ' ')}} CFA</div> 
                                    <table id="datatable-buttons" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr style="font-size: 16px">
                                                <th><b>D??signations</b> </th>
                                                <th><b>Total</b> </th>
                                                
                                            </tr>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>Capital recouvr??</td>
                                                <td class="text-success">{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Int??r??t net</td>
                                                <td class="text-success">{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>??pargne</td>
                                                <td class="text-success">{{number_format($total->sum('epargne_jrs'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                            <tr>
                                                <td>Assurance</td>
                                                <td class="text-success">{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                             <tr>
                                                <td>Frais d??blocage</td>
                                                <td class="text-success">{{number_format($credit_j->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                             <tr>
                                                <td>Frais carte</td>
                                                <td class="text-success">{{number_format($credit_j->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                            </tr>
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                        @endif
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


@endsection
