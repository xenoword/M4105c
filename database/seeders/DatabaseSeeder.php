<?php

namespace Database\Seeders;

use App\Models\PrecisionProbleme;
use App\Models\Probleme;
use App\Models\Ticket;
use App\Models\TypeUser;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CanResolve;
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
            "libelle" => "User"
        ]);
        TypeUser::create([
            "libelle" => "Operator"
        ]);
        TypeUser::create([
            "libelle" => "Manager"
        ]);
        User::create([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("admin"),
            "type_user_id" => 3
        ]);
        User::create([
            "name" => "user",
            "email" => "user@user.com",
            "password" => Hash::make("user"),
            "type_user_id" => 1
        ]);
        User::create([
            "name" => "operator",
            "email" => "ope@ope.com",
            "password" => Hash::make("ope"),
            "type_user_id" => 2
        ]);
        Probleme::create([
            "libelle"=>"Matériel"
        ]);
        Probleme::create([
            "libelle"=>"Logiciel"
        ]);
        Probleme::create([
            "libelle"=>"Utilisateur"
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Crash",
            "probleme_id"=>1
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Dysfonctionnement",
            "probleme_id"=>1
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Dégradation",
            "probleme_id"=>1
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Vol",
            "probleme_id"=>1
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Blocage",
            "probleme_id"=>2
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Erreurs",
            "probleme_id"=>2
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Fonction non disponible",
            "probleme_id"=>2
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Problème de sauvegarde",
            "probleme_id"=>2
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Licence expirée",
            "probleme_id"=>2
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Connexion/Mot de passe",
            "probleme_id"=>3
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Messagerie",
            "probleme_id"=>3
        ]);
        PrecisionProbleme::create([
            "libelle"=>"Accès au casiers",
            "probleme_id"=>3
        ]);
        CanResolve::create([
            "user_id" =>2,
            "precision_probleme_id" =>1
        ]);
        CanResolve::create([
            "user_id" =>2,
            "precision_probleme_id" =>3
        ]);
        CanResolve::create([
            "user_id" =>2,
            "precision_probleme_id" =>8
        ]);
        CanResolve::create([
            "user_id" =>2,
            "precision_probleme_id" =>10
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
            "probleme_id" => 1,
            "precision_probleme_id"=> 1,
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
            "probleme_id" => 1,
            "precision_probleme_id"=> 3,
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
            "probleme_id" => 2,
            "precision_probleme_id"=> 5,
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
            "probleme_id" => 2,
            "precision_probleme_id"=> 6,
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
            "probleme_id" => 1,
            "precision_probleme_id"=> 2,
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
            "probleme_id" => 3,
            "precision_probleme_id"=> null,
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
            "probleme_id" => 3,
            "precision_probleme_id"=> 12,
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
            "probleme_id" => 2,
            "precision_probleme_id"=> 6,
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
            "probleme_id" => 3,
            "precision_probleme_id"=> 11,
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
            "probleme_id" => 3,
            "precision_probleme_id"=> 10,
            "user_id" => 1
        ]);
    }
}
