<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(ActivityStatusTableSeeder::class);
        $this->call(ActivityTypesTableSeeder::class);
        $this->call(AttachmentsTableSeeder::class);
        $this->call(CampaignClientTableSeeder::class);
        $this->call(CampaignMemberStatusTableSeeder::class);
        $this->call(CampaignStatusTableSeeder::class);
        $this->call(CampaignTypesTableSeeder::class);
        $this->call(CampaignsTableSeeder::class);
        $this->call(ClientEmailTemplateTableSeeder::class);
        $this->call(ClientPropertiesTableSeeder::class);
        $this->call(ClientSourceTableSeeder::class);
        $this->call(ClientStatusTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(ClientsUsersTableSeeder::class);
        $this->call(EmailTemplatesTableSeeder::class);
        $this->call(ForecastTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(ProjectDistrictTableSeeder::class);
        $this->call(ProjectUnitsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SaleInfoTableSeeder::class);
        $this->call(UnitFinishsTableSeeder::class);
        $this->call(UnitTypesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(UserActionsTableSeeder::class);
    }
}
