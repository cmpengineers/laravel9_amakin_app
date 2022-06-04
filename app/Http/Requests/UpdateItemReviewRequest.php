<?php

namespace App\Http\Requests;

use App\Models\ItemReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateItemReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('item_review_edit');
    }

    public function rules()
    {
        return [
            'quality' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'location' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'service' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'wifi' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'attitude' => [
                'string',
                'required',
            ],
            'noise' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'quietness' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'star' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_score' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'place_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
