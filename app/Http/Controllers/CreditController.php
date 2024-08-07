<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Credit;
use App\Models\Marche;
use App\Services\Tool;
use Carbon\Carbon;
use Alert;
use App\Models\Filiere;
use App\Models\Secteur;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->where('type_id', '1')->where('perte', 'non')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('type_id', '1')->where('perte', 'non')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.index', compact('clients', 'credits','marches'));
    }
    
    public function nano_index()
    {
       
          
        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $listes = Credit::where('statut', 'Accordé')->where('type_id', '2')->get();
              
            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('type_id', '2')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }

        $clients = Client::where('user_id', auth()->user()->id)->get();

        $marches = Marche::get();
        
        return view('credit.nano', compact('clients', 'credits','marches'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tool = new Tool();
        $credits = [];

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
             $listes = Credit::selectRaw(
                'user_id,
                    SUM(montant) as montant,
                    SUM(interet) as interet,
                    SUM(montant_interet) as montant_interet,
                    SUM(frais_deblocage) as frais_deblocage,
                    SUM(frais_carte) as frais_carte')
                ->groupBy('user_id')
                ->get();

            foreach ($listes as $liste) {

                $montant =  $tool->montant($liste->user_id);
                $interet =  $tool->interet($liste->user_id);
                $montant_interet =  $tool->montant_interet($liste->user_id);
                $frais_deblocage =  $tool->frais_deblocage($liste->user_id);
                $frais_carte =  $tool->frais_carte($liste->user_id);

                    array_push($credits, [
                        'user_id' => $liste->user_id,
                        'montant' => $montant,
                        'interet' => $interet,
                        'montant_interet' => $montant_interet,
                        'frais_deblocage' => $frais_deblocage,
                        'frais_carte' => $frais_carte,
                    ]);

                

            }
        } else {
            $listes = Credit::where('statut', 'Accordé')->where('user_id', auth()->user()->id)->get();

            foreach ($listes as $liste) {

                $encours =  $tool->encours_actualiser($liste->user_id); 

                if ($encours > 0){
                    array_push($credits, $liste);
                }

            }
        }
        
        

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.agent', compact('clients', 'credits','marches'));
    }

    public function marche()
    {
         if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')
             ->groupBy('marche_id')
             ->where('statut', 'Accordé')->get();
 
          }else {
            $credits = Credit::selectRaw(
                'marche_id,
                 SUM(montant) as montant,
                 SUM(interet) as interet,
                 SUM(frais_deblocage) as frais_deblocage,
                 SUM(frais_carte) as frais_carte,
                 SUM(montant_interet) as montant_interet,
                 COUNT(id) as id')->where('statut', 'Accordé')->where('user_id', auth()->user()->id)
             ->groupBy('marche_id')
             ->get();
            
          }

        $clients = Client::where('user_id', auth()->user()->id)->get();
        
        $marches = Marche::get();
        
        return view('credit.marche', compact('clients', 'credits','marches'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $credit = new Credit;
        
        
        $results = $request['client_id'];

        $data_client = explode('|', $results);
        

        $interet = ($request->montant + 0) * ($request->taux + 0);
        
        $montant_interet = ($request->montant + 0) + $interet;
        
        $capital = $request->montant + 0;

        $frais_deblocage = ($request->montant + 0) * $request->frais_deblocage;

        
        if ($request->montant < 100000) {
            $nbre_jrs = 50;
            $montant_par_jour = $montant_interet / $nbre_jrs;
            $capital_par_jour = $capital / $nbre_jrs;
            $interet_par_jour = $interet / $nbre_jrs;
           
        }

        if($request->montant >= 100000){
            $nbre_jrs = 60;
            $montant_par_jour = $montant_interet / $nbre_jrs;
            $capital_par_jour = $capital / $nbre_jrs;
            $interet_par_jour = $interet / $nbre_jrs;
        }
        
  

        if ($request->montant <= 500000) {
           $epargne_par_jour = 500;
           
        }elseif(500000 < $request->montant && $request->montant <= 1000000){
           $epargne_par_jour = 2250;
           
        }elseif($request->montant > 1000000 && $request->montant < 2000000){
           $epargne_par_jour = 2500;
           
        }elseif(2000000 <= $request->montant && $request->montant < 3000000){
           $epargne_par_jour = 4500;

        }elseif(3000000 <= $request->montant && $request->montant < 4000000){
            $epargne_par_jour = 3000;

        }elseif(4000000 <= $request->montant ){
            $epargne_par_jour = 5000;
        }

        
       
       
        $statut = "En attente";
        

        $credit->create([
            'type_id'=>$request->type,
            'client_id'=>$data_client[0],
            'marche_id'=>$data_client[1],
            'nature'=>$data_client[2],
            'sexe'=>$data_client[3],
            'filiere_id'=>$data_client[4],
            'secteur_id'=>$data_client[5],
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'nbre_jrs'=>$nbre_jrs,
            'interet'=>$interet,
            'frais_deblocage'=>$frais_deblocage,
            'frais_carte'=>$request->frais_carte,
            'montant_interet'=>$montant_interet,
            'montant_par_jour'=>$montant_par_jour,
            'capital_par_jour'=>$capital_par_jour,
            'interet_par_jour'=>$interet_par_jour,
            'epargne_par_jour'=>$epargne_par_jour,
            'statut'=>$statut,
            'motif'=>$request->motif,
            'sponsor'=>$request->sponsor,
        ]);

        alert()->image('Demande envoyée!','Patientez que la demande soit accordée!','assets/images/payment.png','175','175');
       
        return redirect()->route('attente.index');
    }
    
    public function nano(Request $request)
    {
       
        $credit = new Credit;
        
        
        $results = $request['client_id'];

        $data_client = explode('|', $results);
        
        $taux = ($request->taux + 0) / 100;

        $interet = ($request->montant + 0) * $taux;
        
        $montant_interet = ($request->montant + 0) + $interet;
        
        $capital = $request->montant + 0;

        
            $nbre_jrs = $request->nbre_jrs;
            $montant_par_jour = $montant_interet / $nbre_jrs;
            $capital_par_jour = $capital / $nbre_jrs;
            $interet_par_jour = $interet / $nbre_jrs;
      
       
       
        $statut = "En attente";
        
        
        $credit->create([
            'type_id'=>$request->type,
            'client_id'=>$data_client[0],
            'marche_id'=> $data_client[1],
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'nbre_jrs'=>$nbre_jrs,
            'interet'=>$interet,
            
            'montant_interet'=>$montant_interet,
            'montant_par_jour'=>$montant_par_jour,
            'capital_par_jour'=>$capital_par_jour,
            'interet_par_jour'=>$interet_par_jour,
            
            'statut'=>$statut,
            'motif'=>$request->motif,
        ]);

        alert()->image('Demande envoyée!','Patientez que la demande soit accordée!','assets/images/payment.png','175','175');
       
        return redirect()->route('attente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $credit = Credit::where('id', $id)->firstOrFail();
        
        $credits = Credit::where('client_id', $credit->client_id)->where('type_id', 1)->count();

        return view('credit.show', compact('credit','credits'));
    }
    
    public function shownano($id)
    {
        $credit = Credit::where('id', $id)->firstOrFail();
        
        $credits = Credit::where('client_id', $credit->client_id)->where('type_id', 2)->count();
        
        $date_deblocage = $credit->date_deblocage;
        $tranche1 = Carbon::create($date_deblocage)->addDays($credit->nbre_jrs / 2);
        $tranche2 = Carbon::create($date_deblocage)->addDays($credit->nbre_jrs);

        return view('credit.show_nano', compact('credit','tranche1','tranche2','credits'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credit = Credit::where('id', $id)->firstOrFail();

        if (auth()->user()->role_id == 1 || auth()->user()->role_id == 6 || auth()->user()->role_id == 8) {
            $clients = Client::get();
          }else {
            $clients = Client::where('user_id', auth()->user()->id)->get();
          }
        
          $marches = Marche::get();
          $filieres = Filiere::get();
          $secteurs = Secteur::get();

        return view('credit.edit', compact('clients','credit','marches', 'filieres', 'secteurs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $credit = Credit::where('id', $id)->firstOrFail();
        
        $results = $request['client_id'];

        $data_credit = explode('|', $results);
        

        $interet = $request->interet;
        
        $montant_interet = ($request->montant + 0) + $interet;
        
        $capital = $request->montant + 0;

        

        if ($request->montant < 100000) {
            $nbre_jrs = 50;
            $montant_par_jour = $montant_interet / $nbre_jrs;
            $capital_par_jour = $capital / $nbre_jrs;
            $interet_par_jour = $interet / $nbre_jrs;
           
        }

        if($request->montant >= 100000){
            $nbre_jrs = 60;
            $montant_par_jour = $montant_interet / $nbre_jrs;
            $capital_par_jour = $capital / $nbre_jrs;
            $interet_par_jour = $interet / $nbre_jrs;
        }


        if ($request->montant <= 500000) {
            $epargne_par_jour = 500;
            
         }elseif(500000 < $request->montant && $request->montant <= 1000000){
            $epargne_par_jour = 2250;
            
         }elseif($request->montant > 1000000 && $request->montant < 2000000){
            $epargne_par_jour = 2500;
            
         }elseif(2000000 <= $request->montant && $request->montant < 3000000){
            $epargne_par_jour = 4500;
 
         }elseif(3000000 <= $request->montant && $request->montant < 4000000){
             $epargne_par_jour = 3000;
 
         }elseif(4000000 <= $request->montant ){
             $epargne_par_jour = 5000;
         }

        $credit->update([
            'client_id'=>$data_credit[0],
            'marche_id'=>$request->marche_id,
            'filiere_id'=>$request->filiere_id,
            'secteur_id'=>$request->secteur_id,
            'sexe'=>$data_credit[1],
            'user_id'=> auth()->user()->id,
            'montant'=>$request->montant,
            'nbre_jrs'=>$nbre_jrs,
            'interet'=>$request->interet,
            'frais_carte'=>$request->frais_carte,
            'montant_interet'=>$montant_interet,
            'montant_par_jour'=>$montant_par_jour,
            'capital_par_jour'=>$capital_par_jour,
            'interet_par_jour'=>$interet_par_jour,
            'epargne_par_jour'=>$epargne_par_jour,
            'adresse'=>$request->adresse,
            'telephone'=>$request->telephone,
            'situation_familiale'=>$request->situation_familiale,
            'nbre_enfant'=>$request->nbre_enfant,
            'nbre_femme'=>$request->nbre_femme,
            'projet_immobilier'=>$request->projet_immobilier,
            'nom_entreprise'=>$request->nom_entreprise,
            'type_activite'=>$request->type_activite,
            'date_entreprise'=>$request->date_entreprise,
            'structure'=>$request->structure,
            'adresse_entreprise'=>$request->adresse_entreprise,
            'rccm'=>$request->rccm,
            'annee_experience'=>$request->annee_experience,
            'description_produit'=>$request->description_produit,
            'revenu_brute'=>$request->revenu_brute,
            'revenu_net'=>$request->revenu_net,
            'autre_source'=>$request->autre_source,
            'dettes_existantes'=>$request->dettes_existantes,
            'valeur_actif'=>$request->valeur_actif,
            'duree_souhaitee'=>$request->duree_souhaitee,
            'utilisation_fonds'=>$request->utilisation_fonds,
            'plan_remboursement'=>$request->plan_remboursement,
            'sponsor'=>$request->sponsor,
        ]);

        alert()->image('Fiche envoyée!','Patientez que la demande soit accordée!','assets/images/payment.png','175','175');
       
        return redirect()->route('attente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $credit = Credit::findOrFail($request->credit);
        $credit->delete();
        alert()->image('Supprimée!!!','','assets/images/recycle.png','150','150');
        return redirect()->back();
    }
}
