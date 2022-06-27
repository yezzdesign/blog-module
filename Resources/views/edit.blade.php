<x-blog::app title="{{__('blog::edit.title')}} - {{ config('blog.name') }}">

    {{-- Header for Breadcrumb and create new Items --}}
    <x-acp::header>

        {{-- Breadcrumb --}}
        <x-acp::breadcrumb>
            <x-acp::breadcrumb.item-main    :href="route('acp.backend.index')" >@lang('acp::nav.home')  </x-acp::breadcrumb.item-main>
            <x-acp::breadcrumb.item         :href="route('blog.backend.index')">@lang('blog::nav.blog') </x-acp::breadcrumb.item>
            <x-acp::breadcrumb.item                                            >@lang('blog::nav.edit') </x-acp::breadcrumb.item>
        </x-acp::breadcrumb>
        {{-- /Breadcrumb --}}

    </x-acp::header>
    {{-- End Header --}}

<form action="{{ route( 'blog.backend.update', $post ) }}" method="post" enctype="multipart/form-data"> @csrf @method('PUT')
    <div id="content">

        {!! app( 'BlogEditPage' )->render( $post, 'post' ) !!}

    </div>
</form>
</x-blog::app>
