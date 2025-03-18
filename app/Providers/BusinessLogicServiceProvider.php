<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BusinessLogicServiceProvider extends ServiceProvider
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
     * Repository services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Services\Auth\AuthService::class, \App\Services\Auth\AuthServiceImp::class);
        $this->app->bind(\App\Services\Generate\GenerateService::class, \App\Services\Generate\GenerateServiceImp::class);
        $this->app->bind(\App\Services\User\UserService::class, \App\Services\User\UserServiceImp::class);
        $this->app->bind(\App\Services\Shareholder\ShareholderService::class, \App\Services\Shareholder\ShareholderServiceImp::class);
        $this->app->bind(\App\Services\Category\CategoryService::class, \App\Services\Category\CategoryServiceImp::class);
        $this->app->bind(\App\Services\Product\ProductService::class, \App\Services\Product\ProductServiceImp::class);
        $this->app->bind(\App\Services\CapitalHistory\CapitalHistoryService::class, \App\Services\CapitalHistory\CapitalHistoryServiceImp::class);
        $this->app->bind(\App\Services\FundHistory\FundHistoryService::class, \App\Services\FundHistory\FundHistoryServiceImp::class);
        $this->app->bind(\App\Services\Customer\CustomerService::class, \App\Services\Customer\CustomerServiceImp::class);
        $this->app->bind(\App\Services\InvoiceType\InvoiceTypeService::class, \App\Services\InvoiceType\InvoiceTypeServiceImp::class);
        $this->app->bind(\App\Services\Invoice\InvoiceService::class, \App\Services\Invoice\InvoiceServiceImp::class);
        $this->app->bind(\App\Services\PawnReceipt\PawnReceiptService::class, \App\Services\PawnReceipt\PawnReceiptServiceImp::class);
        $this->app->bind(\App\Services\PawnProduct\PawnProductService::class, \App\Services\PawnProduct\PawnProductServiceImp::class);
        $this->app->bind(\App\Services\Statistic\StatisticService::class, \App\Services\Statistic\StatisticServiceImp::class);
        //:end-bindings:
    }
}
