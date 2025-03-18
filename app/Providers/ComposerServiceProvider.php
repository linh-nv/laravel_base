<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'client.*',
            'App\Http\ViewComposers\LoggedComposer'
        );
        view()->composer(
            [
                'client.user.user.form.edit',
                'client.user.user.form.add',
                'client.user.user.index',
            ],
            'App\Http\ViewComposers\RoleComposer'
        );
        view()->composer(
            [
                'client.user.product.form.edit',
                'client.user.product.form.add',
                'client.user.product.index',
                'client.user.pawn-receipt.create',
            ],
            'App\Http\ViewComposers\CategoryComposer'
        );
        view()->composer(
            [
                'client.user.capital.form.add',
                'client.user.capital.form.edit',
                'client.user.capital.index',
            ],
            'App\Http\ViewComposers\ShareholderComposer'
        );
        view()->composer(
            [
                'client.user.invoice.index',
                'client.user.fund-history.index',
            ],
            'App\Http\ViewComposers\UserComposer'
        );
        view()->composer(
            [
                'client.user.invoice.form.edit',
                'client.user.invoice.form.add',
                'client.user.invoice.index',
                'client.user.fund-history.form.add',
                'client.user.fund-history.form.edit',
                'client.user.fund-history.index',
            ],
            'App\Http\ViewComposers\InvoiceTypeComposer'
        );
        view()->composer(
            'client.layout.header.top-bar.icon-list',
            'App\Http\ViewComposers\PawnNoticeComposer'
        );

    }
}
