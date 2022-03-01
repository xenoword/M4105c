<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TypeUser;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TypeUser::create([
            "libelle_type_user" => "User"
        ]);
        TypeUser::create([
            "libelle_type_user" => "Operator"
        ]);
        TypeUser::create([
            "libelle_type_user" => "Manager"
        ]);
        User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("admin"),
            "type_user_id" => 3
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 1,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => null,
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 2,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => null,
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 3,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 1,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 2,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 3,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 1,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 2,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 3,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
        Ticket::create([
            "description" => "Test description",
            "computer" => "S06",
            "link_attached_file" => null,
            "urgency" => 1,
            "redirection" => 0,
            "comment" => null,
            "date_start" => Date::now(),
            "date_end" => Date::now(),
            "probleme_id" => null,
            "user_id" => 1
        ]);
    }
}
