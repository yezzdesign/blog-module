<?php

namespace Modules\Blog\Services;

use Modules\ACP\Services\StartServices;

class StartService extends StartServices
{
    protected string    $prefix         =   'blog::forms.';
    protected array     $pageModules    =   [ 'post_title', 'post_content_short', 'post_content', 'post_created_at', 'post_category_id', 'post_image', 'post_status', 'save' ];

    protected string    $tableBodyPrefix=   'blog::tableComponents.';
    protected array     $tableHeadnames =   ['Options', 'Blog Cover', 'ID', 'Blog Title', 'Publish Date', 'More?'];
    protected array     $tableBodyViews =   ['options', 'image', 'id', 'title', 'date', 'more'];



    public function __construct() {

        parent::__construct();

        // Add Navigation Item
        $this->addMenu('Blog', 'blog.backend.index', true);

        // Create the Blog Edit/Create Page
        $this->createPage('BlogEditPage', $this->pageModules, $this->prefix);
        $this->createPage('BlogCreatePage', $this->pageModules, $this->prefix);

        // Add TableIndex
        $this->createTable('BlogIndexTable', $this->tableHeadnames, $this->tableBodyViews);
    }
}
