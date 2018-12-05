<?php

namespace App\Nova;

use App\Nova\Filters\City;
use App\Nova\Metrics\UsersPerCity;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use SecretSanta\FindMatches\FindMatches;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    public static $with = 'receiver';

    public function subtitle()
    {
        return $this->email;
    }

    public static function label()
    {
        return 'Utilisateurs';
    }

    public function fields(Request $request)
    {
        $cities = array_keys(\App\Models\User::CITIES);

        return [
            ID::make()->sortable(),

            Gravatar::make(),

            Text::make('Nom', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Select::make('Ville', 'city')
                ->options(array_combine($cities, $cities))
                ->sortable(),

            BelongsTo::make('Destinataire', 'receiver', self::class)
                // ->searchable()
                ->nullable(),

        ];
    }
    // public static function relatableQuery(NovaRequest $request, $query)
    // {
    //     return $query->where('id', $request->user()->id);
    // }

    // public static function relatableUsers(NovaRequest $request, $query)
    // {
    //     dump($request);
    // }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new UsersPerCity(),
            new FindMatches()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new City(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
