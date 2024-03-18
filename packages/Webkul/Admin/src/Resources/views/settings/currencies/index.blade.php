<x-admin::layouts>
    <x-slot:title>
        @lang('admin::app.settings.currencies.index.title')
    </x-slot>

    {!! view_render_event('bagisto.admin.settings.currencies.create.before') !!}

    <v-currencies>
        <div class="flex  gap-4 justify-between items-center max-sm:flex-wrap">
            <p class="text-xl text-gray-800 dark:text-white font-bold">
                @lang('admin::app.settings.currencies.index.title')
            </p>

            <div class="flex gap-x-2.5 items-center">
                <!-- Create currency Button -->
                @if (bouncer()->hasPermission('settings.currencies.create'))
                    <button
                        type="button"
                        class="primary-button"
                    >
                        @lang('admin::app.settings.currencies.index.create-btn')
                    </button>
                @endif
            </div>
        </div>

        <!-- DataGrid Shimmer -->
        <x-admin::shimmer.datagrid />
    </v-currencies>

    {!! view_render_event('bagisto.admin.settings.currencies.create.after') !!}

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-currencies-template"
        >
            <div class="flex gap-4 justify-between items-center max-sm:flex-wrap">
                <p class="text-xl text-gray-800 dark:text-white font-bold">
                    @lang('admin::app.settings.currencies.index.title')
                </p>

                <div class="flex gap-x-2.5 items-center">
                    <!-- Create currency Button -->
                    @if (bouncer()->hasPermission('settings.currencies.create'))
                        <button
                            type="button"
                            class="primary-button"
                            @click="selectedCurrencies=0; selectedCurrency={}; $refs.currencyUpdateOrCreateModal.toggle()"
                        >
                            @lang('admin::app.settings.currencies.index.create-btn')
                        </button>
                    @endif
                </div>
            </div>

            <x-admin::datagrid
                :src="route('admin.settings.currencies.index')"
                ref="datagrid"
            >
                <!-- DataGrid Body -->
                <template #body="{ columns, records, performAction }">
                    <div
                        v-for="record in records"
                        class="row grid gap-2.5 items-center px-4 py-4 border-b dark:border-gray-800 text-gray-600 dark:text-gray-300 transition-all hover:bg-gray-50 dark:hover:bg-gray-950"
                        :style="`grid-template-columns: repeat(${gridsCount}, minmax(0, 1fr))`"
                    >
                        <!-- Id -->
                        <p v-text="record.id"></p>

                        <!-- Code -->
                        <p v-text="record.code"></p>

                        <!-- Name -->
                        <p v-text="record.name"></p>

                        <!-- Actions -->
                        <div class="flex justify-end">
                            @if (bouncer()->hasPermission('settings.currencies.edit'))
                                <a @click="selectedCurrencies=1; editModal(record.actions.find(action => action.index === 'edit')?.url)">
                                    <span
                                        :class="record.actions.find(action => action.index === 'edit')?.icon"
                                        class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                    >
                                    </span>
                                </a>
                            @endif

                            @if (bouncer()->hasPermission('settings.currencies.delete'))
                                <a @click="performAction(record.actions.find(action => action.index === 'delete'))">
                                    <span
                                        :class="record.actions.find(action => action.index === 'delete')?.icon"
                                        class="cursor-pointer rounded-md p-1.5 text-2xl transition-all hover:bg-gray-200 dark:hover:bg-gray-800 max-sm:place-self-center"
                                    >
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                </template>
            </x-admin::datagrid>

            <!-- Modal Form -->
            <x-admin::form
                v-slot="{ meta, errors, handleSubmit }"
                as="div"
                ref="modalForm"
            >
                <form
                    @submit="handleSubmit($event, updateOrCreate)"
                    ref="currencyCreateForm"
                >
                    <x-admin::modal ref="currencyUpdateOrCreateModal">
                        <!-- Modal Header -->
                        <x-slot:header>
                            <p
                                class="text-lg text-gray-800 dark:text-white font-bold"
                                v-if="selectedCurrencies"
                            >
                                @lang('admin::app.settings.currencies.index.edit.title')
                            </p>

                            <p
                                class="text-lg text-gray-800 dark:text-white font-bold"
                                v-else
                            >
                                @lang('admin::app.settings.currencies.index.create.title')
                            </p>
                        </x-slot>

                        <!-- Modal Content -->
                        <x-slot:content>
                            {!! view_render_event('bagisto.admin.settings.currencies.create.before') !!}

                            <x-admin::form.control-group.control
                                type="hidden"
                                name="id"
                                v-model="selectedCurrency.id"
                            />

                            <!-- Code -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.settings.currencies.index.create.code')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="code"
                                    rules="required|min:3|max:3"
                                    :value="old('code')"
                                    v-model="selectedCurrency.code"
                                    :label="trans('admin::app.settings.currencies.index.create.code')"
                                    :placeholder="trans('admin::app.settings.currencies.index.create.code')"
                                />

                                <x-admin::form.control-group.error control-name="code" />
                            </x-admin::form.control-group>

                            <!-- Name -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label class="required">
                                    @lang('admin::app.settings.currencies.index.create.name')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="name"
                                    rules="required"
                                    :value="old('name')"
                                    v-model="selectedCurrency.name"
                                    :label="trans('admin::app.settings.currencies.index.create.name')"
                                    :placeholder="trans('admin::app.settings.currencies.index.create.name')"
                                />

                                <x-admin::form.control-group.error control-name="name" />
                            </x-admin::form.control-group>

                            <!-- Symbol -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.settings.currencies.index.create.symbol')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="symbol"
                                    :value="old('symbol')"
                                    v-model="selectedCurrency.symbol"
                                    :label="trans('admin::app.settings.currencies.index.create.symbol')"
                                    :placeholder="trans('admin::app.settings.currencies.index.create.symbol')"
                                />

                                <x-admin::form.control-group.error control-name="symbol" />
                            </x-admin::form.control-group>

                            <!-- Decimal -->
                            <x-admin::form.control-group>
                                <x-admin::form.control-group.label>
                                    @lang('admin::app.settings.currencies.index.create.decimal')
                                </x-admin::form.control-group.label>

                                <x-admin::form.control-group.control
                                    type="text"
                                    name="decimal"
                                    :value="old('decimal')"
                                    v-model="selectedCurrency.decimal"
                                    :label="trans('admin::app.settings.currencies.index.create.decimal')"
                                    :placeholder="trans('admin::app.settings.currencies.index.create.decimal')"
                                />

                                <x-admin::form.control-group.error control-name="decimal" />
                            </x-admin::form.control-group>

                            {!! view_render_event('bagisto.admin.settings.currencies.create.after') !!}
                        </x-slot>

                        <!-- Modal Footer -->
                        <x-slot:footer>
                            <div class="flex gap-x-2.5 items-center">
                               <button
                                    type="submit"
                                    class="primary-button"
                                >
                                    @lang('admin::app.settings.currencies.index.create.save-btn')
                                </button>
                            </div>
                        </x-slot>
                    </x-admin::modal>
                </form>
            </x-admin::form>
        </script>

        <script type="module">
            app.component('v-currencies', {
                template: '#v-currencies-template',

                data() {
                    return {
                        selectedCurrency: {},

                        selectedCurrencies: 0,
                    }
                },

                computed: {
                    gridsCount() {
                        let count = this.$refs.datagrid.available.columns.length;

                        if (this.$refs.datagrid.available.actions.length) {
                            ++count;
                        }

                        if (this.$refs.datagrid.available.massActions.length) {
                            ++count;
                        }

                        return count;
                    },
                },

                methods: {
                    updateOrCreate(params, { resetForm, setErrors  }) {
                        let formData = new FormData(this.$refs.currencyCreateForm);

                        if (params.id) {
                            formData.append('_method', 'put');
                        }

                        this.$axios.post(params.id ? "{{ route('admin.settings.currencies.update') }}" : "{{ route('admin.settings.currencies.store') }}", formData)
                        .then((response) => {
                            this.$refs.currencyUpdateOrCreateModal.close();

                            this.$refs.datagrid.get();

                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                            resetForm();
                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                setErrors(error.response.data.errors);
                            }
                        });
                    },

                    editModal(url) {
                        this.$axios.get(url)
                            .then((response) => {
                                this.selectedCurrency = response.data;

                                this.$refs.currencyUpdateOrCreateModal.toggle();
                            })
                            .catch(error => {
                                this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message })
                            });
                    },
                }
            })
        </script>
    @endPushOnce
</x-admin::layouts>
