<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemReviewRequest;
use App\Http\Requests\UpdateItemReviewRequest;
use App\Http\Resources\Admin\ItemReviewResource;
use App\Models\ItemReview;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemReviewApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('item_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItemReviewResource(ItemReview::with(['place'])->get());
    }

    public function store(StoreItemReviewRequest $request)
    {
        $itemReview = ItemReview::create($request->all());

        return (new ItemReviewResource($itemReview))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ItemReview $itemReview)
    {
        abort_if(Gate::denies('item_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ItemReviewResource($itemReview->load(['place']));
    }

    public function update(UpdateItemReviewRequest $request, ItemReview $itemReview)
    {
        $itemReview->update($request->all());

        return (new ItemReviewResource($itemReview))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ItemReview $itemReview)
    {
        abort_if(Gate::denies('item_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReview->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
