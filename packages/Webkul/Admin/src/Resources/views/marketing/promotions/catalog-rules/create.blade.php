<x-admin::layouts>
    <!-- Title of the page -->
    <x-slot:title>
        @lang('admin::app.marketing.promotions.catalog-rules.create.title')
    </x-slot>

    {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.before') !!}

    <!-- Create Catalog form -->
    <v-catalog-rule-create-form></v-catalog-rule-create-form>

    {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.after') !!}

    @pushOnce('scripts')
        <!-- v catalog rule create form template -->
        <script
            type="text/x-template"
            id="v-catalog-rule-create-form-template"
        >
            <div>
                <x-admin::form
                    :action="route('admin.marketing.promotions.catalog_rules.store')"
                    enctype="multipart/form-data"
                >

                    {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.create_form_controls.before') !!}

                    <div class="flex gap-4 justify-between items-center mt-3 max-sm:flex-wrap">
                        <p class="text-xl text-gray-800 dark:text-white font-bold">
                            @lang('admin::app.marketing.promotions.catalog-rules.create.title')
                        </p>

                        <div class="flex gap-x-2.5 items-center">
                            <!-- Cancel Button -->
                            <a
                                href="{{ route('admin.marketing.promotions.catalog_rules.index') }}"
                                class="transparent-button hover:bg-gray-200 dark:hover:bg-gray-800 dark:text-white"
                            >
                                @lang('admin::app.marketing.promotions.catalog-rules.create.back-btn')
                            </a>

                            <!-- Save Button -->
                            <button
                                type="submit"
                                class="primary-button"
                            >
                                @lang('admin::app.marketing.promotions.catalog-rules.create.save-btn')
                            </button>
                        </div>
                    </div>

                    <div class="flex gap-2.5 mt-3.5 max-xl:flex-wrap">
                        <div class="flex flex-col gap-2 flex-1 max-xl:flex-auto">

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.general.before') !!}

                            <!-- General Form -->
                            <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                                <p class="text-base text-gray-800 dark:text-white font-semibold mb-4">
                                    @lang('admin::app.marketing.promotions.catalog-rules.create.general')
                                </p>

                                <x-admin::form.control-group>
                                    <x-admin::form.control-group.label class="required">
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.name')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="text"
                                        id="name"
                                        name="name"
                                        rules="required"
                                        :value="old('name')"
                                        :label="trans('admin::app.marketing.promotions.catalog-rules.create.name')"
                                        :placeholder="trans('admin::app.marketing.promotions.catalog-rules.create.name')"
                                    />

                                    <x-admin::form.control-group.error control-name="name" />
                                </x-admin::form.control-group>

                                <x-admin::form.control-group class="!mb-0">
                                    <x-admin::form.control-group.label>
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.description')
                                    </x-admin::form.control-group.label>

                                    <x-admin::form.control-group.control
                                        type="textarea"
                                        class="text-gray-600 dark:text-gray-300"
                                        id="description"
                                        name="description"
                                        :value="old('description')"
                                        :label="trans('admin::app.marketing.promotions.catalog-rules.create.description')"
                                        :placeholder="trans('admin::app.marketing.promotions.catalog-rules.create.description')"
                                    />

                                    <x-admin::form.control-group.error control-name="description" />
                                </x-admin::form.control-group>
                            </div>

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.general.after') !!}

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.conditions.before') !!}

                            <!-- Conditions -->
                            <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                                <div class="flex gap-4 items-center justify-between">
                                    <p class="text-base text-gray-800 dark:text-white font-semibold">
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.conditions')
                                    </p>

                                    <x-admin::form.control-group class="!mb-0">
                                        <x-admin::form.control-group.control
                                            type="select"
                                            class="ltr:pr-10 rtl:pl-10 text-gray-400 dark:border-gray-800"
                                            id="condition_type"
                                            name="condition_type"
                                            v-model="conditionType"
                                            :label="trans('admin::app.marketing.promotions.catalog-rules.condition-type')"
                                            :placeholder="trans('admin::app.marketing.promotions.catalog-rules.condition-type')"
                                        >
                                            <option value="1">
                                                @lang('admin::app.marketing.promotions.catalog-rules.create.all-conditions-true')
                                            </option>

                                            <option value="2">
                                                @lang('admin::app.marketing.promotions.catalog-rules.create.any-conditions-true')
                                            </option>
                                        </x-admin::form.control-group.control>

                                        <x-admin::form.control-group.error control-name="condition_type" />
                                    </x-admin::form.control-group>
                                </div>

                                <v-catalog-rule-condition-item
                                    v-for='(condition, index) in conditions'
                                    :condition="condition"
                                    :key="index"
                                    :index="index"
                                    @onRemoveCondition="removeCondition($event)"
                                >
                                </v-catalog-rule-condition-item>

                                <div
                                    class="secondary-button max-w-max mt-4"
                                    @click="addCondition"
                                >
                                    @lang('admin::app.marketing.promotions.catalog-rules.create.add-condition')
                                </div>

                            </div>

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.conditions.after') !!}

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.actions.before') !!}

                            <!-- Actions -->
                            <div class="p-4 bg-white dark:bg-gray-900 rounded box-shadow">
                                <div class="grid gap-1.5">
                                    <p class="mb-4 text-base text-gray-800 dark:text-white font-semibold">
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.actions')
                                    </p>

                                    <div class="flex gap-4 max-sm:flex-wrap">
                                        <div class="w-full">
                                            <x-admin::form.control-group>
                                                <x-admin::form.control-group.label class="required">
                                                    @lang('admin::app.marketing.promotions.catalog-rules.create.action-type')
                                                </x-admin::form.control-group.label>

                                                <x-admin::form.control-group.control
                                                    type="select"
                                                    class="h-[39px]"
                                                    id="action_type"
                                                    name="action_type"
                                                    rules="required"
                                                    :value="old('action_type') ?? 'by_percent'"
                                                    :label="trans('admin:create:app.promotions.catalog-rules.create.action-type')"
                                                >
                                                    <option
                                                        value="by_percent"
                                                        {{ old('action_type') == 'by_percent' ? 'selected' : '' }}
                                                    >
                                                        @lang('admin::app.marketing.promotions.catalog-rules.create.percentage-product-price')
                                                    </option>

                                                    <option
                                                        value="by_fixed"
                                                        {{ old('action_type') == 'by_fixed' ? 'selected' : '' }}
                                                    >
                                                        @lang('admin::app.marketing.promotions.catalog-rules.create.fixed-amount')
                                                    </option>
                                                </x-admin::form.control-group.control>

                                                <x-admin::form.control-group.error control-name="action_type" />
                                            </x-admin::form.control-group>
                                        </div>

                                        <div class="w-full">
                                            <x-admin::form.control-group>
                                                <x-admin::form.control-group.label class="required">
                                                    @lang('admin::app.marketing.promotions.catalog-rules.create.discount-amount')
                                                </x-admin::form.control-group.label>

                                                <x-admin::form.control-group.control
                                                    type="text"
                                                    id="discount_amount"
                                                    name="discount_amount"
                                                    rules="required"
                                                    :value="old('discount_amount') ?? 0"
                                                    :label="trans('admin::app.marketing.promotions.catalog-rules.create.discount-amount')"
                                                />

                                                <x-admin::form.control-group.error control-name="discount_amount" />
                                            </x-admin::form.control-group>
                                        </div>

                                        <div class="w-full">
                                            <x-admin::form.control-group>
                                                <x-admin::form.control-group.label>
                                                    @lang('admin::app.marketing.promotions.catalog-rules.create.end-other-rules')
                                                </x-admin::form.control-group.label>

                                                <x-admin::form.control-group.control
                                                    type="select"
                                                    class="h-[39px]"
                                                    id="end_other_rules"
                                                    name="end_other_rules"
                                                    :value="old('end_other_rules') ?? 0"
                                                    :label="trans('admin::app.marketing.promotions.catalog-rules.create.end-other-rules')"
                                                >
                                                    <option
                                                        value="0"
                                                        {{ ! old('end_other_rules') ? 'selected' : '' }}
                                                    >
                                                        @lang('admin::app.marketing.promotions.catalog-rules.create.no')
                                                    </option>

                                                    <option
                                                        value="1"
                                                        {{ old('end_other_rules') ? 'selected' : '' }}
                                                    >
                                                        @lang('admin::app.marketing.promotions.catalog-rules.create.yes')
                                                    </option>
                                                </x-admin::form.control-group.control>

                                                <x-admin::form.control-group.error control-name="end_other_rules" />
                                            </x-admin::form.control-group>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.actions.after') !!}

                        </div>

                        <!-- Right sub-components -->
                        <div class="flex flex-col gap-2 w-[360px] max-w-full max-sm:w-full">

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.accordion.settings.before') !!}

                            <!-- Settings -->
                            <x-admin::accordion>
                                <x-slot:header>
                                    <p class="p-2.5 text-gray-800 dark:text-white text-base font-semibold">
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.settings')
                                    </p>
                                </x-slot>

                                <x-slot:content>
                                    <x-admin::form.control-group>
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.marketing.promotions.catalog-rules.create.priority')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="text"
                                            id="sort_order"
                                            name="sort_order"
                                            :value="old('sort_order')"
                                            :label="trans('admin::app.marketing.promotions.catalog-rules.create.priority')"
                                            :placeholder="trans('admin::app.marketing.promotions.catalog-rules.create.priority')"
                                        />

                                        <x-admin::form.control-group.error control-name="sort_order" />
                                    </x-admin::form.control-group>

                                    <!-- channels -->
                                    <div class="mb-4">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.marketing.promotions.catalog-rules.create.channels')
                                        </x-admin::form.control-group.label>

                                        @foreach(core()->getAllChannels() as $channel)
                                            <x-admin::form.control-group class="flex items-center gap-2.5 !mb-2">
                                                <x-admin::form.control-group.control
                                                    type="checkbox"
                                                    :id="'channel_' . '_' . $channel->id"
                                                    name="channels[]"
                                                    rules="required"
                                                    :value="$channel->id"
                                                    :for="'channel_' . '_' . $channel->id"
                                                    :label="trans('admin::app.marketing.promotions.catalog-rules.create.channels')"
                                                    :checked="in_array($channel->id, old('channels[]', []))"
                                                />

                                                <label
                                                    class="text-xs text-gray-600 dark:text-gray-300 font-medium cursor-pointer"
                                                    for="{{ 'channel_' . '_' . $channel->id }}"
                                                >
                                                    {{ core()->getChannelName($channel) }}
                                                </label>
                                            </x-admin::form.control-group>
                                        @endforeach

                                        <x-admin::form.control-group.error control-name="channels[]" />
                                    </div>

                                    <!-- Customer Groups -->
                                    <div class="mb-4">
                                        <x-admin::form.control-group.label class="required">
                                            @lang('admin::app.marketing.promotions.catalog-rules.create.customer-groups')
                                        </x-admin::form.control-group.label>

                                        @foreach(app('Webkul\Customer\Repositories\CustomerGroupRepository')->all() as $customerGroup)
                                            <x-admin::form.control-group class="flex items-center gap-2.5 !mb-2">
                                                <x-admin::form.control-group.control
                                                    type="checkbox"
                                                    :id="'customer_group_' . '_' . $customerGroup->id"
                                                    name="customer_groups[]"
                                                    rules="required"
                                                    :value="$customerGroup->id"
                                                    :for="'customer_group_' . '_' . $customerGroup->id"
                                                    :label="trans('admin::app.marketing.promotions.catalog-rules.create.customer-groups')"
                                                    :checked="in_array($customerGroup->id, old('customer_groups[]', []))"
                                                />

                                                <label
                                                    class="text-xs text-gray-600 dark:text-gray-300 font-medium cursor-pointer"
                                                    for="{{ 'customer_group_' . '_' . $customerGroup->id }}"
                                                >
                                                    {{ $customerGroup->name }}
                                                </label>
                                            </x-admin::form.control-group>
                                        @endforeach

                                        <x-admin::form.control-group.error control-name="customer_groups[]" />
                                    </div>

                                    <!-- Status -->
                                    <x-admin::form.control-group class="!mb-0">
                                        <x-admin::form.control-group.label>
                                            @lang('admin::app.marketing.promotions.catalog-rules.create.status')
                                        </x-admin::form.control-group.label>

                                        <x-admin::form.control-group.control
                                            type="switch"
                                            name="status"
                                            value="1"
                                            :label="trans('admin::app.marketing.promotions.catalog-rules.create.status')"
                                        />

                                        <x-admin::form.control-group.error control-name="status" />
                                    </x-admin::form.control-group>
                                </x-slot>
                            </x-admin::accordion>

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.accordion.settings.after') !!}

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.accordion.marketing_time.before') !!}

                            <!-- Marketing Time-->
                            <x-admin::accordion>
                                <x-slot:header>
                                    <p class="p-2.5 text-gray-800 dark:text-white text-base font-semibold">
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.marketing-time')
                                    </p>
                                </x-slot>

                                <x-slot:content>
                                    <div class="flex gap-4">
                                        <x-admin::form.control-group class="!mb-0">
                                            <x-admin::form.control-group.label>
                                                @lang('admin::app.marketing.promotions.catalog-rules.create.from')
                                            </x-admin::form.control-group.label>

                                            <x-admin::form.control-group.control
                                                type="date"
                                                id="starts_from"
                                                name="starts_from"
                                                :value="old('starts_from')"
                                                :label="trans('admin::app.marketing.promotions.catalog-rules.create.from')"
                                                :placeholder="trans('admin::app.marketing.promotions.catalog-rules.create.from')"
                                            />

                                            <x-admin::form.control-group.error control-name="starts_from" />
                                        </x-admin::form.control-group>

                                        <x-admin::form.control-group class="!mb-0">
                                            <x-admin::form.control-group.label>
                                                @lang('admin::app.marketing.promotions.catalog-rules.create.to')
                                            </x-admin::form.control-group.label>

                                            <x-admin::form.control-group.control
                                                type="date"
                                                id="ends_till"
                                                name="ends_till"
                                                :value="old('ends_till')"
                                                :label="trans('admin::app.marketing.promotions.catalog-rules.create.to')"
                                                :placeholder="trans('admin::app.marketing.promotions.catalog-rules.create.to')"
                                            />

                                            <x-admin::form.control-group.error control-name="ends_till" />
                                        </x-admin::form.control-group>
                                    </div>
                                </x-slot>
                            </x-admin::accordion>

                            {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.card.accordion.marketing_time.after') !!}

                        </div>
                    </div>

                    {!! view_render_event('bagisto.admin.marketing.promotions.catalog_rules.create.create_form_controls.after') !!}

                </x-admin::form>
            </div>
        </script>

        <!-- v catalog rule create form component -->
        <script type="module">
            app.component('v-catalog-rule-create-form', {
                template: '#v-catalog-rule-create-form-template',

                data() {
                    return {
                        conditionType: "{{ old('condition_type', 1) }}",

                        conditions: []
                    }
                },

                methods: {
                    addCondition() {
                        this.conditions.push({
                            'attribute': '',
                            'operator': '==',
                            'value': '',
                        });
                    },

                    removeCondition(condition) {
                        let index = this.conditions.indexOf(condition)

                        this.conditions.splice(index, 1)
                    },

                    onSubmit(e) {
                        this.$root.onSubmit(e)
                    },

                    redirectBack(fallbackUrl) {
                        this.$root.redirectBack(fallbackUrl)
                    }
                }
            })
        </script>

        <!-- v catalog rule condition item form template -->
        <script type="text/x-template" id="v-catalog-rule-condition-item-template">
            <div class="flex gap-4 justify-between mt-4">
                <div class="flex gap-4 flex-1 max-sm:flex-wrap max-sm:flex-1">
                    <select
                        :name="['conditions[' + index + '][attribute]']"
                        :id="['conditions[' + index + '][attribute]']"
                        class="custom-select flex w-1/3 min:w-1/3 h-10 py-1.5 px-3 bg-white dark:bg-gray-900 border dark:border-gray-800 rounded-md text-sm text-gray-600 dark:text-gray-300 font-normal transition-all hover:border-gray-400 ltr:pr-10 rtl:pl-10"
                        v-model="condition.attribute"
                    >
                        <option value="">@lang('admin::app.marketing.promotions.catalog-rules.create.choose-condition-to-add')</option>

                        <optgroup
                            v-for='(conditionAttribute, index) in conditionAttributes'
                            :label="conditionAttribute.label"
                        >
                            <option
                                v-for='(childAttribute, index) in conditionAttribute.children'
                                :value="childAttribute.key"
                                :text="childAttribute.label"
                            >
                            </option>
                        </optgroup>
                    </select>

                    <select
                        :name="['conditions[' + index + '][operator]']"
                        class="custom-select flex w-1/3 min:w-1/3 h-10 py-1.5 px-3 bg-white dark:bg-gray-900 border dark:border-gray-800 rounded-md text-sm text-gray-600 dark:text-gray-300 font-normal transition-all hover:border-gray-400 ltr:pr-10 rtl:pl-10"
                        v-model="condition.operator"
                        v-if="matchedAttribute"
                    >
                        <option
                            v-for='operator in conditionOperators[matchedAttribute.type]'
                            :value="operator.operator"
                            :text="operator.label"
                        >
                        </option>
                    </select>

                    <div v-if="matchedAttribute">
                        <input
                            type="hidden"
                            :name="['conditions[' + index + '][attribute_type]']"
                            v-model="matchedAttribute.type"
                        >

                        <div v-if="matchedAttribute.key == 'product|category_ids'">
                            <x-admin::tree.view
                                input-type="checkbox"
                                selection-type="individual"
                                id-field="id"
                                ::name-field="'conditions[' + index + '][value]'"
                                value-field="id"
                                ::items='matchedAttribute.options'
                                :fallback-locale="config('app.fallback_locale')"
                            />
                        </div>

                        <div v-else>
                            <div
                                v-if="matchedAttribute.type == 'text'
                                    || matchedAttribute.type == 'price'
                                    || matchedAttribute.type == 'decimal'
                                    || matchedAttribute.type == 'integer'"
                            >
                                <v-field
                                    :name="`conditions[${index}][value]`"
                                    v-slot="{ field, errorMessage}"
                                    :id="`conditions[${index}][value]`"
                                    :rules="matchedAttribute.type == 'price' ? 'regex:^[0-9]+(\.[0-9]+)?$' : ''
                                        || matchedAttribute.type == 'decimal' ? 'regex:^[0-9]+(\.[0-9]+)?$' : ''
                                        || matchedAttribute.type == 'integer' ? 'regex:^[0-9]+(\.[0-9]+)?$' : ''
                                        || matchedAttribute.type == 'text' ? 'regex:^([A-Za-z0-9_ \'\-]+)$' : ''"
                                    label="@lang('admin::app.marketing.promotions.catalog-rules.create.conditions')"
                                    v-model="condition.value"
                                >
                                    <input
                                        type="text"
                                        :class="{ 'border border-red-500': errorMessage }"
                                        class="flex w-[289px] min:w-1/3 h-10 py-1.5 px-3 bg-white dark:bg-gray-900 border dark:border-gray-800 rounded-md text-sm text-gray-600 dark:text-gray-300 font-normal transition-all hover:border-gray-400 ltr:pr-10 rtl:pl-10"
                                        v-bind="field"
                                    />
                                </v-field>

                                <v-error-message
                                    :name="`conditions[${index}][value]`"
                                    class="mt-1 text-red-500 text-xs italic"
                                    as="p"
                                >
                                </v-error-message>
                            </div>

                            <div v-if="matchedAttribute.type == 'date'">
                                <x-admin::flat-picker.date class="!w-[140px]" ::allow-input="false">
                                    <input
                                        type="date"
                                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
                                        :name="['conditions[' + index + '][value]']"
                                        v-model="condition.value"
                                    />
                                </x-admin::flat-picker.date>
                            </div>

                            <div v-if="matchedAttribute.type == 'datetime'">
                                <x-admin::flat-picker.date class="!w-[140px]" ::allow-input="false">
                                    <input
                                        type="datetime"
                                        class="flex min-h-[39px] w-full rounded-md border px-3 py-2 text-sm text-gray-600 transition-all hover:border-gray-400 dark:hover:border-gray-400 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300"
                                        :name="['conditions[' + index + '][value]']"
                                        v-model="condition.value"
                                    />
                                </x-admin::flat-picker.date>
                            </div>

                            <div v-if="matchedAttribute.type == 'boolean'">
                                <select
                                    :name="['conditions[' + index + '][value]']"
                                    class="custom-select inline-flex gap-x-1 justify-between items-center h-10 w-[196px] max-w-[196px] py-1.5 ltr:pl-3 rtl:pr-3 px-3 bg-white dark:bg-gray-900 border dark:border-gray-800 rounded-md text-sm text-gray-600 dark:text-gray-300 font-normal cursor-pointer marker:shadow appearance-none focus:ring-2 focus:outline-none focus:ring-black transition-all hover:border-gray-400"
                                    v-model="condition.value"
                                >
                                    <option value="1">
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.yes')
                                    </option>

                                    <option value="0">
                                        @lang('admin::app.marketing.promotions.catalog-rules.create.no')
                                    </option>
                                </select>
                            </div>

                            <div v-if="matchedAttribute.type == 'select' || matchedAttribute.type == 'radio'">
                                <select
                                    :name="['conditions[' + index + '][value]']"
                                    class="custom-select flex w-[289px] min:w-1/3 h-10 py-1.5 px-3 bg-white dark:bg-gray-900 border dark:border-gray-800 rounded-md text-sm text-gray-600 dark:text-gray-300 font-normal transition-all hover:border-gray-400 ltr:pr-10 rtl:pl-10"
                                    v-if="matchedAttribute.key != 'catalog|state'"
                                    v-model="condition.value"
                                >
                                    <option
                                        v-for='option in matchedAttribute.options'
                                        :value="option.id"
                                        :text="option.admin_name"
                                    >
                                    </option>
                                </select>

                                <select
                                    :name="['conditions[' + index + '][value]']"
                                    class="custom-select flex w-[289px] min:w-1/3 h-10 py-1.5 px-3 bg-white dark:bg-gray-900 border dark:border-gray-800 rounded-md text-sm text-gray-600 dark:text-gray-300 font-normal transition-all hover:border-gray-400 ltr:pr-10 rtl:pl-10"
                                    v-model="condition.value"
                                    v-else
                                >
                                    <optgroup
                                        v-for='option in matchedAttribute.options'
                                        :label="option.admin_name"
                                    >
                                        <option
                                            v-for='state in option.states'
                                            :value="state.code"
                                            :text="state.admin_name"
                                        >
                                        </option>
                                    </optgroup>
                                </select>
                            </div>

                            <div v-if="matchedAttribute.type == 'multiselect' || matchedAttribute.type == 'checkbox'">
                                <select
                                    :name="['conditions[' + index + '][value][]']"
                                    class="custom-select flex w-[289px] min:w-1/3 h-10 py-1.5 px-3 bg-white dark:bg-gray-900 border dark:border-gray-800 rounded-md text-sm text-gray-600 dark:text-gray-300 font-normal transition-all hover:border-gray-400 ltr:pr-10 rtl:pl-10"
                                    v-model="condition.value"
                                    multiple
                                >
                                    <option
                                        v-for='option in matchedAttribute.options'
                                        :value="option.id"
                                        :text="option.admin_name"
                                    >
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <span
                    class="icon-delete max-h-9 max-w-9 text-2xl p-1.5 rounded-md cursor-pointer transition-all hover:bg-gray-100 dark:hover:bg-gray-950 max-sm:place-self-center"
                    @click="removeCondition"
                >
                </span>
            </div>
        </script>

        <!-- v catalog rule condition item component -->
        <script type="module">
            app.component('v-catalog-rule-condition-item', {
                template: "#v-catalog-rule-condition-item-template",

                props: ['index', 'condition'],

                data() {
                    return {
                        conditionAttributes: @json(app('\Webkul\CatalogRule\Repositories\CatalogRuleRepository')->getConditionAttributes()),

                        attributeTypeIndexes: {
                            'product': 0
                        },

                        conditionOperators: {
                            'price': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }, {
                                    'operator': '>=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-greater-than')"
                                }, {
                                    'operator': '<=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-less-than')"
                                }, {
                                    'operator': '>',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.greater-than')"
                                }, {
                                    'operator': '<',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.less-than')"
                                }],
                            'decimal': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }, {
                                    'operator': '>=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-greater-than')"
                                }, {
                                    'operator': '<=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-less-than')"
                                }, {
                                    'operator': '>',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.greater-than')"
                                }, {
                                    'operator': '<',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.less-than')"
                                }],
                            'integer': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }, {
                                    'operator': '>=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-greater-than')"
                                }, {
                                    'operator': '<=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-less-than')"
                                }, {
                                    'operator': '>',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.greater-than')"
                                }, {
                                    'operator': '<',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.less-than')"
                                }],
                            'text': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }, {
                                    'operator': '{}',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.contain')"
                                }, {
                                    'operator': '!{}',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.does-not-contain')"
                                }],
                            'boolean': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }],
                            'date': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }, {
                                    'operator': '>=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-greater-than')"
                                }, {
                                    'operator': '<=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-less-than')"
                                }, {
                                    'operator': '>',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.greater-than')"
                                }, {
                                    'operator': '<',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.less-than')"
                                }],
                            'datetime': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }, {
                                    'operator': '>=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-greater-than')"
                                }, {
                                    'operator': '<=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.equals-or-less-than')"
                                }, {
                                    'operator': '>',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.greater-than')"
                                }, {
                                    'operator': '<',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.less-than')"
                                }],
                            'select': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }],
                            'radio': [{
                                    'operator': '==',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-equal-to')"
                                }, {
                                    'operator': '!=',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.is-not-equal-to')"
                                }],
                            'multiselect': [{
                                    'operator': '{}',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.contains')"
                                }, {
                                    'operator': '!{}',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.does-not-contain')"
                                }],
                            'checkbox': [{
                                    'operator': '{}',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.contains')"
                                }, {
                                    'operator': '!{}',
                                    'label': "@lang('admin::app.marketing.promotions.catalog-rules.create.does-not-contain')"
                                }]
                        }
                    }
                },

                computed: {
                    matchedAttribute() {
                        if (this.condition.attribute == '')
                            return;

                        let attributeIndex = this.attributeTypeIndexes[this.condition.attribute.split("|")[0]];

                        let matchedAttribute = this.conditionAttributes[attributeIndex]['children'].filter((attribute) => {
                            return attribute.key == this.condition.attribute;
                        });

                        if (matchedAttribute[0]['type'] == 'multiselect' || matchedAttribute[0]['type'] == 'checkbox') {
                            this.condition.operator = '{}';

                            this.condition.value = [];
                        }

                        return matchedAttribute[0];
                    }
                },

                methods: {
                    removeCondition() {
                        this.$emit('onRemoveCondition', this.condition)
                    },
                }
            });
        </script>
    @endPushOnce
</x-admin::layouts>
