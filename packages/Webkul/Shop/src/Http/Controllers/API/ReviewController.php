<?php

namespace Webkul\Shop\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\MagicAI\Facades\MagicAI;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\ProductReviewAttachmentRepository;
use Webkul\Product\Repositories\ProductReviewRepository;
use Webkul\Shop\Http\Resources\ProductReviewResource;

class ReviewController extends APIController
{
    /**
     * Create a controller instance.
     *
     * @return void
     */
    public function __construct(
        protected ProductRepository $productRepository,
        protected ProductReviewRepository $productReviewRepository,
        protected ProductReviewAttachmentRepository $productReviewAttachmentRepository
    ) {
    }

    /**
     * Using const variable for status
     */
    const STATUS_APPROVED = 'approved';

    const STATUS_PENDING = 'pending';

    /**
     * Product listings.
     *
     * @param  int  $id
     */
    public function index($id): JsonResource
    {
        $product = $this->productRepository
            ->find($id)
            ->reviews()
            ->Where('status', self::STATUS_APPROVED)
            ->paginate(8);

        return ProductReviewResource::collection($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     */
    public function store($id): JsonResource
    {
        $this->validate(request(), [
            'title'         => 'required',
            'comment'       => 'required',
            'rating'        => 'required|numeric|min:1|max:5',
            'attachments'   => 'array',
            'attachments.*' => 'file|mimetypes:image/*,video/*',
        ]);

        $data = array_merge(request()->only([
            'title',
            'comment',
            'rating',
        ]), [
            'attachments' => request()->file('attachments') ?? [],
            'status'      => self::STATUS_PENDING,
            'product_id'  => $id,
        ]);

        $data['name'] = auth()->guard('customer')->user()?->name ?? request()->input('name');
        $data['customer_id'] = auth()->guard('customer')->id() ?? null;

        $review = $this->productReviewRepository->create($data);

        $this->productReviewAttachmentRepository->upload($data['attachments'], $review);

        return new JsonResource([
            'message' => trans('shop::app.products.view.reviews.success'),
        ]);
    }

    /**
     * Translate the specified resource in storage.
     *
     * @param  int  $id
     * @param  int  $reviewId
     */
    public function translate($id, $reviewId): JsonResponse
    {
        $review = $this->productReviewRepository->find($reviewId);

        $currentLocale = core()->getCurrentLocale();

        $prompt = "
        Translate the following product review to $currentLocale->name. Ensure that the translation retains the sentiment and conveys the meaning accurately. If specific product-related terms or expressions are commonly used in the $currentLocale->name, please adapt accordingly.
        ---

        **Original Product Review:**
        $review->comment

        ---
        Translation:
        ";

        try {
            $model = core()->getConfigData('general.magic_ai.review_translation.model');

            $response = MagicAI::setModel($model)
                ->setPrompt($prompt)
                ->ask();

            return new JsonResponse([
                'content' => $response,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
