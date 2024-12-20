<?php

namespace Database\Seeders;

use App\Models\AccountTypeControllerModal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypesControllerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        $accountTypes = [
            [
                'id' => 1,
                'icon' => 'icon1.png',
                'priority' => 1,
                'title' => 'Account Type 1',
                'leverage' => '1:100',
                'country' => 'Country A',
                'badge' => 'badge1.png',
                'status' => 'Active',
            ],
            [
                'id' => 2,
                'icon' => 'icon2.png',
                'priority' => 2,
                'title' => 'Account Type 2',
                'leverage' => '1:200',
                'country' => 'Country B',
                'badge' => 'badge2.png',
                'status' => 'Active',
            ],
            [
                'id' => 3,
                'icon' => 'icon3.png',
                'priority' => 3,
                'title' => 'Account Type 3',
                'leverage' => '1:300',
                'country' => 'Country C',
                'badge' => 'badge3.png',
                'status' => 'Active',
            ],
            [
                'id' => 4,
                'icon' => 'icon4.png',
                'priority' => 4,
                'title' => 'Account Type 4',
                'leverage' => '1:400',
                'country' => 'Country D',
                'badge' => 'badge4.png',
                'status' => 'Active',
            ],
            [
                'id' => 5,
                'icon' => 'icon5.png',
                'priority' => 5,
                'title' => 'Account Type 5',
                'leverage' => '1:500',
                'country' => 'Country E',
                'badge' => 'badge5.png',
                'status' => 'Active',
            ],
            [
                'id' => 6,
                'icon' => 'icon6.png',
                'priority' => 6,
                'title' => 'Account Type 6',
                'leverage' => '1:600',
                'country' => 'Country F',
                'badge' => 'badge6.png',
                'status' => 'Active',
            ],
            [
                'id' => 7,
                'icon' => 'icon7.png',
                'priority' => 7,
                'title' => 'Account Type 7',
                'leverage' => '1:700',
                'country' => 'Country G',
                'badge' => 'badge7.png',
                'status' => 'Active',
            ],
            [
                'id' => 8,
                'icon' => 'icon8.png',
                'priority' => 8,
                'title' => 'Account Type 8',
                'leverage' => '1:800',
                'country' => 'Country H',
                'badge' => 'badge8.png',
                'status' => 'Active',
            ],
            [
                'id' => 9,
                'icon' => 'icon9.png',
                'priority' => 9,
                'title' => 'Account Type 9',
                'leverage' => '1:900',
                'country' => 'Country I',
                'badge' => 'badge9.png',
                'status' => 'Active',
            ],
            [
                'id' => 10,
                'icon' => 'icon10.png',
                'priority' => 10,
                'title' => 'Account Type 10',
                'leverage' => '1:1000',
                'country' => 'Country J',
                'badge' => 'badge10.png',
                'status' => 'Active',
            ],
            [
                'id' => 11,
                'icon' => 'icon11.png',
                'priority' => 11,
                'title' => 'Account Type 11',
                'leverage' => '1:1100',
                'country' => 'Country K',
                'badge' => 'badge11.png',
                'status' => 'Active',
            ],
            [
                'id' => 12,
                'icon' => 'icon12.png',
                'priority' => 12,
                'title' => 'Account Type 12',
                'leverage' => '1:1200',
                'country' => 'Country L',
                'badge' => 'badge12.png',
                'status' => 'Active',
            ],
            [
                'id' => 13,
                'icon' => 'icon13.png',
                'priority' => 13,
                'title' => 'Account Type 13',
                'leverage' => '1:1300',
                'country' => 'Country M',
                'badge' => 'badge13.png',
                'status' => 'Active',
            ],
            [
                'id' => 14,
                'icon' => 'icon14.png',
                'priority' => 14,
                'title' => 'Account Type 14',
                'leverage' => '1:1400',
                'country' => 'Country N',
                'badge' => 'badge14.png',
                'status' => 'Active',
            ],
            [
                'id' => 15,
                'icon' => 'icon15.png',
                'priority' => 15,
                'title' => 'Account Type 15',
                'leverage' => '1:1500',
                'country' => 'Country O',
                'badge' => 'badge15.png',
                'status' => 'Active',
            ],
            [
                'id' => 16,
                'icon' => 'icon16.png',
                'priority' => 16,
                'title' => 'Account Type 16',
                'leverage' => '1:1600',
                'country' => 'Country P',
                'badge' => 'badge16.png',
                'status' => 'Active',
            ],
            [
                'id' => 17,
                'icon' => 'icon17.png',
                'priority' => 17,
                'title' => 'Account Type 17',
                'leverage' => '1:1700',
                'country' => 'Country Q',
                'badge' => 'badge17.png',
                'status' => 'Active',
            ],
            [
                'id' => 18,
                'icon' => 'icon18.png',
                'priority' => 18,
                'title' => 'Account Type 18',
                'leverage' => '1:1800',
                'country' => 'Country R',
                'badge' => 'badge18.png',
                'status' => 'Active',
            ],
            [
                'id' => 19,
                'icon' => 'icon19.png',
                'priority' => 19,
                'title' => 'Account Type 19',
                'leverage' => '1:1900',
                'country' => 'Country S',
                'badge' => 'badge19.png',
                'status' => 'Active',
            ],
            [
                'id' => 20,
                'icon' => 'icon20.png',
                'priority' => 20,
                'title' => 'Account Type 20',
                'leverage' => '1:2000',
                'country' => 'Country T',
                'badge' => 'badge20.png',
                'status' => 'Active',
            ],
        ];

        AccountTypeControllerModal::insert($accountTypes);
    }

}
