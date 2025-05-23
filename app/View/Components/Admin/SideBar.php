<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
{
    public $menus = [
        [
            'title' => 'Dashboard',
            'icon' => 'bx bx-grid-alt',
            'route' => 'admin.dashboard',
            'isSubMenu' => false,
            'name' => 'dashboard',
        ],
        [
            'title' => 'User List',
            'icon' => 'bx bx-grid-alt',
            'route' => 'admin.user',
            'isSubMenu' => false,
            'name' => 'user',
        ],
        [
            'title' => 'CMS',
            'icon' => 'fal fa-file-alt',
            'isSubMenu' => true,
            'name' => 'cms',
            'subMenus' => [
                [
                    'title' => 'Testimonials',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.testimonials',
                ],
                [
                    'title' => 'FAQ',
                    'icon' => 'bx bxchevron-right',
                    'route' => 'admin.faq',
                ],
                [
                    'title' => 'Pages',
                    'icon' => 'bx bxchevron-right',
                    'route' => 'admin.pages',
                ],
            ]
        ],
        [
            'title' => 'Masters',
            'icon' => 'fal fa-cogs',
            'isSubMenu' => true,
            'name' => 'masters',
            'subMenus' => [
                [
                    'title' => 'Features',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.features',
                ],
                [
                    'title' => 'Plans',
                    'icon' => 'bx bx-chevron-right',
                    'route' => 'admin.plans',
                ],
            ]
        ],

        // [
        //     'title' => 'CMS',
        //     'icon' => 'fal fa-file-alt',
        //     'isSubMenu' => true,
        //     'name' => 'cms',
        //     'subMenus' => [
        //         [
        //             'title' => 'Pages',
        //             'icon' => 'bx bx-chevron-right',
        //             'route' => 'admin.cms.pages.index',
        //         ],

        //     ]
        // ],
    ];


    public function __construct()
    {
        $this->menus = collect($this->menus);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.side-bar');
    }
}
