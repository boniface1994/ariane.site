<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Déconnection',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'id' => 'btnLogout',
            'new-tab' => false,
        ],
        [
            'title' => 'Demande de contact',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'Clients',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'admin/customer',
            'new-tab' => false,
        ],

        // Configurateur
        [
            'section' => 'Configurateur',
        ],
        [
            'title' => 'Trimestres dispo',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => 'admin/configurator/trimester',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Types d\'orbite',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Maturité technique',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Options',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Coûts des options',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Grilles tarifaires',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/admin/configurator/pricelist',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'SC Interface',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/admin/configurator/scinterface',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Types fournisseur',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Opportunités de vol',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'Paramètres divers',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => 'admin/parameter',
            'root' => true,
            'new-tab' => false,
        ],
        // Configurateur
        [
            'section' => 'Site internet',
        ],
        [
            'title' => 'Textes',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],
        [
            'title' => 'FAQ',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => '/',
            'root' => true,
            'new-tab' => false,
        ],

    ]

];
