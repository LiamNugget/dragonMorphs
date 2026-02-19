<?php

namespace Database\Seeders;

use App\Models\Dragon;
use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DragonSeeder extends Seeder
{
    /**
     * Available source images from public/images/ to use as seed data.
     * We copy these into storage/app/public/dragons/ so they serve via the storage link.
     */
    private array $sourceImages = [
        'dragonOne.jpeg',
        'dragonTwo.jpeg',
        'dragonThree.jpeg',
        'dragonFour.jpeg',
        'dragonSlideOne.jpeg',
        'dragonSlideTwo.jpg',
        'dragonSlideThree.jpeg',
        'dragonSlideFour.jpeg',
    ];

    private int $imageIndex = 0;

    private function attachImage(Dragon $dragon, int $count = 1): void
    {
        for ($i = 0; $i < $count; $i++) {
            $source = $this->sourceImages[$this->imageIndex % count($this->sourceImages)];
            $this->imageIndex++;

            $ext = pathinfo($source, PATHINFO_EXTENSION);
            $filename = 'seed_' . $dragon->id . '_' . $i . '.' . $ext;
            $destPath = 'dragons/' . $filename;

            // Copy the file into storage
            $sourceFull = public_path('images/' . $source);
            if (File::exists($sourceFull)) {
                Storage::disk('public')->put($destPath, File::get($sourceFull));
            }

            Image::create([
                'dragon_id' => $dragon->id,
                'image_path' => $destPath,
                'is_primary' => $i === 0,
                'order' => $i,
            ]);
        }
    }

    public function run(): void
    {
        // Ensure dragons directory exists
        Storage::disk('public')->makeDirectory('dragons');

        // ── Breeding Stock - Males ──
        $sire1 = Dragon::create([
            'name' => 'Blaze',
            'sex' => 'male',
            'dob' => '2022-03-15',
            'morph' => 'Hypo',
            'weight' => 485,
            'status' => 'breeding_stock',
            'description' => 'Stunning hypo male with incredible orange colouring. One of our top sires producing amazing offspring consistently.',
            'notes' => 'Imported from USA breeder 2022. Excellent temperament.',
        ]);
        $this->attachImage($sire1, 2);

        $sire2 = Dragon::create([
            'name' => 'Ghost',
            'sex' => 'male',
            'dob' => '2021-07-22',
            'morph' => 'Zero',
            'weight' => 510,
            'status' => 'breeding_stock',
            'description' => 'Beautiful zero male, completely patternless with clean white colouring. Produces stunning zero and wero offspring.',
            'notes' => 'From top European bloodline.',
        ]);
        $this->attachImage($sire2, 2);

        $sire3 = Dragon::create([
            'name' => 'Titan',
            'sex' => 'male',
            'dob' => '2023-01-10',
            'morph' => 'Trans',
            'weight' => 420,
            'status' => 'breeding_stock',
            'description' => 'Translucent male with deep red colouring. Exceptional genetics for producing high-colour trans babies.',
            'notes' => 'UK bred, excellent lineage.',
        ]);
        $this->attachImage($sire3, 2);

        // ── Breeding Stock - Females ──
        $dam1 = Dragon::create([
            'name' => 'Ember',
            'sex' => 'female',
            'dob' => '2022-05-08',
            'morph' => 'Leatherback',
            'weight' => 390,
            'status' => 'breeding_stock',
            'description' => 'High colour leatherback female with vibrant red and orange. Consistently produces large healthy clutches.',
            'notes' => 'Paired with Blaze for 2025 season.',
        ]);
        $this->attachImage($dam1, 2);

        $dam2 = Dragon::create([
            'name' => 'Pearl',
            'sex' => 'female',
            'dob' => '2022-09-14',
            'morph' => 'Witblits',
            'weight' => 365,
            'status' => 'breeding_stock',
            'description' => 'Gorgeous witblits female, clean patternless look. Paired with Ghost to produce zeros and weros.',
            'notes' => 'Imported from Germany.',
        ]);
        $this->attachImage($dam2);

        $dam3 = Dragon::create([
            'name' => 'Ruby',
            'sex' => 'female',
            'dob' => '2023-04-20',
            'morph' => 'Hypo',
            'weight' => 340,
            'status' => 'breeding_stock',
            'description' => 'Extreme red hypo female. Incredible colour depth, one of the reddest dragons in our collection.',
            'notes' => 'First breeding season 2025.',
        ]);
        $this->attachImage($dam3);

        // ── Available ──
        $d = Dragon::create([
            'name' => 'Sunset',
            'sex' => 'female',
            'dob' => '2025-09-12',
            'morph' => 'Hypo',
            'weight' => 85,
            'price' => 250,
            'status' => 'available',
            'parent_male_id' => $sire1->id,
            'parent_female_id' => $dam1->id,
            'description' => 'Beautiful hypo leatherback female from our Blaze x Ember pairing. Showing incredible orange colouring already.',
            'date_listed' => '2025-11-01',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Inferno',
            'sex' => 'male',
            'dob' => '2025-09-12',
            'morph' => 'Leatherback',
            'weight' => 92,
            'price' => 200,
            'status' => 'available',
            'parent_male_id' => $sire1->id,
            'parent_female_id' => $dam1->id,
            'description' => 'Leatherback male from our Blaze x Ember clutch. Smooth scales and great colour coming through.',
            'date_listed' => '2025-11-01',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Phantom',
            'sex' => 'male',
            'dob' => '2025-10-05',
            'morph' => 'Zero',
            'weight' => 62,
            'price' => 350,
            'status' => 'available',
            'parent_male_id' => $sire2->id,
            'parent_female_id' => $dam2->id,
            'description' => 'Clean zero male from Ghost x Pearl. Completely patternless with bright white colouring. Rare morph.',
            'date_listed' => '2025-12-01',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Snowflake',
            'sex' => 'female',
            'dob' => '2025-10-05',
            'morph' => 'Wero',
            'weight' => 58,
            'price' => 400,
            'status' => 'available',
            'parent_male_id' => $sire2->id,
            'parent_female_id' => $dam2->id,
            'description' => 'Stunning wero female from our Ghost x Pearl pairing. Very rare morph combining zero and witblits genetics.',
            'date_listed' => '2025-12-01',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Crimson',
            'sex' => 'male',
            'dob' => '2025-11-18',
            'morph' => 'Trans',
            'weight' => 35,
            'price' => 300,
            'status' => 'available',
            'parent_male_id' => $sire3->id,
            'parent_female_id' => $dam3->id,
            'description' => 'Translucent male with deep red colouring. You can see the dark eyes characteristic of the trans morph.',
            'date_listed' => '2026-01-15',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => null,
            'sex' => 'female',
            'dob' => '2025-11-18',
            'morph' => 'Hypo',
            'weight' => 32,
            'price' => 175,
            'status' => 'available',
            'parent_male_id' => $sire3->id,
            'parent_female_id' => $dam3->id,
            'description' => 'Hypo female from our Titan x Ruby clutch. Nice citrus tones developing.',
            'date_listed' => '2026-01-15',
        ]);
        $this->attachImage($d);

        // ── Reserved ──
        $d = Dragon::create([
            'name' => 'Apollo',
            'sex' => 'male',
            'dob' => '2025-09-12',
            'morph' => 'Hypo',
            'weight' => 88,
            'price' => 275,
            'status' => 'reserved',
            'parent_male_id' => $sire1->id,
            'parent_female_id' => $dam1->id,
            'description' => 'Hypo male from Blaze x Ember. Reserved for collection in February.',
            'date_listed' => '2025-11-01',
            'notes' => 'Reserved by John D. Deposit paid. Collection 20th Feb.',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Misty',
            'sex' => 'female',
            'dob' => '2025-10-05',
            'morph' => 'Witblits',
            'weight' => 55,
            'price' => 325,
            'status' => 'reserved',
            'parent_male_id' => $sire2->id,
            'parent_female_id' => $dam2->id,
            'description' => 'Witblits female from Ghost x Pearl pairing. Beautiful patternless look.',
            'date_listed' => '2025-12-01',
            'notes' => 'Reserved by Sarah M. Full payment received. Shipping arranged.',
        ]);
        $this->attachImage($d);

        // ── Sold ──
        $d = Dragon::create([
            'name' => 'Blitz',
            'sex' => 'male',
            'dob' => '2025-06-20',
            'morph' => 'Dunner',
            'weight' => 180,
            'price' => 225,
            'status' => 'sold',
            'description' => 'Dunner male with great pattern. Went to a wonderful home in Manchester.',
            'date_listed' => '2025-08-15',
            'date_sold' => '2025-09-10',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Coral',
            'sex' => 'female',
            'dob' => '2025-06-20',
            'morph' => 'Genetic Stripe',
            'weight' => 165,
            'price' => 300,
            'status' => 'sold',
            'description' => 'Genetic stripe female with clean dorsal stripe. Sold to a breeder in London.',
            'date_listed' => '2025-08-15',
            'date_sold' => '2025-09-25',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Spike',
            'sex' => 'male',
            'dob' => '2025-04-10',
            'morph' => 'Silkback',
            'weight' => 220,
            'price' => 450,
            'status' => 'sold',
            'description' => 'Silkback male, completely scaleless. Very rare morph. Sold to experienced keeper.',
            'date_listed' => '2025-06-01',
            'date_sold' => '2025-07-15',
        ]);
        $this->attachImage($d);

        $d = Dragon::create([
            'name' => 'Luna',
            'sex' => 'female',
            'dob' => '2025-05-03',
            'morph' => 'Trans',
            'weight' => 195,
            'price' => 280,
            'status' => 'sold',
            'description' => 'Translucent female with stunning eyes. Sold to a family in Liverpool.',
            'date_listed' => '2025-07-01',
            'date_sold' => '2025-08-20',
        ]);
        $this->attachImage($d);
    }
}
