@section('title', 'Recouvrement')

@extends('master')

@section('content')

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    @php
    $sum_frais_deblocage = 0;
    $sum_frais_carte = 0;
    $sum_montant_interet = 0;
    $encours = 0;
    foreach($credits as $credit){
    $sum_frais_deblocage = $credit->frais_deblocage + $sum_frais_deblocage ;
    $sum_frais_carte = $credit->frais_carte + $sum_frais_carte;
    $sum_montant_interet = $credit->montant_interet + $sum_montant_interet;
    $encours = $credit->encours($credit->montant_interet) + $encours;
    }
    @endphp
    <div class="page-content">
        <div class="container-fluid">


            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 text-success">Recouvrement Global :
                            {{number_format(((($total->sum('recouvrement_jrs') + $total->sum('interet_jrs') +
                            $total->sum('epargne_jrs') + $total->sum('assurance') + $epargnes->sum('frais_deblocage') +
                            $epargnes->sum('frais_carte'))) - $total->sum('retrait')), 0, ',', ' ')}} CFA </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0" id="web">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Africred</a></li>
                                <li class="breadcrumb-item active">Recouvrement Global</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row mb-4">
                <div class="col-xl-2" id="web">

                    <button type="button" class="btn btn-primary btn-block waves-effect waves-light" data-toggle="modal"
                        data-target="#arrete">
                        <i class="ri-survey-line  align-middle mr-2"></i> ÉTATS D'ARRÊTÉ
                    </button>

                </div>
                <div class="col-xl-4" id="web">
                    <form method="POST" action="{{route('date.store')}}" class="d-flex mb-4">
                        @csrf
                        <div class="col-xl-6"><input type="date" name="date" class="form-control"></div>
                        <div class="col-xl-2"><button type="submit" class="btn btn-primary  waves-effect waves-light"><i
                                    class=" ri-search-2-line"></i> </div>
                    </form>
                </div>
                <div class="col-xl-2" id="web">

                </div>
                <div class="col-xl-2"><a href="{{route('historique.index')}}"
                        class="btn btn-primary btn-block  waves-effect waves-light mb-2"><i
                            class="ri-file-list-3-line  align-middle mr-2"></i> HISTORIQUE</a></div>
                <div class="col-xl-2"><a href="{{route('etat_recouvrement.index')}}"
                        class="btn btn-success btn-block  waves-effect waves-light"><i
                            class=" ri-bank-line  align-middle mr-2"></i> ÉTAT DU JOUR</a></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-right mb-4">
                                @if (auth()->user()->role_id == 2)
                                <button type="button" class="btn btn-primary waves-effect waves-light mb-3"
                                    data-toggle="modal" data-target="#staticBackdrop">
                                    <i class="ri-calendar-check-line  align-middle mr-2"></i> Recouvrement
                                </button>
                                <button type="button" class="btn btn-danger  waves-effect waves-light mb-3"
                                    data-toggle="modal" data-target="#static"><i
                                        class="ri-arrow-up-fill  align-middle mr-1"></i> Retrait Épargne</button>
                                @endif
                            </h4>
                            <div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('recouvrement.store')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"><i
                                                        class="ri-calendar-check-line  align-middle mr-2"></i>
                                                    Recouvrement journalier</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group ">
                                                    <label>Date</label>
                                                    <div>
                                                        <input class="form-control" type="date" name="date" id="date"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Client</label>
                                                    <select class="form-control select2" name="credit_id" required>
                                                        @foreach ($credits as $item)
                                                        <option
                                                            value="{{$item->id}}|{{$item->marche_id}}|{{$item->montant_interet}}|{{$item->type_id}}">
                                                            {{$item->Client['nom_prenom']}} :
                                                            {{number_format(($item->encours($item->montant_interet)), 0,
                                                            ',', ' ')}} CFA
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                </div>


                                                <div class="row">
                                                    <div class="col-6 form-group ">
                                                        <label>Capital</label>
                                                        <div>
                                                            <input class="form-control" type="number"
                                                                name="recouvrement_jrs" min="0" id="recouvrement_jrs"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group ">
                                                        <label>Intérêt</label>
                                                        <div>
                                                            <input class="form-control" type="number" name="interet_jrs"
                                                                min="0" id="interet_jrs" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 form-group ">
                                                        <label>Epargne</label>
                                                        <div>
                                                            <input class="form-control" type="number" name="epargne_jrs"
                                                                min="0" id="epargne_jrs" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group ">
                                                        <label>Assurance</label>
                                                        <div>
                                                            <input class="form-control" type="number" name="assurance"
                                                                min="0" id="assurance" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
                                                    data-dismiss="modal">Annuler</button>
                                                <button class="btn btn-primary waves-effect waves-light"
                                                    type="submit"><i
                                                        class="ri-calendar-check-line  align-middle mr-2"></i>
                                                    Recouvrir</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal fade" id="static" tabindex="-1" role="dialog"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('retrait.epargne')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Retrait Épargne</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-group ">
                                                    <label>Date</label>
                                                    <div>
                                                        <input class="form-control" type="date" name="date" id="date"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Client</label>
                                                    <select class="form-control select2" name="credit_id" required>
                                                        @foreach ($epargnes as $item)
                                                        <option
                                                            value="{{$item->id}}|{{$item->marche_id}}|{{$item->montant_interet}}|{{$item->type_id}}">
                                                            {{$item->Client['nom_prenom']}} :
                                                            {{number_format($item->getEpargne($item->id), 0, ',', ' ')}}
                                                            CFA
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                </div>


                                                <div class="form-group ">
                                                    <label>Montant du retrait</label>
                                                    <div>
                                                        <input class="form-control" type="number" name="retrait" min="0"
                                                            id="retrait" required>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
                                                    data-dismiss="modal">Annuler</button>
                                                <button class="btn btn-danger waves-effect waves-light" type="submit"><i
                                                        class="  ri-arrow-up-line"></i> Retirer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal fade" id="arrete" tabindex="-1" role="dialog"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('etat_recouvrement.store')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel"><i
                                                        class="ri-survey-line  align-middle mr-2"></i> États d'arrêté
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 8)
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label>Marché</label>
                                                            <select class="form-control select2" name="marche_id"
                                                                required>
                                                                @foreach ($marches as $item)
                                                                <option value="{{$item->id}}|{{$item->libelle}}">
                                                                    {{$item->libelle}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group ">
                                                            <label>Agent</label>
                                                            <select class="form-control select2" name="user_id"
                                                                required>
                                                                @foreach ($agents as $item)
                                                                <option value="{{$item->id}}|{{$item->nom}}">
                                                                    {{$item->nom}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    <label>Marché</label>
                                                    <select class="form-control select2" name="marche_id" required>
                                                        @foreach ($marches as $item)
                                                        <option value="{{$item->id}}|{{$item->libelle}}">
                                                            {{$item->libelle}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect"
                                                    data-dismiss="modal">Annuler</button>
                                                <button class="btn btn-primary waves-effect waves-light"
                                                    type="submit"><i class="ri-survey-line  align-middle mr-2"></i>
                                                    Arrêter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-xl-4">
                                    <label for="">Afficher par :</label>
                                    @if (auth()->user()->role_id == 2)
                                    <a href="{{route('recouvrement.index')}}"
                                        class="btn btn-success btn-sm waves-effect waves-light mr-2"><i
                                            class="ri-user-3-line"></i> Client</a>
                                    <a href="{{route('recouvrement.create')}}"
                                        class="btn btn-success btn-sm waves-effect waves-light"><i
                                            class="ri-store-2-line "></i> Marché</a>
                                    @else
                                    <a href="{{route('recouvrement.index')}}"
                                        class="btn btn-success btn-sm waves-effect waves-light mr-2"><i
                                            class="ri-user-3-line"></i> Agent</a>

                                    <a href="{{route('recouvrement.create')}}"
                                        class="btn btn-success btn-sm waves-effect waves-light"><i
                                            class="ri-store-2-line "></i> Marché</a>
                                    @endif
                                </div>
                            </div>

                            <table id="datatable-buttons" class="table  dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>

                                    <tr>
                                        <th></th>
                                        <th>Client</th>
                                        <th>Marché</th>
                                        <th>Encours Global</th>
                                        <th>Capital & Intérêt</th>
                                        <th>Capital</th>
                                        <th>Capital Restant</th>
                                        <th>Intérêt</th>
                                        <th>Intérêt Restant</th>
                                        <th>Epargne</th>
                                        <th>Assurance</th>
                                        <th>Frais de déblocage</th>
                                        <th>Frais de carte</th>
                                        <th style="background-color: #ff3d60; color: white ">Rétrait Épargne</th>



                                    </tr>

                                </thead>


                                <tbody>

                                    @php
                                    use Illuminate\Support\Facades\Log;

                                    @endphp
                                    @foreach ($recouvrements as $item)
                                    @php
                                    if(!isset($item->Credit->Client)){


                                    Log::info('Recouvrement : ' . $item);
                                    Log::info('creation de l\'élément avec ID : ' . $item->id);
                                    Log::info('PAR : ' . auth()->user()->email);
                                    }

                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="/assets/images/users/{{$item->Credit->Client['image'] ?? ''}}" alt=""
                                                class="rounded-circle avatar-sm">
                                        </td>

                                        <td>{{$item->Credit->Client['nom_prenom']}}</td>

                                        <td>{{$item->Credit->Client->Marche['libelle']}}</td>

                                        @if(intval($item->Credit->montant_interet) - (intval($item->interet_jrs) +
                                        intval($item->recouvrement_jrs)) < 0) <td>
                                            {{number_format(intval($item->Credit->montant_interet) -
                                            (intval($item->interet_jrs) + intval($item->recouvrement_jrs)), 0, ',', '
                                            ')}} CFA (Erreur)</td>
                                        @elseif(intval($item->Credit->montant_interet) - (intval($item->interet_jrs)
                                            + intval($item->recouvrement_jrs)) == 0)
                                            <td>
                                                <div class="badge badge-soft-success font-size-14"><i
                                                        class="ri-check-line align-middle mr-2"></i>Crédit soldé</div>
                                            </td>
                                        @else
                                            <td>{{number_format(intval($item->Credit->montant_interet) -
                                                (intval($item->interet_jrs) + intval($item->recouvrement_jrs)), 0, ',',
                                                ' ')}} CFA</td>
                                        @endif

                                        <td>{{number_format(($item->Credit['montant_interet']), 0, ',', ' ')}} CFA
                                            </td>

                                            <td>{{number_format($item->recouvrement_jrs, 0, ',', ' ')}} CFA</td>

                                            <td>{{number_format( intval($item->Credit->montant) - $item->recouv(),
                                                0, ',', ' ')}} CFA</td>

                                            <td>{{number_format($item->interet_jrs, 0, ',', ' ')}} CFA</td>

                                            <td>{{number_format( intval($item->Credit->interet) -
                                                $item->recouvInte(), 0, ',', ' ')}} CFA</td>

                                            <td>{{number_format(($item->epargne_jrs - $item->retrait), 0, ',', ' ')}}
                                                CFA</td>

                                            <td>{{number_format($item->assurance, 0, ',', ' ')}} CFA</td>

                                            <td>{{number_format($item->getFraisDeblocageCredit($item->credit_id), 0,
                                                ',', ' ')}} CFA</td>

                                            <td>{{number_format($item->getFraisCarteCredit($item->credit_id), 0, ',', '
                                                ')}} CFA</td>

                                            <td>{{number_format($item->retrait, 0, ',', ' ')}} CFA</td>

                                    </tr>
                                    @endforeach
                                    <tr style="background-color: #1cbb8c; color: white ">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{number_format($sum_montant_interet, 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($total->sum('recouvrement_jrs'), 0, ',', ' ')}} CFA</td>
                                        <td></td>
                                        <td>{{number_format($total->sum('interet_jrs'), 0, ',', ' ')}} CFA</td>
                                        <td></td>
                                        <td>{{number_format(($total->sum('epargne_jrs') - $total->sum('retrait')), 0,
                                            ',', ' ')}} CFA</td>
                                        <td>{{number_format($total->sum('assurance'), 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($epargnes->sum('frais_deblocage'), 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($epargnes->sum('frais_carte'), 0, ',', ' ')}} CFA</td>
                                        <td>{{number_format($total->sum('retrait'), 0, ',', ' ')}} CFA</td>
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
