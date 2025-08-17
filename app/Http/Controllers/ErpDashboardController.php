<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Material;
use App\Models\PurchaseOrder;
use App\Models\FinishedGood;
use App\Models\ProductionRecord;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ErpDashboardController extends Controller
{
    /**
     * Display the main ERP dashboard.
     */
    public function index()
    {
        $stats = [
            'suppliers' => [
                'total' => Supplier::count(),
                'active' => Supplier::where('status', 'active')->count(),
            ],
            'materials' => [
                'total' => Material::count(),
                'low_stock' => Material::lowStock()->count(),
            ],
            'purchase_orders' => [
                'total' => PurchaseOrder::count(),
                'pending' => PurchaseOrder::whereIn('status', ['draft', 'sent', 'confirmed'])->count(),
            ],
            'finished_goods' => [
                'total' => FinishedGood::count(),
                'low_stock' => FinishedGood::lowStock()->count(),
            ],
            'production' => [
                'this_month' => ProductionRecord::whereMonth('production_date', now()->month)
                    ->whereYear('production_date', now()->year)
                    ->sum('quantity_produced'),
                'total_cost' => ProductionRecord::whereMonth('production_date', now()->month)
                    ->whereYear('production_date', now()->year)
                    ->sum('total_production_cost'),
            ],
            'sales' => [
                'total' => SalesOrder::count(),
                'pending' => SalesOrder::whereIn('status', ['draft', 'confirmed'])->count(),
                'revenue' => SalesOrder::where('status', 'delivered')
                    ->whereMonth('order_date', now()->month)
                    ->whereYear('order_date', now()->year)
                    ->sum('total_amount'),
            ],
        ];

        $recent_activities = [
            'purchase_orders' => PurchaseOrder::with('supplier')
                ->latest()
                ->take(5)
                ->get(),
            'production_records' => ProductionRecord::with('finishedGood')
                ->latest()
                ->take(5)
                ->get(),
            'sales_orders' => SalesOrder::latest()
                ->take(5)
                ->get(),
        ];

        return Inertia::render('welcome', [
            'stats' => $stats,
            'recent_activities' => $recent_activities,
        ]);
    }

    /**
     * Display detailed dashboard for authenticated users.
     */
    public function show()
    {
        $stats = [
            'suppliers' => [
                'total' => Supplier::count(),
                'active' => Supplier::where('status', 'active')->count(),
            ],
            'materials' => [
                'total' => Material::count(),
                'low_stock' => Material::lowStock()->count(),
            ],
            'purchase_orders' => [
                'total' => PurchaseOrder::count(),
                'pending' => PurchaseOrder::whereIn('status', ['draft', 'sent', 'confirmed'])->count(),
            ],
            'finished_goods' => [
                'total' => FinishedGood::count(),
                'low_stock' => FinishedGood::lowStock()->count(),
            ],
            'production' => [
                'this_month' => ProductionRecord::whereMonth('production_date', now()->month)
                    ->whereYear('production_date', now()->year)
                    ->sum('quantity_produced'),
                'total_cost' => ProductionRecord::whereMonth('production_date', now()->month)
                    ->whereYear('production_date', now()->year)
                    ->sum('total_production_cost'),
            ],
            'sales' => [
                'total' => SalesOrder::count(),
                'pending' => SalesOrder::whereIn('status', ['draft', 'confirmed'])->count(),
                'revenue' => SalesOrder::where('status', 'delivered')
                    ->whereMonth('order_date', now()->month)
                    ->whereYear('order_date', now()->year)
                    ->sum('total_amount'),
            ],
        ];

        $recent_activities = [
            'purchase_orders' => PurchaseOrder::with('supplier')
                ->latest()
                ->take(5)
                ->get(),
            'production_records' => ProductionRecord::with('finishedGood')
                ->latest()
                ->take(5)
                ->get(),
            'sales_orders' => SalesOrder::latest()
                ->take(5)
                ->get(),
        ];

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recent_activities' => $recent_activities,
        ]);
    }
}