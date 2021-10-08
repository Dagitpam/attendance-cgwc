<?php
namespace Database\Seeders;

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
        // $this->call(StateSeeder::class);
        // $this->call(LgaSeeder::class);
        // $this->call(CommunitySeeder::class);
        // $this->call(EducationSeeder::class);
        // $this->call(BenefitSeeder::class);
        // $this->call(StatusSeeder::class);
        // $this->call(BeneficiarySeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
        // $this->call(TrackerSeeder::class);
        // $this->call(ReportsSeeder::class);
        // $this->call(GrmSeeder::class);
        // $this->call(AllocationSeeder::class);
        // $this->call(InvestmentSeeder::class);
        //$this->call(ProjectSeeder::class);
        // $this->call(SocialSeeder::class);
        // $this->call(PeaceSeeder::class);
        // $this->call(TrainingSeeder::class);
        // $this->call(FeedbackSeeder::class);
        // $this->call(ComplainSeeder::class);
        // $this->call(CommunicationSeeder::class);
        // $this->call(TransportSeeder::class);
        // $this->call(WashSeeder::class);
        // $this->call(PumpBoreholeSeeder::class);
        // $this->call(SchoolSeeder::class);
        // $this->call(ClassroomSeeder::class);
        // $this->call(ScorecardSeeder::class);
    }
}

