<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use App\Models\HomepageCard;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        // Section 1
        $section1 = HomepageSection::create([
            'heading' => 'Wholesale Infrastructure & Logistics',
            'description' => 'AZM CLAN provides the backbone for global product reach. Our end-to-end wholesale solutions ensure supply chain integrity, high-volume fulfillment, and rapid market deployment.',
            'section_key' => 'wholesale_1',
            'order_num' => 1,
        ]);

        HomepageCard::create([
            'homepage_section_id' => $section1->id,
            'heading' => 'Strategic Distribution',
            'description' => 'We act as your trusted B2B distributor, connecting your brand with reliable resellers while maintaining full control over pricing and presence.',
            'image' => 'wholesale_hero_1.png',
            'link' => '/products',
            'order_num' => 1,
        ]);

        HomepageCard::create([
            'homepage_section_id' => $section1->id,
            'heading' => 'Marketplace Protection',
            'description' => 'Safeguard your product listings across major online marketplaces and eliminate unauthorized or non-compliant sellers.',
            'image' => 'wholesale_hero_2.png',
            'link' => '/partner',
            'order_num' => 2,
        ]);

        // Section 2
        $section2 = HomepageSection::create([
            'heading' => 'Wholesale Infrastructure & Logistics',
            'description' => 'AZM CLAN provides the backbone for global product reach. Our end-to-end wholesale solutions ensure supply chain integrity, high-volume fulfillment, and rapid market deployment.',
            'section_key' => 'wholesale_2',
            'order_num' => 2,
        ]);

        HomepageCard::create([
            'homepage_section_id' => $section2->id,
            'heading' => 'Climate-Controlled Warehousing',
            'description' => 'State-of-the-art facilities optimized for medical and beauty product integrity with advanced SKU tracking.',
            'image' => 'wholesale_hero_1.png',
            'order_num' => 1,
        ]);

        HomepageCard::create([
            'homepage_section_id' => $section2->id,
            'heading' => 'Global Freight Logistics',
            'description' => 'Secure international shipping networks with real-time tracking, customs handling, and priority fulfillment.',
            'image' => 'wholesale_hero_2.png',
            'order_num' => 2,
        ]);

        HomepageCard::create([
            'homepage_section_id' => $section2->id,
            'heading' => 'Regulatory Compliance',
            'description' => 'Full adherence to international health standards, distribution regulations, and batch quality certification.',
            'image' => 'wholesale_hero_3.png',
            'order_num' => 3,
        ]);

        HomepageCard::create([
            'homepage_section_id' => $section2->id,
            'heading' => 'Scalable Vendor Portal',
            'description' => 'Enterprise-grade inventory access and automated bulk ordering systems for high-volume partners.',
            'image' => 'wholesale_hero_1.png',
            'order_num' => 4,
        ]);
    }
}
