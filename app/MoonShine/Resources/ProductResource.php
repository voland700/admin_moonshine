<?php

namespace App\MoonShine\Resources;


use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Number;
use MoonShine\Fields\Textarea;
use MoonShine\CKEditor\Fields\CKEditor;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Checkbox;
use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;
use MoonShine\Fields\Json;
use MoonShine\Fields\Select;
use MoonShine\Decorations\Heading;

use MoonShine\Fields\BelongsTo;

use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Column;
use MoonShine\Actions\FiltersAction;
use MoonShine\Decorations\Tabs;
use MoonShine\Decorations\Tab;



class ProductResource extends Resource
{
	public static string $model = Product::class;
	public static string $title = 'Товары каталога';

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('Данные товара', [
                        Tabs::make([
                            Tab::make('Основное', [
                                ID::make()->sortable(),
                                SwitchBoolean::make('Активен', 'active')->onValue(1)->offValue(0)->default(1)->sortable(),
                                Flex::make([
                                    Checkbox::make('Хит', 'hit')->hideOnIndex(),
                                    Checkbox::make('Новинка', 'new')->hideOnIndex(),
                                    Checkbox::make('Акция', 'stock')->hideOnIndex(),
                                    Checkbox::make('Советуем', 'advice')->hideOnIndex(),
                                ])->justifyAlign('start'),

                                Text::make('Название товара', 'name')->required()->sortable(),
                                Slug::make('Slug')->from('name')->separator('-')->unique()->hideOnIndex(),
                                Number::make('Сортировка', 'sort')->default(500)->sortable(),
                                BelongsTo::make('Категория товара', 'category_id', 'name')->nullable(),
                                Grid::make([
                                    Column::make([
                                        MediaLibrary::make('Основное изображение', 'image')->hideOnIndex(),
                                    ])->columnSpan(6),
                                    Column::make([
                                        MediaLibrary::make('Изображение анонса', 'prev'),
                                    ])->columnSpan(6),
                                    Column::make([
                                        MediaLibrary::make('Дополнительные изображения', 'more')->multiple()->hideOnIndex(),
                                    ])->columnSpan(12),
                                ]),
                                Heading::make('Стоимость товара'),
                                Flex::make([
                                Text::make('Цена', 'base_price')->default(0)->sortable(),
                                Select::make('Валюта', 'currency')
                                    ->options([
                                        'RUB' => 'RUB',
                                        'EUR' => 'EUR',
                                        'USD' => 'USD',
                                        'BYN' => 'BYN',
                                        'UAH' => 'UAH'
                                    ]),
                                ])
                            ]),
                            Tab::make('Характеристики', [
                                Json::make('Характеристики товара', 'properties')
                                    ->fields([
                                        Text::make('Title', 'title'),
                                        Text::make('Value', 'value')
                                    ])->removable()->hideOnIndex(),

                            ])


                        ])



                    ]),















                ])->columnSpan(6),





                Column::make([
                    Block::make('SEO, META- данные товара', [
                        Text::make('Заголовок H1', 'h1')->hideOnIndex(),
                        Textarea::make('Meta title', 'meta_title')->hideOnIndex(),
                        Textarea::make('Meta description', 'meta_description')->hideOnIndex(),
                        Text::make('Meta keywords', 'meta_keywords')->hideOnIndex(),

                    ]),
                    Block::make('Описания товара', [
                        Textarea::make('Краткое описание', 'summary')->hideOnIndex(),
                        CKEditor::make('Детальное описание', 'description')->hideOnIndex(),
                    ]),
                ])->columnSpan(6),


            ])









        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
