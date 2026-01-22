<?php

namespace App\Services;

use App\Models\Quotation;
use App\Models\QuotationItem;

class QuotationTemplateService
{
    /**
     * Get all available quotation templates.
     */
    public static function getTemplates(): array
    {
        return [
            'web_development' => [
                'name' => 'Web Development Package',
                'items' => [
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'UI/UX Design',
                        'description' => 'User interface and user experience design including wireframes, mockups, and prototypes',
                        'quantity' => 5,
                        'unit_price' => 5000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Frontend Development',
                        'description' => 'HTML, CSS, JavaScript development with responsive design',
                        'quantity' => 10,
                        'unit_price' => 1500000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Backend Development',
                        'description' => 'Server-side development with database integration and API',
                        'quantity' => 15,
                        'unit_price' => 2000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Testing & QA',
                        'description' => 'Quality assurance, bug fixing, and performance testing',
                        'quantity' => 3,
                        'unit_price' => 3000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Deployment & Training',
                        'description' => 'Server deployment, configuration, and user training',
                        'quantity' => 2,
                        'unit_price' => 2500000,
                        'discount_percent' => 0,
                    ],
                ],
            ],
            'digital_marketing' => [
                'name' => 'Digital Marketing Campaign',
                'items' => [
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'SEO Optimization',
                        'description' => 'Search engine optimization including keyword research, on-page and off-page SEO',
                        'quantity' => 1,
                        'unit_price' => 8000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Google Ads Campaign',
                        'description' => 'Google AdWords campaign setup and management for 3 months',
                        'quantity' => 3,
                        'unit_price' => 3500000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Social Media Marketing',
                        'description' => 'Social media content creation and management (Instagram, Facebook, LinkedIn)',
                        'quantity' => 3,
                        'unit_price' => 4000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Content Writing',
                        'description' => 'Blog posts, articles, and marketing copy (20 pieces)',
                        'quantity' => 20,
                        'unit_price' => 500000,
                        'discount_percent' => 0,
                    ],
                ],
            ],
            'branding' => [
                'name' => 'Branding Package',
                'items' => [
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Logo Design',
                        'description' => 'Professional logo design with 5 concepts and unlimited revisions',
                        'quantity' => 1,
                        'unit_price' => 5000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Brand Guidelines',
                        'description' => 'Comprehensive brand identity guidelines including color palette, typography, and usage rules',
                        'quantity' => 1,
                        'unit_price' => 8000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Business Card Design',
                        'description' => 'Professional business card design with printing',
                        'quantity' => 1000,
                        'unit_price' => 3000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Marketing Collateral',
                        'description' => 'Brochure, flyer, and presentation template design',
                        'quantity' => 1,
                        'unit_price' => 6000000,
                        'discount_percent' => 0,
                    ],
                ],
            ],
            'mobile_app' => [
                'name' => 'Mobile App Development',
                'items' => [
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'UI/UX Design for Mobile',
                        'description' => 'Mobile app interface design for iOS and Android',
                        'quantity' => 8,
                        'unit_price' => 4000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Mobile App Development',
                        'description' => 'Native or cross-platform mobile app development',
                        'quantity' => 20,
                        'unit_price' => 2500000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'Backend API Development',
                        'description' => 'RESTful API development for mobile app',
                        'quantity' => 10,
                        'unit_price' => 3000000,
                        'discount_percent' => 0,
                    ],
                    [
                        'item_type' => QuotationItem::TYPE_SERVICE,
                        'name' => 'App Store Deployment',
                        'description' => 'Publishing to Google Play Store and Apple App Store',
                        'quantity' => 1,
                        'unit_price' => 5000000,
                        'discount_percent' => 0,
                    ],
                ],
            ],
            'custom' => [
                'name' => 'Custom Quotation',
                'items' => [
                    [
                        'item_type' => QuotationItem::TYPE_CUSTOM,
                        'name' => 'Custom Service',
                        'description' => 'Description of custom service',
                        'quantity' => 1,
                        'unit_price' => 0,
                        'discount_percent' => 0,
                    ],
                ],
            ],
        ];
    }

    /**
     * Apply template to a quotation by creating quotation items.
     */
    public static function applyTemplate(Quotation $quotation, string $templateKey): void
    {
        $templates = self::getTemplates();
        
        if (!isset($templates[$templateKey])) {
            return;
        }

        $template = $templates[$templateKey];
        
        // Delete existing items if any
        $quotation->items()->delete();
        
        // Create items from template
        foreach ($template['items'] as $index => $itemData) {
            $itemData['sort_order'] = $index;
            $quotation->items()->create($itemData);
        }
        
        // Recalculate totals
        $quotation->calculateTotals();
    }

    /**
     * Get template options for select field.
     */
    public static function getTemplateOptions(): array
    {
        $templates = self::getTemplates();
        $options = [];
        
        foreach ($templates as $key => $template) {
            $options[$key] = $template['name'];
        }
        
        return $options;
    }
}
