@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification email</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<div class="col" style="margin-left: 25px">
  <a href="{{route('profil_referent')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp" ><i class="bx bxs-chevron-left me-1"></i> Retour</button></a>
</div>
<center>
 {{-- si l'utiliisateur a cliqué sur enregistrer en laissant des champs vides--}}
 @if (\Session::has('error_email'))
 <div class="alert alert-danger col-md-4">
     <ul>
         <li>{!! \Session::get('error_email') !!}</li>
     </ul>
 </div>
 @endif
<div class="col-lg-4">
    <div class="p-3 form-control">

        <form   class="btn-submit" action="{{route('update_mail_resp')}}" method="post" enctype="multipart/form-data">
            @csrf

                    <input type="hidden" value="   {{ $responsable->nom_resp }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}


                        <input type="hidden" class="form-control test input" value="   {{ $responsable->prenom_resp }}"  name="prenom">


                        {{-- <select hidden value="{{$responsable->sexe_resp}}" name="genre" class="form-select test input" id="genre"  >
                          <option value="{{$responsable->sexe_resp}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select> --}}


                        <input type="hidden" class="form-control test input" name="genre" value="{{ $responsable->genre_id}}">
                        <input type="hidden" class="form-control test input" name="date_naissance" value="{{ $responsable->date_naissance_resp}}">


                          <input type="hidden" value="{{ $responsable->cin_resp}}" class="form-control test input"  name="cin" >

                          <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                        <input type="email" class="form-control test input"  name="mail_resp" value="{{ $responsable->email_resp }}" >
                        <label class="ml-3 form-control-placeholder" style="">Email</label>

                    </div>
                </div>
                        <input type="hidden" class="form-control test"  name="phone" value="{{ $responsable->telephone_resp }}">
                        <input type="hidden" class="form-control test" value=""  name="password" placeholder="">
                          <input type="hidden" class="form-control test" id="lot" name="lot" placeholder="Lot" value="{{ $responsable->adresse_lot}}">



                          <input type="hidden" class="form-control test" id="quartier" name="quartier" placeholder="Quartier" value="{{ $responsable->adresse_quartier}}">


                          <input type="hidden" class="form-control test" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $responsable->adresse_code_postal}}">


                          <input type="hidden" class="form-control test" id="ville" name="ville" placeholder="Ville" value="{{ $responsable->adresse_ville}}">
                          <input type="hidden" class="form-control test" id="region" name="region" placeholder="Region" value="{{ $responsable->adresse_region}}">


                    <input type="hidden" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $responsable->fonction_resp}}" readonly>


                    <input type="hidden" class="form-control"  name="entreprise"  value="{{ optional(optional($responsable)->entreprise)->nom_etp}}" readonly>




                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($responsable)->departement)->nom_departement }}" readonly>



<button class="btn_enregistrer mt-1 btn modification "><i class="bx bx-check me-1"></i> Enregistrer</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>

@endsection