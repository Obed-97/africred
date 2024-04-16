<div>
    <style media="screen">
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }


        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 4px;
        }

        #logo img {
            height: 90px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #1b2586;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #1b2586;
        }

        table .n1 {
            text-align: center;
        }

        table .n2 {
            background: #DDDDDD;
            text-align: center;
        }

        table .n5 {
            background: #d5c7b7;
        }

        table .n3 {
            background: #e6ad6c;
            text-align: rigth
        }

        table .n4 {
            background: #1b2586;
            color: #FFFFFF;
            text-align: center;
        }

        table td.n2,
        table td.n3,
        table td.n4 {
            font-size: 1.2em;
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #1b2586;
            font-size: 1.4em;
            border-top: 1px solid #1b2586;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
        }
    </style>
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="clearfix">
                                <div id="logo">
                                    <img src="{{ asset('assets/images/Logo AfriCRED.png') }}">
                                </div>
                                <div id="company">
                                    <br>
                                    <br>
                                    <div>Fait à Bamako le {{ \Date::now()->format('d.m.y') }}</div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Encours sans intérêt
                    </h1>
                    <p>
                        L’encours sans intérêt fait référence au capital qui reste à recouvrir sur les prêts accordés
                        aux clients dans les différents marchés.
                        Le tableau ci-dessous donne les détails sur les encours sans intérêts ou encore capital à
                        recouvrir.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($currentWeekCredits as $currentWeekCredit)
                                    @php
                                    $tool = new App\Services\Tool();
                                    $esilw = $lastWeekCredits->where('marche_id',
                                    $currentWeekCredit->marche_id)->sum('montant');
                                    $ecart = $currentWeekCredit->montant - $esilw;
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($currentWeekCredit->marche_id) }}</td>
                                        <td class="n1">{{ $currentWeekCredit->montant }}</td>
                                        <td class="n2">{{ $esilw }}</td>
                                        <td class="n4">{{ abs($ecart) }}</td>
                                    </tr>
                                    @empty
                                    @php
                                    $tool = new App\Services\Tool();
                                    @endphp
                                    @forelse ($lastWeekCredits as $lastWeekCredit)
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($lastWeekCredit->marche_id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(0) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($lastWeekCredit->montant) }}</td>
                                        <td class="n4">{{ $tool->numberFormat($lastWeekCredit->montant) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="no">-</td>
                                        <td class="n1">-</td>
                                        <td class="n2">-</td>
                                        <td class="n4">-</td>
                                    </tr>
                                    @endforelse
                                    @endforelse

                                    @php
                                    $tool = new App\Services\Tool();
                                    @endphp
                                    @forelse ($currentTotalWeekTypeCredits as $currentTotalWeekTypeCredit)
                                    <tr>
                                        <td class="n5">{{ $tool->getTypeCreditName($currentTotalWeekTypeCredit->type_id)
                                            }}</td>
                                        <td class="n1">{{ $tool->numberFormat($currentTotalWeekTypeCredit->montant) }}
                                        </td>
                                        <td class="n2">{{
                                            $tool->numberFormat($lastTotalWeekTypeCredits->where('type_id',
                                            $currentTotalWeekTypeCredit->type_id)->montant) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($currentTotalWeekTypeCredit->montant -
                                            $lttc)) }}</td>
                                    </tr>
                                    @empty
                                    @forelse ($lastTotalWeekTypeCredits as $lastTotalWeekTypeCredit)
                                    <tr>
                                        <td class="n5">{{ $tool->getTypeCreditName($lastTotalWeekTypeCredit->type_id) }}
                                        </td>
                                        <td class="n1">{{ $tool->numberFormat(0) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($lastTotalWeekTypeCredit->montant) }}</td>
                                        <td class="n4">{{ $tool->numberFormat($lastTotalWeekTypeCredit->montant) }}</td>
                                    </tr>
                                    @empty

                                    @endforelse
                                    @endforelse
                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{
                                            $tool->numberFormat($currentTotalWeekTypeCredits->sum('montant')) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($lastTotalWeekTypeCredits->sum('montant'))
                                            }}</td>
                                        <td class="n4">{{
                                            $tool->numberFormat(abs($currentTotalWeekTypeCredits->sum('montant') -
                                            $lastTotalWeekTypeCredits->sum('montant'))) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Commentaires
                    </h1>
                    <p>
                        @php
                        $se = $currentTotalWeekTypeCredits->sum('montant') - $lastTotalWeekTypeCredits->sum('montant');
                        @endphp
                        @if($se < 0) Cette semaine l’encours sans intérêt a baissé de  {{ $tool->
                            numberFormat(abs($currentTotalWeekTypeCredits->sum('montant') -
                            $lastTotalWeekTypeCredits->sum('montant'))) }}, ce qui signifie que nous avons
                            pas fait assez de déblocage cette semaine par rapport à la semaine passée.
                            {{-- Sur le capital de {{ $tool->numberFormat($lastTotalWeekTypeCredits->sum('montant')) }}
                            --}}
                            {{-- 1.611.275 CFA représente le capital à recouvrir sur les
                            crédits en difficultés de paiement et 54.135.825 CFA de capital en mouvement. --}}
                            @endif
                    </p>
                    <br>
                    <br>
                    <br>
                    <h1 class="card-title text-left mb-4">
                        Encours Global
                    </h1>

                    <p>
                        L’encours sans intérêt fait référence au capital qui reste à recouvrir sur les prêts accordés
                        aux clients dans les différents marchés.
                        Le tableau ci-dessous donne les détails sur les encours sans intérêts ou encore capital à
                        recouvrir.
                    </p>
                    <p>
                        L’encours global fait référence au montant global de crédit qui reste à recouvrir dans les
                        différents marchés. Ce montant comprend le capital et les intérêts nets.
                        Le tableau ci-dessous donne les détails sur l’encours global dans les différents marchés.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $engls1 = 0;
                                    $engls2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $engls1 += $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    );

                                    $engls2 += $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    );

                                    $ecart = $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    ) -
                                    $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    );
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($market->id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat($tool->encours_global_par_marche(
                                            $market->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )) }}</td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->encours_global_par_marche(
                                            $market->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ecart)) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{ $tool->numberFormat($engls1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($engls2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($engls1 - $engls2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Commentaires
                    </h1>
                    <p>
                        {{-- @php
                        $se = $currentTotalWeekTypeCredits->sum('montant') - $lastTotalWeekTypeCredits->sum('montant');
                        @endphp
                        @if($se < 0) Cette semaine l’encours sans intérêt a baissé de  {{ $tool->
                            numberFormat(abs($currentTotalWeekTypeCredits->sum('montant') -
                            $lastTotalWeekTypeCredits->sum('montant'))) }}, ce qui signifie que nous avons
                            pas fait assez de déblocage cette semaine par rapport à la semaine passée.
                            {{-- Sur le capital de {{ $tool->numberFormat($lastTotalWeekTypeCredits->sum('montant')) }}
                            --}}
                            {{-- 1.611.275 CFA représente le capital à recouvrir sur les
                            crédits en difficultés de paiement et 54.135.825 CFA de capital en mouvement.
                            @endif --}}
                    </p>
                    <h1 class="card-title text-left mb-4">
                        Tableau Comparatif des encours de crédit
                    </h1>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $engls1 = 0;
                                    $engls2 = 0;
                                    $ense1 = 0;
                                    $ense2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $engls1 += $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    );

                                    $engls2 += $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    );

                                    $ecart = $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    ) -
                                    $tool->encours_global_par_marche(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    );


                                    $ense1 += $tool->encours_sans_epargne_par_marche(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    );

                                    $ense2 += $tool->encours_sans_epargne_par_marche(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    );
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td class="n3">ENCOURS SANS INTERET</td>
                                        <td class="n1">{{
                                            $tool->numberFormat($currentTotalWeekTypeCredits->sum('montant')) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($lastTotalWeekTypeCredits->sum('montant'))
                                            }}</td>
                                        <td class="n4">{{
                                            $tool->numberFormat(abs($currentTotalWeekTypeCredits->sum('montant') -
                                            $lastTotalWeekTypeCredits->sum('montant'))) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="n3">ENCOURS GLOBAL</td>
                                        <td class="n1">{{ $tool->numberFormat($engls1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($engls2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($engls1 - $engls2)) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="n3">ENCOURS SANS EPARGNE</td>
                                        <td class="n1">{{ $tool->numberFormat($ense1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($ense2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ense1 - $ense2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <br>
                    <br>
                    <h1 class="card-title text-left mb-4">
                        Budget d’exploitation/Produit
                    </h1>
                    <p>
                        Les produits font référence aux intérêts nets perçu ainsi que les frais de déblocages et de
                        carnet.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            @php
                            $inn1p = 0;
                            $inn1r = 0;
                            $inn2p = 0;
                            $inn2r = 0;
                            $inn1rp = 0;
                            $inn2rp = 0;

                            $foTotal = 0;
                            $foPTotal = 0;
                            $fTotal = 0;
                            $sTotal = 0;
                            $tTotal = 0;

                            $deblo1p = 0;
                            $deblo1r = 0;
                            $deblo2p = 0;
                            $deblo2r = 0;

                            $tool = new App\Services\Tool();
                            @endphp
                            @foreach ($markets as $market)
                            @php

                            $inn1rp += $tool->interet_net_nano($market->id, $day['fourthFriday'])['prev'];
                            $inn2rp += $tool->interet_net_nano($market->id, $day['fourthFriday'])['rea'];
                            $inn1p += $tool->interet_net_nano($market->id, $day['fourthFriday'])['rea'];
                            $inn1r += $tool->interet_net_nano($market->id, $day['thirdFriday'])['rea'];
                            $inn2p += $tool->interet_net_nano($market->id, $day['secondFriday'])['rea'];
                            $inn2r += $tool->interet_net_nano($market->id, $day['firstFriday'])['rea'];

                            $deblo1p += $tool->interet_net_nano($market->id, $day['fourthFriday'])['fdeblo'];
                            $deblo1r += $tool->interet_net_nano($market->id, $day['thirdFriday'])['fdeblo'];
                            $deblo2p += $tool->interet_net_nano($market->id, $day['secondFriday'])['fdeblo'];
                            $deblo2r += $tool->interet_net_nano($market->id, $day['firstFriday'])['fdeblo'];
                            @endphp

                            @endforeach
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} P</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} R</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['thirdFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['secondFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['firstFriday']->format('d/m/y') }}</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="n3">INTERETS NETS PERÇUS SUR NANO</td>
                                        <td class="n1">{{ $tool->numberFormat(round($inn1rp)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($inn2rp)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($inn1p)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($inn1r)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($inn2p)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($inn2r)) }}</td>
                                        <td class="n4">{{ $inn1p > 0 ? round(($inn2rp/$inn1rp) * 100) : 0 }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="n3">COMMISSIONS PERÇUS SUR NANO(FRAIS DE DEBLOCAGES)</td>
                                        <td class="n1">{{ $tool->numberFormat(round($deblo1p)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($deblo1p)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($deblo1p)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($deblo1r)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($deblo2p)) }}</td>
                                        <td class="n1">{{ $tool->numberFormat(round($deblo2r)) }}</td>
                                        <td class="n4">{{ $deblo1p > 0 ? round(($deblo1r/$deblo1p) * 100) : 0 }}%</td>
                                    </tr>
                                    @foreach (\App\Models\ReportingItem::where('type', 'produit')->get() as $item)
                                    @php
                                    $fTotal += $item->getDataItem($item->id)['fData']->sum('rea');
                                    $sTotal += $item->getDataItem($item->id)['sData']->sum('rea');
                                    $tTotal += $item->getDataItem($item->id)['tData']->sum('rea');
                                    $foTotal += $item->getDataItem($item->id)['foData']->sum('rea');
                                    $foPTotal += $item->getDataItem($item->id)['foData']->sum('pre');
                                    @endphp
                                    <tr>
                                        <td class="n3">{{$item->name}}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['foData']->sum('pre') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['foData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['foData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['tData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['sData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['fData']->sum('rea') }}</td>
                                        <td class="n4">{{ $item->getDataItem($item->id)['foData']->sum('pre') > 0 ?
                                            round(($item->getDataItem($item->id)['foData']->sum('rea')/$item->getDataItem($item->id)['foData']->sum('pre'))
                                            * 100) : 0 }}%</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="n3">TOTAL Produits</td>
                                        <td class="n1">
                                            {{$tool->numberFormat($foPTotal + $deblo1p + $inn1rp)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($foTotal + $deblo1p + $inn2rp)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($foTotal + $deblo1p + $inn2rp)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tTotal + $deblo1p + $inn1r)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($sTotal + $deblo1p + $inn2p)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($fTotal + $deblo1p + $inn2r)}}
                                        </td>

                                        <td class="n4">
                                            {{ round(
                                            ($foTotal + $deblo1p + $inn2rp) / ($foPTotal + $deblo1p + $inn1rp) * 100
                                            ) }}%
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Budget d’exploitation/Rentablité par marché
                    </h1>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $engls1 = 0;
                                    $engls2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $engls1 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['renta'];

                                    $engls2 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['renta'];

                                    $ecart = $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['renta'] -
                                    $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['renta'];
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($market->id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['renta']) }}</td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['renta']) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ecart)) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($marketTypes as $marketType)

                                    @php
                                    $ecart = ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['renta'] ?? 0) - ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['renta'] ?? 0)
                                    @endphp
                                    <tr>
                                        <td class="n3">{{ $marketType->libelle }}</td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['renta'] ?? 0) }}
                                        </td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['renta'] ?? 0) }}
                                        </td>
                                        <td class="n4">{{ $ecart }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{ $tool->numberFormat($engls1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($engls2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($engls1 - $engls2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <h1 class="card-title text-left mb-4">
                        Charges
                    </h1>
                    <p>
                        Les charges font références aux frais du personnel et aux autres charges du mois.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            @php
                            $cfoTotal = 0;
                            $cfoPTotal = 0;
                            $cfTotal = 0;
                            $csTotal = 0;
                            $ctTotal = 0;
                            $tool = new App\Services\Tool();
                            @endphp
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} P</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} R</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['thirdFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['secondFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['firstFriday']->format('d/m/y') }}</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\ReportingItem::where('type', 'charge')->get() as $item)
                                    @php
                                    $cfTotal += $item->getDataItem($item->id)['fData']->sum('rea');
                                    $csTotal += $item->getDataItem($item->id)['sData']->sum('rea');
                                    $ctTotal += $item->getDataItem($item->id)['tData']->sum('rea');
                                    $cfoTotal += $item->getDataItem($item->id)['foData']->sum('rea');
                                    $cfoPTotal += $item->getDataItem($item->id)['foData']->sum('pre');
                                    @endphp
                                    <tr>
                                        <td class="n3">{{$item->name}}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['foData']->sum('pre') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['foData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['foData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['tData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['sData']->sum('rea') }}</td>
                                        <td class="n1">{{ $item->getDataItem($item->id)['fData']->sum('rea') }}</td>
                                        <td class="n4">{{ $item->getDataItem($item->id)['foData']->sum('pre') > 0 ?
                                            round(($item->getDataItem($item->id)['foData']->sum('rea')/$item->getDataItem($item->id)['foData']->sum('pre'))
                                            * 100) : 0 }}%</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="n3">Total Frais Généraux</td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfoPTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfoTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfoTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($ctTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($csTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfTotal)}}
                                        </td>

                                        <td class="n4">
                                            {{ $cfoTotal > 0 ? round(
                                            ($foTotal) / ($cfoPTotal) * 100
                                            ) : 0 }}%
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Résultat opérationnel (EBITDA)
                    </h1>
                    <p>
                        Le résultat opérationnel, également appelé résultat brut d’exploitation ou excèdent brut
                        d’exploitation, est un indicateur financier qui mesure la performance opérationnelle. Il est
                        calculé en soustrayant les charges d’exploitation ou frais généraux (coûts liés à la production
                        et à la gestion courante) des produits d’exploitation (revenus issus de l’activité principale de
                        l’entreprise). </p>

                    <div class="row">
                        <div class="col-xl-12">
                            @php
                            $cfoTotal = 0;
                            $cfoPTotal = 0;
                            $cfTotal = 0;
                            $csTotal = 0;
                            $ctTotal = 0;
                            $tool = new App\Services\Tool();
                            @endphp
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} P</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} R</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['thirdFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['secondFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['firstFriday']->format('d/m/y') }}</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\ReportingItem::where('type', 'charge')->get() as $item)
                                    @php
                                    $cfTotal += $item->getDataItem($item->id)['fData']->sum('rea');
                                    $csTotal += $item->getDataItem($item->id)['sData']->sum('rea');
                                    $ctTotal += $item->getDataItem($item->id)['tData']->sum('rea');
                                    $cfoTotal += $item->getDataItem($item->id)['foData']->sum('rea');
                                    $cfoPTotal += $item->getDataItem($item->id)['foData']->sum('pre');
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td class="n3">Produits</td>
                                        <td class="n1">
                                            {{$tool->numberFormat($foPTotal + $deblo1p + $inn1rp)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($foTotal + $deblo1p + $inn2rp)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($foTotal + $deblo1p + $inn2rp)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tTotal + $deblo1p + $inn1r)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($sTotal + $deblo1p + $inn2p)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($fTotal + $deblo1p + $inn2r)}}
                                        </td>

                                        <td class="n4">
                                            {{ round(
                                            ($foTotal + $deblo1p + $inn2rp) / ($foPTotal + $deblo1p + $inn1rp) * 100
                                            ) }}%
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="n3">Charges</td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfoPTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfoTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfoTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($ctTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($csTotal)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($cfTotal)}}
                                        </td>

                                        <td class="n4">
                                            {{ $cfoTotal > 0 ? round(
                                            ($foTotal) / ($cfoPTotal) * 100
                                            ) : 0 }}%
                                        </td>

                                    </tr>
                                    <tr>
                                        @php
                                        $ro1 = 0;
                                        $ro2 = 0;
                                        $ro3 = 0;
                                        $ro4 = 0;
                                        $ro5 = 0;
                                        $ro6 = 0;
                                        $ro7 = 0;
                                        @endphp
                                        <td class="n3">Résultat Opérationnel</td>
                                        <td class="n1">
                                            @php
                                            $ro1 = $foPTotal + $deblo1p + $inn1rp - $cfoPTotal;
                                            @endphp
                                            {{$tool->numberFormat($foPTotal + $deblo1p + $inn1rp - $cfoPTotal)}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $ro2 = $cfoTotal - $foTotal + $deblo1p + $inn2rp;
                                            @endphp
                                            {{$tool->numberFormat($cfoTotal - $foTotal + $deblo1p + $inn2rp)}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $ro3 = $cfoTotal -$foTotal + $deblo1p + $inn2rp;
                                            @endphp
                                            {{$tool->numberFormat($cfoTotal -$foTotal + $deblo1p + $inn2rp)}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $ro4 = $ctTotal - $tTotal + $deblo1p + $inn1r;
                                            @endphp
                                            {{$tool->numberFormat($ctTotal - $tTotal + $deblo1p + $inn1r)}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $ro5 = $csTotal - $sTotal + $deblo1p + $inn2p
                                            @endphp
                                            {{$tool->numberFormat($csTotal - $sTotal + $deblo1p + $inn2p)}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $ro6 = $cfTotal - $fTotal + $deblo1p + $inn2r
                                            @endphp
                                            {{$tool->numberFormat($cfTotal - $fTotal + $deblo1p + $inn2r)}}
                                        </td>

                                        <td class="n4">
                                            {{ ($cfoTotal - $foTotal + $deblo1p + $inn2rp) > 0 ? round(
                                            ($cfoTotal - $foTotal + $deblo1p + $inn2rp) / ($foPTotal + $deblo1p +
                                            $inn1rp - $cfoPTotal) * 100
                                            ) : 0 }}%
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h1 class="card-title text-left mb-4">
                        Recouvrements capitaux
                    </h1>
                    <p>
                        Le tableau ci-dessous détaille les recouvrements des capitaux cette semaine comparés au
                        recouvrement des capitaux la semaine précédente.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $engls1 = 0;
                                    $engls2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $engls1 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['recouv'];

                                    $engls2 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['recouv'];

                                    $ecart = $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['recouv'] -
                                    $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['recouv'];
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($market->id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['recouv']) }}</td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['recouv']) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ecart)) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($marketTypes as $marketType)

                                    @php
                                    $ecart = ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['recouv'] ?? 0) - ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['recouv'] ?? 0)
                                    @endphp
                                    <tr>
                                        <td class="n3">{{ $marketType->libelle }}</td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['recouv'] ?? 0) }}
                                        </td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['recouv'] ?? 0) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat($ecart) }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{ $tool->numberFormat($engls1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($engls2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($engls1 - $engls2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <h1 class="card-title text-left mb-4">
                        Recouvrements produits
                    </h1>
                    <p>
                        Les produits font références aux rentabilités perçues qui correspondent aux intérêts nets et aux
                        frais de déblocages et de carnet.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $engls1 = 0;
                                    $engls2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $engls1 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['renta'];

                                    $engls2 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['renta'];

                                    $ecart = $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['renta'] -
                                    $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['renta'];
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($market->id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['renta'] ?? 0) }}</td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['renta'] ?? 0) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ecart)) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($marketTypes as $marketType)

                                    @php
                                    $ecart = $tool->renta(
                                    $marketType->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['renta'] - $tool->renta(
                                    $marketType->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['renta']
                                    @endphp
                                    <tr>
                                        <td class="n3">{{ $marketType->libelle }}</td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['renta'] ?? 0) }}
                                        </td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['renta'] ?? 0) }}
                                        </td>
                                        <td class="n4">{{ $ecart }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{ $tool->numberFormat($engls1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($engls2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($engls1 - $engls2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <h1 class="card-title text-left mb-4">
                        Recouvrement épargnes
                    </h1>
                    <p>
                        Les épargnes collectées quotidiennement garantissent 25% du capital des prêts octroyés aux
                        clients. Le tableau ci-dessous donne les détails sur les épargnes collectées par marché.
                    </p>
                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $engls1 = 0;
                                    $engls2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $engls1 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['epargne'];

                                    $engls2 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['epargne'];

                                    $ecart = $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['epargne'] -
                                    $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['epargne'];
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($market->id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['epargne'] ?? 0) }}</td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['epargne'] ?? 0) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ecart)) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($marketTypes as $marketType)

                                    @php
                                    $ecart = ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['epargne'] ?? 0) - ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['epargne'] ?? 0)
                                    @endphp
                                    <tr>
                                        <td class="n3">{{ $marketType->libelle }}</td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['epargne'] ?? 0) }}
                                        </td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['renta'] ?? 0) }}
                                        </td>
                                        <td class="n4">{{ $ecart }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{ $tool->numberFormat($engls1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($engls2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($engls1 - $engls2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Recouvrement Global
                    </h1>
                    <p>
                        Le recouvrement global fait référence au montant global recouvré cette semaine. Le tableau
                        ci-dessous donne les détails sur les recouvrements par marché.
                    </p>

                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $rcglo1 = 0;
                                    $rcglo2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $rcglo1 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['recouv'];

                                    $rcglo2 += $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['recouv'];

                                    $ecart = $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['recouv'] -
                                    $tool->rentabli_by_market(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['recouv'];
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($market->id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['recouv']) }}</td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->rentabli_by_market(
                                            $market->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['recouv']) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ecart)) }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach ($marketTypes as $marketType)

                                    @php
                                    $ecart = ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['recouv'] ?? 0) - ($tool->renta(
                                    $marketType->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['recouv'] ?? 0)
                                    @endphp
                                    <tr>
                                        <td class="n3">{{ $marketType->libelle }}</td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['recouv'] ?? 0) }}
                                        </td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->renta(
                                            $marketType->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['recouv'] ?? 0) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat($ecart) }}</td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{ $tool->numberFormat($rcglo1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($rcglo2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($rcglo1 - $rcglo2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <h1 class="card-title text-left mb-4">
                        Encaissement
                    </h1>
                    <p>
                        Les encaissements sont la somme des capitaux recouvrés, des épargnes collectées, des assurances
                        pour les différentes activités. En plus de ça s’ajoute le Cash-Flow qui est le la trésorerie
                        générée après déduction faite des frais généraux et des investissements effectués durant la
                        période. </p>
                    <div class="row">
                        <div class="col-xl-12">
                            @php
                            $cfoTotal = 0;
                            $cfoPTotal = 0;
                            $cfTotal = 0;
                            $csTotal = 0;
                            $ctTotal = 0;
                            $tool = new App\Services\Tool();
                            @endphp
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} P</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }} R</th>
                                        <th class="n1">{{ $day['fourthFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['thirdFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['secondFriday']->format('d/m/y') }}</th>
                                        <th class="n1">{{ $day['firstFriday']->format('d/m/y') }}</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\ReportingItem::where('type', 'encaissement')->get() as $item)
                                    @php
                                    $cfTotal += $item->getDataItem($item->id)['fData']->sum('rea');
                                    $csTotal += $item->getDataItem($item->id)['sData']->sum('rea');
                                    $ctTotal += $item->getDataItem($item->id)['tData']->sum('rea');
                                    $cfoTotal += $item->getDataItem($item->id)['foData']->sum('rea');
                                    $cfoPTotal += $item->getDataItem($item->id)['foData']->sum('pre');
                                    @endphp
                                    @endforeach
                                    @php
                                    $v1 = 0;
                                    $v2 = 0;
                                    $v3 = 0;
                                    $v4 = 0;
                                    $v5 = 0;
                                    $v6 = 0;

                                    @endphp
                                    <tr>
                                        <td class="n3">Cash Flow</td>
                                        <td class="n1">
                                            @php
                                            $v1 += ($ro1 -
                                            $tool->sumInvest($day['fourthFriday'])['totalInvestPrevision']);
                                            @endphp
                                            {{$tool->numberFormat($ro1 -
                                            $tool->sumInvest($day['fourthFriday'])['totalInvestPrevision'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v2 += ($ro2 -
                                            $tool->sumInvest($day['fourthFriday'])['totalInvestRealisation']);
                                            @endphp
                                            {{$tool->numberFormat($ro2 -
                                            $tool->sumInvest($day['fourthFriday'])['totalInvestRealisation'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v3 += ($ro3 -
                                            $tool->sumInvest($day['fourthFriday'])['totalInvestRealisation']);
                                            @endphp
                                            {{$tool->numberFormat($ro3 -
                                            $tool->sumInvest($day['fourthFriday'])['totalInvestRealisation'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v4 += ($ro4 -
                                            $tool->sumInvest($day['thirdFriday'])['totalInvestRealisation']);
                                            @endphp
                                            {{$tool->numberFormat($ro4 -
                                            $tool->sumInvest($day['thirdFriday'])['totalInvestRealisation'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v5 += ($ro5 -
                                            $tool->sumInvest($day['secondFriday'])['totalInvestRealisation']);
                                            @endphp
                                            {{$tool->numberFormat($ro5 -
                                            $tool->sumInvest($day['secondFriday'])['totalInvestRealisation'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v6 += ($ro6 -
                                            $tool->sumInvest($day['firstFriday'])['totalInvestRealisation']);
                                            @endphp
                                            {{$tool->numberFormat($ro6 -
                                            $tool->sumInvest($day['firstFriday'])['totalInvestRealisation'])}}
                                        </td>

                                        <td class="n4">
                                            {{ $v1 > 0 ?
                                            round(($v2/$v1)
                                            * 100) : 0 }}%

                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="n3">Recouvrement Capital</td>
                                        <td class="n1">
                                            @php
                                            $v1 += $tool->recouvrement($day['fourthFriday'])['recouvPrevision'];
                                            @endphp
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['recouvPrevision'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v2 += $tool->recouvrement($day['fourthFriday'])['recouv'];
                                            @endphp
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['recouv'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v3 += $tool->recouvrement($day['fourthFriday'])['recouv'];
                                            @endphp
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['recouv'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v4 += $tool->recouvrement($day['thirdFriday'])['recouv'];
                                            @endphp
                                            {{$tool->numberFormat($tool->recouvrement($day['thirdFriday'])['recouv'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v5 += $tool->recouvrement($day['secondFriday'])['recouv'];
                                            @endphp
                                            {{$tool->numberFormat($tool->recouvrement($day['secondFriday'])['recouv'])}}
                                        </td>
                                        <td class="n1">
                                            @php
                                            $v6 += $tool->recouvrement($day['firstFriday'])['recouv'];
                                            @endphp
                                            {{$tool->numberFormat($tool->recouvrement($day['firstFriday'])['recouv'])}}
                                        </td>

                                        <td class="n4">

                                            {{ $tool->recouvrement($day['fourthFriday'])['recouvPrevision'] > 0 ?
                                            round(($tool->recouvrement($day['fourthFriday'])['recouv']/$tool->recouvrement($day['fourthFriday'])['recouvPrevision'])
                                            * 100) : 0 }}%
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="n3">Recouvrement Épargne</td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['epargnePrevision'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['epargne'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['epargne'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['thirdFriday'])['epargne'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['secondFriday'])['epargne'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['firstFriday'])['epargne'])}}
                                        </td>

                                        <td class="n4">

                                            {{ $tool->recouvrement($day['fourthFriday'])['epargnePrevision'] > 0 ?
                                            round(($tool->recouvrement($day['fourthFriday'])['epargne']/$tool->recouvrement($day['fourthFriday'])['epargnePrevision'])
                                            * 100) : 0 }}%
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="n3">Recouvrement Assurance</td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['assurPrevision'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['assur'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['fourthFriday'])['assur'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['thirdFriday'])['assur'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['secondFriday'])['assur'])}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($tool->recouvrement($day['firstFriday'])['assur'])}}
                                        </td>

                                        <td class="n4">

                                            {{ $tool->recouvrement($day['fourthFriday'])['assurPrevision'] > 0 ?
                                            round(($tool->recouvrement($day['fourthFriday'])['assur']/$tool->recouvrement($day['fourthFriday'])['assurPrevision'])
                                            * 100) : 0 }}%
                                        </td>

                                    </tr>
                                    @foreach (\App\Models\ReportingItem::where('type', 'encaissement')->get() as $item)
                                    @php
                                    $fTotal += $item->getDataItem($item->id)['fData']->sum('rea');
                                    $sTotal += $item->getDataItem($item->id)['sData']->sum('rea');
                                    $tTotal += $item->getDataItem($item->id)['tData']->sum('rea');
                                    $foTotal += $item->getDataItem($item->id)['foData']->sum('rea');
                                    $foPTotal += $item->getDataItem($item->id)['foData']->sum('pre');
                                    @endphp
                                    <tr>
                                        <td class="n3">{{$item->name}}</td>
                                        <td class="n1">
                                            @php
                                            $v1 += $item->getDataItem($item->id)['foData']->sum('pre');
                                            @endphp
                                            {{ $item->getDataItem($item->id)['foData']->sum('pre') }}</td>
                                        <td class="n1">
                                            @php
                                            $v2 += $item->getDataItem($item->id)['foData']->sum('rea');
                                            @endphp
                                            {{ $item->getDataItem($item->id)['foData']->sum('rea') }}</td>
                                        <td class="n1">
                                            @php
                                            $v3 += $item->getDataItem($item->id)['foData']->sum('rea');
                                            @endphp
                                            {{ $item->getDataItem($item->id)['foData']->sum('rea') }}</td>
                                        <td class="n1">
                                            @php
                                            $v4 += $item->getDataItem($item->id)['tData']->sum('rea');
                                            @endphp
                                            {{ $item->getDataItem($item->id)['tData']->sum('rea') }}</td>
                                        <td class="n1">
                                            @php
                                            $v5 += $item->getDataItem($item->id)['sData']->sum('rea');
                                            @endphp
                                            {{ $item->getDataItem($item->id)['sData']->sum('rea') }}</td>
                                        <td class="n1">
                                            @php
                                            $v6 += $item->getDataItem($item->id)['fData']->sum('rea');
                                            @endphp
                                            {{ $item->getDataItem($item->id)['fData']->sum('rea') }}</td>
                                        <td class="n4">{{ $item->getDataItem($item->id)['foData']->sum('pre') > 0 ?
                                            round(($item->getDataItem($item->id)['foData']->sum('rea')/$item->getDataItem($item->id)['foData']->sum('pre'))
                                            * 100) : 0 }}%</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="n3">TOTAL Encaissement </td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($v1) }}
                                        </td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($v2) }}
                                        </td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($v3)}}
                                        </td>
                                        <td class="n1">
                                            {{ $tool->numberFormat($v4)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($v5)}}
                                        </td>
                                        <td class="n1">
                                            {{$tool->numberFormat($v6)}}
                                        </td>

                                        <td class="n4">
                                            {{ $v1 > 0 ?
                                            round(($v2/$v1)
                                            * 100) : 0 }}%
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h1 class="card-title text-left mb-4">
                        Décaissements
                    </h1>
                    <p>
                        Les décaissements sont les montant débloqués pour les crédits, les achats de matériels de
                        travail, les travaux d’aménagement, et d’autres activités de l’institutions.
                    </p>
                    <h1 class="card-title text-left mb-4">
                        Déblocages
                    </h1>
                    <p>
                        Les déblocages sont répartis entre les marchés ci-dessous:
                    </p>

                    <div class="row">
                        <div class="col-xl-12">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th class="no"></th>
                                        <th class="n1">SEMAINE 1 (ACTUELLE)</th>
                                        <th class="n2">SEMAINE 2 (PASSEE)</th>
                                        <th class="n4">ECART</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $rcglo1 = 0;
                                    $rcglo2 = 0;
                                    @endphp
                                    @foreach ($markets as $market)
                                    @php

                                    $tool = new App\Services\Tool();
                                    $rcglo1 += $tool->deblocage(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['deblo'];

                                    $rcglo2 += $tool->deblocage(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['deblo'];

                                    $ecart = $tool->deblocage(
                                    $market->id,
                                    $tool->week()['currentWeekStartDate'],
                                    $tool->week()['currentWeekEndDate'],
                                    )['deblo'] -
                                    $tool->deblocage(
                                    $market->id,
                                    $tool->week()['lastWeekStartDate'],
                                    $tool->week()['lastWeekEndDate'],
                                    )['deblo'];
                                    @endphp
                                    <tr>
                                        <td class="no">{{ $tool->getMarcheName($market->id) }}</td>
                                        <td class="n1">{{ $tool->numberFormat($tool->deblocage(
                                            $market->id,
                                            $tool->week()['currentWeekStartDate'],
                                            $tool->week()['currentWeekEndDate'],
                                            )['deblo']) }}</td>
                                        <td class="n2">
                                            {{ $tool->numberFormat($tool->deblocage(
                                            $market->id,
                                            $tool->week()['lastWeekStartDate'],
                                            $tool->week()['lastWeekEndDate'],
                                            )['deblo']) }}
                                        </td>
                                        <td class="n4">{{ $tool->numberFormat(abs($ecart)) }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="n3">TOTAL GENERALE</td>
                                        <td class="n1">{{ $tool->numberFormat($rcglo1) }}</td>
                                        <td class="n2">{{ $tool->numberFormat($rcglo2) }}</td>
                                        <td class="n4">{{ $tool->numberFormat(abs($rcglo1 - $rcglo2)) }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
</div>
