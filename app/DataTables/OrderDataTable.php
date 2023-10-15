<?php

namespace App\DataTables;

use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class OrderDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()

        ->eloquent($query)
        ->addColumn('status', function($row){

            if($row->status == 1)
            {
                return "Pending";
            } elseif($row->status == 2)
            {
                return "Processing";
            } elseif($row->status == 3)
            {
                return "On the way";
            } elseif($row->status == 4)
            {
                return "Shipped";
            } elseif($row->status == 5)
            {
                return "Delivered";
            } elseif($row->status == 6)
            {
                return "Cancelled by Customer";
            } elseif($row->status == 7)
            {
                return "Cancelled by Seller";
            } else {
                return "Refunded";
            }

        })
        ->addColumn('action', function ($query) {
            return '<a href="' . route("orderShow", $query->invoice_no) .
            '" class="btn btn-info text-white btn-sm" target="_blank">Show</a>';
        })
        ->addColumn('payment_type', function($row){

            if($row->payment_type == 0)
            {
                return "Cod";
            } else {
                return "Noncod";
            }

        })
        ->editColumn('created_at', function($query){
            return $query->created_at->format('Y.m.d H:i:s');
        })
        ->editColumn('updated_at', function($query){
            return $query->created_at->format('Y.m.d H:i:s');
        });
    }


    public function query(Order $model)
    {
        $data = Order::with('user', 'shop', 'payment_option')->select();
        return $this->applyScopes($data);
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('Order-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('csv'),
                Button::make('excel')
            );
    }


    public function getColumns(): array
    {
        return [
            Column::make('invoice_no'),
            Column::make('shop.username'),
            Column::make('user.username'),
            Column::make('payment_option.name'),
            Column::make('payment_type'),
            Column::make('total_price'),
            Column::make('discount'),
            Column::make('delivery_fee'),
            Column::make('payable'),
            Column::make('paid'),
            Column::make('due'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('action'),
        ];
    }


    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}

