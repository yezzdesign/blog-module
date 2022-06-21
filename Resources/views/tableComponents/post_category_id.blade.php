<x-acp::forms.create
    :title="__('blog::forms.post_category_id.title')"
    :description="__('blog::forms.post_category_id.description')">

    <div class="md:grid md:grid-cols-3 md:gap-6">

        {{-- 1. Col with input --}}
        <div class="md:col-span-2">
            <div class="flex">
                <span class="inline-flex items-center px-3 rounded-l-sm border-y border-l border-main_brand/50 bg-main_brand/5 text-main_font/80 text-sm"><i class="fa-solid fa-cat w-4 hover:text-main_brand"></i></span>
                <select name="post_category_id" class="form-select appearance-none block w-full text-base font-normal text-main_font bg-white bg-clip-padding bg-no-repeat border border-solid border-main_brand/50 rounded-r-sm transition ease-in-out m-0 focus:text-main_brand/50 focus:bg-white hover:border-main_brand/50 focus:border-main_brand/50 focus:outline-none focus:ring-main_brand/50 focus:shadow-outline" aria-label="select_categories">
                    <option value="1" @if(isset($post->post_category_id) && $post->post_category_id === 1) selected @endif>@lang('blog::forms.post_category_id.value.1')</option>
                    <option value="2" @if(isset($post->post_category_id) && $post->post_category_id === 2) selected @endif>@lang('blog::forms.post_category_id.value.2')</option>
                    <option value="3" @if(isset($post->post_category_id) && $post->post_category_id === 3) selected @endif>@lang('blog::forms.post_category_id.value.3')</option>
                </select>
            </div>
        </div>

        {{-- 2. Col with errormessage --}}
        <div class="md:col-span-1">
            <div class="flex">
                @error('post_category_id')<p class="block w-full sm:text-sm text-main_brand_error">{{$message}} </p> @enderror
            </div>

        </div>
    </div>

</x-acp::forms.create>
