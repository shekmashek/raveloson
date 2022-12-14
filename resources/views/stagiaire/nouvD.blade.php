@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h2,label{
        font-weight: 400;
    }
    label{
        color: gray;
    }
    input{
        font-size: 12px;
    }
</style>
<div class="container shadow-sm mt-5 p-5">
    <div class="row">
         @if ($message = Session::get('success'))
            <div class="alert alert-primary" role="alert">
                <p style="text-align: center;" class="align-middle mt-2 p-1" >Demande envoyée!!</p>
            </div>
        @endif
        <div class="col-md-12">
            <div class="float-start">
                <h2>Fiche de demande de formation</h2>
            </div>
            <div class="float-end">
                <a href="/planFormation" class="btn btn-dark text-light"> <i class="fa-solid fa-caret-left"></i> &nbsp;Retour à la liste</a>
            </div>

        </div>
    </div>
    @foreach ($collaborateur as $c)
    <form action="{{route('plan.creation')}}" method="post">
        @csrf
        <div class="row">
                @foreach ($plan as $pl)
                    <h2>Années : {{$pl->AnneePlan}}</h2>
                    <input type="hidden" name="anneePlan_id" value="{{$pl->id}}">
                @endforeach
                <div class="col-md-6 mt-3">
                    <input type="hidden" name="stagiaire_id" value="{{$c->id}}">
                    <input type="hidden" name="entreprise_id" value="{{$entreprise_id}}">
                    <div class="input-groupe">
                        <label for="">Nom et prenoms du demandeur :</label>
                        <input type="text" class="form-control" value="{{$c->nom_stagiaire}}&nbsp;{{$c->prenom_stagiaire}}" disabled>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Email :</label>
                        <input type="text" class="form-control" value="{{$c->mail_stagiaire}}" disabled>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">domaine de formation :</label>
                        <select name="domaines_id" class="form-control" id="acf-domaine">
                            <option value="null" disable selected hidden>Choisissez la
                                domaine de formation ...</option>
                            @foreach ($domaine as $d)
                                <option value="{{$d->id}}" data-value="{{$d->nom_domaine}}">{{$d->nom_domaine}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">thematique du domaine :</label>
                        <select class="form-control select_formulaire categ categ input" id="acf-categorie" name="thematique_id" style="height: 40px;" required>
                        </select>
                        <p id="domaine_id_err" style="font-size: 14px;color:blue" >Choisissez une zone de formation, puis sélectionnez le thème du coparrainant.</p>
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Raison de la formation :</label>
                        <select name="objectif" id="" class="form-control">
                            <option value="">Adaptation au poste</option>
                            <option value="">Evolution dans l'empoi</option>
                            <option value="">Développement de competence</option>
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="input-groupe mt-3">
                        <label for="">date prévisionnelle</label>
                        <input type="month" name="date_previsionnelle" class="form-control" >
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Organisme sugére:</label>
                        <input type="text" name="organisme" class="form-control" >
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">durée de la formation formation:</label>
                        <input type="number" name="dure" class="form-control" >
                    </div>
                    <div class="input-groupe mt-2">
                        <label for="">Type de demande:</label>
                        <select name="t_dem" id="" class="form-control">
                            <option value="" selected hidden> Choisissez le type du demande</option>
                            <option value="Collectif">Collectif</option>
                            <option value="Individuel">Individuel</option>

                        </select>
                    </div>
                    <div class="input-groupe mt-4">
                        <label for="">Priorité:</label>
                        <select name="priorite" id="" class="form-control">
                            <option value="1 Peu critique" > 1 Peu critique</option>
                            <option value="2 Critique"> 2 Critique</option>
                            <option value="3 Trés critique">3 Trés critique</option>

                        </select>
                    </div>
                    <div class="input-groupe mt-3">
                        <label for="">Urgence:</label>
                    </div>
                    <div class="div mt-1" style="display: flex">
                        <input type="radio" class="mt-1" style="" name="type" value="urgent" id="type">&nbsp;&nbsp;<p class="m-2">Urgent</p>
                        <input type="radio" class="mt-1" style="margin-left:200px" value="non-urgent" name="type" id="type">&nbsp;&nbsp;<p class="m-2">Non urgent</p>
                    </div>
                <button type="submit" style="float: right" class="btn btn-info mt-4 text-light">Envoyer la demande</button>
                </div>

        </div>
    </form>
    @endforeach
</div>
<script>
    $("#acf-domaine").change(function() {
        var id = $(this).val();
        $(".categ").empty();
        // $(".categ").append(
        //     '<option value="null" disable selected hidden>Choisissez la catégorie de formation ...</option>'
        // );

        $.ajax({
            url: "/get_formation",
            type: "get",
            data: {
                id: id,
            },
            success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("domaine_id_err").innerHTML = "";
                    for (var $i = 0; $i < userData.length; $i++) {
                        $(".categ").append(
                            '<option value="' +
                                userData[$i].id +
                                '" data-value="' +
                                userData[$i].nom_formation +
                                '" >' +
                                userData[$i].nom_formation +
                                "</option>"
                            'input name="nom_formation" type="hidden" value="'+userData[$i].nom_formation +
                                '" data-value="' +
                                userData[$i].nom_formation +
                                '" >' +
                                userData[$i].nom_formation +
                            "</input>"
                        );
                    }
                } else {
                    document.getElementById("domaine_id_err").innerHTML =
                        "choisir le type de domaine valide pour avoir ses formations";
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    });
</script>
@endsection