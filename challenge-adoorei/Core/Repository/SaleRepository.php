<?php

namespace Core\Repository;

use App\Exceptions\SaleCanceledError;
use App\Exceptions\SalesNotFound;
use App\Models\Sale;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class SaleRepository implements ISaleRepository
{
    /**
     * @throws Exception
     */
    public function createSale($sale): Sale|Exception
    {
        try {
            $s = Sale::query()->create([
                'amount'       => $sale['amount'],
                'cancelled_at' => null,
            ]);

            foreach ($sale['products'] as $product) {
                $s->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }

            return Sale::query()->get()->last();
        } catch (Exception|ModelNotFoundException) {
            throw new Exception('Invalid data');
        }
    }

    /**
     * @throws SalesNotFound
     */
    public function listSales(): Collection|SalesNotFound
    {
        try {
            return Sale::all();
        } catch (Exception|ModelNotFoundException) {
            throw new SalesNotFound('Sales not found');
        }
    }

    /**
     * @throws SalesNotFound
     */
    public function findSaleById(int $id): Sale|SalesNotFound
    {
        try {
            $sale = Sale::query()->find($id);

            if (empty($sale)) {
                return new SalesNotFound('Sale not found !');
            }

            return $sale->first();
        } catch (Exception|ModelNotFoundException $e) {
            throw new SalesNotFound('Sale not found !');
        }
    }

    /**
     * @throws SaleCanceledError
     */
    public function cancelSale(int $id): Sale|SaleCanceledError
    {
        try {
            $sale = Sale::query()->find($id);

            if (! $sale) {
                return new SaleCanceledError('Sale not found');
            }

            $sale               = $sale->first();
            $sale->cancelled_at = Carbon::now()->toDateTimeString();
            $sale->save();

            return $sale;
        } catch (Exception|ModelNotFoundException) {
            throw new SaleCanceledError('Sale cannot be canceled');
        }
    }

    /**
     * @throws SalesNotFound
     */
    public function addProductsToSale(int $id, $products, $newAmount): Sale|SalesNotFound
    {
        try {
            $sale = Sale::query()->find($id);

            if (empty($sale)) {
                return new SalesNotFound('Sale not found');
            }

            $sale = $sale->first();

            $sale->amount += $newAmount;

            foreach ($products as $product) {
                $sale->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }
            $sale->save();

            return $sale;
        } catch (Exception|ModelNotFoundException) {
            throw new SalesNotFound('Sale not found');
        }
    }
}
