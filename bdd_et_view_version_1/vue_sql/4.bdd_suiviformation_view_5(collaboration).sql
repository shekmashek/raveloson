
CREATE OR REPLACE VIEW v_collab_cfp_etp AS SELECT
    collab.id,
    collab.statut,
    collab.demmandeur,
    e.id AS id_etp,
    e.nom_etp,
    e.adresse_rue,
    e.logo AS logo_etp,
    e.nif AS nif_etp,
    e.stat AS stat_etp,
    e.cif AS cif_etp,
    e.rcs AS rcs_etp,
    e.secteur_id,
    e.email_etp,
    e.site_etp,
    e.telephone_etp,
    sect.nom_secteur,
    r.id AS responsable_id,
    r.nom_resp AS nom_resp,
    r.prenom_resp AS prenom_resp,
    r.email_resp AS email_responsable,
    r.photos AS photos_resp,
    concat(SUBSTRING(r.nom_resp, 1, 1),SUBSTRING(r.prenom_resp, 1, 1)) as initial_resp_etp,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif AS nif_cfp,
    c.stat AS stat_cfp,
    c.rcs AS rcs_cfp,
    c.cif AS cif_cfp,
    c.logo AS logo_cfp,
    c.specialisation AS specialisation,
    c.presentation AS presentation,
    c.site_web,
    rc.id AS responsable_cfp_id,
    rc.email_resp_cfp,
    rc.nom_resp_cfp,
    rc.prenom_resp_cfp,
    rc.photos_resp_cfp,
    concat(SUBSTRING(rc.nom_resp_cfp, 1, 1),SUBSTRING(rc.prenom_resp_cfp, 1, 1)) as initial_resp_cfp,
    collab.updated_at as date_refuse

FROM collaboration_etp_cfp as collab
JOIN entreprises as e ON collab.etp_id = e.id
JOIN cfps as c ON collab.cfp_id = c.id
JOIN secteurs as sect ON e.secteur_id = sect.id
JOIN responsables as r ON collab.etp_id = r.entreprise_id
JOIN responsables_cfp as rc ON collab.cfp_id = rc.cfp_id
WHERE r.prioriter = 1 and rc.prioriter = 1;



CREATE OR REPLACE VIEW v_demmande_cfp_pour_formateur AS SELECT
    demmande_cfp_formateur.id,
    demmandeur_cfp_id,
    inviter_formateur_id,

    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.nom,
    cfps.adresse_lot,
    cfps.adresse_ville,
    cfps.adresse_region,
    cfps.email,
    cfps.telephone,
    cfps.slogan,
    cfps.nif AS nif_cfp,
    cfps.stat AS stat_cfp,
    cfps.rcs AS rcs_cfp,
    cfps.cif AS cif_cfp,
    cfps.logo AS logo_cfp,
    cfps.specialisation AS specialisation,
    cfps.presentation AS presentation,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau_etude_id) niveau_formateur,
    formateurs.numero_formateur,
    (
        DATEDIFF(
            demmande_cfp_formateur.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_cfp_formateur.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_cfp_formateur.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_cfp_formateur.created_at
            ) date_demmande
        FROM
            demmande_cfp_formateur,responsables_cfp,cfps,
            formateurs
        WHERE
            demmandeur_cfp_id = cfps.id and inviter_formateur_id = formateurs.id  and

              demmande_cfp_formateur.activiter = 0;



CREATE OR REPLACE VIEW v_demmande_formateur_pour_cfp AS SELECT
    demmande_formateur_cfp.id,
    demmandeur_formateur_id,
    inviter_cfp_id,
    resp_cfp_id,
    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.slogan,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    (cfps.specialisation) specialisation,
    (cfps.presentation) presentation,
    (
        DATEDIFF(
            demmande_formateur_cfp.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_formateur_cfp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_formateur_cfp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_formateur_cfp.created_at
            ) date_demmande
        FROM
            demmande_formateur_cfp,responsables_cfp,formateurs,
            cfps
        WHERE
            inviter_cfp_id = cfps.id and demmandeur_formateur_id = formateurs.id  and
            resp_cfp_id =responsables_cfp.id and inviter_cfp_id =responsables_cfp.cfp_id
            and  demmande_formateur_cfp.activiter = 0;




CREATE OR REPLACE VIEW v_invitation_cfp_pour_formateur AS SELECT
    demmande_formateur_cfp.id,
    inviter_cfp_id,
    demmandeur_formateur_id,
    resp_cfp_id,
    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.nom,
    cfps.adresse_lot,
    cfps.adresse_ville,
    cfps.adresse_region,
    cfps.email,
    cfps.telephone,
    cfps.slogan,
    cfps.nif AS nif_cfp,
    cfps.stat AS stat_cfp,
    cfps.rcs AS rcs_cfp,
    cfps.cif AS cif_cfp,
    cfps.logo AS logo_cfp,
    cfps.specialisation AS specialisation,
    cfps.presentation AS presentation,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau_etude_id) niveau_formateur,
    formateurs.numero_formateur,
    (
        DATEDIFF(
            demmande_formateur_cfp.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_formateur_cfp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_formateur_cfp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_formateur_cfp.created_at
            ) date_demmande
        FROM
            demmande_formateur_cfp,responsables_cfp,cfps,
            formateurs
        WHERE
            inviter_cfp_id = cfps.id and demmandeur_formateur_id = formateurs.id
            and resp_cfp_id =responsables_cfp.id and inviter_cfp_id =responsables_cfp.cfp_id
            and  demmande_formateur_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_invitation_formateur_pour_cfp AS SELECT
    demmande_cfp_formateur.id,
    inviter_formateur_id,
    demmandeur_cfp_id,
    resp_cfp_id,
    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.nom,
    cfps.adresse_lot,
    cfps.adresse_ville,
    cfps.adresse_region,
    cfps.email,
    cfps.telephone,
    cfps.slogan,
    cfps.nif AS nif_cfp,
    cfps.stat AS stat_cfp,
    cfps.rcs AS rcs_cfp,
    cfps.cif AS cif_cfp,
    cfps.logo AS logo_cfp,
    cfps.specialisation AS specialisation,
    cfps.presentation AS presentation,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau_etude_id) niveau_formateur,
    formateurs.numero_formateur,
    (
        DATEDIFF(
            demmande_cfp_formateur.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_cfp_formateur.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_cfp_formateur.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_cfp_formateur.created_at
            ) date_demmande
        FROM
            demmande_cfp_formateur,responsables_cfp,cfps,
            formateurs
        WHERE
            demmandeur_cfp_id = cfps.id  and inviter_formateur_id = formateurs.id
            and resp_cfp_id =responsables_cfp.id and demmandeur_cfp_id =responsables_cfp.cfp_id
            and  demmande_cfp_formateur.activiter = 0;




CREATE OR REPLACE VIEW v_demmande_formateur_cfp AS SELECT
    d.activiter AS activiter_demande,
    rsp.email_resp_cfp,
    rsp.nom_resp_cfp,
    rsp.prenom_resp_cfp,
    rsp.photos_resp_cfp,
    d.resp_cfp_id,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif,
    c.stat,
    c.rcs,
    c.cif,
    c.logo,
    c.activiter AS activiter_cfp,
    c.site_web,
    f.id AS formateur_id,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    f.photos,
    f.genre_id,
    f.date_naissance,
    f.adresse,
    f.cin,
    f.specialite,
    f.niveau_etude_id,
    f.activiter AS activiter_formateur,
    f.user_id AS user_id_formateur
FROM
    demmande_formateur_cfp d
JOIN cfps c ON
    c.id = d.inviter_cfp_id
JOIN formateurs f ON
    f.id = d.demmandeur_formateur_id
JOIN responsables_cfp rsp ON
    d.resp_cfp_id =rsp.id
WHERE
    d.activiter = 1;



CREATE OR REPLACE VIEW v_demmande_cfp_formateur AS SELECT
    d.activiter AS activiter_demande,

    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif,
    c.stat,
    c.rcs,
    c.cif,
    c.logo,
    c.activiter AS activiter_cfp,
    c.site_web,
    f.user_id,
    f.id AS formateur_id,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    f.photos,
    f.genre_id,
    (IFNULL(g.genre,1)) genre,
    f.date_naissance,
    f.adresse,
    f.cin,
    f.specialite,
    f.niveau_etude_id,
    f.activiter AS activiter_formateur,
    f.user_id AS user_id_formateur
FROM
    demmande_cfp_formateur d
JOIN
    cfps c on c.id = d.demmandeur_cfp_id
JOIN formateurs f on f.id = d.inviter_formateur_id
JOIN genre g ON g.id = IFNULL(f.genre_id,1)
where d.activiter = 1;

