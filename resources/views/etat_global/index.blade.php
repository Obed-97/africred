@section('title', 'Tableau de bord')

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
                    <h4 class="mb-0 text-success"> État Global </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0" id="web"> 
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                            <li class="breadcrumb-item active">État Global</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row mb-4">
            <div class="col-xl-4" id="web">
               <form  method="POST" action="{{route('etat_global.store')}}" class="d-flex mb-4">
                   @csrf
                   <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                   <div class="col-xl-2"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> </div>
               </form>
            </div>
              <div class="col-xl-6" id="web">
                   <form  method="POST" action="{{route('filtre.store')}}" class="d-flex mb-4">
                       @csrf
                       <div class="col-xl-3"><input type="date" name="fdate" class="form-control"></div>
                       <div class="col-xl-3"><input type="date" name="sdate"  class="form-control"></div>
                       <div class="col-xl-3"><button type="submit"  class="btn btn-primary  waves-effect waves-light"><i class=" ri-search-2-line"></i> Filtrer</div>
                   </form>
               </div> 
               <div class="col-xl-2"><a href="/" class="btn btn-success btn-block  waves-effect waves-light">ÉTAT DU JOUR</a></div>
           </div>
            <div class="row" id="web">
                <div class="col-xl-8">
                    <div id="container" class="mb-4"></div>
                </div>
                <div class="col-xl-4">
                    <div id="chart_container" class="mb-4"></div>
                </div>
            </div>
               @if (auth()->user()->role_id == 5)
               <div class="row">
                   <div class="col-xl-12">
                       <div class="row">
                           <div class="col-md-3">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Encaissement</p>
                                               <h4 class="mb-0">{{number_format($encaissements->sum('montant'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-success">
                                               <i class="ri-arrow-down-fill font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       
                                   </div>
                               </div>
                           </div>
   
                           <div class="col-md-3">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Décaissement</p>
                                               <h4 class="mb-0">{{number_format($decaissements->sum('montant'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-danger">
                                               <i class="ri-arrow-up-fill font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       
                                   </div>
                               </div>
                           </div>
   
                           <div class="col-md-3">
                               <div class="card bg-primary">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-white font-size-14 mb-2">Caisse</p>
                                               <h4 class="mb-0 text-white">{{ number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-white">
                                               <i class="ri-coin-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="card bg-info">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-white font-size-14 mb-2">Banque</p>
                                               <h4 class="mb-0 text-white">{{ number_format(($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-white">
                                               <i class="ri-bank-fill font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       
                                   </div>
                               </div>
                           </div>
                           
                       </div>
                       <!-- end row -->
                       <!-- end row -->
                  <!-- start page title -->
                  <div class="row">
                   <div class="col-12">
                       <div class="page-title-box d-flex align-items-center justify-content-between">
                           <h4 class="mb-0"> ADMINISTRATION</h4>
       
                           <div class="page-title-right">
                               <ol class="breadcrumb m-0"> 
                                   
                               </ol>
                           </div>
       
                       </div>
                   </div>
               </div>
               <!-- end page title -->
   
               <div class="row">
                   <div class="col-xl-12">
                       <div class="row">
                               <div class="col-md-3" >
                                   <div class="card">
                                       <div class="card-body">
                                           <div class="media">
                                               <div class="media-body overflow-hidden">
                                                   <p class="text-truncate font-size-14 mb-2">Nouveaux comptes</p>
                                                   <h4 class="mb-0">{{count($clients)}} compte(s)</h4>
                                               </div>
                                               <div class="text-primary">
                                                   <i class=" ri-team-line font-size-24"></i>
                                               </div>
                                           </div>
                                       </div>
       
                                      
                                   </div>
                               </div>
                               <div class="col-md-3" >
                                   <div class="card">
                                       <div class="card-body">
                                           <div class="media">
                                               <div class="media-body overflow-hidden">
                                                   <p class="text-truncate font-size-14 mb-2">Nombre total agent de terrain</p>
                                                   <h4 class="mb-0">{{count($agents)}} agent(s)</h4>
                                               </div>
                                               <div class="text-primary">
                                                   <i class=" ri-team-line font-size-24"></i>
                                               </div>
                                           </div>
                                       </div>
       
                                      
                                   </div>
                               </div>
                               <div class="col-md-3" >
                                <div class="card bg-success">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Trésorerie</p>
                                                <h4 class="mb-0 text-white">{{number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))) + ($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ') }} CFA</h4>
                                            </div>
                                            <div class="text-white">
                                                <i class=" ri-line-chart-fill font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                              
                       </div>
                       <!-- end row -->
       
                       
                   </div>
       
                 
               </div>
   
   
                       
                   </div>
   
               
               </div>  
               @else
               <div class="row">
                   <div class="col-xl-12">
                       <div class="row">
                           <div class="col-md-4">
                               <div class="card bg-primary">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-white font-size-14 mb-2">Total Recouvrement & Frais</p>
                                               <h4 class="mb-0 text-white">{{number_format(($recouvrements->sum('recouvrement_jrs') + $recouvrements->sum('interet_jrs') + $recouvrements->sum('epargne_jrs') + $recouvrements->sum('assurance') + $credits->sum('frais_deblocage') + $credits->sum('frais_carte') ), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-white">
                                               <i class=" ri-scales-line  font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-white">
                                           <span class="text-white ml-2">Agents en charge :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($agents)}} </span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                              
                           <div class="col-md-4">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Total capital recouvré</p>
                                               <h4 class="mb-0">{{number_format($recouvrements->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-primary">
                                               <i class="ri-store-2-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-muted ml-2">Agents en charge :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($agents)}} </span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Total intérêt net recouvré</p>
                                               <h4 class="mb-0">{{number_format($recouvrements->sum('interet_jrs'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-primary">
                                               <i class=" ri-calendar-check-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-muted ml-2">Agents en charge :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($agents)}} </span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Solde épargne quotidienne</p>
                                               <h4 class="mb-0">{{number_format(($recouvrements->sum('epargne_jrs')-$recouvrements->sum('retrait')), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-primary">
                                               <i class=" ri-funds-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-muted ml-2">Retraits effectués :</span>
                                           <span class="badge badge-soft-success font-size-14">{{number_format($recouvrements->sum('retrait'), 0, ',', ' ')}} CFA </span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Total assurance recouvrée</p>
                                               <h4 class="mb-0">{{number_format($recouvrements->sum('assurance'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-primary">
                                               <i class=" ri-vip-crown-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-muted ml-2">Agents en charge :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($agents)}} </span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Total frais de déblocage</p>
                                               <h4 class="mb-0">{{number_format($credits->sum('frais_deblocage'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-primary">
                                               <i class="ri-wallet-3-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-muted ml-2">Nombre total de déblocages :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($credits)}}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
   
                           <div class="col-md-3">
                               <div class="card">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-truncate font-size-14 mb-2">Total frais de carte</p>
                                               <h4 class="mb-0">{{number_format($credits->sum('frais_carte'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-primary">
                                               <i class="ri-bank-card-2-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-muted ml-2">Nombre total de cartes :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($credits)}}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="card bg-primary text-white ">
                                   <div class="card-body ">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class=" font-size-14 mb-2">Total montant déblocage</p>
                                               <h4 class="mb-0 text-white">{{number_format($credits->sum('montant'), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div >
                                               <i class="ri-hand-coin-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
   
                                   <div class="card-body text-white border-top py-3">
                                       <div class="text-truncate">
                                           <span class=" ml-2">Nombre total de déblocages :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($credits)}}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="card bg-secondary">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-white font-size-14 mb-2">Solde épargne</p>
                                               <h4 class="mb-0 text-white">{{number_format(($epargne->sum('depot')) - ($epargne->sum('retrait')), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-white">
                                               <i class="ri-funds-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-white ml-2">Nombre clients :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($epargne)}}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
   
                           <div class="col-md-3">
                               <div class="card bg-secondary">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-white font-size-14 mb-2">Solde tontine</p>
                                               <h4 class="mb-0 text-white">{{number_format(($tontine->sum('depot')) - ($tontine->sum('retrait')), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-white">
                                               <i class="ri-recycle-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-white ml-2">Nombre clients :</span>
                                           <span class="badge badge-soft-success font-size-20">{{count($tontine)}}</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
   
                           <div class="col-md-3">
                               <div class="card bg-info">
                                   <div class="card-body">
                                       <div class="media">
                                           <div class="media-body overflow-hidden">
                                               <p class="text-white font-size-14 mb-2">Caisse</p>
                                               <h4 class="mb-0 text-white">{{ number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                           </div>
                                           <div class="text-white">
                                               <i class="ri-coin-line font-size-24"></i>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="card-body border-top py-3">
                                       <div class="text-truncate">
                                           <span class="text-white ml-2">Enc. :</span>
                                               <span class="badge badge-soft-white text-white font-size-12">{{number_format($encaissements->sum('montant'), 0, ',', ' ')}} CFA</span>
                                               <span class="text-white ml-2">Déc. :</span>
                                               <span class="badge badge-soft-white text-white font-size-12">{{number_format($decaissements->sum('montant'), 0, ',', ' ')}} CFA</span>
                                       </div>
                                   </div>
                               </div>
                           </div>
   
                       </div>
                       <!-- end row -->
                       <!-- end row -->
                  <!-- start page title -->
                  <div class="row">
                   <div class="col-12">
                       <div class="page-title-box d-flex align-items-center justify-content-between">
                           <h4 class="mb-0"> ADMINISTRATION</h4>
       
                           <div class="page-title-right">
                               <ol class="breadcrumb m-0"> 
                                   
                               </ol>
                           </div>
       
                       </div>
                   </div>
               </div>
               <!-- end page title -->
   
               <div class="row">
                   <div class="col-xl-12">
                       <div class="row">
                                 <div class="col-md-2" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Tous les comptes</p>
                                                <h4 class="mb-0">{{count($clients)}} </h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-bank-card-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Agents de terrain</p>
                                                <h4 class="mb-0">{{count($agents)}} </h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class=" ri-team-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Marchés</p>
                                                <h4 class="mb-0">{{count($marches)}} </h4>
                                            </div>
                                            <div class="text-primary">
                                                <i class="ri-store-2-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                               <div class="col-md-3" >
                                <div class="card bg-info">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Banque</p>
                                                <h4 class="mb-0 text-white">{{ number_format(($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ')}} CFA</h4>
                                            </div>
                                            <div class="text-white">
                                                <i class=" ri-bank-fill font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                            <div class="col-md-3" >
                                <div class="card bg-success">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body overflow-hidden">
                                                <p class="text-white font-size-14 mb-2">Trésorerie</p>
                                                <h4 class="mb-0 text-white">{{number_format(($encaissements->sum('montant') - ($decaissements->sum('montant'))) + ($depots->sum('montant') - ($retraits->sum('montant'))), 0, ',', ' ') }} CFA</h4>
                                            </div>
                                            <div class="text-white">
                                                <i class="ri-line-chart-fill font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                   
                                </div>
                            </div>
                              
                       </div>
                       <!-- end row -->
       
                       
                   </div>
       
                 
               </div>
               </div>
           </div>  
           @endif

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@endsection
@section('extra-js')

<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">

    var datas =<?php echo json_encode($datas)?>;
    var donnes_deblocage =<?php echo json_encode($donnes_deblocage)?>;
    var donnees_client =<?php echo json_encode($donnees_client)?>;
    var donnes_deblocages =<?php echo json_encode($donnes_deblocages)?>;

    Highcharts.chart('container', {

       title:{
           text: 'Statistiques Globales',
           style: {
                  fontSize: '18px',
                  fontFamily: 'Inter'
               }
       }, 
       subtitle:{
           text: 'Source : AFRICRED',
            style: {
                   
                    fontFamily: 'Inter'
                }
       },
        credits: {
            enabled: false
        },

       xAxis:{
        categories: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Aoû', 'Sep',

                'Oct', 'Nov', 'Déc']
       },

       yAxis: [{
                    title: {
                        text: 'Échelles'
                    },

                }
                ],

      

       plotOptions:{
            series:{
                allowPointSelect:true
            }
       },
       series: [{
            name: 'Comptes 2022',
            type: 'spline',
            color:'#5664d2',
            data: datas
        },{
            name: 'Déblocages 2022',
            type: 'areaspline',
            color: '#1cbb8c',
            data: donnes_deblocage
        },
        {
            name: 'Comptes 2023',
            type: 'scatter',
            color:'#5664d2',
            data: donnees_client
        },
        {
            name: 'Déblocages 2023',
            type: 'scatter',
            color: '#1cbb8c',
            data: donnes_deblocages
        },
    ],

       responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
    

  
</script>

<script>
        Highcharts.chart('chart_container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
            
        },
        title: {
            text: 'Chiffres d\'affaire Globaux',
            align: 'left',
            style: {
                  fontSize: '18px',
                  fontFamily: 'Inter'
               }
    
        },
         credits: {
            enabled: false
        },
        
        tooltip: {
            outside: true,
            pointFormat: '{series.name}: <b>{point.y} CFA</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                
            }
        },
        series: [{
            name: 'Total',
            colorByPoint: true,
            data: [ {
                name: 'Déblocage ',
                y: <?= $deblocage_annee ?>,
                color: '#4aa3ff',
                dataLabels: {
                    enabled: true,
                    useHTML: true,
                    allowOverlap: true,
                    distance: -130,
                    format:'<img src="/assets/images/Logo AfriCRED.png" alt="" height="50" width="150"></img>'  

              }
            },
            {
                name: 'Encours Global',
                y: <?= $encours_global  ?>,
                color: '#fcb92c',
            },
            {
                name: 'Intérêt',
                y: <?= $interet_recouvre ?>,
                color: '#1cbb8c' 
            },
            {
                name: 'Capital',
                y: <?= $capital_recouvre ?>,
                color: '#5664d2', 
                
            }
           ],
           
            size: 250,
            innerSize: '80%',
            showInLegend: true,
            dataLabels: {
                enabled: false
            }
        }]
            
    });

</script>


@endsection


