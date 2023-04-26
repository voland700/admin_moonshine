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
use MoonShine\Fields\Image;
use MoonShine\Fields\Checkbox;
use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;
use MoonShine\Fields\Json;
use MoonShine\Fields\Select;

use MoonShine\Actions\FiltersAction;




class ProductResource extends Resource
{
	public static string $model = Product::class;

	public static string $title = 'Товары каталога';


	public function fields(): array
	{
		return [
            Block::make('Данные товара', [
		        ID::make()->sortable(),
                SwitchBoolean::make('Активен', 'active')->onValue(1)->offValue(0)->default(1),
                Checkbox::make('Хит', 'hit'),
                Checkbox::make('Новинка', 'new'),
                Checkbox::make('Акция', 'stock'),
                Checkbox::make('Советуем', 'advice'),
                Text::make('Название товара', 'name')->required()->sortable(),
                Slug::make('Slug')->from('title')->separator('-')->unique(),
                Number::make('Сортировка', 'sort')->default(500),

                MediaLibrary::make('Основное изображение', 'image'),
                MediaLibrary::make('Изображение анонса', 'prev'),
                MediaLibrary::make('Дополнительные изображения', 'more')->multiple(),

            ]),
            Block::make('Стоисость товара', [
                Text::make('Цена', 'base_price')->default(0),
                Select::make('Валюта', 'currency')
                    ->options([
                        'RUB' => 'RUB',
                        'EUR' => 'EUR',
                        'USD' => 'USD',
                        'BYN' => 'BYN',
                        'UAH' => 'UAH'
                    ])
            ]),
            Block::make('Характеристики товара', [
                Json::make('Характеристики товара', 'properties')
                    ->keyValue('Характиристика', 'Значение')
                    ->removable()
            ]),

            Block::make('SEO, META- данные товара', [
                Text::make('Заголовок H1', 'h1'),
                Textarea::make('Meta title', 'meta_title'),
                Textarea::make('Meta description', 'meta_description'),
                Text::make('Meta keywords', 'meta_keywords'),

            ]),




            Block::make('Описания товара', [
                Textarea::make('Краткое описание', 'summary'),
                CKEditor::make('Детальное описание', 'description'),
            ]),









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
