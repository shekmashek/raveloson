@extends('./layouts/admin')
@section('content')

<style>
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

</style>


<div class="container-fluid">
    <div class="row">
        <h3> <strong>Liste Facture</strong></h3>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">
                        <i class="fa fa-list">Liste des Factures</i></a>
                </li>
                @canany(['isSuperAdmin','isCFP'])
                <li class="nav-item">
                    <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                        <i class="fa fa-plus">Nouveau Facture</i></a>
                </li>
                @endcanany
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">

            <li class="nav-item me-5">
                <a href="#" class="" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="false">
                    Facture Validé
                    @if (count($facture_actif) > 0)
                    <strong style="color: red">({{count($facture_actif)}})</strong>
                    @endif
                </a>
            </li>
            <li class="nav-item me-5">
                <a href="#" class="" id="nav-encour-tab" data-bs-toggle="tab" data-bs-target="#nav-encour" type="button" role="tab" aria-controls="nav-encour" aria-selected="false">
                    Facture En Cour
                    @if (count($facture_encour) > 0)
                    <strong style="color: red">({{count($facture_encour)}})</strong>
                    @endif
                </a>
            </li>
            <li class="nav-item me-5">
                <a href="#" class="" id="nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                    Facture Payer
                    @if (count($facture_payer) > 0)
                    <strong style="color: red">({{count($facture_payer)}})</strong>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a style="color: #9C27B0" href="#" class=" " id="nav-invitation-tab" data-bs-toggle="tab" data-bs-target="#nav-invitation" type="button" role="tab" aria-controls="nav-invitation" aria-selected="false">
                    Recherce par intervale de date
                </a>
            </li>
            <li class="nav-item ms-5">
                <a style="color: #9C27B0" href="#" class="" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                    Recherche par numero
                </a>
            </li>

        </ul>
    </div>
</nav>


<div class="tab-content" id="nav-tabContent">

    <div class="tab-pane fade" id="nav-invitation" role="tabpanel" aria-labelledby="nav-invitation-tab">

        <div class="container-fluid">
            <div class="row">
                <div class="col"></div>
                <div class="col-8">
                    <h5>Recherche par Date de Création Date</h5>
                    <form class="d-flex mt-3" method="POST" action="{{route('search_par_date')}}">
                        @csrf
                        <div class="form-group">
                            <input name="invoice_dte_fact" id="fact_dte" class="form-control input_inscription me-2" type="date" aria-label="Search">
                            <label for="fact_dte" class="form-control-placeholder">début<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="form-group">
                            <input name="due_dte_fact" id="fact_dte2" class="form-control input_inscription me-2" type="date" aria-label="Search">
                            <label for="fact_dte2" class="form-control-placeholder">fin<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control input_inscription mt-1" style="background: #9C27B0; color:white" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherce" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

        <div class="container-fluid">
            <div class="row">
                <div class="col"></div>
                <div class="col-4">
                    <h5>Recherche par Numero Facture</h5>
                    <form class="d-flex mt-3" method="POST" action="{{route('search_par_num_fact')}}">
                        @csrf
                        <div class="form-group">
                            <input name="num_fact" id="num_fact" required class="form-control input_inscription me-2" type="text" aria-label="Search">
                            <label for="num_fact" class="form-control-placeholder">Numéro de facture<strong style="color:#ff0000;">*</strong></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control input_inscription mt-1" style="background: #9C27B0; color:white" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherce" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>



    <div class="tab-pane fade" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5>Facture Validé</h5>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numéro de facture</th>
                                <th scope="col">Description</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Date Totale</th>
                                <th scope="col">Activité</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($facture_actif) > 0)
                            @foreach ($facture_actif as $actif)
                            <tr>
                                <td class="text-center" style="color:green;">O</td>
                                <th>
                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                        <strong> <i class="fa fa-barcode"></i> {{$actif->num_facture}} </strong>
                                    </a>
                                </th>
                                <td>{{$actif->other_message}}</td>
                                <td>{{$actif->invoice_date}}</td>
                                <td>{{$actif->due_date}}</td>
                                <td>{{$actif->totale_jour.' jour(s)'}}</td>
                                @if ($actif->jour_restant<0) <td style="color:red;">temps de payement a éxpirer!</td>
                                    @else
                                    <td style="color:rgb(221, 23, 178);">{{$actif->jour_restant.' jour(s)'}}</td>
                                    @endif
                                    @if ($actif->facture_encour == "valider")
                                    <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>

                                    @elseif ($actif->facture_encour == "en_cour")
                                    <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                                    @canany(['isCFP'])
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                <hr class="dropdown-divider">
                                                <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                            </div>
                                        </div>
                                    </td>
                                    @endcanany
                                    @else
                                    <td style="color:rgb(15, 221, 67);"><i class="fa fa-check-circle"></i><i class="fa fa-check-circle"></i> {{$actif->facture_encour}}</td>

                                    @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center" style="color:red;">Aucun Résultat</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="tab-pane fade" id="nav-encour" role="tabpanel" aria-labelledby="nav-encour-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h4>Facture En Cour</h4>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numéro de facture</th>
                                <th scope="col">Description</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Date Totale</th>
                                <th scope="col">Activité</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($facture_encour) > 0)
                            @foreach ($facture_encour as $actif)
                            <tr>
                                <td class="text-center" style="color:green;">O</td>
                                <th>
                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                        <i class="fa fa-barcode"></i>
                                        {{$actif->num_facture}}
                                    </a>
                                </th>
                                <td>{{$actif->other_message}}</td>
                                <td>{{$actif->invoice_date}}</td>
                                <td>{{$actif->due_date}}</td>
                                <td>{{$actif->totale_jour.' jour(s)'}}</td>
                                @if ($actif->facture_encour == "valider")
                                <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>
                                <td>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item btn btn-default btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                            <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class=" btn btn-default btn-block mb-2"><i class="fa fa-eye"></i>Liste des encaissements</button></a>

                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @if ($actif->facture_encour == "en_cour")
                                <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>

                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center" style="color:red;">Aucun Résultat</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h4>Facture Payer</h4>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numéro de facture</th>
                                <th scope="col">Description</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Date Totale</th>
                                <th scope="col">Activité</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($facture_payer) > 0)
                            @foreach ($facture_payer as $actif)
                            <tr>
                                <td class="text-center" style="color:green;">O</td>
                                <th>
                                    <a href="{{route('detail_facture',$actif->num_facture)}}">
                                        <i class="fa fa-barcode"></i>
                                        {{$actif->num_facture}}
                                    </a>
                                </th>
                                <td>{{$actif->other_message}}</td>
                                <td>{{$actif->invoice_date}}</td>
                                <td>{{$actif->due_date}}</td>
                                <td>{{$actif->totale_jour.' jour(s)'}}</td>
                                @if ($actif->facture_encour == "valider")
                                <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>

                                @elseif ($actif->facture_encour == "en_cour")
                                <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                                @canany(['isCFP'])]
                                <td>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item btn btn-default btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                            <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class=" btn btn-default btn-block mb-2"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                        </div>
                                    </div>
                                </td>
                                @endcanany
                                @else
                                <td style="color:rgb(15, 221, 67);"><i class="fa fa-check-circle"></i><i class="fa fa-check-circle"></i> {{$actif->facture_encour}}</td>

                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center" style="color:red;">Aucun Résultat</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col justify-content center" align="center">
                <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group me-2" role="group" aria-label="First group">
                        @if ($data["pagination"] != null &&  $data["pagination"]->totale_pagination>0)
                        @for ($i=1;$i<=$data["pagination"]->totale_pagination;$i+=1)
                        <a href="{{$data['totale']}}" class="nav-item"> <button type="button" class="btn btn-secondary">{{$i}}</button></a>
                        @endfor
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


</div>








@endsection
