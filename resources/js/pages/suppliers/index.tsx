import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/components/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';

interface Supplier {
    id: number;
    name: string;
    address: string;
    phone: string;
    pic: string;
    npwp: string;
    discount_percentage: number;
    payment_terms_days: number;
    status: string;
    created_at: string;
}

interface PaginationLink {
    url?: string;
    label: string;
    active: boolean;
}

interface PaginationMeta {
    last_page: number;
    [key: string]: unknown;
}

interface Props {
    suppliers: {
        data: Supplier[];
        links: PaginationLink[];
        meta: PaginationMeta;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Suppliers', href: '/suppliers' },
];

export default function SuppliersIndex({ suppliers }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Suppliers" />
            
            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold">🏢 Suppliers</h1>
                        <p className="text-muted-foreground">
                            Manage your supplier relationships and information
                        </p>
                    </div>
                    <Link href="/suppliers/create">
                        <Button>Add New Supplier</Button>
                    </Link>
                </div>

                <div className="grid gap-4">
                    {suppliers.data.length === 0 ? (
                        <Card>
                            <CardContent className="p-6">
                                <div className="text-center">
                                    <div className="text-6xl mb-4">🏢</div>
                                    <h3 className="text-lg font-semibold mb-2">No suppliers found</h3>
                                    <p className="text-muted-foreground mb-4">
                                        Get started by adding your first supplier
                                    </p>
                                    <Link href="/suppliers/create">
                                        <Button>Add Supplier</Button>
                                    </Link>
                                </div>
                            </CardContent>
                        </Card>
                    ) : (
                        <div className="grid gap-4">
                            {suppliers.data.map((supplier) => (
                                <Card key={supplier.id} className="hover:shadow-md transition-shadow">
                                    <CardHeader>
                                        <div className="flex justify-between items-start">
                                            <div className="flex-1">
                                                <CardTitle className="flex items-center gap-2">
                                                    <span className="text-2xl">🏢</span>
                                                    {supplier.name}
                                                    <span className={`px-2 py-1 text-xs rounded-full ${
                                                        supplier.status === 'active' 
                                                            ? 'bg-green-100 text-green-800' 
                                                            : 'bg-gray-100 text-gray-800'
                                                    }`}>
                                                        {supplier.status}
                                                    </span>
                                                </CardTitle>
                                                <CardDescription>{supplier.address}</CardDescription>
                                            </div>
                                            <div className="flex space-x-2">
                                                <Link href={`/suppliers/${supplier.id}`}>
                                                    <Button variant="outline" size="sm">View</Button>
                                                </Link>
                                                <Link href={`/suppliers/${supplier.id}/edit`}>
                                                    <Button variant="outline" size="sm">Edit</Button>
                                                </Link>
                                            </div>
                                        </div>
                                    </CardHeader>
                                    <CardContent>
                                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                            <div>
                                                <p className="font-medium">📞 Contact</p>
                                                <p className="text-muted-foreground">{supplier.phone}</p>
                                            </div>
                                            <div>
                                                <p className="font-medium">👤 PIC</p>
                                                <p className="text-muted-foreground">{supplier.pic}</p>
                                            </div>
                                            <div>
                                                <p className="font-medium">💰 Discount</p>
                                                <p className="text-muted-foreground">{supplier.discount_percentage}%</p>
                                            </div>
                                            <div>
                                                <p className="font-medium">⏰ Payment Terms</p>
                                                <p className="text-muted-foreground">{supplier.payment_terms_days} days</p>
                                            </div>
                                        </div>
                                    </CardContent>
                                </Card>
                            ))}
                        </div>
                    )}
                </div>

                {/* Pagination */}
                {suppliers.meta && suppliers.meta.last_page > 1 && (
                    <div className="flex justify-center space-x-2">
                        {suppliers.links.map((link, index: number) => (
                            <Link
                                key={index}
                                href={link.url || '#'}
                                className={`px-3 py-2 rounded-md text-sm ${
                                    link.active
                                        ? 'bg-primary text-primary-foreground'
                                        : 'bg-secondary text-secondary-foreground hover:bg-secondary/80'
                                } ${!link.url ? 'opacity-50 pointer-events-none' : ''}`}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </div>
                )}
            </div>
        </AppLayout>
    );
}