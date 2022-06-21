<x-blog::app title="{{__('blog::edit.title')}} - {{ config('blog.name') }}">

    {{-- Header for Breadcrumb and create new Items --}}
    <x-acp::header>
        {{-- Breadcrumb --}}
        <x-acp::breadcrumb>
            <x-acp::breadcrumb.item-main    :href="route('acp.backend.index')" >@lang('acp::nav.home')  </x-acp::breadcrumb.item-main>
            <x-acp::breadcrumb.item         :href="route('blog.backend.index')">@lang('blog::nav.blog') </x-acp::breadcrumb.item>
            <x-acp::breadcrumb.item                                            >@lang('blog::nav.edit') </x-acp::breadcrumb.item>
        </x-acp::breadcrumb>

    </x-acp::header>
    {{-- End Header --}}

<form action="{{ route('blog.backend.update', $post) }}" method="post" enctype="multipart/form-data"> @csrf @method('PUT')
    <div id="content">

        <x-acp::forms.divider />

        {{-- Post Titel --}}
        @include('blog::tableComponents.post_title')
        <x-acp::forms.divider />
        {{-- /Post Titel --}}

        {{-- Post content short --}}
        @include('blog::tableComponents.post_content_short')
        <x-acp::forms.divider />
        {{-- /Post content short --}}

        {{-- Post content --}}
        @include('blog::tableComponents.post_content')
        <x-acp::forms.divider />
        {{-- /Post content --}}

        {{-- Publishing Date --}}
        @include('blog::tableComponents.post_created_at')
        <x-acp::forms.divider />
        {{-- /Publishing Date --}}

        {{-- Categorie --}}
        @include('blog::tableComponents.post_category_id')
        <x-acp::forms.divider />
        {{-- /Categorie --}}

        @if(\Nwidart\Modules\Facades\Module::find('bibliography'))
            {{-- Book from Bibliography --}}
            @include('blog::tableComponents.book')
            <x-acp::forms.divider />
            {{-- /Book from Bibliography --}}
        @endif

        {{-- Image Upload --}}
        @include('blog::tableComponents.post_image')
        <x-acp::forms.divider />
        {{-- /Image Upload --}}

        {{-- Post Status --}}
        @include('blog::tableComponents.post_status')
        <x-acp::forms.divider />
        {{-- /Post Status --}}

        {{-- Save Button --}}
        @include('blog::tableComponents.save')
        <x-acp::forms.divider />
        {{-- /Save Button --}}

    </div>
</form>
</x-blog::app>
