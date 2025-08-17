import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/components/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { type BreadcrumbItem } from '@/types';

interface Material {
    id: number;
    name: string;
    sku: string;
    description: string;
    unit: string;
    unit_cost: number;
    current_stock: number;
    minimum_stock: number;
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
    materials: {
        data: Material[];
        links: PaginationLink[];
        meta: PaginationMeta;
    };
    [key: string]: unknown;
}

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Materials', href: '/materials' },
];

export default function MaterialsIndex({ materials }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Raw Materials" />
            
            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold">📦 Raw Materials</h1>
                        <p className="text-muted-foreground">
                            Track your inventory and manage stock levels
                        </p>
                    </div>
                    <Link href="/materials/create">
                        <Button>Add New Material</Button>
                    </Link>
                </div>

                <div className="grid gap-4">
                    {materials.data.length === 0 ? (
                        <Card>
                            <CardContent className="p-6">
                                <div className="text-center">
                                    <div className="text-6xl mb-4">📦</div>
                                    <h3 className="text-lg font-semibold mb-2">No materials found</h3>
                                    <p className="text-muted-foreground mb-4">
                                        Get started by adding your first raw material
                                    </p>
                                    <Link href="/materials/create">
                                        <Button>Add Material</Button>
                                    </Link>
                                </div>
                            </CardContent>
                        </Card>
                    ) : (
                        <div className="grid gap-4">
                            {materials.data.map((material) => {
                                const isLowStock = material.current_stock <= material.minimum_stock;
                                
                                return (
                                    <Card key={material.id} className="hover:shadow-md transition-shadow">
                                        <CardHeader>
                                            <div className="flex justify-between items-start">
                                                <div className="flex-1">
                                                    <CardTitle className="flex items-center gap-2">
                                                        <span className="text-2xl">🧴</span>
                                                        {material.name}
                                                        <span className="text-sm text-muted-foreground">({material.sku})</span>
                                                        <span className={`px-2 py-1 text-xs rounded-full ${
                                                            material.status === 'active' 
                                                                ? 'bg-green-100 text-green-800' 
                                                                : 'bg-gray-100 text-gray-800'
                                                        }`}>
                                                            {material.status}
                                                        </span>
                                                        {isLowStock && (
                                                            <span className="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                                Low Stock
                                                            </span>
                                                        )}
                                                    </CardTitle>
                                                    <CardDescription>{material.description}</CardDescription>
                                                </div>
                                                <div className="flex space-x-2">
                                                    <Link href={`/materials/${material.id}`}>
                                                        <Button variant="outline" size="sm">View</Button>
                                                    </Link>
                                                    <Link href={`/materials/${material.id}/edit`}>
                                                        <Button variant="outline" size="sm">Edit</Button>
                                                    </Link>
                                                </div>
                                            </div>
                                        </CardHeader>
                                        <CardContent>
                                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                                <div>
                                                    <p className="font-medium">💰 Unit Cost</p>
                                                    <p className="text-muted-foreground">${material.unit_cost}/{material.unit}</p>
                                                </div>
                                                <div>
                                                    <p className="font-medium">📊 Current Stock</p>
                                                    <p className={`font-semibold ${isLowStock ? 'text-red-600' : 'text-green-600'}`}>
                                                        {material.current_stock} {material.unit}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p className="font-medium">⚠️ Minimum Stock</p>
                                                    <p className="text-muted-foreground">{material.minimum_stock} {material.unit}</p>
                                                </div>
                                                <div>
                                                    <p className="font-medium">📏 Unit</p>
                                                    <p className="text-muted-foreground">{material.unit}</p>
                                                </div>
                                            </div>
                                        </CardContent>
                                    </Card>
                                );
                            })}
                        </div>
                    )}
                </div>

                {/* Pagination */}
                {materials.meta && materials.meta.last_page > 1 && (
                    <div className="flex justify-center space-x-2">
                        {materials.links.map((link, index: number) => (
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