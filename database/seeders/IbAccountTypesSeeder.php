<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ibAccounttypesModal; // Update with the correct model name



class IbAccountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 1',
        'badge' => 'Multi level',
        'status' => 'Active',
        'type' => 'Premium',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Inactive',
        'type' => 'Standard',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 2',
        'badge' => 'Multi level',
        'status' => 'Inactive',
        'type' => 'Premium',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 3',
        'badge' => 'Multi level',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Inactive',
        'type' => 'Premium',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 4',
        'badge' => 'Multi level',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Inactive',
        'type' => 'Standard',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 5',
        'badge' => 'Multi level',
        'status' => 'Active',
        'type' => 'Premium',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 6',
        'badge' => 'Multi level',
        'status' => 'Inactive',
        'type' => 'Standard',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Inactive',
        'type' => 'Premium',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 7',
        'badge' => 'Multi level',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 8',
        'badge' => 'Multi level',
        'status' => 'Inactive',
        'type' => 'Premium',
    ],
    [
        'title' => 'Single Level IB',
        'group' => 'real\IB\IB Main',
        'badge' => 'Single',
        'status' => 'Active',
        'type' => 'Standard',
    ],
    [
        'title' => 'Multi Level IB',
        'group' => 'real\IB\Level 9',
        'badge' => 'Multi level',
        'status' => 'Active',
        'type' => 'Standard',
    ],
            [
                'title' => 'Multi Level IB',
                'group' => 'real\IB\Level 1',
                'badge' => 'Multi level',
                'status' => 'Active',
                'type' => 'Premium',
            ]
            // Add more entries as needed
            ];

            ibAccountTypesModal::insert($accounts);
    }
}



    


