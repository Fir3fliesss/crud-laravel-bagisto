{!! view_render_event('bagisto.admin.catalog.product.edit.form.categories.before', ['product' => $product]) !!}

<!-- Panel -->
<div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
    <!-- Panel Header -->
    <p class="flex justify-between text-base text-gray-800 dark:text-white font-semibold mb-4">
        @lang('admin::app.catalog.products.edit.categories.title')
    </p>

    {!! view_render_event('bagisto.admin.catalog.product.edit.form.categories.controls.before', ['product' => $product]) !!}

    <!-- Panel Content -->
    <div class="mb-5 text-sm text-gray-600 dark:text-gray-300">

        <v-product-categories>
            <x-admin::shimmer.tree />
        </v-product-categories>

    </div>

    {!! view_render_event('bagisto.admin.catalog.product.edit.form.categories.controls.after', ['product' => $product]) !!}
</div>

{!! view_render_event('bagisto.admin.catalog.product.edit.form.categories.after', ['product' => $product]) !!}

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-product-categories-template"
    >
        <div>
            <template v-if="isLoading">
                <x-admin::shimmer.tree />
            </template>

            <template v-else>
                <x-admin::tree.view
                    input-type="checkbox"
                    selection-type="individual"
                    name-field="categories"
                    id-field="id"
                    value-field="id"
                    ::items="categories"
                    :value="json_encode($product->categories->pluck('id'))"
                    :fallback-locale="config('app.fallback_locale')"
                >
                </x-admin::tree.view>
            </template>
        </div>
    </script>

    <script type="module">
        app.component('v-product-categories', {
            template: '#v-product-categories-template',

            data() {
                return {
                    isLoading: true,

                    categories: [],
                }
            },

            mounted() {
                this.get();
            },

            methods: {
                get() {
                    this.$axios.get("{{ route('admin.catalog.categories.tree') }}")
                        .then(response => {
                            this.isLoading = false;

                            this.categories = response.data.data;
                        }).catch(error => {
                            console.log(error);
                        });
                }
            }
        });
    </script>
@endpushOnce
