<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.marketing.communications.templates.create.title')
    </x-slot>

    {!! view_render_event('bagisto.admin.marketing.communications.templates.create.before') !!}

    <!-- Input Form -->
    <x-admin::form :action="route('admin.marketing.communications.email_templates.store')">

        {!! view_render_event('bagisto.admin.marketing.communications.templates.create.create_form_controls.before') !!}

        <div class="flex justify-between items-center">
            <p class="text-xl text-gray-800 dark:text-white font-bold">
                @lang('admin::app.marketing.communications.templates.create.title')
            </p>

            <div class="flex gap-x-2.5 items-center">
                <!-- Cancel Button -->
                <a
                    href="{{ route('admin.marketing.communications.email_templates.index') }}"
                    class="transparent-button hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-white"
                >
                    @lang('admin::app.marketing.communications.templates.create.back-btn')
                </a>

                <!-- Save Button -->
                <button
                    type="submit"
                    class="primary-button"
                >
                    @lang('admin::app.marketing.communications.templates.create.save-btn')
                </button>
            </div>
        </div>

        <!-- body content -->
        <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">
            <!-- Left sub-component -->
            <div class="flex flex-col gap-2 flex-1 max-xl:flex-auto">

                {!! view_render_event('bagisto.admin.marketing.communications.templates.create.card.content.before') !!}

                <!--Content -->
                <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                    <div class="mb-2.5">
                        <!-- Template Textarea -->
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label class="required">
                                @lang('admin::app.marketing.communications.templates.create.content')
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                id="content"
                                name="content"
                                rules="required"
                                :value="old('content')"
                                :label="trans('admin::app.marketing.communications.templates.create.content')"
                                :placeholder="trans('admin::app.marketing.communications.templates.create.content')"
                                :tinymce="true"
                            />

                            <x-admin::form.control-group.error control-name="content" />
                        </x-admin::form.control-group>
                    </div>
                </div>

                {!! view_render_event('bagisto.admin.marketing.communications.templates.create.card.content.after') !!}

            </div>

            <!-- Right sub-component -->
            <div class="flex flex-col gap-2 w-[360px] max-w-full max-sm:w-full">
                <!-- General -->
                <div class="bg-white dark:bg-gray-900 rounded box-shadow">

                    {!! view_render_event('bagisto.admin.marketing.communications.templates.create.card.accordion.general.before') !!}

                    <x-admin::accordion>
                        <x-slot:header>
                            <div class="flex items-center justify-between">
                                <p class="p-2.5 text-gray-800 dark:text-white text-base  font-semibold">
                                    @lang('admin::app.marketing.communications.templates.create.general')
                                </p>
                            </div>
                        </x-slot>

                        <x-slot:content>
                            <div class="w-full mb-2.5">
                                <!-- Template Name -->
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.marketing.communications.templates.create.name')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="text"
                                        name="name"
                                        rules="required"
                                        :value="old('name')"
                                        :label="trans('admin::app.marketing.communications.templates.create.name')"
                                        :placeholder="trans('admin::app.marketing.communications.templates.create.name')"
                                    />

                                    <x-admin::form.control-group.error control-name="name" />
                                </x-admin::form.control-group>

                                <!-- Template Status -->
                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.marketing.communications.templates.create.status')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="select"
                                        name="status"
                                        rules="required"
                                        :label="trans('admin::app.marketing.communications.templates.create.status')"
                                    >
                                        <!-- Default Option -->
                                        <option value="">
                                            @lang('admin::app.marketing.communications.templates.create.select-status')
                                        </option>

                                        @foreach (['active', 'inactive', 'draft'] as $state)
                                            <option
                                                value="{{ $state }}"
                                                {{ old('status') == $state ? 'selected' : '' }}
                                            >
                                                @lang('admin::app.marketing.communications.templates.create.' . $state)
                                            </option>
                                        @endforeach
                                    </x-admin::form.control-group.control>

                                    <x-admin::form.control-group.error control-name="status" />
                                </x-admin::form.control-group>
                            </div>
                        </x-slot>
                    </x-admin::accordion>

                    {!! view_render_event('bagisto.admin.marketing.communications.templates.create.card.accordion.general.after') !!}

                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.marketing.communications.templates.create.create_form_controls.after') !!}

    </x-admin::form>

    {!! view_render_event('bagisto.admin.marketing.communications.templates.create.after') !!}

</x-admin::layouts>
