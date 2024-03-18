<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('admin::app.catalog.categories.create.title')
    </x-slot>

    {!! view_render_event('bagisto.admin.catalog.categories.create.before') !!}

    <!-- Category Create Form -->
    <x-admin::form
        :action="route('admin.catalog.categories.store')"
        enctype="multipart/form-data"
    >
        {!! view_render_event('bagisto.admin.catalog.categories.create.create_form_controls.before') !!}

        <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
            <p class="text-xl text-gray-800 dark:text-white font-bold">
                @lang('admin::app.catalog.categories.create.title')
            </p>

            <div class="flex gap-x-2.5 items-center">
                <!-- Cancel Button -->
                <a
                    href="{{ route('admin.catalog.categories.index') }}"
                    class="transparent-button hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-white"
                >
                    @lang('admin::app.catalog.categories.create.back-btn')
                </a>

                <!-- Save Button -->
                <button
                    type="submit"
                    class="primary-button"
                >
                    @lang('admin::app.catalog.categories.create.save-btn')
                </button>
            </div>
        </div>

        <!-- Full Pannel -->
        <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">

            <!-- Left Section -->
            <div class="flex flex-col gap-2 flex-1 max-xl:flex-auto">

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.general.before') !!}

                <!-- General -->
                <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('admin::app.catalog.categories.create.general')
                    </p>

                    <!-- Locales -->
                    <x-admin::form.control-group.control
                        type="hidden"
                        name="locale"
                        value="all"
                    />

                    <!-- Name -->
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            @lang('admin::app.catalog.categories.create.name')
                        </x-admin::form.control-group.label>

                        <v-field
                            type="text"
                            name="name"
                            rules="required"
                            value="{{ old('name') }}"
                            v-slot="{ field }"
                            label="{{ trans('admin::app.catalog.categories.create.name') }}"
                        >
                            <input
                                type="text"
                                id="name"
                                :class="[errors['{{ 'name' }}'] ? 'border border-red-600 hover:border-red-600' : '']"
                                class="flex w-full min-h-[39px] py-2 px-3 border rounded-md text-sm text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 dark:bg-gray-900 dark:border-gray-800"
                                name="name"
                                v-bind="field"
                                placeholder="{{ trans('admin::app.catalog.categories.create.name') }}"
                                v-slugify-target:slug="setValues"
                            >
                        </v-field>

                        <x-admin::form.control-group.error control-name="name" />
                    </x-admin::form.control-group>

                    <div>
                        <!-- Parent category -->
                        <label class="block mb-2.5 text-xs text-gray-800 dark:text-white font-medium leading-6">
                            @lang('admin::app.catalog.categories.create.parent-category')
                        </label>

                        <!-- Radio select button -->
                        <div class="flex flex-col gap-3">
                            <x-admin::tree.view
                                input-type="radio"
                                id-field="id"
                                name-field="parent_id"
                                value-field="id"
                                :items="json_encode($categories)"
                                :fallback-locale="config('app.fallback_locale')"
                            />
                        </div>
                    </div>
                </div>

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.general.after') !!}

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.description_images.before') !!}

                <!-- Description and images -->
                <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                        @lang('admin::app.catalog.categories.create.description-and-images')
                    </p>

                    <!-- Description -->
                    <v-description v-slot="{ isDescriptionRequired }">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label ::class="{ 'required' : isDescriptionRequired}">
                                @lang('admin::app.catalog.categories.create.description')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                id="description"
                                class="description"
                                name="description"
                                ::rules="{ 'required' : isDescriptionRequired}"
                                :value="old('description')"
                                :label="trans('admin::app.catalog.categories.create.description')"
                                :tinymce="true"
                                :prompt="core()->getConfigData('general.magic_ai.content_generation.category_description_prompt')"
                            />

                            <x-admin::form.control-group.error control-name="description" />
                        </x-admin::form.control-group>
                    </v-description>

                    <div class="flex pt-5">
                        <!-- Add Logo -->
                        <div class="flex flex-col gap-2 w-2/5">
                            <p class="text-gray-800 dark:text-white font-medium">
                                @lang('admin::app.catalog.categories.create.logo')
                            </p>

                            <p class="text-xs text-gray-500">
                                @lang('admin::app.catalog.categories.create.logo-size')
                            </p>

                            <x-admin::media.images name="logo_path" />
                        </div>

                        <!-- Add Banner -->
                        <div class="flex flex-col gap-2 w-3/5">
                            <p class="text-gray-800 dark:text-white font-medium">
                                @lang('admin::app.catalog.categories.create.banner')
                            </p>

                            <p class="text-xs text-gray-500">
                                @lang('admin::app.catalog.categories.create.banner-size')
                            </p>

                            <x-admin::media.images
                                name="banner_path"
                                width="220px"
                            />
                        </div>
                    </div>
                </div>

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.description_images.after') !!}

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.seo.before') !!}

                <!-- SEO Deatils -->
                <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <p class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                        @lang('admin::app.catalog.categories.create.seo-details')
                    </p>

                    <!-- SEO Title & Description Blade Componnet -->
                    <x-admin::seo/>

                    <div class="mt-8">
                        <!-- Meta Title -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label>
                                @lang('admin::app.catalog.categories.create.meta-title')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                id="meta_title"
                                name="meta_title"
                                :value="old('meta_title')"
                                :label="trans('admin::app.catalog.categories.create.meta-title')"
                                :placeholder="trans('admin::app.catalog.categories.create.meta-title')"
                            />
                        </x-admin::form.control-group>

                        <!-- Slug -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.catalog.categories.create.slug')
                            </x-admin::form.control-group.label>

                            <v-field
                                type="text"
                                name="slug"
                                rules="required"
                                value="{{ old('slug') }}"
                                label="{{ trans('admin::app.catalog.categories.create.slug') }}"
                                v-slot="{ field }"
                            >
                                <input
                                    type="text"
                                    id="slug"
                                    :class="[errors['{{ 'slug' }}'] ? 'border border-red-600 hover:border-red-600' : '']"
                                    class="flex w-full min-h-[39px] py-2 px-3 border rounded-md text-sm text-gray-600 dark:text-gray-300 transition-all hover:border-gray-400 dark:hover:border-gray-400 focus:border-gray-400 dark:focus:border-gray-400 dark:bg-gray-900 dark:border-gray-800"
                                    name="slug"
                                    v-bind="field"
                                    placeholder="{{ trans('admin::app.catalog.categories.create.slug') }}"
                                    v-slugify-target:slug
                                >
                            </v-field>

                            <x-admin::form.control-group.error control-name="slug" />
                        </x-admin::form.control-group>

                        <!-- Meta Keywords -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label>
                                @lang('admin::app.catalog.categories.create.meta-keywords')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                name="meta_keywords"
                                :value="old('meta_keywords')"
                                :label="trans('admin::app.catalog.categories.create.meta-keywords')"
                                :placeholder="trans('admin::app.catalog.categories.create.meta-keywords')"
                            />
                        </x-admin::form.control-group>

                        <!-- Meta Description -->
                        <x-admin::form.control-group class="!mb-0">
                            <x-admin::form.control-group.label>
                                @lang('admin::app.catalog.categories.create.meta-description')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                id="meta_description"
                                name="meta_description"
                                :value="old('meta_description')"
                                :label="trans('admin::app.catalog.categories.create.meta-description')"
                                :placeholder="trans('admin::app.catalog.categories.create.meta-description')"
                            />
                        </x-admin::form.control-group>
                    </div>
                </div>

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.seo.after') !!}
            </div>

            <!-- Right Section -->
            <div class="flex flex-col gap-2 w-[360px] max-w-full">
                <!-- Settings -->

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.accordion.settings.before') !!}

                <x-admin::accordion>
                    <x-slot:header>
                        <p class="p-2.5 text-base text-gray-800 dark:text-white font-semibold">
                            @lang('admin::app.catalog.categories.create.settings')
                        </p>
                    </x-slot>

                    <x-slot:content>
                        <!-- Position -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required text-gray-800 dark:text-white">
                                @lang('admin::app.catalog.categories.create.position')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="text"
                                name="position"
                                rules="required"
                                :value="old('position')"
                                :label="trans('admin::app.catalog.categories.create.position')"
                                :placeholder="trans('admin::app.catalog.categories.create.enter-position')"
                            />

                            <x-admin::form.control-group.error control-name="position" />
                        </x-admin::form.control-group>

                        <!-- Display Mode  -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required text-gray-800 dark:text-white font-medium required">
                                @lang('admin::app.catalog.categories.create.display-mode')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="select"
                                id="display_mode"
                                class="cursor-pointer"
                                name="display_mode"
                                rules="required"
                                value="products_and_description"
                                :label="trans('admin::app.catalog.categories.create.display-mode')"
                            >
                                <!-- Options -->
                                <option value="products_and_description">
                                    @lang('admin::app.catalog.categories.create.products-and-description')
                                </option>

                                <option value="products_only">
                                    @lang('admin::app.catalog.categories.create.products-only')
                                </option>

                                <option value="description_only">
                                    @lang('admin::app.catalog.categories.create.description-only')
                                </option>
                            </x-admin::form.control-group.control>

                            <x-admin::form.control-group.error control-name="display_mode" />
                        </x-admin::form.control-group>

                        <!-- Visible in menu -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="text-gray-800 dark:text-white font-medium">
                                @lang('admin::app.catalog.categories.create.visible-in-menu')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="switch"
                                class="cursor-pointer"
                                name="status"
                                value="1"
                                :label="trans('admin::app.catalog.categories.create.visible-in-menu')"
                            />
                        </x-admin::form.control-group>
                    </x-slot>
                </x-admin::accordion>

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.accordion.settings.after') !!}

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.accordion.filterable_attributes.before') !!}

                <!-- Filterable Attributes -->
                <x-admin::accordion>
                    <x-slot:header>
                        <p class="required p-2.5 text-base text-gray-800 dark:text-white font-semibold">
                            @lang('admin::app.catalog.categories.create.filterable-attributes')
                        </p>
                    </x-slot>

                    <x-slot:content>
                        @foreach ($attributes as $attribute)
                            <x-admin::form.control-group class="flex gap-2.5 items-center !mb-2 select-none last:!mb-0">
                                <x-admin::form.control-group.control
                                    type="checkbox"
                                    :id="$attribute->name ?? $attribute->admin_name"
                                    name="attributes[]"
                                    rules="required"
                                    :value="$attribute->id"
                                    :label="trans('admin::app.catalog.categories.create.filterable-attributes')"
                                    :for="$attribute->name ?? $attribute->admin_name"
                                    :checked="in_array($attribute->id, old('attributes', []))"
                                />

                                <label
                                    class="text-xs text-gray-600 dark:text-gray-300 font-medium cursor-pointer"
                                    for="{{ $attribute->name ?? $attribute->admin_name }}"
                                >
                                    {{ $attribute->name ?? $attribute->admin_name }}
                                </label>
                            </x-admin::form.control-group>
                        @endforeach

                        <x-admin::form.control-group.error control-name="attributes[]" />
                    </x-slot>
                </x-admin::accordion>

                {!! view_render_event('bagisto.admin.catalog.categories.create.card.accordion.filterable_attributes.after') !!}

            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.categories.create.create_form_controls.after') !!}

    </x-admin::form>

    {!! view_render_event('bagisto.admin.catalog.categories.create.after') !!}

    @pushOnce('scripts')
        <script type="text/x-template" id="v-description-template">
            <div>
                <slot :is-description-required="isDescriptionRequired"></slot>
            </div>
        </script>

        <script type="module">
            app.component('v-description', {
                template: '#v-description-template',

                data() {
                    return {
                        isDescriptionRequired: true,

                        displayMode: "{{ old('display_mode') ?? 'products_and_description' }}",
                    };
                },

                mounted() {
                    this.isDescriptionRequired = this.displayMode !== 'products_only';

                    this.$nextTick(() => {
                        document.querySelector('#display_mode').addEventListener('change', (e) => {
                            this.isDescriptionRequired = e.target.value !== 'products_only';
                        });
                    });
                },
            });
        </script>
    @endPushOnce

</x-admin::layouts>
