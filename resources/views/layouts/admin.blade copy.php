<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formation.mg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
    <link rel="shortcut icon" href="{{  asset('maquette/logo_fmg7635dc.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mahafaly.css')}}">
</head>

<body>
    <div class="sidebar active">
        {{-- <div class="logo_content">
            <div class="logo">
                <span><img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="" class="img-fluid"></span>
                <div class="logo_name"><a href="{{ route('home') }}">Formation.mg</a></div>
            </div>

        </div>
        <ul class="nav_list mb-5" id="menu">

            <li>
                <a href="{{ route('home') }}" class="d-flex active nav_linke">
                    <i class="bx bxs-dashboard"></i>
                    <span class="links_name">Accueil</span>
                </a>

            </li>



            @canany(['isReferent'])
            <li>
                <a href="{{ route('afficher_iframe_entreprise') }}" class="d-flex nav_linke">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="links_name">BI</span>
                </a>
            </li>

            @endcanany
            @canany(['isCFP'])
            <li>
                <a href="{{ route('afficher_iframe_cfp') }}" class="d-flex nav_linke">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="links_name">BI</span>
                </a>
            </li>
            @endcanany
            @canany(['isSuperAdmin'])
            <li>
                <a href="{{ route('creer_iframe') }}" class="d-flex  nav_linke">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="links_name"> BI </span>
                </a>
            </li>
            @endcanany




            {{-- @canany(['isCFP'])
            <li>
                <a href="{{route('liste_module')}}" class="d-flex nav_linke">
                    <i class="bx bx-customize"></i>
                    <span class="links_name">Modules</span>
                </a>

            </li>
            @endcanany --}}
            {{-- entreprise --}}
            {{-- @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouvelle_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouvelle Entreprise</span>
                </a>

            <li class="my-1 sousMenu">
                <a href="{{route('departement.index')}}">D??partement</a>
            </li>
            </li> --}}
            {{-- @endcanany --}}
            @canany(['isSuperAdmin'])

            {{-- <a href="{{route('liste_utilisateur')}}" class="btn_racourcis me-4 mt-3">
                <span class="d-flex flex-column"> <i class='bx bxs-user'></i><span
                        class="text_racourcis">Utilisateurs</span></span>


            </a> --}}
            <li>
                <a href="{{route('categorie')}}" class="d-flex nav_linke">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="links_name">Categories</span>
                </a>

            </li>
            <li>
                <a href="{{route('module')}}" class="d-flex nav_linke">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Formations</span>
                </a>

            </li>
            <li>
                <a href="{{ route('taxes') }}" class="d-flex nav_linke">
                    <i class='bx bx-spreadsheet'></i>
                    <span class="links_name">Taxe</span>
                </a>

            </li>
            <li>
                <a href="{{ route('devise') }}" class="d-flex nav_linke">
                    <i class='bx bx-receipt'></i>
                    <span class="links_name">Devise</span>
                </a>

            </li>

            @endcanany
            @canany(['isReferent'])
            {{-- <li>
                <a href="{{route('liste_departement')}}" class="d-flex nav_linke">
                    <i class='bx bx-home-alt'></i>
                    <span class="links_name">Departements</span>
                </a>

            </li> --}}
            @endcanany
            @can('isCFP')
            <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>

            </li>
            @endcan
            @can('isReferent')
            <li>
                <a href="{{route('list_cfp')}}" class="d-flex nav_linke">
                    <i class='bx bxs-business'></i>
                    <span class="links_name">Organisme</span>
                </a>

            </li>
            @endcan
            {{-- projet de formation --}}

            {{-- @canany(['isCFP','isFormateur'])
            <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Projet</span>
                </a>
                <span class="tooltip">Nouveau Projet</span>
            <li class="sousMenu me-2 d-flex justify-content-between">
                <a href="{{url('detail_session')}}">Sessions</a>
                <p class="my-1" id="projets_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;">
                </p>
            </li>
            </li>
            @endcanany --}}
            @canany(['isReferent'])
            <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>
            </li>
            @endcanany
            @canany(['isReferent'])
            {{-- <li>
                <a href="{{route('projet_interne')}}" class="d-flex nav_linke">
                    <i class='bx bxl-netlify'></i>
                    <span class="links_name">Formation Interne</span>
                </a>

            </li> --}}
            @endcanany
            @canany(['isStagiaire'])
            <li>
                <a href="{{route('liste_projet',['id'=>1])}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>

            </li>
            @endcanany
            @canany(['isCFP','isReferent','isManager'])
            {{-- <li>
                <a href="{{route('appel_offre.index')}}" class="d-flex nav_linke">
                    <i class='bx bx-mail-send'></i>
                    <span class="links_name">Appel d'Offre</span>
                </a>

            </li> --}}
            @endcanany
            {{-- utilisateurs --}}
            {{-- @canany(['isSuperAdmin','isAdmin'])

            <li>
                <a href="{{route('utilisateur_stagiaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-user-circle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>

            </li>
            <li>
                <a href="{{route('utilisateur_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>

            </li>
            @endcanany --}}
            {{-- formateurs --}}

            @canany(['isCFP'])
            <li>
                <a href="{{route('liste_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>

            </li>
            {{-- <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>

            </li> --}}
            @endcanany
            {{-- manager --}}
            {{-- @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Manager</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>

            </li> --}}
            {{-- @endcanany --}}
            @canany(['isReferent'])
            {{-- <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Equipe admnistrative</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>

            </li> --}}
            @endcanany
            {{-- Referent --}}
            @canany(['isAdmin','isSuperAdmin'])
            <li>
                <a href="{{route('utilisateur_superAdmin')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">Super Admin</span>
                </a>

            </li>
            {{-- <li>
                <a href="{{route('liste_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">R??ferents</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau R??ferents</span>
                </a>

            </li> --}}
            @endcanany
            {{-- stagiares --}}

            {{-- @canany(['isReferent'])
            <li>
                <a href="{{route('liste_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Stagiaire</span>
                </a>

            </li> --}}
            {{-- @endcanany --}}
            {{-- action de formations --}}

            {{-- @canany(['isFormateur'])
            <li>
                <a href="{{route('presence.index')}}" class="d-flex nav_linke">
                    <i class='bx bx-list-check'></i>
                    <span class="links_name">Emargement</span>
                </a>

            </li>
            @endcanany --}}

            {{-- calendrire de formations
            <li>
                @canany(['isReferent','isStagiaire','isManager'])
                <a href="{{route('calendrier_formation')}}" class="d-flex nav_linke">
                    <i class='bx bxs-calendar'></i>
                    <span class="links_name">Calendrier</span>
                </a>
                @endcan--}}
                {{-- @canany(['isCFP', 'isFormateur'])
                <a href="{{route('calendrier')}}" class="d-flex nav_linke">
                    <i class='bx bxs-calendar'></i>
                    <span class="links_name">Calendrier</span>
                </a>
                @endcanany -


            </li>-}}

            {{-- commercial --}}
            {{-- @canany(['isSuperAdmin','isCFP','isReferent'])
            <li>
                <a href="{{route('collaboration')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-account'></i>
                    <span class="links_name">Coop??ration</span>
                </a>

            </li>
            @endcanany --}}
            @canany(['isCFP','isReferent'])
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Factures</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
            </li> --}}

            @endcanany
            {{-- competence --}}
            @canany(['isReferent','isManager'])
            @canany(['isReferent'])
            {{-- <li>
                <a href="{{route('demande_test_niveau')}}" class="d-flex nav_linke">
                    <i class='bx bx-network-chart'></i>
                    <span class="links_name">Aptitudes</span>
                </a>
            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
            </li> --}}
            @endcanany
            {{-- <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="links_name">Comp??tence</span>
                </a>
            </li> --}}
            @endcanany

            {{-- plan de formation --}}
            {{-- @canany(['isStagiaire','isManager','isReferent'])
            <li>
                <a @canany(['isStagiaire']) href="{{route('planFormation.index')}}" @endcanany
                    href="{{route('liste_demande_stagiaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-scatter-chart'></i>
                    <span class="links_name">Plan</span>
                </a>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('listePlanFormation')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Liste Plan</span>
                </a>
            </li> --}}
            {{-- @endcanany --}}
            {{-- abonemment --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('listeAbonne')}}" class="d-flex nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonn??es</span>
                </a>

            </li>

            {{-- integrer dans la page
            <li>
                <a href="{{route('abonnement.index')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Abonnement</span>
                </a>
            </li> --}}
            @endcanany

            @canany(['isReferent','isCFP'])
            <li>
                <a href="{{route('ListeAbonnement')}}" class="d-flex nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonnement</span>
                </a>
            </li>

            @endcan
            @can(['isCFP'])
            <li>
                <a href="{{route('liste_demande_devis')}}" class="d-flex nav_linke">
                    <i class='bx bxs-notepad'></i>
                    <span class="links_name"> Demande devis</span>
                </a>
            </li>

            @endcan
            @can('isFormateur')
            <li>
                <a href="{{route('profilProf',Auth::user()->id)}}" class="d-flex nav_linke">
                    <i class='bx bxs-notepad'></i>
                    <span class="links_name">Mon CV</span>
                </a>
            </li>

            @endcan

            {{-- <li>
                <i class='bx bxs-notepad'></i>
                <span class="links_name">Reporting</span>
                </a>
            </li> --}}
            @can('isCFP')
            <li>
                <a href="{{route('gestion_documentaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-book-add'></i>
                    <span class="links_name">Librairies</span>
                </a>
            </li>
            @endcan
        </ul>

        {{-- <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <div class='photo_users'> </div>
                    <div class="name_job">
                        <div class="name">D??connexion</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out" id="log_out"></i></a>
            </div>
        </div> --}}

    </div>

    <div class="home_content">
        <div class="container-fluid p-0 height-100 bg-light" id="content">
            <header class="header row align-items-center g-0" id="header">
                {{-- <div class="col-1 menu_hamburger">
                    <i class="bx bx-menu" id="btn_menu" role="button" onclick="clickSidebar();"></i>
                </div> --}}
                <div class="col-3 d-flex flex-row padding_logo">
                    {{-- <span><img src="{{asset('img/logo_formation/logo_fmg7635dc.png')}}" alt=""
                            class="img-fluid menu_logo me-3"></span>@yield('title') --}}
                            <a href="/home" class="teste">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <div class="titre">
                                    <i >F</i>
                                </div>

                            </a>
                </div>
                <div class="col-4 align-items-center justify-content-start d-flex flex-row ">
                    @canany(['isReferent','isStagiaire','isManager'])
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">

                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_formation')}}" class="text-center " role="button"
                                    onclick="afficher_catalogue()"><span class="d-flex flex-column"><i
                                            class='bx bxs-category-alt mb-2 mt-1'></i><span
                                            class="text_racourcis">Catalogue</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('annuaire')}}" class="text-center " role="button"
                                    onclick="afficher_annuaire()"><span class="d-flex flex-column"><i
                                            class='bx bx-analyse mb-2 mt-1'></i><span
                                            class="text_racourcis">Annuaire</span></span></a>
                            </div>

                        </div>
                    </div>
                    @endcanany
                    @canany(['isReferent','isManager'])
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier_formation')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column text-center"><i
                                            class='bx bxs-calendar-edit mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('employes.liste')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-user-detail mb-2 mt-1'></i><span
                                            class="text_racourcis">employ??s</span></span></a>
                            </div class="btn_racourcis">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('employes')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-group mb-2 mt-1'></i><span
                                            class="text_racourcis">Equipe</span></span></a>
                            </div>
                        </div>
                    </div>
                    @endcan

                    {{-- @canany(['isCFP','isFormateur'])
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier')}}" class="text-center " role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-calendar-edit mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                        </div>
                    </div>
                    @endcanany --}}
                    @canany('isCFP')
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_module')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-customize mb-2 mt-1'></i><span
                                            class="text_racourcis">Modules</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_projet')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bx-library mb-2 mt-1'></i><span
                                            class="text_racourcis">Projets</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-calendar-week mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                            @can('isPremium')
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_equipe_admin')}}" class="text-center" role="button">
                                    <span class="d-flex flex-column">
                                        <i class='bx bxs-user-account mb-2 mt-1'></i>
                                        <span class="text_racourcis">equipes</span>
                                    </span>
                                </a>
                            </div>
                            @endcan
                        </div>
                    </div>
                    @endcanany
                    @canany('isStagiaire')
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_projet')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bx-library mb-2 mt-1'></i><span
                                            class="text_racourcis">Projets</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier_formation')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-calendar-week mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                        </div>
                    </div>
                    @endcanany
                    @canany(['isFormateur','isFormateurInterne'])
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="d-flex flex-row">
                                <div class="btn_racourcis me-4">
                                    <a href="{{route('liste_projet')}}" class="text-center" role="button"><span
                                            class="d-flex flex-column"><i class='bx bx-library mb-2 mt-1'></i><span
                                                class="text_racourcis">Projets</span></span></a>
                                </div>
                                <div class="btn_racourcis me-4">
                                    <a href="{{route('calendrier')}}" class="text-center" role="button"><span
                                            class="d-flex flex-column"><i
                                                class='bx bxs-calendar-week  mb-2 mt-1'></i><span
                                                class="text_racourcis">Agenda</span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcanany
                </div>
                <div class="col-5 header-right align-items-center d-flex flex-row">
                    <div class="col-10 d-flex flex-row justify-content-center apprendCreer pb-3">
                        @can('isStagiaire')
                        <div class="col-5 header-right">
                            <div class="col-12 d-flex flex-row justify-content-center apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endcan
                        @can('isManager')
                        <div class="col-5 header-right">
                            <div class="col-12 d-flex flex-row justify-content-center apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endcan
                        @can('isReferent')
                        <div class="col-5 header-right d-flex flex-row">
                            <div class="col-12 d-flex flex-row justify-content-center apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                                <div class="btn_racourcis dropdown prevent_affichage .navigation_module" >
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="dropdown-toggle" role="button" id="notification" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-bell-ring bx-tada-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation">6</span>
                                    </a>
                                    <ul class="dropdown-menu agrandir2" aria-labelledby="notification">
                                        listes des notifications
                                    </ul>
                                </div>
                                <div class="btn_racourcis dropdown prevent_affichage2 .navigation_module" >
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="dropdown-toggle" role="button" id="invitation_cfp" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-message-add bx-burst-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation">9</span>
                                    </a>
                                    <ul class="dropdown-menu agrandir " aria-labelledby="invitation_cfp">
                                        <div class="m-4 mt-2" role="tabpanel">
                                            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab" style="font-size: 10px;">
                                                <li class="nav-item ">
                                                    <a href="#invitation_attente" class="nav-link active" data-bs-toggle="tab">Invitations en attente</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#invitation_refuses" class="nav-link" data-bs-toggle="tab">Invitations r??fus??es</a>
                                                </li>

                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="invitation_attente">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul>
                                                                liste invitations en attente
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="invitation_refuses">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul>
                                                                liste des invitations r??fus??es
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        @endcan
                        @can('isCFP')
                        <div class="col-5 header-right">
                            <div class="col-12 d-flex flex-row justify-content-end apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                                <div class="btn_racourcis dropdown prevent_affichage .navigation_module" >
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="dropdown-toggle" role="button" id="notification" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-bell-ring bx-tada-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation">6</span>
                                    </a>
                                    <ul class="dropdown-menu agrandir2" aria-labelledby="notification">
                                        listes des notifications
                                    </ul>
                                </div>
                                <div class="btn_racourcis dropdown prevent_affichage2 .navigation_module" >
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="dropdown-toggle" role="button" id="invitation_cfp" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-message-add bx-burst-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation"></span>
                                    </a>
                                    <ul class="dropdown-menu agrandir " aria-labelledby="invitation_cfp">
                                        <div class="m-4 mt-2" role="tabpanel">
                                            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab" style="font-size: 10px;">
                                                <li class="nav-item " >
                                                    <a href="#invitation_attente" class="nav-link active" data-bs-toggle="tab">Invitations en attente</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#invitation_refuses" class="nav-link" data-bs-toggle="tab">Invitations r??fus??es</a>
                                                </li>

                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="invitation_attente">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul>
                                                                <p class="test_affiche1 mt-3 my-2" style="font-size: 12px"></p>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="invitation_refuses">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul class="test_affiche2 mt-3 my-2" style="font-size: 12px">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endcan
                        <div class="pt-2">
                            @can('isSuperAdmin')
                            <div class="btn_creer dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none"
                                    aria-haspopup="true">
                                    <i class='bx bx-plus-medical icon_creer_admin'></i>Cr??er
                                </a>

                                <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuLink">

                                    <li><a class="dropdown-item" href="{{route('nouveau_type')}}"> <i
                                                class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouveau type
                                        </a></li>
                                        <li><a class="dropdown-item" href="{{route('nouveau_coupon')}}"> <i
                                            class='bx bx-money '></i>&nbsp;Nouveau coupon
                                    </a></li>
                                </ul>
                            </div>
                            @endcan
                            @can('isManager')
                            <div class="btn_creer dropdown">

                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none"
                                    aria-haspopup="true">
                                    <i class='bx bx-plus-medical icon_creer_admin'></i>Cr??er
                                </a>

                                <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuLink">

                                    <li><a class="dropdown-item" href="{{route('planFormation.index')}}"> <i
                                                class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouvelle demande
                                            stagiaire</a></li>
                                    <li><a class="dropdown-item" href="{{route('ajout_plan')}}"> <i
                                                class='bx bx-scatter-chart icon_plus'></i>&nbsp;Nouvelle plan de
                                            formation</a></li>
                                    <li><a class="dropdown-item" href="{{route('budget')}}"><i
                                                class="fas fa-money-check icon_plus"></i>&nbsp;Budgetisation</a></li>

                                </ul>
                            </div>
                            @endcan
                            @can('isReferent')
                            <div class=" d-flex flex-row">
                                <div class="btn_creer dropdown">

                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"
                                        style="text-decoration: none">
                                        <i class='bx bx-plus-medical icon_creer_admin'></i>Cr??er

                                    </a>

                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{route('employes.new')}}"><i
                                                    class="fas fa-user icon_plus  "></i>&nbsp; Nouveau Employ??s</a></li>
                                        {{-- <li><a class="dropdown-item" href="{{route('nouveau+appel+offre')}}"> <i
                                                    class="fas fa-envelope-open-text icon_plus"></i>&nbsp; Appel
                                                d'offre</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{route('planFormation.index')}}"> <i
                                                    class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouvelle demande
                                                stagiaire</a></li>
                                        <li><a class="dropdown-item" href="{{route('ajout_plan')}}"> <i
                                                    class='bx bx-scatter-chart icon_plus'></i>&nbsp;Nouvelle plan de
                                                formation</a></li>
                                        <li><a class="dropdown-item" href="{{route('budget')}}"><i
                                                    class="fas fa-money-check icon_plus"></i>&nbsp;Budgetisation</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('formations')}}">
                                                <i class="bx bx-customize icon_plus"></i>&nbsp; Nouveau Module Interne
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('formateurs')}}">
                                                <i class="bx bxs-user-rectangle icon_plus "></i>&nbsp; Nouveau Formateur
                                                Interne
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('projets')}}">
                                                <i class="bx bx-library icon_plus"></i>&nbsp; Projet Interne
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>

                                <div class="ms-2">
                                    <div class="btn_creer dropdown">

                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"
                                            style="text-decoration: none">
                                            <i class='bx bxs-cog icon_creer_admin'></i>
                                            Param??tres
                                        </a>

                                        <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="{{route('aff_parametre_referent')}}"><i
                                                        class="bx bx-info-circle icon_plus  "></i>&nbsp; Information
                                                    l??gales</a></li>
                                            <li><a class="dropdown-item" href="{{route('ListeAbonnement')}}"> <i
                                                        class="bx bxl-sketch icon_plus"></i>&nbsp;Abonnement</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{route('liste_departement')}}">
                                                    <i class='bx bxs-buildings icon_plus'></i>&nbsp;Structure de
                                                    l'entreprise
                                                </a></li>
                                            {{-- <li><a class="dropdown-item" href="{{route('planFormation.index')}}">
                                                    <i class='bx bxs-credit-card-front icon_plus'></i>&nbsp;Taxation
                                                </a></li> --}}
                                            <li><a class="dropdown-item" href="{{route('parametrage_frais_annexe')}}">
                                                    <i class='bx bx-money-withdraw icon_plus'></i>&nbsp;Frais annexes
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            @can('isCFP')
                            <div class=" d-flex flex-row">
                                <div class="btn_creer dropdown">
                                    <a class="dropdown-toggle ms-2" href="#" role="button" id="dropdownMenuLink"
                                        data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"
                                        style="text-decoration: none">
                                        <i class='bx bx-plus-medical icon_creer_admin'></i>Cr??er

                                    </a>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuLink">
                                        @can('isCFPPrincipale')
                                        @can('isPremium')
                                        <li>
                                            <a class="dropdown-item" href="{{route('liste+responsable+cfp')}}">
                                                <i class="bx bx-user icon_plus"></i>&nbsp; Nouveau r??ferent
                                            </a>
                                        </li>
                                        @endcan
                                        @endcan

                                        <li>
                                            <a class="dropdown-item" href="{{route('nouveau_module')}}">
                                                <i class="bx bx-customize icon_plus"></i>&nbsp; Nouveau Module
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('nouveau_formateur')}}">
                                                <i class="bx bxs-user-rectangle icon_plus "></i>&nbsp; Nouveau Formateur
                                            </a>
                                        </li>
                                        @can('isPremium')
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{route('nouveau_groupe_inter',['type_formation'=>2])}}">
                                                <i class='bx bx-library icon_plus'></i>&nbsp;Projet Inter
                                            </a>
                                        </li>
                                        @endcan
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{route('nouveau_groupe',['type_formation'=>1])}}">
                                                <i class="bx bx-library icon_plus"></i>&nbsp; Projet Intra
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{route('facture')}}">
                                                <i class='bx bxs-bank icon_plus'></i>&nbsp;Nouvelle Facture
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                @can('isCFPPrincipale','isPremium')
                                <div class="ms-2">
                                    <div class="btn_creer dropdown">

                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class='bx bxs-cog icon_creer_admin'></i>
                                            Param??tres
                                        </a>
                                        <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="{{route('affichage_parametre_cfp')}}"><i
                                                        class="bx bx-info-circle icon_plus  "></i>&nbsp; Information
                                                    l??gales</a></li>
                                            <li><a class="dropdown-item" href="{{route('ListeAbonnement')}}"> <i
                                                        class="bx bxl-sketch icon_plus"></i>&nbsp;Abonnement</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{route('parametrage_salle')}}">
                                                    <i class='bx bxs-door-open icon_plus'></i>&nbsp;Salle de formation
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                                @endcan
                            </div>
                            @endcan

                        </div>
                    </div>
                    <div class="col-2 btn_profil">
                        <div class="btn_vous header_img text-center">
                            <span role="button">
                                <i class='bx bxs-user' style="font-size: 20px; position: relative; top:.1rem;"></i>
                                <span class="mt-1" style="font-size: 12.8px">Vous&nbsp;<i class='bx bx-caret-down mt-1 ' style="font-size: 12.7px"></i></span>
                            </span>
                        </div>
                        <div class="pdp_profil mt-3" id="box_profil">
                            <div class="container pdp_profil_card " >
                                <div class="card" >
                                    <div class="card-title">
                                        <div class="row">
                                            <div class="col-12 pt-3">
                                                <span>
                                                    <div style="display: grid; place-content: center">
                                                        <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height: 65px; width: 65px ; display: grid; place-content: center">
                                                        </div>
                                                    </div>
                                                </span>
                                                <p id="nom_etp"></p>
                                                <h6 class="mb-0 text-center">{{Auth::user()->name}}</h6>
                                                <h6 class="mb-0 text-center text-muted">{{Auth::user()->email}}</h6>
                                                <div class="text-center">
                                                    @can('isManagerPrincipale')
                                                    <a href="{{route('affProfilChefDepartement')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isFormateurPrincipale')
                                                    <a href="{{route('profile_formateur')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isStagiairePrincipale')
                                                    <a href="{{route('profile_stagiaire')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isReferentPrincipale')
                                                    <a href="{{route('profil_referent')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                    @can('isCFPPrincipale')
                                                    <a href="{{route('profil_du_responsable')}}"><button
                                                            class="btn profil_btn mt-4 mb-2">G??rer votre
                                                            compte</button></a><br>
                                                    @endcan
                                                </div>
                                                <hr>
                                                <div class="text-center d-flex justify-content-center">
                                                    <input type="text" value="{{Auth::user()->id}}" id="id_user" hidden>

                                                    <p class="text-muted me-3">Conn??ct?? en tant que :
                                                    <ul id="liste_role" class="d-flex flex-column"></ul>
                                                    </p>

                                                </div>
                                                <hr>
                                                <div class="text-center">
                                                    <div class="">
                                                        <p><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                            </a></p>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"
                                                            class="deconnexion_text text-center">Se D??connecter</a>
                                                        <form action="{{ route('logout') }}" id="logout-form"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                                <hr>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body py-0">
                                        <div class="d-flex flex-row py-0 card_body_text">
                                            <a href="{{url('politique_confidentialite')}}" target="_blank">
                                                <p class="m-0">Politique de confidentialit??</p>
                                            </a>
                                            &nbsp;-&nbsp;
                                            <a href="{{route('condition_generale_de_vente')}}" target="_blank">
                                                <p class="m-0">Conditions d'utilisation</p>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-row py-0 card_body_text">
                                            <a href="{{url('contacts')}}" target="_blank">
                                                <p class="m-0">Contactez-nous</p>
                                            </a>
                                            &nbsp;-&nbsp;
                                            <a href="{{url('info_legale')}}" target="_blank">
                                                <p class="m-0">Informations l??gales</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            {{-- header --}}
            {{-- content --}}
            <div class="container-fluid content_body px-0 " style="padding-bottom: 1rem; padding-top: 4.5rem;">
                @yield('content')

            </div>
            {{-- content --}}
            {{-- footer --}}
            {{-- <div class="footer mt-5">
                <div class="container-fluid footer_all">
                    <div class="row w-100">
                        <div class="col-12">
                            <div class="container">
                                <div class="d-flex w-auto footer_one justify-content-center">
                                    <div class="footer_list me-2">
                                        <a href="#" class="mx-auto">
                                            <p>&copy;&nbsp;Copyright 2022 : Formation.mg</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Informations l??gales</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{url('contacts')}}" style="color: #801D62;text-decoration:none">
                                            <p>Contactez-nous</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{url('politique_confidentialite')}}" target="_blank">
                                            <p>Politique de confidentialit??</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{route('condition_generale_de_vente')}}"
                                            style="color:#801D68 !important" target="_blank">
                                            <p>Conditions d'utilisation</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Tarifs</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Cr??dits</p>
                                        </a>
                                    </div>
                                    <div class="footer_list_end ms-2 me-2 text-muted">
                                        <p>1.01</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="apprendre mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0 titre_apprendre"> Apprendre</p>
                    </div>
                    <div class="col text-end close" id="closeApprendre">
                        <!--<i class="bx bx-x " role="button" onclick="afficherTuto();"></i>-->
                        <i class="bx bx-x" role="button"></i>
                    </div>
                    <hr class="mt-2">
                    @can('isAdmin')
                    <div class="tutorielApprendreAdmin">Admin</div>
                    @endcan
                    @can('isCFP')
                    <div class="tutorielApprendreCfp">
                        <h5>Cr??er un nouveau projet de formation</h5>
                        <p class="m-0 p-1">
                            <span>Pour cr??er un nouveau de formation, il faut au pr??alable compl??ter les pr??requis
                                suivant :</span>
                        </p>
                        <div class="list-group list-group-flush" id="accordion">
                            <li class="list-group-item align-items-start ">
                                <a class="accordion-toggle d-flex justify-content-between listeApprendre"
                                    id="accApprCat" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                    href="#apprCat">
                                    <div class="ms-2 me-auto">
                                        <div class="text-sm">1. Avoir un catalogue de formation</div>
                                    </div>
                                    <span class="fas fa-angle-down"></span>
                                </a>
                                <div id="apprCat" class="collapse p-1">
                                    <hr>
                                    <a href="/nouveau_module"><span>Cliquer ici pour ajouter un module ?? votre catalogue
                                            de formation</span></a>
                                </div>
                            </li>
                            <li class="list-group-item  align-items-start">
                                <a class="accordion-toggle d-flex justify-content-between listeApprendre"
                                    id="accApprForm" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                    href="#apprFormateur">
                                    <div class="ms-2 me-auto">
                                        <div class="text-sm">2. Ajouter des formateurs</div>
                                    </div>
                                    <span class="fas fa-angle-down"></span>
                                </a>
                                <div id="apprFormateur" class="collapse  p-1">
                                    <hr>
                                    <a href="nouveau_formateur"><span>Cliquer ici pour ajouter un formateur</span></a>
                                </div>
                            </li>

                            <li class="list-group-item align-items-start listeApprendre">
                                <a class="accordion-toggle d-flex justify-content-between listeApprendre"
                                    id="accApprInter" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                    href="#apprInter">
                                    <div class="ms-2 me-auto">
                                        <div class=" text-sm">3. Collaborer avec les entreprises qui ont des projets en
                                            commun avec vous </div>
                                    </div>
                                    <span class="fas fa-angle-down"></span>
                                </a>
                                <div id="apprInter" class="collapse">
                                    <hr>
                                    <a href="/liste_entreprise"><span>Cliquer ici pour collaborer avec une
                                            entreprise</span></a>
                                </div>
                            </li>
                        </div>
                    </div>
                    <div class="tutorielApprendre"></div>
                    @endcan
                    @can('isStagiaire')
                    <div class="tutorielApprendreStagiaire">Stagiaire</div>
                    @endcan

                    @can('isReferent')
                    <div class="tutorielApprendreReferent">Referent</div>
                    @endcan

                    @can('isManager')
                    <div class="tutorielApprendreManager">Manager</div>
                    @endcan

                    @canany(['isFormateur','isFormateurInterne'])
                    <div class="tutorielApprendreFormateur">Formateur</div>
                    @endcanany
                    <!-- <h6 class="title_apprendre"><u>Annuaire</u></h6>
                        <h6 class="title_apprendre"><u>Agenda</u></h6> -->

                </div>
            </div>
            {{-- <div class="apprendre mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0 titre_apprendre">Apprendre</p>
                    </div>
                    <div class="col text-end close" id="close">
                        <!--<i class="bx bx-x " role="button" onclick="afficherTuto();"></i>-->
                        <i class="bx bx-x" role="button"></i>
                    </div>
                    <hr class="mt-2">
                    @can('isAdmin')
                    <div class="tutorielApprendreAdmin">Admin</div>
                    @endcan
                    @can('isCFP')
                    <div class="tutorielApprendreCfp">
                        <h5>Cr??er un nouveau projet de formation</h5>
                        <p class="m-0 p-1">
                            <span>Pour cr??er un nouveau de formation, il faut au pr??alable compl??ter les pr??requis
                                suivant :</span>
                        </p>
                        <ol class="list-group list-group-numbered list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">
                                <div class="ms-2 me-auto">
                                    <div class="text-sm">Avoir un catalogue de formation</div>
                                </div>
                                <button class="btn btn-light btn-sm apprCat" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#apprCat" aria-expanded="false" aria-controls="apprCat"><i
                                        class="fas fa-angle-down"></i></button>
                            </li>
                            <div id="apprCat" class="collapse p-2"><a href="/nouveau_module"><span>Cliquer ici pour
                                        ajouter un module ?? votre catalogue de formation</span></a></div>
                            <li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">
                                <div class="ms-2 me-auto">
                                    <div class="text-sm">Ajouter des formateurs</div>
                                </div>
                                <button class="btn btn-light btn-sm apprCat" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#apprFormateur" aria-expanded="false" aria-controls=""><i
                                        class="fas fa-angle-down"></i></button>
                            </li>
                            <div id="apprFormateur" class="collapse p-2"><a href="nouveau_formateur"><span>Cliquer ici
                                        pour ajouter un formateur</span></a></div>

                            <li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">
                                <div class="ms-2 me-auto">
                                    <div class=" text-sm">Collaborer avec les entreprises qui ont des projets en commun
                                        avec vous </div>
                                </div>
                                <button class="btn btn-light btn-sm apprCat " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#apprInter" aria-expanded="false" aria-controls="apprInter"><i
                                        class="fas fa-angle-down"></i></button>
                            </li>
                            <div id="apprInter" class="collapse p-2"><a href="liste_entreprise"><span>Cliquer ici pour
                                        collaborer avec une entreprise</span></a></div>
                    </div>
                    @endcan
                    @can('isStagiaire')
                    <div class="tutorielApprendreStagiaire">Stagiaire</div>
                    @endcan

                    @can('isReferent')
                    <div class="tutorielApprendreReferent">Referent</div>
                    @endcan

                    @can('isManager')
                    <div class="tutorielApprendreManager">Manager</div>
                    @endcan

                    @canany(['isFormateur','isFormateurInterne'])
                    <div class="tutorielApprendreFormateur">Formateur</div>
                    @endcanany
                    <!-- <h6 class="title_apprendre"><u>Annuaire</u></h6>
                        <h6 class="title_apprendre"><u>Agenda</u></h6> -->

                </div>
            </div>

        </div>
        {{-- footer --}}
    </div>

    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"
        integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"
        integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>  -->
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/apprendre.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">
        //Pour chaque div de classe randomColor
        $(".randomColor").each(function() {
        //On change la couleur de fond au hasard
        $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
        })

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }

        $(document).ready(function() {
            var pdp = "";
            $.ajax({
                url: '{{ route("profile_resp") }}'
                , type: 'get'
                , success: function(response) {
                    $('.badge_invitation').text("");
                    $('.badge_invitation').append(response['invitation'].length);

                    // var userData = JSON.parse(response);
                    // alert(JSON.stringify(response.length));
                    if(response['invitation'].length == 0){
                        // alert("eto");
                        var html = "Aucun invitations en attente";
                        $('.test_affiche1').append(html);
                        $('.test_affiche1').css('textAlign','center');

                    }else{
                        // alert("aiza");
                        for (let i = 0; i < response['invitation'].length; i++){
                            $('.test_affiche1').append('<li class="invitation_'+response['invitation'][i]['demmandeur_etp_id']+' text-center"><span class="me-2">'+response['invitation'][i]['nom_resp']+'</span><span class="me-2">'+response['invitation'][i]['prenom_resp']+'</span>|&nbsp;&nbsp;<span class="me-2">'+response['invitation'][i]['email_etp']+'</span>|&nbsp;&nbsp;<span class="me-2">'+response['invitation'][i]['nom_etp']+'</span>|&nbsp;&nbsp;<span>'+response['invitation'][i]['nom_secteur']+'</span> <span id="'+response['invitation'][i]['demmandeur_etp_id']+'" class="btn btn-sm accepte" title="accepter l\'invitation" role="button"><i class="bx bx-check-double bx_ajouter"></i></span> <span id="ref_'+response['invitation'][i]['demmandeur_etp_id']+'" class="btn refuse" title="refuser l\'invitation" role="button" data-id="'+response['invitation'][i]['demmandeur_etp_id']+'"><i class="bx bx-x bx_supprimer"></i></span></li>');

                            $(".accepte").on("click", function(e) {
                                let id = $(e.target).closest(".accepte").attr("id");
                                // alert(id);
                                $.ajax({
                                    type: "get",
                                    url: " {{ route('accept_invitation_cfp_etp_notif') }}",
                                    data: {
                                        Id: id,
                                    },
                                    success: function(response) {

                                        console.log(".invitation_" + id);
                                        $(".invitation_" + id).remove();
                                        $('.badge_invitation').text("");
                                        $('.badge_invitation').append(i);
                                        toastr.success('Une invitation a ??t?? acc??pt??e');
                                    },
                                    error: function(error) {
                                    console.log(error);
                                    },
                                });
                            });


                            $(".refuse").on("click", function(e) {
                                let id = $(this).data("id");
                                $.ajax({
                                    type: "get",
                                    url: " {{ route('annulation_cfp_etp_notif') }}",
                                    data: {
                                        Id: id,
                                    },
                                    success: function(response) {
                                        // alert("success");
                                        // console.log(".invitation_" + id);
                                        $(".invitation_" + id).remove();
                                        $('.badge_invitation').text("");
                                        $('.badge_invitation').append(i);
                                        toastr.warning('Une invitation ?? ??t?? r??fuser');
                                    },
                                    error: function(error) {
                                    console.log(error);
                                    },
                                });
                            });
                        }
                    }

                    if(response['photo'] == 'oui'){
                        var html = '<img src="{{asset(":?")}}" alt="user_profile" style="width : 70px; height : 70px; border: none; border-radius : 100%; display: grid; place-content: center">';
                        html = html.replace(":?", response['user']);
                        // alert(JSON.stringify(response));
                        $('.photo_users').append(html);

                    }
                    if(response['photo'] == 'non'){
                        var html = response['user'][0]['nm']+''+response['user'][0]['pr'];
                        $('.photo_users').append(html);
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });

         $(document).ready(function() {
            $.ajax({
                url: '{{ route("aff_refuse_etp_cfp") }}'
                , type: 'get'
                , success: function(response) {
                    if(response['refuse_invitation'].length == 0){
                        var html = 'Aucun invitations refus??e';
                        $('.test_affiche2').append(html);
                        $('.test_affiche2').css('textAlign','center');

                    }else{
                        // alert("aiza");
                        for (let i = 0; i < response['refuse_invitation'].length; i++){
                            $('.test_affiche2').append('<li class="invitation_'+response['refuse_invitation'][i]['demmandeur_etp_id']+' text-center"><span class="me-2">'+response['refuse_invitation'][i]['email_etp']+'</span>|&nbsp;&nbsp;<span class="me-2">'+response['refuse_invitation'][i]['nom_etp']+'</span>|&nbsp;&nbsp;<span>'+response['refuse_invitation'][i]['nom_secteur']+'</span></li>');
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });

        $('.prevent_affichage').on('click', function(e){
            e.stopPropagation();
        });

        $('.prevent_affichage2').on('click', function(e){
            e.stopPropagation();
        });

        // $(document).on('click', function(e) {
        //     var container = $("#box_profil");
        //     if ($(e.target).closest(container).length) {
        //         container.show();
        //     }
        // });
        // $(document).on('click', function(e) {
        //     var container = $("#box_profil");
        //     if (!$(e.target).closest(container).length) {
        //         container.hide();
        //     }
        // });

    </script>
</body>

</html>