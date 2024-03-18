<?php

namespace Webkul\Theme\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Webkul\Admin\Database\Factories\ThemeFactory;
use Webkul\Core\Eloquent\TranslatableModel;
use Webkul\Theme\Contracts\ThemeCustomization as ThemeCustomizationContract;

class ThemeCustomization extends TranslatableModel implements ThemeCustomizationContract
{
    use HasFactory;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'options',
    ];

    /**
     * With the translations given attributes
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * Image carousel precision.
     *
     * @var string
     */
    public const IMAGE_CAROUSEL = 'image_carousel';

    /**
     * Product carousel precision.
     *
     * @var string
     */
    public const PRODUCT_CAROUSEL = 'product_carousel';

    /**
     * Category carousel precision.
     *
     * @var string
     */
    public const CATEGORY_CAROUSEL = 'category_carousel';

    /**
     * Footer links precision.
     *
     * @var string
     */
    public const FOOTER_LINKS = 'footer_links';

    /**
     * Static precision.
     *
     * @var string
     */
    public const STATIC_CONTENT = 'static_content';

    /**
     * Services Content.
     *
     * @var string
     */
    public const SERVICES_CONTENT = 'services_content';

    /**
     * Castable.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Add fillable properties
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'options',
        'sort_order',
        'status',
        'channel_id',
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return ThemeFactory::new();
    }
}
