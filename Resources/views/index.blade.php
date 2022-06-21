<x-blog::app title="{{__('blog::index.title')}} - {{ config('blog.name') }}">

    {{-- Header for Breadcrumb and create new Items --}}
    <x-acp::header>
        {{-- Breadcrumb --}}
        <x-acp::breadcrumb>
            <x-acp::breadcrumb.item-main    :href="route('acp.backend.index')" >@lang('acp::nav.home')  </x-acp::breadcrumb.item-main>
            <x-acp::breadcrumb.item         :href="route('blog.backend.index')">@lang('blog::nav.blog') </x-acp::breadcrumb.item>
            <x-acp::breadcrumb.item                                            >@lang('blog::nav.index')</x-acp::breadcrumb.item>
        </x-acp::breadcrumb>
        {{-- Create new Button--}}
        <x-acp::forms.a-button :href="route('blog.backend.create')"><i class="fa-solid fa-plus"></i> {{ __('blog::index.button.add.post') }}</x-acp::forms.a-button>
        {{-- End Create new --}}
    </x-acp::header>
    {{-- End Header --}}

    <x-acp::table>
        <x-acp::table.header>
            <x-acp::table.header.item> @lang('blog::index.table.head.option')   </x-acp::table.header.item>
            <x-acp::table.header.item> @lang('blog::index.table.head.id')       </x-acp::table.header.item>
            <x-acp::table.header.item> @lang('blog::index.table.head.image')    </x-acp::table.header.item>
            <x-acp::table.header.item> @lang('blog::index.table.head.title')    </x-acp::table.header.item>
            <x-acp::table.header.item> @lang('blog::index.table.head.publish_date') </x-acp::table.header.item>
        </x-acp::table.header>
        {{-- Begin Table Body--}}
        <x-acp::table.body>
            @foreach($posts as $post)
                <x-acp::table.tr>
                    <!-- -->
                    <x-acp::table.td class="w-52">
                        <div class="flex flex-none">
                            {{-- Option Edit--}}
                            <x-acp::forms.opt-button :href="route('blog.backend.edit', $post)"><i class="fa-solid fa-pencil w-8 fa-xl"></i> </x-acp::forms.opt-button>
                            {{-- --}}

                            {{-- Option State--}}
                            @if($post->post_status)              <x-acp::forms.opt-button :href="route('blog.backend.status.update', $post)"><i class="fa-solid fa-toggle-on text-main_brand_success w-8 fa-xl"></i></x-acp::forms.opt-button>
                            @elseif($post->post_status == false) <x-acp::forms.opt-button :href="route('blog.backend.status.update', $post)"><i class="fa-solid fa-toggle-off text-main_brand_error w-8 fa-xl"></i></x-acp::forms.opt-button>
                            @endif
                            {{-- --}}

                            {{-- Option Delete--}}
                            <form action="{{ route('blog.backend.post.delete', $post) }}" method="post"> @csrf @method('DELETE')
                                <x-acp::forms.opt-button :href="route('blog.backend.post.delete', $post)"
                                                         onclick="event.preventDefault();
                                                         this.closest('form').submit();">
                                    <i class="fa-solid fa-trash w-8 fa-xl hover:text-main_brand_error"></i>
                                </x-acp::forms.opt-button>
                            </form>
                            {{-- --}}
                        </div>
                    </x-acp::table.td>
                    <!-- -->
                    <!-- -->
                    <x-acp::table.td>{{ $post->id }}</x-acp::table.td>
                    <!-- -->
                    <!-- -->
                    <x-acp::table.td><div class="border-main_brand/50 border-4 border-double rounded-sm overflow-hidden h-28 w-28"><img src="{{ config('app.url') . '/storage/' . $post->post_image }}" alt="" class="object-cover h-28 w-28"></div></x-acp::table.td>
                    <!-- -->
                    <!-- -->
                    <x-acp::table.td><div class="flex flex-col justify-center"><div class="p-1">{{ $post->post_title }}</div><div class="p-1 text-xs font-bold ">{{$post->author->name}}</div></div></x-acp::table.td>
                    <!-- -->
                    <!-- -->
                    <x-acp::table.td><span>{{ \Carbon\Carbon::parse($post->post_created_at)->locale('de_DE')->format('d.m.Y') }}</span></x-acp::table.td>
                    <!-- -->
                </x-acp::table.tr>
            @endforeach
            <x-acp::table.tr>

                <x-acp::table.td colspan="5" class="space-x-96">{{ $posts->links() }}</x-acp::table.td>
            </x-acp::table.tr>
        </x-acp::table.body>
        {{-- End Table Body--}}

    </x-acp::table>




</x-blog::app>
