@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Liste des équipes administratives</h3>
@endsection
@inject('groupe', 'App\groupe')
@section('content')
<style>
    .td_hover:hover{
        background: #f0f0f0;

    }

    #aze:hover{
        background-color: #f0f0f0;
        border-color:#f0f0f0
    }

    @keyframes action{
        0%{
            filter: brightness(1);
        }
        25%{
            filter: brightness(2.4);
        }
        50%{
            filter: brightness(2);
        }
        75%{
            filter: brightness(1.5);
        }
        100%{
            filter: brightness(1.2);
        }
    }

    .animation_alert{
        animation-name: action;
        animation-duration: 3s;
        animation-delay: 1s;
        animation-iteration-count: infinite;
    }

    .warning{
    color: #f64f59;
    font-size: 4rem;
    }
        #in2{
            cursor:default;
        }

        .main{
            cursor: pointer;
        }

        .navigation_module .nav-link {
        color: #637381;
        padding: 5px;
        cursor: pointer;
        font-size: 0.900rem;
        transition: all 200ms;
        margin-right: 1rem;
        text-transform: uppercase;
        padding-top: 10px;
        border: none;
    }

    .nav-item .nav-link.active {
        border-bottom: 3px solid #7635dc !important;
        border: none;
        color: #7635dc;
    }

    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: scale(1.1);
        border: none;
    }
    .nav-tabs .nav-item a{
        text-decoration: none;
        text-decoration-line: none;
    }


    #tabDynamique{
        background-color: #70d061;
        border-radius: 3px;
    }

    #tabDynamique:hover{
        background-color: #4db53e;
        border-radius: 3px;
    }

    #text{
        color: white;
    }

    #text:hover{
        color: rgb(255, 255, 255);
    }

    th{
        font-weight: 300;
        font-size: 14px
    }

    .form-check-input:disabled{
        opacity: 1 !important;
    }

    .form-switch .form-check-input:not(checked){
        border-color: #939393;
        color: #0d6efd
    }

    #modifTable_filter label, #modifTable_length label, #modifTable_length select, .pagination, .headEtp, .dataTables_info, .dataTables_length, .headProject {
        font-size: 13px;
    }

    .redClass{
        color: #f44336 !important;
    }

    .arrowDrop{
        color: #1e9600;
        transition: 0.3s !important;
        transform: rotate(360deg) !important;
    }
    .mivadika{
        transform: rotate(180deg) !important;
        color: red !important;
        transition: 0.3s !important;
    }

    #example_length select{
        height: 25px;
        font-size: 13px;
        vertical-align: middle;
    }

</style>

<div class="container-fluid pb-1">
    <div class="container mt-3 p-1 mb-1">
        <div id="popup">
            <div class="row">
                <div class="col text-center">
                    <i class='bx bxs-up-arrow-circle icon_upgrade me-3'></i>
                    @if($abonnement_cfp != null)
                        @if(count($cfp) <= $abonnement_cfp[0]->nb_utilisateur)
                            <span>Votre abonnement actuel vous permet d'inviter @if($abonnement_cfp[0]->illimite == 1) un nombre illimité d'@else {{$abonnement_cfp[0]->nb_utilisateur}} @endif utilisateurs. Si vous voullez plus d'utilisateurs veuillez <a href="{{route('ListeAbonnement')}}" class="text-primary lien_condition">upgrader votre abonnement</a></span>
                        @elseif($abonnement_cfp[0]->illimite == 1)
                            <span>Votre abonnement actuel vous permet d'inviter un nombre illimités d'utilisateurs.</span>
                        @endif
                    @else
                        <span>Actuellement vous n'avez aucun abonnement. Si vous voullez plus de formateurs veuillez <a href="{{route('ListeAbonnement')}}" class="text-primary lien_condition">upgrader votre abonnement</a></span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($resp_connecte->activiter == 1)
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item ">
                <a href="#vosReferent" class="nav-link active mt-2" data-bs-toggle="tab">Vos réferents&nbsp;&nbsp;&nbsp;</a>
            </li>
        @if($resp_connecte->prioriter == 1)
            <li class="nav-item" id="">
                <a href="{{route('liste+responsable+cfp')}}" class="btn_nouveau btn my-1" role="button"><i class="bx bx-plus-medical me-1"></i>nouveau referent</a>
            </li>
        @endif

        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="vosReferent">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="mt-4 table  table-borderless table-lg" id="modifTable">
                                <thead class="thead_projet" style="border-bottom: 1px solid black; background: #c7c9c939">
                                    <tr>
                                        <th></th>
                                        <th class="headEtp">Nom</th>
                                        <th class="headEtp">E-mail</th>
                                        <th class="headEtp">Téléphone</th>
                                        <th class="headEtp">Fonction</th>
                                        <th class="text-center headEtp">Réferent principale</th>
                                        <th class="text-center headEtp">Activer</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="data_collaboration" style="font-size: 11.5px;">
                                    @foreach($cfp as $responsables_cfp)
                                        <tr class="information">
                                            @if($responsables_cfp->photos_resp_cfp == NULL or $responsables_cfp->photos_resp_cfp == '' or $responsables_cfp->photos_resp_cfp == 'XXXXXXX')
                                                <td role="button" class="randomColor m-auto mt-2 text-uppercase empNew" style="width:40px;height:40px; border-radius:100%; color:white; display: grid; place-content: center" data-id={{$responsables_cfp->id}} id={{$responsables_cfp->id}} onclick="afficherInfos();">
                                                    <span class=""> {{$responsables_cfp->nom}} {{$responsables_cfp->pr}} </span>
                                                </td>
                                            @else
                                                <td class="td_hover empNew" role="button" style="display: grid; place-content: center" data-id={{$responsables_cfp->id}} id={{$responsables_cfp->id}} onclick="afficherInfos();">
                                                    <img src="{{asset("images/responsables/".$responsables_cfp->photos_resp_cfp)}}" style="width:40px;height:40px; border-radius:100%">
                                                </td>
                                            @endif
                                            <td style="vertical-align: middle">
                                                {{$responsables_cfp->nom_resp_cfp}} &nbsp; {{$responsables_cfp->prenom_resp_cfp}}
                                            </td>
                                            {{-- <td style="vertical-align: middle">{{$responsables_cfp->prenom_resp_cfp}}</td> --}}
                                            <td style="vertical-align: middle">
                                                {{$responsables_cfp->email_resp_cfp}}
                                            </td>
                                            <td style="vertical-align: middle">
                                                @php
                                                  echo $groupe->formatting_phone($responsables_cfp->telephone_resp_cfp);
                                                @endphp
                                            </td>
                                            <td style="vertical-align: middle">{{$responsables_cfp->fonction_resp_cfp}}</td>

                                            <td style="vertical-align: middle" class="text-center">
                                                @if($responsables_cfp->prioriter == 1 && $responsables_cfp->activiter == 1 && $responsables_cfp->id == $resp_connecte->id)
                                                    <span data-bs-toggle="modal" data-bs-target="#staticBackdrop" title="Résponsable principale" role="button" class="td_hover" style="vertical-align: middle; font-size:23px; color:gold" align="center"><i data-bs-toggle="modal" data-bs-target="#staticBackdrop" class='bx bxs-star'></i></span>
                                                @elseif($responsables_cfp->prioriter == 0 && $responsables_cfp->activiter == 0 && $responsables_cfp->id != $resp_connecte->id)
                                                    <span desabled title="Résponsable" role="button"  class="td_hover" style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" align="center">
                                                        <i desabled class='bx bxs-star'></i>
                                                    </span>
                                                @else
                                                    <span desabled title="Résponsable" role="button"  class="td_hover" @if($responsables_cfp->prioriter == 0) style="vertical-align: middle; font-size:23px; color:rgb(168, 168, 168)" @elseif($responsables_cfp->prioriter == 1) style="vertical-align: middle; font-size:23px; color:gold" @endif align="center">
                                                        <i desabled @if($resp_connecte->prioriter == 1) data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$responsables_cfp->id }}" @endif class='bx bxs-star'></i>
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="td_hover" role="button" style="vertical-align: middle" >
                                                @if($responsables_cfp->prioriter == 1 && $responsables_cfp->id == $resp_connecte->id)
                                                    <div style="display: grid; place-content: center" class="form-check form-switch">
                                                        <input  class="form-check-input activer main" data-id="" type="checkbox" role="switch" checked disabled/>
                                                    </div>
                                                @else
                                                    @if($resp_connecte->prioriter == 1)
                                                        <div style="display: grid; place-content: center" class="form-check form-switch">
                                                            <input class="form-check-input {{$responsables_cfp->id}} main" data-bs-toggle="modal"  name="switch"  @if($responsables_cfp->activiter == 1) data-bs-target="#test_{{$responsables_cfp->id}}" id="switch2_{{$responsables_cfp->id}}" title="Désactiver la personne selectionner" @elseif($responsables_cfp->activiter == 0) data-bs-target="#test2_{{$responsables_cfp->id}}" id="switch_{{$responsables_cfp->id}}" title="Activer la personne selectionner" @endif   class="form-check-input activer" data-id="" type="checkbox" role="switch" @if($responsables_cfp->activiter == 1) checked @endif/>
                                                        </div>
                                                    @else
                                                        <div style="display: grid; place-content: center" class="form-check form-switch">
                                                            <input class="form-check-input main" data-bs-toggle="modal" name="switch" data-bs-target="#test_{{$responsables_cfp->id}}" id="switch2_{{$responsables_cfp->id}}" title="Désactiver la personne selectionner" type="checkbox" role="switch" @if($responsables_cfp->activiter == 1) checked @endif disabled/>
                                                        </div>
                                                    @endif

                                                @endif
                                                <td>
                                                        @if($responsables_cfp->activiter == 1)
                                                            <div class="text-center mt-3">
                                                                <p>
                                                                    <span style="color:white; background-color:rgb(23, 171, 0); border-radius:7px; padding: 5px" > Activé </span>
                                                                </p>
                                                            </div>
                                                        @elseif($responsables_cfp->activiter == 0)
                                                            <div class="text-center mt-3">
                                                                <p>
                                                                    <span style="color:white; background-color:rgb(255, 38, 38); border-radius:7px; padding: 5px" > Desactivé </span>
                                                                </p>
                                                            </div>
                                                        @endif
                                                </td>
                                            </td>
                                        </tr>
                                        <div class="modal fade mt-5" id="staticBackdrop_{{$responsables_cfp->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <form action="{{route('update_roleReferent')}}" method="Post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <span style="font-size: 16px;" class="modal-title" id="staticBackdropLabel"></span>
                                                        <button style="font-size: 13px" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body mt-3">
                                                        <span>Vous êtes sur le point de designer cette personne comme referent principale?</span>
                                                        <input name="id_resp" type="hidden" class="responsable_cible" value="{{$responsables_cfp->id}}">
                                                    </div>
                                                    <div class="modal-footer mt-5">
                                                        <button style="border-radius:25px" type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Annuler</button>

                                                        <button style="border-radius:25px" type="submit" class="btn btn-outline-success btn-sm" data-bs-dismiss="modal">Confirmer</button>
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="modal fade" id="test_{{$responsables_cfp->id}}" tabindex="-1" aria-labelledby="test_{{$responsables_cfp->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header  d-flex justify-content-center"
                                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez désactiver cette personne. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary non_active" data-bs-dismiss="modal" id="{{$responsables_cfp->id}}"> Non </button>
                                                        <button type="button" class="btn btn-secondary desactiver_personne" data-id="{{$responsables_cfp->id}}" id="{{$responsables_cfp->id}}"> Oui</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="modal fade" id="test2_{{$responsables_cfp->id}}" tabindex="-1" aria-labelledby="test2_{{$responsables_cfp->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez activer cette personne. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary non_active2"
                                                            data-bs-dismiss="modal" id="{{$responsables_cfp->id}}">Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary activer_personne" id="{{$responsables_cfp->id}}">Oui</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade mt-5" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <span style="font-size: 16px;" class="modal-title" id="staticBackdropLabel">Choississez comme</span>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body mt-3">
                                       <span style="font-size: 14px;">vous êtes déjà une référence principale !</span>
                                    </div>
                                    <div class="modal-footer mt-5">
                                      <button style="border-radius:25px" type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">OK</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @elseif($resp_connecte->prioriter == 0)
                                @foreach($cfpPrincipale as $prioriter)
                                    <div id="in2" class=" text-center p-2 mt-5 m-0  alert alert-danger text-center" role="alert">
                                        <h4 class="alert-heading animation_alert"><i class="fas fa-exclamation-triangle"></i></h4>
                                        <p style="color: rgb(228, 128, 128)">Veuillez-vous contactez votre réferent principale pour activer votre compte !</p>
                                        <hr>
                                        <p class="mb-0" style="color: rgb(213, 97, 97);">{{$prioriter->nom_resp_cfp}} {{$prioriter->prenom_resp_cfp}} &nbsp; | &nbsp; {{$prioriter->email_resp_cfp}} &nbsp; | &nbsp;{{$prioriter->telephone_resp_cfp}}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--AfficheInfos--}}
    <div class="infos mt-3">
        <div class="row">
            <div class="col">
                <p class="m-0 text-center">INFORMATION</p>
            </div>
            <div class="col text-end">
                <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
            </div>
            <hr class="mt-2">

            <div class="mt-2" style="font-size:14px">
                {{-- <div class="mt-1">
                        <span class="text-center" style="height: 50px; width: 100px"><img src="{{asset('images/CFP/'.$centre->logo_cfp)}}" alt="Logo"></span>
            </div> --}}
            <div class="mt-1 text-center mb-3">
                <span id="donner"></span>
            </div>

            <div class="mt-1 text-center">
                <span id="nomEtp" style="color: #64b5f6; font-size: 18px; text-transform: uppercase; font-weight: bold"></span>
            </div>
            {{-- <div class="mt-1 mb-3 text-center">
                <span id="prenom" style="font-size: 16px; text-transform: capitalize; font-weight: bold"></span>
            </div> --}}
            <div class="mt-1">
                <div class="row">
                    <div class="col-md-1"><i class='bx bx-user'></i></div>
                    <div class="col-md-3">Nom_prénoms</div>
                    <div class="col-md">
                        <span id="nom" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                        <span id="prenom" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                    </div>
                </div>
            </div>
            <div class="mt-1">
                <div class="row">
                    <div class="col-md-1"><i class='bx bx-envelope' ></i></div>
                    <div class="col-md-3">E-mail</div>
                    <div class="col-md"><span id="mail_stagiaire"></span></div>
                </div>
            </div>
            <div class="mt-1">
                <div class="row">
                    <div class="col-md-1"><i class='bx bx-phone' ></i></div>
                    <div class="col-md-3">Télephone</div>
                    <div class="col-md">
                        <span></span><span id="telephone_stagiaire"></span>
                    </div>
                </div>
            </div>
            <div class="mt-1">
                <div class="row">
                    <div class="col-md-1"><i class='bx bx-location-plus' ></i></div>
                    <div class="col-md-3">Adresse</div>
                    <div class="col-md"><span id="adresse"></span></div>
                </div>

            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script>
        $(document).ready(function () {
            $('#modifTable thead tr:eq(1) th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" class="column_search form-control form-control-sm" style="font-size:13px;"/>' );
                // $(this).html( '<input type="text" placeholder="Afficher par '+title+'" class="column_search form-control form-control-sm" style="font-size:13px;"/>' );
                $( "th.hideActive > input" ).prop( "disabled", true ).attr( "placeholder", "" );
            } );

            function searchByColumn(table){
                var defaultSearch = 0;

                $(document).on('change keyup', '#select-column', function(){
                    defaultSearch = this.value;
                });

                $(document).on('change keyup', '#search-by-column', function(){
                    table.search('').column().search('').draw();
                    table.column(defaultSearch).search(this.value).draw();
                });
            }

            $( '#modifTable thead'  ).on( 'keyup', ".column_search",function () {

                table
                    .column( $(this).parent().index() )
                    .search( this.value )
                    .draw();
            } );

            var table = $('#modifTable').removeAttr('width').DataTable({
                initComplete : function() {
                    $("#myDatatablesa_filter").detach().appendTo('#new-search-area');
                },
                scrollY:        "500px",
                // scrollX:        true,
                // scrollCollapse: true,
                orderCellsTop: true,
                fixedHeader: true,
                "language": {
                    "paginate": {
                    "previous": "précédent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun résultat trouvé",
                    "infoEmpty":      " 0 trouvés",
                    "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoFiltered":   "(filtre sur _MAX_ entrées)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });

            $('input:checkbox').on('change', function () {
                var Projet = $('input:checkbox[name="Projet"]:checked').map(function() {
                    return '^' + this.value + '$';
                }).get().join('|');

                table.column(0).search(Projet, true, false, false).draw(false);

                var Session = $('input:checkbox[name="session"]:checked').map(function() {
                    return this.value;
                }).get().join('|');

                table.column(1).search(Session, true, false, false).draw(false);

                var Entreprise = $('input:checkbox[name="entreprise"]:checked').map(function() {
                    return this.value;
                }).get().join('|');

                table.column(3).search(Entreprise, true, false, false).draw(false);

                var Modalite = $('input:checkbox[name="modalite"]:checked').map(function() {
                    return this.value;
                }).get().join('|');

                table.column(4).search(Modalite, true, false, false).draw(false);

                var TypeFormation = $('input:checkbox[name="typeFormation"]:checked').map(function() {
                    return this.value;
                }).get().join('|');

                table.column(8).search(TypeFormation, true, false, false).draw(false);

                var Module = $('input:checkbox[name="module"]:checked').map(function() {
                    return this.value;
                }).get().join('|');

                table.column(2).search(Module, true, false, false).draw(false);

                var Statut = $('input:checkbox[name="statut"]:checked').map(function() {
                    return this.value;
                }).get().join('|');

                table.column(7).search(Statut, true, false, false).draw(false);

            });

            searchByColumn(table);
        });


        var el = document.getElementById("in2");

        function fadeIn(el, time) {
            el.style.opacity = 0;

            var last = +new Date();
            var tick = function() {
                el.style.opacity = +el.style.opacity + (new Date() - last) / time;
                last = +new Date();

                if (+el.style.opacity < 1) {
                    (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 10);
                }
            };

            tick();
        }

        $(".randomColor").each(function() {
                $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
            });

        $(".non_active2").on('click', function(e) {
            let id = e.target.id;
            let id2 = $("#switch_"+id).val();
            $("#switch_"+id).prop('checked',false);
        });

        $(".non_active").on('click', function(e) {
            let id = e.target.id;
            let id2 = $("#switch_"+id).val();
            $("#switch2_"+id).prop('checked',true);
        });

        $('.desactiver_personne').on('click',function(e){
            let id = e.target.id;
            $.ajax({
                method: "GET"
                , url: "{{route('desactiver_personne')}}"
                , data: {Id : id}
                , success: function(response) {
                    window.location.reload();
                }
                , error: function(error) {
                    console.log(error)
                }
            });
        });

        $('.activer_personne').on('click',function(e){
            let id = e.target.id;
            $.ajax({
                method: "GET"
                , url: "{{route('activer_personne')}}"
                , data: {Id : id}
                , success: function(response) {
                    window.location.reload();
                }
                , error: function(error) {
                    console.log(error)
                }
            });
        });

        $('.empNew').on('click', function(){
            var user_id = $(this).data("id");
            $.ajax({
                method: "GET"
                , url: "/newAfficheInfo/employe_cfp/"+user_id
                , dataType: "html"
                , success: function(response) {
                    let userData = JSON.parse(response);
                    for (let $i = 0; $i < userData.length; $i++) {
                        let url_photo = '<img src="{{asset("images/employes/:url_img")}}" style="height80px; width:80px;">';
                        url_photo = url_photo.replace(":url_img", userData[$i].photos);
                        var nom = (userData[$i].nom_resp_cfp).substr(0, 1);
                        var prenom = (userData[$i].prenom_resp_cfp).substr(0, 1);

                        if(userData[$i].photos == null){
                            $('#donner').html(" ");
                            $('#donner').append('<p style="background-color: #5c6bc0; width: 80px; height: 80px; border-radius: 50%; padding: 30px; color: white; font-weight: 700; font-size: 14px; marging-bottom: 20px; position: relative; left: 40%"><span>'+nom+prenom+'</span></p>');
                        }else{
                            $("#donner").html(" ");
                            $("#donner").append(url_photo);
                        }

                        $("#nom").text(': '+userData[$i].nom_resp_cfp);
                        $("#prenom").text(userData[$i].prenom_resp_cfp);
                        $("#mail_stagiaire").text(': '+userData[$i].email_resp_cfp);

                        if(userData[$i].telephone_resp_cfp == null) var phone = "-------";
                        else var phone = userData[$i].telephone_resp_cfp;

                        $("#telephone_stagiaire").text(': '+phone);

                        if(userData[$i].adresse_lot == null){
                            var lot = "-------"
                        }
                        else  var lot = userData[$i].adresse_lot;
                            if(userData[$i].adresse_quartier == null){
                            var quartier = "-------"
                        }
                        else  var quartier = userData[$i].adresse_quartier;

                        if(userData[$i].adresse_ville == null){
                            var ville = "-------"
                        }
                        else  var ville = userData[$i].adresse_ville;

                        if(userData[$i].adresse_region == null){
                            var region = "-------"
                        }
                        else  var region = userData[$i].adresse_region;
                        $("#adresse").text(': '+lot+' '+quartier+ ' '+ville+ ' '+region);
                        $("#code_postal").text(': '+userData[$i].adresse_code_postal);
                    }
                }
            });
        });
    </script>
@endsection

