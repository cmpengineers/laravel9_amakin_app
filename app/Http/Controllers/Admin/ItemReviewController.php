<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemReviewRequest;
use App\Http\Requests\StoreItemReviewRequest;
use App\Http\Requests\UpdateItemReviewRequest;
use App\Models\ItemReview;
use App\Models\Place;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemReviewController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('item_review_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReviews = ItemReview::with(['place'])->get();

        return view('admin.itemReviews.index', compact('itemReviews'));
    }

    public function create()
    {
        abort_if(Gate::denies('item_review_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $places = Place::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.itemReviews.create', compact('places'));
    }

    public function store(StoreItemReviewRequest $request)
    {
        $itemReview = ItemReview::create($request->all());

        return redirect()->route('admin.item-reviews.index');
    }

    public function edit(ItemReview $itemReview)
    {
        abort_if(Gate::denies('item_review_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $places = Place::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $itemReview->load('place');

        return view('admin.itemReviews.edit', compact('itemReview', 'places'));
    }

    public function update(UpdateItemReviewRequest $request, ItemReview $itemReview)
    {
        $itemReview->update($request->all());

        return redirect()->route('admin.item-reviews.index');
    }

    public function show(ItemReview $itemReview)
    {
        abort_if(Gate::denies('item_review_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReview->load('place');

        return view('admin.itemReviews.show', compact('itemReview'));
    }

    public function destroy(ItemReview $itemReview)
    {
        abort_if(Gate::denies('item_review_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReview->delete();

        return back();
    }

    public function massDestroy(MassDestroyItemReviewRequest $request)
    {
        ItemReview::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
