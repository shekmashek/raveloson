<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('js/facture.js')}}"></script>
<script type="text/javascript">
    function Unite(nombre) {
        var unite;
        switch (nombre) {
            case 0:
                unite = "zéro";
                break;
            case 1:
                unite = "un";
                break;
            case 2:
                unite = "deux";
                break;
            case 3:
                unite = "trois";
                break;
            case 4:
                unite = "quatre";
                break;
            case 5:
                unite = "cinq";
                break;
            case 6:
                unite = "six";
                break;
            case 7:
                unite = "sept";
                break;
            case 8:
                unite = "huit";
                break;
            case 9:
                unite = "neuf";
                break;
        } //fin switch
        return unite;
    } //-----------------------------------------------------------------------

    function Dizaine(nombre) {
        switch (nombre) {
            case 10:
                dizaine = "dix";
                break;
            case 11:
                dizaine = "onze";
                break;
            case 12:
                dizaine = "douze";
                break;
            case 13:
                dizaine = "treize";
                break;
            case 14:
                dizaine = "quatorze";
                break;
            case 15:
                dizaine = "quinze";
                break;
            case 16:
                dizaine = "seize";
                break;
            case 17:
                dizaine = "dix-sept";
                break;
            case 18:
                dizaine = "dix-huit";
                break;
            case 19:
                dizaine = "dix-neuf";
                break;
            case 20:
                dizaine = "vingt";
                break;
            case 30:
                dizaine = "trente";
                break;
            case 40:
                dizaine = "quarante";
                break;
            case 50:
                dizaine = "cinquante";
                break;
            case 60:
                dizaine = "soixante";
                break;
            case 70:
                dizaine = "soixante-dix";
                break;
            case 80:
                dizaine = "quatre-vingt";
                break;
            case 90:
                dizaine = "quatre-vingt-dix";
                break;
        } //fin switch
        return dizaine;
    }

    function NumberToLetter(nombre) {
        var i, j, n, quotient, reste, nb;
        var ch
        var numberToLetter = '';
        //__________________________________

        if (nombre.toString().replace(/ /gi, "").length > 15) return "dépassement de capacité";
        if (isNaN(nombre.toString().replace(/ /gi, ""))) return "Nombre non valide";

        nb = parseFloat(nombre.toString().replace(/ /gi, ""));
        if (Math.ceil(nb) != nb) return "Nombre avec virgule non géré.";

        n = nb.toString().length;
        switch (n) {
            case 1:
                numberToLetter = Unite(nb);
                break;
            case 2:
                if (nb > 19) {
                    quotient = Math.floor(nb / 10);
                    reste = nb % 10;
                    if (nb < 71 || (nb > 79 && nb < 91)) {
                        if (reste == 0) numberToLetter = Dizaine(quotient * 10);
                        if (reste == 1) numberToLetter = Dizaine(quotient * 10) + "-et-" + Unite(reste);
                        if (reste > 1) numberToLetter = Dizaine(quotient * 10) + "-" + Unite(reste);
                    } else numberToLetter = Dizaine((quotient - 1) * 10) + "-" + Dizaine(10 + reste);
                } else numberToLetter = Dizaine(nb);
                break;
            case 3:
                quotient = Math.floor(nb / 100);
                reste = nb % 100;
                if (quotient == 1 && reste == 0) numberToLetter = "cent";
                if (quotient == 1 && reste != 0) numberToLetter = "cent" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = Unite(quotient) + " cents";
                if (quotient > 1 && reste != 0) numberToLetter = Unite(quotient) + " cent " + NumberToLetter(reste);
                break;
            case 4:
                quotient = Math.floor(nb / 1000);
                reste = nb - quotient * 1000;
                if (quotient == 1 && reste == 0) numberToLetter = "mille";
                if (quotient == 1 && reste != 0) numberToLetter = "mille" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " mille";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
                break;
            case 5:
                quotient = Math.floor(nb / 1000);
                reste = nb - quotient * 1000;
                if (quotient == 1 && reste == 0) numberToLetter = "mille";
                if (quotient == 1 && reste != 0) numberToLetter = "mille" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " mille";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
                break;
            case 6:
                quotient = Math.floor(nb / 1000);
                reste = nb - quotient * 1000;
                if (quotient == 1 && reste == 0) numberToLetter = "mille";
                if (quotient == 1 && reste != 0) numberToLetter = "mille" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " mille";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
                break;
            case 7:
                quotient = Math.floor(nb / 1000000);
                reste = nb % 1000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un million";
                if (quotient == 1 && reste != 0) numberToLetter = "un million" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " millions";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
                break;
            case 8:
                quotient = Math.floor(nb / 1000000);
                reste = nb % 1000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un million";
                if (quotient == 1 && reste != 0) numberToLetter = "un million" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " millions";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
                break;
            case 9:
                quotient = Math.floor(nb / 1000000);
                reste = nb % 1000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un million";
                if (quotient == 1 && reste != 0) numberToLetter = "un million" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " millions";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
                break;
            case 10:
                quotient = Math.floor(nb / 1000000000);
                reste = nb - quotient * 1000000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un milliard";
                if (quotient == 1 && reste != 0) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " milliards";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
                break;
            case 11:
                quotient = Math.floor(nb / 1000000000);
                reste = nb - quotient * 1000000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un milliard";
                if (quotient == 1 && reste != 0) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " milliards";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
                break;
            case 12:
                quotient = Math.floor(nb / 1000000000);
                reste = nb - quotient * 1000000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un milliard";
                if (quotient == 1 && reste != 0) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " milliards";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
                break;
            case 13:
                quotient = Math.floor(nb / 1000000000000);
                reste = nb - quotient * 1000000000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un billion";
                if (quotient == 1 && reste != 0) numberToLetter = "un billion" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " billions";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
                break;
            case 14:
                quotient = Math.floor(nb / 1000000000000);
                reste = nb - quotient * 1000000000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un billion";
                if (quotient == 1 && reste != 0) numberToLetter = "un billion" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " billions";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
                break;
            case 15:
                quotient = Math.floor(nb / 1000000000000);
                reste = nb - quotient * 1000000000000;
                if (quotient == 1 && reste == 0) numberToLetter = "un billion";
                if (quotient == 1 && reste != 0) numberToLetter = "un billion" + " " + NumberToLetter(reste);
                if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " billions";
                if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
                break;
        } //fin switch
        /*respect de l'accord de quatre-vingt*/
        if (numberToLetter.substr(numberToLetter.length - "quatre-vingt".length, "quatre-vingt".length) == "quatre-vingt") numberToLetter = numberToLetter + "s";

        return numberToLetter;
    }

    function getCalcule() {
        var qte = document.getElementsByName("qte[]");
        var facture = document.getElementsByName("facture[]");
        var totale_facture = document.getElementsByName("totale_facture[]");
        var remise = document.getElementById("remise");
        var type_remise = document.getElementById("type_remise_id");
        var total_remise = document.getElementById("total_remise");
        var montant_frais_annexe = document.getElementsByName("montant_frais_annexe[]");
        var totale_frais_annexe = document.getElementsByName("totale_frais_annexe[]");
        var qte_annexe = document.getElementsByName("qte_annexe[]");
        var calc_re = 0;

        var totale_facture_ht = document.getElementById("totale_facture_ht");
        var totale_facture_ttc = document.getElementById("totale_facture_ttc");
        var taxe_value = document.getElementById("taxe_value");
        var taxe = document.getElementById("taxe");

        var chiffre_convert_letter = document.getElementById("chiffre_convert_letter");

        var calc_taxe = 0;
        var totale = 0;
        var totale_annexe = 0;
        var ensemble = 0;
        for (var i = 0; i < facture.length; i += 1) {
            var sum = facture[i].value * qte[i].value;
            totale_facture[i].innerHTML = sum;
            totale_facture[i].innerHTML = totale_facture[i].innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

            /*     totale_facture[i].innerHTML = number_format(sum, 0, ",", " "); */
            totale += sum;
        }

        for (var j = 0; j < montant_frais_annexe.length; j += 1) {
            var sum_annexe = qte_annexe[j].value * montant_frais_annexe[j].value;
            totale_annexe += sum_annexe;
            totale_frais_annexe[j].innerHTML = sum_annexe;
            totale_frais_annexe[j].innerHTML = totale_frais_annexe[j].innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();
        }

        ensemble = totale + totale_annexe;
        ensemble = Math.ceil(ensemble);
        totale_facture_ht.innerHTML = ensemble;
        totale_facture_ht.innerHTML = totale_facture_ht.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();
        $('#valeur_brute').append(totale_facture_ht.innerHTML);
        if (type_remise.value == 1) { // MGA
            calc_re = remise.value;
            calc_re = Math.ceil(calc_re);
            total_remise.innerHTML = "-" + calc_re;
        }
        if (type_remise.value == 2) { // %
            calc_re = (ensemble * remise.value) / 100;
            calc_re = Math.ceil(calc_re);
            total_remise.innerHTML = "-" + calc_re;
        }
        total_remise.innerHTML = total_remise.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

        if (taxe_value.value > 0) {
            calc_taxe = (ensemble * taxe_value.value) / 100;
        }
        calc_taxe = Math.ceil(calc_taxe);
        taxe.innerHTML = calc_taxe;
        taxe.innerHTML = taxe.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

        //TTC = TAXE+MONTANT_total-remise
        totale_facture_ttc.innerHTML = (ensemble - calc_re + calc_taxe);
        totale_facture_ttc.innerHTML = totale_facture_ttc.innerHTML.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim();

        var oke = (ensemble - calc_re + calc_taxe);
        chiffre_convert_letter.innerHTML = NumberToLetter(oke);

    }
    /*=========================================================*/
    $(document).on("keyup change", "#invoice_date", function() {
        document.getElementById("due_date").setAttribute("min", $(this).val());
    });


    function number_format(number, decimals, decPoint, thousandsSep) {
        decimals = decimals || 0;
        number = parseFloat(number);

        if (!decPoint || !thousandsSep) {
            decPoint = '.';
            thousandsSep = ',';
        }

        var roundedNumber = Math.round(Math.abs(number) * ('1e' + decimals)) + '';
        var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
        var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
        var formattedNumber = "";

        while (numbersString.length > 3) {
            formattedNumber += thousandsSep + numbersString.slice(-3)
            numbersString = numbersString.slice(0, -3);
        }

        return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
    }


    $(document).ready(function() {

        var total_frais_annexe_possible = ($(".row #inputFormRow").length + 1);
        if (total_frais_annexe_possible < 1) {
            $(".titre_annexe").css("display", "none");

        } else {
            $(".titre_annexe").css("display", "inline-block");
        }

        $(".changer_carret").on("click", function() {
            if (
                $(this)
                .find(".carret-icon")
                .hasClass("bx-caret-down")
            ) {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-down")
                    .addClass("bx-caret-up");
            } else {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-up")
                    .addClass("bx-caret-down");
            }
        });

        $(".changer_carret2").on("click", function() {
            if (
                $(this)
                .find(".carret-icon")
                .hasClass("bx-caret-down")
            ) {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-down")
                    .addClass("bx-caret-up");
            } else {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-up")
                    .addClass("bx-caret-down");
            }
        });


    });




    // ========= show facture existe déjà
    $(document).on("keyup change", "#num_facture", function() {
        /* $(document).on('change', '#num_facture', function() { */
        var num_facture = $(this).val();
        $.ajax({
            url: '{{route("verifyFacture")}}'
            , type: 'get'
            , data: {
                num_facture: num_facture
            }
            , success: function(response) {
                var userData = response;
                if (userData.length > 0) {
                    document.getElementById("num_facture_err").innerHTML = "le numero de la facture a été déjà utilisé! merci";
                } else {
                    document.getElementById("num_facture_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    // ========= show reference bon de commande existe déjà
    /*
        $(document).on('keyup change', '#reference_bc', function() {
            var reference_bc = $(this).val();
            $.ajax({
                url: '{{route("verifyReferenceBC")}}'
                , type: 'get'
                , data: {
                    reference_bc: reference_bc
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("reference_bc_err").innerHTML = "Reference Bon de commande est déjà utiliser!";
                    } else {
                        document.getElementById("reference_bc_err").innerHTML = "";
                    }

                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });
    */
    // ======== show entreprise
    $(document).on('change', '#entreprise_id', function() {
        $("#projet_id").empty();
        $(".session_id").empty();

        var id = $(this).val();
        var prj_id = 0;
        $.ajax({
            url: 'projetFacturer'
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response.projet;
                var etp = response.entreprise;
                var taxe = response.taxes;
                document.getElementById("taxe_name").innerHTML = taxe.description + "(" + taxe.pourcent + " %)";
                document.getElementById("taxe_value").value = taxe.pourcent;
                /*  console.log(document.getElementById("taxe_value").value);
                 */
                if (etp != null) {
                    document.getElementById("nom_etp_detail").innerHTML = "" + etp.nom_etp;
                    document.getElementById("adresse_etp").innerHTML = "" + etp.adresse_rue + "&nbsp;" + etp.adresse_quartier + " <br> " + etp.adresse_ville + "&nbsp;" + etp.adresse_code_postal + " <br> " + etp.adresse_region;
                    document.getElementById("tel_etp").innerHTML = "" + etp.telephone_etp;
                    document.getElementById("mail_etp").innerHTML = "" + etp.email_etp;
                    document.getElementById("site_etp").innerHTML = "" + etp.site_etp;
                    document.getElementById("info_légale_etp").innerHTML = "NIF: " + etp.nif + " &nbsp; STAT: " + etp.stat + " &nbsp; <br> RCS: " + etp.rcs + " &nbsp; CIF: " + etp.cif;

                    if (userData.length <= 0) {
                        document.getElementById("projet_id_err").innerHTML = "Aucun projet a été détecter";

                    } else {
                        document.getElementById("projet_id_err").innerHTML = "";
                        for (var $i = 0; $i < (userData.length); $i++) {
                            $("#projet_id").append('<option value="' + userData[$i].projet_id + '">' + userData[$i].nom_projet + ' (' + userData[$i].pourcent_facturer + '% facturé)</option>');
                        }
                        prj_id = $("#projet_id").val();

                        if (id != null && prj_id != null) {
                            $.ajax({
                                url: "{{route('groupe_projet')}}"
                                , type: 'get'
                                , data: {
                                    id: prj_id
                                    , entreprise_id: id
                                }
                                , success: function(response2) {
                                    var userData2 = response2;
                                    $("#addRowMontant").val(userData2.length);
                                    if ($("#addRowMontant").val() > 1) {
                                        $("#addRowMontant").css("display", "inline-block");
                                    } else {
                                        $("#addRowMontant").css("display", "none");
                                    }
                                    if (userData2.length > 0) {
                                        for (var $i = 0; $i < userData2.length; $i++) {
                                            $(".session_id").append('<option value="' + userData2[$i].groupe_entreprise_id + '/'+ userData2[$i].groupe_id+'">' + userData2[$i].nom_formation + '/ ' + userData2[$i].nom_module + '/ ' + userData2[$i].reference + "/ " + userData2[$i].nom_groupe + '</option>');
                                        }
                                        document.getElementById("session_id_err").innerHTML = "";
                                    } else {
                                        document.getElementById("session_id_err").innerHTML = "Aucun session a été détecter";
                                    }
                                }
                            });

                            $.ajax({
                                url: "{{route('groupe_projet')}}"
                                , type: 'get'
                                , data: {
                                    id: prj_id
                                    , entreprise_id: id
                                }
                                , success: function(response2) {

                                    var userData2 = response2;
                                    if (userData2.length > 0) {
                                        for (var $i = 0; $i < userData2.length - userData2.length; $i++) {
                                            $("#session_id").append('<option value="' + userData2[$i].groupe_entreprise_id + '">' + userData2[$i].nom_groupe + '</option>');
                                            document.getElementById("module_id_ref").innerHTML = "" + userData2[$i].nom_formation + '/' + userData2[$i].nom_module + '/' + userData2[$i].reference;
                                        }
                                        document.getElementById("session_id_err").innerHTML = "";
                                    } else {
                                        document.getElementById("module_id_ref").innerHTML = "";
                                        document.getElementById("session_id_err").innerHTML = "Aucun session a été détecter";
                                    }

                                }
                            });
                        }
                    }

                } else {
                    document.getElementById("nom_etp").innerHTML = "";
                    document.getElementById("adresse_etp").innerHTML = "";
                    document.getElementById("tel_etp").innerHTML = "";
                    document.getElementById("mail_etp").innerHTML = "";
                    document.getElementById("site_etp").innerHTML = "";
                }


            }
            , error: function(error) {
                console.log(error);
            }
        });

    });



    // ======== show session
    $(document).on('change', '#projet_id', function() {
        $(".session_id").empty();

        var prj_id = $(this).val();
        var entreprise_id = $("#entreprise_id").val();
        $.ajax({
            url: "{{route('groupe_projet')}}"
            , type: 'get'
            , data: {
                id: prj_id
                , entreprise_id: entreprise_id
            }
            , success: function(response2) {
                var userData2 = response2;
                $("#addRowMontant").val(userData2.length);
                if ($("#addRowMontant").val() > 1) {
                    $("#addRowMontant").css("display", "inline-block");
                } else {
                    $("#addRowMontant").css("display", "none");
                }
                if (userData2.length > 0) {
                    for (var $i = 0; $i < userData2.length; $i++) {
                        $(".session_id").append('<option value="' + userData2[$i].groupe_entreprise_id + '/'+ userData2[$i].groupe_id+'">' + userData2[$i].nom_formation + '/ ' + userData2[$i].nom_module + '/ ' + userData2[$i].reference + "/ " + userData2[$i].nom_groupe + '</option>');
                    }
                    document.getElementById("session_id_err").innerHTML = "";
                } else {
                    document.getElementById("session_id_err").innerHTML = "Aucun session a été détecter";
                }
            }
        });

    });


    // add row
    $(document).on('click', '#addRow', function() {

        var test = ($(".row #inputFormRow").length + 1);
        if (test < 1) {
            $("#titres_services_annexe").css("display", "none");
        } else {
            $("#titres_services_annexe").css("display", "flex");
        }

        $('#frais').empty();
        $.ajax({
            url: "{{route('frais_annexe')}}"
            , type: 'get'
            , success: function(response) {
                var userData = response;
                $("#addRow").val(userData.length);
                var total_frais_annexe_possible = ($(".row #inputFormRow").length + 1);
                if ($("#addRow").val() > 1) {
                    $("#addRow").css("display", "inline-block");
                } else {
                    $("#addRow").css("display", "none");
                }
                if (total_frais_annexe_possible < ($("#addRow").val() + 1)) {
                    $("#addRow").css("display", "inline-block");
                    for (var $i = 0; $i < userData.length; $i++) {
                        $("#frais").append('<option value="' + userData[$i].id + '">' + JSON.stringify(userData[$i].description) + '</option>');
                    }

                    var html = '';
                    html += '<div class="row mt-3" id="inputFormRow">';
                    html += '<div class="col-3">';
                    html += '<select class="form-select selectP input_section4"  id="frais_annexe_id[]" name="frais_annexe_id[]" required>';

                    for (var $i = 0; $i < userData.length; $i++) {
                        html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                    }
                    html += '</select>';
                    html += '</div>';

                    html += '<div class="col-4">';
                    html += '  <textarea name="description_annexe[]" autocomplete="off" id="description_annexe[]" class="text_description form-control" placeholder="déscription du frais annexe"></textarea>';
                    html += '</div>';

                    html += '<div class="col-1">';
                    html += '<input type="number" min="1" value="1" autocomplete="off" required class="form-control input_quantite annexe_qte" name="qte_annexe[]" id="qte_annexe[]">';
                    html += '</div>';


                    html += '<div class="col-2">';
                    html += '<input type="number" min="0" value="0" autocomplete="off" required name="montant_frais_annexe[]" class="somme_totale_montant form-control input_quantite2 frais_annexe" id="montant_frais_annexe[]" placeholder="0">';
                    html += '</div>';

                    html += '<div class="col-1 text-end pe-0">';
                    html += '<p name="totale_frais_annexe[]" class="text_prix" align="right">0</p>';
                    html += '</div>';

                    html += '<div class="col-1 text-start pt-2">';
                    html += '<button id="removeRow" type="button" class="btn icon_suppre_frais "><i class="fa fa-trash suppre_frais"></i></button></p>';
                    html += '</div>';
                    html += '</div>';

                    $('#newRow').append(html);


                    if (total_frais_annexe_possible >= ($("#addRow").val())) {
                        $("#addRow").css("display", "none");
                    }
                } else {
                    $("#addRow").css("display", "none");
                }


            }
            , error: function(error) {
                console.log(error);
            }
        });

    });


    $(document).on("keyup change", ".services_factures", function() {
        getCalcule();
    });
    /*
        $(document).on("change", ".services_factures", function() {
            getCalcule();
        });

        $(document).on("click", ".services_factures", function() {
            getCalcule();
        });
    */
    // ============================ Montant=========================

    $(document).on('click', '#addRowMontant', function() {
        $('#montant').empty();
        var id = $("#projet_id").val();
        var etp_id = $("#entreprise_id").val();

        $total_session_possible = ($(".row #inputFormRowMontant").length + 1);
        if ($total_session_possible < ($("#addRowMontant").val())) {
            $("#addRowMontant").css("display", "inline-block");
            $.ajax({
                url: "{{route('groupe_projet')}}"
                , type: 'get'
                , data: {
                    id: id
                    , entreprise_id: etp_id
                }
                , success: function(response) {
                    var userData = response;
                    var html = '';
                    html += '<div class="row mt-2" id="inputFormRowMontant">';
                    html += '<div class="col-2">';
                    html += '</div>';
                    html += '<div class="col-3">';
                    html += '<select class="form-select selectP input_section4"  id="session_id[]" name="session_id[]" required>';
                    for (var $i = 0; $i < userData.length; $i++) {
                        html += '<option value="' + userData[$i].groupe_entreprise_id+'/'+ userData[$i].groupe_id+'">' + userData[$i].nom_formation + '/ ' + userData[$i].nom_module + '/ ' + userData[$i].reference + '/ ' + userData[$i].nom_groupe + '</option>';
                    }
                    html += '</select>';
                    html += '</div>';
                    html += '<div class="col-1">';
                    html += '<input type="number" min="1" value="1" autocomplete="off" required class="form-control input_quantite" name="qte[]" id="qte[]">';
                    html += '</div>';
                    html += '<div class="col-2">';
                    html += '<input type="text" name="description[]" autocomplete="off" id="description[]" placeholder=" ex: personne ou groupe ou etc" class="form-control qte input_quantite" required>';
                    html += '</div>';
                    html += '<div class="col-2">';
                    html += '<input type="number" min="0" value="0" autocomplete="off" required name="facture[]" class="somme_totale_montant form-control input_quantite2 montant_session_facture" id="facture[]" placeholder="0">';
                    html += '</div>';
                    html += '<div class="col-1 text-end pe-0">';
                    html += '<p name="totale_facture[]" class="text_prix" align="right">0</p>';
                    html += '</div>';
                    html += '<div class="col-1 text-start pt-2">';
                    html += '<button id="removeRowMontant" type="button" class="btn icon_suppre_frais "><i class="fa fa-trash"></i></button></span></p>';
                    html += '</div>';
                    html += '</div>';
                    $('#newRowMontant').append(html);
                }
                , error: function(error) {
                    console.log(error);
                }
            });

            if ($total_session_possible + 1 >= ($("#addRowMontant").val())) {
                $("#addRowMontant").css("display", "none");
            }
        } else {
            $("#addRowMontant").css("display", "none");
        }

    });

    // remove row
    $(document).on('click', '#removeRowMontant', function() {
        $(this).closest('#inputFormRowMontant').remove();
        var total_session_possible = ($(".row #inputFormRowMontant").length + 1);
        if (total_session_possible < ($("#addRowMontant").val())) {
            $("#addRowMontant").css("display", "inline-block");
        } else {
            $("#addRowMontant").css("display", "none");
        }
        getCalcule();
    });


    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
        var total_frais_annexe_possible = ($(".row #inputFormRow").length + 1);
        if ((total_frais_annexe_possible - 1) < 1) {
            $("#titres_services_annexe").css("display", "none");
        }
        if (total_frais_annexe_possible < ($("#addRow").val() + 1)) {
            $("#addRow").css("display", "inline-block");
        }
        getCalcule();
    });

</script>
