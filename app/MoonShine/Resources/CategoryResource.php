<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\CKEditor\Fields\CKEditor;
use MoonShine\Decorations\Block;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Number;
use MoonShine\Fields\Slug;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;
use MoonShine\Fields\Select;
use MoonShine\Fields\BelongsTo;

use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Column;

class CategoryResource extends Resource
{
	public static string $model = Category::class;

	public static string $title = 'Категории товаров';
    public static string $orderField = 'sort';
    public static string $orderType = 'ASC';

	public function fields(): array
	{
		return [

            Grid::make([

                Column::make([
                    Block::make('Данные товара', [
                        ID::make()->sortable(),
                        SwitchBoolean::make('Активеность', 'active')->onValue(1)->offValue(0)->default(1),
                        Text::make('Название Категории', 'name')->required()->sortable(),
                        Slug::make('Slug')->from('name')->separator('-')->unique()->hideOnIndex(),
                        Number::make('Сортировка', 'sort')->default(500)->sortable(),
                        BelongsTo::make('Родительская категория', 'parent_id', 'name')
                            ->nullable(),
                        MediaLibrary::make('Изображение', 'category')->removable(),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make('SEO, META- данные категории', [
                        Text::make('Заголовок H1', 'h1')->hideOnIndex(),
                        Textarea::make('Meta title', 'meta_title')->hideOnIndex(),
                        Textarea::make('Meta description', 'meta_description')->hideOnIndex(),
                        Text::make('Meta keywords', 'meta_keywords')->hideOnIndex(),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make('Описания Категории', [
                        CKEditor::make('Описание категории', 'description')->hideOnIndex(),
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
