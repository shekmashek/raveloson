@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Facture</p>
@endsection

@section('content')

<style>
    table,
    th {
        font-size: 11px;
    }

    table,
    td {
        font-size: 11px;
    }

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

    .input_inscription {
        padding: 2px;
        border-radius: 100px;
        box-sizing: border-box;
        color: #9E9E9E;
        border: 1px solid #BDBDBD;
        font-size: 16px;
        letter-spacing: 1px;
        height: 50px !important;
        border: 2px solid #aa076c17 !important;


    }

    .input_inscription:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 2px solid #AA076B !important;
        outline-width: 0 !important;
    }


    .form-control-placeholder {
        position: absolute;
        top: 1rem;
        padding: 12px 2px 0 2px;
        padding: 0;
        padding-top: 2px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        transition: all 300ms;
        opacity: 0.5;
        left: 2rem;
    }

    .input_inscription:focus+.form-control-placeholder,
    .input_inscription:valid+.form-control-placeholder {
        font-size: 95%;
        font-weight: bolder;
        top: 1rem;
        transform: translate3d(0, -100%, 0);
        opacity: 1;
        backgroup-color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        box-shadow: 0 0 0 30px white inset !important;
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

    .status_grise {
        border-radius: 1rem;
        background-color: #637381;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reprogrammer {
        border-radius: 1rem;
        background-color: #00CDAC;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_cloturer {
        border-radius: 1rem;
        background-color: #314755;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reporter {
        border-radius: 1rem;
        background-color: #26a0da;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_annulee {
        border-radius: 1rem;
        background-color: #b31217;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_termine {
        border-radius: 1rem;
        background-color: #1E9600;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_confirme {
        border-radius: 1rem;
        background-color: #2B32B2;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .statut_active {
        border-radius: 1rem;
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .btn_creer {
        background-color: white;
        border: none;
        border-radius: 30px;
        padding: .2rem 1rem;
        color: black;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .btn_creer a {
        font-size: .8rem;
        position: relative;
        bottom: .2rem;
    }

    .btn_creer:hover {
        background: #6373812a;
        color: blue;
    }

    .btn_creer:focus {
        color: blue;
        text-decoration: none;
    }

    .icon_creer {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .4rem;
        margin-right: .3rem;
    }


    .color-text-trie {
        color: blue;
    }

    .button_encaiss{
        visibility: hidden;
    }
    .td_encaiss:hover .button_encaiss{
        visibility: visible;
    }
    .dataTables_filter label, #modifTable_length label, #modifTable_length select, #modifTable_filter label, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
        font-size: 13px;
    }

    #example_length select{
        height: 25px;
        font-size: 13px;
        vertical-align: middle;
    }
</style>


<div class="container-fluid">
    {{-- <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>

    @if(isset($invoice_dte) && isset($due_dte))
    <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
        filtre activ?? <i class="fas fa-times"></i> </a>
    @elseif(isset($solde_debut) && isset($solde_fin))
    <a href="{{route('liste_facture')}}"><span class="btn_creer  text-center filter"><span style="position: relative; bottom: -0.2rem">
            </span> filtre activ?? <i class="fas fa-times"></i></span>
    </a>
    @elseif(isset($num_fact))
    <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
        filtre activ?? <i class="fas fa-times"></i> </a>
    @elseif(isset($entiter_id))
    <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
        filtre activ?? <i class="fas fa-times"></i> </a>
    @elseif(isset($status))
    <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
        filtre activ?? <i class="fas fa-times"></i> </a>

    @endif --}}

    <div class="m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">

                @if (isset($pour_list))
                @if ($pour_list == "TOUT")
                <a href="#" class="nav-link active" id="nav-tous-tab" data-bs-toggle="tab" data-bs-target="#nav-tous" type="button" role="tab" aria-controls="nav-tous" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id="nav-tous-tab" data-bs-toggle="tab" data-bs-target="#nav-tous" type="button" role="tab" aria-controls="nav-tous" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link active" id="nav-tous-tab" data-bs-toggle="tab" data-bs-target="#nav-tous" type="button" role="tab" aria-controls="nav-tous" aria-selected="true">
                            @endif
                            TOUT
                            {{count($full_facture)}}
                        </a>

            </li>
            <li class="nav-item">
                @if (isset($pour_list))
                @if ($pour_list == "INACTIF")
                <a href="#" class="nav-link active" id="nav-brouilon-tab" data-bs-toggle="tab" data-bs-target="#nav-brouilon" type="button" role="tab" aria-controls="nav-brouilon" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id="nav-brouilon-tab" data-bs-toggle="tab" data-bs-target="#nav-brouilon" type="button" role="tab" aria-controls="nav-brouilon" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link " id="nav-brouilon-tab" data-bs-toggle="tab" data-bs-target="#nav-brouilon" type="button" role="tab" aria-controls="nav-brouilon" aria-selected="false">
                            @endif
                            Brouillon
                            {{count($facture_inactif)}}
                        </a>
            </li>
            <li class="nav-item">
                @if (isset($pour_list))
                @if ($pour_list == "ACTIF")
                <a href="#" class="nav-link active" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="false">
                            @endif
                            Impay??
                            {{count($facture_actif)}}
                        </a>
            </li>
            <li class="nav-item">
                @if (isset($pour_list))
                @if ($pour_list == "PAYER")
                <a href="#" class="nav-link active" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                            @endif
                            Pay??
                            {{count($facture_payer)}}
                        </a>
            </li>
            <li>
                <a href="{{route('facture')}}" class="btn_nouveau">
                    <i class="bx bx-plus-medical me-2"></i>
                    Nouveau Facture
                </a>
            </li>
        </ul>


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="tab-content mt-3" id="nav-tabContent">

                        @if (isset($pour_list))
                        @if ($pour_list == "TOUT")
                        <div class="tab-pane fade show active" id="nav-tous" role="tabpanel" aria-labelledby="nav-tous-tab">
                            @else
                            <div class="tab-pane fade" id="nav-tous" role="tabpanel" aria-labelledby="nav-tous-tab">
                                @endif
                                @else
                                <div class="tab-pane fade  show active" id="nav-tous" role="tabpanel" aria-labelledby="nav-tous-tab">
                                    @endif

                                    {{------------------------------------------------------------------------------- pagination facture full--}}
                                    {{-- @include("admin.facture.pagination_cfp.pagination_tout_facture") --}}

                                    <table class="table table-hover facture_table myTable">
                                        <thead style="background: #c7c9c939; border-color: white">
                                            <tr>
                                                <th>#</th>
                                                <th >Type</th>
                                                <th>
                                                    <a href="#" style="color: blue" value="0">F # &nbsp; </a>
                                                </th>
                                                <th >
                                                    <a value="0">Entreprise &nbsp; </a>
                                                </th>
                                                <th scope="col">
                                                    <a value="0">Date de facturation &nbsp; <span class="fact_has_arrow"></span></a>
                                                </th>
                                                <th ><a value="0">Date de r??glement &nbsp; <span class="dte_has_arrow"></span></a>
                                                </th>
                                                <th >
                                                    <a value="0"> Total ?? payer &nbsp; <span class="total_has_arrow"></span></a>
                                                </th>
                                                <th >
                                                    <a value="0"> Solde &nbsp; <span class="rest_has_arrow"></span></a>
                                                </th>
                                                <th >Statut</th>
                                                @canany(['isCFP'])
                                                <th >Action</th>
                                                @endcanany
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if (count($full_facture) > 0)
                                            @foreach ($full_facture as $actif)

                                            <tr>
                                                <td>
                                                    @if($actif->facture_encour =="en_cour"  || $actif->facture_encour =="terminer")

                                                        <h6><a href="#collapseprojet_{{$actif->num_facture}}" class="mb-0 changer_carret d-flex pt-2" data-bs-toggle="collapse" role="button"><i class="bx bx-caret-down carret-icon"></i></a></h6>

                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{route('detail_facture',$actif->num_facture)}}">

                                                        @if ($actif->reference_type_facture == "Facture")
                                                        <div style="background-color: green; border-radius: 10px; text-align: center;color: white">
                                                            {{$actif->reference_type_facture}}
                                                        </div>
                                                        @elseif($actif->reference_type_facture == "Avoir")
                                                        <div style="background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white">
                                                            {{$actif->reference_type_facture}}
                                                        </div>
                                                        @elseif($actif->reference_type_facture == "Acompte")
                                                        <div style="background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white">
                                                            {{$actif->reference_type_facture}}
                                                        </div>
                                                        @else
                                                        <div style="background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white">
                                                            {{$actif->reference_type_facture}}
                                                        </div>
                                                        @endif

                                                    </a>

                                                </td>
                                                <td>
                                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        {{$actif->num_facture}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        {{$actif->nom_etp}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        {{$actif->invoice_date}}
                                                    </a>
                                                </td>
                                                <td> <a href="{{route('detail_facture',$actif->num_facture)}}">

                                                        {{$actif->due_date}}
                                                    </a>
                                                </td>
                                                <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        <div align="right">
                                                            {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        <div align="right">
                                                            {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        @if($actif->dernier_montant_ouvert<=0) <div style="background-color: rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">
                                                            pay??
                                                        </div>

                                                        @elseif($actif->activiter==false)

                                                        @if ($actif->jour_restant >0)
                                                        <div style="background-color: rgb(233, 190, 142); border-radius: 10px; text-align: center;color:white">
                                                            non envoy??
                                                        </div>
                                                        @else
                                                        <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                                            en retard
                                                        </div>
                                                        @endif

                                                        @else
                                                        @if($actif->facture_encour =="valider")

                                                        @if ($actif->jour_restant >0)
                                                        <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                            envoy??
                                                        </div>
                                                        @else
                                                        <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                                            en retard
                                                        </div>
                                                        @endif

                                                        @elseif($actif->facture_encour =="en_cour")
                                                        @if ($actif->jour_restant >0)
                                                        <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                            partiellement pay??
                                                        </div>
                                                        @else
                                                        <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                                            en retard
                                                        </div>
                                                        @endif


                                                        @endif
                                                        @endif

                                                    </a>
                                                </td>
                                                <td>
                                                    @if($actif->activiter==0)
                                                    <div class="dropdown">
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li class="dropdown-item">
                                                                    <a href="{{route('edit_facture',$actif->num_facture)}}"> <button type="button" class="btn"><i class="fa fa-edit"></i> Modifier</button>
                                                                    </a>
                                                                </li>
                                                                <li class="dropdown-item">
                                                                    <form action="{{route('valid_facture')}}" method="POST">
                                                                        @csrf
                                                                        <input name="num_facture" type="hidden" value="{{$actif->num_facture}}">
                                                                        <button type="submit" class="btn "><i class='bx bx-file'></i> Valid??</button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_fature_{{$actif->num_facture}}"><span class="fa fa-trash"></span> Supprimer</button>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @else

                                                    @if($actif->facture_encour == "valider")
                                                    <div class="dropdown">
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn  btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <a href="#" class="dropdown-item">
                                                                    <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal{{ $actif->cfp_id }}_{{ $actif->num_facture }}">Faire un encaissement</button>
                                                                </a>
                                                                {{-- <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @elseif($actif->facture_encour =="en_cour")
                                                    <div class="dropdown">
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <a href="#" class="dropdown-item">
                                                                    <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal{{ $actif->cfp_id }}_{{ $actif->num_facture }}">Faire un encaissement</button>
                                                                </a>
                                                                {{-- <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a> --}}
                                                                <hr class="dropdown-divider">
                                                                <a class="dropdown-item {{ Route::currentRouteNamed('pdf+liste+encaissement',$actif->num_facture) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$actif->num_facture)}}">
                                                                    <button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="dropdown">
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}"><button type="button" class="btn "><i class="fa fa-download"></i> PDF Facture</button></a>
                                                                {{-- <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a> --}}
                                                                <hr class="dropdown-divider">
                                                                <a class="dropdown-item {{ Route::currentRouteNamed('pdf+liste+encaissement',$actif->num_facture) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$actif->num_facture)}}">
                                                                    <button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endif

                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="10" class="table inner table-hover m-0 p-0 collapse table-borderless" id="collapseprojet_{{$actif->num_facture}}" aria-labelledby="collapseprojet_{{$actif->num_facture}}">
                                                    @if($actif->facture_encour != "valider" && count($encaissement)>0)
                                                    <div class="centrer">
                                                    <div class="alert alert-light" role="alert">Vos Encaissements:</div>
                                                        <table  class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">N?? F#</th>
                                                                    <th scope="col">Montant facturer</th>
                                                                    <th scope="col">Paiement</th>
                                                                    <th scope="col">Montant ouvert</th>
                                                                    <th scope="col">Mode de paiement</th>
                                                                    <th scope="col">Date de paiement</th>
                                                                    <th scope="col">Memo/Notes</th>
                                                                    <th scope="col">Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($encaissement as $info)
                                                                @if ($actif->num_facture == $info->num_facture)
                                                                    <tr>
                                                                        <td> <a href="{{route('detail_facture',$info->num_facture)}}">
                                                                                {{ $info->num_facture }}</a>
                                                                        </td>
                                                                        <td>{{$devise->devise." ". number_format($info->montant_facture, 0, ',', ' ') }}</td>
                                                                        <td>{{$devise->devise." ". number_format($info->payement, 0, ',', ' ') }}</td>
                                                                        <td>{{$devise->devise." ". number_format($info->montant_ouvert, 0, ',', ' ') }}</td>
                                                                        <td>{{ $info->description }}</td>
                                                                        <td>{{ $info->date_encaissement }}</td>
                                                                        <td>{{ $info->libelle }}</td>
                                                                        <td class="td_encaiss"><div class="button_encaiss"><button class="btn btn_creer btn-block mb-2 encaiss_payement" data-id="{{ $info->id }}" id="{{ $info->id }}" data-bs-toggle="modal" data-bs-target="#modal" style="color:green"><i class="bx bxs-edit-alt bx-modifier"></i></button>&nbsp;
                                                                            <a href="{{ route('supprimer',[$info->id]) }}" onclick="return confirm('??tes-vous s??r de vouloir supprimer cet encaissement ?');"><button class=" btn btn_creer btn-block mb-2 supprimer" style="color: red; "><i class="bx bx-trash bx-supprimer"></i></button></a>
                                                                        </div></td>
                                                                    </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                                <td style="display: none"></td>
                                            </tr>

                                            <div id="modal{{ $actif->cfp_id }}_{{ $actif->num_facture }}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                                <div class="modal-dialog">
                                                    <div class="modal-content px-3 py-3">
                                                        <div class="modal-header">
                                                            <div class="modal-title text-md">
                                                                <h6>Encaisser la facture N??: <span class="text-mued" id="num_fact_encaissement">{{ $actif->num_facture }}</span></h6>
                                                                <h5>Reste ?? payer : <strong><label id="montant"></label> {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}</strong></h5>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('encaisser') }} " id="formPayement" method="POST" novalidate>
                                                                @csrf
                                                                <input autocomplete="off" type="text" value="{{$actif->num_facture}}" name="num_facture" class="form-control formPayement" required="required" hidden>
                                                        </div>
                                                        <div class="inputbox inputboxP mt-3  mx-1">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <span>Date de paiement<strong style="color:#ff0000;">*</strong></span>

                                                                </div>
                                                                <div class="col">
                                                                    <input type="date" name="date_encaissement" class="form-control formPayement" required="required" style="height: 50px;">
                                                                    <div class="invalid-feedback">
                                                                        votre Date de paiement
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="inputbox inputboxP mt-3   mx-1">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <span>Montant ?? facturer<strong style="color:#ff0000;">*</strong></span>

                                                                </div>
                                                                <div class="col">
                                                                    <input autocomplete="off" type="number" min="1" name="montant" class="form-control formPayement" required="required" style="height: 50px;">
                                                                    <div class="invalid-feedback">
                                                                        votre montant ?? encaisser
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="form-group  mt-3  mx-1">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>

                                                                </div>
                                                                <div class="col">
                                                                    <select class="form-select selectP" name="mode_payement" aria-label="Default select example" style="height: 50px;">
                                                                        @foreach ($mode_payement as $mp)
                                                                        <option value="{{ $mp->id }}">{{ $mp->description }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                votre mode de paiement
                                                            </div>
                                                        </div>

                                                        <div class="inputbox inputboxP mt-2  mx-1">
                                                            <span>Memo/Notes</span>
                                                            <textarea autocomplete="off" name="libelle" class="text_description form-control" placeholder="description" rows="5"></textarea>

                                                        </div>

                                                        <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
                                                        <div class="">
                                                            {{-- <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn_creer btnP px-3">Encaisser</button> </div> --}}
                                                            <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_annuler annuler" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x me-1"></i>Annuler</button></span> <button type="submit" class="btn btn_enregistrer btnP px-3"> <i class="bx bx-check me-1"></i> Encaisser</button> </div>

                                                        </div>

                                                        </form>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal fade" id="delete_fature_{{$actif->num_facture}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">
                                                            <h4 class="modal-title text-white">Avertissement !</h4>

                                                        </div>
                                                        <div class="modal-body">
                                                            <small>Vous <span style="color: red"> ??tes </span>sur le point d'enlever une facture qui est d??j?? cr??er, voulez vous continuer ?</small>
                                                        </div>

                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>
                                                            <a href="{{route('delete_facture',$actif->num_facture)}}"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="10" class="text-center">Aucun R??sultat</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                
                            </div>

                            @if (isset($pour_list))
                            @if ($pour_list == "INACTIF")
                            <div class="tab-pane fade show active" id="nav-brouilon" role="tabpanel" aria-labelledby="nav-brouilon-tab">
                                @else
                                <div class="tab-pane fade" id="nav-brouilon" role="tabpanel" aria-labelledby="nav-brouilon-tab">
                                    @endif
                                    @else
                                    <div class="tab-pane fade " id="nav-brouilon" role="tabpanel" aria-labelledby="nav-brouilon-tab">
                                        @endif

                                        {{------------------------------------------------------------------------------- pagination facture brouillon--}}

                                        <table class="table table-hover facture_table" id="myTable">
                                            <thead style="background: #c7c9c939; border-color: white">
                                                <tr>
                                                    <th>#</th>
                                                    <th >Type</th>
                                                    <th><a href="#" style="color: blue" value="0">F # &nbsp; <span class="num_has_arrow"></span> </a>
                                                    </th>
                                                    <th ><a class="nom_entiter_trie" value="0">Entreprise &nbsp; <span class="nom_has_arrow"></span> </a>
                                                    </th>
                                                    <th scope="col"><a class="dte_fact_trie" value="0">Date de facturation &nbsp; <span class="fact_has_arrow"></span></a>
                                                    </th>
                                                    <th ><a class="dte_reglement_trie" value="0">Date de r??glement &nbsp; <span class="dte_has_arrow"></span></a>
                                                    </th>
                                                    <th >
                                                        <a class="total_payer_trie" value="0"> Total ?? payer &nbsp; <span class="total_has_arrow"></span></a>
                                                    </th>
                                                    <th >
                                                        <a class=" rest_payer_trie" value="0"> Solde &nbsp; <span class="rest_has_arrow"></span></a>
                                                    </th>
                                                    <th >Statut</th>
                                                    @canany(['isCFP'])
                                                    <th >Action</th>
                                                    @endcanany
                                                </tr>
                                            </thead>
                                            <tbody id="list_data_trie_brouillon">
                                                @if (count($facture_inactif) > 0)
                                                @foreach ($facture_inactif as $actif)

                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">

                                                            @if ($actif->reference_type_facture == "Facture")
                                                            <div style="background-color: green; border-radius: 10px; text-align: center;color: white">
                                                                {{$actif->reference_type_facture}}
                                                            </div>
                                                            @elseif($actif->reference_type_facture == "Avoir")
                                                            <div style="background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white">
                                                                {{$actif->reference_type_facture}}
                                                            </div>
                                                            @elseif($actif->reference_type_facture == "Acompte")
                                                            <div style="background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white">
                                                                {{$actif->reference_type_facture}}
                                                            </div>
                                                            @else
                                                            <div style="background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white">
                                                                {{$actif->reference_type_facture}}
                                                            </div>
                                                            @endif

                                                        </a>

                                                    </td>
                                                    <td>
                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                            {{$actif->num_facture}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                            {{$actif->nom_etp}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                            {{$actif->invoice_date}}
                                                        </a>
                                                    </td>
                                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">

                                                            {{$actif->due_date}}
                                                        </a>
                                                    </td>
                                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                            <div align="right">
                                                                {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                            <div align="right">
                                                                {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                            @if ($actif->jour_restant >0)
                                                            <div style="background-color: rgb(233, 190, 142); border-radius: 10px; text-align: center;color:white">
                                                                nom envoy??
                                                            </div>
                                                            @else
                                                            <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                                                en retard
                                                            </div>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <div class="btn-group dropstart">
                                                                <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li class="dropdown-item">
                                                                        <a href="{{route('edit_facture',$actif->num_facture)}}"> <button type="button" class="btn"><i class="fa fa-edit"></i> Modifier</button>
                                                                        </a>
                                                                    </li>
                                                                    <li class="dropdown-item">
                                                                        <form action="{{route('valid_facture')}}" method="POST">
                                                                            @csrf
                                                                            <input name="num_facture" type="hidden" value="{{$actif->num_facture}}">
                                                                            <button type="submit" class="btn "><i class='bx bx-file'></i> Valider</button>
                                                                        </form>
                                                                    </li>
                                                                    <li>
                                                                        {{-- <a class="dropdown-item" href="{{route('delete_facture',$actif->num_facture)}}">
                                                                        <button type="submit" class="btn "><span class="fa fa-trash"></span> Supprimer</button>
                                                                        </a> --}}
                                                                        <a class="dropdown-item" href="#">
                                                                            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_fature_inactif_{{$actif->num_facture}}"><span class="fa fa-trash"></span> Supprimer</button>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="delete_fature_inactif_{{$actif->num_facture}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">
                                                                <h4 class="modal-title text-white">Avertissement !</h4>

                                                            </div>
                                                            <div class="modal-body">
                                                                <small>Vous <span style="color: red"> ??tes </span>sur le point d'enlever une facture qui est d??j?? cr??er, voulez vous continuer ?</small>
                                                            </div>

                                                            <div class="modal-footer justify-content-center">
                                                                <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>
                                                                <a href="{{route('delete_facture',$actif->num_facture)}}"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="10" class="text-center" >Aucun R??sultat</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- --}}


                                    @if (isset($pour_list))
                                    @if ($pour_list == "ACTIF")
                                    <div class="tab-pane fade show active" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                                        @else
                                        <div class="tab-pane fade" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                                            @endif
                                            @else
                                            <div class="tab-pane fade" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                                                @endif

                                                {{------------------------------------------------------------------------------- pagination facture activer--}}

                                                <table class="table table-hover facture_table" id="myTable1">
                                                    <thead style="background: #c7c9c939; border-color: white">
                                                        <tr>
                                                            <th>#</th>
                                                            <th >Type</th>
                                                            <th><a href="#" style="color: blue" value="0">F # &nbsp; <span class="num_has_arrow"></span> </a>
                                                            </th>
                                                            <th ><a class="nom_entiter_trie" value="0">Entreprise &nbsp; <span class="nom_has_arrow"></span> </a>
                                                            </th>
                                                            <th scope="col"><a class="dte_fact_trie" value="0">Date de facturation &nbsp; <span class="fact_has_arrow"></span></a>
                                                            </th>
                                                            <th ><a class="dte_reglement_trie" value="0">Date de r??glement &nbsp; <span class="dte_has_arrow"></span></a>
                                                            </th>
                                                            <th >
                                                                <a class="total_payer_trie" value="0"> Total ?? payer &nbsp; <span class="total_has_arrow"></span></a>
                                                            </th>
                                                            <th >
                                                                <a class=" rest_payer_trie" value="0"> Solde &nbsp; <span class="rest_has_arrow"></span></a>
                                                            </th>
                                                            <th >Statut</th>
                                                            @canany(['isCFP'])
                                                            <th >Action</th>
                                                            @endcanany
                                                        </tr>
                                                        
                                                    </thead>
                                                    <tbody id="list_data_trie_valider">
                                                        @if (count($facture_actif) > 0)
                                                        @foreach ($facture_actif as $actif)
                                                        <tr>
                                                            <td>
                                                                @if($actif->facture_encour =="en_cour")
                                                                    <h6><a href="#collapseprojet_actif_{{$actif->num_facture}}" class="mb-0 changer_carret d-flex pt-2" data-bs-toggle="collapse" role="button"><i class="bx bx-caret-down carret-icon"></i></a></h6>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('detail_facture',$actif->num_facture)}}">

                                                                    @if ($actif->reference_type_facture == "Facture")
                                                                    <div style="background-color: green; border-radius: 10px; text-align: center;color: white">
                                                                        {{$actif->reference_type_facture}}
                                                                    </div>
                                                                    @elseif($actif->reference_type_facture == "Avoir")
                                                                    <div style="background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white">
                                                                        {{$actif->reference_type_facture}}
                                                                    </div>
                                                                    @elseif($actif->reference_type_facture == "Acompte")
                                                                    <div style="background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white">
                                                                        {{$actif->reference_type_facture}}
                                                                    </div>
                                                                    @else
                                                                    <div style="background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white">
                                                                        {{$actif->reference_type_facture}}
                                                                    </div>
                                                                    @endif

                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                    {{$actif->num_facture}}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                    {{$actif->nom_etp}}
                                                                </a>
                                                            </td>
                                                            <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                    {{$actif->invoice_date}}
                                                                </a>
                                                            </td>
                                                            <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                    {{$actif->due_date}}
                                                                </a>
                                                            </td>
                                                            <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                    <div align="right">
                                                                        {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                    <div align="right">
                                                                        {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('detail_facture',$actif->num_facture)}}">

                                                                    @if ($actif->jour_restant >0)
                                                                    @if ($actif->facture_encour == "en_cour")
                                                                    <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                                        partiellement pay??
                                                                    </div>
                                                                    @else
                                                                    <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                                        envoy??
                                                                    </div>
                                                                    @endif

                                                                    @else
                                                                    <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                                                        en retard
                                                                    </div>
                                                                    @endif

                                                                </a>
                                                            </td>
                                                            @canany(['isCFP'])
                                                            <td>
                                                                @if ($actif->facture_encour == "valider")

                                                                <div class="dropdown">
                                                                    <div class="btn-group dropstart">
                                                                        <button type="button" class="btn  btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <a href="#" class="dropdown-item">
                                                                                <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal_valide_{{ $actif->cfp_id }}_{{ $actif->num_facture }}">Faire un encaissement</button>
                                                                            </a>
                                                                            {{-- <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a> --}}
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                @elseif ($actif->facture_encour == "en_cour")

                                                                <div class="dropdown">
                                                                    <div class="btn-group dropstart">
                                                                        <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <a href="#" class="dropdown-item">
                                                                                <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal_valide_{{ $actif->cfp_id }}_{{ $actif->num_facture }}">Faire un encaissement</button>
                                                                            </a>
                                                                            {{-- <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a> --}}
                                                                            <hr class="dropdown-divider">
                                                                            <a class="dropdown-item {{ Route::currentRouteNamed('pdf+liste+encaissement',$actif->num_facture) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$actif->num_facture)}}">
                                                                                <button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                @endif

                                                            </td>
                                                            @endcanany

                                                        </tr>
                                                        <tr>
                                                            <td colspan="10" class="table inner table-hover m-0 p-0 collapse table-borderless" id="collapseprojet_actif_{{$actif->num_facture}}" aria-labelledby="collapseprojet_{{$actif->num_facture}}">
                                                                @if($actif->facture_encour != "valider" && count($encaissement)>0)
                                                                <div class="centrer">
                                                                <div class="alert alert-light" role="alert">Vos Encaissements:</div>
                                                                    <table  class="table table-hover table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">N?? F#</th>
                                                                                <th scope="col">Montant facturer</th>
                                                                                <th scope="col">Paiement</th>
                                                                                <th scope="col">Montant ouvert</th>
                                                                                <th scope="col">Mode de paiement</th>
                                                                                <th scope="col">Date de paiement</th>
                                                                                <th scope="col">Memo/Notes</th>
                                                                                <th scope="col">Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($encaissement as $info)
                                                                            @if ($actif->num_facture == $info->num_facture)
                                                                                <tr>
                                                                                    <td> <a href="{{route('detail_facture',$info->num_facture)}}">
                                                                                            {{ $info->num_facture }}</a>
                                                                                    </td>
                                                                                    <td>{{$devise->devise." ". number_format($info->montant_facture, 0, ',', ' ') }}</td>
                                                                                    <td>{{$devise->devise." ". number_format($info->payement, 0, ',', ' ') }}</td>
                                                                                    <td>{{$devise->devise." ". number_format($info->montant_ouvert, 0, ',', ' ') }}</td>
                                                                                    <td>{{ $info->description }}</td>
                                                                                    <td>{{ $info->date_encaissement }}</td>
                                                                                    <td>{{ $info->libelle }}</td>
                                                                                    <td class="td_encaiss"><div class="button_encaiss"><button class="btn btn_creer btn-block mb-2 encaiss_payement" data-id="{{ $info->id }}" id="{{ $info->id }}" data-bs-toggle="modal" data-bs-target="#modal" style="color:green"><i class="bx bxs-edit-alt bx-modifier"></i></button>&nbsp;
                                                                                        <a href="{{ route('supprimer',[$info->id]) }}" onclick="return confirm('??tes-vous s??r de vouloir supprimer cet encaissement ?');"><button class="btn btn_creer btn-block mb-2 supprimer" style="color: red; "><i class="bx bx-trash bx-supprimer"></i></button></a>
                                                                                    </div></td>
                                                                                </tr>
                                                                            @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                @endif
                                                            </td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                        </tr>
                                                        <div id="modal_valide_{{ $actif->cfp_id }}_{{ $actif->num_facture }}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                                            <div class="modal-dialog">
                                                                <div class="modal-content px-3 py-3">
                                                                    <div class="modal-header">
                                                                        <div class="modal-title text-md">
                                                                            <h6>Encaisser la facture N??: <span class="text-mued" id="num_fact_encaissement">{{ $actif->num_facture }}</span></h6>
                                                                            <h5>Reste ?? payer : <strong><label id="montant"></label> {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}</strong></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('encaisser') }} " method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input autocomplete="off" type="text" value="{{$actif->num_facture}}" name="num_facture" class="form-control " required hidden>
                                                                    </div>
                                                                    <div class="inputbox inputboxP mt-3  mx-1">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <span>Date de paiement<strong style="color:#ff0000;">*</strong></span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input type="date" name="date_encaissement" class="form-control " required style="height: 50px;">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="inputbox inputboxP mt-3   mx-1">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <span>Montant ?? facturer<strong style="color:#ff0000;">*</strong></span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <input autocomplete="off" type="number" min="1" max="{{$actif->dernier_montant_ouvert}}" name="montant" class="form-control " required style="height: 50px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group  mt-3  mx-1">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>
                                                                            </div>
                                                                            <div class="col">
                                                                                <select class="form-select selectP" name="mode_payement" aria-label="Default select example" style="height: 50px;">
                                                                                    @foreach ($mode_payement as $mp)
                                                                                    <option value="{{ $mp->id }}">{{ $mp->description }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="inputbox inputboxP mt-2  mx-1">
                                                                        <span>Memo/Notes</span>
                                                                        <textarea autocomplete="off" name="libelle" class="text_description form-control" placeholder="description" rows="5"></textarea>
                                                                    </div>
                                                                    <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
                                                                    <div class="">
                                                                        <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class=" btn_annuler annuler" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x me-1"></i>Annuler</button></span> <button type="submit" class="btn btn_enregistrer btnP px-3"> <i class="bx bx-check me-1"></i> Encaisser</button> </div>
                                                                    </div>
                                                                    </form>

                                                                </div>

                                                            </div>
                                                        </div>
                                                        {{-- </div> --}}

                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="10" class="text-center">Aucun R??sultat</td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                            <td style="display: none"></td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- --}}

                                            @if (isset($pour_list))
                                            @if ($pour_list == "PAYER")
                                            <div class="tab-pane fade show active" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                                                @else
                                                <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                                                    @endif
                                                    @else
                                                    <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                                                        @endif

                                                        {{------------------------------------------------------------------------------- pagination facture payer--}}
                                                        <table class="table table-hover facture_table" id="myTable2">
                                                            <thead style="background: #c7c9c939; border-color: white">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th scope="col">Type</th>
                                                                    <th><a href="#" style="color: blue" value="0">F # &nbsp; <span class="num_has_arrow"></span> </a>
                                                                    </th>
                                                                    <th style="max-width: 12%"><a class="nom_entiter_trie" value="0">Entreprise &nbsp; <span class="nom_has_arrow"></span> </a>
                                                                    </th>
                                                                    <th scope="col"><a class="dte_fact_trie" value="0">Date de facturation &nbsp; <span class="fact_has_arrow"></span></a>
                                                                    </th>
                                                                    <th style="max-width: 12%"><a class="dte_reglement_trie" value="0">Date de r??glement &nbsp; <span class="dte_has_arrow"></span></a>
                                                                    </th>
                                                                    <th scope="col">
                                                                        <div align="right">
                                                                            <a class="total_payer_trie" value="0"> Total ?? payer &nbsp; <span class="total_has_arrow"></span></a>
                                                                        </div>
                                                                    </th>
                                                                    <th scope="col">
                                                                        <div align="right">
                                                                            <a class="rest_payer_trie" value="0"> Solde &nbsp; <span class="rest_has_arrow"></span></a>
                                                                        </div>
                                                                    </th>
                                                                    <th scope="col">Statut</th>
                                                                    @canany(['isCFP'])
                                                                    <th scope="col">Action</th>
                                                                    @endcanany
                                                                </tr>
                                                            </thead>
                                                            <tbody id="list_data_trie_payer">
                                                                @if (count($facture_payer) > 0)
                                                                @foreach ($facture_payer as $actif)
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <h6><a href="#collapseprojet_payer_{{$actif->num_facture}}" class="mb-0 changer_carret d-flex pt-2" data-bs-toggle="collapse" role="button"><i class="bx bx-caret-down carret-icon"></i></a></h6>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            @if ($actif->reference_type_facture == "Facture")
                                                                            <div style="background-color: green; border-radius: 10px; text-align: center;color: white">
                                                                                {{$actif->reference_type_facture}}
                                                                            </div>
                                                                            @elseif($actif->reference_type_facture == "Avoir")
                                                                            <div style="background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white">
                                                                                {{$actif->reference_type_facture}}
                                                                            </div>
                                                                            @elseif($actif->reference_type_facture == "Acompte")
                                                                            <div style="background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white">
                                                                                {{$actif->reference_type_facture}}
                                                                            </div>
                                                                            @else
                                                                            <div style="background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white">
                                                                                {{$actif->reference_type_facture}}
                                                                            </div>
                                                                            @endif
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            {{$actif->num_facture}}
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            {{$actif->nom_etp}}
                                                                        </a>
                                                                    </td>
                                                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            {{$actif->invoice_date}}
                                                                        </a>
                                                                    </td>
                                                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            {{$actif->due_date}}
                                                                        </a>
                                                                    </td>
                                                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            <div align="right">
                                                                                {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            <div align="right">
                                                                                {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                            <div style="background-color: rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">
                                                                                pay??
                                                                            </div>
                                                                        </a>
                                                                    </td>
                                                                    @canany(['isCFP'])
                                                                    <td>
                                                                        <div class="dropdown">
                                                                            <div class="btn-group dropstart">
                                                                                <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                                                </button>
                                                                                <ul class="dropdown-menu">
                                                                                    <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}"><button type="button" class="btn "><i class="fa fa-download"></i> PDF Facture</button></a>
                                                                                    {{-- <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a> --}}
                                                                                    <hr class="dropdown-divider">
                                                                                    <a class="dropdown-item {{ Route::currentRouteNamed('pdf+liste+encaissement',$actif->num_facture) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$actif->num_facture)}}">
                                                                                        <button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>

                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    @endcanany
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="10" class="table inner table-hover m-0 p-0 collapse table-borderless" id="collapseprojet_payer_{{$actif->num_facture}}" aria-labelledby="collapseprojet_{{$actif->num_facture}}">
                                                                        @if($actif->facture_encour != "valider" && count($encaissement)>0)
                                                                        <div class="centrer">
                                                                        <div class="alert alert-light" role="alert">Vos Encaissements:</div>

                                                                            <table  class="table table-hover table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">N?? F#</th>
                                                                                        <th scope="col">Montant facturer</th>
                                                                                        <th scope="col">Paiement</th>
                                                                                        <th scope="col">Montant ouvert</th>
                                                                                        <th scope="col">Mode de paiement</th>
                                                                                        <th scope="col">Date de paiement</th>
                                                                                        <th scope="col">Memo/Notes</th>
                                                                                        <th scope="col">Actions</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($encaissement as $info)
                                                                                    @if ($actif->num_facture == $info->num_facture)
                                                                                        <tr>
                                                                                            <td> <a href="{{route('detail_facture',$info->num_facture)}}">
                                                                                                    {{ $info->num_facture }}</a>
                                                                                            </td>
                                                                                            <td>{{$devise->devise." ". number_format($info->montant_facture, 0, ',', ' ') }}</td>
                                                                                            <td>{{$devise->devise." ". number_format($info->payement, 0, ',', ' ') }}</td>
                                                                                            <td>{{$devise->devise." ". number_format($info->montant_ouvert, 0, ',', ' ') }}</td>
                                                                                            <td>{{ $info->description }}</td>
                                                                                            <td>{{ $info->date_encaissement }}</td>
                                                                                            <td>{{ $info->libelle }}</td>
                                                                                            <td class="td_encaiss"><div class="button_encaiss"><button class=" btn btn_creer btn-block mb-2 encaiss_payement" data-id="{{ $info->id }}" id="{{ $info->id }}" data-bs-toggle="modal" data-bs-target="#modal" style="color:green"><i class="bx bxs-edit-alt bx-modifier"></i></button>&nbsp;
                                                                                                <a href="{{ route('supprimer',[$info->id]) }}" onclick="return confirm('??tes-vous s??r de vouloir supprimer cet encaissement ?');"><button class=" btn btn_creer btn-block mb-2 supprimer" style="color: red; "><i class="bx bx-trash bx-supprimer"></i></button></a>
                                                                                            </div></td>
                                                                                        </tr>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        @endif
                                                                    </td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td colspan="10" class="text-center">Aucun R??sultat</td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                    <td style="display: none"></td>
                                                                </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    {{-- --}}

                                                </div>


                                            </div>


                                            {{-- modal reussi --}}
                                            @if (Session::has('encaissement_ok'))
                                            <div id="myModal" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="form-card">
                                                                    <h2 class="fs-title text-center">{{ Session::get('encaissement_ok') }}</h2> <br><br>
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-3"> <img src="{{ asset('img/images/ok.png') }}" class="fit-image"> </div>
                                                                    </div> <br>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            {{-- fin --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            {{-- debut modal encaissement --}}
                            <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content  px-3 py-3">
                                        <div class="modal-header">
                                            <div class="modal-title text-md">
                                                <h5>Modification</h5>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('modifier_encaissement') }}" method="POST">
                                                @csrf
                                                <div id="modification"></div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- fin --}}
                    </div>
                </div>
            </div>
            {{-- inmportation fonction js pour cfp --}} 
    {{-- @include("admin.facture.function_js.js_cfp")  --}}
@endsection
            
@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                fixedHeader: true,
                "language": {
                    "paginate": {
                    "previous": "pr??c??dent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun r??sultat trouv??",
                    "infoEmpty":      " 0 trouv??s",
                    "info":           "Affichage de _START_ ?? _END_ sur _TOTAL_ entr??es",
                    "infoFiltered":   "(filtre sur _MAX_ entr??es)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });

            $('#myTable1').DataTable({
                fixedHeader: true,
                "language": {
                    "paginate": {
                    "previous": "pr??c??dent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun r??sultat trouv??",
                    "infoEmpty":      " 0 trouv??s",
                    "info":           "Affichage de _START_ ?? _END_ sur _TOTAL_ entr??es",
                    "infoFiltered":   "(filtre sur _MAX_ entr??es)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });

            $('#myTable2').DataTable({
                fixedHeader: true,
                "language": {
                    "paginate": {
                    "previous": "pr??c??dent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun r??sultat trouv??",
                    "infoEmpty":      " 0 trouv??s",
                    "info":           "Affichage de _START_ ?? _END_ sur _TOTAL_ entr??es",
                    "infoFiltered":   "(filtre sur _MAX_ entr??es)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });

            $('.myTable').DataTable({
                scrollY:        "500px",
                orderCellsTop: true,
                fixedHeader: true,
                // paging: false,
                "language": {
                    "paginate": {
                    "previous": "pr??c??dent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun r??sultat trouv??",
                    "infoEmpty":      " 0 trouv??s",
                    "info":           "Affichage de _START_ ?? _END_ sur _TOTAL_ entr??es",
                    "infoFiltered":   "(filtre sur _MAX_ entr??es)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });
        });
    </script>
@endsection

