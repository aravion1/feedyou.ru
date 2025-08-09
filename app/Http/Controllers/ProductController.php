<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ProductController extends Controller
{
    protected ProductService $service;
    public function __construct(ProductService $service) {
        $this->service = $service;
    }

    public function listPage(int $page) {
        $list = json_decode($this->service->getList($page), true);
        $data = $list['data'];
        $data['pagination'] = $this->buildPaginationItems($data['count'], $page);
        return view('products.list', $data);
    }

    public function search(int $page, Request $request) {
        $search = $request->get('search') ?? '';
        $list = json_decode($this->service->search($page, $search), true);
        $data = $list['data'];
        $data['pagination'] = $this->buildPaginationItems($data['count'], $page, '?search=' . $search);
        $data['search'] = $search;
        return view('products.list', $data);
    }
    protected function buildPaginationItems(int $itemsCount, int $page, string $params = ''): array {
        $maxPages = (int)ceil($itemsCount / ProductService::PAGE_TAKE);
        $paginationItems = [];
        $start = ($maxPages <= 10 || $page <= 5) ? 1 : $page - 5;
        if ($maxPages <= 10) {
            $end = $maxPages;
        } else {
            $end = $page <= 5 ? 10 : $page + 5;
        }
        for ($i = $start; $i <= $end; $i++) {
            $paginationItems[$i] = [
                'isActive' => $i == $page ? true : false,
                'params' => $params
            ];
        }
        return $paginationItems;
    }
}
