<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ReviewResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Traits\Upload;


class ReviewController extends Controller
{
    use Upload;
    public function index()
    {
        $reviews = Review::with('images')->latest()->get();

        return apiResourceResponse(ReviewResource::collection($reviews), 'Review list');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', 'exists:orders,id', 'integer'],
            'product_id' => ['required', 'exists:products,id', 'integer'],
            'rating' => ['required', 'in:1,2,3,4,5', 'integer'],
            'comment' => ['string', 'required', 'min:5'],
            'gallery' => ['required', 'array'],
            'gallery.*' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:5048'],
        ]);

        // return $request->all();
        if ($validator->fails()) {
            return errorResponse($validator->errors()->first(), 422);
        }

        $reviewCheck = Review::where(['user_id' => auth()->id(), 'product_id' => $request->product_id])->first();

        if ($reviewCheck) {
            $reviewCheck->update([
                'comment' => $request->comment,
                'rating' => $request->rating,
            ]);

            if (isset($request->gallery)) {

                if ($reviewCheck->images) {
                    foreach ($reviewCheck->images as $image) {
                        $this->deleteFile($image->image);
                        $image->delete();
                    }
                }

                foreach ($request->gallery as $image) {
                    $image = $this->uploadFile($image, 'comment');
                    $reviewCheck->images()->create([
                        'image' => $image
                    ]);
                }
            }

            return successResponse('Review submitted');
        }

        $review = Review::create([
            'user_id' => auth()->user()->id,
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        if (isset($request->gallery)) {

            foreach ($request->gallery as $image) {
                $image = $this->uploadFile($image, 'comment');
                $review->images()->create([
                    'image' => $image
                ]);
            }
        }

        return successResponse('Review updated');
    }
}
