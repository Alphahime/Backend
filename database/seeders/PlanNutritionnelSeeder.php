<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlanNutritionnelSeeder extends Seeder
{
    public function run(): void
    {
        $recettes = [
            [
                'nom' => 'Omelette aux épinards',
                'description' => 'Une omelette délicieuse et nutritive avec des épinards frais.',
                'type_alimentation' => 'Petit-déjeuner',
                'calories_totale' => '250',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'ingredients' => json_encode(['Œufs', 'Épinards', 'Fromage', 'Sel', 'Poivre']),
                'etapes' => json_encode(['Battre les œufs', 'Ajouter les épinards', 'Cuire à la poêle', 'Ajouter du fromage']),
                'image' => 'https://img.freepik.com/photos-premium/omelette-aux-oeufs-epinards-ricotta_1082220-1591.jpg?w=826', 
            ],
            [
                'nom' => 'Salade de quinoa',
                'description' => 'Une salade saine et rassasiante à base de quinoa et de légumes frais.',
                'type_alimentation' => 'Déjeuner',
                'calories_totale' => '350',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'ingredients' => json_encode(['Quinoa', 'Tomates', 'Concombre', 'Avocat', 'Vinaigrette']),
                'etapes' => json_encode(['Cuire le quinoa', 'Couper les légumes', 'Mélanger tous les ingrédients']),
                'image' => 'https://img.freepik.com/photos-gratuite/bol-bouddha-vegetarien-quinoa-tofu-legumes-frais-concept-aliments-sains-salade-vegetalienne_2829-6931.jpg?t=st=1729467718~exp=1729471318~hmac=cd8b9433fafe0ad4e5461e1427c09b3325fd5fafad13736c74e6cf4635fc8d08&w=1380', 
            ],
            [
                'nom' => 'Poulet grillé avec légumes',
                'description' => 'Un plat simple et délicieux de poulet grillé accompagné de légumes.',
                'type_alimentation' => 'Dîner',
                'calories_totale' => '400',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'ingredients' => json_encode(['Poulet', 'Courgettes', 'Poivrons', 'Épices']),
                'etapes' => json_encode(['Mariner le poulet', 'Griller le poulet', 'Cuire les légumes']),
                'image' => 'https://img.freepik.com/photos-gratuite/appetissant-riz-sain-legumes-plaque-blanche-table-bois_2829-19773.jpg?t=st=1729467820~exp=1729471420~hmac=810608e354178f858090edde9e4d37e07fe2afc548f81b8bf838e176d14943d7&w=1380', // Chemin vers l'image
            ],
            [
                'nom' => 'Porridge aux fruits',
                'description' => 'Un porridge crémeux avec des fruits frais pour le petit-déjeuner.',
                'type_alimentation' => 'Petit-déjeuner',
                'calories_totale' => '300',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'ingredients' => json_encode(['Flocons d\'avoine', 'Lait', 'Fruits', 'Miel']),
                'etapes' => json_encode(['Faire chauffer le lait', 'Ajouter les flocons d\'avoine', 'Ajouter les fruits et le miel']),
                'image' => 'https://img.freepik.com/photos-gratuite/baies-avoine-raisins-noirs-cerises-groseilles-rouges-grenades_140725-73685.jpg?t=st=1729468064~exp=1729471664~hmac=a5430923c1d4709a41d021e609ce3a6cc5720000f23b002370f47618b1e00248&w=740',
            ],
            [
                'nom' => 'Smoothie banane et épinards',
                'description' => 'Un smoothie nutritif à base de banane et d’épinards.',
                'type_alimentation' => 'Collation',
                'calories_totale' => '200',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'ingredients' => json_encode(['Banane', 'Épinards', 'Yaourt', 'Lait']),
                'etapes' => json_encode(['Mélanger tous les ingrédients', 'Servir frais']),
                'image' => 'https://img.freepik.com/photos-gratuite/appetissant-riz-sain-legumes-plaque-blanche-table-bois_2829-19773.jpg?t=st=1729467820~exp=1729471420~hmac=810608e354178f858090edde9e4d37e07fe2afc548f81b8bf838e176d14943d7&w=1380', // Chemin vers l'image
            ],
            [
                'nom' => 'Pâtes au pesto',
                'description' => 'Des pâtes savoureuses avec une sauce pesto maison.',
                'type_alimentation' => 'Déjeuner',
                'calories_totale' => '450',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'ingredients' => json_encode(['Pâtes', 'Basilic', 'Pignons de pin', 'Ail', 'Parmesan']),
                'etapes' => json_encode(['Cuire les pâtes', 'Préparer le pesto', 'Mélanger les pâtes avec le pesto']),
                'image' => 'https://img.freepik.com/photos-gratuite/biscuits-aux-baies_1203-9495.jpg?t=st=1729467774~exp=1729471374~hmac=cac2cb02855892dfa4497693057f7f0f03e7614b32ff37066fc2ca773db73700&w=826', 
            ],
            [
                'nom' => 'Bowl de riz et légumes',
                'description' => 'Un bol de riz savoureux avec des légumes variés.',
                'type_alimentation' => 'Dîner',
                'calories_totale' => '500',
                'date_creation' => Carbon::now(),
                'date_mise_a_jour' => Carbon::now(),
                'ingredients' => json_encode(['Riz', 'Brocoli', 'Carottes', 'Sauce soja']),
                'etapes' => json_encode(['Cuire le riz', 'Cuire les légumes', 'Assembler le bowl']),
                'image' => 'https://img.freepik.com/photos-gratuite/appetissant-riz-sain-legumes-plaque-blanche-table-bois_2829-19773.jpg?t=st=1729467820~exp=1729471420~hmac=810608e354178f858090edde9e4d37e07fe2afc548f81b8bf838e176d14943d7&w=1380', // Chemin vers l'image
            ],
            // Ajoutez d'autres recettes ici...
        ];

        foreach ($recettes as $recette) {
            DB::table('plan_nutritionnels')->insert($recette);
        }
    }
}
