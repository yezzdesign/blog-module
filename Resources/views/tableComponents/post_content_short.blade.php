<x-acp::forms.create
    :title="__('blog::forms.post_content_short.title')"
    :description="__('blog::forms.post_content_short.description')">

    <x-acp::forms.item
        type="text"
        name="post_content_short"
        id="post_content_short"
        errorDBColumn="post_content_short"
        :value=" old('post_content_short') ?? $post->post_content_short ?? '' "
        :placeholder="__('blog::forms.post_content_short.placeholder')">

        <x-slot:span>
            <span class="inline-flex items-center px-3 rounded-l-sm border-y border-l border-main_brand/50 bg-main_brand/5 text-main_font/80 text-sm">
                <i class="fa-solid fa-feather w-4 hover:text-main_brand"></i>
            </span>
        </x-slot:span>

    </x-acp::forms.item>

</x-acp::forms.create>
