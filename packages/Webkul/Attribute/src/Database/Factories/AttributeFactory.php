<?php

namespace Webkul\Attribute\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Webkul\Attribute\Models\Attribute;

class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * @var array
     */
    protected $states = [
        'validation_numeric',
        'validation_email',
        'validation_decimal',
        'validation_url',
        'required',
        'unique',
        'filterable',
        'configurable',
    ];

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $types = [
            'text',
            'textarea',
            'price',
            'boolean',
            'select',
            'multiselect',
            'datetime',
            'date',
            'image',
            'file',
            'checkbox',
        ];

        return [
            'admin_name'          => $this->faker->word,
            'code'                => $this->faker->regexify('/^[a-zA-Z]+[a-zA-Z0-9_]+$/'),
            'type'                => array_rand($types),
            'validation'          => '',
            'position'            => $this->faker->randomDigit,
            'is_required'         => false,
            'is_unique'           => false,
            'value_per_locale'    => false,
            'value_per_channel'   => false,
            'is_filterable'       => false,
            'is_configurable'     => false,
            'is_user_defined'     => true,
            'is_visible_on_front' => true,
            'swatch_type'         => null,
        ];
    }

    public function validation_numeric(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'validation' => 'numeric',
            ];
        });
    }

    public function validation_email(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'validation' => 'email',
            ];
        });
    }

    public function validation_decimal(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'validation' => 'decimal',
            ];
        });
    }

    public function validation_url(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'validation' => 'url',
            ];
        });
    }

    public function required(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_required' => true,
            ];
        });
    }

    public function unique(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_unique' => true,
            ];
        });
    }

    public function filterable(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_filterable' => true,
            ];
        });
    }

    public function configurable(): AttributeFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_configurable' => true,
            ];
        });
    }
}
