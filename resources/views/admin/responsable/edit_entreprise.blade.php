












@extends('./layouts/admin')
@section('content')
<style>
   .input{
        width: 170px;
    }
.test {
    padding: 2px;
    border-radius: 5px;
    box-sizing: border-box;
    color: #9E9E9E;
    border: 1px solid #BDBDBD;
    font-size: 16px;
    letter-spacing: 1px;
    height: 50px !important
}

.test:focus{
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 2px solid #E53935 !important;
    outline-width: 0 !important;
}

.form-control-placeholder {
  position: absolute;
  top: 1rem;
  padding: 12px 2px 0 2px;
  padding: 0;
  padding-top: 2px;
  padding-bottom: 5px;
  transition: all 300ms;
  opacity: 0.5;
  left: 2rem;
}

.test:focus+.form-control-placeholder,
.test:valid+.form-control-placeholder {
  font-size: 95%;
  font-weight: bolder;
  top: 1.5rem;
  transform: translate3d(0, -100%, 0);
  opacity: 1;
  background-color: white;
  margin-left: 105px;

}
</style>
<center>                

<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Entreprise</p>
        <form   class="btn-submit" action="{{route('update_responsable')}}" method="post" enctype="multipart/form-data">
            @csrf
              
                    <input type="hidden" value="   {{ $ref->nom_resp }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
                  
                
                        <input type="hidden" class="form-control test input" value="   {{ $ref->prenom_resp }}"  name="prenom">
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Prénom</label>


                        <select hidden  value="{{$ref->sexe_resp}}" name="genre" class="form-select test input" id="genre"  >
                          <option value="{{$ref->sexe_resp}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>
                   
                
                        <input type="hidden" class="form-control test" name="date" value="{{ $ref->date_naissance_resp}}">
       
                          <input type="hidden" value="{{ $ref->cin_resp}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="{{ $ref->email_resp }}" >

                        <input type="hidden" class="form-control test"  name="phone" value="{{ $ref->telephone_resp }}"> 
                       
                       
                        <input type="hidden" class="form-control test input" value=""  name="password" placeholder="">  
                       
                      
                        <input type="hidden" class="form-control test input" id="lot" name="lot" placeholder="Lot" value="{{ $ref->adresse_lot}}">

                      
                          <input type="hidden" class="form-control test input" id="quartier" name="quartier" placeholder="Quartier" value="{{ $ref->adresse_quartier}}">


                  
               
                          <input type="hidden" class="form-control test input" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $ref->adresse_code_postal}}">
                 
               
                          <input type="hidden" class="form-control test input" id="ville" name="ville" placeholder="Ville" value="{{ $ref->adresse_ville}}">
                

                          <input type="hidden" class="form-control test input" id="region" name="region" placeholder="Region" value="{{ $ref->adresse_region}}">
                      
                    <input type="hidden" class="form-control input"  name="fonction" placeholder="Fonction" value="{{ $ref->fonction_resp}}" readonly>
                
            
                    <div class="row px-3 mt-4">
                        <div class="form-group mt-1 mb-1">
                    <input type="tesxt" class="form-control input"  name="entreprise"  value="{{ optional(optional($ref)->entreprise)->nom_etp}}" readonly>
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Entreprise</label>

                </div>
        </div> 
                    <input type="hidden" value="{{ $ref->poste_resp }}"  class="form-control"  name="poste"  readonly>
             
                 
                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($ref)->departement)->nom_departement }}" readonly>
            
                 
                   
<button style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center> 
</div>
</div>
</div>

@endsection








































