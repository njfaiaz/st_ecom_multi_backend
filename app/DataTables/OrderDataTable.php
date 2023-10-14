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
        ->addColumn('order_id', function ($row) {
            return '<a href="/order/show/1">order_id</a>';
        })

        ->addColumn('order_id', function($row) {
            return '<a href="/prodicts/'. $row->id .'/edit" class="btn btn-primary">Edit</a>';
        })


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

        $start_date     = $this->request()->get('start_date');
        $end_date       = $this->request()->get('end_date');
        $statusValue    = $this->request()->get('statusValue');

        $query = $model->newQuery();
        if ( !empty($start_date)  &&   !empty($end_date))
        {
            $start_date  = Carbon::parse($start_date);

            $end_date = Carbon::parse($end_date);

            $query = $query->whereBetween('created_at',[$start_date,$end_date]);
        }

        if(!empty($statusValue))
        {
            $query = $query->where('statusValue',$statusValue);
        }
        return $this->applyScopes($data);
    }


    public function html()
    {
        return $this->builder()
                    ->setTableId('Order-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('csv'),
                        Button::make('excel')
                    );
    }


    public function getColumns(): array
    {
        return [
            Column::make('order_id'),
            Column::make('shop.username'),
            Column::make('user.username'),
            Column::make('payment_option.name'),
            Column::make('total_price'),
            Column::make('discount'),
            Column::make('payable'),
            Column::make('paid'),
            Column::make('due'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }


    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}

