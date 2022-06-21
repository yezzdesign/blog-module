<?php

namespace Modules\Blog\Logical;

use Modules\ACP\Logical\Facades\Menu;

class Start
{
        public function __construct () {
            //app('Menu')->add('Blog', 'blog.backend.index', true);

            //Menu::test();

            //Menu::test();
            //app('Menu')->test();
            //App::Menu()->add('Blog2', 'blog.backend.index', true);
                //::add('Blog2', 'blog.backend.index', true);
            Menu::add('Blog', 'blog.backend.index', true);
            //Menu::add('Blog', 'blog.backend.index', true);
            //Forms::render();

            //Forms1::render();

            //app('ACP')->render();

            //app('ACP')->getFormContent();
            //ACP::getFormContent();

            //ACP::render();

        }


}
