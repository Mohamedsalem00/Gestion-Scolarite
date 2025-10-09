<?php

namespace App\View\Components\Navigation;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $menuItems;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menuItems = $this->getMenuItems();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation.sidebar');
    }

    /**
     * Get the menu items structure based on user role
     */
    private function getMenuItems()
    {
        $user = auth()->user();
        
        if (!$user) {
            return [];
        }

        // Admin Menu - Full Access
        if ($user->hasRole('admin')) {
            return [
                [
                    'title' => __('app.tableau_de_bord'),
                    'icon' => 'fas fa-tachometer-alt',
                    'route' => 'tableau-bord',
                    'active' => request()->routeIs(['accueil', 'tableau-bord', 'home'])
                ],
                [
                    'title' => __('app.gestion_academique'),
                    'icon' => 'fas fa-graduation-cap',
                    'children' => [
                        [
                            'title' => __('app.classes'),
                            'route' => 'classes.index',
                            'active' => request()->routeIs('classes.*')
                        ],
                        [
                            'title' => __('app.etudiants'),
                            'route' => 'etudiants.index',
                            'active' => request()->routeIs('etudiants.*')
                        ],
                        [
                            'title' => __('app.enseignants'),
                            'route' => 'enseignants.index',
                            'active' => request()->routeIs('enseignants.*')
                        ],
                        [
                            'title' => __('app.courses'),
                            'route' => 'cours.index',
                            'active' => request()->routeIs('cours.*')
                        ],
                        [
                            'title' => __('app.evaluations'),
                            'route' => 'evaluations.index',
                            'active' => request()->routeIs('evaluations.*')
                        ],
                        [
                            'title' => __('app.notes'),
                            'route' => 'notes.index',
                            'active' => request()->routeIs('notes.*')
                        ]
                    ]
                ],
                [
                    'title' => __('app.gestion_financiere'),
                    'icon' => 'fas fa-money-bill-wave',
                    'children' => [
                        [
                            'title' => __('app.paiements_etudiants'),
                            'route' => 'paiements.etudiants.index',
                            'active' => request()->routeIs('paiements.etudiants.*')
                        ],
                        [
                            'title' => __('app.paiements_enseignants'),
                            'route' => 'paiements.enseignants.index',
                            'active' => request()->routeIs('paiements.enseignants.*')
                        ]
                    ]
                ],
                [
                    'title' => __('app.rapports'),
                    'icon' => 'fas fa-chart-bar',
                    'children' => [
                        [
                            'title' => __('app.releve_de_notes'),
                            'route' => 'rapports.notes.transcript-index',
                            'active' => request()->routeIs('rapports.notes.transcript*')
                        ]
                    ]
                ]
            ];
        }

        // Teacher Menu - Limited Access
        if ($user->hasRole('enseignant')) {
            return [
                [
                    'title' => __('app.tableau_de_bord'),
                    'icon' => 'fas fa-tachometer-alt',
                    'route' => 'enseignant.tableau-bord',
                    'active' => request()->routeIs(['enseignant.tableau-bord'])
                ],
                [
                    'title' => __('app.mon_enseignement'),
                    'icon' => 'fas fa-chalkboard-teacher',
                    'children' => [
                        [
                            'title' => __('app.mes_etudiants'),
                            'route' => 'enseignant.mes-etudiants',
                            'active' => request()->routeIs('enseignant.mes-etudiants')
                        ],
                        [
                            'title' => __('app.mes_cours'),
                            'route' => 'enseignant.mes-cours',
                            'active' => request()->routeIs('enseignant.mes-cours')
                        ],
                        [
                            'title' => __('app.saisir_notes'),
                            'route' => 'enseignant.saisir-notes',
                            'active' => request()->routeIs('enseignant.saisir-notes')
                        ]
                    ]
                ],
                [
                    'title' => __('app.mon_profil'),
                    'icon' => 'fas fa-user-circle',
                    'route' => 'enseignant.profil',
                    'active' => request()->routeIs('enseignant.profil')
                ]
            ];
        }

        // Student Menu - Very Limited Access
        if ($user->hasRole('etudiant')) {
            return [
                [
                    'title' => __('app.tableau_de_bord'),
                    'icon' => 'fas fa-tachometer-alt',
                    'route' => 'etudiant.tableau-bord',
                    'active' => request()->routeIs(['etudiant.tableau-bord'])
                ],
                [
                    'title' => __('app.mon_parcours'),
                    'icon' => 'fas fa-user-graduate',
                    'children' => [
                        [
                            'title' => __('app.mes_notes'),
                            'route' => 'etudiant.mes-notes',
                            'active' => request()->routeIs('etudiant.mes-notes')
                        ],
                        [
                            'title' => __('app.mon_emploi_du_temps'),
                            'route' => 'etudiant.mon-emploi',
                            'active' => request()->routeIs('etudiant.mon-emploi')
                        ]
                    ]
                ],
                [
                    'title' => __('app.recherche_publique'),
                    'icon' => 'fas fa-search',
                    'route' => 'rechercher-notes',
                    'active' => request()->routeIs('rechercher-notes')
                ]
            ];
        }

        return [];
    }
}
