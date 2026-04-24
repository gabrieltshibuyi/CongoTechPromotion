<?php

namespace App\Support;

final class SiteContent
{
    public static function page(string $locale, string $page): array
    {
        $fallbackLocale = 'fr';
        $content = self::content();
        $language = $content[$locale] ?? $content[$fallbackLocale];

        return array_merge(
            $language['shared'],
            $language['pages'][$page] ?? $language['pages']['home'],
            [
                'locale' => $locale,
                'currentPage' => $page,
                'currentPath' => \page_path($page, $locale),
            ]
        );
    }

    private static function content(): array
    {
        $contactEmail = (string) config('contact_email', 'contact@congotechpromotion.cd');
        $contactPhone = (string) config('contact_phone', '+243 000 000 000');
        $contactLocation = (string) config('contact_location', 'Kinshasa, RDC');
        $homePathFr = \page_path('home', 'fr');
        $aboutPathFr = \page_path('about', 'fr');
        $contactPathFr = \page_path('contact', 'fr');
        $homePathEn = \page_path('home', 'en');
        $aboutPathEn = \page_path('about', 'en');
        $contactPathEn = \page_path('contact', 'en');

        return [
            'fr' => [
                'shared' => [
                    'brandLabel' => 'Congo Tech Promotion',
                    'nav' => [
                        ['label' => 'Accueil', 'path' => $homePathFr],
                        ['label' => 'Qui sommes-nous ?', 'path' => $aboutPathFr],
                    ],
                    'switcherLabel' => 'Langue',
                    'languageLinks' => [
                        'fr' => 'FR',
                        'en' => 'EN',
                    ],
                    'footerTitle' => 'CTP, plateforme d’alignement pour la transformation numérique de la RDC.',
                    'footerText' => 'Nous fédérons les institutions, les entrepreneurs, les talents et les partenaires pour donner une portée durable à l’innovation congolaise.',
                    'footerLinks' => [
                        ['label' => 'Accueil', 'path' => $homePathFr],
                        ['label' => 'Qui sommes-nous ?', 'path' => $aboutPathFr],
                        ['label' => 'Contact', 'path' => $contactPathFr],
                    ],
                    'footerCta' => 'Parlons de votre initiative',
                    'footerBrandTitle' => 'Congo Tech Promotion',
                    'footerAddressLines' => ['Kinshasa, RDC', 'Écosystème numérique & innovation'],
                    'footerContactItems' => [
                        ['icon' => 'pin', 'lines' => [$contactLocation]],
                        ['icon' => 'phone', 'lines' => [$contactPhone]],
                        ['icon' => 'mail', 'lines' => [$contactEmail]],
                    ],
                    'footerQuickLinksTitle' => 'Accès Rapides',
                    'footerQuickLinks' => [
                        ['label' => 'Accueil', 'path' => $homePathFr],
                        ['label' => 'Qui sommes-nous ?', 'path' => $aboutPathFr],
                        ['label' => 'Viva RDC 2026', 'path' => $homePathFr . '#viva-rdc'],
                        ['label' => 'Contact', 'path' => $contactPathFr],
                    ],
                    'footerInstitutionLinksTitle' => 'Partenaires Institutionnels',
                    'footerInstitutionLinks' => [
                        ['label' => 'Ministère de l’Économie Numérique', 'path' => '#'],
                        ['label' => 'Ministère des Postes et Télécommunications', 'path' => '#'],
                        ['label' => 'Agence pour le Développement du Numérique', 'path' => '#'],
                        ['label' => 'VivaTech', 'path' => '#'],
                        ['label' => 'Écosystème Startup RDC', 'path' => '#'],
                    ],
                    'footerNewsletterTitle' => 'Newsletter',
                    'footerNewsletterText' => 'Recevez les dernières informations et initiatives de Congo Tech Promotion directement par email.',
                    'footerNewsletterLabel' => 'Adresse email',
                    'footerNewsletterPlaceholder' => 'Ex: prenom.nom@exemple.cd',
                    'footerNewsletterButton' => 'Je m’abonne',
                    'footerSocialLinks' => [
                        ['icon' => 'twitter', 'path' => '#', 'label' => 'X'],
                        ['icon' => 'facebook', 'path' => '#', 'label' => 'Facebook'],
                        ['icon' => 'youtube', 'path' => '#', 'label' => 'YouTube'],
                    ],
                    'footerLegalLabel' => 'Mentions Légales',
                    'footerCopyright' => 'Tous droits réservés © 2026 Congo Tech Promotion',
                    'pageCtaLabel' => 'Prendre contact',
                    'pageCtaPath' => $contactPathFr,
                ],
                'pages' => [
                    'home' => [
                        'pageTitle' => 'Congo Tech Promotion | Accueil',
                        'metaDescription' => 'CTP valorise l’écosystème technologique congolais, accompagne Viva RDC et connecte les acteurs du numérique aux opportunités stratégiques.',
                        'pageName' => 'Accueil',
                        'heroEyebrow' => 'Valoriser la tech congolaise',
                        'heroTitle' => 'Congo Tech Promotion valorise l’innovation congolaise et crée des passerelles entre institutions, acteurs privés et opportunités internationales.',
                        'heroLead' => 'CTP agit comme catalyseur de l’écosystème numérique national pour fédérer les talents, accélérer les projets et donner une portée stratégique aux initiatives technologiques de la RDC.',
                        'heroPrimaryCta' => ['label' => 'Découvrir CTP', 'path' => '#who'],
                        'heroSecondaryCta' => ['label' => 'Nous contacter', 'path' => '/contact'],
                        'highlights' => [],
                        'signalCards' => [
                            [
                                'label' => 'Positionnement',
                                'title' => 'Interface privilégiée',
                                'text' => 'Entre la scène tech congolaise, les sphères institutionnelles, économiques et les réseaux internationaux.',
                                'theme' => 'primary',
                            ],
                            [
                                'label' => 'Vision',
                                'title' => 'Le numérique comme levier de développement',
                                'text' => 'Une action alignée avec l’ambition nationale de faire du digital un moteur de transformation pour la RDC.',
                                'theme' => 'accent',
                            ],
                        ],
                        'who' => [
                            'tag' => 'Qui sommes-nous ?',
                            'title' => 'Une société congolaise dédiée à la valorisation de l’écosystème technologique national.',
                            'paragraphs' => [
                                'Congo Tech Promotion (CTP) est une société congolaise dédiée à la valorisation de l’écosystème technologique national dans son ensemble. CTP s’inscrit dans la matérialisation de la vision du Président de la République qui veut faire du numérique un levier de développement de notre pays.',
                            ],
                            'highlights' => [
                                'Valoriser l’écosystème technologique national dans son ensemble',
                                'Fédérer les acteurs publics et privés du numérique en RDC',
                                'Créer des passerelles avec les partenaires et opportunités internationales',
                            ],
                            'cta' => ['label' => 'Découvrir notre mission', 'path' => $aboutPathFr],
                            'image' => ['src' => 'assets/media/gallery/who-ecosystem.svg', 'alt' => 'Illustration de l’écosystème numérique congolais, des partenaires et de la coordination stratégique'],
                        ],
                        'stats' => [
                            ['value' => '1', 'label' => 'plateforme nationale de connexion institutionnelle et tech'],
                            ['value' => '4', 'label' => 'axes d’intervention structurants'],
                            ['value' => '2026', 'label' => 'cap stratégique autour de Viva RDC'],
                        ],
                        'servicesPreview' => [
                            'tag' => 'Notre démarche',
                            'title' => 'Des actions concrètes pour structurer, promouvoir et connecter.',
                            'text' => 'CTP intervient sur toute la chaîne de mise en valeur de la scène tech congolaise, de la stratégie à la représentation internationale.',
                            'items' => [
                                [
                                    'title' => 'Organisation & représentation',
                                    'text' => 'CTP conçoit, coordonne et accompagne la participation congolaise aux événements technologiques à forte portée nationale et internationale.',
                                    'icon' => 'representation',
                                    'accent' => 'blue',
                                ],
                                [
                                    'title' => 'Conseil en stratégie numérique',
                                    'text' => 'Nous aidons les institutions, organisations et acteurs privés à structurer leurs ambitions digitales avec une vision claire et opérationnelle.',
                                    'icon' => 'strategy',
                                    'accent' => 'gold',
                                ],
                                [
                                    'title' => 'Accompagnement des porteurs de projets',
                                    'text' => 'Nous soutenons startups, experts, développeurs et entrepreneurs dans la mise en visibilité et la maturation de leurs initiatives.',
                                    'icon' => 'support',
                                    'accent' => 'red',
                                ],
                                [
                                    'title' => 'Mise en relation & opportunités',
                                    'text' => 'CTP crée des connexions utiles entre l’écosystème tech congolais, les partenaires technologiques et les opportunités d’investissement.',
                                    'icon' => 'connections',
                                    'accent' => 'cyan',
                                ],
                                [
                                    'title' => 'Curating d’écosystème',
                                    'text' => 'Nous sélectionnons et mettons en scène les acteurs à fort potentiel pour offrir une lecture claire et crédible de la tech congolaise.',
                                    'icon' => 'curation',
                                    'accent' => 'violet',
                                ],
                                [
                                    'title' => 'Interface institutionnelle',
                                    'text' => 'CTP facilite l’alignement entre ministères, agences, entrepreneurs et partenaires pour sécuriser les dynamiques de collaboration.',
                                    'icon' => 'institutional',
                                    'accent' => 'ink',
                                ],
                            ],
                        ],
                        'ecosystem' => [
                            'tag' => 'Écosystème fédéré',
                            'title' => 'CTP rassemble les forces qui façonnent le numérique congolais.',
                            'items' => [
                                'Startups innovantes',
                                'Développeurs et experts',
                                'Consultants et entrepreneurs du digital',
                                'Institutions publiques et partenaires internationaux',
                            ],
                        ],
                        'gallery' => [
                            'tag' => 'Galerie institutionnelle',
                            'title' => 'Trois scènes pour raconter la montée en puissance de la tech congolaise.',
                            'items' => [
                                ['title' => 'Représentation internationale', 'text' => 'Présence coordonnée sur les grands rendez-vous de l’innovation.', 'image' => 'assets/media/gallery/representation.svg', 'alt' => 'Illustration de la représentation internationale de la RDC'],
                                ['title' => 'Communautés & talents', 'text' => 'Visibilité donnée aux développeurs, experts, entrepreneurs et porteurs de solutions.', 'image' => 'assets/media/gallery/talents.svg', 'alt' => 'Illustration des talents et communautés numériques congolaises'],
                                ['title' => 'Dialogue public-privé', 'text' => 'Création d’un langage commun entre institutions, marchés et innovation locale.', 'image' => 'assets/media/gallery/dialogue.svg', 'alt' => 'Illustration du dialogue entre institutions et acteurs privés'],
                            ],
                        ],
                        'viva' => [
                            'tag' => 'Focus 2026',
                            'title' => 'Organisation du pavillon RDC et coordination de la délégation Viva RDC.',
                            'paragraphs' => [
                                'Pour l’édition 2026 de VIVATECH, CTP accompagne le Ministère de l’Économie Numérique et le Ministère des Postes et Télécommunications, avec la collaboration de l’Agence pour le Développement du Numérique.',
                                'Cette mission positionne CTP au cœur de la représentation technologique de la RDC sur l’une des plus grandes scènes mondiales de l’innovation.',
                            ],
                            'notes' => [
                                ['label' => 'Coordination', 'text' => 'Alignement institutionnel, mobilisation des acteurs et orchestration de la présence nationale.'],
                                ['label' => 'Rayonnement', 'text' => 'Mise en visibilité des talents, projets et ambitions numériques portés par la RDC.'],
                                ['label' => 'Opportunités', 'text' => 'Création de passerelles durables avec les partenaires technologiques, investisseurs et réseaux internationaux.'],
                            ],
                        ],
                        'partners' => [
                            'tag' => 'Partenaires & écosystème',
                            'title' => 'Un cadre de collaboration institutionnelle, technologique et entrepreneuriale.',
                            'items' => ['Institutions publiques', 'Agences de transformation numérique', 'Startups et hubs d’innovation', 'Investisseurs et partenaires technologiques', 'Experts sectoriels', 'Réseaux internationaux'],
                        ],
                        'closing' => [
                            'tag' => 'Pourquoi CTP ?',
                            'title' => 'Une plateforme d’influence, de structuration et de projection internationale pour la tech congolaise.',
                            'text' => 'CTP se positionne comme un acteur de confiance pour relier ambition publique, innovation privée et opportunités globales au service du développement numérique de la RDC.',
                        ],
                    ],
                    'about' => [
                        'pageTitle' => 'Congo Tech Promotion | Qui sommes-nous ?',
                        'metaDescription' => 'Découvrez la mission, le positionnement et la vision de Congo Tech Promotion au service de l’écosystème numérique congolais.',
                        'pageName' => 'Qui sommes-nous ?',
                        'heroEyebrow' => 'Qui sommes-nous ?',
                        'heroTitle' => 'Une société congolaise engagée pour valoriser l’écosystème technologique national.',
                        'heroLead' => 'Congo Tech Promotion agit comme catalyseur entre les talents du numérique, les institutions et les opportunités stratégiques en RDC.',
                        'heroPrimaryCta' => ['label' => 'Nous contacter', 'path' => '/contact'],
                        'heroSecondaryCta' => ['label' => 'Retour à l’accueil', 'path' => $homePathFr],
                        'intro' => [
                            'tag' => 'Notre identité',
                            'title' => 'CTP s’inscrit dans une vision nationale où le numérique devient un levier de développement.',
                            'paragraphs' => [
                                'Congo Tech Promotion (CTP) est une société congolaise dédiée à la valorisation de l’écosystème technologique national dans son ensemble. CTP s’inscrit dans la matérialisation de la vision du Président de la République qui veut faire du numérique un levier de développement de notre pays.',
                                'Agissant comme catalyseur, nous nous sommes fixés comme objectif de fédérer et de promouvoir les acteurs publics et privés du numérique en RDC, notamment les startups innovantes, les développeurs, les experts, les consultants et les entrepreneurs du digital.',
                            ],
                        ],
                        'positioning' => [
                            'tag' => 'Notre positionnement',
                            'title' => 'Une interface privilégiée entre la scène tech congolaise et les sphères institutionnelles, économiques et internationales.',
                            'paragraphs' => [
                                'CTP se positionne donc comme l’interface privilégiée entre la scène tech congolaise et les sphères institutionnelles, économiques et internationales.',
                                'Notre démarche englobe l’organisation et la participation à des événements majeurs, le conseil en stratégie numérique, l’accompagnement des porteurs de projets ainsi que la création de passerelles durables entre les entrepreneurs du secteur et les opportunités de financement ou de partenariats technologiques.',
                            ],
                        ],
                        'actors' => [
                            'tag' => 'Acteurs concernés',
                            'title' => 'Les forces que CTP fédère autour du numérique en RDC.',
                            'items' => [
                                'Startups innovantes',
                                'Développeurs et experts',
                                'Consultants spécialisés',
                                'Entrepreneurs du digital',
                                'Institutions publiques',
                                'Partenaires technologiques et financiers',
                            ],
                        ],
                        'focus' => [
                            'tag' => 'Focus VivaTech 2026',
                            'title' => 'CTP accompagne l’organisation du pavillon RDC et la coordination de la délégation Viva RDC.',
                            'text' => 'Pour l’organisation du pavillon de la RDC et la coordination de la Délégation « Viva RDC » dans le cadre de l’édition 2026 de VIVATECH, CTP accompagne le Ministère de l’Économie Numérique et le Ministère des Postes et Télécommunications avec la collaboration de l’Agence pour le Développement du Numérique.',
                        ],
                    ],
                    'contact' => [
                        'pageTitle' => 'Congo Tech Promotion | Contact',
                        'metaDescription' => 'Prenez contact avec Congo Tech Promotion pour vos initiatives, collaborations et projets de valorisation de l’écosystème numérique en RDC.',
                        'pageName' => 'Contact',
                        'heroEyebrow' => 'Contact',
                        'heroTitle' => 'Échangeons autour de votre initiative, événement ou partenariat stratégique.',
                        'heroLead' => 'CTP accompagne les institutions, opérateurs et entrepreneurs qui souhaitent structurer ou représenter l’innovation congolaise avec une portée institutionnelle forte.',
                        'heroPrimaryCta' => ['label' => 'Envoyer un email', 'path' => 'mailto:' . $contactEmail],
                        'heroSecondaryCta' => ['label' => 'Qui sommes-nous ?', 'path' => $aboutPathFr],
                        'contactCards' => [
                            ['label' => 'Email', 'value' => $contactEmail, 'href' => 'mailto:' . $contactEmail],
                            ['label' => 'Téléphone', 'value' => $contactPhone, 'href' => 'tel:' . preg_replace('/\s+/', '', $contactPhone)],
                            ['label' => 'Localisation', 'value' => $contactLocation, 'href' => null],
                        ],
                        'intro' => [
                            'tag' => 'Travailler avec CTP',
                            'title' => 'Nous intervenons sur les sujets de représentation, coordination et stratégie numérique.',
                            'paragraphs' => [
                                'Que vous prépariez une présence internationale, une initiative institutionnelle ou un programme de mise en valeur d’acteurs tech, CTP peut vous aider à structurer la démarche.',
                                'Utilisez le formulaire ci-dessous pour transmettre votre besoin à l’équipe CTP. Votre demande est envoyée par email et tracée dans le journal technique du site.',
                            ],
                        ],
                        'brief' => [
                            'tag' => 'Brief express',
                            'title' => 'Ce que nous pouvons cadrer avec vous',
                            'items' => ['Participation à un événement international', 'Structuration d’un pavillon ou d’une délégation', 'Visibilité de startups ou projets innovants', 'Partenariat technologique ou institutionnel', 'Conseil en stratégie numérique'],
                        ],
                        'form' => [
                            'title' => 'Préparez votre demande',
                            'note' => '',
                            'fields' => [
                                ['label' => 'Nom / Organisation', 'placeholder' => 'Votre nom ou structure'],
                                ['label' => 'Email', 'placeholder' => 'nom@organisation.com'],
                                ['label' => 'Objet', 'placeholder' => 'Nature de votre besoin'],
                                ['label' => 'Message', 'placeholder' => 'Contexte, objectifs, échéance, partenaires concernés'],
                            ],
                            'button' => 'Envoyer la demande',
                        ],
                        'partners' => [
                            'tag' => 'Cadre de collaboration',
                            'title' => 'CTP travaille à l’intersection des acteurs institutionnels, entrepreneuriaux et technologiques.',
                            'items' => ['Institutions et ministères', 'Agences publiques', 'Hubs et incubateurs', 'Entreprises technologiques', 'Startups et experts', 'Partenaires internationaux'],
                        ],
                    ],
                ],
            ],
            'en' => [
                'shared' => [
                    'brandLabel' => 'Congo Tech Promotion',
                    'nav' => [
                        ['label' => 'Home', 'path' => $homePathEn],
                        ['label' => 'Who are we?', 'path' => $aboutPathEn],
                    ],
                    'switcherLabel' => 'Language',
                    'languageLinks' => [
                        'fr' => 'FR',
                        'en' => 'EN',
                    ],
                    'footerTitle' => 'CTP, an alignment platform for the digital transformation of the DRC.',
                    'footerText' => 'We connect institutions, entrepreneurs, talent and partners to give Congolese innovation long-term strategic reach.',
                    'footerLinks' => [
                        ['label' => 'Home', 'path' => $homePathEn],
                        ['label' => 'Who are we?', 'path' => $aboutPathEn],
                        ['label' => 'Contact', 'path' => $contactPathEn],
                    ],
                    'footerCta' => 'Discuss your initiative',
                    'footerBrandTitle' => 'Congo Tech Promotion',
                    'footerAddressLines' => ['Kinshasa, DRC', 'Digital ecosystem & innovation'],
                    'footerContactItems' => [
                        ['icon' => 'pin', 'lines' => [str_replace('RDC', 'DRC', $contactLocation)]],
                        ['icon' => 'phone', 'lines' => [$contactPhone]],
                        ['icon' => 'mail', 'lines' => [$contactEmail]],
                    ],
                    'footerQuickLinksTitle' => 'Quick Links',
                    'footerQuickLinks' => [
                        ['label' => 'Home', 'path' => $homePathEn],
                        ['label' => 'Who are we?', 'path' => $aboutPathEn],
                        ['label' => 'Viva RDC 2026', 'path' => $homePathEn . '#viva-rdc'],
                        ['label' => 'Contact', 'path' => $contactPathEn],
                    ],
                    'footerInstitutionLinksTitle' => 'Institutional Links',
                    'footerInstitutionLinks' => [
                        ['label' => 'Ministry of Digital Economy', 'path' => '#'],
                        ['label' => 'Ministry of Posts and Telecommunications', 'path' => '#'],
                        ['label' => 'Digital Development Agency', 'path' => '#'],
                        ['label' => 'VivaTech', 'path' => '#'],
                        ['label' => 'DRC Startup Ecosystem', 'path' => '#'],
                    ],
                    'footerNewsletterTitle' => 'Newsletter',
                    'footerNewsletterText' => 'Receive the latest updates and initiatives from Congo Tech Promotion directly by email.',
                    'footerNewsletterLabel' => 'Email address',
                    'footerNewsletterPlaceholder' => 'Ex: first.last@example.com',
                    'footerNewsletterButton' => 'Subscribe',
                    'footerSocialLinks' => [
                        ['icon' => 'twitter', 'path' => '#', 'label' => 'X'],
                        ['icon' => 'facebook', 'path' => '#', 'label' => 'Facebook'],
                        ['icon' => 'youtube', 'path' => '#', 'label' => 'YouTube'],
                    ],
                    'footerLegalLabel' => 'Legal Notice',
                    'footerCopyright' => 'All rights reserved © 2026 Congo Tech Promotion',
                    'pageCtaLabel' => 'Get in touch',
                    'pageCtaPath' => $contactPathEn,
                ],
                'pages' => [
                    'home' => [
                        'pageTitle' => 'Congo Tech Promotion | Home',
                        'metaDescription' => 'CTP promotes the Congolese tech ecosystem, supports Viva RDC and connects digital stakeholders with strategic opportunities.',
                        'pageName' => 'Home',
                        'heroEyebrow' => 'Promoting Congolese tech',
                        'heroTitle' => 'Congo Tech Promotion promotes Congolese innovation and builds bridges between institutions, private stakeholders and international opportunities.',
                        'heroLead' => 'CTP acts as a catalyst for the national digital ecosystem to unite talent, accelerate projects and give strategic visibility to technological initiatives across the DRC.',
                        'heroPrimaryCta' => ['label' => 'Discover CTP', 'path' => '#who'],
                        'heroSecondaryCta' => ['label' => 'Contact us', 'path' => '/contact'],
                        'highlights' => [
                            'Unite public and private digital stakeholders across the DRC',
                            'Build durable bridges to funding and strategic partnerships',
                            'Support the Viva RDC delegation for VIVATECH 2026',
                        ],
                        'signalCards' => [
                            [
                                'label' => 'Positioning',
                                'title' => 'Preferred interface',
                                'text' => 'Between the Congolese tech scene and institutional, economic and international spheres.',
                                'theme' => 'primary',
                            ],
                            [
                                'label' => 'Vision',
                                'title' => 'Digital as a development lever',
                                'text' => 'Action aligned with the national ambition to make digital transformation a driver of growth in the DRC.',
                                'theme' => 'accent',
                            ],
                        ],
                        'who' => [
                            'tag' => 'Who are we?',
                            'title' => 'A Congolese company dedicated to showcasing the national technology ecosystem.',
                            'paragraphs' => [
                                'Congo Tech Promotion (CTP) is a Congolese company dedicated to promoting the national technology ecosystem as a whole. CTP is part of the implementation of the President’s vision to make digital technology a lever for the development of our country.',
                            ],
                            'highlights' => [
                                'Promote the national technology ecosystem as a whole',
                                'Unite public and private digital stakeholders across the DRC',
                                'Build bridges with partners and international opportunities',
                            ],
                            'cta' => ['label' => 'Discover our mission', 'path' => '/about'],
                            'image' => ['src' => 'assets/media/gallery/who-ecosystem.svg', 'alt' => 'Illustration of the Congolese digital ecosystem, partner networks and strategic coordination'],
                        ],
                        'stats' => [
                            ['value' => '1', 'label' => 'national platform for institutional and tech alignment'],
                            ['value' => '4', 'label' => 'structuring intervention pillars'],
                            ['value' => '2026', 'label' => 'strategic horizon around Viva RDC'],
                        ],
                        'servicesPreview' => [
                            'tag' => 'Our approach',
                            'title' => 'Concrete actions to structure, promote and connect.',
                            'text' => 'CTP operates across the full value chain of the Congolese tech scene, from strategic guidance to international representation.',
                            'items' => [
                                ['title' => 'Organization & representation', 'text' => 'CTP designs, coordinates and supports Congolese participation in major technology events with national and international reach.', 'icon' => 'representation', 'accent' => 'blue'],
                                ['title' => 'Digital strategy advisory', 'text' => 'We help institutions, organizations and private stakeholders structure their digital ambitions with a clear operational vision.', 'icon' => 'strategy', 'accent' => 'gold'],
                                ['title' => 'Project support', 'text' => 'We support startups, experts, developers and entrepreneurs in increasing the visibility and maturity of their initiatives.', 'icon' => 'support', 'accent' => 'red'],
                                ['title' => 'Connections & opportunities', 'text' => 'CTP creates useful links between the Congolese tech ecosystem, technology partners and investment opportunities.', 'icon' => 'connections', 'accent' => 'cyan'],
                                ['title' => 'Ecosystem curation', 'text' => 'We select and frame high-potential stakeholders to present a clear and credible narrative of Congolese tech.', 'icon' => 'curation', 'accent' => 'violet'],
                                ['title' => 'Institutional interface', 'text' => 'CTP helps align ministries, agencies, entrepreneurs and partners to secure collaborative momentum.', 'icon' => 'institutional', 'accent' => 'ink'],
                            ],
                        ],
                        'ecosystem' => [
                            'tag' => 'Federated ecosystem',
                            'title' => 'CTP brings together the forces shaping Congolese digital transformation.',
                            'items' => ['Innovative startups', 'Developers and experts', 'Consultants and digital entrepreneurs', 'Public institutions and international partners'],
                        ],
                        'gallery' => [
                            'tag' => 'Institutional gallery',
                            'title' => 'Three scenes illustrating the rise of Congolese tech.',
                            'items' => [
                                ['title' => 'International representation', 'text' => 'Coordinated presence on leading innovation stages.', 'image' => 'assets/media/gallery/representation.svg', 'alt' => 'Illustration of the DRC international representation'],
                                ['title' => 'Communities & talent', 'text' => 'Visibility for developers, experts, entrepreneurs and solution builders.', 'image' => 'assets/media/gallery/talents.svg', 'alt' => 'Illustration of Congolese talent and communities'],
                                ['title' => 'Public-private dialogue', 'text' => 'A common language between institutions, markets and local innovation.', 'image' => 'assets/media/gallery/dialogue.svg', 'alt' => 'Illustration of dialogue between institutions and private stakeholders'],
                            ],
                        ],
                        'viva' => [
                            'tag' => 'Focus 2026',
                            'title' => 'RDC pavilion organization and Viva RDC delegation coordination.',
                            'paragraphs' => [
                                'For the 2026 edition of VIVATECH, CTP supports the Ministry of Digital Economy and the Ministry of Posts and Telecommunications, in collaboration with the Digital Development Agency.',
                                'This mission places CTP at the core of the DRC’s technological representation on one of the world’s leading innovation stages.',
                            ],
                            'notes' => [
                                ['label' => 'Coordination', 'text' => 'Institutional alignment, stakeholder mobilization and orchestration of the national presence.'],
                                ['label' => 'Visibility', 'text' => 'Showcasing the talent, projects and digital ambitions carried by the DRC.'],
                                ['label' => 'Opportunities', 'text' => 'Building durable bridges with technology partners, investors and international networks.'],
                            ],
                        ],
                        'partners' => [
                            'tag' => 'Partners & ecosystem',
                            'title' => 'A framework for institutional, technological and entrepreneurial collaboration.',
                            'items' => ['Public institutions', 'Digital transformation agencies', 'Startups and innovation hubs', 'Investors and technology partners', 'Sector experts', 'International networks'],
                        ],
                        'closing' => [
                            'tag' => 'Why CTP?',
                            'title' => 'A platform for influence, structuring and international projection for Congolese tech.',
                            'text' => 'CTP positions itself as a trusted actor linking public ambition, private innovation and global opportunities in service of the DRC’s digital development.',
                        ],
                    ],
                    'about' => [
                        'pageTitle' => 'Congo Tech Promotion | Who are we?',
                        'metaDescription' => 'Learn about Congo Tech Promotion, its role, positioning and mission for the Congolese digital ecosystem.',
                        'pageName' => 'Who are we?',
                        'heroEyebrow' => 'Who are we?',
                        'heroTitle' => 'A Congolese company committed to promoting the national technology ecosystem.',
                        'heroLead' => 'Congo Tech Promotion acts as a catalyst between digital talent, institutions and strategic opportunities across the DRC.',
                        'heroPrimaryCta' => ['label' => 'Contact us', 'path' => '/contact'],
                        'heroSecondaryCta' => ['label' => 'Back to home', 'path' => '/'],
                        'intro' => [
                            'tag' => 'Our identity',
                            'title' => 'CTP is part of a national vision where digital transformation becomes a lever for development.',
                            'paragraphs' => [
                                'Congo Tech Promotion (CTP) is a Congolese company dedicated to promoting the national technology ecosystem as a whole. CTP is part of the implementation of the President’s vision to make digital technology a lever for the development of our country.',
                                'Acting as a catalyst, our objective is to unite and promote public and private digital stakeholders in the DRC, including innovative startups, developers, experts, consultants and digital entrepreneurs.',
                            ],
                        ],
                        'positioning' => [
                            'tag' => 'Our positioning',
                            'title' => 'A preferred interface between the Congolese tech scene and institutional, economic and international spheres.',
                            'paragraphs' => [
                                'CTP positions itself as a preferred interface between the Congolese tech scene and institutional, economic and international spheres.',
                                'Our approach includes organizing and participating in major events, digital strategy advisory, support for project leaders, and building durable bridges between entrepreneurs and opportunities for funding or technology partnerships.',
                            ],
                        ],
                        'actors' => [
                            'tag' => 'Stakeholders involved',
                            'title' => 'The communities CTP brings together around digital transformation in the DRC.',
                            'items' => [
                                'Innovative startups',
                                'Developers and experts',
                                'Specialized consultants',
                                'Digital entrepreneurs',
                                'Public institutions',
                                'Technology and funding partners',
                            ],
                        ],
                        'focus' => [
                            'tag' => 'VivaTech 2026 focus',
                            'title' => 'CTP supports the RDC pavilion and the coordination of the Viva RDC delegation.',
                            'text' => 'For the organization of the RDC pavilion and the coordination of the "Viva RDC" delegation for the 2026 edition of VIVATECH, CTP supports the Ministry of Digital Economy and the Ministry of Posts and Telecommunications with the collaboration of the Digital Development Agency.',
                        ],
                    ],
                    'contact' => [
                        'pageTitle' => 'Congo Tech Promotion | Contact',
                        'metaDescription' => 'Contact Congo Tech Promotion for strategic initiatives, collaborations and programs showcasing the digital ecosystem in the DRC.',
                        'pageName' => 'Contact',
                        'heroEyebrow' => 'Contact',
                        'heroTitle' => 'Let’s discuss your initiative, event or strategic partnership.',
                        'heroLead' => 'CTP supports institutions, operators and entrepreneurs who want to structure or represent Congolese innovation with strong institutional reach.',
                        'heroPrimaryCta' => ['label' => 'Send an email', 'path' => 'mailto:' . $contactEmail],
                        'heroSecondaryCta' => ['label' => 'Who are we?', 'path' => '/about'],
                        'contactCards' => [
                            ['label' => 'Email', 'value' => $contactEmail, 'href' => 'mailto:' . $contactEmail],
                            ['label' => 'Phone', 'value' => $contactPhone, 'href' => 'tel:' . preg_replace('/\s+/', '', $contactPhone)],
                            ['label' => 'Location', 'value' => str_replace('RDC', 'DRC', $contactLocation), 'href' => null],
                        ],
                        'intro' => [
                            'tag' => 'Working with CTP',
                            'title' => 'We engage on representation, coordination and digital strategy topics.',
                            'paragraphs' => [
                                'Whether you are preparing an international presence, an institutional initiative or a visibility program for tech actors, CTP can help structure the approach.',
                                'Use the form below to send your request directly to the CTP team. Your request is emailed and also written to the local technical log.',
                            ],
                        ],
                        'brief' => [
                            'tag' => 'Quick brief',
                            'title' => 'What we can scope with you',
                            'items' => ['Participation in an international event', 'Structuring a pavilion or delegation', 'Visibility for startups or innovative projects', 'Technology or institutional partnership', 'Digital strategy advisory'],
                        ],
                        'form' => [
                            'title' => 'Prepare your request',
                            'note' => '',
                            'fields' => [
                                ['label' => 'Name / Organization', 'placeholder' => 'Your name or organization'],
                                ['label' => 'Email', 'placeholder' => 'name@organization.com'],
                                ['label' => 'Subject', 'placeholder' => 'Nature of your request'],
                                ['label' => 'Message', 'placeholder' => 'Context, goals, timeline, relevant partners'],
                            ],
                            'button' => 'Send request',
                        ],
                        'partners' => [
                            'tag' => 'Collaboration framework',
                            'title' => 'CTP operates at the intersection of institutional, entrepreneurial and technology stakeholders.',
                            'items' => ['Institutions and ministries', 'Public agencies', 'Hubs and incubators', 'Technology companies', 'Startups and experts', 'International partners'],
                        ],
                    ],
                ],
            ],
        ];
    }
}
