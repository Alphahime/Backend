<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanNutritionnelSeeder extends Seeder
{
    public function run(): void
    {
        // Vider la table
        DB::table('plan_nutritionnels')->truncate();

        // Inserting 30 specific recipes
        $recettes = [
            [
                'nom' => 'Salade César',
                'description' => 'Une salade composée avec de la laitue, des croûtons, et une sauce césar maison.',
                'type_alimentation' => 'Salade',
                'calories_totale' => '400 kcal',
                'ingredients' => json_encode([
                    'Laitue romaine',
                    'Croûtons',
                    'Parmesan râpé',
                    'Sauce césar maison (jaune d\'œuf, huile d\'olive, ail, anchois, moutarde, jus de citron)',
                    'Poulet grillé (optionnel)',
                ]),
                'etapes' => json_encode([
                    'Laver et couper la laitue.',
                    'Griller les croûtons dans un peu de beurre.',
                    'Préparer la sauce césar en mélangeant les ingrédients.',
                    'Mélanger la laitue avec la sauce, ajouter les croûtons et le parmesan.',
                    'Ajouter le poulet grillé en tranches si désiré.',
                ]),
                'image' => 'https://rians.com/wp-content/uploads/2024/04/1000038128.jpg',
            ],
            [
                'nom' => 'Smoothie Vert Détox',
                'description' => 'Un smoothie revitalisant et purifiant, idéal pour le petit-déjeuner ou en collation.',
                'type_alimentation' => 'Boisson',
                'calories_totale' => '250 kcal',
                'ingredients' => json_encode([
                    'Épinards frais',
                    'Banane',
                    'Avocat',
                    'Lait d\'amande',
                    'Graines de chia',
                    'Miel (optionnel)',
                ]),
                'etapes' => json_encode([
                    'Mélanger tous les ingrédients dans un mixeur.',
                    'Ajouter un peu d\'eau ou de lait d\'amande selon la consistance désirée.',
                    'Servir immédiatement et garnir de graines de chia.',
                ]),
                'image' => 'https://www.consoglobe.com/wp-content/uploads/2015/03/smoothie-boisson-detox.jpg',
            ],
            [
                'nom' => 'Poulet au Curry',
                'description' => 'Un plat de poulet mijoté avec une sauce au curry et lait de coco.',
                'type_alimentation' => 'Plat principal',
                'calories_totale' => '600 kcal',
                'ingredients' => json_encode([
                    'Filets de poulet',
                    'Pâte de curry',
                    'Lait de coco',
                    'Oignons',
                    'Tomates',
                    'Riz basmati (pour accompagner)',
                ]),
                'etapes' => json_encode([
                    'Faire revenir les oignons dans une poêle.',
                    'Ajouter le poulet coupé en morceaux et cuire jusqu\'à ce qu\'il soit doré.',
                    'Incorporer la pâte de curry et bien mélanger.',
                    'Ajouter les tomates et le lait de coco, laisser mijoter 20 minutes.',
                    'Servir avec du riz basmati.',
                ]),
                'image' => 'https://static.750g.com/images/1200-630/91ab938d758f762c1f3f84286b121e53/adobestock-307737508.jpeg',
            ],
            [
                'nom' => 'Pancakes Protéinés',
                'description' => 'Des pancakes riches en protéines, parfaits pour un petit-déjeuner énergétique.',
                'type_alimentation' => 'Petit-déjeuner',
                'calories_totale' => '350 kcal',
                'ingredients' => json_encode([
                    'Farine d\'avoine',
                    'Protéine en poudre (saveur vanille)',
                    'Lait d\'amande',
                    'Œufs',
                    'Sirop d\'érable (optionnel)',
                ]),
                'etapes' => json_encode([
                    'Mélanger tous les ingrédients jusqu\'à obtenir une pâte homogène.',
                    'Verser des petites portions dans une poêle chaude.',
                    'Cuire jusqu\'à ce que des bulles apparaissent, puis retourner les pancakes.',
                    'Servir avec du sirop d\'érable ou des fruits frais.',
                ]),
                'image' => 'https://img.cuisineaz.com/660x660/2019/07/12/i147980-pancake-proteine.jpeg',
            ],
            // Ajoutez d'autres recettes protéinées et smoothies ici
        ];

        // Ajouter des recettes protéinées
        $recettes_proteinees = [
            [
                'nom' => 'Poulet Grillé aux Épices',
                'description' => 'Un poulet grillé savoureux et épicé, parfait pour un repas riche en protéines.',
                'type_alimentation' => 'Plat principal',
                'calories_totale' => '450 kcal',
                'ingredients' => json_encode([
                    'Filets de poulet',
                    'Paprika',
                    'Cumin',
                    'Ail en poudre',
                    'Huile d\'olive',
                    'Sel et poivre',
                ]),
                'etapes' => json_encode([
                    'Mélanger les épices avec l\'huile d\'olive et frotter sur le poulet.',
                    'Faire mariner pendant au moins 30 minutes.',
                    'Griller le poulet jusqu\'à ce qu\'il soit bien cuit.',
                ]),
                'image' => 'https://resize.prod.femina.ladmedia.fr/rblr/652,438/img/var/2020-09/recette-poulet-grille-aux-e-pices-mai-s-cocon-citron-cyril-lignac.jpg',
            ],
            [
                'nom' => 'Omelette aux Épinards et Feta',
                'description' => 'Une omelette riche en protéines avec des épinards frais et du fromage feta.',
                'type_alimentation' => 'Petit-déjeuner',
                'calories_totale' => '300 kcal',
                'ingredients' => json_encode([
                    'Œufs',
                    'Épinards frais',
                    'Feta',
                    'Oignons',
                    'Huile d\'olive',
                ]),
                'etapes' => json_encode([
                    'Battre les œufs dans un bol.',
                    'Faire revenir les oignons et les épinards dans une poêle.',
                    'Ajouter les œufs et la feta, cuire jusqu\'à ce que l\'omelette soit prise.',
                ]),
                'image' => 'https://img-global.cpcdn.com/recipes/ab1039aaa1097224/1200x630cq70/photo.jpg',
            ],
        ];

        // Ajouter des smoothies
        $recettes_smoothies = [
            [
                'nom' => 'Smoothie aux Fruits Rouges',
                'description' => 'Un smoothie délicieux à base de fruits rouges, parfait pour une collation.',
                'type_alimentation' => 'Boisson',
                'calories_totale' => '200 kcal',
                'ingredients' => json_encode([
                    'Fruits rouges (frais ou surgelés)',
                    'Yaourt nature',
                    'Lait',
                    'Miel (optionnel)',
                ]),
                'etapes' => json_encode([
                    'Mettre tous les ingrédients dans un mixeur.',
                    'Mixer jusqu\'à consistance lisse.',
                    'Servir frais.',
                ]),
                'image' => 'https://gateauetcuisinerachida.com/wp-content/uploads/2023/02/Recette-smoothie-aux-fruits-rouges.jpg',
            ],
            [
                'nom' => 'Smoothie à la Mangue et à la Banane',
                'description' => 'Un smoothie tropical à base de mangue et de banane, parfait pour l\'été.',
                'type_alimentation' => 'Boisson',
                'calories_totale' => '220 kcal',
                'ingredients' => json_encode([
                    'Mangue',
                    'Banane',
                    'Lait de coco',
                    'Graines de chia',
                ]),
                'etapes' => json_encode([
                    'Couper la mangue et la banane en morceaux.',
                    'Mettre dans un mixeur avec le lait de coco.',
                    'Mixer jusqu\'à obtenir une consistance lisse.',
                ]),
                'image' => 'https://www.lesoeufs.ca/assets/RecipeThumbs/Seasonal-Protein-Bowl2.jpg',
            ],
        ];

        // Fusionner tous les tableaux de recettes
        $recettes = array_merge($recettes, $recettes_proteinees, $recettes_smoothies);

        // Insérer les recettes dans la base de données
        foreach ($recettes as $recette) {
            DB::table('plan_nutritionnels')->insert($recette);
        }
    }
}
