

<style>
    /* .icon_plus {
        border: 2px solid whitesmoke;
        font-size: 0.5rem;
    } */
    #detail_panning{
        color:#637381;
    }
    #detail_panning input::placeholder{
        display:none;
    }
    #detail_panning .input:hover{
        cursor: pointer;
    }
    .input{
        height: 2.5rem !important;
        border-style: none;
        margin: 0;
        padding: 0;
    }

    .nouveau_detail {
        background-color: #822164;
        border-radius: 20px;
        color: #fff;
        padding: 0 8;
    }

    .nouveau_detail:hover {
        background-color: #b8368f;
        color: #fff;
    }

    .outline {
        outline: none;
        box-shadow: none;
    }

    .th_sans_donnee {
        font-weight: bold;
        text-align: center;
    }

    .form_control_time {
        height: .5rem;
    }

    input[type="text"],
    input[type="date"] {
        height: auto !important;
    }

    .intervention {
        background-color: rgb(241, 241, 242);
        padding: 2px 8px;
        border-radius: 1rem;
        text-align: center;
    }

    /* .icon_plus {
        color: #b8368f;
        margin-top: -1rem;
        font-size: 3rem;
        position: sticky;
        margin-left: 90%;
    }

    .icon_plus:hover {
        cursor: pointer;
    } */

    p {
        text-align: center !important;
    }

    .nouveau_detail {
        padding: 0 5px;
        margin: 0;
        color: #7635dc;
        border-radius: 10px;
        background-color: #7535dc2f;
        transition: all .5s ease;
    }

    .nouveau_detail:hover {
        color: #7635dc;
        border-radius: 10px;
        background-color: #63738141;
        transform: scale(1.1);
    }


    .btn_ajouter_detail {
        padding: .3rem 1rem;
        padding-bottom: .4rem;
        color: black;
        /* box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; */
    }

    .btn_ajouter_detail a {
        font-size: .8rem;
        position: relative;
        bottom: .4rem;
    }

    .btn_ajouter_detail:hover {
        background: #efefef;
        border-radius: 30px;
        color: rgb(0, 0, 0);
    }

    .icon_ajouter_detail {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .3rem;
        margin-right: .3rem;
    }

    .titre_detail_session {
        font-size: 1rem;
        padding-top: .8rem;
    }
</style>
@if (Session::has('detail_error'))
    <div class="alert alert-danger ms-2 me-2">
        <ul>
            <li>{!! Session::get('detail_error') !!}</li>
        </ul>
    </div>
@endif
<nav class="d-flex justify-content-between mb-1 ">
    <span class="titre_detail_session">
        @php
            $info = $groupe->infos_session($projet[0]->groupe_id);
            if ($info->difference == null && $info->nb_detail == 0) {
                echo $info->nb_detail . ' s??ance , dur??e totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m';
            } elseif ($info->difference != null && $info->nb_detail == 1) {
                echo $info->nb_detail . ' s??ance , dur??e totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m';
            } elseif ($info->difference != null && $info->nb_detail > 1) {
                echo $info->nb_detail . ' s??ances , dur??e totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m';
            }
        @endphp
    </span>
    @canany(['isCFP'])
        <a aria-current="page" data-bs-toggle="modal" data-bs-target="#modal_nouveau_detail">
            <button class="btn btn_nouveau"><i class='bx bx-plus-medical'></i>
                Ajouter une s??ance</button></a>
    @endcanany
</nav>
@if (count($datas) <= 0)
    @if ($type_formation_id == 1)
        <form onsubmit="change_active()" id="non_existante" action="{{ route('detail.store') }}" method="post">
    @endif
    @if ($type_formation_id == 2)
        <form onsubmit="change_active()" id="non_existante" action="{{ route('store_detailInter') }}" method="post">
    @endif
    @csrf
    <input type="hidden" name="projet" value="{{ $projet[0]->projet_id }}">
    <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">

    <table class="table table-bordered my-3" id="detail_panning">
        <thead>
            <tr>
                <th><i class="fa fa-calendar-day entete"></i>&nbsp;Date </th>
                <th><i class="fa fa-clock"></i>&nbsp;Heure d??but</th>
                <th><i class="fa fa-clock"></i>&nbsp;Heure fin </th>
                <th>
                    @if ($type_formation_id == 1)
                        <i class="fa fa-user"></i>&nbsp;Formateur
                    @endif
                    @if ($type_formation_id == 2)
                        <i class="fa fa-home"></i>&nbsp;Ville
                    @endif
                </th>
                <th><i class="fa fa-map-marker-alt"></i>&nbsp;Salle de formation</th>
                @canany(['isCFP'])
                <th>
                    @if ($type_formation_id == 1)
                        <button id="addRow" type="button"><i class="bx bx-plus-circle" style="font-size:1.6rem" style="color:#637381;"></i></button>
                    @endif
                    @if ($type_formation_id == 2)
                        <button id="addRow2" type="button"><i class="bx bx-plus-circle" style="font-size:1.6rem" style="color:#637381;"></i></button>
                    @endif
                </th>
                @endcanany
            </tr>
        </thead>
        @canany(['isCFP'])
        <tbody id="body_planning">
            <tr>
                <td>
                    <input type="date" min="{{ $projet[0]->date_debut }}" max="{{ $projet[0]->date_fin }}" style="color:#637381;" name="date[]" placeholder="" class="form-control input text-center" required>
                </td>
                <td>
                    <input type="time" name="debut[]" class="form-control input text-center" style="color:#637381;" required>
                </td>
                <td>
                    <input type="time" name="fin[]" class="form-control input text-center" style="color:#637381;" required>
                </td>
                <td>
                    @if ($type_formation_id == 1)
                        <select name="formateur[]" id="" class="form-control input" style="color:#637381;" required>
                        @foreach ($formateur as $format)
                            <option value="{{ $format->formateur_id }}">{{ $format->nom_formateur . ' ' . $format->prenom_formateur }}</option>
                        @endforeach
                        </select>
                    @elseif ($type_formation_id == 2)
                        <select name="ville[]" id="ville"  class="form-control input" required onblur="ville_Lieu();" style="color:#637381;">
                            <option value="Tananarive">Tananarive</option>
                            <option value="Tamatave">Tamatave</option>
                            <option value="Antsirab??">Antsirab??</option>
                            <option value="Fianarantsoa">Fianarantsoa</option>
                            <option value="Majunga">Majunga</option>
                            <option value="Tul??ar">Tul??ar</option>
                            <option value="Diego-Suarez">Diego-Suarez</option>
                            <option value="Antanifotsy">Antanifotsy</option>
                            <option value="Ambovombe">Ambovombe</option>
                            <option value="Amparafaravola">Amparafaravola</option>
                            <option value="T??lanaro">T??lanaro</option>
                            <option value="Ambatondrazaka">Ambatondrazaka</option>
                            <option value="Mananara Nord">Mananara Nord</option>
                            <option value="Soavinandriana">Soavinandriana</option>
                            <option value="Mahanoro">Mahanoro</option>
                            <option value="Soanierana Ivongo">Soanierana Ivongo</option>
                            <option value="Faratsiho">Faratsiho</option>
                            <option value="Nosy Varika">Nosy Varika</option>
                            <option value="Vavatenina">Vavatenina</option>
                            <option value="Morondava">Morondava</option>
                            <option value="Amboasary">Amboasary</option>
                            <option value="Manakara">Manakara</option>
                            <option value="Antalaha">Antalaha</option>
                            <option value="Ikongo">Ikongo</option>
                            <option value="Manjakandriana">Manjakandriana</option>
                            <option value="Sambava">Sambava</option>
                            <option value="Fandriana">Fandriana</option>
                            <option value="Marovoay">Marovoay</option>
                            <option value="Betioky">Betioky</option>
                            <option value="Ambanja">Ambanja</option>
                            <option value="Ambositra">Ambositra</option>
                        </select>
                    @endif
                </td>
                <td>
                    <select name="lieu[]" class="form-control salle_de_formation input" style="color:#637381;">
                        @foreach ($salle_formation as $salle)
                        <option value="{{ $salle->ville .',  '. $salle->salle_formation }}">{{ $salle->ville . ',' . $salle->salle_formation }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <button id="removeRow" type="button"><i class="bx bx-minus-circle" style="font-size: 1.6rem;"></i></button>
                    <input type="hidden" name="ville_lieu" id="ville_lieu">
                </td>
            </tr>

        </tbody>
        @endcanany

    </table>
    @canany(['isCFP'])
    <div class="enregistrer">
        <button type="submit" class="btn btn_enregistrer">Enregistrer</button>
    </div>
    <div class="modal" tabindex="-1" id="nouvelle_salle">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouvelle salle de formation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form action="#" method="POST"> --}}
                    <label for="salle_formation" class="form-label">Salle</label>
                    <input type="text" class="form-control" id="salle_formation">
                    <button type="button" id="enregistrer_salle" class="btn inserer_emargement p-1 mt-1"
                        data-bs-dismiss="modal">Enregistrer</button>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
    @endcanany
    </form>
@endif

<style>
    .titre_projet {
        background: rgba(235, 233, 233, 0.658);
        border-radius: 5px;
    }

    .titre_projet:hover {
        color: #7635dc;
        background-color: #6373811f;
    }

    .titre_projet .collapsed {
        color: #637381;
    }

    .titre_projet {
        color: #7635dc;
    }
</style>
@canany(['isReferent', 'isFormateur','isFormateurInterne'])
    @if (count($datas) <= 0)
        <div class="d-flex mt-3 titre_projet p-1 mb-1">
            <span class="text-center">Aucun detail de la session</span>
        </div>
    @endif
@endcanany


{{-- donnee non exiatante --}}

@if (count($datas) > 0)
    <div id="existante">
        <div class="row">
            @if (count($datas) != 0 && $projet[0]->status_groupe == 1)
                @can('isReferent')
                    <div class="col-md-12 m-1">
                        Confirmer la session "<Strong style="color: #822164">{{ $projet[0]->nom_groupe }}</Strong>" du
                        {{ $projet[0]->date_debut }} au {{ $projet[0]->date_fin }} et les details ci-dessous
                        <a href="{{ route('acceptation_session', [$projet[0]->groupe_id]) }}"><button type="button"
                                class="btn btn-success" data-dismiss="modal">Accepter</button></a>
                        {{-- <a href=""><button type="button" class="btn  btn-danger" data-dismiss="modal">Refuser</button></a> --}}
                    </div>
                @endcan
            @endif
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless" style="border: none"
                                id="dataTables-example">
                                <thead style="border-bottom: 1px solid black; line-height: 20px">
                                    <td>S??ance</td>
                                    @canany(['isReferent', 'isManager', 'isChefDeService'])
                                        <td>CFP</td>
                                    @endcanany
                                    <td>Module</td>
                                    <td>Ville</td>
                                    <td width="30%">Salle de formation</td>
                                    <td>Date</td>
                                    <td>D??but</td>
                                    <td>Fin</td>
                                    <td>Formateur</td>
                                    @canany(['isCFP'])
                                        <td>Action</td>
                                    @endcanany
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($datas as $d)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            @canany(['isReferent', 'isManager','isChefDeService'])
                                                <td>{{ $d->nom_cfp }}</td>
                                            @endcanany
                                            <td>{{ $d->nom_module }}</td>
                                            @php
                                                $salle = explode(',', $d->lieu);
                                            @endphp
                                            <td>{{ $salle[0] }}</td>
                                            <td>{{ $salle[1] }}</td>
                                            <td>{{ $d->date_detail }}</td>
                                            <td>{{ $d->h_debut }} h</td>
                                            <td>{{ $d->h_fin }} h</td>
                                            <td>
                                                @if ($d->photos == null)
                                                    <span class="m-0 p-2" height="50px" width="50px"
                                                        style="border-radius: 50%; background-color:#b8368f;">{{ $d->sans_photos }}</span>{{ $d->nom_formateur . ' ' . $d->prenom_formateur }}
                                                @else
                                                    <img src="{{ asset('images/formateurs/' . $d->photos) }}" alt=""
                                                        height="30px" width="30px" style="border-radius: 50%;">
                                                    {{ $d->nom_formateur . ' ' . $d->prenom_formateur }}
                                                @endif
                                            </td>
                                            @canany(['isCFP'])
                                                <td>
                                                    <a href="" aria-current="page" data-bs-toggle="modal"
                                                        data-bs-target="#modal_modifier_detail_{{ $d->detail_id }}"><i
                                                            class="bx bxs-edit-alt bx_modifier ms-2"></i></a>
                                                    {{-- <a href="{{ route('destroy_detail',[$d->detail_id]) }}"><i
                                                    class="fa fa-trash-alt ms-4" style="color:rgb(130,33,100);"></i></a> --}}
                                                    <button type="button" style="background: none" data-bs-toggle="modal"
                                                        data-bs-target="#delete_detail_{{ $d->detail_id }}"><i
                                                            class="bx bx-trash bx_supprimer ms-4"></i></button>
                                                </td>
                                            @endcanany
                                            {{-- @canany(['isFormateur'])
                                        <td><i data-toggle="collapse" href="#stagiaire_presence" class="fa fa-edit"
                                                style="color:rgb(130,33,100);">Emargement</i></td>
                                        @endcanany --}}
                                            {{-- <td>
                                            <a href="{{route('execution',[$d->detail_id])}}" class="btn btn-info"
                                                id="{{$d->detail_id}}"><span
                                                    class="glyphicon glyphicon-eye-open"></span></a>
                                        </td>
                                        <td><button class="btn btn-success modifier" id="{{$d->detail_id}}"
                                                data-toggle="modal" data-target="#myModal"><span
                                                    class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
                                        <td><button class="btn btn-danger supprimer" id="{{$d->detail_id}}"><span
                                                    class="glyphicon glyphicon-remove"></span> Supprimer</button></td> --}}
                                            @canany(['isCFP'])
                                                <div class="modal fade" id="delete_detail_{{ $d->detail_id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header  d-flex justify-content-center"
                                                                style="background-color:rgb(224,182,187);">
                                                                <h6 class="modal-title">Avertissement !</h6>
                                                            </div>
                                                            <div class="modal-body">
                                                                <small>Vous ??tes sur le point d'effacer une donn??e, cette
                                                                    action est irr??versible. Continuer ?</small>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"> Non </button>
                                                                <button type="button" class="btn btn-secondary"><a
                                                                        href="{{ route('destroy_detail', [$d->detail_id]) }}">Oui</a></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade"
                                                    id="modal_modifier_detail_{{ $d->detail_id }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content p-3">
                                                            <div class="modal-title pt-3"
                                                                style="height: 50px; align-items: center;">
                                                                <h5 class="text-center my-auto">Modifier detail</h5>
                                                            </div>
                                                            <form class="btn-submit"
                                                                action="{{ route('update_detail', [$d->detail_id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="detail"
                                                                    value="{{ $d->detail_id }}">
                                                                <div class="row">
                                                                    <div class="form-group mx-auto col-md-12">
                                                                        <label for="formateur">Formateur</label><br>
                                                                        <select class="form-control" id="formateur"
                                                                            name="formateur">
                                                                            <option value="{{ $d->formateur_id }}">
                                                                                {{ $d->nom_formateur . ' ' . $d->prenom_formateur }}
                                                                            </option>
                                                                            @foreach ($formateur as $format)
                                                                                <option
                                                                                    value="{{ $format->formateur_id }}">
                                                                                    {{ $format->nom_formateur }}
                                                                                    {{ $format->prenom_formateur }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <p><strong style="color: red"
                                                                                id="err_formateur"></strong>
                                                                        </p>
                                                                    </div>
                                                                    <div class="form-group mx-auto col-md-12">
                                                                        <label for="lieu">Salle de formation</label>
                                                                        <input type="text" class="form-control" id="lieu"
                                                                            name="lieu" placeholder="Lieu"
                                                                            value="{{ $d->lieu }}">

                                                                    </div>
                                                                    <div class="form-group mx-auto col-md-12">
                                                                        <label for="date">Date</label>
                                                                        <input type="date" class="form-control"
                                                                            id="date_detail" name="date"
                                                                            min="{{ $projet[0]->date_debut }}"
                                                                            max="{{ $projet[0]->date_fin }}"
                                                                            value="{{ $d->date_detail }}">
                                                                    </div>
                                                                    <div class="form-group mx-auto col-md-12">
                                                                        <label for="debut">Heure d??but</label>
                                                                        <input type="time" class="form-control" id="debut"
                                                                            name="debut" min="07:00" max="17:00"
                                                                            value="{{ $d->h_debut }}">
                                                                    </div>
                                                                    <div class="form-group mx-auto col-md-12">
                                                                        <label for="fin">Heure fin</label>
                                                                        <input type="time" class="form-control" id="fin"
                                                                            name="fin" min="08:00" max="18:08"
                                                                            value="{{ $d->h_fin }}">
                                                                    </div>
                                                                    <div
                                                                        class="d-flex justify-content-around mt-3 col-md-12">
                                                                        <button class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <input type="submit" id="ajouter"
                                                                            style="background-color: #822164"
                                                                            class="btn btn-primary" value="Modifier">
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcanany
                                        </tr>
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        </tbody>
                        </table>
                        @canany(['isCFP'])
                            <div class="modal fade" id="modal_nouveau_detail">
                                <div class="modal-dialog">
                                    <div class="modal-content p-3">
                                        <div class="modal-title pt-3" style="height: 50px; align-items: center;">
                                            <h5 class="text-center my-auto">Nouvelle s??ance</h5>
                                        </div>
                                        <form class="btn-submit" action="{{ route('detail.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="projet" value="{{ $projet[0]->projet_id }}">
                                            <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
                                            <div class="form-group mx-auto">
                                                <label for="formateur">Formateur</label><br>
                                                <select class="form-control" id="formateur" name="formateur[]">
                                                    <option type="hidden">Choissisez un formateur ...</option>
                                                    @foreach ($formateur as $format)
                                                        <option value="{{ $format->formateur_id }}">
                                                            {{ $format->nom_formateur }}
                                                            {{ $format->prenom_formateur }}</option>
                                                    @endforeach
                                                </select>
                                                <p><strong style="color: red" id="err_formateur"></strong></p>
                                            </div>
                                            <div class="form-group mx-auto">
                                                <label for="lieu">Salle de formation</label>
                                                <select name="lieu[]" style="height: 2.361rem"
                                                    class="form-control  my-1 salle_de_formation">
                                                    <option selected hidden>Choississez votre salle de formation&hellip;</option>
                                                    @foreach ($salle_formation as $salle)
                                                        <option
                                                            value="{{ $salle->ville . ',  ' . $salle->salle_formation }}">
                                                            {{ $salle->ville . ', ' . $salle->salle_formation }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group mx-auto">
                                                <label for="date">Date</label>
                                                <input type="date" class="form-control" id="date_detail" name="date[]"
                                                    min="{{ $projet[0]->date_debut }}"
                                                    max="{{ $projet[0]->date_fin }}">
                                            </div>
                                            <div class="form-group mx-auto">
                                                <label for="debut">Heure d??but</label>
                                                <input type="time" class="form-control" id="debut" name="debut[]"
                                                    min="07:00" max="17:00">
                                            </div>
                                            <div class="form-group mx-auto">
                                                <label for="fin">Heure fin</label>
                                                <input type="time" class="form-control" id="fin" name="fin[]" min="08:00"
                                                    max="18:08">
                                            </div>
                                            <div class="d-flex justify-content-center mt-2 mb-3 ">
                                                <input type="submit" id="ajouter" class="btn inserer_emargement p-2"
                                                    value="Ajouter">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endcanany

                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Modification</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="btn-submit">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nom">Projet</label>
                                                <input type="text" class="form-control" id="projetModif"
                                                    placeholder="Projet">
                                            </div>
                                            <div class="form-group">
                                                <label for="groupe">Groupe</label>
                                                <input type="text" class="form-control" id="groupeModif"
                                                    placeholder="Groupe">
                                            </div>
                                            <div class="form-group">
                                                <label for="lieu">Salle de formation</label>
                                                <input type="text" class="form-control" id="lieuModif"
                                                    placeholder="Lieu">
                                            </div>
                                            <div class="form-group">
                                                <label for="debut">Date d??but</label>
                                                <input type="date" class="form-control" id="debutModif" name="debut">
                                            </div>
                                            <div class="form-group">
                                                <label for="fin">Date fin</label>
                                                <input type="date" class="form-control" id="finModif" name="fin">
                                            </div>
                                            <button class="btn btn-success modification " id="action1"><span
                                                    class="glyphicon glyphicon-pencil"></span> Modifier</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $(document).ready(function() {
        $('#body_planning').DataTable( {
            keys: true
        });
    } );
    $('select[name^=ville]').change(function() {
        if ($(this).val() == 'ajout') {
            $('#nouvelle_salle').modal('show');
        }
    });

    $("#enregistrer_salle").on('click', function(e) {
        var salle = $('#salle_formation').val();
        $.ajax({
            type: "GET",
            url: "{{ route('ajouter_salle_of') }}",
            data: {
                salle: salle
            },
            success: function(response) {
                var data = JSON.parse(JSON.stringify(response));
                if (data['status'] == '200') {
                    var salle = data['salles'];
                    var html = '';
                    for (var i = 0; i < salle.length; i++) {
                        html += '<option value="' + salle[i].salle_formation + '">' + salle[i]
                            .salle_formation + '</option>'
                    }
                    html +=
                        '<option class="ajout_salle" value="ajout">Ajouter une autre salle</option>';
                    $('.salle_de_formation').html(html);
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
</script>
<script>
    $("#non_existante").on('submit', function() {
        document.getElementById('#non_existante').onsubmit = function() {
            document.querySelector('#non_existante').style.display = "none";
            document.querySelector('#existante').style.display = "block";
        }
    });

    function change_active() {
        document.querySelector('#non_existante').style.display = "none";
        document.querySelector('#existante').style.display = "block";
    };
    // document.getElementById('#non_existante').onsubmit = function (){
    //      document.querySelector('#non_existante').style.display = "none";
    //     document.querySelector('#existante').style.display = "block";
    // }
    // function change_active(){
    //     document.querySelector('#non_existante').style.display = "none";
    //     document.querySelector('#existante').style.display = "block";
    // }


    var id_detail;
    $(".modifier").on('click', function(e) {
        var id = e.target.id;

        $.ajax({
            type: "GET",
            url: "{{ route('edit_detail') }}",
            data: {
                Id: id
            },
            dataType: "html",
            success: function(response) {
                var userData = JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#projetModif").val(userData[$i].projet.nom_projet);
                    $("#groupeModif").val(userData[$i].projet.groupe_projet);
                    $("#lieuModif").val(userData[$i].lieu);
                    $("#debutModif").val(userData[$i].date_debut);
                    $("#finModif").val(userData[$i].date_fin);
                    id_detail = userData[$i].id;
                }
                $('#action1').val('Modifier');
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
    $(".supprimer").on('click', function(e) {
        var id = e.target.id;
        $.ajax({
            type: "GET",
            url: "{{ route('destroy_detail') }}",
            data: {
                Id: id
            },
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
    $("#action1").click(function(e) {
        var lieu = $("#lieu").val();
        var date_debut = $('#debut').val();
        var date_fin = $('#fin').val();
        var url = 'update_detail/' + id_detail;
        $.ajax({
            url: url,
            method: 'get',
            data: {

                Lieu: lieu,
                Debut: date_debut,
                Fin: date_fin,

            },
            success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            },
            error: function(error) {
                console.log(error)
            }
        });
    });

    $(document).on('click', '#addRow2', function() {
        $('#frais').empty();
        $.ajax({
            url: "{{ route('all_formateurs') }}",
            type: 'get',
            success: function(response) {
                var userData = response['formateur'];
                var salles = response['salles'];
                var html = '';
                html += '<tr>';

                html += '<td>';
                html += '<input type="date" min="{{ $projet[0]->date_debut }}" style="color:#637381;" max="{{ $projet[0]->date_fin }}" name="date[]" placeholder="" class="form-control input text-center" required>';
                html += '</td><td>';
                html +='<input type="time" name="debut[]" class="form-control input text-center" style="color:#637381;" required>';
                html += '</td><td>';
                html += '<input type="time" name="fin[]" class="form-control input text-center" style="color:#637381;" required>';
                html += '</td><td>';
                html +='<select name="ville[]" id=""  class="form-control input" style="color:#637381;" required>';
                html += '<option value="Tananarive">Tananarive</option>';
                html += '<option value="Tamatave">Tamatave</option>';
                html += '<option value="Antsirab??">Antsirab??</option>';
                html += '<option value="Fianarantsoa">Fianarantsoa</option>';
                html += '<option value="Majunga">Majunga</option>';
                html += '<option value="Tul??ar">Tul??ar</option>';
                html += '<option value="Diego-Suarez">Diego-Suarez</option>';
                html += '<option value="Antanifotsy">Antanifotsy</option>';
                html += '<option value="Ambovombe">Ambovombe</option>';
                html += '<option value="Amparafaravola">Amparafaravola</option>';
                html += '<option value="T??lanaro">T??lanaro</option>';
                html += '<option value="Ambatondrazaka">Ambatondrazaka</option>';
                html += '<option value="Mananara Nord">Mananara Nord</option>';
                html += '<option value="Soavinandriana">Soavinandriana</option>';
                html += '<option value="Mahanoro">Mahanoro</option>';
                html += '<option value="Soanierana Ivongo">Soanierana Ivongo</option>';
                html += '<option value="Faratsiho">Faratsiho</option>';
                html += '<option value="Nosy Varika">Nosy Varika</option>';
                html += '<option value="Vavatenina">Vavatenina</option>';
                html += '<option value="Morondava">Morondava</option>';
                html += '<option value="Amboasary">Amboasary</option>';
                html += '<option value="Manakara">Manakara</option>';
                html += '<option value="Antalaha">Antalaha</option>';
                html += '<option value="Ikongo">Ikongo</option>';
                html += '<option value="Manjakandriana">Manjakandriana</option>';
                html += '<option value="Sambava">Sambava</option>';
                html += '<option value="Fandriana">Fandriana</option>';
                html += '<option value="Marovoay">Marovoay</option>';
                html += '<option value="Betioky">Betioky</option>';
                html += '<option value="Ambanja">Ambanja</option>';
                html += '<option value="Ambositra">Ambositra</option>';
                html += '</select>';
                html += '</td><td>';
                html += '<select  name="lieu[]" class="form-control input" style="color:#637381;" required>';
                for (var $i = 0; $i < salles.length; $i++) {
                    html += '<option value="' + salles[$i].ville + ','+salles[$i].salle_formation+'">'+ salles[$i].ville + ','+salles[$i].salle_formation+ '</option>';
                }
                html += '</select>';
                html += '</td><td>';
                html +='<button id="removeRow" type="button"><i class="bx bx-minus-circle"></i></button> ';
                html += '<input type="hidden" name="ville_lieu" id="ville_lieu">';
                html += '</td>';
                html += '</tr>';

                $('#body_planning').append(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });



    $(document).on('click', '#removeRow', function() {
        $(this).closest('tr').remove();
    });

    $(document).on('click', '#addRow', function() {
        $('#frais').empty();
        $.ajax({
            url: "{{ route('all_formateurs') }}",
            type: 'get',
            success: function(response) {
                var userData = response['formateur'];
                var salles = response['salles'];
                // var formateur = data;
                // console.log(data);
                var html = '';
                html += '<tr>';
                html += '<td>';
                html += '<input type="date" min="{{ $projet[0]->date_debut }}" style="color:#637381;" max="{{ $projet[0]->date_fin }}" name="date[]" placeholder="" class="form-control input text-center" required>';
                html += '</td><td>';
                html +='<input type="time" name="debut[]" class="form-control input text-center" style="color:#637381;" required>';
                html += '</td><td>';
                html += '<input type="time" name="fin[]" class="form-control input text-center" style="color:#637381;" required>';
                html += '</td><td>';
                html +=
                    '<select name="formateur[]" id=""  class="form-control input" style="color:#637381;" required>';
                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].formateur_id + '">'+ userData[$i]
                        .nom_formateur+' '+ userData[$i]
                        .prenom_formateur + '</option>';
                }
                html += '</select>';
                html += '</td><td>';
                html += '<select name="lieu[]" id="" class="form-control input" style="color:#637381;" required>';
                for (var $i = 0; $i < salles.length; $i++) {
                    html += '<option value="' + salles[$i].ville + ','+salles[$i].salle_formation+'">'+ salles[$i].ville + ','+salles[$i].salle_formation+ '</option>';
                }
                html += '</select>';
                html += '</td><td>';
                html +='<button id="removeRow" type="button"><i class="bx bx-minus-circle" style="font-size: 1.6rem;"></i></button> ';
                html += '<input type="hidden" name="ville_lieu" id="ville_lieu">';
                html += '</td></tr>';
                $('#body_planning').append(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>