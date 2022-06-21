<x-acp::forms.create
    :title="__('blog::forms.post_created_at.title')"
    :description="__('blog::forms.post_created_at.description')">

    <x-acp::forms.item
        type="date"
        name="post_created_at"
        id="post_created_at"
        errorDBColumn="post_created_at"
        value="{{ \Carbon\Carbon::parse(old('post_created_at') ?? $post->post_created_at ?? now())->format('Y-m-d') }}">

        <x-slot:span>
            <span class="inline-flex items-center px-3 rounded-l-sm border-y border-l border-main_brand/50 bg-main_brand/5 text-main_font/80 text-sm">
                <i class="fa-solid fa-calendar-days w-4 hover:text-main_brand"></i>
            </span>
        </x-slot:span>

    </x-acp::forms.item>

</x-acp::forms.create>
