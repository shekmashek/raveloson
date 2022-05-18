@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification programme</h3>
@endsection
@section('content')
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/modif_programme.css')}}">
<div class="row navigation_detail">
    <div class="ps-5 col justify-content-between d-flex flex-row">
        <div>
            <ul class="d-flex flex-row">
                <li class="me-5"><a href="#objectif">objectif</a></li>
                <li class="me-5"><a href="#pour_qui">pour qui ?</a></li>
                <li class="me-5"><a href="#programme">programme</a></li>
            </ul>
        </div>
        <div>
            <a class="new_list_nouvelle {{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
            href="{{route('liste_module')}}">
            <span class="btn_enregistrer text-center"><i class='bx bxs-chevron-left me-1'></i>Précedent</span>
        </a>
        </div>
    </div>
</div>
<section class="detail__formation">
    <div class="container py-4 bg-light">
        <div class="row justify-content-space-between py-3 px-5" id="border_premier">
            <div class="col-lg-6 col-md-6 ">
                <div class="">
                    @foreach ($infos as $res)
                    <h4 class="py-4">{{$res->nom_module}}&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#nom_module"><i class='bx bx-edit bx_modifier' title="modifier titre module"></i></span></h4>
                    <p class="text_black">{{$res->nom_formation}}</p>
                    <div class="d-flex">
                        <p class="text_black">{{$res->description}}</p>&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#description"><i class='bx bx-edit bx_modifier' title="modifier description module"></i></span>
                    </div>
                    <div class="detail__formation__result__avis">
                        <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                        <span class="text_black"><strong>{{ $res->pourcentage }}</strong>/5 ({{ $nb_avis }} avis)</span>
                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 ">
                <div class="detail__formation__result__item2">
                    <a href="#">
                        <h6 class="py-4 text-center text_black">Formation Proposée par&nbsp;<span>{{$res->nom}}</span>
                        </h6>
                    </a>
                    <div class="text-center"><img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid"
                            style="width: 200px; height:100px;"></div>
                </div>
            </div>
            <div class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                <div id="objectif"></div>
                <div class="col"><i class="bx bxs-alarm bx_icon"></i>
                    <span class="text_black">
                        @isset($res->duree_jour)
                        {{$res->duree_jour}} jours
                        @endisset
                    </span>
                    <span class="text_black">
                        @isset($res->duree)
                        /{{$res->duree}} h
                        @endisset
                    </span> </p>
                </div>

                <div class="col"><i class="bx bxs-devices bx_icon"></i><span
                        class="text_black">&nbsp;{{$res->modalite_formation}}</span>
                </div>
                <div class="col"><i class='bx bx-equalizer bx_icon'></i><span
                        class="text_black">&nbsp;{{$res->niveau}}</span>
                </div>
                <div class="col"><i class='bx bx-receipt bx_icon'></i><span
                    class="text_black">&nbsp;{{ $res->reference }}</span>
                </div>
                <div class="col">
                    {{$devise->devise}}<span class="text_black text_prix">&nbsp;{{number_format($res->prix, 0, ' ', ' ')}}&nbsp;</span>&nbsp;HT</span>
                </div>
                <div class="col">
                    {{$devise->devise}}<span class="text_black text_prix">&nbsp;{{number_format($res->prix_groupe, 0, ' ', ' ')}}&nbsp;</span>&nbsp;HT</span>
                </div>
                <div class="col">
                    <span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#refs"><i class='bx bx-edit bx_modifier' title="modifier details module"></i></span>
                </div>
            </div>
        </div>
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5 mb-5">
            <div class="col-lg-9 detail__formation__content">
                <div id="pour_qui"></div>
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pb-3">Objectifs de la formation&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#objectif_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></h3>
                <div class="row detail__formation__item__left__objectif">
                    <div class="col-lg-12">
                        {{-- <p>@php echo html_entity_decode($res->objectif) @endphp</p> --}}
                        <p id="objectif_content">{{$res->objectif}}</p>
                    </div>
                </div>

                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3 pb-3">A qui s'adresse cette formation?</h3>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-6">
                        <div class="row">
                            <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour qui ?&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#cible"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></h3></span>
                            <div class="col-12">
                                {{-- <p>@php echo html_entity_decode($res->cible) @endphp</p> --}}
                                <p id="cible_content">{{$res->cible}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i
                                    class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#prerequis_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                {{-- <p>@php echo html_entity_decode($res->prerequis) @endphp</p> --}}
                                <p id="prerequis_content">{{$res->prerequis}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                necessaire&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#equipement_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                {{-- <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p> --}}
                                <p id="equipement_content">{{$res->materiel_necessaire}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
                                a savoir&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#bon_a_savoir_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                {{-- <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p> --}}
                                <p id="bon_a_savoir_content">{{$res->bon_a_savoir}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="programme"></div>
                <div id="programme__formation"></div>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-12 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bx-hive py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
                                pedagogiques&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#prestation_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                {{-- <p>@php echo html_entity_decode($res->prestation) @endphp</p> --}}
                                <p id="prestation_content">{{$res->prestation}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__item__left">
                    <h3 class="pt-3 pb-3">Programme de la formation</h3>
                    <div class="col-lg-12">
                        <div class="row detail__formation__item__left">
                            <form action="{{route('insert_prog_cours')}}" method="POST" class="w-100">
                                @csrf
                                <div id="newProg"></div>
                                <div class="form-row d-flex flex-row">
                                    <input type="hidden" value="{{$id}}" name="id_module">
                                    <button type="submit" class="btn btn_enregistrer me-4" id="nouveau_prg"
                                        style="display:none"><i class='bx bx-check me-1'></i>Enregistrer</button>
                                    <button type="button" id="addProg" class="btn_nouveau btn">
                                        <i class='bx bx-plus-medical '></i>
                                        Ajouter un section
                                    </button>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row detail__formation__item__left__accordion ">
                            <div class="accordionWrapper">
                                <?php $i=0 ?>
                                @foreach ($programmes as $prgc)
                                <div class="accordionItem open" id="programme{{$prgc->id}}">
                                    <h6 class="accordionItemHeading py-2 ps-3 pe-3 justify-content-between d-flex flex-row">
                                        <div class="pt-2">{{$i+1}} - {{$prgc->titre}}</div>
                                        <div class="d-flex flex-row test_affichage">
                                            <div role="button" data-bs-toggle="modal" class="ajouter_cours me-2" data-bs-target="#Modal_cours_{{$prgc->id}}" id="{{$prgc->id}}" title="ajouter une nouvelle point">
                                                <i class='bx bx-plus-medical bx_ajouter'></i>
                                            </div>
                                            <div role="button" data-bs-toggle="modal" class="modifier_cours me-2" data-bs-target="#Modal_{{$prgc->id}}" id="{{$prgc->id}}" title="modifier le programme">
                                                <i class='bx bx-edit bx_modifier'></i>
                                            </div>
                                            <div class="suppression_programme" title="Supprimer le programme" id="{{$prgc->id}}">
                                                <i class='bx bx-trash bx_supprimer'></i>
                                            </div>
                                        </div>
                                    </h6>
                                    <div class="accordionItemContent">
                                        @foreach ($cours as $c)
                                        @if($c->programme_id == $prgc->id)
                                        <div id="cours{{$c->cours_id}}" class="ps-4 m-0 pb-3 pt-2 p-0 cours_hover d-flex flex-row justify-content-between">
                                            <div class="pt-2"><i class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}}</div>
                                            <div class="me-2">
                                                <span class="suppression mt-2" title="Supprimer le Cours" id="{{$c->cours_id}}">
                                                    <i class='bx bx-trash bx_supprimer'></i>
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach

                                    </div>
                                    {{-- data-target="#Modal_{{$prgc->id}}" --}}
                                </div>
                                <div>
                                    <div class="modal fade" id="Modal_{{$prgc->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal{{$prgc->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Modifier les Cours et le Programme</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('update_prog_cours')}}" method="POST"
                                                        class="form_modif">
                                                        @csrf
                                                        <input type="hidden" value="{{$prgc->id}}" name="id_prog">
                                                        <div class="form-row">
                                                            <label for="" class="mb-2">Titre de Section</label>
                                                            <input type="text" name="titre_prog"
                                                                class="w-100  titre_{{$i}} input" value="{{$prgc->titre}}">
                                                            <hr>
                                                            <label for="" class="mb-2">Liste des Points en Cours</label>
                                                            <div class="d-flex flex-column">
                                                                <?php $j=0 ?>
                                                                @foreach ($cours as $c)
                                                                @if($c->programme_id == $prgc->id)
                                                                <input type="text"
                                                                    name="cours_{{$prgc->id}}_{{$c->cours_id}}"
                                                                    class="w-100 cours_{{$j}} input mb-2"
                                                                    value="{{$c->titre_cours}}" required>
                                                                <input type="hidden"
                                                                    name="id_cours_{{$prgc->id}}_{{$c->cours_id}}"
                                                                    value="{{$c->cours_id}}">
                                                                <?php $j++ ?>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                    <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="modal fade" id="Modal_cours_{{$prgc->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal_cours_{{$prgc->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('insertion_cours')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_prog" id="id" value="{{$prgc->id}}">
                                                    <div class="modal-header">
                                                        <h6>Ajouter des nouvelles Points dans&nbsp;{{$prgc->titre}}</h6>
                                                    </div>
                                                    <div class="modal-body mt-2 mb-2">
                                                        <div class="container">
                                                            <div class="row mb-5">
                                                                <div class="mt-2 text-center">
                                                                    <span class="btn_nouveau text-center" onclick="Cours();" >
                                                                        <i class='bx bx-plus-medical me-1'></i>Ajouter un point
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="form-row">
                                                                            <input type="text" name="cours[]" id="cours"
                                                                                class="form-control input" placeholder="Nouveau Point" required>
                                                                            <label for="cours"
                                                                                class="form-control-placeholder">Nouveau Point </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="newRowCours"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn_fermer" id="fermerCours" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FIXME:mise en forme de design --}}
            <div class="col-lg-3 g-0 p-0 m-0">

                @if($competences != null)
                <div class="row g-0 competence_box mb-3 ">
                    <h5 class="text-center py-2">Compétences à Acquérir</h5>
                        @foreach ($competences as $comp)
                        <div class="row text-start g-0 px-1" id="competence_{{$comp->id}}">
                            <div class="col-1">
                                <i class="bx bx-check check_comp"></i>&nbsp;
                            </div>
                            <div class="col-11 mb-3">
                                <span class="text-capitalize">{{$comp->titre_competence}}</span>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center mb-3">
                            <span class=" ms-2 mb-2 mt-2 pb-2" data-bs-toggle="modal" data-bs-target="#ModalCompetence_{{$id}}" id="{{$id}}" title="ajouter une nouvelle competence">
                                <i class='bx bx-plus-medical bx_ajouter'></i>
                            </span>
                            <span class=" ms-2 mb-2 mt-2 pb-2" data-bs-toggle="modal" data-bs-target="#Modal_{{$id}}" id="{{$id}}" title="modifier les competence">
                                <i class='bx bx-edit bx_modifier'></i>
                            </span>
                        </div>
                </div>
                @endif
                <div>
                    <div class="modal fade" id="ModalCompetence_{{$id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('ajout_competence')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                    <div class="modal-header">
                                        <h6>Compétences a évaluer</h6>
                                    </div>
                                    <div class="modal-body mt-2 mb-2">
                                        <div class="container">
                                            <div class="row">
                                                <div class="mt-2 text-center mb-5">
                                                    <span id="addRow" class="btn_nouveau text-center " onclick="competence();" >
                                                        <i class='bx bx-plus-medical me-1'></i>Ajouter une competence
                                                    </span>

                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <input type="text" name="titre_competence[]"
                                                                id="titre_competence"
                                                                class="form-control input" placeholder="Compétences"
                                                                required>
                                                            <label for="titre_competence"
                                                                class="form-control-placeholder">Compétences</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group ms-1">
                                                        <div class="form-row">
                                                            <input type="text" name="notes[]"
                                                                id="notes" min="1" max="10"
                                                                onfocus="(this.type='number')"
                                                                class="form-control input" placeholder="Notes"
                                                                required>
                                                            <label for="notes"
                                                                class="form-control-placeholder">Notes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="newRowComp"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_fermer" id="fermerComp" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <?php $i=0 ?>
                    <div class="modal fade" id="Modal_{{$id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modifier_competence')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                    <div class="modal-header">
                                        <h6>Compétences a évaluer</h6>
                                    </div>
                                    <div class="modal-body mt-2 mb-2">
                                        <div class="container">
                                            @foreach ($competences as $comp)
                                            <div class="d-flex">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <input type="text" name="titre_competence_{{$comp->module_id}}_{{$comp->id}}"
                                                                id="titre_competence"
                                                                class="form-control input mb-2 suppre_{{$comp->id}}" value="{{$comp->titre_competence}}" placeholder="Compétences"
                                                                required>
                                                            <input type="hidden"
                                                                name="id_notes_{{$comp->module_id}}_{{$comp->id}}"
                                                                value="{{$comp->module_id}}">
                                                            <label for="titre_competence"
                                                                class="form-control-placeholder">Compétences</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group ms-1">
                                                        <div class="form-row">
                                                            <input type="text" name="notes_{{$comp->module_id}}_{{$comp->id}}"
                                                                id="notes" min="1" max="10"
                                                                onfocus="(this.type='number')"
                                                                class="form-control input mb-2 suppre_{{$comp->id}}" value="{{$comp->objectif}}" placeholder="Notes"
                                                                required>
                                                                <input type="hidden"
                                                                    name="id_notes_{{$comp->module_id}}_{{$comp->id}}"
                                                                    value="{{$comp->module_id}}">
                                                            <label for="notes"
                                                                class="form-control-placeholder">Notes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="suppre_{{$comp->id}} suppression_competence" role="button" title="Supprimer le competence" id="{{$comp->id}}" data-id="{{$comp->id}}"><i class='bx bx-trash bx_supprimer mt-1 ms-2'></i></div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_fermer" id="fermer4" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php $i++ ?>
                </div>
            </div>
            {{-- modal modification --}}
            <div>
                {{-- modification nom_module --}}
                <div>
                    <div class="modal" id="nom_module" aria-labelledby="nom_module" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modification_nom_module',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Nom module</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="nom_module" required value="{{$res->nom_module}}" placeholder="Nom module" >
                                            <label for="nom_module" class="form-control-placeholder">Nom module</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                    </div>
                </div>
                {{-- modification description --}}
                <div>
                    <div class="modal" id="description" aria-labelledby="description" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modification_description',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Déscription module</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="description" required value="{{$res->description}}" placeholder="Déscription module" >
                                            <label for="description" class="form-control-placeholder">Déscription</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification detail --}}
                <div>
                    <div class="modal" id="refs" aria-labelledby="refs" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modification_detail',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Détail module</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control jour input" id="jour" name="jour" min="1" max="365" onfocus="(this.type='number')" title="modifier durée en jours" value="{{$res->duree_jour}}" placeholder="Durée en Jours (J)" required>
                                            <label for="acf-jour" class="form-control-placeholder">Durée en Jours (J)</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control jour input" id="heure" name="heure" min="1" max="8760" onfocus="(this.type='number')" title="modifier durée en heure" value="{{$res->duree}}" placeholder="Durée en Heure (H)" required>
                                            <label for="acf-jour" class="form-control-placeholder">Durée en Heure (H)</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select_formulaire modalite modalite input mt-3" id="modalite" name="modalite" style="height: 50px;">
                                                @if($res->modalite_formation == 'En ligne')
                                                <option value="{{$res->modalite_formation}}" selected>
                                                    {{$res->modalite_formation}}</option>
                                                <option value="Presentiel">Présentiel</option>
                                                <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                @endif
                                                @if($res->modalite_formation == 'Presentiel')
                                                <option value="En ligne">En ligne</option>
                                                <option value="{{$res->modalite_formation}}" selected>
                                                    {{$res->modalite_formation}} </option>
                                                <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                @endif
                                                @if($res->modalite_formation == 'En ligne/Presentiel')
                                                <option value="En ligne">En ligne</option>
                                                <option value="Presentiel">Présentiel</option>
                                                <option value="{{$res->modalite_formation}}" selected>
                                                    {{$res->modalite_formation}} </option>
                                                @endif
                                            </select>
                                            <label for="acf-modalite" class="form-control-placeholder">Modifier la modalite de formation...</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select_formulaire niveau niveau input mt-3" id="niveau" name="niveau" style="height: 50px;">
                                                <option value="{{$res->niveau_id}}" selected>
                                                    {{$res->niveau}} </option>
                                                @foreach($niveau as $nv)
                                                <option value="{{$nv->id}}" data-value="{{$nv->niveau}}">
                                                    {{$nv->niveau}}</option>
                                                @endforeach
                                            </select>
                                            <label for="acf-modalite" class="form-control-placeholder">Modifier le niveau</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="reference" required value="{{$res->reference}}" placeholder="Référence module" >
                                            <label for="reference" class="form-control-placeholder">Référence</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="prix" required value="{{$res->prix}}" onfocus="(this.type='number')" placeholder="Prix module" >
                                            <label for="prix" class="form-control-placeholder">Prix en {{$devise->devise}}</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="prix_groupe" required value="{{$res->prix_groupe}}" onfocus="(this.type='number')" placeholder="Prix en groupe module" >
                                            <label for="prix_groupe" class="form-control-placeholder">Prix groupe en {{$devise->devise}}</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification objectif --}}
                <div>
                    <div class="modal" id="objectif_module" aria-labelledby="objectif_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_objectif',$res->module_id)}}" method="POST" id="form_objectif">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Objectif de la formation</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="objectif_textarea" name="objectif" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="objectif_id">
                                                <p>@php echo html_entity_decode($res->objectif) @endphp</p>
                                            </div>

                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification pour_qui --}}
                <div>
                    <div class="modal" id="cible" aria-labelledby="cible" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_pour_qui',$res->module_id)}}" method="POST" id="form_public">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Public cible</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="public_textarea" name="public_cible" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="public_id">
                                                <p>@php echo html_entity_decode($res->cible) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification prerequis --}}
                <div>
                    <div class="modal" id="prerequis_module" aria-labelledby="prerequis_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_prerequis',$res->module_id)}}" method="POST" id="form_prerequis">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Prérequis</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="prerequis_textarea" name="prerequis" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="prerequis_id">
                                                <p>@php echo html_entity_decode($res->prerequis) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification equipement --}}
                <div>
                    <div class="modal" id="equipement_module" aria-labelledby="equipement_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_equipement',$res->module_id)}}" method="POST" id="form_equipement">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Equipement necessaire</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="equipement_textarea" name="equipement" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="equipement_id">
                                                <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification bon_a_savoir --}}
                <div>
                    <div class="modal" id="bon_a_savoir_module" aria-labelledby="bon_a_savoir_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_bon_a_savoir',$res->module_id)}}" method="POST" id="form_bon_a_savoir">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Bon à savoir</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="bon_a_savoir_textarea" name="bon_a_savoir" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="bon_a_savoir_id">
                                                <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification prestation --}}
                <div>
                    <div class="modal" id="prestation_module" aria-labelledby="prestation_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_prestation',$res->module_id)}}" method="POST" id="form_prestation">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Préstation pédagogique</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="prestation_textarea" name="prestation" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="prestation_id">
                                                <p>@php echo html_entity_decode($res->prestation) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('js/module_programme.js') }}"></script>
<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}],
        [{ 'script': 'sub'}, { 'script': 'super' }],

        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }]
    ];

    let objectif_editor = new Quill('#objectif_id', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow',
    });

    let public_editor = new Quill('#public_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let prerequis_editor = new Quill('#prerequis_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let equipement_editor = new Quill('#equipement_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let bon_a_savoir_editor = new Quill('#bon_a_savoir_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let prestation_editor = new Quill('#prestation_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let objectif = objectif_editor.root.innerHTML;
    $('#objectif_content').html(objectif);
    $("#form_objectif").on("submit",function() {
        $("#objectif_textarea").val($("#objectif_id").html());
    });


    let cible = public_editor.root.innerHTML;
    $('#cible_content').html(cible);
    $("#form_public").on("submit",function() {
        $("#public_textarea").val($("#public_id").html());
    });

    let prerequis = prerequis_editor.root.innerHTML;
    $('#prerequis_content').html(prerequis);
    $("#form_prerequis").on("submit",function() {
        $("#prerequis_textarea").val($("#prerequis_id").html());
    });

    let equipement = equipement_editor.root.innerHTML;
    $('#equipement_content').html(equipement);
    $("#form_equipement").on("submit",function() {
        $("#equipement_textarea").val($("#equipement_id").html());
    });

    let bon_a_savoir = bon_a_savoir_editor.root.innerHTML;
    $('#bon_a_savoir_content').html(bon_a_savoir);
    $("#form_bon_a_savoir").on("submit",function() {
        $("#bon_a_savoir_textarea").val($("#bon_a_savoir_id").html());
    });

    let prestation = prestation_editor.root.innerHTML;
    $('#prestation_content').html(prestation);
    $("#form_prestation").on("submit",function() {
        $("#prestation_textarea").val($("#prestation_id").html());
    });

</script>
@endsection