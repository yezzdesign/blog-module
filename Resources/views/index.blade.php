<x-blog::app title="{{__('blog::index.title')}} - {{ config('blog.name') }}">

    {{-- Header for Breadcrumb and create new Items --}}
    <x-acp::header>

        {{-- Breadcrumb --}}
        <x-acp::breadcrumb>
            <x-acp::breadcrumb.item-main    :href="route('acp.backend.index')" >@lang('acp::nav.home')  </x-acp::breadcrumb.item-main>
            <x-acp::breadcrumb.item         :href="route('blog.backend.index')">@lang('blog::nav.blog') </x-acp::breadcrumb.item>
            <x-acp::breadcrumb.item                                            >@lang('blog::nav.index')</x-acp::breadcrumb.item>
        </x-acp::breadcrumb>
        {{-- /Breadcrumb --}}

        {{-- Create new Button--}}
        <x-acp::forms.a-button :href="route('blog.backend.create')"><i class="fa-solid fa-plus"></i> {{ __('blog::index.button.add.post') }}</x-acp::forms.a-button>
        {{-- End Create new --}}
    </x-acp::header>
    {{-- End Header --}}


    {!! app('BlogIndexTable')->render($posts, 'post') !!}

    {{ $posts->render() }}

</x-blog::app>
