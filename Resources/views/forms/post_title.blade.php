<x-acp::forms.create
    :title="__('blog::forms.post_title.title')"
    :description="__('blog::forms.post_title.description')">

    <x-acp::forms.item type="text"
                       name="post_title"
                       id="post_title"
                       errorDBColumn="post_title"
                       :value="old('post_title')  ?? $post->post_title ?? '' "
                       :placeholder="__('blog::forms.post_title.placeholder')">

        <x-slot:span>
            <span class="inline-flex items-center px-3 rounded-l-sm border-y border-l border-main_brand/50 bg-main_brand/5 text-main_font/80 text-sm">
                <i class="fa-solid fa-feather-pointed w-4 hover:text-main_brand"></i>
            </span>
        </x-slot:span>
    </x-acp::forms.item>

</x-acp::forms.create>
