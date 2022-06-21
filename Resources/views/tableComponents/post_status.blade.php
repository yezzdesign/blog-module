<x-acp::forms.create
    :title="__('blog::forms.post_status.title')"
    :description="__('blog::forms.post_status.description')">

    <div class="md:grid md:grid-cols-3 md:gap-6">

        {{-- 1. Col with input --}}
        <div class="md:col-span-2">
            <div class="">
                <div class="flex flex-col items-between justify-center">
                    <div class="flex flex-col">
                        <label for="check" class="inline-flex items-center">
                            <input
                                name="post_status"
                                type="checkbox"
                                class="form-checkbox ml-16 h-5 w-5 text-main_brand peer rounded-sm border-main_brand/50 focus:ring-main_brand/50"
                                id="check"
                                @checked( old('post_status') ?? $post->post_status ?? false )
                            >
                            <span class="ml-2 text-main_font">Active?</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Col with errormessage --}}
        <div class="md:col-span-1">
            <div class="flex">
                @error('post_status')<p class="block w-full sm:text-sm text-main_brand_error">{{$message}} </p> @enderror
            </div>

        </div>
    </div>

</x-acp::forms.create>
