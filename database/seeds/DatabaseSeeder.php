<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(permissionsTableDataSeeder::class);
        $this->call(rolesTableDataSeeder::class);
        $this->call(roleHasPermissionsTableDataSeeder::class);
        $this->call(modelHasrolesTableDataSeeder::class);  
        $this->call(OutletsTableSeeder::class);
        $this->call(VendorsTableSeeder::class);
        $this->call(Admin_purchase_categeoriesTableSeeder::class);
        $this->call(Product_categoriesTableSeeder::class);
        $this->call(Product_sub_categoriesTableSeeder::class);
        $this->call(Wholesale_purchasesTableSeeder::class);
        $this->call(SitesettingsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(MakersTableSeeder::class);
        $this->call(Maker_itemsTableSeeder::class);
        $this->call(Payment_typesTableSeeder::class);
    }
}
