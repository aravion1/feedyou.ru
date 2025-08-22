<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ProductController extends Controller
{
    const PRODUCT_PAGE_DESCRIPTION = 'Ищите идеальное сочетание продуктов питания с подробными данными о их калорийности, содержании белков, жиров и углеводов? Познакомьтесь с нашим полным списком продуктов, где каждый продукт сопровождается точными значениями КБЖУ. Удобный поиск, четкие данные - все для вашего здорового питания и контроля веса. Оптимизируйте свой рацион с нашими данными КБЖУ прямо сейчас!';
    private static $productKeyWordsTemplates = [
        'Сколько калорий в ',
        'КБЖУ ',
        'Сколько углеводов в ',
        'Сколько белков в ',
        'Сколько жиров в ',
        'Калорийность ',
        '',
    ];
    protected ProductService $service;
    public function __construct(ProductService $service) {
        $this->service = $service;
    }

    public function listPage(int $page) {
        $list = json_decode($this->service->getList($page), true);
        $data = $list['data'];
        $data['pagination'] = $this->buildPaginationItems($data['count'], $page);
        $data['seo'] = $this->buildSeo($data['list']);
        return view('products.list', $data);
    }

    public function search(int $page, Request $request) {
        $search = $request->get('search') ?? '';
        if (empty($search)) {
            return redirect(route('products', 1));
        }
        $list = json_decode($this->service->search($page, $search), true);
        $data = $list['data'];
        $data['pagination'] = $this->buildPaginationItems($data['count'], $page, '?search=' . $search);
        $data['search'] = $search;
        $data['seo'] = $this->buildSeo($data['list']);
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

    protected function buildSeo($items) {
        $key_words = ['калорийность продуктов', 'КБЖУ', 'белки', 'жиры', 'углеводы', 'Сколько каллориев в продукте', 'продукты', 'питание', 'здоровый образ жизни', 'ЗОЖ'];
        $description = self::PRODUCT_PAGE_DESCRIPTION;
        foreach ($items as $item) {
            foreach (self::$productKeyWordsTemplates as $template)
            $key_words[] = $template . $item['name'];
        }
        return [
            'keywords' => implode(', ', $key_words),
            'description' => $description
        ];
    }
}
