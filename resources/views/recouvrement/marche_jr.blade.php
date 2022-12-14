<!DOCTYPE html>
<html>
	<head>
        
    <meta charset="utf-8" />
    <title>AFRICRED | Recouvrement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">
    
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />  

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <style>

        @media only screen

        and (min-device-width : 280px)

        and (max-device-width : 653px){  #web{display: none;}}
        
        @media only screen

        and (min-device-width : 320px)

        and (max-device-width : 500px){  #web{display: none;}}

        @media only screen

        and (min-device-width : 540px)

        and (max-device-width : 720px){  #web{display: none;}}


        </style>
        
         <style>
        .myDiv{
        	display:none;
           
        }  
        
        </style>

    

</head>
	<body data-sidebar="dark">
	    <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <i class="ri-loader-line spin-icon"></i>
                </div>
            </div>
        </div>

        @include('layouts.header')

		@include('layouts.left_sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                   
                    
                    
                    <!-- start page title -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 text-success">Recouvrement du jour </h4>

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
                                            <div class="mb-4 col-xl-8">
                                                <h4 class="text-success mb-2"> Total = {{number_format(($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') + $total->sum('epargne_jrs') + $total->sum('assurance') ), 0, ',', ' ')}} CFA </h4>
                                                
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
                                                   
                                                    <th>March??</th>
                                                    <th>Capital ?? ce jour</th>
                                                    <th>Int??r??t ?? ce jour</th>
                                                    <th>Epargne ?? ce jour</th>
                                                    <th>Assurance</th>
                                                    
                                                </tr>
                                            @else
                                            <tr>
                                                <th>March??</th>
                                                <th>Capital ?? ce jour</th>
                                                <th>Int??r??t ?? ce jour</th>
                                                <th>Epargne ?? ce jour</th>
                                                <th>Assurance</th>
                                                <th class="text-success">Total</th>
                                               
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
                                                        <td class="text-success">{{number_format(($item->recouvrement_jrs + $item->interet_jrs + $item->epargne_jrs + $item->assurance) , 0, ',', ' ')}} CFA</td>
                                                        

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
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                      
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
                                                
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            @include('layouts.footer')
		
	   

            @include('layouts.script')
    
    
        </body>
    </html>
