<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\User\UserRepository::class, \App\Repositories\User\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CapitalHistory\CapitalHistoryRepository::class, \App\Repositories\CapitalHistory\CapitalHistoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Category\CategoryRepository::class, \App\Repositories\Category\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Product\ProductRepository::class, \App\Repositories\Product\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Shareholder\ShareholderRepository::class, \App\Repositories\Shareholder\ShareholderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FundHistory\FundHistoryRepository::class, \App\Repositories\FundHistory\FundHistoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\System\SystemRepository::class, \App\Repositories\System\SystemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Customer\CustomerRepository::class, \App\Repositories\Customer\CustomerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoiceType\InvoiceTypeRepository::class, \App\Repositories\InvoiceType\InvoiceTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Invoice\InvoiceRepository::class, \App\Repositories\Invoice\InvoiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PawnReceipt\PawnReceiptRepository::class, \App\Repositories\PawnReceipt\PawnReceiptRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PawnProduct\PawnProductRepository::class, \App\Repositories\PawnProduct\PawnProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InterestPaidHistory\InterestPaidHistoryRepository::class, \App\Repositories\InterestPaidHistory\InterestPaidHistoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LoanPaidHistory\LoanPaidHistoryRepository::class, \App\Repositories\LoanPaidHistory\LoanPaidHistoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Statistic\StatisticRepository::class, \App\Repositories\Statistic\StatisticRepositoryEloquent::class);

        //:end-bindings:
    }
}
