<?php

namespace Core\Repository;

use App\Exceptions\SaleCanceledError;
use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SaleRepository implements ISaleRepository
{
    public function createSale($sale): Sale|Exception
    {
        try {
            $s = Sale::query()->create([
                'amount' => $sale['amount'],
                'cancelled_at' => null
            ]);

            foreach ($sale['products'] as $product) {
                $s->products()->attach($product['id'], array('quantity' => $product['quantity']));
            }

            return Sale::query()->get()->last();
        } catch (Exception $e) {
            dd($e->getMessage());
            return new Exception('Invalid data');
        }
    }

    public function listSales(): Collection|SalesNotFound
    {
        try {
            return Sale::all();
        } catch (Exception) {
            return new SalesNotFound('Sales not found');
        }
    }

    public function findSaleById(int $id): Sale|SalesNotFound
    {
        try {
            return Sale::query()->find($id)->first();
        } catch (Exception) {
            return new SalesNotFound('Sale not found');
        }
    }

    public function cancelSale(int $id): Sale|SaleCanceledError
    {
        try {
            $sale = Sale::query()->find($id)->first();
            $sale->cancelled_at = Carbon::now()->toDateTimeString();
            $sale->save();

            return $sale;
        } catch (Exception) {
            return new SaleCanceledError('Sale cannot be canceled');
        }
    }

    public function addProductsToSale(int $id, array $products): Sale|SalesNotFound
    {
        try {
            $sale = Sale::query()->find($id)->first();
            return $sale;
        } catch (Exception) {
            return new SalesNotFound('Sale not found');
        }
    }
}
