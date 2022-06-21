<x-acp::forms.create
    :title="__('blog::forms.post_image.title')"
    :description="__('blog::forms.post_image.description')">


    <div class="md:grid md:grid-cols-3 md:gap-6">

        {{-- 1. Col with input --}}
        <div class="md:col-span-2">
            <div class="mt-1 flex justify-center px-6 pt-3 pb-3 border-2 @if($errors->has('post_image')) border-main_brand_error @else border-main_brand/50 @endif border-dashed rounded-sm">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-main_brand/50 hover:text-main_brand" stroke="currentColor" fill="none"
                         viewBox="0 0 48 48" aria-hidden="true">
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="flex text-sm text-main_font">
                        <label for="file-upload"
                               class="relative cursor-pointer bg-white rounded-sm font-medium text-main_brand hover:text-main_brand/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="post_image" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-main_font/70">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
        </div>

        {{-- 2. Col with errormessage --}}
        <div class="md:col-span-1">
            <div class="flex">
                @error('post_image')<p class="block w-full sm:text-sm text-main_brand_error">{{$message}} </p> @enderror
            </div>

        </div>
    </div>

    <div class="md:grid md:grid-cols-3 md:gap-6">

        {{-- 1. Col with input --}}
        <div class="md:col-span-2">
            <div class="flex justify-items-center mt-5 bg-clip-content py-3 h-96 bg-contain bg-no-repeat bg-center rounded-sm overflow-hidden border-main_brand/50 border-2 border-dashed" style='background-image: url(
            @if(isset($post->post_image)) {{ config('app.url') . '/storage/' . $post->post_image }}
            @else {{ config('app.url') . '/storage/' . '/uploads/blog/cover/placeholder.png'}}
            @endif
            )'>
            </div>
        </div>

    </div>

</x-acp::forms.create>
