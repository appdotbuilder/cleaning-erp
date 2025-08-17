import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/components/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';

interface PurchaseOrder {
    po_number: string;
    total_amount: number;
    status: string;
    supplier?: {
        name: string;
    };
    [key: string]: unknown;
}

interface ProductionRecord {
    batch_number: string;
    quantity_produced: number;
    total_production_cost: number;
    finished_good?: {
        name: string;
    };
    [key: string]: unknown;
}

interface SalesOrder {
    so_number: string;
    customer_name: string;
    total_amount: number;
    status: string;
    [key: string]: unknown;
}

interface Stats {
    suppliers: {
        total: number;
        active: number;
    };
    materials: {
        total: number;
        low_stock: number;
    };
    purchase_orders: {
        total: number;
        pending: number;
    };
    finished_goods: {
        total: number;
        low_stock: number;
    };
    production: {
        this_month: number;
        total_cost: number;
    };
    sales: {
        total: number;
        pending: number;
        revenue: number;
    };
}

interface Props {
    stats?: Stats;
    recent_activities?: {
        purchase_orders: PurchaseOrder[];
        production_records: ProductionRecord[];
        sales_orders: SalesOrder[];
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

export default function Dashboard({ stats, recent_activities }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="ERP Dashboard" />
            
            <div className="flex h-full flex-1 flex-col gap-6 p-6 overflow-x-auto">
                {/* Welcome Section */}
                <div className="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 rounded-lg">
                    <h1 className="text-2xl font-bold mb-2">🏭 Welcome to CleanTech ERP Dashboard</h1>
                    <p className="text-blue-100">
                        Manage your cleaning tools manufacturing operations efficiently
                    </p>
                </div>

                {/* Quick Stats */}
                {stats && (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                        <Card>
                            <CardHeader className="pb-2">
                                <CardTitle className="text-sm">🏢 Suppliers</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold text-blue-600">{stats.suppliers.total}</div>
                                <p className="text-xs text-muted-foreground">
                                    {stats.suppliers.active} active
                                </p>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader className="pb-2">
                                <CardTitle className="text-sm">📦 Raw Materials</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold text-green-600">{stats.materials.total}</div>
                                <p className="text-xs text-muted-foreground">
                                    {stats.materials.low_stock} low stock
                                </p>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader className="pb-2">
                                <CardTitle className="text-sm">📋 Purchase Orders</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold text-purple-600">{stats.purchase_orders.total}</div>
                                <p className="text-xs text-muted-foreground">
                                    {stats.purchase_orders.pending} pending
                                </p>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader className="pb-2">
                                <CardTitle className="text-sm">🧽 Finished Goods</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold text-orange-600">{stats.finished_goods.total}</div>
                                <p className="text-xs text-muted-foreground">
                                    {stats.finished_goods.low_stock} low stock
                                </p>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader className="pb-2">
                                <CardTitle className="text-sm">⚡ Production</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold text-red-600">{stats.production.this_month}</div>
                                <p className="text-xs text-muted-foreground">
                                    units this month
                                </p>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader className="pb-2">
                                <CardTitle className="text-sm">💵 Revenue</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="text-2xl font-bold text-emerald-600">
                                    ${stats.sales.revenue.toLocaleString()}
                                </div>
                                <p className="text-xs text-muted-foreground">
                                    this month
                                </p>
                            </CardContent>
                        </Card>
                    </div>
                )}

                {/* Quick Actions */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <Card className="hover:shadow-md transition-shadow">
                        <CardHeader>
                            <CardTitle className="text-lg">🤝 Supplier Management</CardTitle>
                            <CardDescription>
                                Manage supplier information and relationships
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="pt-0">
                            <div className="flex space-x-2">
                                <Link href="/suppliers">
                                    <Button size="sm">View All</Button>
                                </Link>
                                <Link href="/suppliers/create">
                                    <Button size="sm" variant="outline">Add New</Button>
                                </Link>
                            </div>
                        </CardContent>
                    </Card>

                    <Card className="hover:shadow-md transition-shadow">
                        <CardHeader>
                            <CardTitle className="text-lg">🧴 Raw Materials</CardTitle>
                            <CardDescription>
                                Track inventory and manage stock levels
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="pt-0">
                            <div className="flex space-x-2">
                                <Link href="/materials">
                                    <Button size="sm">View All</Button>
                                </Link>
                                <Link href="/materials/create">
                                    <Button size="sm" variant="outline">Add New</Button>
                                </Link>
                            </div>
                        </CardContent>
                    </Card>

                    <Card className="hover:shadow-md transition-shadow opacity-50">
                        <CardHeader>
                            <CardTitle className="text-lg">📋 Purchase Orders</CardTitle>
                            <CardDescription>
                                Create and manage purchase orders
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="pt-0">
                            <div className="flex space-x-2">
                                <Button size="sm" disabled>Coming Soon</Button>
                            </div>
                        </CardContent>
                    </Card>

                    <Card className="hover:shadow-md transition-shadow opacity-50">
                        <CardHeader>
                            <CardTitle className="text-lg">📊 Production Reports</CardTitle>
                            <CardDescription>
                                View COGS and production analytics
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="pt-0">
                            <div className="flex space-x-2">
                                <Button size="sm" disabled>Coming Soon</Button>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Recent Activities */}
                {recent_activities && (
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <Card>
                            <CardHeader>
                                <CardTitle>🛒 Recent Purchase Orders</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-2">
                                    {recent_activities.purchase_orders?.slice(0, 5).map((po, index: number) => (
                                        <div key={index} className="flex justify-between items-center py-2 border-b border-gray-100">
                                            <div>
                                                <p className="font-medium text-sm">{po.po_number}</p>
                                                <p className="text-xs text-muted-foreground">{po.supplier?.name}</p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm font-medium">${po.total_amount?.toLocaleString()}</p>
                                                <span className={`text-xs px-2 py-1 rounded-full ${
                                                    po.status === 'delivered' ? 'bg-green-100 text-green-800' :
                                                    po.status === 'confirmed' ? 'bg-blue-100 text-blue-800' :
                                                    'bg-yellow-100 text-yellow-800'
                                                }`}>
                                                    {po.status}
                                                </span>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader>
                                <CardTitle>⚡ Recent Production</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-2">
                                    {recent_activities.production_records?.slice(0, 5).map((record, index: number) => (
                                        <div key={index} className="flex justify-between items-center py-2 border-b border-gray-100">
                                            <div>
                                                <p className="font-medium text-sm">{record.batch_number}</p>
                                                <p className="text-xs text-muted-foreground">{record.finished_good?.name}</p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm font-medium">{record.quantity_produced} units</p>
                                                <p className="text-xs text-muted-foreground">${record.total_production_cost?.toLocaleString()}</p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </CardContent>
                        </Card>

                        <Card>
                            <CardHeader>
                                <CardTitle>💰 Recent Sales Orders</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div className="space-y-2">
                                    {recent_activities.sales_orders?.slice(0, 5).map((so, index: number) => (
                                        <div key={index} className="flex justify-between items-center py-2 border-b border-gray-100">
                                            <div>
                                                <p className="font-medium text-sm">{so.so_number}</p>
                                                <p className="text-xs text-muted-foreground">{so.customer_name}</p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm font-medium">${so.total_amount?.toLocaleString()}</p>
                                                <span className={`text-xs px-2 py-1 rounded-full ${
                                                    so.status === 'delivered' ? 'bg-green-100 text-green-800' :
                                                    so.status === 'shipped' ? 'bg-blue-100 text-blue-800' :
                                                    'bg-yellow-100 text-yellow-800'
                                                }`}>
                                                    {so.status}
                                                </span>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}