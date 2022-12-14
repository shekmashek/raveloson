@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil du responsable de centre de formation</h3>
@endsection
@section('content')
<div class="page-content page-container" id="page-content">
    <div class="col" style="margin-left: 25px">
        <a href="{{route('affichage_parametre_cfp')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
    </div>
    @foreach ($liste_cfps as $cfp)


    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-2 m-r-2">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center">
                                <div class="m-b-25 mt-2">
                                    <div class="hover">
                                        <a href="{{ route('modification_logo_cfp',$cfp->id) }}">

                                    {{-- <img src="/dynamic-image/{{$cfp->logo}}" width="30%" height="30%"> --}}
                                        <img src="{{asset('images/CFP/'.$cfp->logo)}}" width="40%" height="30%">
                                        </a>
                                    </div>
                                </div>
                                <div class="hover" >
                                    <a href="{{ route('modification_nom_organisme',$cfp->id) }}">
                                     <h4 class="f-w-600 mt-5">{{$cfp->nom }}</h4>
                                    </a>
                                </div>
                                <p></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                <p></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                <div class="row">
                                    <div class="col">
                                        @canany(['isAdminPrincipale','isSuperAdminPrincipale'])
                                        <button class="btn btn_enregistrer my-2 edit_pdp_cfp" data-id="{{ $cfp->id }}" id="{{ $cfp->id }}" data-bs-toggle="modal" data-bs-target="#modal"> <i class="bx bxs-edit-alt"></i> modifier profile</button>
                                        @endcanany
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <div class="col-lg-12 text-center d-flex flex-column">
                                    <span style="font-size: 17px;"><i class='bx bx-money-withdraw'></i> Assujetti à la TVA</span>
                                    @if($cfp->assujetti_id == null)
                                    {{-- <a href="{{route('modification_assujetti_cfp',$cfp->id)}}"> --}}
                                        <p class="mt-2 text-primary text-decoration-underline">incomplète</p>
                                    </a>
                                    @elseif($cfp->assujetti_id == 1)
                                        {{-- <a href="{{route('modification_assujetti_cfp',$cfp->id)}}"> --}}
                                            <span class="mt-2 text-primary text-decoration-underline">Assujetti</span></a>
                                    @else
                                        {{-- <a href="{{route('modification_assujetti_cfp',$cfp->id)}}"> --}}
                                            <span class="mt-2 text-primary text-decoration-underline">Non assujetti</span></a>
                                    @endif
                                    <hr class="m-0 p-0 mt-0">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        {{-- <h6 class="m-b-20  f-w-600">Centre de formaton</h6> --}}
                                        {{-- <hr> --}}
                                        <p class="mt-3 m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Adresse</p>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                                            <a href="{{route('modification_adresse_organisme',$cfp->id)}}">
                                                <h6 class="text-muted f-w-400">
                                                    lot:
                                                    @if($cfp->adresse_lot==NULL)
                                                    <strong style="color: red">incomplète</strong>
                                                    @else
                                                    {{ $cfp->adresse_lot }}
                                                    @endif
                                                </h6>
                                            </a>
                                        </div>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                                            <a href="{{route('modification_adresse_organisme',$cfp->id)}}">
                                                <h6 class="text-muted f-w-400">
                                                    quartier:
                                                    @if($cfp->adresse_quartier==NULL)
                                                    <strong style="color: red">incomplète</strong>
                                                    @else
                                                    {{ $cfp->adresse_quartier }}
                                                    @endif
                                                </h6>
                                            </a>
                                        </div>

                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                                            <a href="{{route('modification_adresse_organisme',$cfp->id)}}">
                                                <h6 class="text-muted f-w-400">
                                                    ville:
                                                    @if($cfp->adresse_ville==NULL)
                                                    <strong style="color: red">incomplète</strong>
                                                    @else
                                                    {{ $cfp->adresse_ville }}
                                                    @endif
                                                </h6>
                                            </a>
                                        </div>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                                            <a href="{{route('modification_adresse_organisme',$cfp->id)}}">
                                                <h6 class="text-muted f-w-400">
                                                    region:
                                                    @if($cfp->adresse_region==NULL)
                                                    <strong style="color: red">incomplète</strong>
                                                    @else
                                                    {{ strtoupper($cfp->adresse_region) }}
                                                    @endif
                                                </h6>
                                            </a>
                                        </div>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">

                                                 <p class="m-b-10 m-t-2 f-w-600"><i class="bx bx-envelope"></i>&nbsp;Email</p>
                                        <a href="{{ route('modification_email',$cfp->id) }}">

                                                 <h6 class="text-muted f-w-400">{{ $cfp->email }}</h6>
                                        </a>
                                        </div>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">

                                                <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                        <a href="{{ route('modification_telephone',$cfp->id) }}">

                                                <h6 class="text-muted f-w-400">{{ $cfp->telephone }}</h6>
                                        </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">

                                        <p class="mt-3 m-b-10 f-w-600"><i class="bx bxs-calendar"></i>&nbsp; Horaire d'ouverture</p>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                                            <a href="{{route('modification_horaire',$cfp->id)}}">
                                                <h6 class="text-muted f-w-400">
                                                    @if ($horaire==NULL)
                                                        <strong style="color: red">incomplète</strong>
                                                    @else
                                                        @for ($i = 0;$i < count($horaire);$i++)
                                                            {{ $horaire[$i]->jours}} : @php echo (date('H:i', strtotime($horaire[$i]->h_entree))." - ".date('H:i', strtotime($horaire[$i]->h_sortie))) @endphp <br>
                                                        @endfor
                                                    @endif
                                                </h6>
                                            </a>
                                        </div>

                                        <p class="m-b-10 f-w-600"><i class="bx bxs-graduation"></i>&nbsp; Slogan</p>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                                            <a href="{{route('modification_slogan',$cfp->id)}}">
                                                <h6 class="text-muted f-w-400">
                                                    @if ($cfp->slogan==NULL)
                                                    <strong style="color: red">incomplète</strong>
                                                    @else
                                                    {{ $cfp->slogan }}
                                                    @endif
                                                </h6>
                                            </a>
                                        </div>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                                            <a href="{{route('modification_site_web',$cfp->id)}}">
                                                <p class="m-b-10 f-w-600"><i class="fa fa-globe"></i>&nbsp; Site web officiel</p>
                                                <h6 class="text-muted f-w-400">
                                                    @if ($cfp->site_web==NULL)
                                                    <strong style="color: rgb(202, 98, 98)">incomplète</strong>
                                                    @else
                                                    {{ $cfp->site_web }}
                                                    @endif
                                                </h6>
                                            </a>
                                        </div>
                                        <div class="hover" style="border-bottom: solid 1px #e8dfe5;">

                                                <p class="m-b-10 f-w-600"><i class="fa fa-globe"></i>&nbsp; Réseaux sociaux</p>
                                                 <h6 class="text-muted f-w-400">
                                                        @if($reseaux_sociaux == null)
                                                            <a href="{{route('lien_facebook',$cfp->id)}}">Facebook :  <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                            <a href="{{route('lien_twitter',$cfp->id)}}">Twitter :   <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                            <a href="{{route('lien_instagram',$cfp->id)}}">  Instagram :   <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                            <a href="{{route('lien_linkedin',$cfp->id)}}"> Linkedin : <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                        @else
                                                            @if ($reseaux_sociaux[0]->lien_facebook==null)
                                                                <a href="{{route('lien_facebook',$cfp->id)}}">Facebook :  <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                            @else
                                                                <a href="{{route('lien_facebook',$cfp->id)}}">Facebook : {{$reseaux_sociaux[0]->lien_facebook}}<br></a>
                                                            @endif
                                                            @if ($reseaux_sociaux[0]->lien_twitter==null)
                                                                <a href="{{route('lien_twitter',$cfp->id)}}">Twitter :   <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                            @else
                                                                <a href="{{route('lien_twitter',$cfp->id)}}">Twitter : {{$reseaux_sociaux[0]->lien_twitter}}<br></a>
                                                            @endif
                                                            @if ($reseaux_sociaux[0]->lien_instagram==null)
                                                                <a href="{{route('lien_instagram',$cfp->id)}}">  Instagram :   <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                            @else
                                                                <a href="{{route('lien_instagram',$cfp->id)}}">Instagram : {{$reseaux_sociaux[0]->lien_instagram}}<br></a>
                                                            @endif
                                                            @if ($reseaux_sociaux[0]->lien_linkedin==null)
                                                                <a href="{{route('lien_linkedin',$cfp->id)}}">  Linkedin :   <strong style="color: rgb(202, 98, 98)">incomplète</strong> <br></a>
                                                            @else
                                                                <a href="{{route('lien_linkedin',$cfp->id)}}"> Linkedin : {{$reseaux_sociaux[0]->lien_linkedin}}<br></a>
                                                            @endif
                                                        @endif

                                                    </h6>


                                        </div>
                                    </div>

                                </div>

                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div id="modal" class="modal fade" data-backdrop="true"> --}}
    <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title text-md">
                        <h6>Modification des informations pour</h6>
                        <h5><strong>{{$cfp->nom}}</strong></h5>

                    </div>
                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form action="{{ route('utilisateur_update_cfp',$cfp->id) }}" id="formPayement" method="POST">
                        @csrf
                        {{-- <h6 class="text-uppercase">Payment details</h6> --}}
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bxs-graduation"></i>&nbsp; Raison sociale<strong style="color:red">*</strong> </span>
                            <input autocomplete="off" type="text" name="nom_cfp" class="form-control formPayement" required="required" value="{{$cfp->nom}}">

                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bxs-graduation"></i>&nbsp; Domaine de formation<strong style="color:red">*</strong> </span>
                            <textarea autocomplete="off" required class="form-control" id="exampleFormControlTextarea1" rows="3" name="domaine_cfp"></textarea>
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;NIF<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="nif_cfp" class="form-control formPayement" required="required" value="{{$cfp->nif}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;STAT<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="stat_cfp" class="form-control formPayement" required="required" value="{{$cfp->stat}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;CIF<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="cif_cfp" class="form-control formPayement" required="required" value="{{$cfp->cif}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;RCS<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="rcs_cfp" class="form-control formPayement" required="required" value="{{$cfp->rcs}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-envelope"></i>&nbsp;Email<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="email" name="email_cfp" class="form-control formPayement" required="required" value="{{$cfp->email}}">
                        </div>

                        <div class="inputbox inputboxP mt-3">
                            <span><i class="bx bx-phone"></i>&nbsp;Téléphone<strong style="color:#ff0000;">*</strong></span>
                            <input autocomplete="off" type="text" name="telephone_cfp" class="form-control formPayement" required="required" value="{{$cfp->telephone}}"> </div>
                        @if ($cfp->site_web!=NULL)
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="fa fa-globe"></i>&nbsp; Site web officiel</span>
                            <input autocomplete="off" type="text" name="site_web" class="form-control formPayement" required="required" value="{{$cfp->site_web}}"> </div>

                        @else
                        <div class="inputbox inputboxP mt-3">
                            <span><i class="fa fa-globe"></i>&nbsp; Ajouter un site web officiel</span>
                            <input autocomplete="off" type="text" name="site_web" class="form-control formPayement" required="required"> </div>

                        @endif


                        <div class="inputbox inputboxP mt-3">
                            <span>Lot<strong style="color:#ff0000;">*</strong></span>
                            <input type="text" name="adresse_lot" class="form-control formPayement" required="required" value="{{$cfp->adresse_lot}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span>Quartier<strong style="color:#ff0000;">*</strong></span>
                            <input type="text" name="adresse_quartier" class="form-control formPayement" required="required" value="{{$cfp->adresse_quartier}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span>Ville<strong style="color:#ff0000;">*</strong></span>
                            <input type="text" name="adresse_ville" class="form-control formPayement" required="required" value="{{$cfp->adresse_ville}}">
                        </div>
                        <div class="inputbox inputboxP mt-3">
                            <span>Région<strong style="color:#ff0000;">*</strong></span>
                            <input type="text" name="adresse_region" class="form-control formPayement" required="required" value="{{$cfp->adresse_region}}">
                        </div>
                        <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
                        <div class="mt-4 mb-4">
                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                <button type="submit" form="formPayement" class="btn btn_enregistrer">Valider</button> </div>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- fin --}}


    @endforeach
</div>


@endsection
