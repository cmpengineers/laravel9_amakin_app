<?php

namespace App\Http\Requests;

use App\Models\ItemReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyItemReviewRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('item_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:item_reviews,id',
        ];
    }
}
