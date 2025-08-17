import React from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

interface User {
    name: string;
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
    auth?: {
        user?: User;
    };
    stats?: Stats;
    recent_activities?: Record<string, unknown>;
    [key: string]: unknown;
}

export default function Welcome({ auth, stats }: Props) {
    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
            <header className="bg-white shadow-sm border-b">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between items-center py-4">
                        <div className="flex items-center space-x-3">
                            <div className="bg-blue-600 text-white p-2 rounded-lg">
                                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h1 className="text-2xl font-bold text-gray-900">🏭 CleanTech ERP</h1>
                        </div>
                        
                        <div className="flex items-center space-x-4">
                            {auth?.user ? (
                                <div className="flex items-center space-x-4">
                                    <span className="text-gray-700">Welcome, {auth.user.name}</span>
                                    <Link href="/dashboard">
                                        <Button>Dashboard</Button>
                                    </Link>
                                </div>
                            ) : (
                                <div className="flex items-center space-x-2">
                                    <Link href="/login">
                                        <Button variant="outline">Login</Button>
                                    </Link>
                                    <Link href="/register">
                                        <Button>Get Started</Button>
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </header>

            <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                {/* Hero Section */}
                <div className="text-center mb-12">
                    <h2 className="text-4xl font-bold text-gray-900 mb-4">
                        🧽 Cleaning Tools Manufacturing ERP System
                    </h2>
                    <p className="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Streamline your manufacturing operations with our comprehensive ERP solution. 
                        Manage suppliers, materials, production, and sales all in one place.
                    </p>
                    
                    {!auth?.user && (
                        <div className="flex justify-center space-x-4">
                            <Link href="/register">
                                <Button size="lg" className="px-8 py-3">
                                    🚀 Start Your Free Trial
                                </Button>
                            </Link>
                            <Link href="/login">
                                <Button variant="outline" size="lg" className="px-8 py-3">
                                    📱 Demo Login
                                </Button>
                            </Link>
                        </div>
                    )}
                </div>

                {/* Key Features */}
                <div className="mb-16">
                    <h3 className="text-3xl font-bold text-gray-900 text-center mb-8">
                        🎯 Complete Manufacturing Management
                    </h3>
                    
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <Card className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <span className="text-2xl mr-2">🤝</span>
                                    Supplier Management
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-gray-600">
                                    Track supplier information, payment terms, discounts, and contact details with integrated mapping.
                                </p>
                            </CardContent>
                        </Card>

                        <Card className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <span className="text-2xl mr-2">📦</span>
                                    Inventory Control
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-gray-600">
                                    Monitor raw materials and finished goods stock levels with automatic low-stock alerts.
                                </p>
                            </CardContent>
                        </Card>

                        <Card className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <span className="text-2xl mr-2">🛒</span>
                                    Purchase Orders
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-gray-600">
                                    Create and manage purchase orders with supplier integration and delivery tracking.
                                </p>
                            </CardContent>
                        </Card>

                        <Card className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <span className="text-2xl mr-2">⚙️</span>
                                    Production Tracking
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-gray-600">
                                    Track production batches, costs (COGS), and output with detailed reporting.
                                </p>
                            </CardContent>
                        </Card>

                        <Card className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <span className="text-2xl mr-2">💰</span>
                                    Sales Management
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-gray-600">
                                    Create sales orders, track deliveries, and manage customer relationships.
                                </p>
                            </CardContent>
                        </Card>

                        <Card className="hover:shadow-lg transition-shadow">
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <span className="text-2xl mr-2">📊</span>
                                    Analytics & Reports
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p className="text-gray-600">
                                    Generate detailed production cost reports and sales analytics with visual charts.
                                </p>
                            </CardContent>
                        </Card>
                    </div>
                </div>

                {/* System Overview Stats */}
                {stats && (
                    <div className="mb-16">
                        <h3 className="text-3xl font-bold text-gray-900 text-center mb-8">
                            📈 System Overview
                        </h3>
                        
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <Card>
                                <CardHeader className="pb-2">
                                    <CardTitle className="text-lg">🏢 Suppliers</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-blue-600">{stats.suppliers.total}</div>
                                    <p className="text-sm text-gray-500">
                                        {stats.suppliers.active} active suppliers
                                    </p>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader className="pb-2">
                                    <CardTitle className="text-lg">🧴 Raw Materials</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-green-600">{stats.materials.total}</div>
                                    <p className="text-sm text-gray-500">
                                        {stats.materials.low_stock} items low stock
                                    </p>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader className="pb-2">
                                    <CardTitle className="text-lg">📋 Purchase Orders</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-purple-600">{stats.purchase_orders.total}</div>
                                    <p className="text-sm text-gray-500">
                                        {stats.purchase_orders.pending} pending orders
                                    </p>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader className="pb-2">
                                    <CardTitle className="text-lg">🧽 Finished Goods</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-orange-600">{stats.finished_goods.total}</div>
                                    <p className="text-sm text-gray-500">
                                        {stats.finished_goods.low_stock} items low stock
                                    </p>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader className="pb-2">
                                    <CardTitle className="text-lg">⚡ Production This Month</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-red-600">{stats.production.this_month}</div>
                                    <p className="text-sm text-gray-500">
                                        Cost: ${stats.production.total_cost.toLocaleString()}
                                    </p>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader className="pb-2">
                                    <CardTitle className="text-lg">💵 Monthly Revenue</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div className="text-2xl font-bold text-emerald-600">
                                        ${stats.sales.revenue.toLocaleString()}
                                    </div>
                                    <p className="text-sm text-gray-500">
                                        {stats.sales.pending} pending sales orders
                                    </p>
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                )}

                {/* Call to Action */}
                <div className="bg-blue-600 text-white rounded-2xl p-8 text-center">
                    <h3 className="text-3xl font-bold mb-4">
                        🎯 Ready to Transform Your Manufacturing?
                    </h3>
                    <p className="text-xl mb-6 text-blue-100">
                        Join hundreds of cleaning tool manufacturers who trust CleanTech ERP
                        to streamline their operations and boost productivity.
                    </p>
                    
                    {!auth?.user && (
                        <div className="flex justify-center space-x-4">
                            <Link href="/register">
                                <Button size="lg" variant="secondary" className="px-8 py-3">
                                    🚀 Get Started Today
                                </Button>
                            </Link>
                            <Link href="/login">
                                <Button size="lg" variant="outline" className="px-8 py-3 bg-transparent border-white text-white hover:bg-white hover:text-blue-600">
                                    📞 Contact Sales
                                </Button>
                            </Link>
                        </div>
                    )}
                </div>
            </main>

            <footer className="bg-gray-800 text-white py-8 mt-16">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p className="text-gray-400">
                        © 2024 CleanTech ERP. Built for cleaning tool manufacturers worldwide. 🌍
                    </p>
                </div>
            </footer>
        </div>
    );
}