@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projets.css')}}">
<div class="container">
    <div class="row">
        <div class="row mb-4 mt-3">
            <div class="col-6">
                <h5>Nouvelle session de projet Inter</h5>
            </div>
            <div class="col-6 text-end">
                <div>
                    <a class="new_list_nouvelle " href="{{url()->previous()}}">
                    <span class="btn_precedent text-center"><i class='bx bxs-chevron-left me-1'></i>Précedent</span>
                </a>
                </div>
            </div>
        </div>
        <form action="{{ route('nouveau_session_inter',['type_formation'=>2]) }}" id="formPayement" method="POST"
            class="form_session p-2 m-0">
            @csrf
            <input type="hidden" name="module_id" value="{{$module_id}}">
            <div class="row">
                @if (Session::has('groupe_error'))
                    <div class="alert alert-danger ms-2 me-2">
                        <ul>
                            <li>{!! \Session::get('groupe_error') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <div class="row my-2">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"><span class="text-danger">* Champ obligatoire</span></div>
                        <div class="col-lg-4"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6 text-end mt-2"><span>Date debut de la session<strong
                                    class="text-danger">*</strong></span></div>
                        <div class="col-lg-6"><input type="date" id="date_debut" class="form-control input"
                                name="date_debut" style="width: 12rem;" required></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6 text-end mt-2"><span>Date fin de la session<strong
                                    class="text-danger">*</strong></span></div>
                        <div class="col-lg-6"><input type="date" id="min" class="form-control input"
                                name="date_fin" style="width: 12rem;" required></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6 text-end mt-2"><span>Modalité<strong class="text-danger">*</strong> </span>
                        </div>
                        <div class="col-lg-6 text-end">
                            <select class="form-select input_select" name="modalite" aria-label="Default select example"
                                style="width: 15rem;" required>
                                <option value="null">Sélectionnez</option>
                                <option value="Présentiel">Présentielle</option>
                                <option value="En ligne">En ligne</option>
                                <option value="Présentiel/En ligne">Présentiel/En ligne</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-6 text-end"><button type="submit" form="formPayement"
                            class="btn btn_enregistrer py-1"><i class='bx bx-check me-1'></i>Créer</button>
                        </div>
                        <div class="col-lg-6 text-start">
                            <a href="{{ route('nouveau_groupe_inter',[2]) }}"><button type="button" class="btn btn_annuler py-1"
                            data-dismiss="modal"><i class='bx bx-x me-1'></i>Annuler</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


</div>
<style>
    #annuler_session{
        margin-top: 6rem;
    }
</style>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>? --}}

{{-- <script src="{{asset('js/projet_inter_intra.js')}}"></script> --}}
<script>
    localStorage.setItem('activeTab', 'detail');
</script>
@endsection